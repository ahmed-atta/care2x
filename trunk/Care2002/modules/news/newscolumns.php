<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('MODERATE_NEWS',0);  // define to 1 if news is moderated

$lang_tables=array('departments.php');
define('LANG_FILE','newscolumns.php');
define('NO_2LEVEL_CHK',1);

require_once($root_path.'include/inc_front_chain_lang.php');

# reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 

$subtitle=$LDSubTitle[$target];

# Set default values
$default_editor_script='modules/news/editor-4plus1-select-art.php';
$default_start_page='main/startframe.php';
$thisfile=basename(__FILE__);

$HTTP_SESSION_VARS['sess_file_break']=$top_dir.$thisfile;

if(isset($dept_nr) && $dept_nr) $HTTP_SESSION_VARS['sess_dept_nr']=$dept_nr;
    else  $dept_nr=$HTTP_SESSION_VARS['sess_dept_nr'];
	
//if(!isset($user_origin)||empty($user_origin)) $user_origin=$HTTP_SESSION_VARS['sess_user_origin'];
if(empty($user_origin)) $user_origin=$HTTP_SESSION_VARS['sess_user_origin'];
# Set the return paths 

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');


if($dblink_ok) {

	$sql_2= 'SELECT dept.name_formal, dept.LD_var, reg.module_start_script, reg.news_editor_script FROM care_department as dept LEFT JOIN care_registry AS reg  ON dept.id=reg.registry_id WHERE dept.nr='.$dept_nr;
    
	if(isset($user_origin) && !empty($user_origin)) {
	    
		$sql= 'SELECT dept.name_formal, dept.LD_var, reg.module_start_script, reg.news_editor_script FROM care_registry AS reg, care_department AS dept  WHERE reg.registry_id="'.$user_origin.'" AND dept.nr='.$dept_nr;
		
	}else{
	
		$sql=$sql_2;
	}
	
    if($result=$db->Execute($sql)) {
		if($result->RecordCount()){
		    $row=$result->FetchRow();
		}else{
    		if($result=$db->Execute($sql_2)) {
				if($result->RecordCount()){
		    		$row=$result->FetchRow();
				}
			} else echo "<p>$sql<p>$LDDbNoRead<p>";
		}	
	} else echo "<p>$sql<p>$LDDbNoRead<p>";

	/* Check the start script as break destination*/
	if (!empty($HTTP_SESSION_VARS['sess_path_referer'])){
		$breakfile=$HTTP_SESSION_VARS['sess_path_referer'];
	} elseif(isset($row['module_start_script']) && !empty($row['module_start_script'])){
		$breakfile =$row['module_start_script'];
	} else {
		 /* default startpage */
		$breakfile = $default_start_page;
	}
	$breakfile=$root_path.$breakfile.URL_APPEND;
	/* Check the title */
	if(!isset($$row['LD_var'])||empty($$row['LD_var'])) {
		$title=$row['name_formal'];
	}else {
		$title=$$row['LD_var'];
	}	
	 # Save to session
	$HTTP_SESSION_VARS['sess_title']=$title;
	
/*	# Check the editor script as forward file
	if(isset($row['news_editor_script']) && (trim($row['news_editor_script'])!='')) {
		$HTTP_SESSION_VARS['sess_file_forward'] =$root_path.$row['news_editor_script'];
		$HTTP_SESSION_VARS['sess_file_editor'] =$root_path.$row['news_editor_script'];
	} else {
		 # default file forward
		$HTTP_SESSION_VARS['sess_file_forward'] = $root_path.$default_editor_script;
		$HTTP_SESSION_VARS['sess_file_editor'] = $root_path.$default_editor_script;
	}
*/
	$HTTP_SESSION_VARS['sess_file_forward'] = $root_path.$default_editor_script;
	$HTTP_SESSION_VARS['sess_file_editor'] = $root_path.$default_editor_script;
	
	# Now get the news articles
    include_once($root_path.'include/inc_date_format_functions.php');
	
    $dbtable='care_news_article';

	# Get the maximum number of headlines to be displayed 
    $config_type='news_dept_max_display';
    include($root_path.'include/inc_get_global_config.php');

    if(!$news_dept_max_display) $news_num_stop=4; /* default is 3 */
        else $news_num_stop=$news_dept_max_display;  // The maximum number of news article to be displayed
	
	//include($root_path.'include/inc_news_get.php'); // now get the current news	
	
	# Now set the sql query for article # 5 or the achived news 
	
	require_once($root_path.'include/care_api_classes/class_news.php');
    $newsobj=new News;
    $news=&$newsobj->getHeadlinesPreview($dept_nr,$news_num_stop);
	
	/* Now get the archived news articles */
	//echo $dept_nr;
	$news_archive=&$newsobj->getArchiveList($dept_nr,$news);
	$rows=$newsobj->LastRecordCount();
}
$returnfile=$breakfile;
$readerpath='editor-4plus1-read.php'.URL_REDIRECT_APPEND;
$editorpath='editor-pass.php'.URL_APPEND;
$today=date('Y-m-d');
//$HTTP_SESSION_VARS['sess_dept_nr']=$dept_nr;
$HTTP_SESSION_VARS['sess_file_return']=$top_dir.basename(__FILE__);


//echo $HTTP_SESSION_VARS['sess_file_editor'];
/* Set this file as the referer */
//$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $title ?> Information</TITLE>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG>&nbsp;<?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dept_news.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10>
  <tr>
<?php 

 /* Get the news global configurations */
$config_type='news_%';
include($root_path.'include/inc_get_global_config.php');

if(!$news_normal_preview_maxlen) $news_normal_preview_maxlen=300;

/* Load editor functions */
require_once($root_path.'include/inc_editor_fx.php');

$picalign='left';

for($j=1;$j<=$news_num_stop;$j++)
{
	echo '
    <td valign="top" width="50%">';
	
	include($root_path.'include/inc_news_preview.php');
	
	echo '
	</td>';
	if($j==2) echo '
	</tr>
	<tr>';
}

?>
    
  </tr>
  <tr>
    <td colspan=2 valign="top">
	

	
<?php if($rows) { ?>
	<?php echo $subtitle ?>
	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#0>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2 color="#0000cc"><b><?php echo $LDArticle ?></b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2 color="#0000cc"><b><?php echo $LDWrittenBy ?>:</b></font></td>
      <td><font face="Verdana,arial" size=2 color="#0000cc"><b><?php echo $LDWrittenOn ?>:</b></font></td>
    </tr>
<?php while($artikel=$news_archive->FetchRow())
{
echo '<tr bgcolor="#ffffff"><td><a href="#"><a href="'.$readerpath.'&nr='.$artikel['nr'].'&news_type=headline"><font face=verdana,arial size=2> '.$artikel['title'].'</a></td>
		<td><font face=verdana,arial size=2><a href="'.$readerpath.'&nr='.$artikel['nr'].'&news_type=headline"><img '.createComIcon($root_path,'info.gif','0').' alt="'.$LDClk2Read.'"></a></td>		
		<td><font face=verdana,arial size=2> '.$artikel['author'].'</td>
		<td><font face=verdana,arial size=2><nobr> '.formatDate2Local($artikel['publish_date'],$date_format,1).' </td></tr>';
echo "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
	
	</td>
  </tr>
</table>

<?php } ?>
<hr>
	<FONT    SIZE=4  FACE="Arial">
	<a href="<?php echo $editorpath ?>"> <?php echo $LDClk2Compose; ?> </a>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','middle').' alt="'.$LDBackTxt.'"'; ?>></a>
<p>
</FONT>
</td>
</tr>

</table>        

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
