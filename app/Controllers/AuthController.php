<?php

namespace App\Controllers;

use PDO;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\Identity;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends _BaseController
{
    protected $identity;
    protected $google_client;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
        $this->google_client = new Google_Client();

        $this->google_client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $this->google_client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $this->google_client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $this->google_client->addScope("email");
        $this->google_client->addScope("profile");
    }

    public function getAuthenticatedIdentity()
    {
        if (isset($_SESSION['identity_id'])) {
            return $this->identity->getById($_SESSION['identity_id']);
        }

        return null;
    }

    public function showLogInForm()
    {
        $this->view('auth/index', ['googleAuthUrl' => $this->google_client->createAuthUrl()]);
    }

    public function googleLogIn()
    {
        $code = $_GET['code'];
        if (empty($code)) {
            $this->redirect('/login');
        }

        // authenticate code from Google OAuth Flow 
        $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET['code']);
        $this->google_client->setAccessToken($token['access_token']);

        // get profile info 
        $google_oauth = new Google_Service_Oauth2($this->google_client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $first_name = $google_account_info->given_name;
        $last_name = $google_account_info->family_name;


        $identity = $this->identity->getByEmail($email);

        if ($identity) {
            $_SESSION['identity_id'] = $identity['id'];

            $this->redirect('/dashboard');
        }

        $hashedPassword = password_hash(bin2hex(random_bytes(20)), PASSWORD_DEFAULT);

        $identity = $this->identity->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashedPassword,
            'identity_type' => 'user'
        ]);

        $_SESSION['identity_id'] = $identity['id'];

        $this->redirect('/dashboard');
    }

    public function signIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->flash('error', 'Please enter your email and password.');
            $this->redirect('/login');
        }

        // Check if the identity exists in the database
        $identity = $this->identity->getByEmail($email);

        if (!$identity || !password_verify($password, $identity['password'])) {
            $this->flash('error', 'Incorrect email or password.');
            $this->redirect('/login');
        }

        $_SESSION['identity_id'] = $identity['id'];

        $this->redirect('/dashboard');
    }

    public function signUp()
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $identity_type = $_POST['identity_type'];

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
            $this->flash('error', 'Please enter your name, email, and password.');
            $this->redirect('/auth/signup');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flash('error', 'Please enter a valid email.');
            $this->redirect('/auth/signup');
        }

        $identity = $this->identity->getByEmail($email);

        if ($identity) {
            $this->flash('error', 'This email is already in use.');
            $this->redirect('/auth/signup');
        }

        if (!preg_match('/^[a-zA-Z]+$/', $first_name) || !preg_match('/^[a-zA-Z]+$/', $last_name)) {
            $this->flash('error', 'Please enter a valid name.');
            $this->redirect('/auth/signup');
        }

        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
            $this->flash('error', 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.');
            $this->redirect('/auth/signup');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $identity = $this->identity->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashedPassword,
            'identity_type' => 'user',
        ]);

        $_SESSION['identity_id'] = $identity['id'];

        $this->redirect('/dashboard');
    }

    public function logOut()
    {
        unset($_SESSION['identity_id']);
        $this->redirect('/auth/login');
    }

    public function resetPassword()
    {
        $email = $_POST['email']; 

        // $identity = $this->identity->getByEmail($email);

        // if (!$identity) {
        //     $this->flash('error', 'User with that email not found!');
        //     $this->redirect('auth/reset-password');
        // }
        //
        $code = $this->identity->createResetCode($email);

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        // Server settings
        // Enable verbose debug output
        $mail->SMTPDebug = 2; 
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'postafshnverify@gmail.com';
        $mail->Password   = 'jzqn xlgz vuba gnup';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
    
        //Recipients
        $mail->setFrom('postafshn@gmail.com', 'PostaFSHN');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true); 
        $mail->Subject  = 'Test Email';
        $reset_link     = sprintf('http://localhost:8000/auth/reset-password/confirm?email=%s&code=%s', $email, $code);
        $mail->Body     = "Reset Password: " . $reset_link; 

        $mail->send();

        $this->flash('success', 'Please check the email address for instructions to reset your password.');
        $this->redirect('/auth/reset-password');
    }

    public function setNewPassword() {
        $email      =   $_POST['email']; 
        $code       =   $_POST['code'];
        $password   =   $_POST['password'];

        $valid_code = $this->identity->isValidResetCode($email, $code);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        if($valid_code){
            $this->flash('success', 'Password reset successfully!');
            $this->identity->setPassword($email, $hashedPassword);
        }
        $this->redirect('/auth/login');
    }
}
