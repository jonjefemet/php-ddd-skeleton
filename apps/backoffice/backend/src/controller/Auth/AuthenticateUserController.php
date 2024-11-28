<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Backoffice\Backend\Controller\Auth;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\CommandBus;

final class AuthenticateUserController
{


    public function __construct(
        private CommandBus $commandBus
    ) {}

    public function __invoke(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();

        $username = $data['username'];
        $password = $data['password'];
        $command = new AuthenticateUserCommand(
            $username,
            $password
        );

        $this->commandBus->dispatch($command);

        return $response->withStatus(200);
    }
}
