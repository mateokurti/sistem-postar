<?php

namespace App\Core;

class Router
{
    protected $pdo;
    public $routes = [
        'GET' => [],
        'POST' => []
    ];


    public static function load($pdo, $file)
    {
        $router = new static;
        $router->pdo = $pdo;
        require __DIR__ . '/../../config/' . $file;
        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        http_response_code(404);
        echo '404 Not Found';
        exit;
    }

    protected function callAction($controller, $action)
    {
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