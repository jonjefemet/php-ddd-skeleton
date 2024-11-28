<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Domain\Criteria;

use SkeletonDDD\Context\Shared\Domain\Criteria\OrderBy;
use SkeletonDDD\Tests\Context\Shared\Domain\WordMother;

final class OrderByMother
{
	public static function create(?string $fieldName = null): OrderBy
	{
		return new OrderBy($fieldName ?? WordMother::create());
	}
}
