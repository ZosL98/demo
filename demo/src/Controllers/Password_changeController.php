<?php

    namespace App\Controllers;

    use App\Models\Password_change;
    use App\Controller;
    use App\Core\Validator;
    use App\Core\Session;
    use App\Core\Request;

    class Password_changeController extends Controller
    {
        public function index()
        {
            redirectIfNotLoggedIn('login');

            $this->render("password_change");
        }

        public function change()
        {
            $errors = Validator::validate([
                'current_password' => ['min:3', 'required', 'password'],
                'new_password' => ['min:3', 'required', 'matches:confirm_password'],
                'confirm_password' => ['min:3', 'required', 'matches:new_password'],
            ]);

            if (!empty($errors)) {
                Session::flash('errors', $errors);
                redirect('passwordchange');
            }

            $new_password = Request::input('new_password');

            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            Password_change::update($hashed, Session::get('user_id'));

            logoutUser();
        }
    }
