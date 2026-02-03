<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Core\Request;
    use App\Core\Session;
    use App\Core\Validator;
    use App\Models\Auth;

    class AuthController extends Controller
    {
        public function index()
        {
            $this->render("login");
        }

        public function register()
        {
            $this->render("register");
        }

        public function store()
        {
            $errors = [];

            $username = trim(Request::input('username'));
            $email = trim(Request::input('email'));
            $password = trim(Request::input('password'));
            $password_confirm = trim(Request::input('password_confirm'));

            $resUsername = Auth::check('username', $username);
            $resEmail = Auth::check('email', $email);

            if (empty($username)) {
                $errors['username'] = 'Username field must not be empty';

            } else if(!Validator::string($username, 3, 20)) {
                $errors['username'] = 'Username must be between 3 and 20 characters';

            } else if($resUsername) {
                $errors['username'] = 'This username is already used';
            }

            if (empty($email)) {
                $errors['email'] = 'Email field must not be empty';

            } else if(!Validator::email($email)) {
                $errors['email'] = 'Your email is not well formed';
                
            } else if($resEmail) {
                $errors['email'] = 'This email is already used';
            }

            if (empty($password)) {
                $errors['password'] = 'Password field must not be empty';

            } else if (!Validator::string($password, 3, INF)) {
                $errors['password'] = 'Password must be at least 3 characters long';
            }

            if (empty($password_confirm)) {
                $errors['password_confirm'] = 'Cofirm password field must not be empty';
            }

            if ($password_confirm !== $password) {
                $errors['password'] = "Passwords do not match";
                $errors['password_confirm'] = "Passwords do not match";
            }

            if (!empty($errors)) {
                Session::flash('errors', $errors);
                Session::flash('old', Request::all());
                redirect('register');
            }

            $hashed = password_hash(Request::input('password'), PASSWORD_DEFAULT);

            Auth::store($username, $email, $hashed);
            Session::flash('success', 'You have successfully registered');
            redirect('register');
        }


        public function login()
        {
            $errors = [];
            
            $res = Auth::check('username', Request::input('username'));

            $username = trim(Request::input('username'));
            $password = trim(Request::input('password'));

            if (!$res || !password_verify($password, $res['password'])) {
                $errors['username'] = 'Wrong username or password';
                $errors['password'] = 'Wrong username or password';
            }

            if (empty($username)) {
                $errors['username'] = 'Username field must not be empty';
            } else if(!Validator::string($username, 3, 20)) {
                $errors['username'] = 'Username must be between 3 and 20 characters';
            }

            if (empty($password)) {
                $errors['password'] = 'Password field must not be empty';
            }

            if (!empty($errors)) {
                Session::flash('old', Request::all());
                Session::flash('errors', $errors);
                redirect('login');
            }

            Session::flash('success', 'You have successfully logged in');
            Session::put('user_id', $res['id']);
            Session::put('user_username', $res['username']);

            if (!empty(Request::input('rememberme'))) {
                setcookie("user_id", Session::get('user_id'), time() + (10 * 365 * 24 * 60 * 60));
                setcookie("user_username", Session::get('user_username'), time() + (10 * 365 * 24 * 60 * 60));
            } else {
                setcookie("user_id", "");
                setcookie("user_username", "");
            }

            redirect('login');
        }

        public function logout()
        {
            $this->render('logout');
        }
    }