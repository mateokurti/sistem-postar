<?php

namespace App\Core;

use App\Controllers\AuthController;

class Router
{
    protected $pdo;
    protected $auth;
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($pdo, $file)
    {
        $auth = new AuthController($pdo);

        $router = new static;
        $router->pdo = $pdo;
        $router->auth = $auth;
        require __DIR__ . '/../../config/' . $file;
        return $router;
    }

    public function get($uri, $controller, $middleware = [])
    {
        $this->routes['GET'][$uri]['controller'] = $controller;
        $this->routes['GET'][$uri]['middleware'] = $middleware;
    }

    public function post($uri, $controller, $middleware = [])
    {
        $this->routes['POST'][$uri]['controller'] = $controller;
        $this->routes['POST'][$uri]['middleware'] = $middleware;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            $handler = $this->routes[$requestType][$uri]['controller'];
            $middleware = $this->routes[$requestType][$uri]['middleware'];

            foreach ($middleware as $m) {
                $m = new $m($this->auth);
                $m();
            }

            return $this->callAction($handler);
        }

        http_response_code(404);
        echo '404 Not Found';
        exit;
    }

    protected function callAction($handler)
    {
        [$controller, $action] = explode('@', $handler);

        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller($this->pdo);

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            echo '404 Not Found';
            exit;
        }

        return $controller->$action();
    }
}