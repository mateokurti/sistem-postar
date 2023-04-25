<?php

namespace App\Models;


class Identity extends _BaseModel
{
    protected $table = 'identities';

    public function getByEmail($email)
    {
        return $this->getBy('email', $email);
    }

    public function createResetCode($email)
    {
        $code = sprintf("%06d", mt_rand(1, 999999));
        $created_at = date('Y-m-d H:i:s');
        $expires_at = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($created_at)));

        $sql = "INSERT INTO reset_codes (email, code, created_at, expires_at) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $code, $created_at, $expires_at]);         
        
        return $code;
    }

    public function isValidResetCode($email, $code)
    {
        $now = date('Y-m-d H:i:s');
        $sql = "SELECT * from reset_codes WHERE email = ? AND code = ? AND expires_at > ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $code, $now]);

        return $stmt->rowCount() > 0;
    }

    public function setPassword($email, $password)
    {
        $sql = "UPDATE identities SET password = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$password, $email]); 
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, password, account_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['first_name'], $data['last_name'], $data['email'], $data['password'], $data['account_type']]);
        return $this->getById($this->pdo->lastInsertId());
    }
}
