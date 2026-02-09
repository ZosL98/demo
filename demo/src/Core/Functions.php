<?php

    namespace App\Core;

    use App\Core\Database;

    class Functions extends Database
    {
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
