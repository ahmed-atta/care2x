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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

/* Check whether the content is language dependent and set the lang appendix */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $lang_append=' AND lang=\''.$lang.'\'';
}
else 
{
    $lang_append='';
}

if ($station=='') { $station='p3a';  }
if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

$dbtable='care_nursing_station_patients';
			
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{

    include_once($root_path.'include/inc_date_format_functions.php');
    

	$sql='SELECT bed_patient FROM '.$dbtable.' WHERE  s_date=\''.$s_date.'\' AND station=\''.$station.'\''.$lang_append;
																		
																		
	if($ergebnis=$db->Execute($sql))
    {
		if($rows=$ergebnis->RecordCount())
		{
			$result=$ergebnis->FetchRow();
			$occup="1";
		}
	}
	else {echo "$sql<p>$LDDbNoRead"; exit;}
							
	if($mode=='save')
	{
		//echo $result[bed_patient]."<br>";
		$remarks=strtr($remarks,"_","-");
		$buf1="r=$r&b=$b&e=$e&n=$n&t=$t&ln=$ln&fn=$fn&g=$g&s=$s&k=$k";
		//echo $buf1."<br>";
		$buf1=strtr($buf1,"+"," ");
		$buf3=explode("_",$result['bed_patient']);
		for($i=0;$i<sizeof($buf3);$i++)
		{
			$buf3[$i]=strtr($buf3[$i],"+"," ");
			if(substr_count($buf3[$i],$buf1))
			{
				$buf3[$i]=$buf1."&rem=".strtr($remarks," ","+");
				break;
			}
		}
		
		$result[bed_patient]=implode("_",$buf3);
		
		$sql="UPDATE $dbtable SET bed_patient='".addslashes($result['bed_patient'])."'
										 WHERE  s_date='$s_date'
										 	AND	station='$station'
											".$lang_append;
											
		if($ergebnis=$db->Execute($sql))
        {
			$sql="SELECT bed_patient FROM $dbtable WHERE  s_date=\"$s_date\" AND	station=\"$station\"".$lang_append;
			
			if($ergebnis=$db->Execute($sql))
       		{

				if($rows=$ergebnis->RecordCount())
				{
					$remark_saved=1;
					$result=$ergebnis->FetchRow();
					$occup="1";
				}
			}
			else {echo "$sql<p>$LDDbNoRead"; exit;}
							
		}
		else {echo "$sql<p>$LDDbNoUpdate"; exit;}
	} // end of if (mode = save)
}
else { echo "$LDDbNoLink<br>"; } 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> <?php echo "$LDNotes $station" ?> </TITLE>

<script language="javascript">
<!-- 
var n=false;
function checkForm()
{
	if(n) return true;
	return false;
}
function setChg()
{
	n=true;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus();<?php if(($mode=='save')&&($occup)) echo "window.opener.location.reload();window.focus();"; ?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=4  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo $LDNotes.' '.strtoupper($station).' ('.formatDate2Local($s_date,$date_format).')'; ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','remarks','','<?php echo $station ?>','<?php echo $LDNotes ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  
<?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul><font face="Verdana, Arial" color=#800000>
<?php if($occup)
{

//echo $result[bed_patient];
$buf=explode("_",trim($result['bed_patient']));
	
		for($k=0;$k<sizeof($buf);$k++)
		{
			parse_str(trim($buf[$k]),$helper);
			//foreach($helper as $v) echo $v;
			if  ((trim($helper[n])==$pn)&&(trim($helper[fn])==$patient)){  break;} 
			$helper="";
		}
echo "<font color=0> ".$LDPatListElements[0].":  $helper[r] $helper[b] - </font>".ucfirst($helper['ln']).", ".ucfirst($helper['fn'])." ".formatDate2Local($helper[g],$date_format); 
}
?>
<form method=post name=remform action="nursing-station-remarks.php" onSubmit="return checkForm()">
<textarea name="remarks" cols=60 rows=17 wrap="physical" onKeyup="setChg()"><?php  echo str_replace("\\","",$helper['rem']);?></textarea>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="r" value="<?php echo $helper['r'] ?>">
<input type="hidden" name="b" value="<?php echo $helper['b'] ?>">
<input type="hidden" name="n" value="<?php echo $helper['n'] ?>">
<input type="hidden" name="e" value="<?php echo $helper['e'] ?>">
<input type="hidden" name="t" value="<?php echo strtr($helper['t']," ","+") ?>">
<input type="hidden" name="ln" value="<?php echo strtr($helper['ln']," ","+") ?>">
<input type="hidden" name="fn" value="<?php echo strtr($helper['fn']," ","+") ?>">
<input type="hidden" name="g" value="<?php echo $helper['g'] ?>">
<input type="hidden" name="s" value="<?php echo $helper['s'] ?>">
<input type="hidden" name="k" value="<?php echo $helper['k'] ?>"><br>
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="patient" value="<?php echo $patient ?>">
<!-- <input type="submit" value="<?php echo $LDSave ?>">
 -->
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif') ?>>
 
</form>

</font>
<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>

</ul>

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
