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
define("LANG_FILE","doctors.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

switch($retpath)
{
	case "docs": $breakfile="aerzte.php?sid=$sid&lang=$lang"; break;
	case "op": $breakfile="op-doku.php?sid=$sid&lang=$lang"; break;
	default: $breakfile="aerzte.php?sid=$sid&lang=$lang"; 
}

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

if(!$hilitedept)
{
	if($dept) $hilitedept=$dept;
	else
	{
		include("../include/inc_resolve_dept_dept.php");
		if($deptOK) $hilitedept=$dept;
	}
}

$filename="../global_conf/$lang/doctors_abt_list.pid";

if (file_exists($filename))
{
	$abtname=get_meta_tags($filename);
	while(list($x,$v)=each($abtname))
	{
		$abtarr[]=$x;
	}
}
else $abtarr[0]="?";
	



$dbtable="doctors_dutyplan";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
		for($i=0;$i<sizeof($abtarr);$i++)
		{
			$dept=$abtarr[$i];
		 	$sql="SELECT a_dutyplan,r_dutyplan FROM $dbtable 
							WHERE dept='$dept'
								AND year='$pyear'
								AND month='$pmonth'";
			
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$content[$i]=mysql_fetch_array($ergebnis);
					//print $result[$i][a_dutyplan];
					//print $sql."<br>";
				}
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
		} // end of for $i
	}
  	 else { print "$LDDbNoLink<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: none; }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,f,b,d)
{
	urlholder="doctors-dienstplan-popinfo.php?<?php echo "sid=$sid&lang=$lang" ?>&ln="+l+"&fn="+f+"&bd="+b+"&dept="+d+"&user=<?php print $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>

<?php 
require("../include/inc_css_a_hilitebu.php");
?>
</HEAD>
<BODY  bgcolor="silver" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDDocsOnDuty ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('docs_duty_quickview.php')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php print $cfg['body_bgcolor']; ?>" colspan=2>
 
<?php
print '
	<table  cellpadding="2" cellspacing=0 border="0" >
	<tr bgcolor="aqua" align=center>';

for($j=0;$j<sizeof($LDTabElements);$j++)
	print '<td><font face="verdana,arial" size="2" ><b>&nbsp; '.$LDTabElements[$j].' &nbsp;&nbsp;</b></td>';
print '
	</tr>';

$toggler=0;


for ($i=0;$i<sizeof($abtarr);$i++)
	{
	//print $pday."<br>";

	$aduty=explode("~",$content[$i][a_dutyplan]);
	$rduty=explode("~",$content[$i][r_dutyplan]);
	parse_str(trim($aduty[$pday-1]),$aelems);//print $aduty[$pday-1];
	parse_str(trim($rduty[$pday-1]),$relems);//print $rduty[$pday-1];

	if (sizeof($aduty)||sizeof($rduty)) 
	{
		$sql="SELECT list FROM doctors_dept_personell_quicklist WHERE
				dept='".$abtarr[$i]."'";
		//print $sql;
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$pinfo=mysql_fetch_array($ergebnis);
					//print $result[$i][a_dutyplan];
					//print $sql."<br>";
				}
			}
	}
	$bold="";$boldx="";
	if($hilitedept==$abtarr[$i]) 	{ print '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ print '<tr bgcolor="#cfcfcf">'; $toggler=1;} 
				else { print '<tr bgcolor="#f6f6f6">'; $toggler=0;}
	print '<td ><font face="verdana,arial" size="1" >&nbsp;'.$bold.$abtname[$abtarr[$i]].$boldx.'&nbsp;</td><td >&nbsp;<font face="verdana,arial" size="2" >
	<img src="../img/mans-gr.gif" width=12 height=15>&nbsp;<a href="javascript:popinfo(\''.$aelems[l].'\',\''.$aelems[f].'\',\''.$aelems[b].'\',\''.$abtarr[$i].'\')" title="Click für mehr Info."><b>';
	//if ($aelems[l]!="") print $aelems[l].', ';
	//print $aelems[f].'</b></a></td>';
	print $aelems[s].'</b></a></td>';
	print '<td><font face="verdana,arial" size="2" >';
	if ($aelems[l]!="") 
	{
		$ndl="l=$aelems[l]&f=$aelems[f]&b=$aelems[b]";
		$lbuf=explode("~",$pinfo['list']);
		for($j=0;$j<sizeof($lbuf);$j++)
		{
			if(substr_count($lbuf[$j],$ndl))
			{
				parse_str($lbuf[$j],$tf); 
			 	print ' <font color=red> '.$tf[df].'</font> / '.$tf[dp];
				break;
			 }
		}
	}
	print '&nbsp;';
	print '</td><td ><font face="verdana,arial" size="2" >
	<img src="../img/mans-red.gif" width=12 height=15>&nbsp;<a href="javascript:popinfo(\''.$relems[l].'\',\''.$relems[f].'\',\''.$relems[b].'\',\''.$abtarr[$i].'\')" title="Click für mehr Info."><b>';
	if ($relems[l]!="") print $relems[l].', '.$relems[f];
	print '</b></a></td>';
	print '<td><font face="verdana,arial" size="2" >';
	if ($relems[l]!="") 
	{
		$ndl="l=$relems[l]&f=$relems[f]&b=$relems[b]";
		$lbuf=explode("~",$pinfo['list']);
		for($j=0;$j<sizeof($lbuf);$j++)
		{
			if(substr_count($lbuf[$j],$ndl))
			{
				parse_str($lbuf[$j],$tf); 
			 	print ' <font color=red> '.$tf[of].'</font> / '.$tf[op];
				break;
			 }
		}	
	}
	print '&nbsp;';
	print '</td><td >&nbsp; <a href="doctors-dienstplan.php?sid='.$sid.'&dept='.$abtarr[$i].'&retpath=qview&lang='.$lang.'">
	<button onClick="javascript:window.location.href=\'doctors-dienstplan.php?sid='.$sid.'&dept='.$abtarr[$i].'&retpath=qview&lang='.$lang.'\'"><img src="../img/new_address.gif" border=0 width=20 height=20 align="absmiddle" alt="'.$LDShowActualPlan.'" ><font size=1> '.$LDShow.'</font></button></a> </td></tr>';
	print "\n";

	}
print '</table>';
?>
<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" alt="<?php echo $LDCloseAlt ?>">
</a></FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</BODY>
</HTML>
