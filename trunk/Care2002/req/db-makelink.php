<?
/****************************************************************************
			these are the global data for mySQL databank connection 
  			edit these to correctly configure
******************************************************************************/

$dbhost="localhost";  ////// format is "host:port" 
$dbusername="httpd";
$dbpassword="";

/****************************************************************************
            Set the following to the name of your database. If you have not yet created 
			the database, remember the name that you enter here. You need this name
			later in creating the database
******************************************************************************/ 
$dbname="maho";

/*****************************************************************************
			the following lines are to establish connection DO NOT EDIT ..................
  			the variable $DBLink_OK will be tested in the script to determine
			whether the link is established or not 
			DO NOT EDIT THE FOLLOWING LINES!!!!!!
***************************************************************************** */
 if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$DBLink_OK=1;
	}
	else $DBLink_OK=0; 
}
?>
