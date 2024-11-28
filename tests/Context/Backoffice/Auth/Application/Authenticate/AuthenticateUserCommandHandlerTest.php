<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Backoffice\Auth\Application\Authenticate;

use  SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommandHandler;
use  SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\UserAuthenticator;
use  SkeletonDDD\Context\Backoffice\Auth\Domain\InvalidAuthCredentials;
use  SkeletonDDD\Context\Backoffice\Auth\Domain\InvalidAuthUsername;
use SkeletonDDD\Tests\Context\Backoffice\Auth\AuthModuleUnitTestCase;
use SkeletonDDD\Tests\Context\Backoffice\Auth\Domain\AuthUserMother;
use SkeletonDDD\Tests\Context\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandHandlerTest extends AuthModuleUnitTestCase
{
	private AuthenticateUserCommandHandler | null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new AuthenticateUserCommandHandler(new UserAuthenticator($this->repository()));
	}

	/** @test */
	public function it_should_authenticate_a_valid_user(): void
	{
		$command = AuthenticateUserCommandMother::create();
		$authUser = AuthUserMother::fromCommand($command);

		$this->shouldSearch($authUser->username(), $authUser);


		$this->dispatch($command, $this->handler);
	}

	/** @test */
	public function it_should_throw_an_exception_when_the_user_does_not_exist(): void
	{
		$this->expectException(InvalidAuthUsername::class);

		$command = AuthenticateUserCommandMother::create();
		$username = AuthUsernameMother::create($command->username());

		$this->shouldSearch($username);

		$this->dispatch($command, $this->handler);
	}

	/** @test */
	public function it_should_throw_an_exception_when_the_password_does_not_math(): void
	{
		$this->expectException(InvalidAuthCredentials::class);

		$command = AuthenticateUserCommandMother::create();
		$authUser = AuthUserMother::create(username: AuthUsernameMother::create($command->username()));

		$this->shouldSearch($authUser->username(), $authUser);

		$this->dispatch($command, $this->handler);
	}
}
