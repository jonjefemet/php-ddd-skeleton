<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Domain\Criteria;

use SkeletonDDD\Context\Shared\Domain\Criteria\FilterField;
use SkeletonDDD\Tests\Context\Shared\Domain\WordMother;

final class FilterFieldMother
{
	public static function create(?string $fieldName = null): FilterField
	{
		return new FilterField($fieldName ?? WordMother::create());
	}
}
