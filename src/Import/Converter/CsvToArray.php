<?php

namespace App\Import\Converter;

use App\Constants\Constants;

class CsvToArray implements ConverterInterface
{
    public function convert(string $fname): array
    {
        if (!($fp = fopen($fname, 'rb'))) {
            throw new \ErrorException('Could not locate the file');
        }

        $header = fgetcsv($fp, Constants::CSV_MAX_LINE_LENGTH, Constants::CSV_DELIMITER);

        if (count($header) !== Constants::CSV_HEADER_COUNT) {
            throw new \ErrorException('Missing csv headers');
        }

        $array = [];
        while ($row = fgetcsv($fp, Constants::CSV_MAX_LINE_LENGTH, Constants::CSV_DELIMITER)) {
            if (count($row) !== Constants::CSV_HEADER_COUNT) {
                continue;
            }

            $array[] = array_combine($header, $row);
        }


        fclose($fp);

        return $array;
    }
}