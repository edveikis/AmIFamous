<?php

namespace App\Controllers;

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
        $filename = $params['file'] ?? null;

        loadView('dashboard/show', ['file_name' => $filename]);
    }

    public function add()

    {
        inspectAndDie($_POST);
    }
}
