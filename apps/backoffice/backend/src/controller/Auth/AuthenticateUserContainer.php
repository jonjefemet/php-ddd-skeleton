<?php

declare(strict_types=1);


namespace SkeletonDDD\Apps\Backoffice\Backend\Controller\Auth;

use DI\Container;
use Psr\Container\ContainerInterface;
use SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommandHandler;
use SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\UserAuthenticator;
use SkeletonDDD\Context\Backoffice\Auth\Domain\AuthRepository;
use SkeletonDDD\Context\Backoffice\Auth\Infrastructure\Persistence\InMemoryAuthRepository;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\CommandBus;

class AuthenticateUserContainer
{
    public static function create(Container $container): Container
    {

        $container->set(UserAuthenticator::class, function (ContainerInterface $container) {
            return new UserAuthenticator($container->get(AuthRepository::class));
        });

        $container->set(AuthRepository::class, function () {
            return new InMemoryAuthRepository();
        });

        $container->set(AuthenticateUserCommandHandler::class, function (ContainerInterface $container) {
            return new AuthenticateUserCommandHandler($container->get(UserAuthenticator::class));
        });

        $container->set(AuthenticateUserController::class, function (ContainerInterface $container) {
            return new AuthenticateUserController($container->get(CommandBus::class));
        });


        return $container;
    }
}
