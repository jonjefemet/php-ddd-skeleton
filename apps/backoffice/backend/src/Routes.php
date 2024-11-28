<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Backoffice\Backend;

use SkeletonDDD\Apps\Backoffice\Backend\Controller\Auth\AuthenticateUserController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

class Routes
{
    static public function register(App $app)
    {
        $app->group('/v1', function (RouteCollectorProxy $group) {
            $group->group('/auth', function (RouteCollectorProxy $group) {
                $group->post('/authenticate', AuthenticateUserController::class);
            });
        });
    }
}
