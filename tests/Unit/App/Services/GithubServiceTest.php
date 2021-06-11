<?php

use App\Services\GithubService;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\mock;

beforeEach(function (): void {
	$this->api_base = 'https://api.github.com';
	$this->githubService = new GithubService;
});

it('creates an instance of App\Services\GithubService', function (): void {
	expect($this->githubService)->toBeInstanceOf(GithubService::class);
});

it('throws an exception if no token is found', function (): void {
	// token value currently set to `false` if no token is found in environment
});

it('throws an exception if no email recipient is defined', function (): void {
	// information should be found in config

	// recipients should be defined in $alertRecipients
});

it('constructs the correct api url', function (): void {
	$api_endpoint = 'users/jsn1nj4/events/public';

	expect($this->githubService->getUrl($api_endpoint))
		->toBeString()
		->toEqual("{$this->api_base}/{$api_endpoint}");
});

it('uses a correctly-formatted event api request', function (): void {
	// need to match the request it sends with the one defined here
});

it('rejects an incorrectly-formatted event api response', function(): void {
	// ...
});

it('handles api errors', function (): void {
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

	$this->assertTrue(true);
});

it('filters out unsupported types of github events', function (): void {
	// for this to work, need to spy on service object to see supported event types
});

it('emails a list of new event types that should be supported', function (): void {
	// requires email connection be configured

	// look into how to fake email being sent
});
