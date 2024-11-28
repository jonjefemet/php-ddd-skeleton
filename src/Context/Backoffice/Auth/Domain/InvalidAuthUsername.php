<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Backoffice\Auth\Domain;

use RuntimeException;
use SkeletonDDD\Context\Shared\Domain\Exception\HttpNotFoundException;

final class InvalidAuthUsername extends HttpNotFoundException
{
	public function __construct(AuthUsername $username)
	{
		parent::__construct(sprintf('The user <%s> does not exists', $username->value()));
	}
}
