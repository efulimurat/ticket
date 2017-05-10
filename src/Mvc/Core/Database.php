<?php

namespace Mvc\Core;

class Database {

    private static $ins;
    private $connection;

    private function __construct() {
        $dsn = 'mysql:dbname=' . config('db.name') . ';host=' . config('db.host');
        $user = config('db.user');
        $password = config('db.password');

        try {
            $this->connection = new \PDO($dsn, $user, $password);

            if (config("app.debug") == true) {
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            echo 'Bağlantı kurulamadı: ' . $e->getMessage();
        }
    }

    private function __clone() {
        
    }

    public static function getInstance() {

        if (!isset(self::$ins)) {
            self::$ins = new Database;
        }
        return self::$ins;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        $this->connection = null;
    }

}
