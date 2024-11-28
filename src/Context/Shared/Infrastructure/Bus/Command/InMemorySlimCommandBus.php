<?php

namespace SkeletonDDD\Context\Shared\Infrastructure\Bus\Command;

use SkeletonDDD\Context\Shared\Domain\Bus\Command\Command;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\CommandBus;

final class InMemorySlimCommandBus implements CommandBus
{
	private array $handlers;

	public function __construct(array $handlers)
	{
		$this->handlers = $handlers;
	}

	public function dispatch(Command $command): void
	{
		$handlerClass = get_class($command) . 'Handler';
		if (!isset($this->handlers[$handlerClass])) {
			throw new CommandNotRegisteredError($command);
		}

		$handler = $this->handlers[$handlerClass];
		if (!is_callable($handler)) {
			throw new CommandNotRegisteredError($command);
		}

		$handler($command);
	}
}
