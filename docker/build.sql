CREATE DATABASE `learning` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev';
CREATE USER 'dev'@'%' IDENTIFIED BY 'dev';
GRANT ALL PRIVILEGES ON `learning`.* TO 'dev'@'localhost';
GRANT ALL PRIVILEGES ON `learning`.* TO 'dev'@'%';