<?php

namespace App\Controllers;

use PDO;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\Identity;

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

    public function showSignInForm()
    {
        $this->view('auth/sign_in', ['googleAuthUrl' => $this->google_client->createAuthUrl()]);
    }

    public function googleSignIn()
    {
        $code = $_GET['code'];
        if (empty($code)) {
            $this->redirect('/signin');
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
            'password' => $hashedPassword
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
            $this->redirect('/signin');
        }

        // Check if the identity exists in the database
        $identity = $this->identity->getByEmail($email);

        if (!$identity || !password_verify($password, $identity['password'])) {
            $this->flash('error', 'Incorrect email or password.');
            $this->redirect('/signin');
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

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
            $this->flash('error', 'Please enter your name, email, and password.');
            $this->redirect('/');
        }

        $identity = $this->identity->getByEmail($email);

        if ($identity) {
            $this->flash('error', 'This email is already in use.');
            $this->redirect('/signup');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $identity = $this->identity->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $_SESSION['identity_id'] = $identity['id'];

        $this->redirect('/dashboard');
    }

    public function signOut()
    {
        unset($_SESSION['identity_id']);

        $this->redirect('/signin');
    }
}