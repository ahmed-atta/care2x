<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

if($mode=="save")
{
	$OneYear=time()+(3600*24*365);
	setcookie(ck_thispc_dept,$pcdept,$OneYear); //expires in 1 year
	setcookie(ck_thispc_station,$pcstation,$OneYear);
	setcookie(ck_thispc_room,$pcroom,$OneYear);
	setcookie(ck_thispc_phone,$pcphone,$OneYear);
	setcookie(ck_thispc_intercom,$pcintercom,$OneYear);
	header("location: login-pc-config.php?sid=$ck_sid&lang=$lang&saved=1");
}

require("../req/config-color.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 
<script language="javascript" >
<!-- 
function closewin()
{
	location.href='startframe.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}
// -->
</script> 
<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="window.parent.STARTPAGE.location.href='indexframe.php?sid=<?="$ck_sid&lang=$lang" ?>'" 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  
SIZE=+3  FACE="Arial">
<STRONG> &nbsp;<?=$LDLogin ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right><a href="#"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle"  
 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="js_allrestart.htm?sid=<?print $ck_sid;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle"   <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td></tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>

<table>
<tr bgcolor=<? print $cfg['body_bgcolor']; ?>>
<td align=right><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
<td >
<? if ($saved) : ?>
<FONT  face="Verdana,Helvetica,Arial" size=3 color="#990000"><?=$LDChangeSaved ?><br>
<? else : ?>
<FONT  face="Verdana,Helvetica,Arial" size=5><font color="#cc0000" ><?=$LDWelcome ?>!</font><br>
<?=$ck_login_username ?>
<? endif ?>
</td></tr>
</table>

<form name="pcids"  method="post">
<TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT 
                  face="Verdana,Helvetica,Arial" size=2> <?=$LDPcID ?></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/home.gif" width=21 height=10 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <input type="text" name="pcdept" size=20 maxlength=25 value="<?=$ck_thispc_dept ?>">
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?=$LDDept ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/statbel2.gif" width=20 height=20 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <input type="text" name="pcstation" size=20 maxlength=25 value="<?=$ck_thispc_station ?>">
     			  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?=$LDWard ?></nobr></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
                <TR bgColor=#eeeeee><td align=center><img src="../img//button_info.gif" width=15 height=15 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="pcroom" size=20 maxlength=25 value="<?=$ck_thispc_room ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDWardOR ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/profile.gif" width=14 height=14 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="pcphone" size=20 maxlength=25 value="<?=$ck_thispc_phone ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDPhoneNr ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/listen-sm-legend.gif" width=15 height=15 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <input type="text" name="pcintercom" size=20 maxlength=25 value="<?=$ck_thispc_intercom ?>">
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDIntercomNr ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img src="../img/lightning.gif" width=17 height=17 border=0></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <?=$REMOTE_ADDR ?>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?=$LDPcIP ?></FONT></TD></TR>
             
			 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="save">
<input type="submit" value="<?=$LDSave ?>">
<input type="button" value="<?=$LDNoChange ?>" onClick="window.location.href='startframe.php?sid=<?="$ck_sid&lang=$lang" ?>'">&nbsp;
<a href="startframe.php?sid=<?="$ck_sid&lang=$lang" ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0  alt="<?=$LDClose ?>" align="absmiddle"></a>
</form>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
