<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.07 - 2003-08-29
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_userconfig.php');
$user=new UserConfig;

if($user->getConfig($HTTP_COOKIE_VARS['ck_config'])){
	$config=&$user->getConfigData();
}else{
	$config=array();
}

/* Load the dept object */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept=new Department;
$depts=&$dept->getAllActive();

// Load the ward object and wards info 
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward;
$items='nr,ward_id,name'; // set the items to be fetched
$ward_info=&$ward_obj->getAllWardsItemsArray($items);


if(isset($mode)&&($mode=='save')){

	$config['thispc_dept_nr']=$HTTP_POST_VARS['thispc_dept_nr'];
	$config['thispc_ward_nr']=$HTTP_POST_VARS['thispc_ward_nr'];
	$config['thispc_room_nr']=$HTTP_POST_VARS['thispc_room_nr'];
	$config['thispc_phone']=$HTTP_POST_VARS['thispc_phone'];
	$config['thispc_intercom']=$HTTP_POST_VARS['thispc_intercom'];
	
	$user->saveConfig($HTTP_COOKIE_VARS['ck_config'],$config);
	
	header("location: login-pc-config.php?sid=$sid&lang=$lang&saved=1");
	exit;
}

require_once($root_path.'include/inc_config_color.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="window.parent.STARTPAGE.location.href='indexframe.php<?php echo URL_REDIRECT_APPEND ?>'" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  
SIZE=+3  FACE="Arial">
<STRONG> &nbsp;<?php echo $LDLogin ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right><a href="javascript:gethelp('');"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>  
 <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?>   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td></tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>

<table>
<tr bgcolor=<?php echo $cfg['body_bgcolor']; ?>>
<td align=right><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
<td >
<?php if ($saved) : ?>
<FONT  face="Verdana,Helvetica,Arial" size=3 color="#990000"><?php echo $LDChangeSaved ?><br>
<?php else : ?>
<FONT  face="Verdana,Helvetica,Arial" size=5><font color="#cc0000" ><?php echo $LDWelcome ?>!</font><br>
<?php echo $HTTP_SESSION_VARS['sess_login_username'] ?>
<?php endif ?>
</td></tr>
</table>

<form name="pcids"  method="post" action="login-pc-config.php">
<TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <?php echo $LDPcID ?></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'home.gif') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>

				<select name="thispc_dept_nr">
				<option value=""> </option>';
	<?php
		if($depts&&is_array($depts)){		
			while(list($x,$v)=each($depts)){
				echo '
					<option value="'.$v['nr'].'"';
				if($v['nr']==$config['thispc_dept_nr']) echo ' selected';
				echo '>';
				if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
					else echo $v['name_formal'];
				echo '</option>';
			}
		}
	?>
				</select>
				  
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDept ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'statbel2.gif') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>

				<select name="thispc_ward_nr">
				<option value=""> </option>';
	<?php
		if($ward_info&&is_array($ward_info)){		
			while(list($x,$v)=each($ward_info)){
				echo '
					<option value="'.$v['nr'].'"';
				if($v['nr']==$config['thispc_ward_nr']) echo ' selected';
				echo '>'.$v['name'].'</option>';
			}
		}
	?>
				</select>

     			  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDWard ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
                <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'button_info.gif') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="thispc_room_nr" size=20 maxlength=25 value="<?php echo $config['thispc_room_nr'] ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDWardOR ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'profile.gif') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="thispc_phone" size=20 maxlength=25 value="<?php echo $config['thispc_phone'] ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPhoneNr ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'listen-sm-legend.gif') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="thispc_intercom" size=20 maxlength=25 value="<?php echo $config['thispc_intercom'] ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDIntercomNr ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'lightning.gif') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <?php echo $HTTP_SERVER_VARS['REMOTE_ADDR']; ?>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPcIP ?></FONT></TD></TR>
             
			 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="save">
<input type="submit" value="<?php echo $LDSave ?>">
<input type="button" value="<?php echo $LDNoChange ?>" onClick="window.location.href='startframe.php?sid=<?php echo "$sid&lang=$lang" ?>'">&nbsp;<a href="startframe.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','top') ?>  alt="<?php echo $LDClose ?>" ></a>
</form>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
