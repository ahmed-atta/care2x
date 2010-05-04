<?PHP

//Variablen allgemein
$LDja="    Ja    ";
$LDnein="  Nein  ";

//Variablen f�r sub_modul_neu.php
$LDNeuesModulanlegen = 'Erstellen';
$LD_sub_NeuesModulAnlegenTxt= "erstellt ein neues Modul nach Ihren Vorgaben";
$LD_Hinweise="Hinweise";
$LD_HinweiseTxt="Hinweise f�r die Bereitstellung von Login mit einem neuen Modul";

//Variablen f�r edv_modul_neu.php
$modul_titel="Name des neuen Moduls:";
$menue_eintrag_ja="Eintrag im Standardmen� f�r dieses Modul vornehmen (Standard).";
$menue_eintrag_nein="Keinen Eintrag vornehmen. Ein Submen� eines anderen Moduls wird manuell erstellt.";
$modulanlegen="Modul anlegen";
$LD_menufolge_txt1="Bitte w�hlen Sie die Position, an die Sie den Eintrag f�r das neue Modul einf�gen wollen.";
$LD_menufolge_txt2="Standard ist \"automatisch\", der Eintrag erfolgt dann am Ende der Men�struktur.";
$LD_automatic="automatisch";
$LD_stelle="Stelle";
$LD_weiter="Weiter...";
$LD_mit_untermenu="W�hlen Sie dieses Feld, wenn f�r das neu geplante Modul mehrere Untermen�s geplant sind, es wird automatisch ein Submen� zur einfachen manuellen Erweiterung generiert.";

//Variablen f�r edv_modul_neu_2.php
$blank_eingabe="Die Modulbezeichnung enth�lt Leerzeichen oder mehrere Worte. Empfehlung: Sie k�nnen die gek�rzte Fassung (1 Wort) behalten oder auf \"Nein\" klicken und �ndern.";
$fehleingabe="Leere Modulnamen sind nicht erlaubt.";
$kontrollmeldung_1="Der Name des neuen Moduls w�re: ";
$kontrollmeldung_2="hei�en.";
$kontrollmeldung_3="Soll das neue Modul mit dem o.g. Titel erstellt werden (ggf. �ndern)?";

//Variablen f�r edv_modul_neu_3.php
$weiter_info="\"Weiter\" klicken um die Haupdatei zu estellen. Weitere Angaben sind n�tig.";
$wichtige_info="Wichtige Admin-Hinweise bzgl. Anpassung der \"Modulname\"-main-pass.php";



//Variablen f�r check_patientwahl.php
$LD_headline_frage="Treffen Sie eine Wahl. Standardm�ssig wird ein Modul patientenbezogen generiert.";
$haken_info="Das Modul ist Patientenbezogen, beim Start soll zuerst ein Patient gew�hlt werden";

//Variablen f�r radio_tabwahl.php
$LD_wahl1="Bereits vorhandenen Tabelle mit dbForm im neuen Modul bearbeiten.";
$LD_wahl2="Zun�chst eine Tabelle im Memofeld anlegen und diese ins neue Modul einbinden.";
//$LD_wahl3=" Mit DB-Designer erstellte Datei hochladen und in MySQL implementieren.";
$LD_wahl3="Keine �nderungen mehr, eine leere Datei erzeugen";
$setback_fields="Felder zur�cksetzen";

//Variablen f�r radio_tabwahl.php  U N D  radio1_memofeld.php
$nenne_tabelle="Bitte hier den Tabellennamen angeben";
$nenne_tabelle2="<strong>(denselben wie im Memofeld!)</strong>";
$nenne_suchfeld="Bitte hier das Suchfeld, (i.d.R. \"id\") angeben";
$nenne_tab_bezeichner="Bitte hier eine �berschrift angeben";
$nenne_anzeigefeld="Bitte eine Tabellenspalte zum F�llen des Suchfeldes angeben ";
$nenne_server="Bitte hier den Datenbankserver angeben";
$fertig="Tabelle und Modul $ModulNeuBez fertigstellen";

//Variablen f�r radio1_memofeld.php
$infoline="�ndern Sie die Beispieltabelle nach Ihren W�nschen ab.</br>";


//Variablen f�r editsql.php
$sql_meldung="Der folgende SQL-String wurde in Ihrer Datenbank ausgef�hrt.";

//Variablen aus inc_datei_array.de
$err_ida_var_fehlt="Die Variablen root_path oder ModulNeuBez sind leer. Zielpfad konnte nicht ermittelt werden.";
$err_keinpfad="Abbruch. Der Pfad exisitert nicht. Dies ist eine Fehlermeldung aus inc_datei_array.php.<br/>";
$err_mainpass_copy="Kopieren der main-pass.php - Datei fehlgeschlagen.";
$err_kopieren="Kopieren von ";
$err_fehlgeschlagen=" fehlgeschlagen.<br/>";


//Variablen aus Schlusssatz.php
$ld_gratulation="Gratuliere, das Modul <strong> $ModulNeuBez</strong> ist fertig.";


?>
