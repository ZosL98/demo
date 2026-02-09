<?php

    namespace App\Models;

    use App\Core\Database;
    use App\Core\Functions;

    class Auth extends Database
    {
        public static function check($header, $value)
        {
            return parent::query("SELECT * FROM users WHERE $header = :$header", [":$header" => $value])->fetch(\PDO::FETCH_ASSOC);
        }

        public static function store($username, $email, $password)
        {
            Functions::insert("users", [
                ":username" => $username,
                ":email" => $email,
                ":password" => $password,
            ]);
        }
    }
