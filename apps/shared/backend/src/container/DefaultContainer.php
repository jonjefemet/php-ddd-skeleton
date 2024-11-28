<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Shared\Backend\Container;

use DI\Container;
use Psr\Container\ContainerInterface;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\CommandBus;
use SkeletonDDD\Context\Shared\Domain\Bus\Query\QueryBus;
use SkeletonDDD\Context\Shared\Infrastructure\Bus\Command\InMemorySlimCommandBus;
use SkeletonDDD\Context\Shared\Infrastructure\Bus\Query\InMemorySlimQueryBus;
use SkeletonDDD\Context\Shared\SharedIdentifiers;

abstract class DefaultContainer
{
    public static function create(): Container
    {
        $container = new Container();

        $container->set(CommandBus::class, function (ContainerInterface $container) {
            return new InMemorySlimCommandBus($container->get(SharedIdentifiers::COMMAND_HANDLERS));
        });

        $container->set(QueryBus::class, function (ContainerInterface $container) {
            return new InMemorySlimQueryBus($container->get(SharedIdentifiers::QUERY_HANDLERS));
        });

        return $container;
    }
}
