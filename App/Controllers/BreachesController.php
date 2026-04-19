<?php

namespace App\Controllers;

use Framework\Database;

class BreachesController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function getBreaches()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : null;

        if (!$email || empty($email)) {
            redirect('/');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // TODO: error message
            echo "Invalid email format";
            exit;
        }

        $breaches = $this->db->query(
            "SELECT 
            b.name AS breach_name,
            br.email,
            br.username,
            br.password,
            br.raw_data_json
        FROM breach_records br
        JOIN breaches b ON br.breach_id = b.id
        WHERE br.email = :email",
            ['email' => $email]
        )->fetchAll();

        loadView('breaches', [
            'breaches' => $breaches,
            'email' => $email,
            'breach_count' => count($breaches)
        ]);
    }
}
