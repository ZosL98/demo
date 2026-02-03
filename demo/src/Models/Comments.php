<?php

    namespace App\Models;

    use App\Core\Database;

    class Comments extends Database
    {
        public static function all()
        {
            return parent::query("SELECT comments.*,users.username, users.image FROM comments JOIN users ON users.id = comments.user_id ORDER BY comments.id ASC")->fetchAll(\PDO::FETCH_ASSOC);
        }


        public static function store($user_id, $comment, $parent_id)
        {
            parent::query("INSERT INTO comments(user_id, comment, parent_id) VALUES(:user_id, :comment, :parent_id)", [
                ":user_id" => $user_id,
                ":comment" => $comment,
                ":parent_id" => $parent_id,
            ]);
        }

        public static function delete($id, $user_id)
        {
            parent::query("DELETE FROM comments WHERE id = :id AND user_id = :user_id", [':id' => $id, ':user_id' => $user_id]);
        }
    }