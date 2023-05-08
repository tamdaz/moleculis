<?php

use Slim\Factory\AppFactory;

require "../vendor/autoload.php";
require "../config/dependencies.php";

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require "../config/routes.php";

$app->run();
