<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","aufnahme.php");
$local_user="aufnahme_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");

$thisfile="aufnahme_start.php";
$breakfile="startframe.php";

$newdata=1;

$dbtable="mahopatient";

$curdate=date("d.m.Y");
$curtime=date("H.i");

if($patnum=="") 
{
 	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
	{	
		if($update)
			{
				$sql='SELECT * FROM '.$dbtable.' WHERE item="'.$itemname.'"';
        		$ergebnis=mysql_query($sql,$link);
				$zeile=mysql_fetch_array($ergebnis);
		
				//load data
				$patnum=$zeile[patnum];
				$anrede=$zeile[title];
				$name=$zeile[name];
				$vorname=$zeile[vorname];
				$address=$zeile[address];
				$geburtsdatum=$zeile[gebdatum];
				$sex=$zeile[sex];
				$phone=$zeile[phone1];
				$ambu_stat=$zeile[status];
				$kassetype=$zeile[kasse];
				$kassename=$zeile[kassename];
				$diagnose=$zeile[diagnose];
				$referrer=$zeile[referrer];
				$therapie=$zeile[therapie];
				$besonder=$zeile[besonder];
				$aufdatum=$zeile[pdate];
				$aufzeit=$zeile[ptime];	
			}
			else
			{	
				$sql="SELECT * FROM $dbtable ORDER BY item DESC";
        		$ergebnis=mysql_query($sql,$link);

				// count the total entry	
				if($ergebnis)
       				{
						$zeile=mysql_fetch_array($ergebnis);
						$linecount=$zeile[item];
					}
				 else {print "<p>".$sql."<p>$LDDbNoRead";};

				// get the last patient number
				$sql='SELECT * FROM '.$dbtable.' WHERE item="'.$linecount.'"';
        		$ergebnis=mysql_query($sql,$link);
				$zeile=mysql_fetch_array($ergebnis);

				// add one to patient number for new patient
				if(date(Y)<2000) $yb=1; else $yb=date(Y)-2000;
				$yb="2".$yb."000000";
				
         		if($zeile) $patnum=$zeile[patnum]+1; else $patnum=(int)$yb;
				if($patnum<(int)$yb) $patnum+=1000000;
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
			
			   	$aufdatum=$curdate;
				$aufzeit=$curtime;	
			}
			//set default time and date and encoder
			//$aufdatum=$curdate;
			//$aufzeit=$curtime;	
			$encoder=$aufnahme_user;			
	}
  	 else 
		{ print "$LDDbNoLink<br>"; }


// print "from table ".$linecount;
}
// else print "from list ".$linecount;



if (($eingaben=="speichern")or($speichern!=""))
 {

	if($speichern!="forcesave")
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
				include("../include/inc_db_makelink.php");
				if($link&&$DBLink_OK) 
					{
						 if(($update))
						 {
							$itemno=$itemname;		
							$sql='UPDATE '.$dbtable.' SET
									patnum="'.$patnum.'",
									title="'.$anrede.'",
									name="'.$name.'",
									vorname="'.$vorname.'",
									gebdatum="'.$geburtsdatum.'",
									sex="'.$sex.'",
									address="'.$address.'",
									phone1="'.$phone.'",
									status="'.$ambu_stat.'",
									kasse="'.$kassetype.'",
									kassename="'.$kassename.'",
									diagnose="'.$diagnose.'",
									referrer="'.$referrer.'",
									therapie="'.$therapie.'",
									besonder="'.$besonder.'",
									pdate="'.$aufdatum.'",
									ptime="'.$aufzeit.'",
									encoder="'.$encoder.'"
									WHERE item="'.$itemname.'"';
							}	
					 		 else
					  		{
					  			$from="entry";
								$itemno=$linecount+1;
								$sql="INSERT INTO ".$dbtable." 
										(	
										item,
										patnum,
										title,
										name,
										vorname,
										gebdatum,
										sex,
										address,
										phone1,
										status,
										kasse,
										kassename,
										diagnose,
										referrer,
										therapie,
										besonder,
										pdate,
										ptime,
										encoder,
										sdate  ) 
										VALUES (
										'$itemno',
										'$patnum',
										'$anrede',
										'$name', 
										'$vorname', 
										'$geburtsdatum', 
										'$sex',
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
										'$encoder',
										'$sdate'
									)";
							 }

						if(mysql_query($sql,$link))
						{ 
							mysql_close($link);
							header("Location: aufnahme_daten_zeigen.php?sid=$sid&lang=$lang&itemname=$itemno&newdata=&from=$from&newdata=$newdata"); exit;
						}
			 			else {print "<p>".$sql."<p>$LDDbNoSave";};
				}
				 else 	{ print "$LDDbNoLink<br>"; }
     };

 }
 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Aufnahme</TITLE>

<script  language="javascript">
<!-- 
function setsex(d)
{
	s=d.selectedIndex;
	t=d.options[s].text;
	if(t.indexOf("Frau")!=-1) document.aufnahmeform.sex[1].checked=true;
	if(t.indexOf("Herr")!=-1) document.aufnahmeform.sex[0].checked=true;
	if(t.indexOf("-")!=-1){ document.aufnahmeform.sex[0].checked=false;document.aufnahmeform.sex[1].checked=false;}
}

function settitle(d)
{
	if(d.value=="m") document.aufnahmeform.anrede.selectedIndex=2;
	else document.aufnahmeform.anrede.selectedIndex=1;
}

function hidecat()
{
	if(document.images) document.images.catcom.src="../img/pixel.gif";
}

function loadcat()
{

  	cat=new Image();
  	cat.src="../imgcreator/catcom.php?person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+")."&lang=$lang";?>";
  	
}

function showcat()
{

	document.images.catcom.src=cat.src;
}

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>





<?php if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>

	<STYLE TYPE="text/css">

	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	div.cats{
					position: absolute;
					right: 10;
					top: 80;
				}	
	</style>';
}
?>



</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();loadcat();" 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDAdmission ?></STRONG></FONT>
</td>

<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) print "startframe.php?sid=$sid&lang=$lang"; 
	else print "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseWin ?>" width=93 height=41  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=<?php print $cfg['body_bgcolor']; ?>><p><br>

<div class="cats">
<a href="javascript:hidecat()"><img
<?php if($from=="pass")
{ 
    print 'src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" ';
 }
else 
{
	print ' src="../img/pixel.gif" ';
}
?>
align=right id=catcom border=0></a>
</div>
<ul>

<FONT    SIZE=-1  FACE="Arial">

<form method="post" action="<?php print $thisfile; ?>" name="aufnahmeform">

<table border="0" cellspacing=0>


<?php if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle">
	<?php if ($errornum>1) print $LDErrorS; else print $LDError; ?>
</center>
</td>
</tr>
<?php endif; ?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>: 
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><?php print $aufdatum; ?><input name="aufdatum" type="hidden" value="<?php print $aufdatum; ?>">
</td>
<td ><FONT  SIZE=2  FACE="Arial"><?php echo $LDAdmitBy ?>:
</td>
<td><input  name="encoder" type="text" value=<?php if ($encoder!="") print '"'.$encoder.'"' ; else print '"'.$HTTP_COOKIE_VARS[$local_user.$sid].'"' ?> size="28" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitTime ?>:
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><?php print $aufzeit; ?><input name="aufzeit" type="hidden" value="<?php print $aufzeit; ?>">
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td colspan=3>
<input name="patnum" type="hidden"  value="<?php print $patnum; ?>" >
<FONT SIZE=-1  FACE="Arial" color="#800000"><?php print $patnum; ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td >
<input type="text" name="anrede" size=14 maxlength=25 value="<?php echo $anrede ?>">
<!-- 
<select name="anrede"  size="1" onFocus=hidecat() onChange=setsex(this)>
<option value="-" <?php if ($anrede=="-") print "selected"; ?>>-</option>
<option value="Frau" <?php if ($anrede=="Frau") print "selected"; ?>>Frau</option>
<option value="Herr" <?php if ($anrede=="Herr") print "selected"; ?>>Herr</option>
<option value="Frau Dr." <?php if ($anrede=="Frau Dr.") print "selected"; ?>>Frau Dr.</option>
<option value="Herr Dr." <?php if ($anrede=="Herr Dr.") print "selected"; ?>>Herr Dr.</option>
<option value="Frau Prof." <?php if ($anrede=="Frau Prof.") print "selected"; ?>>Frau Prof.</option>
<option value="Herr Prof." <?php if ($anrede=="Herr Prof.") print "selected"; ?>>Herr Prof.</option>
</select> -->

</td>
<td align=right><FONT SIZE=-1  FACE="Arial">
</td>
<!-- <td colspan=3><FONT SIZE=-1  FACE="Arial"><input name="sex" type="radio" value="m" onClick="settitle(this);hidecat()" <?php if($sex=="m") print "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" onClick="settitle(this);hidecat()" <?php if($sex=="f") print "checked"; ?>><?php echo $LDFemale ?>
</td>
 --><td colspan=3><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>: <input name="sex" type="radio" value="m" onClick="hidecat()" <?php if($sex=="m") print "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" onClick="hidecat()" <?php if($sex=="f") print "checked"; ?>><?php echo $LDFemale ?>
</td>

</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorname) print "<font color=red>"; ?><?php echo $LDLastName ?>:
</td>
<td colspan=2><input name="name" type="text" size="25" value="<?php print $name; ?>" onFocus=hidecat()> 
</td>

<td rowspan=4><FONT SIZE=-1  FACE="Arial"><?php if ($erroraddress) print "<font color=red>"; ?><?php echo $LDAddress ?>:<br><textarea rows="5"  cols="23" name="address" onFocus=hidecat()><?php print $address; ?></textarea>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorvorname) print "<font color=red>"; ?><?php echo $LDFirstName ?>:
</td>
<td colspan=2><input name="vorname" type="text" size="25" value="<?php print $vorname; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorgebdatum) print "<font color=red>"; ?><?php echo $LDBday ?>:
</td>
<td  colspan=2><input name="geburtsdatum" type="text" size="25" value="<?php print $geburtsdatum; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorphone) print "<font color=red>"; ?><?php echo $LDPhone ?>:
</td>
<td colspan=2><input name="phone" type="text" size="25" value="<?php print $phone; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td>
</td>
<td  colspan=3><input name="ambu_stat" type="radio"  value="amb" <?php if ($ambu_stat=="amb") print "checked"; ?> onFocus=hidecat()><FONT SIZE=-1  FACE="Arial"><?php if ($errorstatus) print "<font color=red>"; ?><?php echo $LDAmbulant ?>  <input name="ambu_stat" type="radio" value="stat" <?php if ($ambu_stat=="stat") print "checked"; ?> onFocus=hidecat()><?php echo $LDStationary ?>

</td>
</tr>
<tr>
<td>
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
<input name="kassetype" type="radio" value="x" <?php if ($kassetype=="x") print "checked"; ?> onFocus=hidecat()><?php if ($errorkassetype) print "<font color=red>"; ?><?php echo $LDSelfPay ?>  
&nbsp;<input name="kassetype" type="radio" value="privat" onFocus=hidecat()
<?php if ($kassetype=="privat") print "checked"; ?>><?php echo $LDPrivate ?> 
&nbsp;<input name="kassetype" type="radio" value="kasse" onFocus=hidecat()
<?php if ($kassetype=="kasse") print "checked"; ?>><?php echo $LDInsurance ?>:
<?php if (($errorkassename)and($kassetype=="kasse")) print "<font color=red> >>>>"; ?>
</td>
<td><input name="kassename" type="text" size="28" value="<?php print $kassename; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errordiagnose) print "<font color=red>"; ?><?php echo $LDDiagnosis ?>:
</td>
<td colspan=3><input name="diagnose" type="text" size="60" value="<?php print $diagnose; ?>" onFocus=hidecat()> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorreferrer) print "<font color=red>"; ?><?php echo $LDRecBy ?>:
</td>
<td colspan=3><input name="referrer" type="text" size="60" value="<?php print $referrer; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errortherapie) print "<font color=red>"; ?><?php echo $LDTherapy ?>:
</td>
<td colspan=3><input name="therapie" type="text" size="60" value="<?php print $therapie; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorbesonder) print "<font color=red>"; ?><?php echo $LDSpecials ?>:
</td>
<td colspan=3><input name="besonder" type="text" size="60" value="<?php print $besonder; ?>" onFocus=hidecat()>
</td>
</tr>

</table>
<p>
<input type=hidden name=itemname value=<?php print $itemname; ?>>
<input type=hidden name=sid value=<?php print $sid; ?>>
<input type=hidden name=linecount value=<?php print $linecount; ?>>
<input type="hidden" name="sdate" value="<?php echo date("Y.m.d") ?>">
<input type="hidden" name="eingaben" value="speichern">
<input type=hidden name="lang" value="<?php echo $lang; ?>">

<?php if($update) print '<input type=hidden name=update value=1>'; ?>
<input  type="image" src=../img/<?php echo "$lang/$lang" ?>_savedisc.gif border=0 onClick=hidecat() alt="<?php echo $LDSaveData ?>" align="absmiddle"> 
<a href="javascript:document.aufnahmeform.reset()"><img src="../img/<?php echo "$lang/$lang" ?>_reset.gif" border="0" alt="<?php echo $LDResetData ?>" onClick=hidecat()  align="absmiddle"></a>
<?php if($error==1) print '<input type="hidden" name="speichern" value="forcesave">
								<input  type="submit" value="'.$LDForceSave.'">'; ?>
<?php if($update) 
	{ 
		print '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($from=="such") print 'aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang;
			else print 'aufnahme_list.php?sid='.$sid.'&newdata=1&lang='.$lang;
		print '\')"> '; 
	}
?>
</form>

<?php if (!($newdata)) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type=hidden name=sid value=<?php print $sid; ?>>
<input type=hidden name=patnum value="">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=submit value="<?php echo $LDNewForm ?>" onClick=hidecat()>
</form>
<?php endif; ?>

<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_daten_such.php?sid=<?php print "$sid&lang=$lang"; ?>"><?php echo $LDPatientSearch ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_list.php?sid=<?php print "$sid&lang=$lang"; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="#" onClick="showcat()"><?php echo $LDCatPls ?><br>

<p>
<a href="
<?php if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) print 'startframe.php';
	else print 'aufnahme_pass.php';
	print "?sid=$sid&lang=$lang";
?>
"><img border=0 src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</FONT>
</BODY>
</HTML>
