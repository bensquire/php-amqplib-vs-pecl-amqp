#System setup
apt-get -y update
apt-get -y upgrade


# PHP Library
add-apt-repository -y ppa:ondrej/php5-5.6
apt-get -y update
apt-get install -y --force-yes python-software-properties php5-cli php5-curl php5-dev


# AMQP Extension
apt-get install -y pkg-config autoconf libtool automake git
cd /tmp
git clone git://github.com/alanxz/rabbitmq-c.git
cd /tmp/rabbitmq-c
git submodule init && git submodule update
autoreconf -i
./configure
make
make install
pecl install amqp
echo "extension=amqp.so" | sudo tee -a /etc/php5/cli/php.ini


# Install rabbitMQ
echo "deb http://www.rabbitmq.com/debian/ testing main" >> /etc/apt/sources.list
curl http://www.rabbitmq.com/rabbitmq-signing-key-public.asc -o /tmp/rabbitmq-signing-key-public.asc
apt-key add /tmp/rabbitmq-signing-key-public.asc
apt-get -y update
apt-get -y install rabbitmq-server
rabbitmqctl add_user tester testpassword
rabbitmqctl set_user_tags tester administrator
rabbitmqctl set_permissions -p / tester ".*" ".*" ".*"
rabbitmq-plugins enable rabbitmq_management
rabbitmqctl stop
invoke-rc.d rabbitmq-server start


# Install composer
#COMPOSER_HOME=/home/vagrant
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer


# Install composer dependencies
cd /vagrant/
/usr/local/bin/composer install --ignore-platform-reqs