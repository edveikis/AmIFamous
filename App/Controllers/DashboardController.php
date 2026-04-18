<?php

namespace App\Controllers;

use Error;
use Framework\Database;

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

    public function import($params)
    {
        $importsPath = basePath('storage/breaches/imports/');
        $filename = isset($params['file']) ? $params['file'] : null;

        if (!$filename) {
            return ErrorController::notFound('Filename is missing');
        }

        // Strip any directory components entirely
        $filename = basename($filename);

        // Resolve the real path and confirm it stays inside importsPath
        $fullPath = realpath($importsPath . $filename);
        $allowedBase = realpath($importsPath);

        if (!$fullPath || !str_starts_with($fullPath, $allowedBase)) {
            return ErrorController::notFound('File not found');
        }

        loadView('dashboard/show', ['file_name' => $filename]);
    }

    public function add()
    {

        // TODO: sanitize user data
        inspectAndDie($_POST);
    }
}
