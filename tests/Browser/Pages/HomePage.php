<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class HomePage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
			->assertVisible('@header')
			->assertVisible('@main')
			->assertVisible('@banner')
			->assertSee('ElliotDerhay.com')
			->assertSee('A personal profile')
			->assertVisible('@twitter')
			->assertVisible('@github')
			->assertVisible('@footer');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
			'@banner' => '.home-banner',
            '@twitter' => '#twitter_timeline-home',
			'@github' => '#github_events_feed-home',
        ];
    }
}
