<?php
# This is the database name
$dbname='care2x_gettext';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='root';

# Database user password, default is empty char
$dbpassword='root';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='3.4490598255973E+26';

# Second key used for accessing modules
$key_2level='2.3096868388074E+28';

# 3rd key for encrypting cookie information
$key_login='2.9647067937614E+28';

# Main host address or domain
$main_domain='localhost/gettext/care2002/care2x/branches/gettext/';

# Host address for images
$photoserver_ip='localhost/gettext/care2002/care2x/branches/gettext/';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';

# Set this to your timezone.
$timezone = 'Europe/Tirane';
date_default_timezone_set($timezone);

?>