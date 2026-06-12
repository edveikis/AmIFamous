<?php

namespace Framework\Import;

use Exception;
use Framework\Database;

class CSVImporter
{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function import($fullPath, $fields)
    {
        $file = fopen($fullPath, 'r');

        // Skips a BOM is present
        $bom = fread($file, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($file);
        }

        $header = ($line = fgetcsv($file));

        $this->db->conn->beginTransaction();

        try {
            $this->db->query(
                'INSERT INTO breaches(name, file_name) VALUES(:name, :file_name)',
                [
                    'name' => $fields['name'],
                    'file_name' => $fields['file_name']
                ]
            );

            $breachID = $this->db->conn->lastInsertId();
            $lineCount = 0;

            while (($line = fgetcsv($file)) !== FALSE) {
                $line = array_combine($header, $line);

                $known = array_flip([$fields['email'] ?? '', $fields['username'] ?? '', $fields['password'] ?? '']);
                $rawData = array_diff_key($line, $known);

                $this->db->query(
                    "INSERT INTO breach_records(breach_id, email, username, password, raw_data) VALUES(:breach_id, :email, :username, :password, :raw_data)",
                    [
                        'breach_id' => $breachID,
                        'email' => $line[$fields['email']],
                        'username' => $line[$fields['username']] ?? '',
                        'password' => $line[$fields['password']] ?? '',
                        'raw_data' => !empty($rawData) ? json_encode($rawData) : null,

                    ]
                );

                $lineCount++;
            }

            $this->db->query(
                'UPDATE breaches SET line_count=:line_count WHERE id=:id',
                [
                    'line_count' => $lineCount,
                    'id' => $breachID
                ]
            );
        } catch (Exception $e) {
            // if there is a failure db remains unchanged
            $this->db->conn->rollBack();
            fclose($file);
            throw $e;
        }

        fclose($file);
    }
}
