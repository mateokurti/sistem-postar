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

    public function getByHolderId($holderId, $holderType) {
        // god forgive me for this query :(
        if ($holderType == 'courier') {
            $sql = "
            SELECT t1.*, t2.status FROM {$this->table} t1
            JOIN tracking_history t2 ON t1.id = t2.delivery_id
            JOIN (
                SELECT delivery_id, MAX(created_at) AS latest_created_at
                FROM tracking_history
                GROUP BY delivery_id
            ) t3 ON t2.delivery_id = t3.delivery_id AND t2.created_at = t3.latest_created_at
            WHERE t1.holder_id = ? OR t2.status = 'created' OR t2.status = 'accepted' OR t2.status = 'in_post_office'
            ";
        } else if ($holderType == 'office') {
            $sql = "
            SELECT t1.*, t2.status FROM {$this->table} t1
            JOIN tracking_history t2 ON t1.id = t2.delivery_id
            JOIN (
                SELECT delivery_id, MAX(created_at) AS latest_created_at
                FROM tracking_history
                GROUP BY delivery_id
            ) t3 ON t2.delivery_id = t3.delivery_id AND t2.created_at = t3.latest_created_at
            WHERE t1.office_id = ?
            ";
        } else {
            $sql = "SELECT * FROM {$this->table} WHERE holder_id = ?";
        }
        
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

    public function update($id, $data) {
        $data = $this->sanitizeArray($data);
        $sql = "UPDATE {$this->table} SET ";
        $sql .= isset($data['holder_id']) ? "holder_id = :holder_id, " : "";
        $sql .= isset($data['office_id']) ? "office_id = :office_id, " : "";
        $sql .= isset($data['notes']) ? "notes = :notes, " : "";
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if (isset($data['holder_id'])) $stmt->bindParam(':holder_id', $data['holder_id']);
        if (isset($data['office_id'])) $stmt->bindParam(':office_id', $data['office_id']);
        if (isset($data['notes'])) $stmt->bindParam(':notes', $data['notes']);
        $stmt->execute();
        return $this->getById($id);
    }

   
    public function delete($id) {
        $id = $this->sanitize($id);
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
