<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Backoffice\Auth;

use Mockery\MockInterface;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthRepository;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUser;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthUsername;
use SkeletonDDD\Tests\Context\Shared\Infrastructure\PhpUnit\UnitTestCase;

abstract class AuthModuleUnitTestCase extends UnitTestCase
{
    private AuthRepository | MockInterface | null $repository = null;

    protected function shouldSearch(AuthUsername $username, AuthUser $authUser = null): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($username))
            ->once()
            ->andReturn($authUser);
    }

    protected function repository(): AuthRepository | MockInterface
    {
        return $this->repository ??= $this->mock(AuthRepository::class);
    }
}
