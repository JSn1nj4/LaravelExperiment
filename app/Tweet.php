<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * The base Twitter API URL
     *
     * @var string
     */
    private $api_url = 'https://api.twitter.com';

    /**
     * The token used for retrieving tweet information from the Twitter API
     *
     * @var string
     */
    private $token;

    /**
     * The API key used for generating the token
     *
     * @var string
     */
    private $key;

    /**
     * The API secret key part used for generating the token
     *
     * @var string
     */
    private $secret;

    /**
     * Create a new instance of the Tweet model
     *
     * @param array     $attributes
     * @return void
     *
     * This is necessary to initialize some properties that can't otherwise be
     * initialized. Initializing properties outside of a constrctor requires
     * that the initial values be static.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->token = config('service.twitter.token', false);
        $this->key = config('services.twitter.key', false);
        $this->secret = config('services.twitter.secret', false);
    }

    /**
     * Generate a new Twitter API token if one doesn't exist
     *
     * @return void
     *
     * The 'if' in this case has to do with whether Twitter already has a token
     * for use. If the token hasn't been generated previously or if the previous
     * token was revoked, then this function will be used to ask Twitter for a
     * new one.
     *
     * This method will also only be called if the token doesn't already exist
     * in the environment.
     */
    public function createToken()
    {
        if(!$this->token) {
            return true;
        }

        if(!$this->key || !$this->secret) {
            abort(500);
        }

        $post_url = "$this->api_url/oauth2/token";

        $twitter_str = base64_encode(urlencode($this->key) . ':' . urlencode($this->secret));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $post_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic $twitter_str",
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        if(isset($result->errors)) {
            abort(500);
        }

        $this->token = $result->access_token;
    }

    /**
     * Retrieve raw tweets via Twitter's GET API
     *
     * @param string    $curl_url
     * @return string
     */
    public function getRawTweets(string $curl_url)
    {
        if(!$this->token) {
            $this->createToken();
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $this->token"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $tweets = curl_exec($ch);

        if(isset(json_decode($tweets)->errors)) {
            abort(500);
        }

        return $tweets;
    }

    /**
     * Format tweet data
     *
     * @param string    $tweets
     * @return array
     *
     * Strip down tweet data returned by Twitter API. Most of the data returned
     * by the Twitter API isn't necessary in this case.
     */
    private function formatTweetData($tweets)
    {
        $formattedTweets = [];

        foreach(json_decode($tweets) as $tweet) {
            $tmp = new \stdClass;
            $tmp->created_at = $tweet->created_at;
            $tmp->id_str = $tweet->id_str;
            $tmp->text = $tweet->text;
            $tmp->entities = new \stdClass;
            $tmp->entities->hashtags = [];
            $tmp->entities->user_mentions = [];
            $tmp->user = new \stdClass;
            $tmp->user->name = $tweet->user->name;
            $tmp->user->screen_name = $tweet->user->screen_name;
            $tmp->user->profile_image_url_https = $tweet->user->profile_image_url_https;

            foreach($tweet->entities->hashtags as $hashtag) {
                array_push($tmp->entities->hashtags, $hashtag->text);
            }

            foreach($tweet->entities->user_mentions as $user_mention) {
                array_push($tmp->entities->user_mentions, $user_mention->screen_name);
            }

            array_push($formattedTweets, $tmp);
        }

        return $formattedTweets;
    }

    /**
     * Retrieve tweets
     *
     * @param array     $options: count, screen_name, retweets
     * @return string
     *
     * This method returns a list of tweets that their initial API data trimmed
     * down first.
     */
    public function getTweets(array $options = [])
    {
        $count = isset($options['count']) && $options['count'] > 0 ?
            $options['count'] : 5;
        $screen_name = isset($options['screen_name']) && mb_strlen($options['screen_name']) ?
            $options['screen_name'] : 'jsn1nj4';
        $retweets = isset($options['retweets']) && is_bool($options['retweets']) ?
            $options['retweets'] : false;

        $url = "$this->api_url/1.1/statuses/user_timeline.json?count=$count&screen_name=$screen_name&include_rts=$retweets";
        return $this->formatTweetData($this->getRawTweets($url));
    }

    /**
     * Retrieve a single tweet
     *
     * @param string    $tweet_id
     * @return string
     *
     * This method returns a single tweet in an array. It currently needs to be
     * in this format due to the formateTweetData method being made to work on
     * arrays.
     */
    public function getTweet($tweet_id)
    {
        $url = "$this->api_url/1.1/statuses/show.json?id=$tweet_id";
        return $this->formatTweetData("[" . $this->getRawTweets($url) . "]");
    }
}
