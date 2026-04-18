<?php

namespace Framework\Import;

use Framework\Database;

class CSVImporter
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
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

            $known = array_flip([$fields['email'], $fields['username'], $fields['password']]);
            $rawData = array_diff_key($line, $known);

            $this->db->query(
                "INSERT INTO breach_records(breach_id, email, username, password, raw_data_json) VALUES(:breach_id, :email, :username, :password, :raw_data_json)",
                [
                    'breach_id' => $breachID,
                    'email' => $line[$fields['email']],
                    'username' => $line[$fields['username']],
                    'password' => $line[$fields['password']],
                    'raw_data_json' => json_encode($rawData),

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

        fclose($file);
    }
}
