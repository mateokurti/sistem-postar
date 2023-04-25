<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$router->get('', '', [AuthMiddleware::class, GuestMiddleware::class]);


// Auth routes
$router->get('auth/login', 'AuthController@showLogInForm', [GuestMiddleware::class]);
$router->get('auth/signup', 'AuthController@showLogInForm', [GuestMiddleware::class]);
$router->get('auth/reset-password', 'AuthController@showLogInForm', [GuestMiddleware::class]);
$router->get('auth/reset-password/confirm', 'AuthController@showLogInForm', [GuestMiddleware::class]);

$router->post('auth/login', 'AuthController@signIn', [GuestMiddleware::class]);
$router->post('auth/signup', 'AuthController@signUp', [GuestMiddleware::class]);
$router->post('auth/reset-password', 'AuthController@resetPassword', [GuestMiddleware::class]);
$router->post('auth/reset-password/confirm', 'AuthController@setNewPassword', [GuestMiddleware::class]);
$router->get('auth/logout', 'AuthController@logOut', [AuthMiddleware::class]);
$router->get('oauth/google', 'AuthController@googleLogIn', [GuestMiddleware::class]);


// Redirect wrong routes (e.g. /login) to the correct ones (e.g. /auth/login)
$router->get('login', function () {
    header('Location: /auth/login');
}, [GuestMiddleware::class]);

$router->get('signup', function () {
    header('Location: /auth/signup');
}, [GuestMiddleware::class]);

$router->get('reset-password', function () {
    header('Location: /auth/reset-password');
}, [GuestMiddleware::class]);

$router->get('logout', function () {
    header('Location: /auth/logout');
}, [GuestMiddleware::class]);


$router->get('dashboard', 'DashboardController@index', [AuthMiddleware::class]);
$router->get('deliveries', 'DeliveryController@index', [AuthMiddleware::class]);
$router->get('deliveries/create', 'DeliveryController@showCreateForm', [AuthMiddleware::class]);
$router->post('deliveries/create', 'DeliveryController@create', [AuthMiddleware::class]);
