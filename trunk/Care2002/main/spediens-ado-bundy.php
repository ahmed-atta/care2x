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
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

$thisfile="spediens-ado-bundy.php";
$breakfile="spediens-ado.php?sid=".$sid."&lang=".$lang;

$saal="exclude";
require('../include/inc_resolve_opr_dept.php');

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
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)  
	{	
	// get orig data

	  		$dbtable="care_nursing_dept_personell_quicklist";
		 	$sql="SELECT list FROM $dbtable 
					WHERE dept='$dept'";
			//echo $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					$pdata=mysql_fetch_array($ergebnis);
					//echo $sql."<br>";
					//echo $rows;
				}
				//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else  { echo "$LDDbNoRead<br>$sql"; } 
	}
  		else { echo "$LDDbNoLink<br>$sql"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

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
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  height="35">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?php echo $LDDutyPlanOrg ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right   height="35"><a href="javascript:history.back();"><img 
<?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?> 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp()"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> 
align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> 
width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<br><p>
<FONT face="Verdana,Helvetica,Arial" size=4>
<img <?php echo createComIcon('../','icon_clock.gif','0') ?>> <?php echo $LDBundyMachine ?><p></font>

<FONT face="Verdana,Helvetica,Arial" size=3>
<font size=1><a href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=-1"><img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <?php echo $LDPrevMonth ?></a></font> 
<b>&nbsp;<?php echo $monat[(int)$month]." ".$year; ?>&nbsp;</b> 
<font size=1><a href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=1"><?php echo $LDNextMonth ?> <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>></a></font>


<FONT face="Verdana,Helvetica,Arial" size=2>
<table border=1>
<?php
if($datafound)
{
	echo '<tr><td>&nbsp;</td>
	<td> '.$LDEntry.' </td>
	<td> '.$LDExit.' </td>
	<td> '.$LDRemarks.' </td>
	</tr>';  
   $pbuf=explode("~",$pdata['list']);
   for ($i=0;$i<sizeof($pbuf);$i++)
   {
	   parse_str(trim($pbuf[$i]),$persons);
	   echo '
	    <tr>
        <td><FONT face="Verdana,Helvetica,Arial" size=2>
	   ';
	   echo ucfirst($persons[l]).', '.ucfirst($persons[f]).'
	   <br></td>
	   <td>&nbsp;</td>
	   <td>&nbsp;</td>
	   <td>&nbsp;</td>';
       echo '</tr>';
    }
}
?>
</table>


<p><br>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0','middle') ?> alt="<?php echo $LDCancel ?>"></a>

</FONT>
<p>
</ul>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
