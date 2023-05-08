<?php

namespace App\Http\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PageController extends AbstractController
{
    public function index(Request $request, Response $response, array $args=[])
    {
        $this->view->render($response, 'index.twig', [
            "name" => "hello world"
        ]);

        return $response;
    }
}