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
$lang_tables=array('date_time.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
/* Create nursing notes object */
require_once($root_path.'include/care_api_classes/class_notes_nursing.php');
$report_obj= new NursingNotes;

if ($station=='') { $station='p3a';  }
if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

$thisfile=basename(__FILE__);
			
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){
    include_once($root_path.'include/inc_date_format_functions.php');
	if($mode=='save'){
		if($report_obj->saveDailyWardNotes($HTTP_POST_VARS)){
			header("Location:$thisfile".URL_REDIRECT_APPEND."&pn=$pn&station=$station&location_nr=$location_nr");
			exit;
		}else{echo "$sql<p>$LDDbNoUpdate";}
	}else{
		if($d_notes=&$report_obj->getDailyWardNotes($pn)){
    		include_once($root_path.'include/inc_editor_fx.php');
			$occup=true;
		}
		/* Create nursing notes object */
		include_once($root_path.'include/care_api_classes/class_ward.php');
		$ward_obj= new Ward;
	}
}else{
	echo "$LDDbNoLink<br>";
} 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> <?php echo "$LDNotes $station" ?> </TITLE>

<script language="javascript">
<!-- 
var n=false;
function checkForm(f)
{
	if(f.notes.value==""||f.personell_name=="") return false;
	 else return true;
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
 
<?php
if($occup){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDNotes; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDCreatedBy; ?></td>
  </tr>
<?php
	$toggle=0;
	while($row=$d_notes->FetchRow()){
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		$toggle=!$toggle;
		if(!empty($row['short_notes'])) $bgc='yellow';
	
?>


  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['time']) echo $row['time']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#000033">
	<?php 
		if(!empty($row['notes'])) echo deactivateHotHtml(nl2br($row['notes'])); 
		if(!empty($row['short_notes'])) echo '<br>[ '.deactivateHotHtml($row['short_notes']).' ]';
	?>
	</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
?>

 <ul>
 
 <font face="Verdana, Arial" color=#800000>
<?php if($occup)
{
	//echo "<font color=0> ".$LDPatListElements[0].":  $helper[r] $helper[b] - </font>".ucfirst($buf['ln']).", ".ucfirst($buf['fn'])." ".formatDate2Local($buf[g],$date_format); 
}
?>
<form method="post" name=remform action="nursing-station-remarks.php" onSubmit="return checkForm(this)">
<textarea name="notes" cols=60 rows=5 wrap="physical" onKeyup="setChg()"></textarea>
<input type="text" name="personell_name" size=60 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="location_nr" value="<?php echo $location_nr; ?>">
<input type="hidden" name="location_id" value="<?php echo $ward_obj->WardName($location_nr); ?>">
<input type="hidden" name="location_type" value="2"> <!--  location type 2 = ward -->
<input type="hidden" name="mode" value="save">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<!-- <input type="submit" value="<?php echo $LDSave ?>">
 --><p>
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
