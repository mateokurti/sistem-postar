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
        $email = $this->sanitize($email);
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
        $email = $this->sanitize($email);
        $now = date('Y-m-d H:i:s');
        $sql = "SELECT * from reset_codes WHERE email = ? AND code = ? AND expires_at > ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $code, $now]);

        return $stmt->rowCount() > 0;
    }

    public function setPassword($email, $password)
    {
        $email = $this->sanitize($email);
        $sql = "UPDATE identities SET password = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$password, $email]); 
    }

    public function createHolder($identity_id, $type) {
        $identity_id = $this->sanitize($identity_id);
        $type = $this->sanitize($type);
        if ($type == 'office') {
            $sql = "INSERT INTO package_holders (office_id, type) VALUES (?, ?)";
        } else {
            $sql = "INSERT INTO package_holders (identity_id, type) VALUES (?, ?)";
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$identity_id, $type]);
    }

    public function create($data)
    {
        $data = $this->sanitizeArray($data);
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, password, identity_type) VALUES (:first_name, :last_name, :email, :password, :identity_type)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':identity_type', $data['identity_type']);
        
        $stmt->execute();

        if ($data['identity_type'] == 'user' || $data['identity_type'] == 'courier') {
            $this->createHolder($this->pdo->lastInsertId(), $data['identity_type']);
        }

        return $this->getById($this->pdo->lastInsertId());
    }

    public function update($data) {
        $data = $this->sanitizeArray($data);
        $sql = "UPDATE {$this->table} SET email = ?, first_name = ?, last_name = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['email'], $data['first_name'], $data['last_name'], $data['id']]);
    }
}
