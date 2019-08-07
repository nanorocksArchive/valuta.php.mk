<?php

class LoadClass extends ExchangeRateClass
{

    /**
     * On load static content
     */
    public static function onload()
    {
        Flight::render('index.php', array('endpoints' => self::$apiEndpoints));
    }

}