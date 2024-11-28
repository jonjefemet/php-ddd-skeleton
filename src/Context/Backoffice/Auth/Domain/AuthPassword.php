<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Backoffice\Auth\Domain;

use SkeletonDDD\Context\Shared\Domain\ValueObject\StringValueObject;

final class AuthPassword extends StringValueObject
{
	public function isEquals(self $other): bool
	{
		return $this->value() === $other->value();
	}
}
