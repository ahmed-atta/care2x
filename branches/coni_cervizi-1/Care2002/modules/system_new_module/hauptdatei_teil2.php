<?php
/*** Zweiter Teil dieser Datei, dbForm-Datei anlegen ***/
//Pfad für das neue Modul
$pfad="../$ModulNeuBez/";
//dbform-Datei schreiben
$dateiname=$ModulNeuBez."_dbform.php";
// Prüfen ob die Datei bereits existiert
	if (is_file($pfad.$dateiname)){ 
	    echo "teil2: Datei gibt es schon, bitte überprüfen sie den Ordner <strong>".$pfad."/".$datpeiname."</strong><br/>";
			echo "Aktion ".$datei." erstellen abgebrochen.";
			exit;
			}
		
//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt dieser Datei in ein Array schreiben
$dbformline=array(35);
$dbformline[0]="<?PHP\n";
$dbformline[1]="//***Variablen für dieses Modul setzen***\n";
$dbformline[2]="\$tab_name=\"$tab_name\";\n";
$dbformline[3]="\$suchfeld=\"$suchfeld\";\n";
$dbformline[4]="\$tabellentitel=\"$tabellentitel\";\n";
$dbformline[5]="\$host=\"$host\";\n";
$dbformline[6]="\$user=\"$user\";\n";
$dbformline[7]="\$used_db=\"$used_db\";\n";
$dbformline[8]="\$sortfeld2=\"$sortfeld2\";\n";
$dbformline[9]="\$ModulNeuBez=\"$ModulNeuBez\";\n";

$dbformline[10]="//include DBFORM\n";
$dbformline[11]="include_once(\"../../../dbForm/formFields.inc\");\n";
$dbformline[12]="include_once(\"../../../dbForm/template.inc\");\n";
$dbformline[13]="include_once(\"../../../dbForm/dbForm.inc\");\n";

$dbformline[14]="//include ADODBC\n";
$dbformline[15]="include_once(\"../../../adodb/adodb.inc.php\");\n";

$dbformline[16]="\$conn = &ADONewConnection(\"mysql\");\n";
$dbformline[17]="//\$conn->debug = true;\n";

$dbformline[18]="\$conn->Connect(\$host, \$user, \"\", \$used_db);\n";
$dbformline[19]="\$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;\n";

$dbformline[20]="//To create a form for the person table\n";
$dbformline[21]="\$dbForm = new dbForm(\$tabellentitel, \$conn, \$tab_name);\n";

$dbformline[22]="//We now need to set the search field. x Felder können nach select angegeben werden\n";

if ($pat_bez=="1"){
    $dbformline[23]="\$dbForm->setSearchField(\$suchfeld, \"select \$suchfeld, \$sortfeld2 FROM \$tab_name WHERE \$suchfeld=\$pid\");\n";
}
else {
    $dbformline[23]="\$dbForm->setSearchField(\$suchfeld, \"select \$suchfeld, \$sortfeld2 FROM \$tab_name\");\n";
}

$dbformline[24]="\$dbForm->processForm();\n";

$dbformline[25]="\$dbForm->setTemplateFile(\"testform.tpl\");\n";

$dbformline[26]="\$dbForm->displayForm();\n";

$dbformline[27]="require (\"back.php\");\n";
$dbformline[28]="?>\n";

//Anzahl der Codezeilen im Array bestimmen
$anzahl_dbformline=count($dbformline);

//Alle Codezeilen in die Datei einfügen
$i=0;
while($i<$anzahl_dbformline){
			fwrite($datei,$dbformline[$i]);
			$i++;
			}
fclose($datei);

echo "Und auch die Letzte Datei des Moduls $ModulNeuBez wurde generiert.<br/>";
//echo "Die Haupt-Datei-2 des Moduls ".$ModulNeuBez." wurde generiert.<br/>";
//echo "<br/>".$pat_bez;

?>