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
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once('../include/inc_front_chain_lang.php');

/* Load date formatter */
require_once('../include/inc_date_format_functions.php');
				

if($mode=='search')
{
 $patnum=(int)$patnum;
 include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
	
	
	// get orig data

	  		$dbtable='care_admission_patient';
		 	$sql="SELECT patnum,name,vorname,gebdatum FROM $dbtable 
					WHERE patnum LIKE '".addslashes($patnum)."'";
			//echo $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows==1)
				{
					//mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					//$pdata=mysql_fetch_array($ergebnis);
					//echo $sql."<br>";
					//echo $rows;
				}
				else $pdata=NULL;
				//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else { echo "$LDDbNoLink<br>$sql"; } 
 }
  	 else { echo "$LDDbNoLink<br>"; } 

}

?>
<html>
<head>
<?php echo setCharSet(); ?>





<script language="javascript">
<!-- Script Begin
function setalldate(d)
{
	if(d) 
	{
		for(n=0;n<document.maindata.maxpic.value;n++) eval("window.parent.SELECTFRAME.srcform.sdate"+n+".value=d");
	}
}

function resetall()
{
	d=document.maindata;
	d.patnum.value="";
	d.lastname.value="";
	d.firstname.value="";
	d.bday.value="";
	d.shotdate.value="";
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>


//  Script End -->
</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>
<script language="javascript" src="../js/setdatetime.js"></script>
</head>
<body topmargin=3 marginheight=3 onLoad="document.maindata.patnum.select()" onFocus="document.maindata.patnum.select()">
<form name="maindata">
<a href="javascript:gethelp('fotolab.php','maindata','')"><img <?php echo createComIcon('../','frage.gif','0','right') ?>></a>
<table border=0>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
<?php echo $LDPatientNr ?>:</td>
    <td><input type="text" name="patnum" size=12 maxlength=18 value="<?php echo $pdata['patnum'] ?>"> <input type="submit" value="<?php echo $LDSearch ?>"></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDName ?>:
<input type="hidden" name="lastname" value="<?php echo $pdata['name'] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata['name'] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDFirstName ?>:
<input type="hidden" name="firstname" value="<?php echo $pdata['vorname'] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata['vorname'] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDBday ?>:
<input type="hidden" name="bday" value="<?php echo$pdata['gebdatum'] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php if($pdata['gebdatum']) echo formatDate2Local($pdata['gebdatum'],$date_format) ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDShotDate ?>:
</td>
<!--     <td><input type="text" name="shotdate" size=12 maxlength=12   onKeyUp="setDate(this);setalldate(window.document.maindata.shotdate.value);" onFocus=this.select()>
 -->   
    <td><input type="text" name="shotdate" size=12 maxlength=12   onBlur="IsValidDate(this,'<?php echo $date_format ?>')"  onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
	<a href="javascript:setalldate(window.document.maindata.shotdate.value)">
<img <?php echo createComIcon('../','preset-add.gif','0') ?> alt="<?php echo $LDSetShotDate ?>"></a></td>
  </tr>
</table>
<input type="hidden" name="maxpic" value="<?php echo $maxpic ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<!-- <input type="button" value="<?php echo $LDReset ?>" onClick="resetall()">
 --></form>

<br>
</body>
</html>
