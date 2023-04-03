<?php

namespace App\Controllers;

use PDO;
use App\Models\Identity;

class AuthController extends _BaseController
{
    protected $identity;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->identity = new Identity($pdo);
    }

    public function showLoginForm()
    {
        $this->view('auth/sign_in');
    }

    public function signIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->flash('error', 'Please enter your email and password.');
            $this->redirect('/sign-in');
        }

        // Check if the identity exists in the database
        $identity = $this->identity->getByEmail($email);

        if (!$identity || !password_verify($password, $identity['password'])) {
            $this->flash('error', 'Incorrect email or password.');
            $this->redirect('/sign-in');
        }

        $_SESSION['identity_id'] = $identity['id'];

        $this->redirect('/dashboard');
    }

    public function signUp()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($name) || empty($email) || empty($password)) {
            $this->flash('error', 'Please enter your name, email, and password.');
            $this->redirect('/');
        }

        $identity = $this->identity->getByEmail($email);

        if ($identity) {
            $this->flash('error', 'This email is already in use.');
            $this->redirect('/sign-up');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $identity = $this->identity->create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $_SESSION['identity_id'] = $identity['id'];

        $this->redirect('/dashboard');
    }

    public function signOut()
    {
        unset($_SESSION['identity_id']);

        $this->redirect('/sign-in');
    }
}