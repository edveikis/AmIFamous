<?php

namespace Framework\Import;

use RuntimeException;

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
                break;
            default:
                throw new RuntimeException("Unsupported file type: $extension");
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
