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
define("LANG_FILE","specials.php");
$local_user="ck_fotolab_user";
require("../include/inc_front_chain_lang.php");

if($mode=="search")
{
 $patnum=(int)$patnum;
 include("../include/inc_db_makelink.php");
 if($link&&$DBLink_OK) 
	{	
	// get orig data

	  		$dbtable="mahopatient";
		 	$sql="SELECT patnum,name,vorname,gebdatum FROM $dbtable 
					WHERE patnum LIKE '".addslashes($patnum)."'";
			//print $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows==1)
				{
					//mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					//$pdata=mysql_fetch_array($ergebnis);
					//print $sql."<br>";
					//print $rows;
				}
				else $pdata=NULL;
				//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else { print "$LDDbNoLink<br>$sql"; } 
 }
  	 else { print "$LDDbNoLink<br>"; } 

}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" src="../js/setdatetime.js">
</script>

<script language="">
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
//  Script End -->
</script>
</head>
<body topmargin=3 marginheight=3 onLoad="document.maindata.patnum.select()" onFocus="document.maindata.patnum.select()">
<form name="maindata">
<a href="javascript:gethelp('fotolab.php','maindata','')"><img src="../img/frage.gif" border=0 width=15 height=15 align="right"></a>
<table border=0>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
<?php echo $LDPatientNr ?>:</td>
    <td><input type="text" name="patnum" size=12 maxlength=18 value="<?php echo $pdata[patnum] ?>"> <input type="submit" value="<?php echo $LDSearch ?>"></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDName ?>:
<input type="hidden" name="lastname" value="<?php echo $pdata[name] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata[name] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDFirstName ?>:
<input type="hidden" name="firstname" value="<?php echo $pdata[vorname] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata[vorname] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDBday ?>:
<input type="hidden" name="bday" value="<?php echo $pdata[gebdatum] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata[gebdatum] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDShotDate ?>:
</td>
    <td><input type="text" name="shotdate" size=12 maxlength=12   onKeyUp="setDate(this);setalldate(window.document.maindata.shotdate.value);" onFocus=this.select()>
	<a href="javascript:setalldate(window.document.maindata.shotdate.value)">
<img src="../img/preset-add.gif" width=14 height=14 border=0 alt="<?php echo $LDSetShotDate ?>"></a></td>
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
