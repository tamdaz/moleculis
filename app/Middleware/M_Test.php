<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class M_Test
{
    public function __invoke(Request $request, RequestHandler $handler)
    {
        // ...
    }
}
