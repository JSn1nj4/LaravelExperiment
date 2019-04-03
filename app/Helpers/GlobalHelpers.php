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
        $ago = new \DateTime($dateString, new \DateTimeZone($timeZoneString));
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
        return $string ? 'about ' . implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * Format a date string from a given date
     *
     * @method          formatDate
     * @access public
     * @static
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

    /**
     * Convert camelCase and PascalCase to kebab-case
     *
     * Defaults to converting from PascalCase, though the initial
     * solution should also convert camelCase also given the regular
     * expression used.
     *
     * Short explanation: (?<!^) is a negative look-behind to ensure
     * that the beginning of the line is not matched.
     * - (?<! ): Assert that the Regex below does not match
     * - ^: Asserts position at start of a line
     *
     * Together, `(?<!^)[A-Z]` ensures that a capital letter at the
     * beginning of a given line of text will not be matched, since the
     * goal of this solution is to insert dash characters between each
     * "word" in the string.
     *
     * Original solution from the Stack Overflow answer linked here:
     * @link: https://stackoverflow.com/a/19533226
     *
     * @NOTE: The solution author and some commentors mention a handful
     * of cases in which the original solution could be a problem.
     * However, given that every GitHub event type is in PascalCase and
     * doesn't include the word name "GitHub" in them, the simple form
     * of the below regex is enough.
     *
     * @method          stringToKebabCase
     * @access public
     * @static
     *
     * @param string    $string
     * @param string    $fromCase
     *
     * @return string
     */
    public static function stringToKebabCase(string $string, string $fromCase = 'pascal')
    {
        switch (strtolower($fromCase)) {
            default:
                return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $string));
                break;
        }
    }
}

?>
