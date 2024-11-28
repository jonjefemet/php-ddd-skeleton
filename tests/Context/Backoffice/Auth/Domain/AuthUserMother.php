<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Backoffice\Auth\Domain;

use  SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use  SkeletonDDD\Context\Backoffice\Auth\Domain\AuthPassword;
use  SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUser;
use  SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUsername;

final class AuthUserMother
{
	public static function create(?AuthUsername $username = null, ?AuthPassword $password = null): AuthUser
	{
		return new AuthUser($username ?? AuthUsernameMother::create(), $password ?? AuthPasswordMother::create());
	}

	public static function fromCommand(AuthenticateUserCommand $command): AuthUser
	{
		return self::create(
			AuthUsernameMother::create($command->username()),
			AuthPasswordMother::create($command->password())
		);
	}
}
