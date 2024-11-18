<?php

namespace NewCo\UserService\Repositories;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;

use Dotenv\Dotenv;

class Repository
{
    protected PDO $pdo;
    private string $host;
    private string $username;
    private string $databaseName;
    private string $databasePassword;
    private string $charset;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();

        $this->host = $_ENV["DB_HOST"];
        $this->username = $_ENV["DB_USERNAME"];
        $this->databaseName = $_ENV["DB_NAME"];
        $this->databasePassword = $_ENV["DB_PASSWORD"];
        $this->charset = 'utf8mb4';

        $dsn = "mysql:host=$this->host;dbname=$this->databaseName;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->databasePassword, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}