<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function login()
    {
        return loadView('login');
    }

    public function logout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }

    public function authenticate()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 chars';
        }

        if (!empty($errors)) {
            loadView('login', ['errors' => $errors]);
            exit;
        }

        $user = $this->db->query('SELECT * FROM admins WHERE email = :email', [
            'email' => $email,
        ])->fetch();

        if (!$user) {
            $errors['email'] = 'Incorrect credentials';
            loadView('login', ['errors' => $errors]);
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            $errors['email'] = 'Incorrect credentials';
            loadView('login', ['errors' => $errors]);
            exit;
        }

        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ]);

        redirect('/');
    }
}
