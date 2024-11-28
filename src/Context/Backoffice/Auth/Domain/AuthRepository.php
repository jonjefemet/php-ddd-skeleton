<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Backoffice\Auth\Domain;


interface AuthRepository
{
	public function search(AuthUsername $username): ?AuthUser;
}
