<?php

namespace App\Source;

use PDO;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load("../.env");

/**
 * Allows to interact with the database
 * INFO: it's a singleton class, it will be instancied one time
 */
class Database
{
    private static ?Database $instance = null;
    private ?PDO $pdo = null;
    private array $settings = [];

    private function __construct()
    {
        $this->settings = [
            "host"    => $_ENV["DB_HOST"],
            "user"    => $_ENV["DB_USER"],
            "pass"    => $_ENV["DB_PASS"],
            "db_name" => $_ENV["DB_NAME"]
        ];

        $this->pdo = new PDO(
            sprintf("mysql:dbname=%s;host=%s", $this->settings["db_name"], $this->settings["host"]),
            $this->settings["user"], $this->settings["pass"]
        );
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function query(string $instruction): array
    {
        $query = $this->pdo->query($instruction);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}