<?PHP
//Standardpfade setzen
require('./roots.php');

/***************************************************/
/***  H A U P T D A T E I    E R S T E L L E N   ***/
/***************************************************/

// Datei <modulname.php> im neuen Verzeichnis erstellen 

//Pfad f�r das neue Modul
$pfad="../$ModulNeuBez/";

//Dateiname generieren auf Grundlage des Modulnamens
$dateiname=$ModulNeuBez . ".php";

// Pr�fen ob die Datei bereits existiert
	if (is_file($pfad.$dateiname)){ echo "Datei gibt es schon, bitte �berpr�fen sie den Ordner <strong>/module/".$dateiname."</strong>";}
		
 
//Datei �ffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt dieser Datei in ein Array schreiben
$mainline=array(50);
$mainline[1]="<?PHP\n";
$mainline[2]="//***Variablen f�r dieses Modul setzen***\n";
$mainline[3]="//Variable f�r Individual-Sprachdateisetzen, Ausgabetext sollte in Variablen hier abgelegt werden.\n";

//$zeile4 Umgebungsvaliable f�r die spezielle Sprachdatei f�r das neue Modul setzen;
$mainline[4]="\$lang_thismodule_used=\"".$ModulNeuBez.".php\";\n";

// Variable f�r den Cookie setzen
$mainline[5]="// Variable f�r den Cookie setzen";
$mainline[6]="\$this_cookie_name=\"ck_".$ModulNeuBez."user.php\";\n";

//Hilfedatei Variable setzen und erstellen
$mainline[7]="//Hilfedatei\n";
$mainline[8]="\$new_hlp_file=\"".$ModulNeuBez."._hlp.php\";\n";

$mainline[9]="//Variable f�r �berschrift der Titelleseite, des Submen�s o.�.\n";
$mainline[10]="\$thismodulname=".$ModulNeuBez.";\n";

// Standardpfadangaben laden
$mainline[11]="require(\"./roots.php\");\n";

// Die Standarddateien aus std_include_parts in den neuen Ordner kopieren.
// ggf. m�ssen noch Anpassungen in den Dateien vorgenommen werden

//wird auskommentiert, da diese Datei bereits in sub_modulname_anlegen.php ausgef�hrt wurde.
require ("inc_datei_array.php");

// Die soeben kopierten Dateien einbinden
$mainline[12]="// Error Meldungen unterdr�cken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,\n";
$mainline[13]="// Dateischutz etc.\n"; 
$mainline[14]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[0]\");\n";
$mainline[15]="// Den <HEAD> includen\n";
$mainline[16]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[1]\");\n";
$mainline[17]="// Den <BODY> includen \n";
$mainline[18]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[2]\");\n";
$mainline[19]="// den blauen Titelblock einbinden\n";
$mainline[20]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[3]\");\n";

/*** Hier erfolt der eigene Code***/
$line[18]="/*****************************************/\n";
$line[19]="// Eigener Code folgt ab hier.\n";
$line[19]="// Verweis auf die Datei mit DBForm.\n";
$line[20]="/*****************************************/\n";
//Verweis auf die Seite mit der DBFORM Tabelle erstellen


$mainline[21]="require(\$root_path.\"include/std_include_parts/footnote.inc.php\");\n";
$mainline[22]="?>\n";


//Anzahl der Codezeilen im Array bestimmen
$anzahl_mainline=count($mainline);

//Alle Codezeilen in die Datei einf�gen
$i=1;
while($i<$anzahl_mainline){
			fwrite($datei,$mainline[$i]);
			$i++;
			}
fclose($datei);


/*** Grundger�st zum Darstellen einer Tabelle mit dbForm ***/

$host="localhost";
$user="root";
$used_db="care2xdb";

$tabelle=$tab_name;
$tabellentitel="Testdatenbank";
$suchfeld="id";

//include DBFORM
include_once("../../../dbForm/formFields.inc");
include_once("../../../dbForm/tempxxxlate.inc");
include_once("../../../dbForm/dbForm.inc");



//include ADODB
include_once("../../../adodb/adodb.inc.php");
//include_once($root_path."classes/adodb/adodb.inc.php");

//Ende des Grundger�sts

$conn = &ADONewConnection("mysql");
//$conn->debug = true;

$conn->Connect($host, $user, "", $used_db);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

//To create a form for the person table
$dbForm = new dbForm($tabellentitel, $conn, $tabelle);

//We now need to set the search field. x Felder k�nnen nach select angegeben werden
$dbForm->setSearchField($suchfeld, "select $suchfeld, name from $tabelle");

$dbForm->processForm();

$dbForm->setTemplateFile("testform.tpl");

$dbForm->displayForm();
?>
