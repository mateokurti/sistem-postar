<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$router->get('signin', 'AuthController@showSignInForm', [GuestMiddleware::class]);
$router->post('signin', 'AuthController@signIn', [GuestMiddleware::class]);
$router->post('signup', 'AuthController@signUp', [GuestMiddleware::class]);
$router->get('sign-out', 'AuthController@signOut', [AuthMiddleware::class]);

$router->get('dashboard', 'DashboardController@index', [AuthMiddleware::class]);

$router->get('oauth/google', 'AuthController@googleSignIn', [GuestMiddleware::class]);
