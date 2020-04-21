<?php

/**
 * @return string
 * @throws Exception
 */
function getCurrentDate() : string
{
    $data = new DateTime();
    return $data->format('Y-m-d');
}

/**
 * @param string $url
 * @param string $date
 * @param string $token
 * @return string
 */
function generateNewUrl(string $url, string $date, string $token) : string
{
    return sprintf('%s%s?token=%s', $url, $date, $token);
}

/**
 * @param string $days
 * @return string
 * @throws Exception
 */
function getDateBeforeToday(string $days) : string
{
    $current = getCurrentDate();
    $now = strtotime($current);
    $daysBefore = sprintf('-%s days', $days);

    return date('Y-m-d', strtotime($daysBefore, $now));
}

/**
 * @param int $total
 * @return array
 * @throws Exception
 */
function getDatesArray($total = 1) : array
{
    $dates[] = getCurrentDate();
    for($i = 1; $i <= $total; $i++ )
    {
        $dates[] = getDateBeforeToday($i);
    }

    return $dates;
}

$fileLocation = __DIR__ . '/../endpoint/results.json';
$url='https://api.php.mk/nbrm/v1.0/';
$token = 'c40b5ab8a3b190ac6c40aaef3df88717';
$dataSet = [];

try {
    $date = getCurrentDate();
    $today = generateNewUrl($url, $date, $token);
} catch (Exception $e) {
    die('Can\'t get today rates.');
}

try {
    foreach (getDatesArray(15) as $currentDate) {
        $generateUrl = generateNewUrl($url, $currentDate, $token);
        $jsonResponse = file_get_contents($generateUrl);
        $response = json_decode($jsonResponse,true)['data'];
        $dataSet = array_merge($dataSet, $response);
    }
} catch (Exception $e) {
    die('There is problem with generating dataset.');
}

$fp = fopen($fileLocation, 'w');
fwrite($fp, json_encode($dataSet));
fclose($fp);

die('done.');