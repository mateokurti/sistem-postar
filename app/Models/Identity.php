<?php

namespace App\Models;


class Identity extends _BaseModel
{
    protected $table = 'identities';

    public function getByEmail($email)
    {
        return $this->getBy('email', $email);
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['first_name'], $data['last_name'], $data['email'], $data['password']]);
        return $this->getById($this->pdo->lastInsertId());
    }
}