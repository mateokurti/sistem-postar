<?php

namespace App\Middleware;

use App\Controllers\AuthController;

class GuestMiddleware
{
    private $auth;

    public function __construct(AuthController $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke()
    {
        if ($this->auth->getAuthenticatedIdentity()) {
            // Redirect to home page if user is logged in
            // header('Location: /dashboard');
            header('Location: /deliveries');
        }
    }
}