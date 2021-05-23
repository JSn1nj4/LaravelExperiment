<?php

namespace App\Services;

use App\Contracts\GitHostService;
use App\Mail\GithubEventEmail;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class GithubService implements GitHostService {
	/**
	 * The base GitHub API URL
	 */
	private string $api_url = 'https://api.github.com';

	/**
	 * The recipients to notify of new GitHub event types
	 */
	private array $alertRecipients = [];

	/**
	 * Currently-supported GitHub event types
	 *
	 * Reference: https://docs.github.com/en/developers/webhooks-and-events/github-event-types
	 */
	private array $eventTypes = [
		'CreateEvent',
		'DeleteEvent',
		'ForkEvent',
		'IssueCommentEvent',
		'IssuesEvent',
		'PublicEvent',
		'PullRequestEvent',
		'PushEvent',
		'WatchEvent',
	];

	/**
	 * The token used for interacting with the API
	 */
	private string $token;

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
			->filter(function ($event, $key) use ($newEventTypes) {
				$event = collect($event);

				if (!in_array($event->get('type'), $this->eventTypes)) {
					$newEventTypes->push($event->get('type'));
					return false;
				}

				return true;
			});

		if ($newEventTypes->count() > 0) {
			Mail::to($this->alertRecipients)->send(new GithubEventEmail(
				$newEventTypes->unique()->values()->toArray()
			));
		}

		return $events;
	}

	/**
	 * Retrieve raw events
	 *
	 * @todo: check for error message
	 */
	public function getEvents(string $user, int $count): Collection
	{
		if (!$this->token) {
			abort(500);
		}

		$response = Http::withToken($this->token)
			->withHeaders([
				"Accept: application/vnd.github.v3+json",
				"User-Agent: Elliot-Derhay-App",
			])->get($this->getUrl("users/{$user}/events/public"), [
				'per_page' => $count
			]);

		return $this->filterEventTypes($response);
	}

	/**
	 * Return GitHub API URL
	 */
	public function getUrl(string $url): string
	{
		return "{$this->api_url}/{$url}";
	}
}
