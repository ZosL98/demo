<?php

namespace App\Core;

use Exception;

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

    public static function find($table, $column, $value)
    {
        $allowedTables = ["users", "comments"];
        $allowedColumns = ["username", "email", "id"];

        if (!in_array($table, $allowedTables) || !in_array($column, $allowedColumns)) {
            throw new Exception("Not allowed");
            exit;
        }

        return Database::query("SELECT * FROM $table WHERE $column = :$column", [":$column" => $value])->fetch(\PDO::FETCH_ASSOC);
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
