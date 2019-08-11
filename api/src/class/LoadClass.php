<?php

class LoadClass extends ExchangeRateHelper
{

    /**
     * On load static content
     */
    public static function onload()
    {
        return Flight::render('index.php', array('endpoints' => self::$apiEndpoints));
    }

}