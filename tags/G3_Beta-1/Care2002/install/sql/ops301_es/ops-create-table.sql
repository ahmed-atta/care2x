# phpMyAdmin MySQL-Dump
# version 2.2.0rc1
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost
# Manuel Montemayor: Enero 3, 2004, 2:29 pm
# Server Version: 3.22.34
# PHP Version: 4.0.4pl1
# Datenbank : drg
# --------------------------------------------------------

#
# Estructura para tabla 'care_ops301_es'
#


CREATE TABLE care_ops301_es (
   code varchar(12) NOT NULL,
   description text NOT NULL,
   inclusive text NOT NULL,
   exclusive text NOT NULL,
   notes text NOT NULL,
   std_code char(1) NOT NULL,
   sub_level tinyint(4) DEFAULT '0' NOT NULL,
   remarks text NOT NULL
);


