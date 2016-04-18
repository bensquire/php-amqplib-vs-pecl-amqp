<?php
include dirname(dirname(__DIR__)) . '/vendor/autoload.php';
include dirname(dirname(__DIR__)) . '/tests/common.php';


$time = time();
$startTime = microtimeFloat();
$iterations = 1000;


for ($x = 0; $x <= $iterations; $x++) {
    // Create a connection
    $cnn = new \AMQPConnection();
    $cnn->setHost($connection['host']);
    $cnn->setPort($connection['port']);
    $cnn->setLogin($connection['username']);
    $cnn->setPassword($connection['password']);
    $cnn->setVhost($connection['vhost']);
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
    $ex->publish($testDataString, null, AMQP_DURABLE);

    //Disconnect
    $cnn->disconnect();
}

echo $iterations . ' iterations took ' . number_format(microtimeFloat() - $startTime, 3) . ' seconds' . "\r\n";