<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Domain\Bus\Query;

interface QueryHandler
{
    public function __invoke(Query $query): ?Response;
}
