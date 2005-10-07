# phpMyAdmin MySQL-Dump
# version 2.2.0rc1# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost# Erstellungszeit: March 24, 2002, 5:53 pm
# Server Version: 3.22.34# PHP Version: 4.0.4pl1# Datenbank : drg
# -------------------------------------------------------- 
#
# Tabellenstruktur für Tabelle 'care_icd10_de'
# 
CREATE TABLE care_icd10_de (   
 diagnosis_code varchar(12) NOT NULL,   
 description text NOT NULL,   
 class_sub varchar(5) NOT NULL,   
 type varchar(10) NOT NULL,   
 inclusive text NOT NULL,   
 exclusive text NOT NULL,   
 notes text NOT NULL,   
 std_code char(1) NOT NULL,   
 sub_level tinyint(4) DEFAULT '0' NOT NULL,   
 remarks text NOT NULL,   
 extra_codes text NOT NULL,   
 extra_subclass text NOT NULL);
