<?php

function microtimeFloat()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}


$testData = ['test' => 'message'];
$testDataString = json_encode($testData);
$iterations = 10000;
$exchangeName = 'router';
$queueName = 'msgs';