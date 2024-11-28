<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Backoffice\Auth\Domain;

use SkeletonDDD\Context\Shared\Domain\Exception\HttpNotFoundException;

final class InvalidAuthCredentials extends HttpNotFoundException
{
	public function __construct(AuthUsername $username)
	{
		parent::__construct(sprintf('The credentials for <%s> are invalid', $username->value()));
	}
}
