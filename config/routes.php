<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$router->get('sign-in', 'AuthController@showSignInForm', [GuestMiddleware::class]);
$router->post('sign-in', 'AuthController@signIn', [GuestMiddleware::class]);
$router->post('sign-up', 'AuthController@signUp', [GuestMiddleware::class]);
$router->get('sign-out', 'AuthController@signOut', [AuthMiddleware::class]);

$router->get('dashboard', 'DashboardController@index', [AuthMiddleware::class]);

$router->get('oauth/google', 'AuthController@googleSignIn', [GuestMiddleware::class]);
