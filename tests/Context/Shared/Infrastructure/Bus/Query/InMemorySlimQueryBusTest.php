<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\Bus\Query;

use Mockery\MockInterface;
use RuntimeException;
use SkeletonDDD\Context\Shared\Domain\Bus\Query\Query;
use SkeletonDDD\Context\Shared\Infrastructure\Bus\Query\InMemorySlimQueryBus;
use SkeletonDDD\Context\Shared\Infrastructure\Bus\Query\QueryNotRegisteredError;
use SkeletonDDD\Tests\Context\Shared\Infrastructure\Bus\Query\FakeQuery;
use SkeletonDDD\Tests\Context\Shared\Infrastructure\PhpUnit\UnitTestCase;

final class InMemorySlimQueryBusTest extends UnitTestCase
{
	private InMemorySlimQueryBus | null $queryBus;

	protected function setUp(): void
	{
		parent::setUp();

		$this->queryBus = new InMemorySlimQueryBus([$this->queryHandler()]);
	}

	/** @test */
	public function it_should_return_a_response_successfully(): void
	{
		$this->expectException(RuntimeException::class);

		$this->queryBus->ask(new FakeQuery());
	}

	/** @test */
	public function it_should_raise_an_exception_dispatching_a_non_registered_query(): void
	{
		$this->expectException(QueryNotRegisteredError::class);

		$this->queryBus->ask($this->query());
	}

	private function queryHandler(): object
	{
		return new class() {
			public function __invoke(FakeQuery $query): never
			{
				throw new RuntimeException('This works fine!');
			}
		};
	}

	private function query(): MockInterface | Query
	{
		return $this->mock(Query::class);
	}
}
