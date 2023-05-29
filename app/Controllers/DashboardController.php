<?php

namespace App\Controllers;

use App\Models\Identity;
use App\Models\Address;
use PDO;

class DashboardController extends _BaseController
{
    private $identity;
    private $address;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
        $this->address = new Address($pdo);
    }

    public function index()
    {
        $identityId = $_SESSION['identity_id'];
        $identity = $this->identity->getById($identityId);
        $identity['address'] = $this->address->getByIdentityId($identityId);

        // Render the dashboard view
        $this->view('dashboard/index', ['identity' => $identity]);
    }
}