<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class TwitterClient
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
    public function __construct()
    {
        $this->token = config('services.twitter.token', false);
        $this->key = config('services.twitter.key', false);
        $this->secret = config('services.twitter.secret', false);
    }

    /**
     * Get the Twitter API token
     *
     * Generate a new one if necessary.
     *
     * @method                  getToken
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
    public function getToken()
    {
        if ($this->token) {
            return $this->token;
        }

        if (!$this->key || !$this->secret) {
            abort(500);
        }

        $auth_hash = base64_encode(urlencode($this->key) . ':' . urlencode($this->secret));

        $response = Http::asForm()->withHeaders([
            'Authorization' => "Basic {$auth_hash}",
        ])->post("{$this->api_url}/oauth2/token", [
            'grant_type' => 'client_credentials',
        ]);

        if($response->failed()) {
            $response->throw();
        }

        $this->token = $response['access_token'];

        return $this->token;
    }

    /**
     * Get tweets from the Twitter API
     *
     * The argument for `$since` must be an ID because this is what the
     * Twitter API requires to find tweets after a certain point.
     */
    public function getTweets(string $username, ?string $since = null, bool $retweets = true, ?int $count = null)
    {
        $url = "{$this->api_url}/1.1/statuses/user_timeline.json?" .
               ($count ? "count={$count}&" : "") .
               ($since ? "since_id={$since}" : "") .
               "screen_name={$username}&include_rts={$retweets}";

        $response = Http::withToken($this->getToken())->get($url);

        if($response->failed()) {
            $response->throw();
        }

        return $response->json();
    }

    /**
     * Get a single tweet by its ID
     */
    public function getSingleTweet(string $tweet_id)
    {
        $url = "{$this->api_url}/1.1/statuses/show.json?id={$tweet_id}";

        $response = Http::withToken($this->getToken())->get($url);

        if ($response->failed()) {
            $response->throw();
        }

        return $response->json();
    }
}
