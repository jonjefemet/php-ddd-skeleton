<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Domain\Bus\Query;

interface QueryBus
{
	public function ask(Query $query): ?Response;
}
