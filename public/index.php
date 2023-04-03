<?php
use App\Core\Request;
use App\Core\Router;

session_start();

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/init.php';

Router::load($pdo, 'routes.php')->direct(Request::uri(), Request::method());