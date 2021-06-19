<?php

namespace Tests\Support;

use ReflectionObject;

class PrivatePropertyAccessor
{
	private object $object;

	public function __construct()
	{
		// ...
	}

	public function from(object $object): self
	{
		$this->object = $object;

		return $this;
	}

	public function get(string $propertyName): mixed
	{
		$reflector = new ReflectionObject($this->object);
		$property = $reflector->getProperty($propertyName);
		$property->setAccessible(true);

		return $property->getValue($this->object);
	}

	public static function make(): self
	{
		return new self;
	}
}
