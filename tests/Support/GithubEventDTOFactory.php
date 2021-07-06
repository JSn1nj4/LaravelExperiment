<?php

namespace Tests\Support;

use App\DataTransferObjects\GithubEventDTO;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class GithubEventDTOFactory extends BaseFactory
{
	private string $class = GithubEventDTO::class;

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

		return [
			'id' => $this->faker->numerify('###########'),
			'actor' => [
				'id' => $this->faker->randomNumber(7, true),
				'login' => $user,
				'display_login' => $user,
				'avatar_url' => $this->faker->imageUrl(50, 50, 'cats'),
			],
			'type' => Arr::random($this->eventTypes),
			'created_at' => now()->toDateTimeString(),
			'repo' => [
				'name' => "{$user}/{$this->faker->slug()}",
			],
			'payload' => [
				'ref' => "refs/heads/{$this->faker->slug()}",
			],
		];
	}
}
