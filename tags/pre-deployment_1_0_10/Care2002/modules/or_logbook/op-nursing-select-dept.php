<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;

switch($target){
	case 'search': $title="$LDOrLogBook :: $LDSearch";
					  //$fileforward='op-pflege-logbuch-such-javastart.php'.URL_APPEND.'&retpath='.$retpath;
					  $targetfile='op-pflege-logbuch-such-javastart.php';
					  break;
	case 'archiv': $title="$LDOrLogBook :: $LDArchive";
					  //$fileforward='op-pflege-logbuch-arch-javastart.php'.URL_APPEND.'&retpath='.$retpath;
					  $targetfile='op-pflege-logbuch-arch-javastart.php';
					  break;
	default: $title=$LDOrLogBook;
					  //$fileforward='op-pflege-logbuch-javastart.php'.URL_APPEND.'&retpath='.$retpath;
					  $targetfile='op-pflege-logbuch-javastart.php';
					  break;
}
$dept_ok=false;
$or_ok=false;
/* Check if department nr and OR nr are available from user config*/
if(isset($cfg['thispc_dept_nr'])&&!empty($cfg['thispc_dept_nr'])&&$dept_obj->isSurgery($cfg['thispc_dept_nr'])){
	$dept_nr=$cfg['thispc_dept_nr'];
	$dept_ok=true;
}
if(isset($cfg['thispc_room_nr'])&&!empty($cfg['thispc_room_nr'])&&$dept_obj->isOR($cfg['thispc_room_nr'])){
	$saal=$cfg['thispc_room_nr'];
	$or_ok=true;	
}
if($dept_ok&&$or_ok){
	header("Location:$targetfile".URL_REDIRECT_APPEND."&dept_nr=".$cfg['thispc_dept_nr']."&saal=".$cfg['thispc_room_nr']."&retpath=".$retpath);
	exit;
}

/*
switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}
*/
/* default startpage */
$breakfile = $root_path.'main/op-doku.php'.URL_APPEND;

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

/* Load the department list with oncall doctors */
$dept_DOC=&$dept_obj->getAllActiveWithSurgery();
if(is_array($dept_DOC)) $dlen=sizeof($dept_DOC);
	else $dlen=0;
$ORNrs=&$dept_obj->getAllActiveORNrs();
if(is_object($ORNrs)) $slen=$ORNrs->RecordCount();
	else $slen=0;

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
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
function popinfo(l,d)
{
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}
function check(d)
{	
	var i;
	var n=false;
	var s=false;
	for( i = 0;i<<?php echo $dlen ?>;i++){
		if(d.dept_nr[i].checked){
			n=true;
			break;
		}
	}
	for( i = 0;i<<?php echo $slen ?>;i++){
		if(d.saal[i].checked){
			s=true;
			break;
		}
	}
	if(!n){
		alert("<?php echo $LDAlertNoDeptSelected ?>");
		return false;
	}else if(!s){
		alert("<?php echo $LDAlertNoORSelected ?>");
		return false;
	}else{
		return true;
	}
}
-->
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY  bgcolor="silver" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dept_op_select.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>

<ul>
<form action="<?php echo $targetfile ?>" method="post" name="dept_select" onSubmit="return check(this)">
<table  cellpadding="2"  border=0>
  <tr>
    <td valign="bottom">
		<img <?php echo createComIcon($root_path,'angle_down_l.gif','0','bottom') ?> align="top">
	</td>
	<td valign="top">
		
		<font face=arial color="#990000" size=4>
		<?php echo $LDPlsSelectDept; ?>
		
	</td>
	<td  valign="top">
		&nbsp;
	</td>

  <tr>
    <td colspan=2 valign="top">
	
	<!--  The department list block  -->
		<table  cellpadding="2" cellspacing=0 border="0">
		<?php

			$toggler=0;

			while(list($x,$v)=each($dept_DOC)){
		
				$bold='';
				$boldx='';
				if($dept_nr==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
					elseif ($toggler==0){ echo '<tr bgcolor="#cfcfcf">'; } 
						else { echo '<tr bgcolor="#f6f6f6">';}
				$toggler=!$toggler;
				echo '<td >&nbsp;';

				echo '<input type="radio" name="dept_nr" value="'.$v['nr'].'"';

				if($dept_nr==$v['nr']) echo ' checked';

				echo '>&nbsp;<font face="verdana,arial" size="2" >&nbsp;'.$bold;
				if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
					else echo $v['name_formal'];
				echo $boldx.'&nbsp;</td>';
				echo '<td >&nbsp;';
	
				/*	echo '<a href="'.$fileforward.'&dept_nr='.$v['nr'].'">
				<img '.createLDImgSrc($root_path,'ok_small.gif','0','absmiddle').' alt="'.$LDShowActualPlan.'" ></a>';
				*/	
				echo '</td></tr>';
        		echo "\n";
			}
		?>
		</table>
	<!--  End of department list block  -->
	
	</td>
    <td>
	<!--  Start of the OR room numbers block -->
		<table  cellpadding="2" cellspacing=0 border="0">
    		<tr>
      			<td><font face=arial color="#990000" size=4><?php echo $LDSelectORoomNr; ?></td>
    		</tr>
			<tr>
			<td>
			<table  cellpadding="2" cellspacing=0 border="0">
		<?php
		if(is_object($ORNrs)){
			$toggler=0;

			while($room=$ORNrs->FetchRow()){
		
				$bold='';
				$boldx='';
				if($saal==$room['room_nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
					elseif ($toggler==0){ echo '<tr bgcolor="#cfcfcf">'; } 
						else { echo '<tr bgcolor="#f6f6f6">';}
				$toggler=!$toggler;
				echo '<td >&nbsp;';

				echo '<input type="radio" name="saal" value="'.$room['room_nr'].'"';
				if($saal==$room['room_nr']) echo ' checked';
				echo '>&nbsp;<font face="verdana,arial" size="2" >&nbsp;'.$bold;
				echo $LDORoom.' '.$room['room_nr'];
				
				echo '&nbsp;</td>';
				
				echo '<td ><font face="verdana,arial" size="2" >&nbsp;';

				echo $LDORoom.' '.$room['info'];
				
				echo '&nbsp;</td>
						</tr>
						';
        		echo "\n";
			}
		}
		?>
		</table>
		</td>
		</tr>
		</table>	
	<!--  End of the OR room numbers block -->
	</td>
  </tr>
  </tr>
  
  
    <tr>
      <td colspan=2><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"></a></td>
      <td align="right"><input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>></td>
    </tr>
  
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
</form>

</FONT>

</td>
</tr>
</table>        
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
