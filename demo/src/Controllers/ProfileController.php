<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Core\Session;
    use App\Core\Request;
    use App\Core\Validator;
    use App\Models\Profile;

    class ProfileController extends Controller
    {
        public function index()
        {
            redirectIfNotLoggedIn('');

            $userData = Profile::find("id", Session::get("user_id"));

            $this->render("profile", ["userData" => $userData]);
        }

        public function store()
        {
            $errors = [];

            $userData = Profile::find("id", Session::get('user_id'));

            // file
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['file'];

                if ($file['size'] > 5000000) {
                    $errors['file']['size'] = 'File is too big';
                }

                $allowed = ['image/jpg', 'image/jpeg', 'image/png'];
                if (!in_array($file['type'], $allowed)) {
                    $errors['file']['type'] = 'File must be type jpg or jpeg or png';
                }
            }

            // username
            if (!empty(Request::input('username'))) {
                $username = Request::input('username');
                $res = Profile::find('username', $username);

                if (!Validator::string($username, 3, 20)) {
                    $errors['username'] = 'Username must be between 3 and 20 characters';
                }

                if ($res) {
                    $errors['username'] = 'This username is already used';
                }
            }

            // email
            if (!empty(Request::input('email'))) {
                $email = Request::input('email');
                $res = Profile::find('email', $email);

                if (!Validator::email($email)) {
                    $errors['email'] = 'Your email is not well formed';
                }

                if ($res) {
                    $errors['email'] = 'This email is already used';
                }
            }

            // password
            if (empty(Request::input('password'))) {
                $errors['password'] = 'Password field is required';

            } else if (!password_verify(Request::input('password'), $userData['password'])) {
                $errors['password'] = 'Wrong password';
            }

            if (!empty($errors)) {
                Session::flash('errors', $errors);
                Session::flash('old', Request::all());
                redirect('profile');
            }

            // changes
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $target_dir = __DIR__ . '/../../public/assets/uploads/';
                $target_file = $target_dir . $file['name'];

                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    Profile::change('image', $file['name'], Session::get('user_id'));
                }
            }

            if (!empty(Request::input('username'))) {
                Profile::change("username", Request::input("username"), Session::get('user_id'));
                Session::put('user_username', Request::input('username'));
            }

            if (!empty(Request::input('email'))) {
                Profile::change("email", Request::input("email"), Session::get('user_id'));
            }

            Session::flash('success', 'You have successfully updated your profile');

            redirect('profile');

        }
    }
