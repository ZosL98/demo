<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Core\Request;
    use App\Core\Database;
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
            $errors = Validator::validate([
                'username' => ['min:3', 'max:20', 'required', 'unique:users,username'],
                'email' => ['email', 'required', 'unique:users,email'],
                'password' => ['min:3', 'max:20', 'required', 'matches:password_confirm'],
                'password_confirm' => ['min:3', 'max:20', 'required', 'matches:password'],
            ]);

            if (!empty($errors)) {
                Session::flash('errors', $errors);
                Session::flash('old', Request::all());
                redirect('register');
            }

            $hashed = password_hash(Request::input('password'), PASSWORD_DEFAULT);

            Auth::store(Request::input('username'), Request::input('email'), $hashed);
            Session::flash('success', 'You have successfully registered');
            redirect('register');
        }


        public function login()
        {
            $errors = Validator::validate([
                'username' => ['min:3', 'max:20', 'required'],
                'password' => ['required'],
            ]);

            if (!empty($errors)) {
                Session::flash('old', Request::all());
                Session::flash('errors', $errors);
                redirect('login');
            }

            $res = Database::find("users", 'username', Request::input('username'));
            $password = trim(Request::input('password'));

            if (!$res || !password_verify($password, $res['password'])) {
                Session::flash('errors', ['password' => 'Wrong username or password.']);
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
