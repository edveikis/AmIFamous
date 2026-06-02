<?php

namespace Framework\Import;

use RuntimeException;
use Framework\Session;

class ImportDispatcher
{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function import($fullPath, $fields)
    {
        $extension = pathinfo($fullPath, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'csv':
                $importer = new CSVImporter($this->db);
                $importer->import($fullPath, $fields);
                Session::setFlashMessage('success_message', 'Database imported successfully');
                break;
            default:
                Session::setFlashMessage('error_message', 'File type ' . $extension . ' not supported');
                break;
        }

        $this->archive($fullPath);
    }

    public function archive($fullPath)
    {
        $archivePath = basePath('storage/breaches/archive/') . basename($fullPath);
        rename($fullPath, $archivePath);
    }
}
