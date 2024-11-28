<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Infrastructure\Bus\Event\InMemory;

use SkeletonDDD\Context\Shared\Domain\Bus\Event\DomainEvent;
use SkeletonDDD\Context\Shared\Domain\Bus\Event\DomainEventSubscriber;
use SkeletonDDD\Context\Shared\Domain\Bus\Event\EventBus;


class InMemorySymfonyEventBus implements EventBus
{


	/**
	 * @var DomainEventSubscriber[] $eventSubscriber
	 */
	private array $eventSubscriber;

	public function __construct(array $eventSubscriber)
	{
		$this->eventSubscriber = $eventSubscriber;
	}

	public function publish(DomainEvent ...$events): void
	{
		foreach ($events as $event) {
			$eventName = get_class($event);
			foreach ($this->eventSubscriber as $subscriber) {
				if (in_array($eventName, $subscriber::subscribedTo())) {
					$subscriber($event);
				}
			}
		}
	}
}
