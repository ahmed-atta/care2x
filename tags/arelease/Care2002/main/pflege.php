<?
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
Beta version 1.0    2002-05-10
GNU GPL. For details read file "copy_notice.txt".
*/
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

setcookie(ck_pflege_user,"");
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php");

$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
$breakfile="startframe.php?sid=$ck_sid&lang=$lang";

$dbtable="nursing_station_$lang";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
    {
        $sql="SELECT station,dept FROM $dbtable WHERE 1 ORDER BY station";
		if($ergebnis=mysql_query($sql,$link))
        {
            $rows=0;
            while($stations=mysql_fetch_array($ergebnis)) $rows++;
            if($rows)mysql_data_seek($ergebnis,0);
        }
        else print "$sql<br>$LDDbNoRead"; 
    }
    else { print "$LDDbNoLink<br>"; } 
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 
var urlholder;

function statbel(station){
<?php
	if($cfg['dhtml'])
	{
	print 'w=window.parent.screen.width;
			h=window.parent.screen.height;';
	}
	else print 'w=800;
					h=600;';
?>
	winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);
	urlholder="pflege-station-pass.php?sid=<?="$ck_sid&lang=$lang" ?>&rt=pflege&edit=1&station="+station;
	window.location.href=urlholder;
	//stationwin=window.open(urlholder,station,winspecs);	
}
	
function closewin()
{
	location.href='startframe.php?sid=<?print $ck_sid.'&uid='.$r;?>';
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
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?=$LDNursing ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('submenu1.php','Nursing')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul><!-- <img src="../img/nurse.jpg" align="right"> -->
<FONT    SIZE=-1  FACE="Arial">

  <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img src="../img/eye_s.gif" border=0 width=16 height=16></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-schnellsicht.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><?=$LDQuickView ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDQuickViewTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/eyeglass.gif" border=0 width=17 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-patient-such-start.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><?=$LDSearchPatient ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDSearchPatientTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/eyeglass.gif" border=0 width=17 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-station-archiv.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><?=$LDArchive ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDArchiveTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/timeplan.gif" border=0 width=16 height=16></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="pflege-station-manage-pass.php?sid=<?="$ck_sid&lang=$lang" ?>"><nobr><?=$LDStationMan ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?=$LDStationManTxt ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/bubble.gif" border=0 width=15 height=14></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="newscolumns.php?sid=<?="$ck_sid&lang=$lang&target=nursing&title=$LDNursing" ?>"><?=$LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/mail.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="ucons.php"><?=$LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
             
<!--               <TR bgColor=#eeeeee> <td align=center><img src="../img/discussions.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="../forum//list.php?f=2"><?=$LDNursingForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?=$LDNursingForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
 -->              
               <TR bgColor=#eeeeee> <td align=center><img src="../img/discussions.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="ucons.php?lang=<?=$lang ?>"><?=$LDNursingForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?=$LDNursingForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              
              <TR bgColor=#eeeeee><td align=center><img src="../img/team_wksp.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				    <a href="#"><nobr><?=$LDNursingStations ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDNursingStationsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd >
                <TD colSpan=3>
				  <FONT face="Verdana,Helvetica,Arial" 
                  size=2>
				  <ul>
				  <?
							$i=0;

						while($stations=mysql_fetch_array($ergebnis))
						{
							print '<a href="javascript:statbel(\''.strtolower($stations[station]).'\')">'.strtoupper($stations[station]).'</a> &nbsp;';
							$i++;
							if($i==4)
							{
								print "<br>\r\n";
								$i=0;
							}
						}

				?>
			</UL>  
				  </TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<a href="javascript:closewin()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0  width=103 height=24 alt="<?=$LDCloseBack2Main ?>" align="middle"></a>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
