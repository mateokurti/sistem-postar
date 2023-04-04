<?php

namespace App\Middleware;

use App\Controllers\AuthController;

class AuthMiddleware
{
    private $auth;

    public function __construct(AuthController $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke()
    {
        if (!$this->auth->getAuthenticatedIdentity()) {
            // Redirect to login page if user is not logged in
            header('Location: /sign-in');
            exit;
        }
    }
}