<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
require_once('../include/inc_date_format_functions.php');

/*if(empty($date_format))
{
   $date_format=getDateFormat($link,$DBLink_OK);
}
*/


$thisfile='aufnahme_start.php';
$breakfile='startframe.php';

$newdata=1;

$dbtable='care_admission_patient';

$curdate=date('Y-m-d');
$curtime=date('H:i:s');

if($patnum=='') 
{
 	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
	{	
		if($update)
			{
				$sql='SELECT * FROM '.$dbtable.' WHERE item="'.$itemname.'"';
        		$ergebnis=mysql_query($sql,$link);
				$zeile=mysql_fetch_array($ergebnis);
		
				//load data
				$patnum=$zeile['patnum'];
				$anrede=$zeile['title'];
				$name=$zeile['name'];
				$vorname=$zeile['vorname'];
				$address=$zeile['address'];
				$geburtsdatum=$zeile['gebdatum'];
				$sex=$zeile['sex'];
				$phone=$zeile['phone1'];
				$ambu_stat=$zeile['status'];
				$kassetype=$zeile['kasse'];
				$kassename=$zeile['kassename'];
				$diagnose=$zeile['diagnose'];
				$referrer=$zeile['referrer'];
				$therapie=$zeile['therapie'];
				$besonder=$zeile['besonder'];
				$aufdatum=$zeile['pdate'];
				$aufzeit=$zeile['ptime'];	
			}
			else
			{	
				$sql="SELECT item FROM $dbtable ORDER BY item DESC LIMIT 1";
        		$ergebnis=mysql_query($sql,$link);

				// count the total entry	
				if($ergebnis)
       				{
						$zeile=mysql_fetch_array($ergebnis);
						$linecount=$zeile['item'];
					}
				 else {echo "<p>".$sql."<p>$LDDbNoRead";};

				// get the last patient number
				$sql='SELECT * FROM '.$dbtable.' WHERE item="'.$linecount.'"';
        		$ergebnis=mysql_query($sql,$link);
				$zeile=mysql_fetch_array($ergebnis);

				// add one to patient number for new patient
				$Ybuffer=date('Y');
				if($Ybuffer<2000) $actMil=1900;
				 else $actMil=2000;
				if(date(Y)<$actMil) $yb=1; else $yb=date(Y)-$actMil;
				$yb="2".$yb."000000";
				
         		if($zeile) $patnum=$zeile[patnum]+1; else $patnum=(int)$yb;
				if($patnum<(int)$yb) $patnum+=1000000;
				// reset variables

				$name='';
				$vorname='';
				$address='';
				$geburtsdatum='';
				$phone='';
				$ambu_stat='';
				$kassetype='';
				$kassename='';
				$diagnose='';
				$referrer='';
				$therapie='';
				$besonder='';
			
			   	$aufdatum=$curdate;
				$aufzeit=$curtime;	
			}
			//set default time and date and encoder
			//$aufdatum=$curdate;
			//$aufzeit=$curtime;	
			$encoder=$aufnahme_user;			
	}
  	 else 
		{ echo "$LDDbNoLink<br>"; }


// echo "from table ".$linecount;
}
// else echo "from list ".$linecount;



if (($eingaben=="speichern")or($speichern!=''))
 {

	if($speichern!="forcesave")
	{
	//clean and check input data variables
	$aufdatum=trim($aufdatum); if ($aufdatum=='')  $aufdatum=$curdate;
	$aufzeit=trim($aufzeit); if($aufzeit=='') $aufzeit=$curtime;
	$encoder=trim($encoder); if($encoder=='') $encoder=$aufnahme_user;
	$patnum=trim($patnum); if ($patnum=='') $patnum=$linecount+20000001;
//	$anrede=trim($anrede); 
	$phone=trim($phone);if ($phone=='') { $errorphone=1; $error=1; $errornum++;};
	$ambu_stat=trim($ambu_stat);if ($ambu_stat=='') { $errorstatus=1; $error=1; $errornum++;};
	$kassetype=trim($kassetype);if ($kassetype=='') { $errorkassetype=1; $error=1; $errornum++;};
	$kassename=trim($kassename);if (($kassetype=="kasse")and($kassename=='')) { $errorkassename=1; $error=1; $errornum++;};
	$diagnose=trim($diagnose);if ($diagnose=='') { $errordiagnose=1; $error=1; $errornum++;};
	$referrer=trim($referrer);if ($referrer=='') { $errorreferrer=1; $error=1; $errornum++;};
	$therapie=trim($therapie);if ($therapie=='') { $errortherapie=1; $error=1; $errornum++;};
	$besonder=trim($besonder);if ($besonder=='') { $errorbesonder=1; $error=1; $errornum++;};
	$name=trim($name); if ($name=='') { $errorname=1; $error=2; $errornum++;};
	$vorname=trim($vorname);if ($vorname=='') { $errorvorname=1; $error=2; $errornum++;};
	$geburtsdatum=trim($geburtsdatum);if ($geburtsdatum=='') { $errorgebdatum=1; $error=2; $errornum++;};
	$address=trim($address);if ($address=='') { $erroraddress=1; $error=2; $errornum++;};
	}
	

	if($error==0) 
	{	
				include('../include/inc_db_makelink.php');
				if($link&&$DBLink_OK) 
					{
						 if(($update))
						 {
							//echo formatDate2STD($geburtsdatum,$date_format);
							$itemno=$itemname;		
							$sql='UPDATE '.$dbtable.' SET
									patnum="'.$patnum.'",
									title="'.$anrede.'",
									name="'.$name.'",
									vorname="'.$vorname.'",
									gebdatum="'.formatDate2STD($geburtsdatum,$date_format).'",
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
									encoder="'.$encoder.'",
									modify_id="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"
									WHERE item="'.$itemname.'"';
							}	
					 		 else
					  		{
					  			$from="entry";
								$sql="INSERT INTO ".$dbtable." 
										(	
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
										sdate,
										create_id,
										create_time 
										 ) 
										VALUES 
										(
										'$patnum',
										'$anrede',
										'$name', 
										'$vorname', 
										'".formatDate2STD($geburtsdatum,$date_format)."', 
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
										'$sdate',
										'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
										NULL
									)";
							 }

						if(mysql_query($sql,$link))
						{ 
						    if(!$update) $itemno=mysql_insert_id($link);
							mysql_close($link);
							header("Location: aufnahme_daten_zeigen.php?sid=$sid&lang=$lang&itemname=$itemno&newdata=&from=$from&newdata=$newdata"); exit;
						}
			 			else {echo "<p>".$sql."<p>$LDDbNoSave";};
				}
				 else 	{ echo "$LDDbNoLink<br>"; }
     };

 }


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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
	if(document.images) document.images.catcom.src="../gui/img/common/default/pixel.gif";
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
	if (!x) x='';
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>

-->
</script>

<script language="javascript" src="../js/setdatetime.js"></script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>




<?php if($cfg['dhtml'])
{ echo' 
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
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDAdmission ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>

<div class="cats">
<a href="javascript:hidecat()"><img
<?php if($from=="pass")
{ 
    echo 'src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" ';
 }
else 
{
	echo ' src="../gui/img/common/default/pixel.gif" ';
}
?>
align=right id=catcom border=0></a>
</div>
<ul>

<FONT    SIZE=-1  FACE="Arial">

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform">

<table border="0" cellspacing=0 cellpadding=0>


<?php if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
<img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php if ($errornum>1) echo $LDErrorS; else echo $LDError; ?>
</center>
</td>
</tr>
<?php endif; ?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>: 
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 

    echo formatDate2Local($aufdatum,$date_format); 

?>
<input name="aufdatum" type="hidden" value="<?php echo $aufdatum; ?>">
</td>
<td align="right"><nobr><FONT  SIZE=2  FACE="Arial"><?php echo $LDAdmitBy ?>:
<input  name="encoder" type="text" value=<?php if ($encoder!='') echo '"'.$encoder.'"' ; else echo '"'.$HTTP_COOKIE_VARS[$local_user.$sid].'"' ?> size="28" onFocus=hidecat()>
</nobr></td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitTime ?>:
</td>
<td ><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo convertTimeToLocal($aufzeit); ?><input name="aufzeit" type="hidden" value="<?php echo $aufzeit; ?>">
</td>
</tr>
<tr>
<td colspan=3><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td colspan=2>
<input name="patnum" type="hidden"  value="<?php echo $patnum; ?>" >
<FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $patnum; ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td >
<input type="text" name="anrede" size=14 maxlength=25 value="<?php echo $anrede ?>">
<!-- 
<select name="anrede"  size="1" onFocus=hidecat() onChange=setsex(this)>
<option value="-" <?php if ($anrede=="-") echo "selected"; ?>>-</option>
<option value="Frau" <?php if ($anrede=="Frau") echo "selected"; ?>>Frau</option>
<option value="Herr" <?php if ($anrede=="Herr") echo "selected"; ?>>Herr</option>
<option value="Frau Dr." <?php if ($anrede=="Frau Dr.") echo "selected"; ?>>Frau Dr.</option>
<option value="Herr Dr." <?php if ($anrede=="Herr Dr.") echo "selected"; ?>>Herr Dr.</option>
<option value="Frau Prof." <?php if ($anrede=="Frau Prof.") echo "selected"; ?>>Frau Prof.</option>
<option value="Herr Prof." <?php if ($anrede=="Herr Prof.") echo "selected"; ?>>Herr Prof.</option>
</select> -->

</td>

<!-- <td colspan=3><FONT SIZE=-1  FACE="Arial"><input name="sex" type="radio" value="m" onClick="settitle(this);hidecat()" <?php if($sex=="m") echo "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" onClick="settitle(this);hidecat()" <?php if($sex=="f") echo "checked"; ?>><?php echo $LDFemale ?>
</td>
 --><td colspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>: <input name="sex" type="radio" value="m" onClick="hidecat()" <?php if($sex=="m") echo "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" onClick="hidecat()" <?php if($sex=="f") echo "checked"; ?>><?php echo $LDFemale ?>
</td>

</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorname) echo "<font color=red>"; ?><?php echo $LDLastName ?>:
</td>
<td colspan=2><input name="name" type="text" size="35" value="<?php echo $name; ?>" onFocus=hidecat()> 
</td>


</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorvorname) echo "<font color=red>"; ?><?php echo $LDFirstName ?>:
</td>
<td colspan=2><input name="vorname" type="text" size="35" value="<?php echo $vorname; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorgebdatum) echo "<font color=red>"; ?><?php echo $LDBday ?>:
</td>
<td  colspan=2><FONT SIZE=-1  FACE="Arial">
<input name="geburtsdatum" type="text" size="15" maxlength=10 value="<?php 
                                                                                            if($geburtsdatum)
																							{
																							    if($error) echo $geburtsdatum; 
																								   else echo formatDate2Local($geburtsdatum,$date_format);
																							}
																							
																							/* Uncomment the following when the current date must be inserted
																							*    automatically at the start of each document
																							*/
																							
																							/*else 
																							{
																							   echo formatDate2Local(date('Y-m-d'),$date_format);
																							 }*/
																					  ?>"
 onFocus="hidecat(); this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
 [ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</td>
</tr>
<!--   
 --><tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($erroraddress) echo "<font color=red>"; ?><?php echo $LDAddress ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial"><textarea rows="5"  cols="30" name="address" onFocus=hidecat()><?php echo $address; ?></textarea>
</td>
</tr>


<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorphone) echo "<font color=red>"; ?><?php echo $LDPhone ?>:
</td>
<td colspan=2><input name="phone" type="text" size="35" value="<?php echo $phone; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td>
</td>
<td  colspan=2><input name="ambu_stat" type="radio"  value="amb" <?php if ($ambu_stat=="amb") echo "checked"; ?> onFocus=hidecat()><FONT SIZE=-1  FACE="Arial"><?php if ($errorstatus) echo "<font color=red>"; ?><?php echo $LDAmbulant ?>  <input name="ambu_stat" type="radio" value="stat" <?php if ($ambu_stat=="stat") echo "checked"; ?> onFocus=hidecat()><?php echo $LDStationary ?>

</td>
</tr>
<tr>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<input name="kassetype" type="radio" value="x" <?php if ($kassetype=="x") echo "checked"; ?> onFocus=hidecat()><?php if ($errorkassetype) echo "<font color=red>"; ?><?php echo $LDSelfPay ?>  
&nbsp;<input name="kassetype" type="radio" value="privat" onFocus=hidecat()
<?php if ($kassetype=="privat") echo "checked"; ?>><?php echo $LDPrivate ?> 
&nbsp;<input name="kassetype" type="radio" value="kasse" onFocus=hidecat()
<?php if ($kassetype=="kasse") echo "checked"; ?>><?php echo $LDInsurance ?>:
<?php if (($errorkassename) && ($kassetype=="kasse")) echo "<font color=red> >>>>"; ?>
</td>
<td><input name="kassename" type="text" size="28" value="<?php echo $kassename; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errordiagnose) echo "<font color=red>"; ?><?php echo $LDDiagnosis ?>:
</td>
<td colspan=2><input name="diagnose" type="text" size="60" value="<?php echo $diagnose; ?>" onFocus=hidecat()> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorreferrer) echo "<font color=red>"; ?><?php echo $LDRecBy ?>:
</td>
<td colspan=2><input name="referrer" type="text" size="60" value="<?php echo $referrer; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errortherapie) echo "<font color=red>"; ?><?php echo $LDTherapy ?>:
</td>
<td colspan=2><input name="therapie" type="text" size="60" value="<?php echo $therapie; ?>" onFocus=hidecat()>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php if ($errorbesonder) echo "<font color=red>"; ?><?php echo $LDSpecials ?>:
</td>
<td colspan=2><input name="besonder" type="text" size="60" value="<?php echo $besonder; ?>" onFocus=hidecat()>
</td>
</tr>

</table>
<p>
<input type=hidden name="itemname" value=<?php echo $itemname; ?>>
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name=linecount value=<?php echo $linecount; ?>>
<input type="hidden" name="sdate" value="<?php echo date("Y.m.d") ?>">
<input type="hidden" name="eingaben" value="speichern">
<input type=hidden name="date_format" value="<?php echo $date_format; ?>">

<?php if($update) echo '<input type=hidden name=update value=1>'; ?>
<input  type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?> onClick=hidecat() alt="<?php echo $LDSaveData ?>" align="absmiddle"> 
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc('../','reset.gif','0') ?> alt="<?php echo $LDResetData ?>" onClick=hidecat()  align="absmiddle"></a>
<?php if($error==1) echo '<input type="hidden" name="speichern" value="forcesave">
								<input  type="submit" value="'.$LDForceSave.'">'; ?>
<?php if($update) 
	{ 
		echo '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($from=="such") echo 'aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang;
			else echo 'aufnahme_list.php?sid='.$sid.'&newdata=1&lang='.$lang;
		echo '\')"> '; 
	}
?>
</form>

<?php if (!($newdata)) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type=hidden name=sid value=<?php echo $sid; ?>>
<input type=hidden name=patnum value="">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="date_format" value="<?php echo $date_format; ?>">
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="aufnahme_daten_such.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="aufnahme_list.php?sid=<?php echo "$sid&lang=$lang"; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="#" onClick="showcat()"><?php echo $LDCatPls ?><br>

<p>
<a href="
<?php if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo 'startframe.php';
	else echo 'aufnahme_pass.php';
	echo "?sid=".$sid."&lang=".$lang;
?>
"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>
</BODY>
</HTML>
