# phpMyAdmin SQL Dump
# version 2.5.3
# http://www.phpmyadmin.net
#
# Serveur: localhost
# Généré le : Lundi 10 Mai 2004 à 19:04
# Version du serveur: 4.0.18
# Version de PHP: 4.3.4
# 
# Base de données: `caredb`
# 

# --------------------------------------------------------

#
# Structure de la table `care_type_immunization`
#

CREATE TABLE `care_type_immunization` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(20) NOT NULL default '',
  `name` varchar(20) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `modify_time` timestamp(14) NOT NULL,
  `period` smallint(6) NOT NULL default '0',
  `tolerance` smallint(3) NOT NULL default '0',
  `dosage` text NOT NULL,
  `medecin` text NOT NULL,
  `titer` text NOT NULL,
  `note` tinyblob NOT NULL,
  `application` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `tolerance` (`tolerance`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
    