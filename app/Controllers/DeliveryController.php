<?php

namespace App\Controllers;

use App\Models\Delivery;
use App\Models\Identity;
use PDO;

class DeliveryController extends _BaseController
{
    private $identity;
    private $delivery;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
        $this->delivery = new Delivery($pdo);
    }

    public function index()
    {
        $identityId = $_SESSION['identity_id'];
        $identity = $this->identity->getById($identityId);

        $deliveries = $this->delivery->getAll(); 
        // Render the deliveries view
        $this->view('deliveries/index', ['identity' => $identity, 'deliveries' => $deliveries]);
    }
    
    public function showCreateForm() {
        $identityId = $_SESSION['identity_id'];
        $identity = $this->identity->getById($identityId);

        $this->view('deliveries/create', ['identity' => $identity]);
    }

    public function create() {
        $data = $_POST;

        if (!isset($_POST['notes'])) {
            $data['notes'] =  '';
        } 

        $identityId = $_SESSION['identity_id'];
        $data['responsible_identity'] = $identityId; 

        $this->delivery->create($data);
        $this->redirect('/deliveries');
    }
}
