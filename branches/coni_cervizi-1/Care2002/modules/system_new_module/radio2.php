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
													 define('NO_TEMPLATE', TRUE);
require_once($root_path."include/std_include_parts/inc_modul_top.php");

// ggf. $breakfile und $returnfile neu definieren
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";

//Head includen
require_once($root_path."include/std_include_parts/head_include.inc.php");

// Den <BODY> includen
	 		 //Variablen die im Body benötigt werden
			 
			      //für den <BODY>, Angabe wo bei onclick der Focus stehen soll beim Laden der Seite
						$this_page_focusfeld=""; 
						
require ($root_path."include/std_include_parts/inc_body.php");

// blauer Titelblock einbinden
	 				//Variablen des Titelblocks
										 //Hilfedatei
										 $new_hlp_file="edv_modul_neu_hlp1.php";
										 
										 //Variable für Überschrift Titellesite
										 $thismodulname=$LDEDP . " - " . $LDNeuesModulanlegen;
//include($root_path."include/std_include_parts/inc_titelblock.php");




$wahl=$_REQUEST['wahl'];
$tab_name=$_REQUEST['tab_name'];
$patientenbezogen=$_REQUEST['patientenbezogen'];
$decision=$wahl;

switch($decision) {
case"1":
		if ($tab_name==""){
		   //echo "Bitte <a href='radio1.inc.php?sid=$sid&lang=$lang'>zurück</a>, um eine Tabelle zu wählen. Abbruch!<br/>";
			 //break;
			 ?>
			 <br/><br/><br/><br/><br/>
     <FONT FACE='ARIAL' color="#ff0000" ><STRONG><blink>Bitte gehen Sie zurück um einen Tabellennamen anzugeben.</blink></STRONG></FONT><br/>
		 <?php
		 //require_once("radio1.inc.php");
		 $radio1_file=$root_path."modules/system_new_module/radio_patientwahl.inc.php?sid=".$sid."&lang=".$lang."&ModulNeuBez=".$ModulNeuBez;
		 if($cfg['dhtml'])echo '<br/><br/><a href="'.$radio1_file.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>

		<?php
		 break;
			 
			 }
		else {
		  require_once("radio1_tabelle_mit_dbform_oeffnen.inc.php");
		
     // require_once("leo.php");//testdatei
		
			break;
			}
			
case "2":
     require_once("radio1_stdtab_sqlinmemo_anlegen.inc.php");
		 break;
		 
case "3":		 
		 require_once("radio1_dbdesigner_datei_laden.inc.php");
		 break;
		 
default:?>
		 <br/><br/><br/><br/><br/>
     <FONT FACE='ARIAL' color="#ff0000" ><STRONG><blink>Sie haben nichts gewählt. Bitte treffen Sie eine Auswahl!</blink></STRONG></FONT><br/>
		 <?php
		 //require_once("radio1.inc.php");
		 $radio1_file=$root_path."modules/system_new_module/radio_patientwahl.inc.php?sid=".$sid."&lang=".$lang."&ModulNeuBez=".$ModulNeuBez;
		 if($cfg['dhtml'])echo '<br/><br/><a href="'.$radio1_file.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>

		<?php
		 break;
}

?>
