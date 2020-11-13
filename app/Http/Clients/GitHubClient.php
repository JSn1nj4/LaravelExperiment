<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class GitHubClient
{
    /**
     * The base GitHub API URL
     *
     * @property string         $api_url
     * @access private
     */
    private $api_url = 'https://api.github.com';

    /**
     * The token used for retrieving information from the GitHub API
     *
     * @property string         $token
     * @access private
     */
    private $token;

    public function __construct()
    {
        $this->token = config('services.github.token', false);
    }

    /**
     * Retrieve raw activity via GitHub's API
     *
     * @method                  getActivity
     * @access public
     *
     * @param string            $user
     * @param int               $count
     *
     * @return string
     *
     * @todo: check for error message
     */
    public function getActivity(string $user, int $count)
    {
        $url = "{$this->api_url}/users/{$user}/events/public?per_page={$count}";

        if(!$this->token) {
            dump('GitHub token not set!');
            abort(500);
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Accept: application/vnd.github.v3+json",
                "Authorization: token {$this->token}",
                "User-Agent: Elliot-Derhay-App"
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $activity = curl_exec($ch);

        /**
         * check for cURL errors here
         */

        curl_close($ch);

        return $activity;
    }
}
