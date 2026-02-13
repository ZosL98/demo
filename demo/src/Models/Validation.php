<?php

    namespace App\Models;

    use App\Core\Database;
    use Exception;

    class Validation extends Database
    {
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
    }