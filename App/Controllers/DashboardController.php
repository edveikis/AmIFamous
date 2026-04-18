<?php

namespace App\Controllers;

use Error;
use Framework\Database;
use Framework\Import\CSVImporter;

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

        loadView(
            'dashboard/index',
            [
                'import_files' => $importFiles,
                'imported_db_count' => $importedDatabasesCount,
                'imported_records_count' => $importedRecordsCount
            ]
        );
    }

    public function importForm($params)
    {
        $importsPath = basePath('storage/breaches/imports/');
        $fileName = isset($params['file']) ? $params['file'] : null;

        if (!$fileName) {
            return ErrorController::notFound('Filename is missing');
        }

        // Strip any directory components entirely
        $fileName = basename($fileName);

        // Resolve the real path and confirm it stays inside importsPath
        $fullPath = realpath($importsPath . $fileName);
        $allowedBase = realpath($importsPath);

        if (!$fullPath || !str_starts_with($fullPath, $allowedBase)) {
            return ErrorController::notFound('File not found');
        }

        loadView('dashboard/show', ['file_name' => $fileName]);
    }

    public function add()
    {
        $importsPath = basePath('storage/breaches/imports/');
        $fileName = isset($_POST['file']) ? $_POST['file'] : null;
        $email = isset($_POST['email_field']) ? $_POST['email_field'] : null;
        $password = isset($_POST['password_field']) ? $_POST['password_field'] : null;
        $username = isset($_POST['username_field']) ? $_POST['username_field'] : null;
        $breachName = isset($_POST['breach_name']) ? $_POST['breach_name'] : null;

        if (!$fileName) {
            return ErrorController::notFound('Filename is missing');
        }

        // Strip any directory components entirely
        $fileName = basename($fileName);

        // Resolve the real path and confirm it stays inside importsPath
        $fullPath = realpath($importsPath . $fileName);
        $allowedBase = realpath($importsPath);

        if (!$fullPath || !str_starts_with($fullPath, $allowedBase)) {
            return ErrorController::notFound('File not found');
        }

        // email and breachName are required for the webapp to work
        if (!$email) {
            echo 'Email field is required';
            // redirect
            exit;
        }

        if (!$breachName) {
            echo 'Breach name is requied';
            // redirect
            exit;
        }

        $importer = new CSVImporter();
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
    }
}
