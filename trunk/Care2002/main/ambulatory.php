<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","ambulatory.php");
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');

// reset all 2nd level lock cookies
require('../include/inc_2level_reset.php');
$breakfile="startframe.php?sid=".$sid."&lang=".$lang;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
<script language="javascript">

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG><?php echo $LDDepartments ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDDoctors ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<TABLE cellSpacing=0 cellPadding=0 width=700  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=3><b><?php echo $LDEmergency ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="labor_test_request_pass.php?sid=<?php echo $sid.'&lang='.$lang.'&target=generic&subtarget=unfamb&user_origin=amb'; ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="newscolumns.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&lang=<?php echo $lang ?>&target=unfamb&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
				  
				  
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>				
		<p>

<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=3><b><?php echo $LDGeneralSurgery ?></b></FONT></TD></TR>

              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="labor_test_request_pass.php?sid=<?php echo $sid.'&lang='.$lang.'&target=generic&subtarget=allamb&user_origin=amb'; ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>	
				  
			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="newscolumns.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&lang=<?php echo $lang ?>&target=allamb&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>

				  	  
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>

<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=3><b><?php echo $LDSonography ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="labor_test_request_pass.php?sid=<?php echo $sid.'&lang='.$lang.'&target=generic&subtarget=sono&user_origin=amb'; ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

				  			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="newscolumns.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&lang=<?php echo $lang ?>&target=sono&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>

				  
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>				
		<p>
		
<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
  				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=3><b><?php echo $LDInternalMed ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="labor_test_request_pass.php?sid=<?php echo $sid.'&lang='.$lang.'&target=generic&subtarget=inmed&user_origin=amb'; ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="newscolumns.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&lang=<?php echo $lang ?>&target=inmed&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
				  

		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>

<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
  				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=3><b><?php echo $LDNuclearMed ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="labor_test_request_pass.php?sid=<?php echo $sid.'&lang='.$lang.'&target=generic&subtarget=nuklear&user_origin=amb'; ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="newscolumns.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&lang=<?php echo $lang ?>&target=nuklear&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
				  

		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		
		<p>
		
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDCloseAlt ?>" align="middle"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
