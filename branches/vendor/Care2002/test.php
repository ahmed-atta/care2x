<?
/*chargement du driver ADODB*/
include('adodb/adodb.inc.php');

/* déclaration de quelques variables */
 $host     = "localhost";
 $user     = "sql-ledger";
 $password = "290372";
 $database = "clinique_des_alizes";
 $table="parts";


/* connection à la base de donnée */
$db = ADONewConnection($database);
$db->debug = true;
$db->Connect($host, $user, $password, $database);
$rs = $db->Execute()
?>
