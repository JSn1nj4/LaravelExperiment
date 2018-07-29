<?php

namespace App\Http\Controllers;

use App\Tweet;

class TweetController extends Controller
{
    /**
     * Instance of App\Tweet used for interacting with the Twitter API
     *
     * @var App\Tweet   $tweets
     */
    private $tweets;

    /**
     * Store instance of App\Tseet on controller instantiation
     *
     * @return void
     */
    public function __construct()
    {
        $this->tweets = new Tweet;
    }

    /**
     * Get a list of tweets for display in a timeline-like view
     *
     * @return string
     */
    public function index(int $count = 5)
    {
        return $this->tweets->getTweets([
            'count' => $count
        ]);
    }

    /**
     * Get a single tweet for display as a tweet-like widget
     *
     * @return string
     */
    public function show(string $id)
    {
        return $this->tweets->getTweet($id);
    }
}
