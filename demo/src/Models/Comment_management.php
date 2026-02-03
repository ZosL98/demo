<?php

    namespace App\Models;

    use App\Core\Database;

    class Comment_management extends Database
    {
        public static function all()
        {
            return parent::query("SELECT comments.*,users.username FROM comments JOIN users ON users.id = comments.user_id ORDER BY comments.id ASC")->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function searchByUsername($username)
        {
            $query = "SELECT comments.*, users.username FROM comments JOIN users ON users.id = comments.user_id WHERE users.username = :username ORDER BY comments.id ASC";

            return parent::query($query, [":username" => $username])->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function searchByDate($date)
        {
            $query = "SELECT comments.*, users.username FROM comments JOIN users ON users.id = comments.user_id WHERE comments.created_at = :created_at ORDER BY comments.id ASC";

            return parent::query($query, [":created_at" => $date])->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function searchByUsernameAndDate($username, $date)
        {
            $query = "SELECT comments.*, users.username FROM comments JOIN users ON users.id = comments.user_id WHERE users.username = :username AND comments.created_at = :created_at ORDER BY comments.id ASC";
            
            return parent::query($query, [':username' => $username,':created_at' => $date])->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function deleteComments($id)
        {
            parent::query("DELETE FROM comments WHERE id = :id", [":id" => $id]);
        }

        public static function updateComment($id, $comment)
        {
            parent::query("UPDATE comments SET comment = :comment WHERE id = :id", [":comment" => $comment, ":id" => $id]);
        }
    }