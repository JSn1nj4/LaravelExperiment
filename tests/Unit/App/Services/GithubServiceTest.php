<?php

use App\Services\GithubService;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

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

it('fetches user events with a correctly-formatted event api request', function (): void {
	$user = $this->faker->userName();
	$eventCount = 1;

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
		Http::response(json_encode($response->body), $response->status, $response->headers)
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

it('rejects incorrectly-formatted event api responses', function(): void {
	$githubService = new GithubService;

	// ...
});

it('handles api errors', function (): void {
	$githubService = new GithubService;

	// determine what happens currently when an error is received.
	// sending a request with a bad token should be enough
});

it('processes response data received from the github events api', function (): void {
	$response = (object) [
		'body' => [
			1, 2, 3,
		],
		'status' => 200,
		'headers' => [
			'test1', 'test2', 'test3',
		],
	];

	Http::fake([
		"{$this->api_base}/users/jsn1nj4/events/public" => Http::response($response->body, $response->status, $response->headers),
	]);

	$githubService = new GithubService;
});

it('filters out unsupported types of github events', function (): void {
	$githubService = new GithubService;

	// for this to work, need to spy on service object to see supported event types
});

it('emails a list of new event types that should be supported', function (): void {
	$githubService = new GithubService;

	// requires email connection be configured

	// look into how to fake email being sent
});
