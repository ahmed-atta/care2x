<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

setcookie(firstentry,''); // The cookie "firsentry" is used for switching the cat image

/* Check the start script as break destination*/
if (!empty($HTTP_SESSION_VARS['sess_path_referer'])&&($HTTP_SESSION_VARS['sess_path_referer']!=$top_dir.$thisfile)){
	if(file_exists($root_path.$HTTP_SESSION_VARS['sess_path_referer'])){
		$breakfile=$HTTP_SESSION_VARS['sess_path_referer'];
	}else {
		 /* default startpage */
		$breakfile = 'main/startframe.php';
	}
} else {
		 /* default startpage */
		$breakfile = 'main/startframe.php';
}
$breakfile=$root_path.$breakfile.URL_APPEND;

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.$thisfile;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript" >
<!-- 
function closewin()
{
	location.href="<?php echo $root_path ?>main/startframe.php?sid=<?php echo URL_REDIRECT_APPEND;?>";
}
// -->
</script> 
 
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<SCRIPT language="JavaScript" src="<?php echo $root_path ?>js/sublinker-nd.js">
</SCRIPT>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDOr ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDOr ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>

<ul>
<img <?php echo createLDImgSrc($root_path,'arzt2.gif','0','absmiddle') ?>  alt="<?php echo $LDDoctor ?>">
  <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path; ?>modules/op_document/op-doku-pass.php<?php echo URL_APPEND ?>" onmouseover="ssm('ALog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo $LDOrDocument ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDOrDocumentTxt ?></FONT></TD>
				  </tr>
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="<?php echo $root_path; ?>modules/doctors/doctors-dienst-schnellsicht.php<?php echo URL_APPEND ?>&retpath=op"><?php echo "$LDDOC $LDQuickView" ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQviewTxtDocs ?></nobr></FONT></TD></TR>
              
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  <a href="#" onmouseover="ssm('ADienstplan'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)">Dienstplan</a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2>Dienstplan erstellen, ansehen, verarbeiten, u.s.w.</FONT></TD></TR> -->
              
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<img <?php echo createLDImgSrc($root_path,'pflege2.gif','0','absmiddle') ?> alt="<?php echo $LDNursing ?>">
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="<?php echo $root_path ?>modules/or_logbook/op-pflege-logbuch-pass.php<?php echo URL_APPEND ?>" onmouseover="ssm('PLog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo $LDOrLogBook ?></a><br>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDOrLogBookTxt ?></FONT></TD>
				 </tr>
<!-- 				 
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="ucons.php?lang=<?php echo $lang ?>" onmouseover="ssm('PProgram'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)"><?php echo $LDOrProgram ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrProgramTxt ?></nobr></FONT></TD></TR>
 -->              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienst-schnellsicht.php<?php echo URL_APPEND ?>"><?php echo "$LDORNOC $LDQuickView" ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDQviewTxtNurse ?></FONT></TD></TR>
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path ?>modules/nursing_or/nursing-or-main-pass.php<?php echo URL_APPEND ?>&retpath=menu&target=dutyplan" onmouseover="ssm('PDienstplan'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo "$LDORNOC $LDScheduler" ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDutyPlanTxt ?></FONT></TD></TR>
				  
				  <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>
				<a href="spediens-bdienst-zeit-erfassung.php<?php echo URL_APPEND."&retpath=op&encoder=".$HTTP_COOKIE_VARS['ck_login_username'.$sid]; ?>" ><?php echo $LDOnCallDuty ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOnCallDutyTxt ?></nobr></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<img <?php echo createLDImgSrc($root_path,'anaes.gif','0','absmiddle') ?> alt="<?php echo $LDAna ?>">
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
<!--               <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  <a href="ucons.php<?php echo URL_APPEND; ?>" ><?php echo "$LDOr $LDAnaLogBook" ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDAnaLogBookTxt ?></FONT></TD>
				</tr>
                           
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
 -->				  
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienst-schnellsicht.php<?php echo URL_APPEND; ?>&retpath=menu&hilitedept=39"><?php echo $LDQuickView ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDQviewTxtAna ?></FONT></TD></TR>
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienstplan.php<?php echo URL_APPEND ?>&dept_nr=39&retpath=menu" onmouseover="ssm('AnaDienstplan'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo "$LDORNOC $LDScheduler" ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDutyPlanTxt ?></FONT></TD></TR>
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
</td></tr>
</table>        
&nbsp;




</FONT>

<DIV id=PLog
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/or_logbook/op-pflege-logbuch-pass.php<?php echo URL_REDIRECT_APPEND."&target=entry"; ?>"><?php echo $LDNewDocu ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/or_logbook/op-pflege-logbuch-pass.php<?php echo URL_REDIRECT_APPEND. "&target=search"; ?>"><?php echo $LDSearch ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/or_logbook/op-pflege-logbuch-pass.php<?php echo URL_REDIRECT_APPEND."&target=archiv"; ?>"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>

<DIV id=PProgram
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
<DIV id=PDienstplan
style=" VISIBILITY: hidden; POSITION: absolute;  ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienstplan.php<?php echo URL_REDIRECT_APPEND; ?>&retpath=menu"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/nursing_or/nursing-or-main-pass.php<?php echo URL_REDIRECT_APPEND; ?>&retpath=menu&target=dutyplan"><?php echo "$LDCreate/$LDUpdate" ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path; ?>modules/nursing_or/nursing-or-main-pass.php<?php echo URL_REDIRECT_APPEND."&target=setpersonal&retpath=menu" ?>"><?php echo $LDCreatePersonList ?></A></nobr></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
<DIV id=ALog
style=" VISIBILITY: hidden; POSITION: absolute;  ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path; ?>modules/op_document/op-doku-pass.php<?php echo URL_REDIRECT_APPEND; ?>&target=entry"><?php echo $LDNewDocu ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path; ?>modules/op_document/op-doku-pass.php<?php echo URL_REDIRECT_APPEND; ?>&target=search"><?php echo $LDSearch ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path; ?>modules/op_document/op-doku-pass.php<?php echo URL_REDIRECT_APPEND; ?>&target=archiv"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
<DIV id=ADienstplan
style=" VISIBILITY: hidden; POSITION: absolute;  ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
			
<DIV id=AnaLog
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDNewDocu ?> 
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDSearch ?> 
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php<?php echo URL_REDIRECT_APPEND; ?>"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>

<DIV id=AnaDienstplan
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienstplan.php<?php echo URL_REDIRECT_APPEND; ?>&dept_nr=42"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="<?php echo $root_path ?>modules/nursing_or/nursing-or-main-pass.php<?php echo URL_REDIRECT_APPEND; ?>&dept_nr=42&retpath=menu&target=dutyplan"><?php echo "$LDCreate/$LDUpdate" ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
</BODY>
</HTML>
