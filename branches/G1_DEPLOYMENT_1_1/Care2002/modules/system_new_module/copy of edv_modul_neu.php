<?PHP

//Standardpfade setzen
require('./roots.php');

// Error Meldungen unterdrücken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,
// Dateischutz etc
	 						 //variabeln für inc_modul_top.php
							 						 //Variable für die in diesem Modul benutzte Individual-Sprachdatei 
													 $lang_thismodule_used="modulneu.php";
													 
													 //Cookiename setzen
													 $this_cookie_name='ck_edv_user';
													 
require_once($root_path."include/std_include_parts/inc_modul_top.php");

// ggf. $breakfile und $returnfile neu definieren
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";

//Head includen
require_once($root_path."include/std_include_parts/head_include.inc.php");

?>

<!-- Java Script für Entscheidung ob das Modul so angelegt werden soll oder nicht.
FAlls ja, edv_modul_neu_2 php ausführen, falls nein, eine Seite zurück zu edv.php
return false ist nötig damit die action - Anweisung in der FORM nicht ausgeführt wird. 
Die Action muss vorhanden sein, falls ein Browser Java nicht aktiviert hat. -->
<script language="JavaScript" type="text/javascript">
<!--
function submitja(){
				 document.ModulNeu.action="edv_modul_neu_2.php";
				 document.ModulNeu.submit();
				 return false;
				 }
function submitnein(){
				 document.ModulNeu.action="edv.php";
				 document.ModulNeu.submit();
				 return false;				 
				 }				 
//-->
</script>

<?php

// Den <BODY> includen
	 		 //Variablen die im Body benötigt werden
			 
			      //für den <BODY>, Angabe wo bei onclick der Focus stehen soll beim Laden der Seite
						$this_page_focusfeld="document.ModulNeu.ModulNeuBez.focus()"; 
						
require ($root_path."include/std_include_parts/inc_body.php");




// blauer Titelblock einbinden
	 				//Variablen des Titelblocks
										 //Hilfedatei
										 $new_hlp_file="edv_modul_neu_hlp1.php";
										 
										 //Variable für Überschrift Titellesite
										 $thismodulname=$LDEDP . " - " . $LDNeuesModulanlegen;
										 
include($root_path."include/std_include_parts/inc_titelblock.php");
?>

<!-- ********************************************** -->
<!-- Ab hier kann komplett eigener Code erfolgen -->
<!-- ********************************************** -->

<?PHP
//check if module name is already set, if not leave module name empty
if(isset($_REQUEST["ModulNeuBez"])){
 $ModulNeuBez = $_REQUEST["ModulNeuBez"];
}
else {
 $ModulNeuBez = "";
}
?>

<!-- Eingabeformular erstellen für den Modulnamen -->

<form name="ModulNeu" action="edv_modul_neu_2.php" >
<input type='hidden' value="<?php echo $sid ?>" name="sid" />
<input type='hidden' value="<?php echo $lang ?>" name="lang" /><br/>
<FONT FACE="Arial" COLOR="<?php echo $cfg['top_txtcolor']; ?>" ><STRONG><?php echo $titel ?></STRONG><br></FONT><br/>
<input name="ModulNeuBez" type="text" size="30" maxlength="30" value="<?php echo $ModulNeuBez; ?>" >
<p>

<table border="1" width="80%">
<tr>
<td>
<br/>
<input type="radio" name="stdmenuejanein" value="1" checked>
			 <FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $menue_eintrag_ja ?></FONT><br/>
<input type="radio" name="stdmenuejanein" value="2" >			 
			  <FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $menue_eintrag_nein ?><br/><br/>
</td></tr></table>	

</p></p>

<!-- Rahmen für die Auswahl, an welcher Stelle das neue Modul im Menü erscheinen soll  -->
<table border="1" width="80%" >
<tr><td><br/>

<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_menufolge_txt1; ?></font><br/>
<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_menufolge_txt2; ?></font><br/>
<br/>


<SELECT name="menufolge">
<?
//*** Menüstellen füllen ***//
//Verbindung zur Datenbank herstellen, mit ADODB
require_once ("Verbindung.inc.php");

//max menu feststellen
//Variable für den neuen Eintrag vorbereiten
$sql="SELECT MAX(sort_nr) FROM care_menu_main";
$maximum=&$conn->Execute($sql);
$max_sort_nr=$maximum->fields[0];

echo "<OPTION SELECTED>".$LD_automatic;
for($i=1;$i<=$max_sort_nr;$i++){
      if ($i<10){
         echo "<OPTION>0".$i.". ".$LD_stelle."</OPTION>";
		  }
			elseif ($i>=10) {
			   echo "<OPTION>".$i.". ".$LD_stelle."</OPTION>";
			}
}			
?>

<!-- Pulldown-Menue und Tabelle schliessen -->
</SELECT>	
<br/><br/>											
</td></tr></table>	
<input type="hidden" name="max_sort_nr" value="<?php echo $max_sort_nr;?>">
<br/>

<!-- Rahmen für die Auswahl, an welcher Stelle das neue Modul im Menü erscheinen soll  -->
<table border="1" width="80%" >
<tr><td><br/>
<input type="checkbox" name="mit_untermenu" value="1" >
<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_mit_untermenu; ?>
<br/></br>										
</td></tr></table><br/>
<!-- Buttons erstellen um das Formular abzuschicken  -->
<input type="submit" onclick="submitja();" size="30" value="<?php echo $modulanlegen; ?>" >
<input type="submit" onclick="submitnein();" size="30" value="<?php echo $LDBack; ?>" >
</form>

<?
// Fusszeile mit Copyright, etc. includen
require_once ($root_path."include/std_include_parts/footnote.inc.php");
?>

