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

    public function getByHolderId($holderId) {
        $sql = "SELECT * FROM {$this->table} WHERE holder_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$holderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($identityId) {
        $sql = "SELECT DISTINCT * FROM {$this->table} WHERE sender_id = :identityId or recipient_id = :identityId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':identityId', $identityId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $data = $this->sanitizeArray($data);
        $sql = "INSERT INTO {$this->table} (sender_id, recipient_id, holder_id, notes, address_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['sender_id'], $data['recipient_id'], $data['holder_id'], $data['notes'], $data['address_id']
        ]);
        $delivery = $this->getById($this->pdo->lastInsertId());
        $tracking_number = str_pad($delivery['id'], 10, "0", STR_PAD_LEFT);
        $this->pdo->prepare("UPDATE {$this->table} SET tracking_number = ? WHERE id = ?")->execute([$tracking_number, $delivery['id'],]);
        return $this->getById($delivery['id']);
    }

    public function update($data)
    {
        $data = $this->sanitizeArray($data);
        $sql = "INSERT {$this->table} SET recipient_id = ?,  notes = ?,  address_id = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['recipient_name'], $data['notes'], $data['address_id']]);
    }

    public function delete($id) {
        $id = $this->sanitize($id);
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
