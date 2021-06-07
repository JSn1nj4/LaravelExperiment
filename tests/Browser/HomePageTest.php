<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
	public function testVisitHomePage(): void
	{
		$this->browse(function (Browser $browser) {
			$homepage = new HomePage;

			$browser->visit($homepage)
				->assertVisible('@main')
				->assertVisible('@banner')
				->assertSee('A personal profile')
				->assertSee('About Me')
				->assertVisible('@twitter')
				->assertVisible('@github');
		});
	}

	public function testLeaveHomePageAndNavigateBackToHomePage(): void
	{
		$this->browse(function (Browser $browser) {
			$homepage = new HomePage;

			$browser->visit($homepage)
				->within($homepage->components->header, function (Browser $browser) use ($homepage) {
					$browser->clickLink('Projects')
						->assertPathIs(route('projects', absolute: false))
						->clickLink('Home')
						->assertPathIs($homepage->url());
				});
		});
	}

	public function testVisitPrivacyPolicyPage(): void
	{
		$this->browse(function (Browser $browser) {
			$homepage = new HomePage;

			$browser->visit($homepage)
				->within($homepage->components->footer, function (Browser $browser) {
					$browser->assertSee('Copyright')
						->assertVisible('@privacy_link')
						->clickLink('Privacy Policy')
						->assertPathIs(route('privacy', absolute: false));
				});
		});
	}
}
