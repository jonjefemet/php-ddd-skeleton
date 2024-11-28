<?php

declare(strict_types=1);


namespace SkeletonDDD\Apps\Backoffice\Backend;

use DI\Container;
use Psr\Container\ContainerInterface;
use SkeletonDDD\Apps\Backoffice\Backend\Controller\Auth\AuthenticateUserContainer;
use SkeletonDDD\Apps\Shared\Backend\Container\DefaultContainer;
use SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommandHandler;
use SkeletonDDD\Context\Shared\SharedIdentifiers;

class BackofficeContainer
{
    public static function create(): Container
    {
        $container = DefaultContainer::create();

        AuthenticateUserContainer::create($container);

        $container->set(SharedIdentifiers::COMMAND_HANDLERS, function (ContainerInterface $container) {
            return [
                AuthenticateUserCommandHandler::class => $container->get(AuthenticateUserCommandHandler::class),
            ];
        });





        return $container;
    }
}
