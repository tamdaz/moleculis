<?php

namespace App\Http\Controller;

use Psr\Container\ContainerInterface;

class AbstractController
{
    protected $view;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get('view');
    }
}
