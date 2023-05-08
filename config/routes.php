<?php

namespace App\Config;

use App\Http\Controller\API\ParticleController;
use App\Http\Controller\DocumentationController;
use App\Http\Controller\PageController;
use Slim\Routing\RouteCollectorProxy;

/**
 * ========================================================
 * You can add routes here
 * ========================================================
 */

$app->get('/', PageController::class . ':index');

/**
 * API part
 */
$app->group('/api', function (RouteCollectorProxy $group) {
    $group->get('/all', ParticleController::class . ':all');
    $group->get('/average', ParticleController::class . ':average');
    $group->get('/latest', ParticleController::class . ':latest');
    // $group->get('/insert', ParticleController::class . ':insert');
});


/**
 * Documentation part
 */
$app->get('/documentation', DocumentationController::class . ':index');
$app->get('/documentation/{title}', DocumentationController::class . ':page');