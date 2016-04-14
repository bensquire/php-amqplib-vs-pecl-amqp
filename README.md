AMQP Performance Tests
======================

V.Simplistic vagrant setup and PHP scripts to test the performance differences between the PHP AMQP extension
and php-amqplib.

In both cases I've attempted to keep the tests as similar and therefore as fair as possible.


Requirements:
-------------
 - Vagrant
 
Installation:
-------------
 - vagrant up
 
Run Tests:
----------
 - vagrant ssh
 - cd /vagrant
 - php tests/library.php
 - php tests/extension.php