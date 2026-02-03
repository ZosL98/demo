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
            $errors = [];

            $current_password = Request::input('current_password');
            $new_password = Request::input('new_password');
            $confirm_password = Request::input('confirm_password');
            $res = Password_change::check(Session::get('user_id'));
            $allInputs = Request::all();

            if (!password_verify($current_password, $res['password'])) {
                $errors['current_password'] = 'Wrong password';
            }

            if ($new_password !== $confirm_password) {
                $errors['new_password'] = 'Passwords do not match';
                $errors['confirm_password'] = 'Passwords do not match';
            }

            foreach ($allInputs as $key => $value) {
                if (empty($value)) {
                    $errors[$key] = "This input field is required";
                } else if (!Validator::string($value, 3, INF)) {
                    $errors[$key] = 'Input field must be at least 3 characters long';
                }
            }

            if (!empty($errors)) {
                Session::flash('errors', $errors);
                redirect('passwordchange');
            }

            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            Password_change::update($hashed, Session::get('user_id'));

            logoutUser();
        }
    }