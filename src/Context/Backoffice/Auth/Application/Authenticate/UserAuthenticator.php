<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate;

use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthPassword;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthRepository;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUser;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUsername;
use SkeletonDDD\Context\Backoffice\Auth\Domain\InvalidAuthCredentials;
use SkeletonDDD\Context\Backoffice\Auth\Domain\InvalidAuthUsername;

final readonly class UserAuthenticator
{
	public function __construct(private AuthRepository $repository) {}

	public function authenticate(AuthUsername $username, AuthPassword $password): void
	{
		$auth = $this->repository->search($username);

		if ($auth === null) {
			throw new InvalidAuthUsername($username);
		}

		$this->ensureCredentialsAreValid($auth, $password);
	}

	private function ensureCredentialsAreValid(AuthUser $auth, AuthPassword $password): void
	{
		if (!$auth->passwordMatches($password)) {
			throw new InvalidAuthCredentials($auth->username());
		}
	}
}
