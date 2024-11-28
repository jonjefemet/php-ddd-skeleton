<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Backoffice\Auth\Domain;

use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthPassword;
use SkeletonDDD\Tests\Context\Shared\Domain\UuidMother;

final class AuthPasswordMother
{
	public static function create(?string $value = null): AuthPassword
	{
		return new AuthPassword($value ?? UuidMother::create());
	}
}
