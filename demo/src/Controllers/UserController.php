<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Models\User;
    use App\Core\Request;

    class UserController extends Controller
    {
        public function index()
        {
            $userData = User::all(Request::input('id'));

            $this->render("user", ['userData' => $userData]);
        }
    }