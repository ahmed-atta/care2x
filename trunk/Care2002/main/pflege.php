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
define("LANG_FILE","nursing.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");

require("../include/inc_config_color.php");

$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
$breakfile="startframe.php?sid=$sid&lang=$lang";

$dbtable="nursing_station_$lang";

require("../include/inc_db_makelink.php");
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
	urlholder="pflege-station-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&rt=pflege&edit=1&station="+station;
	window.location.href=urlholder;
	//stationwin=window.open(urlholder,station,winspecs);	
}
	
function closewin()
{
	location.href='startframe.php?sid=<?php echo $$ck_sid_buffer.'&uid='.$r;?>';
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
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo $LDNursing ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDNursing; ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
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
				 <a href="pflege-schnellsicht.php?sid=<?php print "$sid&lang=$lang"; ?>"><?php echo $LDQuickView ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDQuickViewTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/eyeglass.gif" border=0 width=17 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-patient-such-start.php?sid=<?php print "$sid&lang=$lang"; ?>"><?php echo $LDSearchPatient ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDSearchPatientTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/eyeglass.gif" border=0 width=17 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-station-archiv.php?sid=<?php print "$sid&lang=$lang"; ?>"><?php echo $LDArchive ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDArchiveTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/timeplan.gif" border=0 width=16 height=16></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="pflege-station-manage-pass.php?sid=<?php echo "$sid&lang=$lang" ?>"><nobr><?php echo $LDStationMan ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDStationManTxt ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/bubble.gif" border=0 width=15 height=14></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="newscolumns.php?sid=<?php echo "$sid&lang=$lang&target=nursing&title=$LDNursing" ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/mail.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
             
<!--               <TR bgColor=#eeeeee> <td align=center><img src="../img/discussions.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="../forum//list.php?f=2"><?php echo $LDNursingForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDNursingForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
 -->              
               <TR bgColor=#eeeeee> <td align=center><img src="../img/discussions.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="ucons.php?lang=<?php echo $lang ?>"><?php echo $LDNursingForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDNursingForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              
              <TR bgColor="#eeeeee"><td align=center><img src="../img/team_wksp.gif" border=0 width=16 height=17></td>
                <TD vAlign=top width="150"><FONT 
                  face="Verdana,Helvetica,Arial" size="2" color="<?php echo $cfg['body_txtcolor']; ?>"><B>
				    <nobr><?php echo $LDNursingStations ?>&nbsp;<img src="../img/dwn-arrow-grn.gif" border=0 width=12 height=12 align="absmiddle"></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNursingStationsTxt ?></FONT></TD></TR>
              <TR bgColor="#dddddd" >
                <TD colSpan=3>
				  <FONT face="Verdana,Helvetica,Arial" 
                  size=2>
				  <ul>
				  <?php
				  	 if($rows)
					 {
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
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  width=103 height=24 alt="<?php echo $LDCloseBack2Main ?>" align="middle"></a>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
