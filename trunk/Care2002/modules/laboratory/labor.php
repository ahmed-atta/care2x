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
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript" >
<!-- 
function closewin()
{
	location.href='startframe.php?sid=<?php echo "$sid&lang=$lang";?>';
}
// -->
</script> 
 
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<SCRIPT language="JavaScript" src="../../js/sublinker-nd.js">
</SCRIPT>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDLab ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right><a href="startframe.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>
<?php if($cfg['dhtml'])echo' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDLab ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>

<ul>
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000"><b><?php echo $LDMedLab ?></b></FONT>
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
               <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=chemlabor&user_origin=lab" ><?php echo $LDTestRequest ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestRequestChemLabTxt ?></FONT></TD>
			</TR> 
                           
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
               <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=admin&subtarget=chemlabor&user_origin=lab" >
				 <?php echo $LDTestReception ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestReceptionTxt ?></FONT></TD>
			</TR> 
                           
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
			<TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_datasearch_pass.php?<?php echo "sid=$sid&lang=$lang" ?>&route=validroute">
				 <?php echo $LDSeeData  ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDSeeLabData  ?></FONT></TD>
			</TR> 
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  

              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="labor_datainput_pass.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDNewData ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDEnterLabData ?></nobr></FONT></TD></TR>
<!--               
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDPrioParams ?>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDEnterPrioParams ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDNorms ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDEnterNorms ?></FONT></TD></TR>
				  <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>
				<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDOptions ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOtherOptions ?></nobr></FONT></TD></TR>
				  <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>
				<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDTitleMemo ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDMemo ?></nobr></FONT></TD></TR> -->
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>

<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000"><b><?php echo $LDPathLab ?></b></FONT>
  <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=patho&user_origin=lab"><?php echo $LDTestRequest ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestRequestPathoTxt ?></FONT></TD>
			</TR> 
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
               <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=admin&subtarget=patho&user_origin=lab" >
				 <?php echo $LDTestReception ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestReceptionTxt ?></FONT></TD>
			</TR> 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>

<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000"><b><?php echo $LDBacLab ?></b></FONT>
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=baclabor&user_origin=lab" ><?php echo $LDTestRequest ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestRequestBacterioTxt ?></FONT></TD>
			</TR> 
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
               <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=admin&subtarget=baclabor&user_origin=lab" >
				 <?php echo $LDTestReception ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestReceptionTxt ?></FONT></TD>
			</TR> 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000"><b><?php echo $LDBloodBank ?></b></FONT>

 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=blood&user_origin=lab" ><?php echo $LDBloodRequest ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDBloodRequestTxt ?></FONT></TD>
			</TR> 
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
               <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_request_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=admin&subtarget=blood&user_origin=lab" >
				 <?php echo $LDTestReception ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestReceptionTxt ?></FONT></TD>
			</TR> 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
		
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000"><b><?php echo $LDAdministration ?></b></FONT>

 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_test_param_edit_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&user_origin=lab" ><?php echo $LDTestParameters ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDTestParametersTxt ?></FONT></TD>
			</TR> 
                           				                             
		</TBODY>
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
