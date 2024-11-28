<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Domain;

final class RandomElementPicker
{
	public static function from(mixed ...$elements): mixed
	{
		return MotherCreator::random()->randomElement($elements);
	}
}
