<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

require_once($root_path.'include/inc_config_color.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

if(!session_is_registered('sess_pid')) session_register('sess_pid');
if(!session_is_registered('sess_full_pid')) session_register('sess_full_pid');
if(!session_is_registered('sess_en')) session_register('sess_en');
if(!session_is_registered('sess_full_en')) session_register('sess_full_en');

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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDPerson ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('person_reg.php','<?php echo $LDDoctors ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'post_discussion.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&retpath=docs"><?php echo $LDPatientRegister ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDPatientRegisterTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'bn.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="aufnahme_pass.php<?php echo URL_APPEND ?>&target=dutyplan&retpath=menu"><?php echo $LDAdmission ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDAdmissionTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
             <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="aufnahme_pass.php<?php echo URL_APPEND; ?>&target=entry&retpath=docs"><?php echo $LDVisit ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDVisitTxt ?></nobr></FONT></TD></TR>
 			  <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>

				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDAppointments ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDAppointmentsTxt ?></FONT></TD></TR>				 
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDDiagXResults ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDiagXResultsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>	
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eye_s.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDDRG ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDRGTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>

               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDProcedures ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDProceduresTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'prescription.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDPrescriptions ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDPrescriptionsTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_group.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDReports ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDPatientDevTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'people_search_online.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDImmunization ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDImmunizationTxt ?></nobr></FONT></TD></TR>
                 <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'people_search_online.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDMeasurements ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDWtHtTxt ?></nobr></FONT></TD></TR>
                 <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'man-whi.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDPregnancies ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDPregnanciesTxt ?></nobr></FONT></TD></TR>				  
                 <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'new_address.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="patient_register_pass.php<?php echo URL_APPEND; ?>&target=search&retpath=docs"><?php echo $LDBirthDetails ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDBirthDetailsTxt ?></nobr></FONT></TD></TR>					</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDCloseAlt ?>" align="middle"></a>
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
&nbsp;
</FONT>
</BODY>
</HTML>
