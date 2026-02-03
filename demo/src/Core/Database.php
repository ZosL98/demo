<?php

namespace App\Core;

class Database {
    private static $username = "root";
    private static $password = "";
    private static $conn;

    public static function connect() {
        try {
            self::$conn = new \PDO("mysql:host=localhost;dbname=demo;charset=utf8mb4", self::$username, self::$password);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function query($query, $params = []) {
        $statement = Database::connect()->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}
