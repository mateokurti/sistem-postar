<?php

namespace App\Controllers;

use App\Models\Identity;
use App\Models\Delivery;
use App\Models\TrackingHistory;
use App\Models\PackageHolder;
use App\Controllers\DeliveryController;
use PDO;

class TrackingHistoryController extends _BaseController
{
    private $identity;
    private $delivery;
    private $trackingHistory;
    private $package_holder;
    private $deliveryController;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
        $this->delivery = new Delivery($pdo);

        $this->deliveryController = new DeliveryController($pdo);
    }

    public function tracking()
    {
        if (isset( $_GET['tracking_number'])) {
            $identity = null;
            
            if (isset($_SESSION['identity_id'])) {
                $identity = $this->identity->getById($_SESSION['identity_id']);
            }

            $delivery = $this->delivery->getByTrackingNumber($_GET['tracking_number']);
            $this->deliveryController->advancedDelivery($delivery, $identity);

            $this->view('tracking/index', ['identity' => $identity, 'delivery' => $delivery]);

        } else {
            $this->view('tracking/index');
        }
    }
}