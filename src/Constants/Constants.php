<?php

namespace App\Constants;

/**
 * We can define the most important constants for the use in the system.
 */
class Constants
{
    public const CURRENCY_VALIDATION_REGEX = '/^[0-9]+\.[0-9]+$/';

    // Define how many decimals we want after the dot. Round up is still missing, which would come quite in handy in some points.
    public const CURRENCY_SCALE = 2;

    // We can simply add more supported currencies here:
    public const SUPPORTED_CURRENCIES = ['EUR', 'USD', 'GBP'];

    public const EXCHANGE_DEFAULT_CURRENCY = 'EUR';

    public const FIXED_EXCHANGE = [
        'EUR' => [
            'USD' => '1.14',
            'GBP' => '0.88',
        ]
    ];

    public const CSV_DELIMITER = ';';
    public const CSV_MAX_LINE_LENGTH = '1024';
    public const CSV_HEADER_COUNT = 5;


}