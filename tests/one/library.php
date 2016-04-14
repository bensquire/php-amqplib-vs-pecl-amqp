<?php
include dirname(dirname(__DIR__)) . '/vendor/autoload.php';
include dirname(dirname(__DIR__)) . '/tests/common.php';


$time = time();
$startTime = microtimeFloat();

$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest', '/');
$channel = $connection->channel();

$channel->queue_delete($queueName);
$channel->queue_declare($queueName, false, true, false, false);
$channel->exchange_delete($exchangeName);
$channel->exchange_declare($exchangeName, 'direct', false, true, false);
$channel->queue_bind($queueName, $exchangeName);


for ($x = 0; $x <= $iterations; $x++) {
    $message = new \PhpAmqpLib\Message\AMQPMessage($testDataString, array('content_type' => 'text/plain', 'delivery_mode' => \PhpAmqpLib\Message\AMQPMessage::DELIVERY_MODE_PERSISTENT));
    $channel->basic_publish($message, $exchangeName);
}

$channel->close();
$connection->close();


echo $iterations . ' iterations took ' . number_format(microtimeFloat() - $startTime, 3) . ' seconds' . "\r\n";