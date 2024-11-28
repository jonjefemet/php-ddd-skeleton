<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Domain\Criteria;

use SkeletonDDD\Context\Shared\Domain\Criteria\FilterValue;
use SkeletonDDD\Tests\Context\Shared\Domain\WordMother;

final class FilterValueMother
{
	public static function create(?string $value = null): FilterValue
	{
		return new FilterValue($value ?? WordMother::create());
	}
}
