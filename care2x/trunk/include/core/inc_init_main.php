<?php
# This is the database name
$dbname='';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='';

# Database user password, default is empty char
$dbpassword='';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='2087550157770';

# Second key used for accessing modules
$key_2level='52868623995418';

# 3rd key for encrypting cookie information
$key_login='49384441600';

# Main host address or domain
$main_domain='localhost';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';

# Set this to your timezone.
$timezone = 'Europe/Rome';
date_default_timezone_set($timezone);
?>
