<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*** CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","radio.php");
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 

/*$breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'];

if(!file_exists($breakfile)) {
    $breakfile=$root_path.'main/startframe.php';
}
*/
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$HTTP_SESSION_VARS['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);

require_once($root_path.'include/inc_config_color.php');

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

var urlholder;

  function srcxray(){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
	radiologwin=window.open("radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&user=<?php echo $aufnahme_user.'"' ?>,"radiologwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php if($cfg['dhtml']) echo '
window.radiologwin.moveTo(0,0);'; ?>

//-->
}
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDRadio ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDRadio ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<TABLE cellSpacing=0 cellPadding=0 width=550 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=550 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bestell.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND; ?>&target=radio&user_origin=lab"><?php echo $LDTestRequestRadio ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestRequestRadioTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND; ?>&target=admin&subtarget=radio&user_origin=lab" >
				 <?php echo $LDTestReception ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestReceptionTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>               
				  
			  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'torso.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="javascript:srcxray()" ><?php echo $LDXrayFilms ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDXrayFilmsTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              
                <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="<?php echo $root_path ?>modules/news/newscolumns.php<?php echo URL_APPEND."&dept_nr=19" ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'mail.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
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
</td>
</tr>
<tr valign=top  >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>        
&nbsp;
</BODY>
</HTML>
