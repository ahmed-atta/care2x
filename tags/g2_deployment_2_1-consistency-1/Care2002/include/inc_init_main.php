<?php
# This is the database name
$dbname='carepg';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='root';
$dbusername='postgres';

# Database user password, default is empty char
$dbpassword='';
$dbpassword='postgres';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='5.79359877996E+26';

# Second key used for accessing modules
$key_2level='2.52046363331E+28';

# 3rd key for encrypting cookie information
$key_login='8.32137810704E+26';

# Main host address or domain
$main_domain='localhost';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';
$dbtype='postgres7';
?>
