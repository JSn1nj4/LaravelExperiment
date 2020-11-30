<?php

namespace App\Http\Clients;

use App\Mail\GitHubEventEmail;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

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
     * The token used for retrieving information from the GitHub API
     *
     * @property string         $token
     * @access private
     */
    private $token;

    public function __construct()
    {
        $this->token = config('services.github.token', false);

        array_push($this->alertRecipients, [
            'name' => config('mail.to.name'),
            'email' => config('mail.to.address')
        ]);
    }

    public function filterEventTypes(Response $response): Collection
    {
        $newEventTypes = collect([]);

        $events = collect($response->json())
            ->filter(function($event, $key) use ($newEventTypes) {
                $event = collect($event);

                if(!in_array($event->get('type'), $this->eventTypes)) {
                    $newEventTypes->push($event->get('type'));
                    return false;
                }

                return true;
            });

        if($newEventTypes->count() > 0) {
            Mail::to($this->alertRecipients)->send(new GitHubEventEmail(
                $newEventTypes->unique()->values()->toArray()
            ));
        }

        return $events;
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
    public function getActivity(string $user, int $count): Collection
    {
        if(!$this->token) {
            dump('GitHub token not set!');
            abort(500);
        }

        $response = Http::withToken($this->token)
            ->withHeaders([
                "Accept: application/vnd.github.v3+json",
                "User-Agent: Elliot-Derhay-App",
            ])->get("{$this->api_url}/users/{$user}/events/public?per_page={$count}");

        return $this->filterEventTypes($response);
    }
}
