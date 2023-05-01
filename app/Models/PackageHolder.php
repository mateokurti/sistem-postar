<?php

namespace App\Models;


class PackageHolder extends _BaseModel
{
    protected $table = 'package_holders';

    public function getByIdentityId($identityId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE identity_id = ? and (type = 'user' or type = 'courier')");
        $stmt->execute([$identityId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByOfficeId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE office_id = ? and type = 'office'");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
