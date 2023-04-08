<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$router->get('login', 'AuthController@showLogInForm', [GuestMiddleware::class]);
$router->post('login', 'AuthController@signIn', [GuestMiddleware::class]);
$router->post('signup', 'AuthController@signUp', [GuestMiddleware::class]);
$router->get('sign-out', 'AuthController@signOut', [AuthMiddleware::class]);

$router->get('dashboard', 'DashboardController@index', [AuthMiddleware::class]);

$router->get('oauth/google', 'AuthController@googleLogIn', [GuestMiddleware::class]);
