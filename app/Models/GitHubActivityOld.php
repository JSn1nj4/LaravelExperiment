<?php

namespace App\Models;

use App\Http\Clients\GitHubClient;
use Illuminate\Database\Eloquent\Model;

class GitHubActivityOld extends Model
{
    /**
     * Client for accessing GitHub API
     */
    private ?GitHubClient $github = null;

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

        $this->github = new GitHubClient;
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
     * @method                  filterIssuesEventPayload
     * @access public
     *
     * @param array             $payload
     *
     * @return array
     *
     * This helps reduce the size of the payload sent with issue event data for
     * use on the client.
     */
    public function filterIssuesEventPayload($payload)
    {
        return collect($payload)->transform(function($val, $key){
            if($key === 'issue') { // filter issue data
                return collect($val)->filter(function($val, $key) {
                    return in_array($key, [
                        'html_url',
                        'number',
                        'title',
                        'user',
                    ]);
                // Transform the 'issue' data inline
                })->transform(function($val, $key) {
                    return $key !== 'user' ? $val : collect($val)->filter(function($val, $key) {
                        // Return only desired 'user' data
                        return in_array($key, ['login', 'html_url', 'avatar_url']);
                    })->toArray();
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

        foreach($activity as $item) {
            $item = collect($item);
            $type = $item->get('type');

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
                    $item->put('payload', $this->filterIssuesEventPayload(
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
        return $this->filterActivityData(
            $this->github->getActivity('JSn1nj4', $count)->toArray()
        );
    }
}
