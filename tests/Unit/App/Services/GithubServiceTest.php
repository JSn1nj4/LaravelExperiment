<?php

use App\Services\GithubService;

test('creates an instance of App\Services\GithubService', function () {
	$githubService = new GithubService;

	expect($githubService)->toBeInstanceOf(GithubService::class);
});
