<?php

class LoadExchangeRateClassHelper extends MainClass
{

    /**
     * On load static content
     */
    public static function onload()
    {
        echo "<pre>" . self::$apiEndpoints . "</pre>";
        die();
    }

}