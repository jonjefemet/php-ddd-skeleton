<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Shared\Backend;


use Psr\Container\ContainerInterface;
use SkeletonDDD\Apps\Shared\Backend\Handlers\HttpErrorHandler;
use SkeletonDDD\Apps\Shared\Backend\Handlers\JsonBodyParserMiddleware;
use SkeletonDDD\Apps\Shared\Backend\Handlers\JsonResponseMiddleware;
use SkeletonDDD\Apps\Shared\Backend\Handlers\ShutdownHandler;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;


abstract class DefaultApp
{
    protected $app;

    protected $displayErrorDetails = true;

    public function __construct(ContainerInterface $container)
    {
        $this->app = AppFactory::createFromContainer($container);
        $this->registerAfterMiddleware();
        $this->registerRoutes();
        $this->registerBeforeMiddleware();
        $this->errorHandler();
    }

    private function registerAfterMiddleware()
    {
        $this->app->add(JsonBodyParserMiddleware::class);
    }

    private function registerBeforeMiddleware()
    {
        $this->app->add(JsonResponseMiddleware::class);
    }
    private function errorHandler()
    {

        $callableResolver = $this->app->getCallableResolver();
        $responseFactory = $this->app->getResponseFactory();

        $serverRequestCreator = ServerRequestCreatorFactory::create();
        //$request = $serverRequestCreator->createServerRequestFromGlobals();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        // $shutdownHandler = new ShutdownHandler($request, $errorHandler, $this->displayErrorDetails);
        // register_shutdown_function($shutdownHandler);


        $this->app->addRoutingMiddleware();

        $errorMiddleware = $this->app->addErrorMiddleware($this->displayErrorDetails, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);
    }

    abstract protected function registerRoutes();

    public function run()
    {
        $this->app->run();
    }
}
