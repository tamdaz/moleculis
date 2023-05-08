<?php

namespace App\Http\Controller\API;

use App\Http\Controller\AbstractController;
use App\Source\Database;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ParticleController extends AbstractController
{
    public function all(Request $request, Response $response, array $args = [])
    {
        header('Content-Type: application/json');

        $data = Database::getInstance()->query("SELECT concentration, DATE_FORMAT(stored_at, '%d-%m-%y %h:%m:%s') AS stored_at from data");
        $response->getBody()->write(json_encode($data));

        return $response;
    }
    public function average(Request $request, Response $response, array $args = [])
    {
        header('Content-Type: application/json');

        $data = Database::getInstance()->query("
            SELECT DATE_FORMAT(stored_at, '%d/%m/%y %H:00') AS stored_at,
                round(avg(concentration), 1) concentration
            FROM data
            GROUP BY DATE_FORMAT(stored_at, '%d/%m/%y %H:00');
        ");
        $response->getBody()->write(json_encode($data));

        return $response;
    }

    public function latest(Request $request, Response $response, array $args=[])
    {
        header('Content-Type: application/json');

        $data = Database::getInstance()->query("SELECT * FROM data ORDER BY stored_at DESC LIMIT 1");
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}