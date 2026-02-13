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
           $errors = Validator::validate([
                'file' => ['image'],
                'username' => ['min:3', 'max:20', 'unique:users,username'],
                'email' => ['email', 'unique:users,email'],
                'password' => ['password', 'min:3', 'required'],
            ]);


            if (!empty($errors)) {
                Session::flash('errors', $errors);
                Session::flash('old', Request::all());
                redirect('profile');
            }

            // changes
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['file'];
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
