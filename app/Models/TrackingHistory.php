<?php

namespace App\Models;


class TrackingHistory extends _BaseModel
{
    protected $table = 'tracking_history';

    public function getByDeliveryId($delivery_id)
    {
        return $this->getAllBy('delivery_id', $delivery_id);
    }
    
    public function create($data) {
        $data = $this->sanitizeArray($data);
        $sql = "INSERT INTO tracking_history (delivery_id, holder_id, description, status, created_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['delivery_id'], $data['holder_id'], $data['description'], $data['status'],  $data['created_at']]);
        return $this->getById($this->pdo->lastInsertId());
    }
}
