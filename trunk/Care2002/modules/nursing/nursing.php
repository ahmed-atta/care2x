<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

require_once($root_path.'include/inc_config_color.php');

$toggler=0;
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

require_once($root_path.'include/care_api_classes/class_ward.php');
// Load the wards info 
$ward_obj=new Ward;
$items='nr,ward_id,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);

$HTTP_SESSION_VARS['sess_file_return']=$top_dir.basename(__FILE__);
/* Set this file as the referer */
$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
$HTTP_SESSION_VARS['sess_user_origin']='dept';
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDNursing ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDNursing; ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
              
              <TR bgColor="#eeeeee"><td align=center><img <?php echo createComIcon($root_path,'team_wksp.gif','0') ?>></td>
                <TD vAlign=top width="150"><FONT 
                  face="Verdana,Helvetica,Arial" size="2" color="<?php echo $cfg['body_txtcolor']; ?>"><B>
				    <nobr><?php echo $LDNursingStations ?>&nbsp;<img <?php echo createComIcon($root_path,'dwn-arrow-grn.gif','0','absmiddle') ?>></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNursingStationsTxt ?></FONT></TD></TR>
              <TR bgColor="#dddddd" >
                <TD colSpan=3>
				  <FONT face="Verdana,Helvetica,Arial" 
                  size=2>
				  <ul>
				  <?php
				  	 if(is_object($ward_info))
					 {
						$i=0;
						while($stations=$ward_info->FetchRow())
						{

							echo '<a href="'.strtr('nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$stations['ward_id'].'&location_id='.$stations['ward_id'].'&ward_nr='.$stations['nr'],' ',' ').'"><font color="green"><b>'.strtoupper($stations['ward_id']).'</b></font></a> &nbsp;';
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
					     echo $LDNoWardsYet.'<br><img '.createComIcon($root_path,'redpfeil.gif','0','absmiddle').'> <a href="nursing-station-manage-pass.php'.URL_APPEND.'">'.$LDClk2CreateWard.'</a>';
					  }
	/*			  	 if(!empty($rows))
					 {
						$i=0;
						while($stations=$ergebnis->FetchRow())
						{

							echo '<a href="'.strtr('nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$stations['station'],' ',' ').'">'.$stations['station'].'</a> &nbsp;';
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
					     echo $LDNoWardsYet.'<br><img '.createComIcon($root_path,'redpfeil.gif','0','absmiddle').'> <a href="nursing-station-manage-pass.php'.URL_APPEND.'">'.$LDClk2CreateWard.'</a>';
					  }*/
				?>
			</UL>  
				  </TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eye_s.gif','0') ?> border=0 width=16 height=16></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="nursing-schnellsicht.php<?php echo URL_APPEND; ?>"><?php echo $LDQuickView ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDQuickViewTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eyeglass.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="nursing-patient-such-start.php<?php echo URL_APPEND; ?>"><?php echo $LDSearchPatient ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDSearchPatientTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'storage.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="nursing-station-archiv.php<?php echo URL_APPEND; ?>"><?php echo $LDArchive ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDArchiveTxt ?></FONT></TD></tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'timeplan.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="nursing-station-manage-pass.php?sid=<?php echo "$sid&lang=$lang" ?>"><nobr><?php echo $LDStationMan ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDStationManTxt ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?> border=0 width=15 height=14></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="<?php echo $root_path; ?>modules/nursing_or/nursing-or-main-pass.php<?php echo URL_APPEND."&target=setpersonal&retpath=menu" ?>"><?php echo $LDNursesList ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNursesListTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?> border=0 width=15 height=14></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="<?php echo $root_path; ?>modules/news/newscolumns.php<?php echo URL_APPEND."&dept_nr=36" ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'mail.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
             
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDNursingForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDNursingForumTxt ?></nobr></FONT></TD></TR>
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
 -->
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDCloseBack2Main ?>" align="middle"></a>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
