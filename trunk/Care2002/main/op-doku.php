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
define("LANG_FILE","or.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$breakfile="startframe.php?sid=$sid&lang=$lang";

setcookie(firstentry,""); // The cookie "firsentry" is used for switching the cat image
// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
<!-- 
function closewin()
{
	location.href='startframe.php?sid=<?php echo "$sid&lang=$lang";?>';
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

<SCRIPT language="JavaScript" src="../js/sublinker-nd.js">
</SCRIPT>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo $LDOr ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDOr ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>

<ul>
<img src="../img/<?php echo "$lang/$lang" ?>_arzt2.gif" border=0  alt="<?php echo $LDDoctor ?>">
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
				 <img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle"> 
				 <a href="op-doku-pass.php?sid=<?php echo "$sid&lang=$lang" ?>" onmouseover="ssm('ALog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo $LDOrDocument ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDOrDocumentTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  
				<a href="doctors-dienst-schnellsicht.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=op"><?php echo "$LDDOC $LDQuickView" ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQviewTxtDocs ?></nobr></FONT></TD></TR>
              
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  <a href="#" onmouseover="ssm('ADienstplan'); clearTimeout(timer) " 
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
<img src="../img/<?php echo "$lang/$lang" ?>_pflege2.gif" border=0  height=24 alt="<?php echo $LDNursing ?>">
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
				 <img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  
				 <a href="op-pflege-logbuch-pass.php?sid=<?php echo "$sid&lang=$lang" ?>" onmouseover="ssm('PLog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo $LDOrLogBook ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDOrLogBookTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  
				<a href="ucons.php?lang=<?php echo $lang ?>" onmouseover="ssm('PProgram'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)"><?php echo $LDOrProgram ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrProgramTxt ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle"> 
				 <a href="op-pflege-dienst-schnellsicht.php?sid=<?php echo "$sid&lang=$lang" ?>"><?php echo "$LDORNOC $LDQuickView" ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQviewTxtNurse ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle"> 
				 <a href="op-pflege-dienstplan-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=menu" onmouseover="ssm('PDienstplan'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo "$LDORNOC $LDScheduler" ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDutyPlanTxt ?></FONT></TD></TR>
				  <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">
				<a href="spediens-bdienst-zeit-erfassung.php?sid=<?php echo "$sid&lang=$lang&retpath=op&encoder=".$HTTP_COOKIE_VARS['ck_login_username'.$sid]; ?>" ><?php echo $LDOnCallDuty ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOnCallDutyTxt ?></nobr></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<img src="../img/<?php echo "$lang/$lang" ?>_anaes.gif" border=0  height=24 alt="<?php echo $LDAna ?>">
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
				 <img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  <a href="ucons.php" onmouseover="ssm('AnaLog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo "$LDOr $LDAnaLogBook" ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDAnaLogBookTxt ?></FONT></TD>
                           
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  
				<a href="op-pflege-dienst-schnellsicht.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=menu&hilitedept=anaesth"><?php echo $LDQuickView ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQviewTxtAna ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img src="../img/blaupfeil.gif" border=0 width=4 height=7 align="middle">  
				<a href="op-pflege-dienstplan.php?sid=<?php echo "$sid&lang=$lang" ?>&dept=anaesth&retpath=menu" onmouseover="ssm('AnaDienstplan'); clearTimeout(timer) " 
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
            href="op-pflege-logbuch-pass.php?sid=<?php echo "$sid&lang=$lang&target=entry"; ?>"><?php echo $LDNewDocu ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php?sid=<?php echo "$sid&lang=$lang&target=search"; ?>"><?php echo $LDSearch ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php?sid=<?php echo "$sid&lang=$lang&target=archiv"; ?>"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
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
            href="ucons.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
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
            href="op-pflege-dienstplan.php?sid=<?php echo "$sid&lang=$lang"; ?>&retpath=menu"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan-pass.php?sid=<?php echo $sid.'&lang='.$lang.'&pmonth='.date(m); ?>&retpath=menu"><?php echo "$LDCreate/$LDUpdate" ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienst-personalliste-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>&ipath=menu"><?php echo $LDCreatePersonList ?></A></nobr></TD></TR></TABLE></TD></TR></TBODY></TABLE>
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
            href="op-doku-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>&target=entry"><?php echo $LDNewDocu ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-doku-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>&target=search"><?php echo $LDSearch ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-doku-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>&target=archiv"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
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
            href="op-pflege-logbuch-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
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
            href="op-pflege-logbuch-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDNewDocu ?> 
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDSearch ?> 
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
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
            href="op-pflege-dienstplan.php?sid=<?php echo "$sid&lang=$lang"; ?>&dept=anaesth"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan-pass.php?sid=<?php echo $sid.'&lang='.$lang.'&pmonth='.date(m); ?>&dept=anaesth&retpath=menu"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan-pass.php?sid=<?php echo "$sid&lang=$lang"; ?>&dept=anaesth&retpath=menu"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
</BODY>
</HTML>
