<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");

$thisfile="spediens-ado-bundy.php";
$breakfile="spediens-ado.php?sid=$ck_sid&lang=$lang";
/*
if ($dept=="")
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
		else $dept="plop";*/
$saal="exclude";
require("../req/resolve_opr_dept.php");

if(($mondir)&&($month))
{
	if($mondir<0)
	{
		if($month==1)
		{
			 $month=12;
			 $year--;
		}
		else $month--;
	}
	elseif($mondir==1)
	{
		if($month==12)
		{
			 $month=1;
			 $year++;
		}
		else $month++;
    }
}
else
{
if($year=="") $year=date(Y);
if(!$month) $month=date(m);
//if(!$day) $day=date(d);
}
require("../req/db-makelink.php");
if($link&&$DBLink_OK)  
	{	
	// get orig data

	  		$dbtable="nursing_dept_personell_quicklist";
		 	$sql="SELECT list FROM $dbtable 
					WHERE dept='$dept'";
			//print $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					$pdata=mysql_fetch_array($ergebnis);
					//print $sql."<br>";
					//print $rows;
				}
				//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else  { print "$LDDbNoRead<br>$sql"; } 
	}
  		else { print "$LDDbNoLink<br>$sql"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>"  height="35">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?=$LDDutyPlanOrg ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right   height="35"><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp()"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 
align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 
width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<br><p>
<FONT face="Verdana,Helvetica,Arial" size=4>
<img src="../img/icon_clock.gif" width=30 height=23 border=0> <?=$LDBundyMachine ?><p></font>

<FONT face="Verdana,Helvetica,Arial" size=3>
<font size=1><a href="spediens-ado-bundy.php?sid=<?="$ck_sid&lang=$lang&month=$month&year=$year" ?>&mondir=-1"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0> <?=$LDPrevMonth ?></a></font> 
<b>&nbsp;<? print $monat[(int)$month]." ".$year; ?>&nbsp;</b> 
<font size=1><a href="spediens-ado-bundy.php?sid=<?="$ck_sid&lang=$lang&month=$month&year=$year" ?>&mondir=1"><?=$LDNextMonth ?> <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0></a></font>


<FONT face="Verdana,Helvetica,Arial" size=2>
<table border=1>
<?

if($datafound)
{
	
	print '<tr><td>&nbsp;</td>
	<td> '.$LDEntry.' </td>
	<td> '.$LDExit.' </td>
	<td> '.$LDRemarks.' </td>
	</tr>';  
  $pbuf=explode("~",$pdata['list']);
for ($i=0;$i<sizeof($pbuf);$i++)
{
	parse_str(trim($pbuf[$i]),$persons);
	print '
	  <tr>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>
	';
	print ucfirst($persons[l]).', '.ucfirst($persons[f]).'
	<br></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>';
	
  print '</tr>';
}
}

  
?>
</table>


<p><br>
<a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 alt="<?=$LDCancel ?>" align="middle"></a>

</FONT>
<p>
</ul>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.htm");

 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
