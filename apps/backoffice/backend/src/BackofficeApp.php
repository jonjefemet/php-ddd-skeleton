<?php

namespace SkeletonDDD\Apps\Backoffice\Backend;

use SkeletonDDD\Apps\Shared\Backend\DefaultApp;

final class BackofficeApp extends DefaultApp
{
    protected function registerRoutes()
    {
        Routes::register($this->app);
    }
}
