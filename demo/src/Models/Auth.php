<?php

    namespace App\Models;

    use App\Core\Database;

    class Auth extends Database
    {
        public static function check($header, $value)
        {
            return parent::query("SELECT * FROM users WHERE $header = :$header", [":$header" => $value])->fetch(\PDO::FETCH_ASSOC);
        }

        public static function store($username, $email, $password)
        {
            parent::query("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)", [
                ":username" => $username,
                ":email" => $email,
                ":password" => $password,
            ]);
        }
    }