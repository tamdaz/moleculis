<?php

namespace App\Config;

use App\Http\Extension\MarkdownExtension;
use App\Source\Application;
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Twig\TwigFunction;

$container = new Container();
AppFactory::setContainer($container);

$user = $container->get(Application::class);

$twig = Twig::create('../templates', [
    'cache' => '../tmp/cache/',
    'auto_reload' => true,
    'autoescape' => false
]);

$twig->getEnvironment()->addFunction(new TwigFunction('App', function () use ($user) {
    return $user;
}));

$container->set('view', function () use ($twig) {
    return $twig;
});

$twig->addExtension(new MarkdownExtension);

$twig->getEnvironment()->addFunction(new TwigFunction('markdown', function ($text) use ($twig) {
    $parsedown = new \Parsedown();
    return $parsedown->text($text);
}));