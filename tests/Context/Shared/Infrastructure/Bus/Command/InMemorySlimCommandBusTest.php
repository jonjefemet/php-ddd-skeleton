<?php

declare(strict_types=1);

namespace SkeletonDDD\Tests\Context\Shared\Infrastructure\Bus\Command;

use Mockery\MockInterface;
use RuntimeException;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\Command;
use SkeletonDDD\Context\Shared\Infrastructure\Bus\Command\CommandNotRegisteredError;
use SkeletonDDD\Context\Shared\Infrastructure\Bus\Command\InMemorySlimCommandBus;
use SkeletonDDD\Tests\Context\Shared\Infrastructure\PhpUnit\UnitTestCase;

final class InMemorySlimCommandBusTest extends UnitTestCase
{
	private InMemorySlimCommandBus | null $commandBus;

	protected function setUp(): void
	{
		parent::setUp();

		$this->commandBus = new InMemorySlimCommandBus([$this->commandHandler()]);
	}

	/** @test */
	public function it_should_be_able_to_handle_a_command(): void
	{
		$this->expectException(RuntimeException::class);

		$this->commandBus->dispatch(new FakeCommand());
	}

	/** @test */
	public function it_should_raise_an_exception_dispatching_a_non_registered_command(): void
	{
		$this->expectException(CommandNotRegisteredError::class);

		$this->commandBus->dispatch($this->command());
	}

	private function commandHandler(): object
	{
		return new class() {
			public function __invoke(FakeCommand $command): never
			{
				throw new RuntimeException('This works fine!');
			}
		};
	}

	private function command(): Command | MockInterface
	{
		return $this->mock(Command::class);
	}
}
