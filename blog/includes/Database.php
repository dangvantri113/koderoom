<?php
require_once __DIR__ . '/env.php';

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        Env::load(__DIR__ . '/../.env');
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');
        $name = getenv('DB_NAME');
        $this->connection = new mysqli($host, $user, $pass, $name);
        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
