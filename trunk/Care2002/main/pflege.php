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
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

// reset all 2nd level lock cookies
require('../include/inc_2level_reset.php');

require_once('../include/inc_config_color.php');

$toggler=0;
$breakfile="startframe.php?sid=".$sid."&lang=".$lang;

$dbtable="care_nursing_station";

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
    {
/*        $sql="SELECT item, station, dept FROM $dbtable WHERE  lang='".$lang."' ORDER BY station";
*/       
         $sql="SELECT item, station, dept FROM $dbtable ORDER BY station";
		if($ergebnis=mysql_query($sql,$link))
        {
            $rows=mysql_num_rows($ergebnis);
        }
        else echo "$sql<br>$LDDbNoRead"; 
    }
    else { echo "$LDDbNoLink<br>"; } 
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

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
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo $LDNursing ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDNursing; ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul><!-- <img src="../img/nurse.jpg" align="right"> -->
<FONT    SIZE=-1  FACE="Arial">

  <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','eye_s.gif','0') ?> border=0 width=16 height=16></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-schnellsicht.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDQuickView ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDQuickViewTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','eyeglass.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-patient-such-start.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDSearchPatient ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDSearchPatientTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','storage.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="pflege-station-archiv.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDArchive ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDArchiveTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','timeplan.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="pflege-station-manage-pass.php?sid=<?php echo "$sid&lang=$lang" ?>"><nobr><?php echo $LDStationMan ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDStationManTxt ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','bubble.gif','0') ?> border=0 width=15 height=14></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="newscolumns.php?sid=<?php echo "$sid&lang=$lang&target=nursing&title=$LDNursing" ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','mail.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
             
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon('../','discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="ucons.php?lang=<?php echo $lang ?>"><?php echo $LDNursingForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDNursingForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              
              <TR bgColor="#eeeeee"><td align=center><img <?php echo createComIcon('../','team_wksp.gif','0') ?>></td>
                <TD vAlign=top width="150"><FONT 
                  face="Verdana,Helvetica,Arial" size="2" color="<?php echo $cfg['body_txtcolor']; ?>"><B>
				    <nobr><?php echo $LDNursingStations ?>&nbsp;<img <?php echo createComIcon('../','dwn-arrow-grn.gif','0','absmiddle') ?>></nobr>
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

							echo '<a href="pflege-station-pass.php?sid='.$sid.'&lang='.$lang.'&rt=pflege&edit=1&station='.$stations['station'].'">'.$stations['station'].'</a> &nbsp;';
							$i++;
							if($i==4)
							{
								echo "<br>\r\n";
								$i=0;
							}
						}
					 }
					 else
					 {
					     echo $LDNoWardsYet.'<br><img '.createComIcon('../','redpfeil.gif','0','absmiddle').'> <a href="pflege-station-manage-pass.php?sid='.$sid.'&lang='.$lang.'">'.$LDClk2CreateWard.'</a>';
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
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDCloseBack2Main ?>" align="middle"></a>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
