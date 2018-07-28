<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        // $fakeTweets = [
        //     [
        //         'user' => [
        //             'avatar' => 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
        //             'name' => 'Elliot Derhay',
        //             'handle' => '@JSn1nj4',
        //             'profile' => 'https://twitter.com/JSn1nj4/'
        //         ],
        //         'blurb' => 'Twitter has some nice keyboard shortcuts. \`Shift+?\`',
        //         'link' => 'https://twitter.com/JSn1nj4/status/989678620598853635'
        //     ]
        // ];
        //
        // return json_encode($fakeTweets);

        $post_url = 'https://api.twitter.com/oauth2/token';
        $twitter_str = base64_encode(urlencode(config('services.twitter.key')) . ':' . urlencode(config('services.twitter.secret')));

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

        $token = $result->access_token;

        $tweets_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?count=5&screen_name=jsn1nj4';

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $tweets_url);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token"
            // "Accept-Encoding: gzip"
        ]);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        $tweets = json_decode(curl_exec($ch2));

        return $tweets;        
    }
}
