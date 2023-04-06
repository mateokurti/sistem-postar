<?php

namespace App\Models;

use PDO;

class _BaseModel
{
    protected $pdo;
    protected $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBy($column, $value)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}