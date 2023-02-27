FROM ubuntu:latest
RUN apt update
RUN apt-get update
RUN apt update && apt install -y tzdata
RUN apt install software-properties-common -y
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt install curl -y
RUN apt install apt-transport-https -y
RUN apt install apache2 -y
RUN apt install php7.4 -y
RUN apt install mysql-server -y
RUN apt install libcurl4 -y
RUN apt install php7.4-bcmath php7.4-mysql php7.4-curl php7.4-gd php7.4-mbstring php7.4-simplexml php7.4-zip -y
RUN a2enmod rewrite
RUN phpenmod mbstring
RUN phpenmod curl
RUN apt-cache search php7.4-*
RUN cd /var/www/ && curl -sS https://getcomposer.org/installer -o composer-setup.php && php composer-setup.php --install-dir=/usr/local/bin --filename=composer && rm composer-setup.php

RUN apt install redis-server -y
RUN apt install apache2-utils -y
RUN apt install unzip
RUN apt install git -y

RUN apt install rabbitmq-server -y
RUN systemctl enable rabbitmq-server

ENV MYSQL_ROOT_PASSWORD=toor

COPY docker/launch.sh /var/www/launch.sh
COPY docker/configure.sh /var/www/configure.sh
COPY docker/build.sql /var/www/build.sql
COPY docker/web.conf /etc/apache2/sites-available/000-default.conf
COPY docker/mysql.cnf /etc/mysql/mysql.cnf