<?php

    namespace App\Models;

    use App\Core\Database;

    class Comment_management extends Database
    {
        private const query_start = "SELECT comments.*, users.username FROM comments JOIN users ON users.id = comments.user_id";
        private const query_end = " ORDER BY comments.id ASC";

        public static function all()
        {
            return parent::query(self::query_start . self::query_end)->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function search($username, $date)
        {
            $query = self::query_start;

            $conditions = [];
            $params = [];

            if (!empty($username)) {
                $conditions[] = "users.username = :username";
                $params[':username'] = $username;
            }

            if (!empty($date)) {
                $conditions[] = "comments.created_at = :created_at";
                $params[':created_at'] = $date;
            }

            if (!empty($username) && !empty($date)) {
                $query .= " WHERE " . $conditions[0] . " AND " . $conditions[1] . self::query_end;

            } else if(!empty($username) && empty($date)) {
                $query .= " WHERE " . $conditions[0] . self::query_end;

            } else if(empty($username) && !empty($date)) {
                $query .= " WHERE " . $conditions[0] . self::query_end;
            }

            return parent::query($query, $params)->fetchAll(\PDO::FETCH_ASSOC);
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
