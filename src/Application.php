<?php

namespace App\Source;

use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load("../.env");

/**
 * Allows to get the informations about the application
 */
class Application
{
    private string $name;
    private string $version;

    public function __construct()
    {
        $this->name = $_ENV["APP_NAME"];
        $this->version = $_ENV["APP_VERSION"];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
