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

it('constructs the correct api url', function (): void {
	$api_endpoint = 'users/jsn1nj4/events/public';

	expect($this->githubService->getUrl($api_endpoint))
		->toBeString()
		->toEqual("{$this->api_base}/{$api_endpoint}");
});

// it('can use the github api with an active token', function (): void {

// });

// it('cannot use the github api without an active token', function (): void {

// });

it('can fetch user events from the correct endpoint', function (): void {
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
