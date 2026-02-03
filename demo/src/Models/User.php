<?php

    namespace App\Models;

    use App\Core\Database;

    class User extends Database
    {
        public static function all($id)
        {
            return parent::query("SELECT username, email, image FROM users WHERE id = :id", [":id" => $id])->fetch(\PDO::FETCH_ASSOC);
        }
    }