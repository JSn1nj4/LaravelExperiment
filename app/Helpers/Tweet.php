<?php

namespace App\Helpers;

/**
 *  Used for working with Twitter timeline items rendered server-side
 */
class Tweet
{
    /**
     * The base Twitter link for all web URLs
     *
     * @property string         $baseLink
     * @access public
     * @static
     */
    public static $baseLink = 'https://twitter.com';

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
    public static function profileUrl(string $screen_name)
    {
        return self::$baseLink . "/$screen_name";
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

        // Link hashtags, according to Twitter's guidelines
        foreach($tweet->entities->hashtags as $hashtag) {
            $tweet->text = str_replace(
                "#$hashtag->text",
                "<a target=\"_blank\" href=\"" . self::$baseLink . "/search?q=%23$hashtag->text\">#$hashtag->text</a>",
                $tweet->text
            );
        }

        // Link @mentions, according to Twitter's guidelines
        foreach($tweet->entities->user_mentions as $mention) {
            $tweet->text = str_replace(
                "@$mention->screen_name",
                "<a target=\"_blank\" href=\"" . self::$baseLink . "/$mention->screen_name\">@$mention->screen_name</a>",
                $tweet->text
            );
        }

        // Link URLs, according to Twitter's guidelines


        // Link symbols to Twitter searches


        // Render images


        // Insert HTML line breaks where necessary
        // Hint: regex (?:\r\n|\r|\n)
        return $tweet->text; // TEMP: see method description
    }
}

?>
