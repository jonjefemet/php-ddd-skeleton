<?php

namespace SkeletonDDD\Context\Shared\Infrastructure\Bus\Query;

use SkeletonDDD\Context\Shared\Domain\Bus\Query\Query;
use SkeletonDDD\Context\Shared\Domain\Bus\Query\QueryBus;
use SkeletonDDD\Context\Shared\Domain\Bus\Query\Response;

final class InMemorySlimQueryBus implements QueryBus
{
	private array $handlers;

	public function __construct(array $handlers)
	{
		$this->handlers = $handlers;
	}

	public function ask(Query $query): ?Response
	{
		$handlerClass = get_class($query) . 'Handler';
		if (!isset($this->handlers[$handlerClass])) {
			throw new QueryNotRegisteredError($query);
		}

		$handler = $this->handlers[$handlerClass];
		if (!is_callable($handler)) {
			throw new QueryNotRegisteredError($query);
		}

		return $handler($query);
	}
}
