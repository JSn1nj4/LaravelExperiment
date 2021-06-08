<?php

use App\Services\GithubService;

use function Pest\Laravel\mock;

beforeEach(function() {
	$this->config = mock('Illuminate\Config\Repository');
	// need to add some fake return values for config options that are looked for
});

test('creates an instance of App\Services\GithubService', function () {
	$githubService = new GithubService;

	expect($githubService)->toBeInstanceOf(GithubService::class);
});
