<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$aufnahme_user)  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_aufnahme.php");

require("../req/config-color.php");

$thisfile="aufnahme_start.php";
$breakfile="startframe.php";

$error=0;
$errornum=0;
$errorname=0;
$errorvorname=0;
$errorgebdatum=0;
$errorphone=0;
$erroraddress=0;
$errorstatus=0;
$errorkassetype=0;
$errorkassename=0;
$errordiagnose=0;
$errorreferrer=0;
$errortherapie=0;
$errorbesonder=0;
$errorencoder=0;
$errorpatnum=0;

$newdata=1;

$dbtable="mahopatient";


$curdate=date("d.m.Y");
$curtime=date("H.i");

if($patnum=="") 
{
 	include("../req/db-makelink.php");
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
				include("../req/db-makelink.php");
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
							header("Location: aufnahme_daten_zeigen.php?sid=$ck_sid&lang=$lang&itemname=$itemno&newdata=&from=$from&newdata=$newdata"); exit;
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
  	cat.src="../imgcreator/catcom.php?person=<?print strtr($aufnahme_user," ","+")."&lang=$lang";?>";
  	
}

function showcat()
{

	document.images.catcom.src=cat.src;
}

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>





<? if($cfg['dhtml'])
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


<BODY bgcolor="<?print $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();loadcat();" 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?=$LDAdmission ?></STRONG></FONT>
</td>

<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<? 
if($ck_login_logged) print "startframe.php?sid=$ck_sid&lang=$lang"; 
	else print "aufnahme_pass.php?sid=$ck_sid&target=entry&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseWin ?>" width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=<? print $cfg['body_bgcolor']; ?>><p><br>

<div class="cats">
<a href="javascript:hidecat()"><img
<? if($from=="pass")
{ 
print '
src="../imgcreator/catcom.php?lang='.$lang.'&person='.$aufnahme_user.'" ';
//print '
// src="http://www.maryhospital.com/img/cat-com5.png" ';
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

<form method="post" action="<? print $thisfile; ?>" name="aufnahmeform">

<table border="0" cellspacing=0>


<? if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle">
	<? if ($errornum>1) print $LDErrorS; else print $LDError; ?>
</center>
</td>
</tr>
<? endif; ?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAdmitDate ?>: 
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><? print $aufdatum; ?><input name="aufdatum" type="hidden" value="<? print $aufdatum; ?>">
</td>
<td ><FONT  SIZE=2  FACE="Arial"><?=$LDAdmitBy ?>:
</td>
<td><input  name="encoder" type="text" value=<? if ($encoder!="") print '"'.$encoder.'"' ; else print '"'.$aufnahme_user.'"' ?> size="28" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAdmitTime ?>:
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><? print $aufzeit; ?><input name="aufzeit" type="hidden" value="<? print $aufzeit; ?>">
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDCaseNr ?>:
</td>
<td colspan=3>
<input name="patnum" type="hidden"  value="<? print $patnum; ?>" >
<FONT SIZE=-1  FACE="Arial" color="#800000"><? print $patnum; ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTitle ?>:
</td>
<td >
<input type="text" name="anrede" size=14 maxlength=25 value="<?=$anrede ?>">
<!-- 
<select name="anrede"  size="1" onFocus=hidecat() onChange=setsex(this)>
<option value="-" <? if ($anrede=="-") print "selected"; ?>>-</option>
<option value="Frau" <? if ($anrede=="Frau") print "selected"; ?>>Frau</option>
<option value="Herr" <? if ($anrede=="Herr") print "selected"; ?>>Herr</option>
<option value="Frau Dr." <? if ($anrede=="Frau Dr.") print "selected"; ?>>Frau Dr.</option>
<option value="Herr Dr." <? if ($anrede=="Herr Dr.") print "selected"; ?>>Herr Dr.</option>
<option value="Frau Prof." <? if ($anrede=="Frau Prof.") print "selected"; ?>>Frau Prof.</option>
<option value="Herr Prof." <? if ($anrede=="Herr Prof.") print "selected"; ?>>Herr Prof.</option>
</select> -->

</td>
<td align=right><FONT SIZE=-1  FACE="Arial">
</td>
<!-- <td colspan=3><FONT SIZE=-1  FACE="Arial"><input name="sex" type="radio" value="m" onClick="settitle(this);hidecat()" <? if($sex=="m") print "checked"; ?>><?=$LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" onClick="settitle(this);hidecat()" <? if($sex=="f") print "checked"; ?>><?=$LDFemale ?>
</td>
 --><td colspan=3><FONT SIZE=-1  FACE="Arial"><?=$LDSex ?>: <input name="sex" type="radio" value="m" onClick="hidecat()" <? if($sex=="m") print "checked"; ?>><?=$LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" onClick="hidecat()" <? if($sex=="f") print "checked"; ?>><?=$LDFemale ?>
</td>

</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorname) print "<font color=red>"; ?><?=$LDLastName ?>:
</td>
<td colspan=2><input name="name" type="text" size="25" value="<? print $name; ?>" onFocus=hidecat()> 
</td>

<td rowspan=4><FONT SIZE=-1  FACE="Arial"><? if ($erroraddress) print "<font color=red>"; ?><?=$LDAddress ?>:<br><textarea rows="5"  cols="23" name="address" onFocus=hidecat()><? print $address; ?></textarea>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorvorname) print "<font color=red>"; ?><?=$LDFirstName ?>:
</td>
<td colspan=2><input name="vorname" type="text" size="25" value="<? print $vorname; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorgebdatum) print "<font color=red>"; ?><?=$LDBday ?>:
</td>
<td  colspan=2><input name="geburtsdatum" type="text" size="25" value="<? print $geburtsdatum; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorphone) print "<font color=red>"; ?><?=$LDPhone ?>:
</td>
<td colspan=2><input name="phone" type="text" size="25" value="<? print $phone; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td>
</td>
<td  colspan=3><input name="ambu_stat" type="radio"  value="amb" <? if ($ambu_stat=="amb") print "checked"; ?> onFocus=hidecat()><FONT SIZE=-1  FACE="Arial"><? if ($errorstatus) print "<font color=red>"; ?><?=$LDAmbulant ?>  <input name="ambu_stat" type="radio" value="stat" <? if ($ambu_stat=="stat") print "checked"; ?> onFocus=hidecat()><?=$LDStationary ?>

</td>
</tr>
<tr>
<td>
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
<input name="kassetype" type="radio" value="x" <? if ($kassetype=="x") print "checked"; ?> onFocus=hidecat()><? if ($errorkassetype) print "<font color=red>"; ?><?=$LDSelfPay ?>  
&nbsp;<input name="kassetype" type="radio" value="privat" onFocus=hidecat()
<? if ($kassetype=="privat") print "checked"; ?>><?=$LDPrivate ?> 
&nbsp;<input name="kassetype" type="radio" value="kasse" onFocus=hidecat()
<? if ($kassetype=="kasse") print "checked"; ?>><?=$LDInsurance ?>:
<? if (($errorkassename)and($kassetype=="kasse")) print "<font color=red> >>>>"; ?>
</td>
<td><input name="kassename" type="text" size="28" value="<? print $kassename; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errordiagnose) print "<font color=red>"; ?><?=$LDDiagnosis ?>:
</td>
<td colspan=3><input name="diagnose" type="text" size="60" value="<? print $diagnose; ?>" onFocus=hidecat()> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorreferrer) print "<font color=red>"; ?><?=$LDRecBy ?>:
</td>
<td colspan=3><input name="referrer" type="text" size="60" value="<? print $referrer; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errortherapie) print "<font color=red>"; ?><?=$LDTherapy ?>:
</td>
<td colspan=3><input name="therapie" type="text" size="60" value="<? print $therapie; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><? if ($errorbesonder) print "<font color=red>"; ?><?=$LDSpecials ?>:
</td>
<td colspan=3><input name="besonder" type="text" size="60" value="<? print $besonder; ?>" onFocus=hidecat()>
</td>
</tr>

</table>
<p>
<input type=hidden name=itemname value=<? print $itemname; ?>>
<input type=hidden name=sid value=<? print $ck_sid; ?>>
<input type=hidden name=linecount value=<? print $linecount; ?>>
<input type="hidden" name="sdate" value="<?=date("Y.m.d") ?>">
<input type="hidden" name="eingaben" value="speichern">
<input type=hidden name="lang" value="<?print $lang; ?>">

<? if($update) print '<input type=hidden name=update value=1>'; ?>
<input  type="image" src=../img/<?="$lang/$lang" ?>_savedisc.gif border=0 onClick=hidecat() alt="<?=$LDSaveData ?>" align="absmiddle"> 
<a href="javascript:document.aufnahmeform.reset()"><img src="../img/<?="$lang/$lang" ?>_reset.gif" border="0" alt="<?=$LDResetData ?>" onClick=hidecat()  align="absmiddle"></a>
<? if($error==1) print '<input type="hidden" name="speichern" value="forcesave">
								<input  type="submit" value="'.$LDForceSave.'">'; ?>
<? if($update) 
	{ 
		print '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($from=="such") print 'aufnahme_daten_such.php?sid='.$ck_sid.'&lang='.$lang;
			else print 'aufnahme_list.php?sid='.$ck_sid.'&newdata=1&lang='.$lang;
		print '\')"> '; 
	}
?>
</form>

<? if (!($newdata)) : ?>

<form action=<?print $thisfile; ?> method=post>
<input type=hidden name=sid value=<? print $ck_sid; ?>>
<input type=hidden name=patnum value="">
<input type=hidden name="lang" value="<?print $lang; ?>">
<input type=submit value="<?=$LDNewForm ?>" onClick=hidecat()>
</form>
<? endif; ?>

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
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_daten_such.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><?=$LDPatientSearch ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_list.php?sid=<? print "$ck_sid&lang=$lang"; ?>&newdata=1&from=entry"><?=$LDArchive ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="#" onClick="showcat()"><?=$LDCatPls ?><br>

<p>
<a href="
<? if($ck_login_logged) print 'startframe.php';
	else print 'aufnahme_pass.php';
	print "?sid=$ck_sid&lang=$lang";
?>
"><img border=0 src="../img/<?="$lang/$lang" ?>_cancel.gif" alt="<?=$LDCancelClose ?>"></a>
</ul>
<p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
