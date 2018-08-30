<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitHubActivity extends Model
{
    /**
     * The base GitHub API URL
     *
     * @property        $api_url
     * @var string
     */
    private $api_url = 'https://api.github.com';

    /**
     * The token used for retrieving information from the GitHub API
     *
     * @property        $token
     * @var string
     */
    private $token;

    /**
     * Create a new instance of the GitHubActivity model
     *
     * @method          __construct
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

        $this->token = config('services.github.token', false);
    }

    /**
     * Retrieve raw activity via GitHub's API
     *
     * @method          getRawActivity
     * @param string    $curl_url
     * @return string
     *
     * @todo: check for error message
     */
    public function getRawActivity(string $curl_url)
    {
        if(!$this->token) {
            dump('GitHub token not set!');
            abort(500);
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $curl_url,
            CURLOPT_HTTPHEADER => [
                "Accept: application/vnd.github.v3+json",
                "Authorization: token $this->token",
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

    /**
     * Format activity data
     *
     * @method          formatActivityData
     * @param string    $activity
     * @return array
     *
     * Strip down tweet data returned by Twitter API. Most of the data returned
     * by the Twitter API isn't necessary in this case.
     */
    public function formatActivityData($activity)
    {
        $formattedActivity = collect([]);

        foreach(json_decode($formattedActivity, true) as $item) {
            $item = collect($item);

            // Remove unnecessary items from 'actor' data
            $actor = collect($item->get('actor'))->reject(function($val, $key) {
                // filter
            });
            $item->put('actor', $actor->toArray());

            // Remove unnecessary items from 'repo' data
            $repo = collect($item->get('repo'))->reject(function($val, $key) {
                // filter
            });
            $item->put('repo', $repo->toArray());

            // Remove unnecessary items from 'payload' data
            $payload = collect($item->get('payload'))->reject(function($val, $key) {
                // filter
            });
            $commits = $payload->get(commits);
            for($i = 0; $i < count($commits); $i++) {
                $commits[$i] = collect($commits[$i])->reject(function($val, $key) {
                    // filter
                })->toArray();    
            }
            $payload->put('commits', $commits);
            $item->put('payload', $payload->toArray());
        }

        return $formattedActivity;
    }

    /**
     * Retrieve GitHub activity
     *
     * @method          getActivity
     * @param int       $count
     * @return string
     *
     * This method returns a list of tweets that their initial API data trimmed
     * down first.
     */
    public function getActivity(int $count = 5)
    {
        return $this->formatActivityData(json_decode(
            $this->getRawActivity("$this->api_url/users/JSn1nj4/events/public?per_page=$count")
        ));
    }
}
