<?php

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;

it('can visit the homepage', function (): void {
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
});

it('can leave the homepage and navigate back to the homepage', function (): void {
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
});

it('can visit the privacy policy page', function (): void {
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
});
