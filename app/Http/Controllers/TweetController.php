<?php

namespace App\Http\Controllers;

use App\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = new Tweet;
        return $tweets->getTweets();
    }
}
