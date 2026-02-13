<?php

    namespace App\Models;

    use App\Core\Database;

    class Auth extends Database
    {
        public static function store($username, $email, $password)
        {
            Database::insert("users", [
                ":username" => $username,
                ":email" => $email,
                ":password" => $password,
            ]);
        }
    }
