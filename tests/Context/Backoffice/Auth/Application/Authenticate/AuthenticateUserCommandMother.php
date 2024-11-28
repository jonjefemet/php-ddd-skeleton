<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Backoffice\Auth\Application\Authenticate;

use SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthPassword;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUsername;
use SkeletonDDD\Tests\Context\Backoffice\Auth\Domain\AuthPasswordMother;
use SkeletonDDD\Tests\Context\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandMother
{
	public static function create(
		?AuthUsername $username = null,
		?AuthPassword $password = null
	): AuthenticateUserCommand {
		return new AuthenticateUserCommand(
			$username?->value() ?? AuthUsernameMother::create()->value(),
			$password?->value() ?? AuthPasswordMother::create()->value()
		);
	}
}
