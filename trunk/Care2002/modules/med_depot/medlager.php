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
define('LANG_FILE','products.php');
define('NO_2LEVEL_CHK','1');
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
<script language="javascript">
<!-- 
<?php if($stb)
echo '
		function startbot()
		{
		medibotwin'.$sid.'=window.open("'.$root_path.'modules/products/products-bestellbot.php'.URL_REDIRECT_APPEND.'&cat=medlager&userck='.$userck.'","medibotwin'.$sid.'","width=200,height=180,menubar=no,resizable=yes,scrollbars=yes");
		}
		';
?>

// -->
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0
<?php if(isset($stb)&&$stb) echo 'onLoad="startbot()" ';
 if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 ?>
 >

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDMedDepot ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDMedDepot ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
  <TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bestell.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="medlager-pass.php<?php echo URL_APPEND;?>&mode=order"><?php echo $LDPharmaOrder ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPharmaOrderTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'help_tree.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="javascript:gethelp('products.php','how2','','meddepot')"><?php echo $LDHow2Order ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDHow2OrderTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
 			 <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'templates.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="<?php echo $root_path;?>modules/products/products-bestellkatalog-edit.php<?php echo URL_APPEND;?>&cat=medlager"><?php echo $LDOrderCat ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrderCatTxt ?></nobr></FONT></TD></TR>
               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>           
				              
              <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'documents.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="medlager-pass.php<?php echo URL_APPEND;?>&mode=archive"><?php echo $LDOrderArchive ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrderArchiveTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'storage.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="medlager-pass.php<?php echo URL_APPEND;?>&mode=dbank"><?php echo $LDPharmaDb ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPharmaDbTxt ?></FONT></TD></TR>
   
			   <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
                <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'sitemap_animator.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="medlager-bestellbot-pass.php<?php echo URL_APPEND;?>" ><?php echo $LDMediBotActivate ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOrderBotActivateTxt ?></nobr></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top  >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>        
&nbsp;

</BODY>
</HTML>
