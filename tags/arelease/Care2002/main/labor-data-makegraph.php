<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if($from!="station")
	if(!$ck_lab_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_lab.php");
require("../req/config-color.php");

$thisfile="labor_datainput.php";
//$breakfile="labor_data_patient_such.php?sid=$ck_sid&lang=$lang";
$breakfile="javascript:window.history.back()";
$fielddata="patnum,name,vorname,gebdatum";

require("../req/labor-param-group.php");

if($parameterselect=="") $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					
//$paramname=$parametergruppe[$parameterselect];
if($nostat) $ret="labor_data_patient_such.php?sid=$ck_sid&lang=$lang&versand=1&keyword=$patnum";
	else $ret="pflege-station-patientdaten.php?sid=$ck_sid&lang=$lang&station=$station&pn=$patnum";
require("../req/db_dbp.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
      <title><?="$LDLabReport - $LDGraph" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>
<? 
require("../req/css-a-hilitebu.php");
?>
<script language="javascript">
<!-- Script Begin

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table  border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?="$LDLabReport - $LDGraph" ?></STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_list.php','graph','','','<?=$LDGraph ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?=$breakfile ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td colspan=2  bgcolor=#dde1ec><p><br>

<FONT    SIZE=-1  FACE="Arial">

<ul>

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?=$LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<? print $patnum; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?="$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><? print  $name; ?>, 
<? print  $vorname; ?>&nbsp;&nbsp;<? print  $gebdatum; ?></b>
</td>
</tr>
</table>
</UL>
<p>
<table border=0 bgcolor=#9f9f9f cellspacing=0 cellpadding=0>
<tr>
<td>


<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>
<? 

print'
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>';
	for($i=0;$i<$colsize;$i++)
	{
	print '
	<td class="a12_b"><font color="#ffffff">&nbsp;<b>';
	$dbuf="date".$i;
	print $$dbuf.'</b>&nbsp;</td>';
	}
	print '
   </tr>';

print'
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;</td>';
	for($i=0;$i<$colsize;$i++)
	{
	print '
	<td class="a12_b"><font color="#0000cc">&nbsp;<b>';
	$dbuf="time".$i;
	print $$dbuf.'</b> '.$LDOClock.'&nbsp;</td>';
	}
	print '
       </tr>';

$pname=explode("~",$params);
$rowsize=sizeof($pname);
	   
	   
$tid=$tid0;
for($i=1;$i<$colsize;$i++)
{
	$dbuf="tid".$i;
	$tid.="~".$$dbuf;
}

for($l=0;$l<$rowsize;$l++)
{
	print'
   <tr bgcolor=';
	 if($toggle) {print '"#ffdddd"'; $toggle=(!$toggle); }else { print '"#ffeeee"';$toggle=(!$toggle);}
   print '>
     <td class="va12_n"> &nbsp;<nobr><a href="#">'.strtr($pname[$l],"_-",". ").'</a></nobr> 
	</td>
	<td class="j">&nbsp;&nbsp;</td>
	<td class="j"  colspan="'.$colsize.'">
	<img src="../imgcreator/labor-datacurve.php?sid='.$ck_sid.'&lang='.$lang.'&patnum='.$patnum.'&parameter='.$pname[$l].'&tid='.$tid.'" border=0>
	</td>';
	print '
	</tr>';
}
	print '
</table>';     

?>                                         
</td></tr>
</table>
</form>

<ul>
<p>
<a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_back2.gif" border="0" width=110 height=24 alt="<?=$LDBack ?>"></a>


</UL>

</FONT>


<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</td>
</tr>
</table>        


</BODY>
</HTML>
