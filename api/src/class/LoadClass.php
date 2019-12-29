<?php

class LoadClass extends ExchangeRateHelper
{

    /**
     * On load static content
     */
    public static function onload()
    {
        return Flight::render('form.php', array('endpoints' => self::$apiEndpoints));
    }

}