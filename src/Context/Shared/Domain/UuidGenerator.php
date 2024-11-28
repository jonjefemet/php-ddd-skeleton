<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Domain;

interface UuidGenerator
{
	public function generate(): string;
}
