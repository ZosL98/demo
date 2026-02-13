<?php

    namespace App\Models;

    use App\Core\Database;

    class Password_change extends Database
    {
        public static function update($password, $id)
        {
            parent::query("UPDATE users SET password = :password WHERE id = :id", [":password" => $password, ":id" => $id]);
        }
    }
