<?php

namespace App\Helpers;

/**
 *  Used for working with Twitter timeline items rendered server-side
 */
class Tweet
{
    /**
     * Format a date string from a given date
     *
     * @method                  formatDate
     * @access public
     *
     * @param DateTime          $date
     *
     * @return string
     */
    public static function formatDate(\DateTime $date)
    {
        return $date->setTimezone(new \DateTimeZone('America/New_York'))->format('d M Y');
    }

    /**
     * Return a valid Twitter profile URL
     *
     * @method                  profileUrl
     * @access public
     *
     * @param string            $screen_name
     * @param string            $baseLink
     *
     * @return string
     */
    public static function profileUrl(string $screen_name, string $baseLink = 'https://twitter.com')
    {
        return "$baseLink/$screen_name";
    }

    /**
     * Return a valid Tweet URL
     *
     * @method                  tweetUrl
     * @access public
     *
     * @param string            $profileUrl
     * @param string            $id
     *
     * @return string
     */
    public static function tweetUrl(string $profileUrl, string $id)
    {
        return "$profileUrl/status/$id";
    }

    /**
     * Render a given tweet body as HTML
     *
     * @method                  formatBody
     * @access public
     *
     * @param object            $tweet
     *
     * @return void
     */
    public static function formatBody(object $tweet)
    {
        // HTML formatting

        $tweet = collect($tweet);

        return $tweet->get('text'); // TEMP: see method description
    }
}

?>
