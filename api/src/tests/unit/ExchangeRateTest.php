<?php

require_once __DIR__ . './../../helper/ExchangeRateHelper.php';

use PHPUnit\Framework\TestCase;

class ExchangeRateTest extends TestCase{

    /**
     * PrepareResponse function
     */
    public function testPrepareResponseArray()
    {
        $response = ExchangeRateHelper::prepareResponse(
            'true',
            'Internal server error',
            500
            );

        $this->assertIsArray($response);
    }

    /**
     * validateConverter function
     */
    public function testFromToValueIsInvalid()
    {
        $validator = ExchangeRateHelper::validateConverter(
            'MKD23434',
            'EU1',
            '50fd'
        );
        $this->assertFalse($validator);

        $validator = ExchangeRateHelper::validateConverter(
            'MKD',
            'EU',
            '50'
        );
        $this->assertTrue($validator);
    }

    /**
     * getDataFromUrl function
     */
    public function testCheckDataFromGivenUrl()
    {
        $newUrl = "https://api.php.mk/nbrm/v1.0/?token=c40b5ab8a3b190ac6c40aaef3df88717";
        $validDataset = ExchangeRateHelper::getDataFromUrl($rates, $newUrl);
        $this->assertTrue($validDataset);

        $newUrl = "https://api.php.mk/nbrm/v1.0/";
        $validDataset = ExchangeRateHelper::getDataFromUrl($rates, $newUrl);
        $this->assertFalse($validDataset);
    }

    /**
     * isValueDenar function
     */
    public function testDenarIsValue()
    {
        $isDenar = ExchangeRateHelper::isValueDenar('mkd','mkdd', $whoIsDenar);
        $this->assertTrue($isDenar);

        $isDenar = ExchangeRateHelper::isValueDenar('mkdd','mkdd', $whoIsDenar);
        $this->assertFalse($isDenar);

        $isDenar = ExchangeRateHelper::isValueDenar('chz','usa1', $whoIsDenar);
        $this->assertFalse($isDenar);

        $isDenar = ExchangeRateHelper::isValueDenar('mkd','mkd', $whoIsDenar);
        $this->assertTrue($isDenar);
        $this->assertEquals('to', $whoIsDenar);

        $isDenar = ExchangeRateHelper::isValueDenar('usa','mkd', $whoIsDenar);
        $this->assertTrue($isDenar);
        $this->assertEquals('from', $whoIsDenar);

        $isDenar = ExchangeRateHelper::isValueDenar('eur','usa', $whoIsDenar);
        $this->assertFalse($isDenar);

    }

    /**
     * findRating function
     */
    public function testRatingArray()
    {
        $newUrl = "https://api.php.mk/nbrm/v1.0/?token=c40b5ab8a3b190ac6c40aaef3df88717";
        $valid = ExchangeRateHelper::getDataFromUrl($rates, $newUrl);
        $this->assertTrue($valid);

        $to = 'EUR';
        $from = 'USA';
        ExchangeRateHelper::findRating($to, $from, $rates);
        $this->assertIsArray($to);
        $this->assertIsNotArray($from);

        $to = 'CHF';
        $from = 'SEK';
        ExchangeRateHelper::findRating($to, $from, $rates);
        $this->assertIsArray($to);
        $this->assertIsArray($from);
    }

    /**
     * validateCurrencyValue function
     */
    public function testValidatorForCurrency()
    {
        $newUrl = "https://api.php.mk/nbrm/v1.0/?token=c40b5ab8a3b190ac6c40aaef3df88717";
        ExchangeRateHelper::getDataFromUrl($rates, $newUrl);
        $this->assertIsArray($rates);

        $validator = ExchangeRateHelper::validateCurrencyValue('eur', $rates['data']);
        $this->assertTrue($validator);

        $validator = ExchangeRateHelper::validateCurrencyValue('mkd', $rates['data']);
        $this->assertFalse($validator);
    }

    /**
     * prepareResponseHistory function
     */
    public function testResponseHistory()
    {
        $newUrl = "https://api.php.mk/nbrm/v1.0/?token=c40b5ab8a3b190ac6c40aaef3df88717";
        ExchangeRateHelper::getDataFromUrl($rates, $newUrl);
        $this->assertIsArray($rates);

        ExchangeRateHelper::prepareResponseHistory($rates['data'], 34234 ,$responseData);
        $this->assertTrue(is_null($responseData));

        $value = strtoupper('euro');
        ExchangeRateHelper::prepareResponseHistory($rates['data'], $value ,$responseData);
        $this->assertTrue(is_null($responseData));

        $value = strtoupper('eur');
        ExchangeRateHelper::prepareResponseHistory($rates['data'], $value ,$responseData);
        $this->assertIsArray($responseData);

    }
}