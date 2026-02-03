<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Core\Request;
    use App\Core\Session;
    use App\Models\Comments;
    use App\Core\Validator;

    class CommentsController extends Controller
    {
        public function index()
        {
            $all = Comments::all();
            $comments = [];

            foreach($all as $c) {
                $comments[$c['parent_id']][] = $c;
            }

            $this->render('comments', ['comments' => $comments]);
        }

        public function store()
        {
            $errors = [];

            $comment = trim(Request::input('comment'));

            if (!Session::has('user_id')) {
                $errors['not_logged_in'] = "You need to be logged in to comment";
            }

            if (!Validator::string($comment, 3, 200)) {
                $errors['string'] = 'Comment field must be between 3 and 200 characters';
            }

            if (!empty($errors)) {
                Session::flash('errors', $errors);
                redirect('comments');
            }

            $parent_id = Request::input('parent_id') ?? null;
            $user_id = Session::get('user_id');

            Comments::store($user_id, $comment, $parent_id);
            redirect('comments');
        }

        public function delete()
        {
            Comments::delete(Request::input('delete'), Session::get('user_id'));
            redirect('comments');
        }
    }