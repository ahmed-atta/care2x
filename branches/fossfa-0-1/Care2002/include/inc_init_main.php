<?php
# This is the database name
$dbname='care2x';

# Database user name, default is root or httpd
$dbusername='nobody';

# Database user password, default is empty char
$dbpassword='';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='1.8448723808056E+28';

# Second key used for accessing modules
$key_2level='1.1066464454036E+28';

# 3rd key for encrypting cookie information
$key_login='1.004997259468E+27';

# Main host address or domain
$main_domain='localhost';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';



// KB: list of other hospitals
$kb_other_his_array = Array( 'CMS'=>'Cecilia Makiwane Hospital', 'Frere'=>'Frere Hospital' );
?>