<?php

namespace App\Helpers;

/**
 *  Used for working with Twitter timeline items rendered server-side
 */
class Tweet
{
    /**
     * @param string                        $date
     *
     * @return string
     *
     * Format a date from a given date string
     */
    public static function formatDate(string $date)
    {
        // format date

        return $date;
    }

    /**
     * @param string                        $baseLink
     * @param string                        $screen_name
     *
     * @return string
     *
     * Return a valid Twitter profile URL
     */
    public static function profileUrl(string $baseLink, string $screen_name)
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
     * @param string                        $text
     *
     * @return void
     *
     * Render a given tweet body as HTML
     */
    public static function formatBody(string $text)
    {
        // HTML formatting

        return $text; // TEMP: see method description
    }
}

?>
