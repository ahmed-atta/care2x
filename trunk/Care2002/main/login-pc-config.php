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
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if(isset($mode)&&($mode=="save"))
{
	$OneYear=time()+(3600*24*365);
	setcookie(ck_thispc_dept,$HTTP_POST_VARS['pcdept'],$OneYear); //expires in 1 year
	setcookie(ck_thispc_station,$HTTP_POST_VARS['pcstation'],$OneYear);
	setcookie(ck_thispc_room,$HTTP_POST_VARS['pcroom'],$OneYear);
	setcookie(ck_thispc_phone,$HTTP_POST_VARS['pcphone'],$OneYear);
	setcookie(ck_thispc_intercom,$HTTP_POST_VARS['pcintercom'],$OneYear);
	header("location: login-pc-config.php?sid=$sid&lang=$lang&saved=1");
}

require("../include/inc_config_color.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 
<script language="javascript" >
<!-- 
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="window.parent.STARTPAGE.location.href='indexframe.php?sid=<?php echo "$sid&lang=$lang" ?>'" 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  
SIZE=+3  FACE="Arial">
<STRONG> &nbsp;<?php echo $LDLogin ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right><a href="javascript:gethelp('');"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle"  
 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="js_allrestart.htm?sid=<?php echo $sid;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle"   <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td></tr>
<tr>
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>

<table>
<tr bgcolor=<?php print $cfg['body_bgcolor']; ?>>
<td align=right><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
<td >
<?php if ($saved) : ?>
<FONT  face="Verdana,Helvetica,Arial" size=3 color="#990000"><?php echo $LDChangeSaved ?><br>
<?php else : ?>
<FONT  face="Verdana,Helvetica,Arial" size=5><font color="#cc0000" ><?php echo $LDWelcome ?>!</font><br>
<?php echo $HTTP_COOKIE_VARS['ck_login_username'.$sid] ?>
<?php endif ?>
</td></tr>
</table>

<form name="pcids"  method="post" action="login-pc-config.php">
<TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <?php echo $LDPcID ?></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/home.gif" width=21 height=10 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <input type="text" name="pcdept" size=20 maxlength=25 value="<?php echo $HTTP_COOKIE_VARS['ck_thispc_dept'] ?>">
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDDept ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/statbel2.gif" width=20 height=20 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <input type="text" name="pcstation" size=20 maxlength=25 value="<?php echo $HTTP_COOKIE_VARS['ck_thispc_station'] ?>">
     			  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDWard ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
                <TR bgColor=#eeeeee><td align=center><img src="../img//button_info.gif" width=15 height=15 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="pcroom" size=20 maxlength=25 value="<?php echo $HTTP_COOKIE_VARS['ck_thispc_room'] ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDWardOR ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/profile.gif" width=14 height=14 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="pcphone" size=20 maxlength=25 value="<?php echo $HTTP_COOKIE_VARS['ck_thispc_phone'] ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPhoneNr ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/listen-sm-legend.gif" width=15 height=15 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="pcintercom" size=20 maxlength=25 value="<?php echo $HTTP_COOKIE_VARS['ck_thispc_intercom'] ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDIntercomNr ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/lightning.gif" width=17 height=17 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <?php echo $REMOTE_ADDR ?>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPcIP ?></FONT></TD></TR>
             
			 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="save">
<input type="submit" value="<?php echo $LDSave ?>">
<input type="button" value="<?php echo $LDNoChange ?>" onClick="window.location.href='startframe.php?sid=<?php echo "$sid&lang=$lang" ?>'">&nbsp;
<a href="startframe.php?sid=<?php echo "$sid&lang=$lang" ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  alt="<?php echo $LDClose ?>" align="absmiddle"></a>
</form>
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
</BODY>
</HTML>
