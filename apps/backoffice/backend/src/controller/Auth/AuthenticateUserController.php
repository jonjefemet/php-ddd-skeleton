<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Backoffice\Backend\Controller\Auth;


use Respect\Validation\ChainedValidator;
use Respect\Validation\Validator as v;
use SkeletonDDD\Apps\Shared\Backend\ApiController;
use SkeletonDDD\Context\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use SkeletonDDD\Context\Shared\Domain\Bus\Command\CommandBus;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

final class AuthenticateUserController extends ApiController
{


    public function __construct(
        private CommandBus $commandBus
    ) {}

    protected function getSchema()
    {
        return
            v::arrayType()
            ->key('username', v::stringType()->notEmpty())
            ->key('password', v::stringType()->notEmpty());
    }

    protected function doAction(Request $request, Response $response): Response
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
