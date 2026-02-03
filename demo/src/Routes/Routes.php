<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\CommentsController;
use App\Controllers\Password_changeController;
use App\Controllers\ProfileController;
use App\Controllers\UserController;
use App\Controllers\Comment_managementController;
use App\Router;
use App\Core\Session;

Session::start();

$router = new Router();

$router->get('/demo/', HomeController::class, 'index');
$router->get('/demo/login', AuthController::class, 'index');
$router->get('/demo/register', AuthController::class, 'register');
$router->get('/demo/comments', CommentsController::class, 'index');
$router->get('/demo/logout', AuthController::class, 'logout');
$router->get('/demo/profile', ProfileController::class, 'index');
$router->get('/demo/user', UserController::class, 'index');
$router->get('/demo/passwordchange', Password_changeController::class, 'index');
$router->get('/demo/commentmanagement', Comment_managementController::class, 'index');

$router->post('/demo/register', AuthController::class, 'store');
$router->post('/demo/login', AuthController::class, 'login');
$router->post('/demo/comments/store', CommentsController::class, 'store');
$router->post('/demo/comments/delete', CommentsController::class, 'delete');
$router->post('/demo/profile', ProfileController::class, 'store');
$router->post('/demo/passwordchange', Password_changeController::class, 'change');
$router->post('/demo/commentmanagement/search', Comment_managementController::class, 'show');
$router->post('/demo/commentmanagement/delete', Comment_managementController::class, 'delete');
$router->post('/demo/commentmanagement/update', Comment_managementController::class, 'update');

$router->dispatch();