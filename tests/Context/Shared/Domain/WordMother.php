<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Domain;

final class WordMother
{
	public static function create(): string
	{
		return MotherCreator::random()->word;
	}
}
