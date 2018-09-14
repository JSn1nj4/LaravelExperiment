<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\GitHubEventEmail;

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
     * The email address to send notifications to
     *
     * @property        $email
     * @var string
     */
    private $alertRecipients = [];

    /**
     * The list of event types currently supported
     *
     * @property        $eventTypes
     * @var array
     *
     * I will make sure to sort these in the order they're listed on GitHub.
     * Reference: https://developer.github.com/v3/activity/events/types/
     */
    private $eventTypes = [
        'CreateEvent',
        'DeleteEvent',
        'IssueCommentEvent',
        'IssuesEvent',
        'PushEvent',
        'WatchEvent'
    ];

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

        array_push($this->alertRecipients, [
            'name' => config('mail.to.name'),
            'email' => config('mail.to.address')
        ]);
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
     * Filter comment data from issue comment event payloads
     *
     * @method          filterIssueComment
     * @param array     $comment
     * @return array
     *
     * This helps reduce the size of the payload sent with issue comment event
     * data to be used on the client.
     */
    public function filterIssueComment($comment)
    {
        $comment = collect($comment)->filter(function($val, $key) {
            return in_array($key, [
                'html_url',
                'user',
                'body'
            ]);
        });
        $comment->put('user',
            collect($comment->get('user'))->filter(function($val, $key) {
                return in_array($key, [
                    'login',
                    'avatar_url',
                    'html_url'
                ]);
            })
        );

        return $comment->toArray();
    }

    /**
     * Filter payload from issue event
     *
     * @method          filterIssueEventPayload
     * @param array     $payload
     * @return array
     *
     * This helps reduce the size of the payload sent with issue event data for
     * use on the client.
     */
    public function filterIssueEventPayload($payload)
    {
        $payload = collect($payload);

        $payload->put('issue',
            collect($payload->get('issue'))->filter(function($val, $key) {
                return in_array($key, [
                    'html_url',
                    'number',
                    'title'
                ]);
            })->toArray()
        );

        if($payload->has('comment')) {
            $payload->put('comment', $this->filterIssueComment(
                $payload->get('comment')
            ));
        }

        return $payload->toArray();
    }

    /**
     * Default method for filtering event payloads
     *
     * @method          filterEventPayload
     * @param array     $payload
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
     * @method          filterActivityData
     * @param array     $activity
     * @return array
     *
     * Strip down data returned by GitHub API. Most of the data returned by the
     * GitHub API isn't necessary in this case.
     */
    public function filterActivityData($activity)
    {
        $formattedActivity = collect([]);
        $newEventTypes = [];

        foreach($activity as $item) {
            $item = collect($item);
            $type = $item->get('type');

            // Skip $item if type is currently unsupported
            if(!in_array($type, $this->eventTypes)) {
                array_push($newEventTypes, $type);
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
                default:
                    $item->put('payload', $this->filterEventPayload(
                        $item->get('payload')
                    ));
            }

            $formattedActivity->push($item->toArray());
        }

        if(count($newEventTypes) >= 1) {
            \Mail::to($this->alertRecipients)->send(new GitHubEventEmail($newEventTypes));
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
     * This method returns a list of activity that has been trimmed first.
     */
    public function getActivity(int $count = 7)
    {
        return $this->filterActivityData(json_decode(
            $this->getRawActivity("$this->api_url/users/JSn1nj4/events/public?per_page=$count")
        ));
    }
}
