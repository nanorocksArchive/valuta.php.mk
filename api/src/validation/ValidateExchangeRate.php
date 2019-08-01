<?php

class ValidateExchangeRate{

    /**
     * Validate request for converter
     */
    public static function validateConverter($to, $from, $price) : int
    {
        $validator = 0;

        if(!is_numeric($price))
        {
            $validator = 1;
        }

        if(!ctype_alpha($from) || !ctype_alpha($to))
        {
            $validator = 1;
        }

        if($from == $to)
        {
            $validator = 1;
        }

        return $validator;
    }

}