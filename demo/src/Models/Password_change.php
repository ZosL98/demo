<?php

    namespace App\Models;

    use App\Core\Database;

    class Password_change extends Database
    {
        public static function check($id)
        {
            return parent::query("SELECT password FROM users WHERE id = :id", [":id" => $id])->fetch(\PDO::FETCH_ASSOC);
        }

        public static function update($password, $id)
        {
            parent::query("UPDATE users SET password = :password WHERE id = :id", [":password" => $password, ":id" => $id]);
        }
    }