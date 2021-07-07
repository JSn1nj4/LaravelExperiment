<?php

namespace Tests\Support;

abstract class BaseFactory
{
	protected int $count = 0;

	public function __construct()
	{

	}

	public function count(int $count): static
	{
		$this->count = $count;

		return $this;
	}

	public static function init(): static
	{
		return new static();
	}

	abstract public function make(): array;
}
