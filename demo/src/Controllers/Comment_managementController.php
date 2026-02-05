<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Core\Request;
    use App\Core\Session;
    use App\Models\Comment_management;

    class Comment_managementController extends Controller
    {
        public function index()
        {
            $comments = Comment_management::all();

            $this->render("comment_management", ["comments" => $comments]);
        }

        public function show()
        {
            $search_inp = trim(Request::input('search_inp'));
            $date = Request::input('date');
            Session::flash('old', Request::all());

            if (!empty($date) && !empty($search_inp)) {
                $comments = Comment_management::search($search_inp, $date);

                $this->render("comment_management", ["comments" => $comments]);

            } else if(empty($date) && !empty($search_inp)) {
                $comments = Comment_management::search($search_inp, null);

                $this->render("comment_management", ["comments" => $comments]);

            } else {
                $comments = Comment_management::search(null, $date);

                $this->render("comment_management", ["comments" => $comments]);
            }
        }

        public function delete()
        {
            $all = Request::all();
            
            foreach ($all as $key => $value) {
                Comment_management::deleteComments($value);
            }

            redirect('commentmanagement');
        }

        public function update()
        {
            Comment_management::updateComment(Request::input('comment_id'), Request::input('updated_comment'));
            redirect('commentmanagement');
        }

    }
