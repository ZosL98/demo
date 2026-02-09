<?php

    namespace App\Core;

    use App\Core\Database;

    class Functions extends Database
    {
        public static function insert($table, $params = [], $values = [])
        {
            $paramsRes = [];
            $headers = [];

            for ($i = 0; $i < count($params); $i++) {
                $paramsRes[$values[$i]] = $params[$i];
            }

            $headers = array_map(fn($v) => substr($v, 1), $values);

            $headers = implode(",", $headers);
            $values = implode(",", $values);

            $query = "INSERT INTO $table($headers) VALUES($values)";

            Database::query($query, $paramsRes);
        }
    }