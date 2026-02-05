<?php

    namespace App\Models;

    use App\Core\Database;

    class Profile extends Database
    {
        public static function find($header, $val)
        {
            return Database::query("SELECT * FROM users WHERE $header = :$header", ["$header" => $val])->fetch(\PDO::FETCH_ASSOC);
        }

        public static function change($header, $val, $id)
        {
            Database::query("UPDATE users SET $header = :$header WHERE id = :id", [":$header" => $val, ":id" => $id]);
        }
    }
