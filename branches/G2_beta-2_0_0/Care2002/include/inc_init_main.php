<?php
# This is the database name
$dbname='caredb';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
 $dbusername='postgres';
$dbusername='root';

# Database user password, default is empty char
 $dbpassword = 'postgres';
$dbpassword='';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='7.04400938457E+27';

# Second key used for accessing modules
$key_2level='2.47241667141E+27';

# 3rd key for encrypting cookie information
$key_login='4.35213066392E+26';

# Main host address or domain
$main_domain='localhost';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
# postgres7 = for PostgreSQL database
# mysql = for mySQL database

$dbtype = 'postgres7';
$dbtype='mysql';
?>
