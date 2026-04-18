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
        $filename = isset($params['file']) ? urldecode($params['file']) : null;

        if (!$filename) {
            return ErrorController::notFound('Filename is missing');
        }

        if (file_exists($importsPath . $filename)) {
            loadView('dashboard/show', ['file_name' => $filename]);
        } else {
            ErrorController::notFound('Filt not found or filename is null');
        }
    }

    public function add()
    {

        // TODO: sanitize user data
        inspectAndDie($_POST);
    }
}
