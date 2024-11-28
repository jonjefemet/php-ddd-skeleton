<?php

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Infrastructure\Bus\Event\WithMonitoring;

use SkeletonDDD\Context\Shared\Domain\Bus\Event\DomainEvent;
use SkeletonDDD\Context\Shared\Domain\Bus\Event\EventBus;
use SkeletonDDD\Context\Shared\Infrastructure\Monitoring\PrometheusMonitor;

use function Lambdish\Phunctional\each;

final readonly class WithPrometheusMonitoringEventBus implements EventBus
{
	public function __construct(
		private PrometheusMonitor $monitor,
		private string $appName,
		private EventBus $bus
	) {}

	public function publish(DomainEvent ...$events): void
	{
		$counter = $this->monitor->registry()->getOrRegisterCounter(
			$this->appName,
			'domain_event',
			'Domain Events',
			['name']
		);

		each(fn(DomainEvent $event) => $counter->inc(['name' => $event::eventName()]), $events);

		$this->bus->publish(...$events);
	}
}
