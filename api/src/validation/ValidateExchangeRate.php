<?php

class ValidateExchangeRate
{

    /**
     *
     * Validate request for converter
     *
     * @param $to
     * @param $from
     * @param $price
     * @return int
     */
    public static function validateConverter($to, $from, $price): int
    {
        $validator = 0;

        if (!is_numeric($price)) {
            $validator = 1;
        }

        if (!ctype_alpha($from) || !ctype_alpha($to)) {
            $validator = 1;
        }

        if ($from == $to) {
            $validator = 1;
        }

        return $validator;
    }

    /**
     * Validate currency value
     *
     * @param $value
     * @param $data
     * @return int
     */
    public static function validateCurrencyValue($value, $data)
    {
        $validator = 0;

        if (is_numeric($value) || ctype_alnum($value)) {
            return 1;
        }

        $value = strtoupper($value);
        foreach ($data as $rate) {
            if ($value == $rate['oznaka']) {
                $validator = 1;
                break;
            }
        }

        return $validator;
    }

}