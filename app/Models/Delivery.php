<?php

namespace App\Models;

use PDO;

class Delivery extends _BaseModel
{
    protected $table = 'deliveries';

    public function getAll() {
        $sql = "select *, CONCAT(i.first_name, ' ', i.last_name) as resposible_person_name, d.id as id from deliveries d join identities i";;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (recipient_name, city, address, zip, phone, notes, status, responsible_identity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['recipient_name'], $data['city'], $data['address'], $data['zip'], $data['phone'], $data['notes'], $data['status'], $data['responsible_identity']]);
        return $this->getById($this->pdo->lastInsertId());
    }
    
    public function update($data)
    {
        $sql = "INSERT {$this->table} SET recipient_name = ?,  city = ?,  address = ?,  zip = ?,  phone = ?, notes = ?, status = ?, responsible_identity = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['recipient_name'], $data['city'], $data['address'], $data['zip'], $data['phone'], $data['notes'], $data['status'], $data['responsible_identity'], $data['id']]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
