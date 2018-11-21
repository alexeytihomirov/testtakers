<?php

namespace App\Testtakers\Parsers;


class CsvParser implements ParserInterface
{
    public function parse($path): ?array
    {
        $fp = fopen($path, 'r');
        try {
            $fields = array_map(function ($field) {
                return trim(strtolower($field));
            }, fgetcsv($fp, null, ','));

            $values = [];
            while ($line = fgetcsv($fp, null, ',')) {
                $row = array_map(function ($field) {
                    return trim($field);
                }, $line);

                $values[] = array_combine($fields, $row);
            }
        } finally {
            fclose($fp);
        }

        return $values;
    }
}