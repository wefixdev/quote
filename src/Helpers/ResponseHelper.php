<?php

namespace Quote\Helpers;

class ResponseHelper
{
    /**
     * Transforms a JSON string to an array.
     *
     * @param string $string
     *
     * @return array
     * @throws \RuntimeException
     *
     */
    public static function toArray(string $string): array
    {
        static $jsonErrors = [
            JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH - Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH - Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR - Unexpected control character found',
            JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX - Syntax error, malformed JSON',
            JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8 - Malformed UTF-8 characters, possibly incorrectly encoded',
        ];

        $data = json_decode($string, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            $last = json_last_error();

            throw new \RuntimeException(
                'Unable to parse JSON data: ' .
                (isset($jsonErrors[$last]) ? $jsonErrors[$last] : 'Unknown error')
            );
        }

        return $data;
    }
}
