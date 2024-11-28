<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Infrastructure\Bus\Query;

use SkeletonDDD\Context\Shared\Domain\Bus\Query\Response;

final readonly class FakeResponse implements Response
{
	public function __construct(private int $number) {}

	public function number(): int
	{
		return $this->number;
	}
}
