<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
if(!session_is_registered('sess_file_return')) session_register('sess_file_return');
if(!session_is_registered('sess_file_forward')) session_register('sess_file_forward');

$breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'];

if(!file_exists($breakfile)) {
    $breakfile=$root_path.'main/startframe.php';
}

$breakfile=$breakfile.URL_APPEND;
$returnfile=$breakfile;

$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);
$HTTP_SESSION_VARS['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);


if(!isset($stb)) $stb=0;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php  echo setCharSet();  ?>
 <script language="javascript" >
<!-- 
<?php  if($stb)
echo '
		function startbot(d)
		{
		if(d=="r") repabotwin=window.open("technik-repabot.php'.URL_REDIRECT_APPEND.'","repabotwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");
		else if(d=="f") fragebotwin=window.open("technik-fragebot.php'.URL_REDIRECT_APPEND.'","fragebotwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");

		}
		';
?>
// -->
</script> 

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php 
if($stb==1) echo 'onLoad="startbot(\'r\')" ';
 else if($stb==2) echo 'onLoad="startbot(\'f\')" ';
if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDTechSupport ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

    <TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="technik-reparatur-anfordern.php<?php echo URL_APPEND ?>"><?php echo $LDReRepair ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDReRepairTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  <?php echo createComIcon($root_path,'pixel.gif','0'); ?> 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'sitemap_animator.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="technik-bot-pass.php<?php echo URL_APPEND ?>&mode=repabot"><?php echo $LDRepabotActivate ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDRepabotActivateTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  <?php echo createComIcon($root_path,'pixel.gif','0'); ?>
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'icn_rad.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="technik-reparatur-melden.php<?php echo URL_APPEND ?>"><?php echo $LDRepairReport ?></B></a></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDRepairReportTxt ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  <?php echo createComIcon($root_path,'pixel.gif','0'); ?>
                  width=5></TD></TR>
				  
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'eyeglass.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="technik-report-arch.php<?php echo URL_APPEND ?>"><?php echo $LDReportsArchive ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDReportsArchiveTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  <?php echo createComIcon($root_path,'pixel.gif','0'); ?>
                  width=5></TD></TR>
				  
             <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="technik-questions.php<?php echo URL_APPEND ?>"><nobr><?php echo $LDQuestions ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDQuestionsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  <?php echo createComIcon($root_path,'pixel.gif','0'); ?>
                  width=5></TD></TR>
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'sitemap_animator.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="technik-bot-pass.php<?php echo URL_APPEND ?>&mode=fragebot"><?php echo $LDQBotActivate ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQBotActivateTxt ?></nobr></FONT></TD></TR>
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  <?php echo createComIcon($root_path,'pixel.gif','0'); ?>
                  width=5></TD></TR>
             <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'info2.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <nobr><a href="technik-info.php<?php echo URL_APPEND ?>"><?php echo $LDInfo ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDInfoTxt ?></FONT></TD></TR>
 -->                         
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="middle"></a>
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
</td>
</tr>
</table>        
</FONT>
</BODY>
</HTML>
