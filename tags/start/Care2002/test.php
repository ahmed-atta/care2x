<?
/*chargement du driver ADODB*/
include('adodb/adodb.inc.php');

/* d�claration de quelques variables */
 $host     = "localhost";
 $user     = "sql-ledger";
 $password = "290372";
 $database = "clinique_des_alizes";
 $table="parts";


/* connection � la base de donn�e */
$db = ADONewConnection($database);
$db->debug = true;
$db->Connect($host, $user, $password, $database);
$rs = $db->Execute()
?>
