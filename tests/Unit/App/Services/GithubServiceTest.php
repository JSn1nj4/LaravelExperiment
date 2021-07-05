<?php

use App\Mail\GithubEventEmail;
use App\Services\GithubService;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\Support\PrivateMemberAccessor;

beforeEach(function (): void {
	$this->api_base = 'https://api.github.com';

	$this->faker = \Faker\Factory::create();
});

it('creates an instance of App\Services\GithubService', function (): void {
	$githubService = new GithubService;

	expect($githubService)->toBeInstanceOf(GithubService::class);
});

it('throws an exception if no token is found', function (): void {
	Config::offsetUnset('services.github.token');

	$githubService = new GithubService;
})->throws(Exception::class, "Config option 'services.github.token' not set.");

it('throws an exception if email recipient name is not set', function (): void {
	Config::offsetUnset('mail.to.name');

	$githubService = new GithubService;
})->throws(Exception::class, "Config option 'mail.to.name' not set.");

it('throws an exception if email recipient address is not set', function (): void {
	Config::offsetUnset('mail.to.address');

	$githubService = new GithubService;
})->throws(Exception::class, "Config option 'mail.to.address' not set.");

it('constructs the correct api url', function (): void {
	$githubService = new GithubService;

	$api_endpoint = "users/{$this->faker->userName()}/events/public";

	expect($githubService->getUrl($api_endpoint))
		->toBeString()
		->toEqual("{$this->api_base}/{$api_endpoint}");
});

it('constructs a correctly-formatted user event api request', function (): void {
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	$response = (object) [
		'body' => [
			[
				'id' => $this->faker->numerify('###########'),
				'actor' => [
					'id' => $this->faker->randomNumber(7, true),
					'login' => $user,
					'display_login' => $user,
					'avatar_url' => $this->faker->imageUrl(50, 50, 'cats'),
				],
				'type' => 'PushEvent',
				'created_at' => Carbon::now()->toDateTimeString(),
				'repo' => [
					'name' => "{$user}/repo_name",
				],
				'payload' => [
					'ref' => "refs/heads/{$this->faker->slug()}",
				],
			]
		],
		'status' => 200,
		'headers' => [],
	];

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode($response->body), $response->status, $response->headers),
	]);

	(new GithubService)->getEvents($user, $eventCount);

	Http::assertSent(function (Request $request) use ($user, $eventCount) {
		$token = config('services.github.token');

		$events_url = "{$this->api_base}/users/{$user}/events/public?per_page={$eventCount}";

		return $request->url() === $events_url &&
			$request->hasHeaders([
				'Authorization' => "Bearer {$token}",
				'Accept' => 'application/vnd.github.v3+json',
				'User-Agent' => 'Elliot-Derhay-App',
			]);
	});
});

it('throws an exception if requested event count is < 1', function (): void {
	(new GithubService)->getEvents($this->faker->userName(), 0 - $this->faker->numberBetween());
})->throws(Exception::class, "'\$count' value must be 1 or higher.");

it('throws an exception if requested event count is > 100', function (): void {
	(new GithubService)->getEvents($this->faker->userName(), $this->faker->numberBetween(101));
})->throws(Exception::class, "'\$count' value must be 100 or less.");

it('processes response data received from the github events api', function (): void {
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	$response = (object) [
		'body' => [
			[
				'actor' => [
					'id' => $this->faker->randomNumber(6, true),
					'login' => $user,
					'display_login' => $user,
					'avatar_url' => $this->faker->imageUrl(50, 50, 'cats'),
				],
				'type' => 'PushEvent',
				'created_at' => Carbon::now()->toDateTimeString(),
				'repo' => [
					'name' => "{$user}/repo_name",
				],
				'payload' => [
					'ref' => 'refs/heads/fake_branch_name'
				],
			]
		],
		'status' => 200,
		'headers' => [],
	];

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode($response->body), $response->status, $response->headers),
	]);

	Mail::fake();

	$events = (new GithubService)->getEvents($user, $eventCount);

	expect($events)
		->toBeInstanceOf(Collection::class);

	expect(count($events))
		->toBeLessThanOrEqual($eventCount);
});

it('filters out unsupported types of github events', function (): void {
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	$response = (object) [
		'body' => [
			['type' => 'CommitCommentEvent'],
			['type' => 'CommitCommentEvent'],
			['type' => 'CommitCommentEvent'],
			['type' => 'CommitCommentEvent'],
			['type' => 'CommitCommentEvent'],
			['type' => 'CommitCommentEvent'],
			['type' => 'CreateEvent'],
			['type' => 'CreateEvent'],
			['type' => 'CreateEvent'],
			['type' => 'CreateEvent'],
			['type' => 'CreateEvent'],
			['type' => 'CreateEvent'],
			['type' => 'DeleteEvent'],
			['type' => 'DeleteEvent'],
			['type' => 'DeleteEvent'],
			['type' => 'DeleteEvent'],
			['type' => 'DeleteEvent'],
			['type' => 'DeleteEvent'],
			['type' => 'ForkEvent'],
			['type' => 'ForkEvent'],
			['type' => 'ForkEvent'],
			['type' => 'ForkEvent'],
			['type' => 'ForkEvent'],
			['type' => 'ForkEvent'],
			['type' => 'GollumEvent'],
			['type' => 'GollumEvent'],
			['type' => 'GollumEvent'],
			['type' => 'GollumEvent'],
			['type' => 'GollumEvent'],
			['type' => 'GollumEvent'],
			['type' => 'IssueCommentEvent'],
			['type' => 'IssueCommentEvent'],
			['type' => 'IssueCommentEvent'],
			['type' => 'IssueCommentEvent'],
			['type' => 'IssueCommentEvent'],
			['type' => 'IssueCommentEvent'],
			['type' => 'IssuesEvent'],
			['type' => 'IssuesEvent'],
			['type' => 'IssuesEvent'],
			['type' => 'IssuesEvent'],
			['type' => 'IssuesEvent'],
			['type' => 'IssuesEvent'],
			['type' => 'MemberEvent'],
			['type' => 'MemberEvent'],
			['type' => 'MemberEvent'],
			['type' => 'MemberEvent'],
			['type' => 'MemberEvent'],
			['type' => 'MemberEvent'],
			['type' => 'PublicEvent'],
			['type' => 'PublicEvent'],
			['type' => 'PublicEvent'],
			['type' => 'PublicEvent'],
			['type' => 'PublicEvent'],
			['type' => 'PublicEvent'],
			['type' => 'PullRequestEvent'],
			['type' => 'PullRequestEvent'],
			['type' => 'PullRequestEvent'],
			['type' => 'PullRequestEvent'],
			['type' => 'PullRequestEvent'],
			['type' => 'PullRequestEvent'],
			['type' => 'PullRequestReviewEvent'],
			['type' => 'PullRequestReviewEvent'],
			['type' => 'PullRequestReviewEvent'],
			['type' => 'PullRequestReviewEvent'],
			['type' => 'PullRequestReviewEvent'],
			['type' => 'PullRequestReviewEvent'],
			['type' => 'PullRequestReviewCommentEvent'],
			['type' => 'PullRequestReviewCommentEvent'],
			['type' => 'PullRequestReviewCommentEvent'],
			['type' => 'PullRequestReviewCommentEvent'],
			['type' => 'PullRequestReviewCommentEvent'],
			['type' => 'PullRequestReviewCommentEvent'],
			['type' => 'PushEvent'],
			['type' => 'PushEvent'],
			['type' => 'PushEvent'],
			['type' => 'PushEvent'],
			['type' => 'PushEvent'],
			['type' => 'PushEvent'],
			['type' => 'ReleaseEvent'],
			['type' => 'ReleaseEvent'],
			['type' => 'ReleaseEvent'],
			['type' => 'ReleaseEvent'],
			['type' => 'ReleaseEvent'],
			['type' => 'ReleaseEvent'],
			['type' => 'SponsorshipEvent'],
			['type' => 'SponsorshipEvent'],
			['type' => 'SponsorshipEvent'],
			['type' => 'SponsorshipEvent'],
			['type' => 'SponsorshipEvent'],
			['type' => 'SponsorshipEvent'],
			['type' => 'WatchEvent'],
			['type' => 'WatchEvent'],
			['type' => 'WatchEvent'],
			['type' => 'WatchEvent'],
			['type' => 'WatchEvent'],
			['type' => 'WatchEvent'],
		],
		'status' => 200,
		'headers' => [],
	];

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode($response->body), $response->status, $response->headers),
	]);

	Mail::fake();

	$githubService = new GithubService;

	// Make supportedEventTypes list accessible
	$supportedEventTypes = PrivateMemberAccessor::make()
		->from($githubService)
		->getProperty('supportedEventTypes');

	// Build and sum lists of supported and unsupported events
	[$supportedEvents, $unsupportedEvents] = collect($response->body)
		->partition(function ($event) use ($supportedEventTypes) {
			return in_array($event['type'], $supportedEventTypes);
		});

	// "fetch" events
	$events = $githubService->getEvents($user, $eventCount);

	// List unsupported event types that were missed in filtering
	$eventTypesMissed = $events->whereNotInStrict('type', $supportedEventTypes)
		->unique()
		->values();

	// Confirm expectations
	expect($events->toArray())
		->toHaveCount($supportedEvents->count())
		->and($events->count())
		->toBeLessThanOrEqual($eventCount)
		->and($eventTypesMissed)
		->toHaveCount(0);
});

it('emails a list of new event types that should be supported', function (): void {
	$githubService = new GithubService;

	// requires email connection be configured

	// look into how to fake email being sent
});
