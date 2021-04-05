<?php

namespace App\Traits;

trait HasGitRef
{
	public string $refName;

	public string $refUrl;

	protected function setRefName(string $ref): void
	{
		$this->refName = str_replace('refs/heads/', '', $ref);
	}

	protected function setRefUrl(string $repoUrl): void
	{
		$this->refUrl = "{$repoUrl}/tree/{$this->refName}";
	}
}
