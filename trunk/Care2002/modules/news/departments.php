<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');

define('LANG_FILE','abteilung.php');
define('NO_2LEVEL_CHK',1);

require_once($root_path.'include/inc_front_chain_lang.php');


require_once($root_path.'include/inc_config_color.php');
if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');

$HTTP_SESSION_VARS['sess_user_origin']='dept';

$default_url_news='modules/news/newscolumns.php';

$breakfile=$root_path.$HTTP_SESSION_VARS['sess_file_referer'].URL_APPEND;
$returnfile=$breakfile;

$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {

    /* dept type = 1 = medical */

    $sql='SELECT dept.nr, dept.name_formal, dept.LD_var,
	                    dept.work_hours, dept.consult_hours, 
						reg.news_start_script 
						FROM care_department as dept LEFT JOIN care_registry AS reg ON dept.id=reg.registry_id 
						WHERE type=1 AND is_inactive=0 ORDER BY sort_order';
						
    //$sql='SELECT nr, name_formal, work_hours, consult_hours, url_news FROM care_department WHERE  is_inactive=0 ORDER BY sort_order';
	
	if ($result = $db->Execute($sql)) {
	
	    $rows = $result->RecordCount();
	}
}
else {
    echo "$LDDbNoLink<p>";
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDPageTitle ?></TITLE>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>

<script language="">
<!-- Script Begin
function gethelp(x)
{
	urlholder="help-router.php?helpidx="+x+"&lang=<?php echo $lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
//  Script End -->
</script>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG>&nbsp; &nbsp;<?php echo $LDPageTitle ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="#" onClick=history.back()><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?>
<a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?php echo "$sid&lang=$lang";?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#000000>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff background="../../gui/img/common/default/tableHeaderbg.gif">
      <td><font face="Verdana,arial" size=2><b><?php echo $LDDeptTxt ?></b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2><b><?php echo $LDOpenHrsTxt ?></b></font></td>
      <td><font face="Verdana,arial" size=2><b><?php echo $LDChkHrsTxt ?></b></font></td>
    </tr>
<?php 
$toggle=0;
if($rows) {

    while ($dept=$result->FetchRow()) {
	
	    if (empty($dept['news_start_script'])) $dept['news_start_script']=$default_url_news;
        echo '<tr bgcolor="#ffffff" ';
		
	    if($toggle) {
		    echo ' background="../../gui/img/common/default/tableHeaderbg3.gif"';
		}
			$toggle=!$toggle;
		
		echo '><td><font face=verdana,arial size=2><a href="'.$root_path.$dept['news_start_script'].URL_APPEND.'&dept_nr='.$dept['nr'].'"> ';
		
		$buf=$dept['LD_var'];
		if(isset($$buf)&&!empty($$buf)) echo $$buf;
		    else echo $dept['name_formal'];

		echo '</a></td>
		<td><font face=verdana,arial size=2><a href="'.$root_path.$dept['news_start_script'].URL_APPEND.'&dept_nr='.$dept['nr'].'"><img '.createComIcon($root_path,'top_help.gif','0').' alt="'.$LDClk4Info.' '.$dept['name_formal'].'."></a></td>		
		<td><font face=verdana,arial size=2><nobr> '.$dept['work_hours'].'</td>
		<td><font face=verdana,arial size=2><nobr> '.$dept['consult_hours'].'</td></tr>';
echo "\r\n";
    }
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
 

<p>
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>  alt="<?php echo $LDBackTxt ?>" align="absmiddle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top>
<td bgcolor="<?php echo $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
require($root_path.'include/inc_load_copyrite.php');
?></td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
