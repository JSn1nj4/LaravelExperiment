<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\HasPreposition;
use App\Traits\HasPullRequestNumber;

class PullRequestEvent extends BaseComponent
{
	use HasPreposition,
		HasPullRequestNumber;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'opened',
			'fas fa-file-upload',
			$event
		);

		$this->preposition = 'at';
		$this->setPullRequestNumberText($this->event->source);
	}
}
