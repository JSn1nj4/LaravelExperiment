<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitHubActivity extends Model
{
    /**
     * The base GitHub API URL
     *
     * @var string
     */
    private $api_url = 'https://api.github.com';

    /**
     * The token used for retrieving information from the GitHub API
     *
     * @var string
     */
    private $token;

    /**
     * Create a new instance of the GitHubActivity model
     *
     * @param array     $attributes
     * @return void
     *
     * This is necessary to initialize some properties that can't otherwise be
     * initialized. Initializing properties outside of a constrctor requires
     * that the initial values be static.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->token = config('service.github.token', false);
    }

    /**
     * Retrieve raw activity via GitHub's API
     *
     * @param string    $curl_url
     * @return string
     *
     * @todo: check for error message
     */
    public function getRawActivity(string $curl_url)
    {
        if(!this->token) {
            dump('GitHub token not set!');
            abort(500);
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $curl_url,
            CURLOPT_HTTPHEADER => [
                "Accept: application/vnd.github.v3+json",
                "Authorization: token $this->token"
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
