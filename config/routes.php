<?php
$router->get('sign-in', 'AuthController@showLoginForm');
$router->post('sign-in', 'AuthController@signIn');
$router->post('sign-up', 'AuthController@signUp');
$router->get('sign-out', 'AuthController@signOut');

$router->get('dashboard', 'DashboardController@index');

$router->get('oauth/google', 'AuthController@googleSignIn');