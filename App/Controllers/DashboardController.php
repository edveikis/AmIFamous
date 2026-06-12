<?php

namespace App\Controllers;

use Error;
use Exception;
use Framework\Database;
use Framework\Import\ImportDispatcher;
use Framework\Session;

class DashboardController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        $importsPath = basePath('storage/breaches/imports/');
        $importFiles = array_diff(scandir($importsPath), ['.', '..']);

        $importedDatabasesCount = $this->db->query('SELECT COUNT(*) AS total FROM breaches')->fetchColumn();
        $importedRecordsCount = $this->db->query('SELECT COUNT(*) AS total FROM breach_records')->fetchColumn();
        $lastImportDate = $this->db->query('SELECT MAX(created_at) AS last_import FROM breaches')->fetchColumn();

        loadView(
            'dashboard/index',
            [
                'import_files' => $importFiles,
                'imported_db_count' => $importedDatabasesCount,
                'imported_records_count' => $importedRecordsCount,
                'imported_last_date' => $lastImportDate
            ]
        );
    }

    public function importForm($params)
    {
        $importsPath = basePath('storage/breaches/imports/');
        $fileName = isset($params['file']) ? $params['file'] : null;

        if (!$fileName) {
            Session::setFlashMessage('error_message', 'Filename missing');
            redirect('/dashboard');
            exit;
        }

        // Strip any directory components entirely
        $fileName = basename($fileName);

        // Resolve the real path and confirm it stays inside importsPath
        $fullPath = realpath($importsPath . $fileName);
        $allowedBase = realpath($importsPath);

        if (!$fullPath || !str_starts_with($fullPath, $allowedBase)) {
            Session::setFlashMessage('error_message', 'Wrong file path: ' . $fullPath);
            redirect('/dashboard');
            exit;
        }

        loadView('dashboard/show', ['file_name' => $fileName]);
    }

    public function add()
    {
        // No execution time limit for request. Runs as long as it needs to
        set_time_limit(0);

        $importsPath = basePath('storage/breaches/imports/');
        $fileName = isset($_POST['file']) ? $_POST['file'] : null;
        $email = isset($_POST['email_field']) ? $_POST['email_field'] : null;
        $password = isset($_POST['password_field']) ? $_POST['password_field'] : null;
        $username = isset($_POST['username_field']) ? $_POST['username_field'] : null;
        $breachName = isset($_POST['breach_name']) ? $_POST['breach_name'] : null;

        $errors = [];

        if (!$fileName) {
            $errors['file'] = 'Filename was not set';
        }

        // email and breachName are required for the webapp to work
        if (!$email) {
            $errors['email'] = 'Email field is required';
        }

        if (!$breachName) {
            $errors['name'] = 'Breach name is requied';
        }

        if (!empty($errors)) {
            loadView('dashboard/show', ['file_name' => $fileName, 'errors' => $errors]);
            exit;
        }

        // Strip any directory components entirely
        $fileName = basename($fileName);

        // Resolve the real path and confirm it stays inside importsPath
        $fullPath = realpath($importsPath . $fileName);
        $allowedBase = realpath($importsPath);

        if (!$fullPath || !str_starts_with($fullPath, $allowedBase)) {
            Session::setFlashMessage('error_message', 'File not found: ' . $fullPath);
            redirect('/dashboard');
            exit;
        }

        $importer = new ImportDispatcher($this->db);
        try {

            $importer->import(
                $fullPath,
                [
                    'email' => $email,
                    'password' => $password,
                    'username' => $username,
                    'name' => $breachName,
                    'file_name' => $fileName,
                ]
            );
            Session::setFlashMessage('success_message', 'Database imported successfully');
        } catch (Exception $e) {
            Session::setFlashMessage('error_message', $e->getMessage());
        }

        redirect('/dashboard');
    }
}
