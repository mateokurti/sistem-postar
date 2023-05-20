<?php

namespace App\Controllers;

use App\Models\Delivery;
use App\Models\Identity;
use App\Models\PackageHolder;
use App\Models\Employee;
use App\Models\Address;
use App\Models\Office;
use App\Models\TrackingHistory;
use PDO;

class DeliveryController extends _BaseController
{
    private $identity;
    private $delivery;
    private $package_holder;
    private $employee;
    private $address;
    private $office;
    private $tracking_history;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
        $this->delivery = new Delivery($pdo);
        $this->package_holder = new PackageHolder($pdo);
        $this->employee = new Employee($pdo);
        $this->address = new Address($pdo);
        $this->office = new Office($pdo);
        $this->tracking_history = new TrackingHistory($pdo);
    }

    public function index()
    {
        $identityId = $_SESSION['identity_id'];
        $identity = $this->identity->getById($identityId);

        switch ($identity['identity_type']) {
            case 'admin':
                $deliveries = $this->delivery->getAll();
                break;
            case 'courier':
                $deliveries = $this->delivery->getByHolderId(
                    $this->package_holder->getByIdentityId($identityId)['id'], 'courier'
                );
                break;
            case 'employee':
                $deliveries = $this->delivery->getByHolderId(
                    $this->package_holder->getByOfficeId(
                        $this->employee->getByIdentityId($identityId)['office_id'], 'office'
                    )['id']
                );
                break;
            case 'user':
                $deliveries = $this->delivery->getByUser($identityId);
                break;
            default:
                $deliveries = $this->delivery->getByUser($identityId);
                break;
        }

        foreach ($deliveries as &$delivery) {
            $delivery['sender'] = $this->identity->getById($delivery['sender_id']);
            $delivery['recipient'] = $this->identity->getById($delivery['recipient_id']);
            $delivery['address'] = $this->address->getById($delivery['address_id']);

            $holder = $this->package_holder->getById($delivery['holder_id']);
            if ($holder['type'] == 'office') {
                $delivery['holder'] = $this->office->getById($holder['office_id']);
                $delivery['holder']['title'] = $delivery['holder']['name'];
                $delivery['holder']['subtitle'] = 'Pakoja në zyrë postare';

            } else if ($holder['type'] == 'courier') {
                $delivery['holder'] = $this->identity->getById($holder['identity_id']);
                $delivery['holder']['title'] = $delivery['holder']['first_name'] . ' ' . $delivery['holder']['last_name'];
                $delivery['holder']['subtitle'] = 'Pakon e ka korrieri';
            } else {
                $delivery['holder'] = $this->identity->getById($holder['identity_id']);
                $delivery['holder']['title'] = $delivery['holder']['first_name'] . ' ' . $delivery['holder']['last_name'];

                if ($delivery['holder']['id'] == $identity['id']) {
                    $delivery['holder']['subtitle'] = 'Pakon e ke ti';
                } else if ($delivery['holder']['id'] == $delivery['sender']['id']) {
                    $delivery['holder']['subtitle'] = 'Pakon e ka ende dërguesi';
                } else if ($delivery['holder']['id'] == $delivery['recipient']['id']) {
                    $delivery['holder']['subtitle'] = 'Pakon e ka marrë marrësi';
                } else {
                    $delivery['holder']['subtitle'] = 'S\'ka informacion';
                }
            }
            $delivery['holder']['type'] = $holder['type'];
            $delivery['tracking_history'] = $this->tracking_history->getByDeliveryId($delivery['id']);

            foreach ($delivery['tracking_history'] as &$tracking_history) {
                $tracking_holder = $this->package_holder->getById($tracking_history['holder_id']);
                
                if ($tracking_holder['type'] == 'office') {
                    $tracking_history['holder'] = $this->office->getById($tracking_holder['office_id']);
                    $tracking_history['holder']['title'] = $tracking_history['holder']['name'];
                    $tracking_history['holder']['subtitle'] = 'Pakoja në zyrë postare';
                } else {
                    $tracking_history['holder'] = $this->identity->getById($tracking_holder['id']);
                    $tracking_history['holder']['title'] = $tracking_history['holder']['first_name'] . ' ' . $tracking_history['holder']['last_name'];

                    if ($tracking_history['holder']['id'] == $identity['id']) {
                        $tracking_history['holder']['subtitle'] = 'Pakon e ke ti';
                    } else if ($tracking_history['holder']['id'] == $delivery['sender']['id']) {
                        $tracking_history['holder']['subtitle'] = 'Pakon e ka ende dërguesi';
                    } else if ($tracking_history['holder']['id'] == $delivery['recipient']['id']) {
                        $tracking_history['holder']['subtitle'] = 'Pakon e ka marrë marrësi';
                    }
                }
                $tracking_history['holder']['type'] = $tracking_holder['type'];
            }

            $delivery['status'] = $this->tracking_history->getLatestByDeliveryId($delivery['id'])['status'];

            $status_messages = [
                'created' => [
                    'message' => 'Krijuar nga Përdoruesi',
                    'color' => 'purple',
                ],
                'accepted' => [
                    'message' => 'Pranuar nga Korrieri (në pritje të marrjes)',
                    'color' => 'orange',
                ],
                'picked_up' => [
                    'message' => 'Marrë nga Korrieri',
                    'color' => 'sky',
                ],
                'in_post_office' => [
                    'message' => 'Dërgesa është në Zyrën Postare',
                    'color' => 'blue',
                ],
                'out_for_delivery' => [
                    'message' => 'Dërgesa është në Rrugë për Dorëzim',
                    'color' => 'yellow',
                ],
                'delivered' => [
                    'message' => 'Dërgesa u Dorëzua',
                    'color' => 'green',
                ],
            ];

            $delivery['status_display'] = $status_messages[$delivery['status']];
        }

        // Render the deliveries view
        $this->view('deliveries/index', ['identity' => $identity, 'deliveries' => $deliveries]);
    }
    
    public function showCreateForm() {
        $identityId = $_SESSION['identity_id'];
        $identity = $this->identity->getById($identityId);

        $this->view('deliveries/create', ['identity' => $identity]);
    }

    public function accept() {
        $deliveryId = $_GET['delivery_id'];
        $identityId = $_SESSION['identity_id'];

        $this->tracking_history->create([
            'delivery_id' => $deliveryId,
            'holder_id' => $identityId,
            'description' => 'Dërgesa u morr nga korrieri',
            'status' => 'picked_up',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->delivery->update($deliveryId, [
            'holder_id' => $this->package_holder->getByIdentityId($identityId)['id'],
        ]);

        $this->redirect('/deliveries');
    }

    public function create() {
        $data = $_POST;

        $recipient = $this->identity->getByEmail($_POST['recipient_email']);
        
        if (!$recipient) {
            $recipient = $this->identity->create([
                'first_name' => $_POST['recipient_first_name'],
                'last_name' => $_POST['recipient_last_name'],
                'email' => $_POST['recipient_email'],
                'identity_type' => 'user',
                'status' => 0,
            ]);
        }

        $recipient_address = $this->address->getByIdentityId($recipient['id']);
        if (!$recipient_address) {
            $recipient_address = $this->address->create([
                'identity_id' => $recipient['id'],
                'city' => $_POST['recipient_address_city'],
                'street' => $_POST['recipient_address_street'],
                'zip' => $_POST['recipient_address_zip_code'],
            ]);
        }

        if (!isset($_POST['notes'])) {
            $data['notes'] =  '';
        } 

        $identityId = $_SESSION['identity_id'];
        $data['responsible_identity'] = $identityId; 

        $data = $this->delivery->create([
            'sender_id' => $identityId,
            'recipient_id' => $recipient['id'],
            'holder_id' => $identityId,
            'notes' => $data['notes'],
            'address_id' => $recipient_address['id'],
        ]);

        $this->tracking_history->create([
            'delivery_id' => $data['id'],
            'holder_id' => $identityId,
            'description' => 'Dërgesa u krijua',
            'status' => 'created',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->redirect('/deliveries');
    }
}
