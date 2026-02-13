<?php

namespace App\Core;

class Database {
    private static $username = "root";
    private static $password = "";
    private static $conn;

    private static function connect() {
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

    public static function insert($table, $data = [])
    {
        $headers = [];

        $keys = implode(",", array_keys($data));

        foreach(explode(",", $keys) as $key) {
            $key = substr($key, 1);

            $headers[] = $key;
        }

        $headers = implode(",", $headers);
        $values = implode(",", array_keys($data));

        $query = "INSERT INTO $table ($headers) VALUES($values)";

        Database::query($query, $data);
    }
}

