<?php

namespace App\Controllers;

use App\Models\Identity;
use PDO;

class DeliveryController extends _BaseController
{
    private $identity;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
    }

    public function index()
    {
        $identityId = $_SESSION['identity_id'];
        $identity = $this->identity->getById($identityId);

        // Render the deliveries view
        $this->view('deliveries/index', ['identity' => $identity]);
    }
}