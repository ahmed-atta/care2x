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
define("LANG_FILE","specials.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");
$breakfile="startframe.php?sid=$sid&lang=$lang";

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 
var urlholder;

  function bdienstwin(){
	winspecs="width=800,height=600,menubar=no,resizable=yes,scrollbars=yes";
	urlholder="spediens-bdienst-zeit-erfassung.php?sid=<?php print "$sid&lang=$lang"; ?>";
	stationwin=window.open(urlholder,"bdienst",winspecs);
	}
function closewin()
{
	location.href='startframe.php?sid=<?php print "$sid&lang=$lang";?>';
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?> >


<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;<?php echo $LDSpexFunctions ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right><?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="javascript:gethelp('submenu1.php','<?php echo $LDSpexFunctions ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colSpan=3><p><br>
<ul>


      <TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img src="../img/timeplan.gif" width=16 height=16 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="spediens-ado.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=spec"><?php echo $LDDutyPlanOrg ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDutyPlanOrgTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
			<TR bgColor=#eeeeee><td align=center><img src="../img/post_discussion.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="spediens-bdienst-zeit-erfassung.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=spec"><?php echo $LDStandbyDuty ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDStandbyDutyTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>              
			<TR bgColor=#eeeeee><td align=center><img src="../img/thum_upr.gif" border=0 width=20 height=16></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="ucons.php<?php echo "?lang=$lang" ?>"><nobr><?php echo $LDHandStat ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDHandStatTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/calmonth.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="calendar.php?sid=<?php print "$sid&lang=$lang";?>"><?php echo $LDCalendar ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDCalendarTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/bubble.gif" border=0 width=15 height=14></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="editor-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=headline&title=<?php echo $LDEditTitle ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/mail.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/task_tree.gif" border=0 width=16 height=16></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				    <a href="ucons.php<?php echo "?lang=$lang" ?>"><nobr><?php echo $LDBlackBoard ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDBlackBoardTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
<!--               <TR bgColor=#eeeeee><td align=center><img src="../img/new_group.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="../forum/index.php?lang=en"><?php echo $LDForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
 -->              <TR bgColor=#eeeeee><td align=center><img src="../img/calendar.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><a href="calculator.php?sid=<?php print "$sid&lang=$lang";?>"><?php echo $LDCalc ?></a>
				   </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDCalcTxt ?></FONT></TD></TR>
				 <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
				  <?php if(($cfg['bname']=="msie")&&($cfg['bversion']>4))
					{ print '
							<TR bgColor="#eeeeee"> <TD><img src="../img/uhr.gif" border=0 width=17 height=17></td>
                			<TD vAlign=top ><FONT 
                  			face="Verdana,Helvetica,Arial" size=2><B>
    							<a href="clock.php?sid='.$sid.'&lang='.$lang.'">'.$LDClock.'</a></td>
								<TD><FONT face="Verdana,Helvetica,Arial" size=2>'.$LDDigitalClock.'</FONT>';	
				?>
				</TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>				
				<?php
				   }
				?> 


              <TR bgColor=#eeeeee><td align=center><img src="../img/settings_tree.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="colorchg.php?uid=<?php print $r; ?>&sid=<?php print "$sid&lang=$lang";?>"><?php echo $LDColorOpt ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDColorOptTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
				  
				  
				  <?php if($cfg['dhtml'])
					{ print '<TR bgColor=#eeeeee>
   								 <td align=center><img src="../img/settings_tree.gif" border=0 width=16 height=17></td>
								<TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
    							<a href="excolorchg.php?&sid='.$sid.'&lang='.$lang.'"><nobr>'.$LDColorOptExt.'</nobr></a></B></FONT></TD>
                				<TD><FONT face="Verdana,Helvetica,Arial" 
                  				size=2>'.$LDColorOptExtTxt.'</FONT></TD></TR>';
 					}
				?>
      
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/mem_tree.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="myintranet.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDMyIntranet ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMyIntranetTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/padlock.gif" border=0 width=12 height=15 align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="my-passw-change.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDAccessPw ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDAccessPwTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/video.gif" width=15 height=15 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="webcam-home.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDWebCam ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDWebCamTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/camera_s.gif" border=0 width=15 height=15 align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="fotolab_pass.php?sid=<?php echo "$sid&lang=$lang&ck_config=$ck_config";?>"><?php echo $LDPhotoLab ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPhotoLabTxt ?> </FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/templates.gif" border=0 width=16 height=17 align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="<?php if(($cfg[mask]==1)||($cfg[mask]=="")) print "../index.php?lang=$lang&mask=2\" target=\"_top\">$LDDisplay2"; else print "../index.php?lang=$lang&mask=1\" target=\"_top\">$LDDisplay1";?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php if(($cfg[mask]==1)||($cfg[mask]=="")) print $LDDisplay2Txt; else print $LDDisplay1Txt; ?></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  alt="<?php echo $LDClose ?>" align="middle"></a>

<p>
</ul>

</td>
</tr>

<tr valign=top >
<td bgcolor="<?php print $cfg['bot_bgcolor']; ?>" colSpan=3> 
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
