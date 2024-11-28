<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Domain;

interface RandomNumberGenerator
{
	public function generate(): int;
}
