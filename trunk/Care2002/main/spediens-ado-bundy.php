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
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$thisfile="spediens-ado-bundy.php";
$breakfile="spediens-ado.php?sid=$sid&lang=$lang";

$saal="exclude";
require("../include/inc_resolve_opr_dept.php");

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
require("../include/inc_db_makelink.php");
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
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>"  height="35">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?php echo $LDDutyPlanOrg ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align=right   height="35"><a href="javascript:history.back();"><img 
src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp()"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 
align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 
width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<br><p>
<FONT face="Verdana,Helvetica,Arial" size=4>
<img src="../img/icon_clock.gif" width=30 height=23 border=0> <?php echo $LDBundyMachine ?><p></font>

<FONT face="Verdana,Helvetica,Arial" size=3>
<font size=1><a href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=-1"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0> <?php echo $LDPrevMonth ?></a></font> 
<b>&nbsp;<?php print $monat[(int)$month]." ".$year; ?>&nbsp;</b> 
<font size=1><a href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=1"><?php echo $LDNextMonth ?> <img src="../img/bul_arrowgrnlrg.gif" width=16 height=16 border=0></a></font>


<FONT face="Verdana,Helvetica,Arial" size=2>
<table border=1>
<?php
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
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 alt="<?php echo $LDCancel ?>" align="middle"></a>

</FONT>
<p>
</ul>
</td>
</tr>

<tr>
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
