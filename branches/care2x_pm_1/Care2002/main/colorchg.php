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
$lang_tables=array('indexframe.php');
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');
$breakfile='config_options.php'.URL_APPEND;

$config_new=array();

if(!session_is_registered('sess_serial_buffer')){
	session_register('sess_serial_buffer');
}
if(isset($HTTP_SESSION_VARS['sess_serial_buffer'])){
	$config_new=unserialize($HTTP_SESSION_VARS['sess_serial_buffer']);
}	

if ($mode=='change'){
	$color='#'.$color;
	//$$item=$color;
	$config_new[$item]=$color;
	
	$HTTP_SESSION_VARS['sess_serial_buffer']=serialize($config_new);
	$config_new=array_merge($cfg,$config_new);
	
}elseif((($mode=='ok')||($mode=='remain'))&&isset($HTTP_SESSION_VARS['sess_serial_buffer'])){

	// Save to user config table

	include_once($root_path.'include/care_api_classes/class_userconfig.php');
	$user=new UserConfig;

	if($user->getConfig($HTTP_COOKIE_VARS['ck_config'])){

		$config=&$user->getConfigData();
	
		$config=array_merge($config,$config_new);

		if($user->saveConfig($HTTP_COOKIE_VARS['ck_config'],$config)){
			if($mode=='ok'){
				header("location:spediens.php?sid=$sid&lang=$lang&idxreload=j");
			}
			if($mode=='remain'){
				header("location:colorchg.php?sid=$sid&lang=$lang&idxreload=j");
			}
			exit;
		}
	}else{
    	$config=array(); // just declare the array
    }
}else{	
	// Get  default values
	$config_new=$cfg;
}
// Get the menu items for simulation
$sql='SELECT name,LD_var FROM care_menu_main WHERE is_visible=1 OR LD_var="LDEDP" OR LD_var="LDLogin" ORDER by sort_nr ';

$menu_obj=$db->Execute($sql);

require_once($root_path.'include/inc_nocache_headers.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
	var urlholder;
  function chgcolor(p){
	winspecs="width=550,height=600,menubar=no,resizable=yes,scrollbars=yes";
<?php 
	echo 'urlholder="chg-color.php?item="+p+"&sid='.$sid.'&lang='.$lang.'&tb='.str_replace('#','',$cfg['top_bgcolor']).'&tt='.str_replace('#','',$cfg['top_txtcolor']).'&bb='.str_replace('#','',$cfg['body_bgcolor']).'&btb='.str_replace('#','',$cfg['bot_bgcolor']).'&d='.$cfg['dhtml'].'";';
?>
	
	colorwin=window.open(urlholder,"colorwin",winspecs);
	}
	
function ok()
{
	location.href="colorchg.php?mode=ok&sid=<?php echo "$sid&lang=$lang"; ?>";
}
 // -->
</script>
<?php
require($root_path.'include/inc_js_gethelp.php');
?>

<?php if($cfg['dhtml'])
{ echo' 
	<script language="javascript" src="'.$root_path.'js/hilitebu.js"></script>

	<STYLE TYPE="text/css">

	A:link  {text-decoration: none; color: '.$body_txtcolor.';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$body_txtcolor.';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver 
<?php if($idxreload=="j")
{
 echo 'onLoad="window.parent.STARTPAGE.location.replace(\'indexframe.php?sid='.$sid.'&lang='.$lang.'\'); ';
 if($cfg[mask]==2) echo 'window.parent.MENUBAR.location.replace(\'menubar2.php?sid='.$sid.'&lang='.$lang.'\');'; 
 echo '"';
 }
if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<?php echo  $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG>&nbsp;<img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?>> <?php echo $LDColorOpt ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right><?php if($cfg['dhtml']) echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('color_opt.php','')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" valign=top colspan=2><p><br>
<ul>

<table border=1>
  <tr >
    <td rowspan=3 bgcolor="<?php echo $config_new['idx_bgcolor']; ?>" width=100 align=left>
	<center><img <?php echo createLogo($root_path,'care_logo.gif','0') ?>></center>

<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick="chgcolor('idx_txtcolor')">
<FONT    SIZE=1  FACE="Arial" color="<?php echo $config_new['idx_txtcolor']; ?>">
<?php
if(is_object($menu_obj)){
	while($menu=$menu_obj->FetchRow()){
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) echo $$menu['LD_var'];
			else echo $menu['name'];
		echo '<br>';
	}
}
?>
<p>
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('idx_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> >
</a>
</td>
    <td bgcolor="<?php echo $config_new['top_bgcolor']; ?>" ><p><FONT    SIZE=1  FACE="Arial"  color="<?php echo $config_new['top_txtcolor']; ?>">
	&nbsp;&nbsp;&nbsp;<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick="chgcolor('top_txtcolor')"><font size=3 color=<?php echo $config_new['top_txtcolor']; ?>><?php echo $LDTxtColor ?></font></a>&nbsp;&nbsp;&nbsp;
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('top_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
</a></td>
  </tr>
  <tr>
  
<td bgcolor="<?php echo $config_new['body_bgcolor']; ?>" width=400 ><p><br>
	<a href="#" onClick="chgcolor('body_txtcolor')"><FONT    SIZE=4 FACE="Arial" color="<?php echo $config_new['body_txtcolor']; ?>">	<?php echo $LDMainFrame ?></font></a><p><FONT    SIZE=1 FACE="Arial">	
	<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('body_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
	</a><p><br>
</td>
  </tr>
  <tr>
 
    <td bgcolor="<?php echo $config_new['bot_bgcolor']; ?>">
<FONT    SIZE=1  FACE="Arial">
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
<p><a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('bot_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
</a>
</FONT>
</td>
  </tr>
</table>

<FONT    SIZE=-1  FACE="Arial">
<FORM >
<input type="button" value="<?php echo $LDOK ?>" onClick="ok()">
<INPUT type="button"  value="<?php echo $LDCancel ?>" onClick="location.replace('config_options.php<?php echo URL_REDIRECT_APPEND; ?>')">
<input type="button" value="<?php echo $LDApply ?>" onClick="location.replace('colorchg.php<?php echo URL_REDIRECT_APPEND; ?>&mode=remain')">
<?php if ($cfg['dhtml'])
echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDColorOptExt.'" onClick="location.replace(\'excolorchg.php'.URL_REDIRECT_APPEND.'\')">';
?>
</FORM></font>
<p>
</ul>

</td>
</tr>

<tr valign=top >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
