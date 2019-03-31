<?php

namespace App\Helpers;

/**
 * Used to help with rendering GitHub activity items server-side
 */
class GitHubActivity extends GlobalHelpers
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
     * A temporary URL used to display my avatar for my own activity
     *
     * @TODO: Check for presence of user avatar directly in GitHub
     * activities and use instead of this one.
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
     * Return a URL that takes the user to a list of commits on a branch
     *
     * @method                  branchCommitsUrl
     * @access public
     * @static
     *
     * @param string            $repoUrl
     * @param string            $branchName
     *
     * @return string
     */
    public static function branchCommitsUrl(string $repoUrl, string $branchName)
    {
      return "$repoUrl/commits/$branchName";
    }

    /**
     * Return a list of commits that are meant for display
     *
     * @method                  displayCommits
     * @access public
     * @static
     *
     * @param array             commits
     * @param int               displayCount
     *
     * @return array
     */
    public static function displayCommits(array $commits, int $displayCount = 4)
    {
      return count($commits) > $displayCount ? array_slice($commits, 0, $displayCount) : $commits;
    }

    /**
     * Count the commits beyond the display count
     *
     * @method                  countExtraCommits
     * @access public
     * @static
     *
     * @param array             $commits
     * @param int               $displayCount
     *
     * @return int
     */
    public static function countExtraCommits(array $commits, int $displayCount = 4)
    {
      return count($commits) > $displayCount ? count($commits) - 4 : 0;
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
     * Format an issue comment according to a character limit
     *
     * @method                  formatIssueComment
     * @access public
     * @static
     *
     * @param string            $comment
     * @param int               $limit
     *
     * @return string
     */
    public static function formatIssueComment(string $comment, int $limit = 208)
    {
      return (count($comment) > $limit) ? substr(substr($comment, 0, $limit), 0, strrpos($comment, ' ')) . '...' : $comment;
    }

    /**
     * Return the subject line of a commit message
     *
     * @method                  commitSubject
     * @access public
     * @static
     *
     * @param string            $msg
     *
     * @return string
     */
    public static function commitSubject(string $msg)
    {
      $msgEnd = strpos($msg, "\n");
      return (!empty($msgEnd) && $msgEnd >= 0) ?
        substr($msg, 0, $msgEnd) :
        $msg;
    }

    /**
     * Return a shortened commit hash
     *
     * @method                  shortHash
     * @access public
     * @static
     *
     * @param string            $hash
     *
     * @return string
     */
    public static function shortHash(string $hash)
    {
      return substr($hash, 0, 6);
    }

    /**
     * Return the web URL for a commit
     *
     * @method                  commitUrl
     * @access public
     * @static
     *
     * @param string            $repoUrl
     * @param string            $hash
     *
     * @return string
     */
    public static function commitUrl(string $repoUrl, string $hash)
    {
      return "$repoUrl/commit/$hash";
    }

}

?>
