<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\HasGitRef;
use App\Traits\HasPreposition;

class DeleteEvent extends BaseComponent
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
			$event->action ?? 'deleted',
			'far fa-trash-alt',
			$event
		);

		$this->preposition = 'from';
		$this->setRefName($this->event->source);
		$this->setRefUrl($this->repoUrl());
	}
}
