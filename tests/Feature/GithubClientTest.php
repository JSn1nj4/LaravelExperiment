<?php

namespace Tests\Feature;

use App\Http\Clients\GithubClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GithubClientTest extends TestCase
{
    public function test_we_can_create_a_github_client_instance(): void
    {
		$this->assertInstanceOf(GithubClient::class, (new GithubClient));
    }

	public function test_we_can_fetch_github_events(): void
	{
		$github = new GithubClient;

		// fake API calls?
		// See if Http needs to be mocked or if Http::fake
		// can be used since GithubClient uses Http directly

		// should I fake GithubClient?

		// run getEvents

		// fake sending mail for unsupported event types

		// ensure correct amount is returned
	}

	public function test_we_are_notified_of_unsupported_event_types(): void
	{
		// fake API call with real event types and some fake ones

		// run getEvents

		// fake sending mail for unsupported event types

		// assert email is sent?

		// ensure correct amount returned
		// assume unsupported event types are subtracted from total
	}

	// test that error is thrown when user unspecified?

	// test that error is thrown when count is unspecified?
}
