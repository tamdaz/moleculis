<?php

namespace App\Http\Controller;

use App\Http\Controller\AbstractController;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DocumentationController extends AbstractController
{
    public function index(Request $request, Response $response, array $args=[])
    {
        return $this->view->render($response, 'doc/home.twig');
    }

    public function page(Request $request, Response $response, array $args=[])
    {
        return $this->view->render($response, 'doc/page.twig', [
            "title" => $args['title']
        ]);
    }
}