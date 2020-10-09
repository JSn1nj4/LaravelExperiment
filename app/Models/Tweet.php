<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * The base Twitter API URL
     *
     * @property string         $api_url
     * @access private
     */
    private $api_url = 'https://api.twitter.com';

    /**
     * The token used for retrieving tweet information from the Twitter API
     *
     * @property string         $token
     * @access private
     */
    private $token;

    /**
     * The API key used for generating the token
     *
     * @property string         $key
     * @access private
     */
    private $key;

    /**
     * The API secret key part used for generating the token
     *
     * @property string         $secret
     * @access private
     */
    private $secret;

    /**
     * Create a new instance of the Tweet model
     *
     * @method                  __construct
     * @access public
     *
     * @param array             $attributes
     *
     * @return void
     *
     * This is necessary to initialize some properties that can't otherwise be
     * initialized. Initializing properties outside of a constrctor requires
     * that the initial values be static.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->token = config('services.twitter.token', false);
        $this->key = config('services.twitter.key', false);
        $this->secret = config('services.twitter.secret', false);
    }

    /**
     * Generate a new Twitter API token if one doesn't exist
     *
     * @method                  createToken
     * @access public
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
        if($this->token) {
            return true;
        }

        if(!$this->key || !$this->secret) {
            abort(500);
        }

        $post_url = "$this->api_url/oauth2/token";

        $twitter_str = base64_encode(urlencode($this->key) . ':' . urlencode($this->secret));

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $post_url,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic $twitter_str",
                "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
            ],
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_RETURNTRANSFER => true
        ]);

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
     * @method                  getRawTweets
     * @access public
     *
     * @param string            $curl_url
     *
     * @return string
     */
    public function getRawTweets(string $curl_url)
    {
        if(!$this->token) {
            $this->createToken();
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $curl_url,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $this->token"
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $tweets = curl_exec($ch);

        if(isset(json_decode($tweets)->errors)) {
            abort(500);
        }

        curl_close($ch);

        return $tweets;
    }

    /**
     * Format tweet data
     *
     * @method                  formatTweetData
     * @access private
     *
     * @param string            $tweets
     *
     * @return array
     *
     * Strip down tweet data returned by Twitter API. Most of the data returned
     * by the Twitter API isn't necessary in this case.
     */
    private function formatTweetData($tweets)
    {
        $formattedTweets = collect([]);

        foreach(json_decode($tweets, true) as $tweet) {
            $tweet = collect($tweet)->reject(function($val, $key) {
                return !in_array($key, [
                    'created_at',
                    'id_str',
                    'text',
                    'entities',
                    'user'
                ]);
            });

            $user = collect($tweet->get('user'))->reject(function($val, $key) {
                return !in_array($key, [
                    'name',
                    'screen_name',
                    'profile_image_url_https'
                ]);
            });
            $tweet->put('user', $user->toArray());

            $formattedTweets->push($tweet->toArray());
        }

        return $formattedTweets->toJson();
    }

    /**
     * Retrieve tweets
     *
     * @method                  getTweet
     * @access public
     *
     * @param array             $options: count, screen_name, retweets
     *
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
            $options['retweets'] : true;

        $url = "$this->api_url/1.1/statuses/user_timeline.json?count=$count&screen_name=$screen_name&include_rts=$retweets";
        return $this->formatTweetData($this->getRawTweets($url));
    }

    /**
     * Retrieve a single tweet
     *
     * @method                  getTweet
     * @access public
     *
     * @param string            $tweet_id
     *
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
