<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","doctors.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");
$breakfile="startframe.php?sid=$sid&lang=$lang";
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
require("../include/inc_css_a_hilitebu.php");
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
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG><?php echo $LDDoctors ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDDoctors ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<TABLE cellSpacing=0 cellPadding=0 width=550 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=550 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img src="../img/eye_s.gif"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="doctors-dienst-schnellsicht.php?<?php echo "sid=$sid&lang=$lang" ?>&retpath=docs"><?php echo $LDQView ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQViewTxt ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
<!--               <TR bgColor=#eeeeee><td align=center><img src="../img/post_discussion.gif"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="doctors-main-pass.php?sid=<?php echo $sid."&lang=$lang" ?>&target=dutyplan&retpath=menu"><?php echo $LDDutyPlan ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDutyPlanTxt ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
 -->              <TR bgColor=#eeeeee><td align=center><img src="../img/post_discussion.gif"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="doctors-main-pass.php?sid=<?php echo $sid."&lang=$lang" ?>&target=dutyplan&retpath=menu"><?php echo $LDDOCS ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDOCSTxt ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/post_discussion.gif"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="ucons.php?sid=<?php echo $sid."&lang=$lang" ?>&target=dutyplan&retpath=menu"><?php echo $LDDOCSR ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDOCSRTxt ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/people_search_online.gif" width=16 height=16 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="doctors-main-pass.php?sid=<?php echo $sid."&lang=$lang" ?>&target=setpersonal&retpath=menu"><?php echo $LDDocsList ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDocsListTxt ?></nobr></FONT></TD>
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
               <TR bgColor=#eeeeee> <td align=center><img src="../img/discussions.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="../forum//list.php?f=3"><?php echo $LDDocsForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDocsForumTxt ?></nobr></FONT></TD></TR>
 -->              
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
               <TR bgColor=#eeeeee> <td align=center><img src="../img/discussions.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="ucons.php?lang=<?php echo $lang ?>"><?php echo $LDDocsForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDocsForumTxt ?></nobr></FONT></TD></TR>
            
 			  <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
               <TR bgColor=#eeeeee><td align=center><img src="../img/bubble.gif"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="newscolumns.php?sid=<?php echo $sid."&lang=$lang&target=doctors&title=$LDDoctors" ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/waiting.gif" width=16 height=16 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  alt="<?php echo $LDCloseAlt ?>" align="middle"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
