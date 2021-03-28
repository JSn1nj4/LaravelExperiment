<?php

namespace App\Helpers;

/**
 * Used to help with rendering GitHub events server-side
 */
class GithubEventHelpers extends GlobalHelpers
{
    /**
     * The base link to use for all GitHub web links
     *
     * @property string         $baseLink
     * @access public
     * @static
     */
    public static $baseLink = 'https://github.com';

    /**
     * A temporary URL used to display my avatar for my own events
     *
     * @TODO: Check for presence of user avatar directly in GitHub
     * event and use instead of this one.
     *
     * @property string         $tmpAvatarUrl
     * @access public
     * @static
     */
    public static $tmpAvatarUrl = 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg';

    /**
     * Build the web URL to the user's GitHub profile
     *
     * @method                  profileUrl
     * @access public
     * @static
     *
     * @param string            $login
     *
     * @return string
     */
    public static function profileUrl(string $login)
    {
        return self::$baseLink . "/$login";
    }

    /**
     * Build repo URL
     *
     * @method                  repoUrl
     * @access public
     * @static
     *
     * @param string            $repoName
     *
     * @return string
     */
    public static function repoUrl(string $repoName)
    {
        return self::$baseLink . "/$repoName";
    }

    /**
     * Return just the branch name without the ref prefix
     *
     * @method                  branchName
     * @access public
     * @static
     *
     * @param string            $ref
     *
     * @return string
     */
    public static function branchName(string $ref)
    {
        return str_replace('refs/heads/', '', $ref);
    }

    /**
     * Build repo's URL for the branch
     *
     * @method                  branchUrl
     * @access public
     * @static
     *
     * @param string            $repoUrl
     * @param string            $branchName
     *
     * @return string
     */
    public static function branchUrl(string $repoUrl, string $branchName)
    {
        return "$repoUrl/tree/$branchName";
    }

    /**
     * Build a formatted issue number string
     *
     * @method                  issueNumberString
     * @access public
     * @static
     *
     * @param string            $issueNumber
     *
     * @return string
     */
    public static function issueNumberString(string $issueNumber)
    {
      return "Issue #$issueNumber";
    }

    /**
     * Format a string referencing a pull request
     *
     * @method                  pullRequestNumberString
     * @access public
     * @static
     *
     * @param string            $pullRequestNumber
     *
     * @return string
     */
    public static function pullRequestNumberString(string $pullRequestNumber) {
        return "Pull Request #$pullRequestNumber";
    }

}

?>
