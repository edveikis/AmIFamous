<?php

namespace Framework\Import;

use Exception;
use RuntimeException;
use Framework\Session;

use function PHPSTORM_META\expectedArguments;

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
                try {
                    $importer->import($fullPath, $fields);
                } catch (Exception $e) {
                    throw new Exception('Import failed: ' . $e->getMessage());
                }
                break;
            default:
                throw new Exception('Unsupported file format');
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
