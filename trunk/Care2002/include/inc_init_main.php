<?php
# This is the database name
$dbname='carepg';
#$dbname='caredb';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='postgres';
#$dbusername='root';

# Database user password, default is empty char
$dbpassword='postgres';
#$dbpassword='';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='3.87233129665E+27';

# Second key used for accessing modules
$key_2level='1.75230861446E+27';

# 3rd key for encrypting cookie information
$key_login='5.74476131123E+26';

# Main host address or domain
$main_domain='192.168.0.10';

# Host address for images
$fotoserver_ip='192.168.0.10';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='postgres7';
#$dbtype='mysql';
?>
