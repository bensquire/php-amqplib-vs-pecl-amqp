<?php
include dirname(dirname(__DIR__)) . '/vendor/autoload.php';
include dirname(dirname(__DIR__)) . '/tests/common.php';


$time = time();
$startTime = microtimeFloat();


// Create a connection
$cnn = new \AMQPConnection();
$cnn->setHost('localhost');
$cnn->setLogin('guest');
$cnn->setPassword('guest');
$cnn->setVhost('/');
$cnn->connect();

// Create a channel
$ch = new \AMQPChannel($cnn);

// Declare a new exchange
$ex = new \AMQPExchange($ch);
$ex->delete($exchangeName);
$ex->setName($exchangeName);
$ex->setType("direct");
$ex->setFlags(AMQP_DURABLE);
$ex->declareExchange();

// Create a new queue
$q = new \AMQPQueue($ch);
$q->setName($queueName);
$q->delete();
$q->setFlags(AMQP_DURABLE);
$q->declareQueue();

// Bind it on the exchange to routing.key
$q->bind('router');


for ($x = 0; $x <= $iterations; $x++) {
    $ex->publish($testDataString, null, AMQP_DURABLE);
}

$cnn->disconnect();


echo $iterations . ' iterations took ' . number_format(microtimeFloat() - $startTime, 3) . ' seconds' . "\r\n";