<?
 {header("Location: http://maryhospital.any.za.php"); exit;}; 

$thisfile="labor_datainput.php";
$breakfile="labor_data_patient_such.php";

$fielddata="mahopatient_item,mahopatient_patnum,mahopatient_name,mahopatient_vorname,mahopatient_gebdatum";

// parameter gruppe
$parametergruppe=array( "Klinische-Chemie","Liquor","Gerinnung","Hämatologie","Blutzucker",
						"Säugling","Proteine","Schilddrüse","Hormone","Tumormarker","Gewebe-AK",
						"Rheumafakt.","Hepatitis","Punktate","Infektionsserologie","Medikamente",
						"Mutterschutzt-Vorsorge","Stuhl","Raritäten","Urin/Spontanurin",
						"Sammelurin","Sonstiges");


// Klinische Chemie parameter
$klinichemie_list0=array(	"Alk.Ph.","Alpha-GT","Ammoniak","Amylase","Billi-gesamt","Billi-direkt",
						"Calcium","Chlorid","Chol","Cholinesterase","CKMB","CPK","CRP","Eisen",
						"Erythrocyten","freis-Hb","GLDH","GOT","GPT","Harnsäure","Harnstoff",
						"HBDH","HDL-Chol","Kalium","Krea","Kupfer","Lactat-i.P.","LDH",
						"LDL-Chol","Lipase","Lipid-Elpho","Magnesium","Myoglobin","Natrium",
						"Osmolal.","Phosphor","Serumzucker","Tri","Troponin-T" );

// Liquor parameter
$liquor_list1=array("Liquorstatus","Liquorelpho","Oligoklonales-IgG","Reiber-Schema","A1");

// Gerinnung parameter
$gerinnung_list2=array("Fibrinolyse","Quick","PTT","PTZ","Fibrinogen","Lösl.Fibr.mon.","FSP-dimer",
						"Thr.Coag.","AT-III","Faktor-VII","APC-Resistenz","Protein-C","Protein-S",
						"Blutungszeit");

//Hämatologie parameter
$haematologie_list3=array("Retikulozyten","Malaria","Hb-Elpho","HLA-B-27","Thrombo-AK","Leukocyten-Phosp.");

// Blutzucker parameter
$blutzucker_list4=array("Blutzucker.nü.","Blutzucker_9.00","Blutzucker_p.p.","Blutzucker_15.00",
						"Blutzucker_ohne_Zeit_1","Blutzucker_ohne_Zeit_2","Glucose-Bel.",
						"Lactose-Bel.","HBA-1c","Fructosamine");

// Säugling parameter
$saeugling_list5=array("Säugling-Bilirubin","Nabelbilirubin","Bilirubin-direkt","Säuglingszucker-1",
						"Säuglingszucker-2","Retikulozyten","B1");

// Proteine parameter
$proteine_list6=array("Ges.Eiweiss","Albumin","Elpho","Immunfixation","Beta-2-Mikroglobulin.i.S",
						"Immunglobulinquant.","IgE","Haptoglobin","Transferrin","Ferritin",
						"Coeruloplasmin","Alpha-1-Antitrypsin","AFP-Grav.","SSW:","Alpha-1-Mikroglobulin");

// Schilddrüse parameter
$schilddruse_list7=array("T3","Thyroxin/T4","TSH-Basal","TSH-stim.","TAK","MAK","TRAK","Thyreoglobulin",
						"Thyroxinbind.Glob.","freies-T3","freies-T4");

// Hormone parameter
$hormone_list8=array("ACTH","Aldosteron","Calcitonin","Cortisol","Cortisol-Tagespr.","FSH",
					 "Gastrin","HCG","Insulin","Katecholam.i.P.","LH","Oestradiol","Oestriol",
						"SSW:","Parathormon","Progesteron","Prolactin-I","Prolactin-II",
						"Renin","Serotonin","Somatomedin-C","Testosteron","C1");

// Tumormarker parameter
$tumormarker_list9=array("AFP","CA_15-3","CA_19-9","CA_125","CEA","Cyfra_21-2","HCG","NSE",
							"PSA","SCC","TPA");

// Gewebe-AK parameter
$gewebeak_list10=array("ANA","AMA","DNS-AK","ASMA","ENA","ANCA");

// Rheumafakt.
$rheumafakt_list11=array("Anti-Strepto-Titer","Lat.RF","Streptozyme","Waaler-Rose");

// Hepatitis parameter
$hepatitis_list12=array("Anti-HAV","Anti-HAV-IgM","Hbs-Antigen","Anti-HBs-Titer","Anti-HBe",
						"Anti-HBc","Anti-HBc_IgM","Anti-HCV","Hep.D-Delta-A.","Anti-HEV");

// Punktate parameter
$punktate_list13=array("Eiweiss-i.Punktat","LDH-i.Punktat","Chol.i.Punktat","CEA-i.Punktat",
						"AFP-i.Punktat","Harns.i.Punktat","Rheumafakt.i.Punktat","D1","D2");

// Infektionsserologie
$infektion_list12=array("Antistaph.Titer","Adenovirus-AK","Borrelien-AK","Borr.Immunoblot",
						"Brucellen-AK","Campylob.-AK","Candida-AK","Cardiotr.Viren",
						"Chlamydien-AK","C.psittaci-AK","Coxsack.-AK","Cox.burn.-AK(Q-Fieber)",
						"Cytomegalie-AK","EBV-AK","Echinococcus-AK","Echo-Viren-AK","FSME-AK",
						"Herpes-simp.-I-AK","Herpes-simp.-II-AK","HIV1/HIV2-AK","Influenza-A-AK",
						"Influenza-B-AK","LCM-AK","Leg.pneum-AK","Leptospiren-AK","Listerien-AK",
						"Masern-AK","Mononucleose","Mumps-AK","Mycoplas.pneum-AK","Neutrope-Viren-AK",
						"Parainfluenza-II-AK","Parainfluenza-III-AK","Picorna-Virus-AK",
						"Rickettsien-AK","Röteln-AK","Röteln-Immunstatus","RS-Virus-AK",
						"Shigellen/Salm-AK","Toxoplasma-AK","TPHA","Varicella-AK","Yersinien-AK",
						"E1","E2","E3","E4");

// Medikamente 
$medikamente_list13=array("Amiodaron","Barbiturate.i.S.","Benzodiazep.i.S.","Carbamazepin",
							"Clonazepam","Digitoxin","Digoxin","Gentamycin","Lithium",
							"Phenobarbital","Phenytoin","Primidon","Salizylsäure","Theophyllin",
							"Tobramycin","Valproinsäure","Vancomycin","Amphetamine.i.U.",
							"Antidepressiva.i.U.","Barbiturate.i.U.","Benzodiazep.i.U.",
							"Cannabinol.i.U.","Kokain.i.U","Methadon.i.U.","Opiate.i.U.");

// Muttersch.-Vorsorge
$muttersch_list14=array("Chlamyd.Abstr./SSW","SSW:","Down-Screening","Strep-B-Schnelltest",
						"TPHA","HBs-Ag","HIV1/HIV2-AK" );

// Stuhl
$stuhl_list15=array("Chymotrypsin","Stuhl-auf-Blut-1","Stuhl-auf-Blut-2","Stuhl-auf-Blut-3");

// Raritäten
$raritaeten_list16=array("Rarität-H.","Rarität-E.","Rarität-S.","Urinrarität","F1","F2","F3");

// Urin / Spontanurin
$urin_list17=array("Urinamylase","Urinzucker","Eiweiss.i.U.","Albumin.i.U.","Osmol.i.U.",
					"Schwangerschaftst.","Cytomeg.i.Urin","Urincytologie","Bence-Jones",
					"Urin-Elpho","Beta2-Mikroglobulin.i.U.");

// Sammelurin
$sammelurin_list18=array("Addis-Count","Na_i.U.","K_i.U.","Ca_i.U.","Phospor_i.U.","Harnsäure_i.U.",
						"Kreatinin_i.U.","Porphyrine_i.U.","Cortisol_i.U.","Hydroxyprolin_i.U.",
						"Katecholamine_i.U.","Pankreol.","Gamma-Aminoläbulinsre.i.U.");

// Sonstiges
$sonstiges_list19=array("Blutalkohol","CDT","Vitamin-B12","Folsäure","Insulin-AK","Intrinsic-AK",
						"Steinanalyse","ACE","G1","G2","G3","G4","G5","G6","G7","G8","G9","G10");


$paralistarray=array($klinichemie_list0,$liquor_list1,$gerinnung_list2,$haematologie_list3,
						$blutzucker_list4,$saeugling_list5,$proteine_list6,$schilddruse_list7,
						$hormone_list8,$tumormarker_list9,$gewebeak_list10,$rheumafakt_list11,
						$hepatitis_list12,$punktate_list13,$infektion_list12,$medikamente_list13,
						$muttersch_list14,$stuhl_list15,$raritaeten_list16,$urin_list17,
						$sammelurin_list18,$sonstiges_list19);

						
if($parameterselect=="") $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					

$error=0;
$errornum=0;
$errorpatnum=0;


$dbname="maho";
$dbsourcetable="mahopatient";
$dbtargettable="maholaborwert";
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";

$curdate=date("d.m.Y");
$curtime=date("H.i");


if($patnum=="") 
{
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
			
			if(!($update))
			{

				$sql="SELECT * FROM ".$dbtargettable;
        		$ergebnis=mysql_query($sql,$link);

				// count the total entry	
				$linecount=0;
				if($ergebnis)
       				{
					while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
					}
				 else {print "<p>".$sql."<p>Das Lesen von Daten aus der Datenbank ist gescheitert.";};

				// get the last patient number
				$sql='SELECT * FROM '.$dbtable.' WHERE mahopatient_item="'.$linecount.'"';
        		$ergebnis=mysql_query($sql,$link);
				$zeile=mysql_fetch_array($ergebnis);

				// add one to patient number for new patient
         		if($zeile) $patnum=$zeile[mahopatient_patnum]+1; else $patnum=20000001;
			
				// reset variables

				$name="";
				$vorname="";
				$address="";
				$geburtsdatum="";
				$phone="";
				$ambu_stat="";
				$kassetype="";
				$kassename="";
				$diagnose="";
				$referrer="";
				$therapie="";
				$besonder="";

			}
			else
			{	
				$sql='SELECT '.$fielddata.' FROM '.$dbsourcetable.' WHERE mahopatient_item="'.$itemname.'"';
        		$ergebnis=mysql_query($sql,$link);
				$zeile=mysql_fetch_array($ergebnis);
		
				//load data
				$itemname=$zeile[mahopatient_item];
				$patnum=$zeile[mahopatient_patnum];
				$name=$zeile[mahopatient_name];
				$vorname=$zeile[mahopatient_vorname];
				$geburtsdatum=$zeile[mahopatient_gebdatum];


			}
			//set default time and date and encoder
			$aufdatum=$curdate;
			$aufzeit=$curtime;	
			$encoder=$aufnahme_user;			
			
		} else print " Tabelle konnte nicht ausgewählt werden.";
	  mysql_close($link);
	}
  	 else 
		{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }


// print "from table ".$linecount;
}
// else print "from list ".$linecount;



if (($eingaben=="Speichern")or($speichern!=""))
 {

	if($speichern!="Trotzdem speichern")
	{
	//clean and check input data variables
	$aufdatum=trim($aufdatum); if ($aufdatum=="")  $aufdatum=$curdate;
	$aufzeit=trim($aufzeit); if($aufzeit=="") $aufzeit=$curtime;
	$encoder=trim($encoder); if($encoder=="") $encoder=$aufnahme_user;
	$patnum=trim($patnum); if ($patnum=="") $patnum=$linecount+20000001;
//	$anrede=trim($anrede); 
	$phone=trim($phone);if ($phone=="") { $errorphone=1; $error=1; $errornum++;};
	$ambu_stat=trim($ambu_stat);if ($ambu_stat=="") { $errorstatus=1; $error=1; $errornum++;};
	$kassetype=trim($kassetype);if ($kassetype=="") { $errorkassetype=1; $error=1; $errornum++;};
	$kassename=trim($kassename);if (($kassetype=="kasse")and($kassename=="")) { $errorkassename=1; $error=1; $errornum++;};
	$diagnose=trim($diagnose);if ($diagnose=="") { $errordiagnose=1; $error=1; $errornum++;};
	$referrer=trim($referrer);if ($referrer=="") { $errorreferrer=1; $error=1; $errornum++;};
	$therapie=trim($therapie);if ($therapie=="") { $errortherapie=1; $error=1; $errornum++;};
	$besonder=trim($besonder);if ($besonder=="") { $errorbesonder=1; $error=1; $errornum++;};
	$name=trim($name); if ($name=="") { $errorname=1; $error=2; $errornum++;};
	$vorname=trim($vorname);if ($vorname=="") { $errorvorname=1; $error=2; $errornum++;};
	$geburtsdatum=trim($geburtsdatum);if ($geburtsdatum=="") { $errorgebdatum=1; $error=2; $errornum++;};
	$address=trim($address);if ($address=="") { $erroraddress=1; $error=2; $errornum++;};
	}
	

	if($error==0) 
	{	

				$link=mysql_connect($dbhost,$dbusername,$dbpassword);
				if ($link)
 				{


					if(mysql_select_db($dbname,$link)) 
	
					{
					 if(!($update))
					  {
						$itemno=$linecount+1;
						$sql="INSERT INTO ".$dbtable." 
						(	mahopatient_item,
							mahopatient_patnum,
							mahopatient_title,
							mahopatient_name,
							mahopatient_vorname,
							mahopatient_gebdatum,
							mahopatient_address,
							mahopatient_phone1,
							mahopatient_status,
							mahopatient_kasse,
							mahopatient_kassename,
							mahopatient_diagnose,
							mahopatient_referrer,
							mahopatient_therapie,
							mahopatient_besonder,
							mahopatient_date,
							mahopatient_time,
							mahopatient_encoder  ) 
						VALUES (
							'$itemno',
							'$patnum',
							'$anrede',
							'$name', 
							'$vorname', 
							'$geburtsdatum', 
							'$address', 
							'$phone', 
							'$ambu_stat', 
							'$kassetype', 
							'$kassename', 
							'$diagnose', 
							'$referrer', 
							'$therapie', 
							'$besonder', 
							'$aufdatum', 
							'$aufzeit',
							'$encoder')";
					 }
					  else
					 {
						$sql='UPDATE '.$dbtable.' SET
							mahopatient_patnum="'.$patnum.'",
							mahopatient_title="'.$anrede.'",
							mahopatient_name="'.$name.'",
							mahopatient_vorname="'.$vorname.'",
							mahopatient_gebdatum="'.$geburtsdatum.'",
							mahopatient_address="'.$address.'",
							mahopatient_phone1="'.$phone.'",
							mahopatient_status="'.$ambu_stat.'",
							mahopatient_kasse="'.$kassetype.'",
							mahopatient_kassename="'.$kassename.'",
							mahopatient_diagnose="'.$diagnose.'",
							mahopatient_referrer="'.$referrer.'",
							mahopatient_therapie="'.$therapie.'",
							mahopatient_besonder="'.$besonder.'",
							mahopatient_date="'.$aufdatum.'",
							mahopatient_time="'.$aufzeit.'",
							mahopatient_encoder="'.$encoder.'"
							WHERE mahopatient_item="'.$itemname.'"';
							
							$itemno=$itemname;

					
					}	

						if(mysql_query($sql,$link))
						{ 
							
							header("Location: aufnahme_daten_zeigen.php?itemname=".$itemno."&route=validroute&newdata=1"); exit;
						
						}
			 			else {print "<p>".$sql."<p>Das Speichern der Daten is gescheitert.";};
 						
				};
				mysql_close($link);
				}
				 else 
				{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }
//		print "</td></tr></table>";
     };

 }
 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Laborwerte Eingabe</TITLE>

<script language="JavaScript1.2">
<!--
        

        function wopenTEST() 
        {       window.open("testpop.php","Realtime4free","width=400,height=590,locationbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,copyhistory=yes,screenX=400,screenY=20,left=400,top=20" );
        }
        function wopen()
        {       window.open("/cassiopeia/NetCommunityPersonalize?path=realtimequotes_20/direkt.html&nick=&sessionid=lurker&nh=0&checksum=", "RealtimeQuoteCenter", "resizable=no,width=780,height=470,locationbar=no,menubar=no,status=no" );
        }
        function openMarktradar()
        {
                winNeu('Marktradar','http://diraba.teledata.de/dab/marketview.html?nick=&sessionid=lurker&nh=0&checksum=',625,480);
        }
        function openPRWin(address, width, height)
        {
                window.open(address, "Preisrechner", "width=" + width + ",height=" + height);
        }
        

// -->
</script>

</HEAD>

<BODY BACKGROUND="leinwand.gif">


<table width=100% border=1>

<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;Laborwerte eingeben</STRONG></FONT>
</td>
<td bgcolor="navy" align=center valign="middle">
<a href="<? print $breakfile; ?>"><img src="../img/exitdoor.gif" border="0"  hspace=3 vspace=3></a>
</td>
<td bgcolor="navy" align="right">
<FONT  COLOR="yellow"  SIZE=-1  FACE="Arial"><STRONG>
<? print date("d.m.Y"); ?><br>
<? print date("H.i"); ?>
</STRONG></FONT>
</td>
</tr>
<tr>
<td colspan=1  bgcolor=#dde1ec><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">


<form method="post" action="<? print $thisfile; ?>">

<table border=0>
<tr>
<td><FONT SIZE=-1  FACE="Arial">Fallnummer:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<? print $patnum; ?>&nbsp;
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial">Name, Vorname, Geburtsdatum:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><? print $name; ?>,</b>
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><? print $vorname; ?></b>&nbsp;&nbsp;
</td>
<td  bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><? print $geburtsdatum; ?></b>
</td>
</tr>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorphone) print "<font color=red>"; ?>Datum der Probeentnahme:
</td>
<td colspan=2
<? if ($newdata) print 'bgcolor=#ffffee>&nbsp;'.$probedate;
   else print '><input name="phone" type="text" size="14" value="'.$curdate.'">';
?>
</td>
</tr>
</table>


<p><FONT SIZE=-1  FACE="Arial">Aktuelle Parametergruppe: <b><? print $parametergruppe[$parameterselect]; ?></b></font>

<table border=1 bgcolor=#ddffee cellspacing=1 cellpadding=5>
<tr>
<td>

<table border="0" cellpadding=0>


<? if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
In <font color=red>rot</font> gekennzeichnet<? if ($errornum>1) print "en"; else print "em"; ?>&nbsp;
Feld<? if ($errornum>1) print "ern"; ?>&nbsp;
fehl<? if ($errornum>1) print "en"; else print "t eine"; ?>&nbsp;
Information<? if ($errornum>1) print "en"; ?>!
</center>
</td>
</tr>
<? endif; ?>


<? 
$paramnum=sizeof($parameters);
//if($paramnum<=10) $count=$paramnum; else $count=10;
$count=$paramnum;
for ($n=0;$n<$count;$n++)
 {
	print '
	<tr>
	<td><FONT SIZE=1  FACE="Arial">';
	if ($errordiagnose) print '<font color=red>'; 
	print 'Parameter &nbsp;&nbsp;</td>	<td';
	if ($paramnum<=100)
	{
	 print ' bgcolor=#ffffee><font face=arial size=1> &nbsp;&nbsp;<b>'.$parameters[$n].'</b>&nbsp;';
	}
	else
	{
		print '><font size=3>
		<select name="parameter'.$n.'" size=1> ';

		 for ($i=0;$i<$paramnum;$i++)
      
			{	print '<option value="'.$parameters[$i].'"';
				if($i==$n) print ' selected';
				print'>'.$parameters[$i].'</option>';print"\n";
			}
			print '</select>';
	}

	print '</td>
	<td><FONT SIZE=1  FACE="Arial">';
	if ($errordiagnose) print '<font color=red>'; 
	print '&nbsp;Wert
	</td>
	<td><font size=2 face=arial><input name="laborwert'.$n.'" type="text" size="8" value="">
	</td>
	</tr>';
 }

?>

<tr>
<td  colspan=3>&nbsp;
</td>
</tr>

<tr>
<td valign=top colspan=2><input type=hidden name=itemname value=<? print $itemname; ?>>
<input type=hidden name=route value=validroute>
<input type=hidden name=linecount value=<? print $linecount; ?>>
<input type=hidden name=parameterselect value=<? print $parameterselect; ?>>
<? if($update) print '<input type=hidden name=update value=1>'; ?>
<input name="eingaben" type="image" value="Speichern" src="../img/save.gif" border=0> 
</td>

<td colspan=2 align=right><FONT SIZE=-1  FACE="Arial">
<? if($error==1) print '<input  type="submit" name=speichern value="Trotzdem speichern">'; ?>
</form>
<? if($update) print '<a href="labor_data_patient_such.php?route=validroute"><img src="../img/beenden.gif" border="0"></a>'; ?>

</td>
</tr>

</table>
<p>

</td>
</tr>
</table>


<br>
<hr width=80% align=left> 


<form action=<? print $thisfile; ?> method=post >
<table border=0>
<tr>
<td colspan=3><FONT SIZE=-1  FACE="Arial"><b>Parametergruppe auswählen</b>
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial">Parametergruppe:
</td>

<td >
<select name=parameterselect size=1>
<? for ($i=0;$i<sizeof($parametergruppe);$i++)
      {
		print '<option value="'.$i.'"';
		if($parameterselect==$i) print ' selected';
		print '>'.$parametergruppe[$i].'</option>';
		print "\n";
	  }	
?>
</select>
</td>

<td>
<input type=hidden name=itemname value="<? print $itemname; ?>">
<input type=hidden name=route value="validroute">
<input type=hidden name=update value="1">
<FONT SIZE=-1  FACE="Arial">&nbsp;<input  type="image" src="../img/auswahl2.gif" border=0>
</td>
</tr>
</tr>

</table>
</form>

</ul>
</FONT>
<p>
</td>

<td colspan=2 bgcolor=#ffffee width=20% valign=top>


<table border=0 cellpadding=5 cellspacing=2>
<tr>
<td valign=top><a href="Javascript:wopenTEST();"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial">Der Parameter, den ich brauche, ist nicht angezeigt!</td>
</tr>
<tr>
<td valign=top><a href="Javascript:wopenTEST();"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial">Aber, ich muss nur ein Paar Werte eingeben!</td>
</tr>
<tr>
<td valign=top><a href="Javascript:wopenTEST();"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial">Wie soll ich die Werte speichern?</td>
</tr>
<tr>
<td valign=top><a href="Javascript:wopenTEST();"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial">Ich habe einen falschen Wert gespeichert. Wie korrigiere ich
das?</td>
</tr>
<tr>
<td valign=top><a href="Javascript:wopenTEST();"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial">I muss einen Vermerk anstatt Wert eingeben. Wie geht das?</td>
</tr>
<tr>
<td valign=top><a href="Javascript:wopenTEST();"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial">Ich bin fertig. Was nun?</td>
</tr>
</table>

</td>
</tr>
</table>        
<p>
<FONT    SIZE=2  FACE="Arial">
<p>
<FORM action="<? print $breakfile; ?>" >
<INPUT type="submit"  value="Logout"></FORM>
<p>
<hr>
<font color=gray size=1>
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elatorilla@t-online.de>elatorilla@t-online.de</a>.
</FONT>



</FONT>


</BODY>
</HTML>