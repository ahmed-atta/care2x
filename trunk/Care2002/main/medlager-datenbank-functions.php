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
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');
$breakfile="medlager.php?sid=".$sid."&lang=".$lang;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <script language="javascript" >
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$LDMedDepot $LDPharmaDb" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo "$LDMedDepot $LDPharmaDb" ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000">
<?php if($from=="dbankpass")
{
echo '<img '.createMascot('../','mascot1_r.gif','0','bottom','absmiddle').'> ';
$curtime=date("H.i");
if ($curtime<"9.00") echo $LDGoodMorning;
if (($curtime>"9.00")and($curtime<"18.00")) echo $LDGoodDay;
if ($curtime>"18.00") echo $LDGoodEvening;
echo " $ck_prod_db_user!";
}
?><p><br>
  <TABLE cellSpacing=0 cellPadding=0 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','settings_tree.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="products-datenbank-functions-eingabe.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"?>&cat=medlager"><?php echo $LDNewProduct ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewProductTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','eyeglass.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="products-datenbank-functions-such.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"?>&cat=medlager"><?php echo $LDSearch ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDSearchDb ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon('../','discussions.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="products-datenbank-functions-manage.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"?>&cat=medlager"><nobr><?php echo $LDManage ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPharmaDbTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
             
              <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon('../','icn_rad.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="medlager-report.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"?>"><?php echo $LDReports ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDReportsTxt ?></nobr></FONT></TD></TR>

              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon('../','info2.gif','0') ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <nobr><a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDInfo ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDInfoTxt ?></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
<p>
<a href="<?php echo "$breakfile" ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

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
