<?php

function microtimeFloat()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$connection = [
    'host' => 'localhost',
    'port' => 5672,
    'username' => 'guest',
    'password' => 'guest',
    'vhost' => '/'
];

$testData = ['test' => 'message'];
$testDataString = json_encode($testData);
$exchangeName = 'router';
$queueName = 'msgs';