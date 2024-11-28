<?php

declare(strict_types=1);

use SkeletonDDD\Apps\Backoffice\Backend\BackofficeApp;
use SkeletonDDD\Apps\Backoffice\Backend\BackofficeContainer;
use Slim\Factory\AppFactory;

require dirname(__DIR__) . '/../../bootstrap.php';

// No mostrar errores al usuario final
ini_set('display_errors', 'Off');
ini_set('display_startup_errors', 'Off');

// Registrar errores en el archivo de log configurado
ini_set('log_errors', 'On');

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);


$container = BackofficeContainer::create();
$backofficeApp = new BackofficeApp($container);
$backofficeApp->run();
