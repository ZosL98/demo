<?php

use App\Core\Session;
use App\Core\Request;

function old($key)
{
    $old = Session::getFlash('old');

    return isset($old[$key]) ? htmlspecialchars($old[$key]) : null;
}

function urlIs($value) : bool
{
    return Request::uri() === $value;
}

function dd($value)
{
    echo "<pre>";
        var_dump($value);
    echo "</pre>";
}

function redirect($location)
{
    header("location: /demo/$location");
    exit;
}

function redirectIfNotLoggedIn($location)
{
    if (!Session::has('user_id')) {
        redirect($location);
    }
}

function logoutUser($location = 'login')
{
    Session::start();
    session_destroy();

    setcookie("user_id", "");
    setcookie("user_username", "");

    redirect($location);
}