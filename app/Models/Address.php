<?php

namespace App\Models;


class Address extends _BaseModel
{
    protected $table = 'addresses';

    public function getByIdentityId($identityId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE identity_id = ? LIMIT 1");
        $stmt->execute([$identityId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $data = $this->sanitizeArray($data);
        $sql = "INSERT INTO {$this->table} (identity_id, street, city, zip) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['identity_id'], $data['street'], $data['city'], $data['zip']]);
        return $this->getById($this->pdo->lastInsertId());
    }
}
