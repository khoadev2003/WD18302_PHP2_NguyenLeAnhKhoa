<?php

namespace App\Validator;

use DateTime;

class TicketValidator
{
    /**
     * @param $inputDateTime
     * @return bool
     * @throws \Exception
     */
    function isValidFutureDateTime($inputDateTime): bool {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDateTime = new DateTime();
        $inputDateTimeObject = new DateTime($inputDateTime);

        return $inputDateTimeObject->format('Y-m-d H:i:s') >= $currentDateTime->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    function pattern_datetime(): string {
        return '/^(\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])T(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9])$/';
    }
}