<?php

namespace App\Http\Controllers;

use App\Tweet;

class TweetController extends Controller
{
    /**
     * Used for interacting with the Twitter API
     *
     * @property App\Tweet      $tweets
     * @access private
     */
    private $tweets;

    /**
     * Store instance of App\Tseet on controller instantiation
     *
     * @method                  __construct
     * @access public
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
     * @method                  index
     * @access public
     *
     * @param integer           $count
     *
     * @return object
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
     * @method                  show
     * @access public
     *
     * @param string            $id
     *
     * @return object
     */
    public function show(string $id)
    {
        return $this->tweets->getTweet($id);
    }
}
