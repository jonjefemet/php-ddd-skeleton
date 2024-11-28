<?php

declare(strict_types=1);


namespace SkeletonDDD\Tests\Context\Shared\Infrastructure\PhpUnit;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\Command;
use SkeletonDDD\Context\Shared\Domain\Bus\Event\DomainEvent;
use SkeletonDDD\Context\Shared\Domain\Bus\Event\EventBus;
use SkeletonDDD\Context\Shared\Domain\Bus\Query\Query;
use SkeletonDDD\Context\Shared\Domain\Bus\Query\Response;
use SkeletonDDD\Context\Shared\Domain\UuidGenerator;
use SkeletonDDD\Tests\Context\Shared\Domain\TestUtils;
use SkeletonDDD\Tests\Context\Shared\Infrastructure\Mockery\MatcherIsSimilar;

abstract class UnitTestCase extends MockeryTestCase
{
    private EventBus | MockInterface | null $eventBus = null;
    private MockInterface | UuidGenerator | null $uuidGenerator = null;

    /**
     * Crea un mock de la clase especificada.
     *
     * @param string $className
     * @return MockInterface
     */
    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    /**
     * Configura el EventBus para que espere la publicación de un evento de dominio.
     *
     * @param DomainEvent $domainEvent
     * @return void
     */
    protected function shouldPublishDomainEvent(DomainEvent $domainEvent): void
    {
        $this->eventBus()
            ->shouldReceive('publish')
            ->with($this->similarTo($domainEvent))
            ->andReturnNull();
    }

    /**
     * Configura el EventBus para que no espere la publicación de ningún evento de dominio.
     *
     * @return void
     */
    protected function shouldNotPublishDomainEvent(): void
    {
        $this->eventBus()
            ->shouldReceive('publish')
            ->withNoArgs()
            ->andReturnNull();
    }

    /**
     * Obtiene el EventBus mockeado.
     *
     * @return EventBus|MockInterface
     */
    protected function eventBus(): EventBus | MockInterface
    {
        return $this->eventBus ??= $this->mock(EventBus::class);
    }

    /**
     * Configura el UuidGenerator para que genere un UUID específico.
     *
     * @param string $uuid
     * @return void
     */
    protected function shouldGenerateUuid(string $uuid): void
    {
        $this->uuidGenerator()
            ->shouldReceive('generate')
            ->once()
            ->withNoArgs()
            ->andReturn($uuid);
    }

    /**
     * Obtiene el UuidGenerator mockeado.
     *
     * @return MockInterface|UuidGenerator
     */
    protected function uuidGenerator(): MockInterface | UuidGenerator
    {
        return $this->uuidGenerator ??= $this->mock(UuidGenerator::class);
    }

    /**
     * Notifica a un suscriptor con un evento de dominio.
     *
     * @param DomainEvent $event
     * @param callable $subscriber
     * @return void
     */
    protected function notify(DomainEvent $event, callable $subscriber): void
    {
        $subscriber($event);
    }

    /**
     * Despacha un comando a un manejador de comandos.
     *
     * @param Command $command
     * @param callable $commandHandler
     * @return void
     */
    protected function dispatch(Command $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }

    /**
     * Verifica que la respuesta de una consulta sea la esperada.
     *
     * @param Response $expected
     * @param Query $query
     * @param callable $queryHandler
     * @return void
     */
    protected function assertAskResponse(Response $expected, Query $query, callable $queryHandler): void
    {
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Verifica que una consulta lance una excepción específica.
     *
     * @param string $expectedErrorClass
     * @param Query $query
     * @param callable $queryHandler
     * @return void
     */
    protected function assertAskThrowsException(string $expectedErrorClass, Query $query, callable $queryHandler): void
    {
        $this->expectException($expectedErrorClass);

        $queryHandler($query);
    }

    /**
     * Verifica si dos valores son similares.
     *
     * @param mixed $expected
     * @param mixed $actual
     * @return bool
     */
    protected function isSimilar(mixed $expected, mixed $actual): bool
    {
        return TestUtils::isSimilar($expected, $actual);
    }

    /**
     * Asserta que dos valores son similares.
     *
     * @param mixed $expected
     * @param mixed $actual
     * @return void
     */
    protected function assertSimilar(mixed $expected, mixed $actual): void
    {
        TestUtils::assertSimilar($expected, $actual);
    }

    /**
     * Crea un matcher que verifica si un valor es similar a otro.
     *
     * @param mixed $value
     * @param float $delta
     * @return MatcherIsSimilar
     */
    protected function similarTo(mixed $value, float $delta = 0.0): MatcherIsSimilar
    {
        return TestUtils::similarTo($value, $delta);
    }
}
