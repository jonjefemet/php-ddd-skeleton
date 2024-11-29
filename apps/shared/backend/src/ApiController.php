<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Shared\Backend;

use Respect\Validation\Exceptions\ValidationException;
use SkeletonDDD\Context\Shared\Domain\Exception\HttpBadRequestException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class ApiController
{

    public function __invoke(Request $request, Response $response): Response
    {
        $schema = $this->getSchema();
        try {
            $schema->check($request->getParsedBody());
        } catch (ValidationException $e) {
            throw new HttpBadRequestException($e->getMessage());
        }

        return $this->doAction($request, $response);
    }

    abstract protected function getSchema();

    abstract protected function doAction(Request $request, Response $response): Response;
}
