<?php
chdir(dirname(__DIR__));
define('APP_DIR', realpath(__DIR__));
include dirname(__DIR__) . '/vendor/autoload.php';

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time = time();
$startTime = microtime_float();

$testData = ['test' => 'message'];
$testDataString = json_encode($testData);

$iterations = 1000;


//Setup Exchange

//Setup Queue/Route

//Create Message


for ($x = 0; $x <= $iterations; $x++) {
    //Publish to Queue
}

$endTime = microtime_float();
echo $iterations . ' iterations took ' . number_format($endTime - $startTime, 3) . ' seconds' . "\r\n";