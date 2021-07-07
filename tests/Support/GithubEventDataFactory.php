<?php

namespace Tests\Support;

use Illuminate\Support\Arr;

class GithubEventDataFactory extends BaseFactory
{
	private array $eventTypes = [
		'CommitCommentEvent',
		'CreateEvent',
		'DeleteEvent',
		'ForkEvent',
		'GollumEvent',
		'IssueCommentEvent',
		'IssuesEvent',
		'MemberEvent',
		'PublicEvent',
		'PullRequestEvent',
		'PullRequestReviewEvent',
		'PullRequestReviewCommentEvent',
		'PushEvent',
		'ReleaseEvent',
		'SponsorshipEvent',
		'WatchEvent',
	];

	private \Faker\Generator $faker;

	public function __construct()
	{
		$this->faker = \Faker\Factory::create();
	}

	private function definition(): array
	{
		$user = $this->faker->userName();
		$type = Arr::random($this->eventTypes);

		$payload = array_merge([
			'ref' => "refs/heads/{$this->faker->slug()}",
		], match ($type) {
			'ForkEvent' => ['forkee' => [
				'full_name' => "{$user}/{$this->faker->slug}",
			]],
			'IssueCommentEvent', 'IssuesEvent' => ['issue' => [
				'number' => $this->faker->randomNumber(5),
			]],
			'PullRequestEvent' => ['pull_request' => [
				'number' => $this->faker->randomNumber(5),
			]],
			default => [],
		});

		return [
			'id' => $this->faker->numerify('###########'),
			'actor' => [
				'id' => $this->faker->randomNumber(7, true),
				'login' => $user,
				'display_login' => $user,
				'avatar_url' => $this->faker->imageUrl(50, 50, 'cats'),
			],
			'type' => $type,
			'created_at' => now()->toDateTimeString(),
			'repo' => [
				'name' => "{$user}/{$this->faker->slug()}",
			],
			'payload' => $payload,
		];
	}

	public function make(): array
	{
		$data = [];

		for ($i = 0; $i < $this->count; $i++) {
			array_push($data, $this->definition());
		}

		return $data;
	}
}
