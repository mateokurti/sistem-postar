<?php

namespace App\Models;


class TrackingHistory extends _BaseModel
{
    protected $table = 'tracking_history';

    public function getByDeliveryId($delivery_id)
    {
        return $this->getAllBy('delivery_id', $delivery_id);
    }

    public function getLatestByDeliveryId($delivery_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE delivery_id = ? ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([$delivery_id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $data = $this->sanitizeArray($data);
        $sql = "INSERT INTO tracking_history (delivery_id, holder_id, description, status, created_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['delivery_id'], $data['holder_id'], $data['description'], $data['status'],  $data['created_at']]);
        return $this->getById($this->pdo->lastInsertId());
    }
}
