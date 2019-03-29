<?php

namespace App\Helpers;

/**
 * Used as a container for all helpers that will be shared
 */
class GlobalHelpers
{
    /**
     * Return a formatted string representing how long ago something happened
     *
     * Credit to Glavić on Stack Overflow for the original function this is
     * based on.
     * @link: https://stackoverflow.com/a/18602474
     *
     * @method          timeElapsedString
     * @access public
     * @static
     *
     * @param string    $dateString
     * @param string    $timeZoneString
     * @param bool      $full
     *
     * @return string
     */
    public static function timeElapsedString(string $dateString, string $timeZoneString = "America/New_York", $full = false)
    {
        $now = new \DateTime;
        $ago = new \DateTime($datetime, new \DateTimeZone($timeZoneString));
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * Format a date string from a given date
     *
     * @method          formatDate
     * @access public
     *
     * @param string    $date
     * @param string    $format
     * @param string    $timeZone
     *
     * @return string
     */
    public static function formatDate(string $date, string $format = "d M Y", string $timeZone = "America/New_York")
    {
        return (new \DateTime($date))->setTimezone(new \DateTimeZone($timeZone))->format($format);
    }
}

?>
