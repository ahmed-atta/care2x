<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

switch($retpath)
{
	case "docs": $breakfile="doctors.php?sid=".$sid."&lang=".$lang; break;
	case "op": $breakfile="op-doku.php?sid=".$sid."&lang=".$lang; break;
	default: $breakfile="op-doku.php?sid=".$sid."&lang=".$lang; 
}

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$datum=date("d.m.Y");
$abtarr=array();
$abtname=array();

if(!$hilitedept)
{
	if($dept) $hilitedept=$dept;
	else
	{
	$saal="exclude";
	 include("inc_resolve_opr_dept.php");
	 if($deptOK) $hilitedept=$dept;
	 }
}




$filename=$root_path."global_conf/$lang/op_tag_dept.pid";

$dbtable='care_nursing_dutyplan';

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
 if (file_exists($filename))
 {
 	$i=0;
	$abtname=get_meta_tags($filename);
	while(list($x,$v)=each($abtname))
	{
			$abtarr[]=$x;
			$dept=$x;
		 	$sql="SELECT a_dutyplan,r_dutyplan FROM $dbtable 
							WHERE dept='$dept'
								AND year='$pyear'
								AND month='$pmonth'";
			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
					$content[$i]=$ergebnis->FetchRow();
					//echo $content[$i][a_dutyplan];
					//echo $sql."<br>";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
			$i++;
	}
 }
  else $abtarr[0]="?";
}
  	 else { echo "$LDDbNoLink<br>"; } 
	

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

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
	urlholder="op-pflege-dienstplan-popinfo.php?<?php echo "sid=$sid&lang=$lang" ?>&ln="+l+"&fn="+f+"&bd="+b+"&dept="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=450,menubar=no,resizable=yes,scrollbars=yes");

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
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY  bgcolor="silver" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>



<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDOr $LDDutyPlan $LDQuickView" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('op_duty.php','quick')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>
 
<?php
echo '
	<table  cellpadding="2" cellspacing=0 border="0" >
	<tr bgcolor="aqua" align=center>';

for($j=0;$j<sizeof($LDTabElements);$j++)
	echo '<td><font face="verdana,arial" size="2" ><b>&nbsp; '.$LDTabElements[$j].' &nbsp;&nbsp;</b></td>';
echo '
	</tr>';

$toggler=0;


for ($i=0;$i<sizeof($abtarr);$i++)
	{
	//echo $pday."<br>";

	$aduty=explode("~",$content[$i][a_dutyplan]);
	$rduty=explode("~",$content[$i][r_dutyplan]);
	parse_str(trim($aduty[$pday-1]),$aelems);//echo $aduty[$pday-1];
	parse_str(trim($rduty[$pday-1]),$relems);//echo $rduty[$pday-1];

	if (sizeof($aduty)||sizeof($rduty)) 
	{
		$sql="SELECT list FROM care_nursing_dept_personell_quicklist WHERE
				dept='".$abtarr[$i]."'";
		//echo $sql;
		if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $result=$ergebnis->FetchRow()) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$pinfo=$ergebnis->FetchRow();
					//echo $result[$i][a_dutyplan];
					//echo $sql."<br>";
				}
			}
	}
	$bold="";$boldx="";
	if($hilitedept==$abtarr[$i]) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr bgcolor="#cfcfcf">'; $toggler=1;} 
				else { echo '<tr bgcolor="#f6f6f6">'; $toggler=0;}
	echo '<td ><font face="verdana,arial" size="1">&nbsp;'.$bold.$abtname[$abtarr[$i]].$boldx.'&nbsp;</td><td >&nbsp;<font face="verdana,arial" size="2" >
	<img '.createComIcon($root_path,'mans-gr.gif','0').'>&nbsp;<a href="javascript:popinfo(\''.$aelems[l].'\',\''.$aelems[f].'\',\''.$aelems[b].'\',\''.$abtarr[$i].'\')" title="'.$LDClk2Show.' '.$LDExtraInfo.'"><b>';
	//if ($aelems[l]!="") echo $aelems[l].', ';
	//echo $aelems[f].'</b></a></td>';
	echo $aelems[s].'</b></a></td>';
	echo '<td><font face="verdana,arial" size="2" >';
	if ($aelems[l]!="") 
	{
		$ndl="l=$aelems[l]&f=$aelems[f]&b=$aelems[b]";
		$lbuf=explode("~",$pinfo['list']);
		for($j=0;$j<sizeof($lbuf);$j++)
		{
			if(substr_count($lbuf[$j],$ndl))
			{
				parse_str($lbuf[$j],$tf); 
			 	echo ' <font color=red> '.$tf[df].'</font> / '.$tf[dp];
				break;
			 }
		}
	}
	echo '&nbsp;';
	echo '</td><td ><font face="verdana,arial" size="2" >
	<img '.createComIcon($root_path,'mans-red.gif','0').'>&nbsp;<a href="javascript:popinfo(\''.$relems[l].'\',\''.$relems[f].'\',\''.$relems[b].'\',\''.$abtarr[$i].'\')" title="'.$LDClk2Show.' '.$LDExtraInfo.'"><b>';
	//if ($relems[l]!="") echo $relems[l].', '.$relems[f];
	echo $relems[s].'</b></a></td>';
	echo '<td><font face="verdana,arial" size="2" >';
	if ($relems[l]!="") 
	{
		$ndl="l=$relems[l]&f=$relems[f]&b=$relems[b]";
		$lbuf=explode("~",$pinfo['list']);
		for($j=0;$j<sizeof($lbuf);$j++)
		{
			if(substr_count($lbuf[$j],$ndl))
			{
				parse_str($lbuf[$j],$tf); 
			 	echo ' <font color=red> '.$tf[of].'</font> / '.$tf[op];
				break;
			 }
		}
			
	}
	echo '&nbsp;';
	echo '</td><td >&nbsp; <a href="op-pflege-dienstplan.php?sid='.$sid.'&dept='.$abtarr[$i].'&retpath=qview&lang='.$lang.'">
	<button onClick="javascript:window.location.href=\'op-pflege-dienstplan.php?sid='.$sid.'&dept='.$abtarr[$i].'&retpath=qview&lang='.$lang.'\'"><img '.createComIcon($root_path,'new_address.gif','0','absmiddle').' alt="'.$LDClk2Show.' '.$LDDutyPlan.'">  <font size=1>'.$LDShow.'</font></button></a> </td></tr>';
	echo "\n";

	}

echo '</table>';

?>


<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>">
</a></FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
