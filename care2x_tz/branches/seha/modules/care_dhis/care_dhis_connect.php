<?
// include main database connection
include('../../include/inc_init_main.php');

// open a connection to the database server
$connection = mysql_connect($dbhost, $dbusername, $dbpassword);

mysql_select_db('dhis_care');
if (!$connection)
{
	die("Could not open connection to database server");
}

?>