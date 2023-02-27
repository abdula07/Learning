#!/bin/bash
rabbitmq-plugins enable rabbitmq_management 
rabbitmqctl add_user dev dev 
rabbitmqctl set_user_tags dev administrator 
rabbitmqctl set_permissions -p / dev ".*" ".*" ".*"
mysql -uroot -ptoor < /var/www/build.sql
cd /var/www/learning && composer install
chown -R 1000:1000 /var/www/learning
chmod -R 0777 /var/www/learning