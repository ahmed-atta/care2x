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
define("LANG_FILE","radio.php");
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require("../language/".$lang."/lang_".$lang."_radio.php");

$thisfile="radiolog-xray-pat-list.php";

if($mode=='search')
{
 include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
	{	
	// get orig data

	  		$dbtable='care_admission_patient';
		 	$sqlinit="SELECT patnum,name,vorname,gebdatum FROM $dbtable";
			
			if(isset($patnum)&&!empty($patnum))
			{
				if(is_numeric($patnum)) $patnum=(int) $patnum; else $patnum="";
				$sql=$sqlinit." WHERE patnum LIKE '$patnum%'";
			}
			else $sql=NULL;
			
			if(isset($lastname)&&!empty($lastname))
			{
				if(!empty($sql)) $sql=$sql." OR name LIKE '$lastname%'";
					else $sql=$sqlinit." WHERE name LIKE '$lastname%'";
			}
			if(isset($firstname)&&!empty($firstname))
			{
				if(!empty($sql)) $sql=$sql." OR vorname LIKE '$firstname%'";
					else $sql=$sqlinit." WHERE vorname LIKE '$firstname%'";
			}
			if(isset($bday)&&!empty($bday))
			{
				if(!empty($sql)) $sql=$sql." OR gebdatum LIKE '$bday%'";
					else $sql=$sqlinit." WHERE gebdatum LIKE '$bday%'";
			}
			
			if(!empty($sql))
			{
				$sql=$sql." ORDER BY name";
				//echo $sql;
				if($ergebnis=mysql_query($sql,$link))
       			{
					$rows=0;
					if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
					{
						mysql_data_seek($ergebnis,0); //reset the variable
						//$datafound=1;
						//$pdata=mysql_fetch_array($ergebnis);
						//echo $sql."<br>";
						//echo $rows;
					}
					//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
				}
				else echo "$sql<br>$LDDbNoRead";
			}
		}
  		 else { echo "$LDDbNoLink<br>"; }

}

?>
<html>
<head>
<?php echo setCharSet(); ?>

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
</style>

<script language="javascript">
<!-- 

function demopreview(x)
{
	window.parent.PREVIEWFRAME.location.replace('radiolog-xray-display-film.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=preview');
	window.parent.DIAGNOSISFRAME.location.replace('radiolog-xray-diagnosis.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=preview');
	document.plist.xray_pic[x].checked=true;
}

function hilite_bg(x)
{
}
// -->
</script>
</head>
<body leftmargin=0 marginwidth=0>

<form name="plist">
<table border=0 cellpadding=0 cellspacing=0 width="100%">
  <tr>
    <td class="v12"><b>&nbsp;<?php echo $LDCaseNr ?>.</b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDLastName ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDName ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDBday ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDSelect ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDShootDate ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDFullScreen ?></b></td>
  </tr>
   <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>
<?php 
if($rows)
{
	$i=0;
	$img_arrow=createComIcon('../','bul_arrowblusm.gif','0','absmiddle'); // Load the torse icon image
	$img_torso=createComIcon('../','torso.gif','0'); // Load the torse icon image
	while($pdata=mysql_fetch_array($ergebnis))
	{
		echo'
 <tr>
    <td class="v12">&nbsp;'.$pdata[patnum].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[name].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[vorname].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[gebdatum].'&nbsp;</td>
    <td class="v12">&nbsp;<a href="javascript:demopreview('.$i.')">'.$LDPreviewReport.' <img '.$img_arrow.'></a><input type="radio" name="xray_pic" value="1" onFocus="demopreview('.$i.')" >&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[gebdatum].'&nbsp;</td>
    <td class="v12"><a href="javascript:window.top.location.replace(\'radiolog-xray-javastart.php?sid='.$sid.'&lang='.$lang.'&mode=display1\')" title="'.$LDFullScreen.'"><img '.$img_torso.'></a></td>
  </tr>
  <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>';
  	$i++;
  }
	echo '<input type="hidden" name="xray_pic" value="">';
}
?>
  </table>
</form>

</body>
</html>
