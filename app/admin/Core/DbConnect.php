<?php

namespace App\admin\Core;

use PDO;
use PDOException;

class DbConnect
{
    private $connection;
    private static $instance;

    private const SERVER = '';
    private const PORT = '';
    private const USER = '';
    private const PASSWORD = '';
    private const DATABASE = '';

    private function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::SERVER . ';port=' . self::PORT . ';dbname=' . self::DATABASE,
                self::USER,
                self::PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
