<?
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla
								
Beta version 1.0    2002-05-10
								
This script(s) is(are) free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.
																  
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.
											   
You should have received a copy of the GNU General Public
License along with this script; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
																		 
Copy of GNU General Public License at: http://www.gnu.org/
													 
Source code home page: http://www.care2x.com
Contact author at: elpidio@latorilla.com

This notice also applies to other scripts which are integral to the functioning of CARE 2002 within this directory and its top level directory
A copy of this notice is also available as file named copy_notice.txt under the top level directory.
*/
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");
$breakfile="startframe.php?sid=$ck_sid&lang=$lang";

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
	urlholder="spediens-bdienst-zeit-erfassung.php?sid=<? print "$ck_sid&lang=$lang"; ?>";
	stationwin=window.open(urlholder,"bdienst",winspecs);
	}
function closewin()
{
	location.href='startframe.php?sid=<? print "$ck_sid&lang=$lang";?>';
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?> >


<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;<?=$LDSpexFunctions ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right><?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="javascript:gethelp('submenu1.php','<?=$LDSpexFunctions ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colSpan=3><p><br>
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
				  <a href="spediens-ado.php?sid=<?="$ck_sid&lang=$lang" ?>&retpath=spec"><?=$LDDutyPlanOrg ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDDutyPlanOrgTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
			<TR bgColor=#eeeeee><td align=center><img src="../img/post_discussion.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="spediens-bdienst-zeit-erfassung.php?sid=<?="$ck_sid&lang=$lang" ?>&retpath=spec"><?=$LDStandbyDuty ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDStandbyDutyTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>              
			<TR bgColor=#eeeeee><td align=center><img src="../img/thum_upr.gif" border=0 width=20 height=16></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="ucons.php"><nobr><?=$LDHandStat ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDHandStatTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/calmonth.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="calendar.php?sid=<? print "$ck_sid&lang=$lang";?>"><?=$LDCalendar ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDCalendarTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/bubble.gif" border=0 width=15 height=14></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="editor-pass.php?sid=<?=$ck_sid ?>&lang=<?=$lang ?>&target=headline&title=<?=$LDEditTitle ?>"><?=$LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/mail.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="ucons.php"><?=$LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/task_tree.gif" border=0 width=16 height=16></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				    <a href="ucons.php"><nobr><?=$LDBlackBoard ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDBlackBoardTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
<!--               <TR bgColor=#eeeeee><td align=center><img src="../img/new_group.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="../forum/index.php?lang=en"><?=$LDForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?=$LDForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
 -->              <TR bgColor=#eeeeee><td align=center><img src="../img/calendar.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><a href="calculator.php?sid=<? print "$ck_sid&lang=$lang";?>"><?=$LDCalc ?></a>
				   </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2><?=$LDCalcTxt ?></FONT></TD></TR>
				 <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
				  <? if(($cfg['bname']=="msie")&&($cfg['bversion']>4))
					{ print '
							<TR bgColor="#eeeeee"> <TD><img src="../img/uhr.gif" border=0 width=17 height=17></td>
                			<TD vAlign=top ><FONT 
                  			face="Verdana,Helvetica,Arial" size=2><B>
    							<a href="clock.php?sid='.$ck_sid.'&lang='.$lang.'">'.$LDClock.'</a></td>
								<TD><FONT face="Verdana,Helvetica,Arial" size=2>'.$LDDigitalClock.'</FONT></TD></TR>
  								</tr>';
					 }
				?> 

              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/settings_tree.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="colorchg.php?uid=<? print $r; ?>&sid=<? print "$ck_sid&lang=$lang";?>"><?=$LDColorOpt ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDColorOptTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
				  
				  
				  <? if($cfg['dhtml'])
					{ print '<TR bgColor=#eeeeee>
   								 <td align=center><img src="../img/settings_tree.gif" border=0 width=16 height=17></td>
								<TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
    							<a href="excolorchg.php?&sid='.$ck_sid.'&lang='.$lang.'"><nobr>'.$LDColorOptExt.'</nobr></a></B></FONT></TD>
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
				 <a href="ucons.php?sid=<?print "$ck_sid&lang=$lang";?>"><?=$LDMyIntranet ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDMyIntranetTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/padlock.gif" border=0 width=12 height=15 align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="my-passw-change.php?sid=<?print "$ck_sid&lang=$lang";?>"><?=$LDAccessPw ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDAccessPwTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/video.gif" width=15 height=15 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="webcam-home.php?sid=<?print "$ck_sid&lang=$lang&ck_config=$ck_config";?>"><?=$LDWebCam ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDWebCamTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/camera_s.gif" border=0 width=15 height=15 align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="fotolab-parentframe.php?sid=<?print "$ck_sid&lang=$lang&ck_config=$ck_config";?>"><?=$LDPhotoLab ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDPhotoLabTxt ?> </FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/templates.gif" border=0 width=16 height=17 align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="<? if(($cfg[mask]==1)||($cfg[mask]=="")) print "../index.php?lang=$lang&mask=2\" target=\"_top\">$LDDisplay2"; else print "../index.php?lang=$lang&mask=1\" target=\"_top\">$LDDisplay1";?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><? if(($cfg[mask]==1)||($cfg[mask]=="")) print $LDDisplay2Txt; else print $LDDisplay1Txt;?></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0  alt="<?=$LDClose ?>" align="middle"></a>

<p>
</ul>



</td>
</tr>

<tr valign=top >
<td bgcolor="<? print $cfg['bot_bgcolor']; ?>" colSpan=3> 
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
