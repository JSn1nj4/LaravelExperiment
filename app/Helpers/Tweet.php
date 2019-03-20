<?php

namespace App\Helpers;

/**
 *  Used for working with Twitter timeline items rendered server-side
 */
class Tweet
{
    /**
     * @param DateTime                      $date
     *
     * @return string
     *
     * Format a date string from a given date
     */
    public static function formatDate(DateTime $date)
    {
        return $date->setTimezone(new DateTimeZone('America/New_York'))->format('D MMM YYYY');
    }

    /**
     * @param string                        $screen_name
     * @param string                        $baseLink
     *
     * @return string
     *
     * Return a valid Twitter profile URL
     */
    public static function profileUrl(string $screen_name, string $baseLink = 'https://twitter.com')
    {
        return "$baseLink/$screen_name";
    }

    /**
     * @param string                        $profileUrl
     * @param string                        $id
     *
     * @return string
     *
     * Return a valid Tweet URL
     */
    public static function tweetUrl(string $profileUrl, string $id)
    {
        return "$profileUrl/status/$id";
    }

    /**
     * @param array                         $tweet
     *
     * @return void
     *
     * Render a given tweet body as HTML
     */
    public static function formatBody(array $tweet)
    {
        // HTML formatting

        $tweet = collect($tweet);

        return $tweet->get('text'); // TEMP: see method description
    }
}

?>
