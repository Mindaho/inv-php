<?php

namespace App\Constants;

class Constants
{
    public const CURRENCY_VALIDATION_REGEX = '^[0-9]+\.[0-9]+$';

    public const CSV_DELIMITER = ';';
    public const CSV_MAX_LINE_LENGTH = '1024';
    public const CSV_HEADER_COUNT = 5;
}