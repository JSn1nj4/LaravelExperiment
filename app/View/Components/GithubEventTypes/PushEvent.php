<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\HasGitRef;
use App\Traits\HasPreposition;

class PushEvent extends BaseComponent
{
	use HasGitRef,
		HasPreposition;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'pushed to',
			'far fa-arrow-alt-circle-up',
			$event
		);

		$this->preposition = 'at';
		$this->setRefName($this->event->source);
		$this->setRefUrl($this->event->repo);
	}
}
