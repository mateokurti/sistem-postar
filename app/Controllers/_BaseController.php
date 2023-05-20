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

    protected function flash($type, $message, $form = null)
    {
        $_SESSION['flash'][$type] = [
            'message' => $message,
            'form' => $form != null ? $form : $_SERVER['REQUEST_URI']
        ];
    }

    protected function redirect($url)
    {
        $sanitized_url = filter_var($url, FILTER_SANITIZE_URL);
        header("Location: $sanitized_url");
        exit;
    }
}
