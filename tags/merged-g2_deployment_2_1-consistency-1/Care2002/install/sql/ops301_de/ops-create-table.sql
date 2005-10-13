# phpMyAdmin MySQL-Dump
# version 2.2.0rc1
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost
# Erstellungszeit: April 9, 2002, 2:29 pm
# Server Version: 3.22.34
# PHP Version: 4.0.4pl1
# Datenbank : drg
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle 'care_ops301_de'
#


CREATE TABLE care_ops301_de (
   code varchar(12) NOT NULL,
   description text NOT NULL,
   inclusive text NOT NULL,
   exclusive text NOT NULL,
   notes text NOT NULL,
   std_code char(1) NOT NULL,
   sub_level tinyint(4) DEFAULT '0' NOT NULL,
   remarks text NOT NULL
);


