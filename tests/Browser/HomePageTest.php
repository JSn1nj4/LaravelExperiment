<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
	/**
	 * A Dusk test example.
	 *
	 * @return void
	 */
	public function testVisitHomePage()
	{
		$this->browse(function (Browser $browser) {
			$homepage = new HomePage;

			$browser->visit($homepage)
				->clickLink('Home')
				->assertPathIs($homepage->url());
		});
	}
}
