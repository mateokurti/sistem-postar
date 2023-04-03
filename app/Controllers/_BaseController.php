<?php

namespace App\Controllers;

class _BaseController
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    protected function view($template, $data = [])
    {
        $data['viewTitle'] = $data['viewTitle'] ?? 'Sistemi Postar';
        $path = __DIR__ . '/../Views/' . $template . '.php';
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("Template {$template} not found");
        }
        extract($data);
        require $path;
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function flash($type, $message)
    {
        $_SESSION['flash'][$type] = $message;
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}