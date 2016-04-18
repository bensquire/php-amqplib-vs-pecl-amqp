#AMQP Performance Tests

V.Simplistic vagrant setup and PHP scripts to test the performance differences between the PHP AMQP extension
and php-amqplib.

In both cases I've attempted to keep the tests as similar and therefore as fair as possible.


##Requirements:
 - Vagrant
 
##Installation:
 - vagrant up
 
##Run Tests:
 - vagrant ssh
 - cd /vagrant
 - php tests/one/library.php
 - php tests/one/extension.php
 
##Tests:
### Scenario One:
  - Exchange and Queue Deleted 
  - Exchange and Queue Created
  - 10000 published messages
  - Queue/Channel closed
  
### Scenario Two:
  - 1000 iterations
    - Exchange and Queue Deleted 
    - Exchange and Queue Created
    - Publish Message
    - Queue/Channel closed