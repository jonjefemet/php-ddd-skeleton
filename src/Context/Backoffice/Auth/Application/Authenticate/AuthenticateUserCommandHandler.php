<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate;

use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthPassword;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUsername;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\CommandHandler;

final readonly class AuthenticateUserCommandHandler implements CommandHandler
{
	public function __construct(private UserAuthenticator $authenticator) {}

	public function __invoke(AuthenticateUserCommand $command): void
	{
		$this->authenticator->authenticate(
			new AuthUsername($command->username()),
			new AuthPassword($command->password())
		);
	}
}
