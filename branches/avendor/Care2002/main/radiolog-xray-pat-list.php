<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_radio.php");

$thisfile="radiolog-xray-pat-list.php";

if($mode=="search")
{
 include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
	{	
	// get orig data

	  		$dbtable="mahopatient";
		 	$sqlinit="SELECT patnum,name,vorname,gebdatum FROM $dbtable";
			
			if(!empty($patnum))
				if(is_numeric($patnum)) $patnum=(int) $patnum; else $patnum="";
			if(!empty($patnum))
				$sql=$sqlinit." WHERE patnum LIKE '$patnum%'";
			if(!empty($lastname))
			{
				if(!empty($sql)) $sql=$sql." OR name LIKE '$lastname%'";
					else $sql=$sqlinit." WHERE name LIKE '$lastname%'";
			}
			if(!empty($firstname))
			{
				if(!empty($sql)) $sql=$sql." OR vorname LIKE '$firstname%'";
					else $sql=$sqlinit." WHERE vorname LIKE '$firstname%'";
			}
			if(!empty($bday))
			{
				if(!empty($sql)) $sql=$sql." OR gebdatum LIKE '$bday%'";
					else $sql=$sqlinit." WHERE gebdatum LIKE '$bday%'";
			}
			
			if(!empty($sql))
			{
				$sql=$sql." ORDER BY name";
				//print $sql;
				if($ergebnis=mysql_query($sql,$link))
       			{
					$rows=0;
					if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
					{
						mysql_data_seek($ergebnis,0); //reset the variable
						//$datafound=1;
						//$pdata=mysql_fetch_array($ergebnis);
						//print $sql."<br>";
						//print $rows;
					}
					//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
				}
				else print "$sql<br>$LDDbNoRead";
			}
		}
  		 else { print "$LDDbNoLink<br>"; }

}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
</style>

<script language="javascript">
<!-- 

function demopreview(x)
{
	window.parent.PREVIEWFRAME.location.replace('radiolog-xray-display-film.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=preview');
	window.parent.DIAGNOSISFRAME.location.replace('radiolog-xray-diagnosis.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=preview');
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
    <td class="v12"><b>&nbsp;<?=$LDCaseNr ?>.</b></td>
    <td class="v12"><b>&nbsp;<?=$LDLastName ?></b></td>
    <td class="v12"><b>&nbsp;<?=$LDName ?></b></td>
    <td class="v12"><b>&nbsp;<?=$LDBday ?></b></td>
    <td class="v12"><b>&nbsp;<?=$LDSelect ?></b></td>
    <td class="v12"><b>&nbsp;<?=$LDShootDate ?></b></td>
    <td class="v12"><b>&nbsp;<?=$LDFullScreen ?></b></td>
  </tr>
   <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>
<? 
if($rows)
{
	$i=0;
	while($pdata=mysql_fetch_array($ergebnis))
	{
		print'
 <tr>
    <td class="v12">&nbsp;'.$pdata[patnum].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[name].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[vorname].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[gebdatum].'&nbsp;</td>
    <td class="v12">&nbsp;<a href="javascript:demopreview('.$i.')">'.$LDPreviewReport.' <img src="../img/bul_arrowBluSm.gif" border=0 width=12 height=12 align="absmiddle"></a><input type="radio" name="xray_pic" value="1" onFocus="demopreview('.$i.')" >&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[gebdatum].'&nbsp;</td>
    <td class="v12"><a href="javascript:window.top.location.replace(\'radiolog-xray-javastart.php?sid='.$ck_sid.'&lang='.$lang.'&mode=display1\')" title="'.$LDFullScreen.'"><img src="../img/torso.gif" width=18 height=18 border=0></a></td>
  </tr>
  <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>';
  	$i++;
  }
	print '<input type="hidden" name="xray_pic" value="">';
}
?>
  </table>
</form>

</body>
</html>
