<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $fakeTweets = [
            [
                'user' => [
                    'avatar' => 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
                    'name' => 'Elliot Derhay',
                    'handle' => '@JSn1nj4',
                    'profile' => 'https://twitter.com/JSn1nj4/'
                ],
                'blurb' => 'Twitter has some nice keyboard shortcuts. \`Shift+?\`',
                'link' => 'https://twitter.com/JSn1nj4/status/989678620598853635'
            ]
        ];

        return json_encode($fakeTweets);
    }
}
