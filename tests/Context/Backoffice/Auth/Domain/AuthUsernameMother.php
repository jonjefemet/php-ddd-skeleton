<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Backoffice\Auth\Domain;

use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUsername;
use SkeletonDDD\Tests\Context\Shared\Domain\WordMother;

final class AuthUsernameMother
{
	public static function create(?string $value = null): AuthUsername
	{
		return new AuthUsername($value ?? WordMother::create());
	}
}
