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
define("LANG_FILE","products.php");
define("NO_2LEVEL_CHK","1");
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$breakfile="startframe.php?sid=$sid&lang=$lang";
// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript">
<!-- 
<?php if($stb)
print '
		function startbot()
		{
		botwin=window.open("products-bestellbot.php?sid='.$sid.'&lang='.$lang.'&cat=medlager&userck='.$userck.'","botwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");
		}
		';
?>
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
<?php if($stb) print 'onLoad="startbot()" ';
 if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 ?>
 >

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDMedDepot ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDMedDepot ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
  <TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img src="../img/bestell.gif" border=0 width=16 height=16></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="medlager-pass.php?sid=<?php echo "$sid&lang=$lang";?>&mode=order"><?php echo $LDPharmaOrder ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPharmaOrderTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img src="../img/help_tree.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="javascript:gethelp('products.php','how2','','meddepot')"><?php echo $LDHow2Order ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDHow2OrderTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
 			 <TR bgColor=#eeeeee><td align=center><img src="../img/templates.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="products-bestellkatalog-edit.php?sid=<?php echo "$sid&lang=$lang" ?>&cat=medlager"><?php echo $LDOrderCat ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrderCatTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>           
				              
              <TR bgColor=#eeeeee> <td align=center><img src="../img/documents.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="medlager-pass.php?sid=<?php echo "$sid&lang=$lang"?>&mode=archive"><?php echo $LDOrderArchive ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrderArchiveTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
               <TR bgColor=#eeeeee><td align=center><img src="../img/storage.gif" border=0 width=16 height=17></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="medlager-pass.php?sid=<?php echo "$sid&lang=$lang";?>&mode=dbank"><?php echo $LDPharmaDb ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPharmaDbTxt ?></FONT></TD></TR>
   
			   <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../img/pixel.gif" 
                  width=5></TD></TR>
				  
                <TR bgColor=#eeeeee> <td align=center><img src="../img/sitemap_animator.gif" border=0 width=16 height=16></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="medlager-bestellbot-pass.php?sid=<?php echo "$sid&lang=$lang" ?>" ><?php echo $LDMediBotActivate ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrderBotActivateTxt ?></nobr></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top  >
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
