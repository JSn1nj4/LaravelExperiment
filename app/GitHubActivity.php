<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\GitHubEventEmail;

class GitHubActivity extends Model
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

    /**
     * The email address to send notifications to
     *
     * @property array          $email
     * @access private
     */
    private $alertRecipients = [];

    /**
     * The list of event types currently supported
     *
     * @property array          $eventTypes
     * @access private
     *
     * I will make sure to sort these in the order they're listed on GitHub.
     * Reference: https://developer.github.com/v3/activity/events/types/
     */
    private $eventTypes = [
        'CreateEvent',
        'DeleteEvent',
        'ForkEvent',
        'IssueCommentEvent',
        'IssuesEvent',
        'PublicEvent',
        'PullRequestEvent',
        'PushEvent',
        'WatchEvent'
    ];

    /**
     * Create a new instance of the GitHubActivity model
     *
     * @method                  __construct
     * @access public
     *
     * @param array             $attributes
     *
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

        array_push($this->alertRecipients, [
            'name' => config('mail.to.name'),
            'email' => config('mail.to.address')
        ]);
    }

    /**
     * Retrieve raw activity via GitHub's API
     *
     * @method                  getRawActivity
     * @access public
     *
     * @param string            $curl_url
     *
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
     * Filter comment data from issue comment event payloads
     *
     * @method                  filterIssueComment
     * @access public
     *
     * @param array             $comment
     *
     * @return array
     *
     * This helps reduce the size of the payload sent with issue comment event
     * data to be used on the client.
     */
    public function filterIssueComment($comment)
    {
        return collect($comment)->filter(function($val, $key) {
            return in_array($key, [
                'html_url',
                'user',
                'body'
            ]);
        })->transform(function($val, $key) {
            return $key !== 'user' ? $val : collect($val)->filter(function($val, $key) {
                return in_array($key, [
                    'login',
                    'avatar_url',
                    'html_url'
                ]);
            })->toArray();
        })->toArray();
    }

    /**
     * Filter payload from issue event
     *
     * @method                  filterIssueEventPayload
     * @access public
     *
     * @param array             $payload
     *
     * @return array
     *
     * This helps reduce the size of the payload sent with issue event data for
     * use on the client.
     */
    public function filterIssueEventPayload($payload)
    {
        return collect($payload)->transform(function($val, $key){
            if($key === 'issue') { // filter issue data
                return collect($val)->filter(function($val, $key) {
                    return in_array($key, [
                        'html_url',
                        'number',
                        'title'
                    ]);
                })->toArray();
            }

            if ($key === 'comment') { // filter comment data if it exists
                return $this->filterIssueComment($val);
            }

             // return all other values outright
            return $val;
        });
    }

    /**
     * Filter payload from fork event
     *
     * @method                  filterForkEventPayload
     * @access private
     *
     * @param array             $payload
     *
     * @return array
     */
    private function filterForkEventPayload($payload)
    {
        return collect($payload)->transform(function($val, $key) {
            return $key !== 'forkee' ? $val : collect($val)->filter(function($val, $key) {
                return in_array($key, [
                    'full_name',
                    'html_url'
                ]);
            })->toArray();
        })->toArray();
    }

    /**
     * Filter payload from public event
     *
     * @method                  filterPublicEventPayload
     * @access private
     *
     * @param array             $payload
     *
     * @return array
     */
    private function filterPublicEventPayload($payload)
    {
        $payload = collect($payload);

        // @TODO: Build out when first non-empty payload comes through

        return $payload->toArray();
    }

    /**
     * Filter payload from pull request event
     *
     * @method                  filterPullRequestEventPayload
     * @access private
     *
     * @param array             $payload
     *
     * @return array
     */
    private function filterPullRequestEventPayload($payload)
    {
        return collect($payload)->filter(function($val, $key) {
            // Return only desired payload data
            return in_array($key, [
                'action',
                'pull_request',
                'merged'
            ]);
        // Transform the 'pull_request' data inline
        })->transform(function($val, $key) {
            return $key !== 'pull_request' ? $val : collect($val)->filter(function($val, $key) {
                // Return only desired 'pull_request' data
                return in_array($key, [
                    'html_url',
                    'number',
                    'title',
                    'body',
                    'user'
                ]);
            // Transform the 'head' data inline
            })->transform(function($val, $key) {
                return $key !== 'user' ? $val : collect($val)->filter(function($val, $key) {
                    // Return only desired 'user' data
                    return in_array($key, ['login', 'html_url', 'avatar_url']);
                })->toArray();
            })->toArray();
        })->toArray();
    }

    /**
     * Default method for filtering event payloads
     *
     * @method                  filterEventPayload
     * @access public
     *
     * @param array             $payload
     *
     * @return array
     *
     * This is the default method used for filtering an event payload.
     * It will be used if no special method is needed for filtering a
     * payload of a given event type, such as for events that don't have
     * multiple levels of payload data to sift through. If looking at
     * only the first level of an event's payload is enough, then this
     * is the method that should be used.
     */
    public function filterEventPayload($payload)
    {
        return collect($payload)->filter(function($val, $key) {
            return !in_array($key, [
                'push_id',
                'size',
                'distinct_size',
                'head',
                'before',
                'description',
                'pusher_type'
            ]);
        })->toArray();
    }

    /**
     * Filter activity data
     *
     * @method                  filterActivityData
     * @access public
     *
     * @param array             $activity
     *
     * @return array
     *
     * Strip down data returned by GitHub API. Most of the data returned by the
     * GitHub API isn't necessary in this case.
     */
    public function filterActivityData($activity)
    {
        $formattedActivity = collect([]);
        $newEventTypes = collect([]);

        foreach($activity as $item) {
            $item = collect($item);
            $type = $item->get('type');

            // Skip $item if type is currently unsupported
            if(!in_array($type, $this->eventTypes)) {
                $newEventTypes->push($type);
                continue;
            }

            $item->forget('id');
            $item->forget('public');

            // Remove unnecessary items from 'actor' data
            $item->put('actor', collect($item->get('actor'))->filter(function($val, $key) {
                return !in_array($key, [
                    'id',
                    'gravatar_id'
                ]);
            })->toArray());

            $item->put('repo', collect($item->get('repo'))->forget('id')->toArray());

            // Remove unnecessary items from 'payload' data
            switch($type) {
                case preg_match('/Issue(s|Comment)?Event/', $type) === 1:
                    $item->put('payload', $this->filterIssueEventPayload(
                        $item->get('payload')
                    ));
                    break;

                case 'ForkEvent':
                    $item->put('payload', $this->filterForkEventPayload(
                        $item->get('payload')
                    ));
                    break;

                case 'PublicEvent':
                    $item->put('payload', $this->filterPublicEventPayload(
                        $item->get('payload')
                    ));

                case 'PullRequestEvent':
                    $item->put('payload', $this->filterPullRequestEventPayload(
                        $item->get('payload')
                    ));

                default:
                    $item->put('payload', $this->filterEventPayload(
                        $item->get('payload')
                    ));
            }

            $formattedActivity->push($item->toArray());
        }

        if($newEventTypes->count() >= 1) {
            \Mail::to($this->alertRecipients)->send(new GitHubEventEmail(
                $newEventTypes->unique()->values()->toArray()
            ));
        }

        return $formattedActivity;
    }

    /**
     * Retrieve GitHub activity
     *
     * @method                  getActivity
     * @access public
     *
     * @param int               $count
     *
     * @return string
     *
     * This method returns a list of activity that has been trimmed first.
     */
    public function getActivity(int $count = 7)
    {
        return $this->filterActivityData(json_decode(
            $this->getRawActivity("$this->api_url/users/JSn1nj4/events/public?per_page=$count")
        ));
    }
}
