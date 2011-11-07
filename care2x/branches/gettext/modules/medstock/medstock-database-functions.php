<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','medstock');
define('LANG_FILE_MODULAR','medstock.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
$breakfile='medstock.php '.URL_APPEND;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

<?php 

require($root_path.'include/helpers/include_header_css_js.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td  >
<FONT    SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$LDMedDepot $LDPharmaDb" ?></STRONG></FONT></td>
<td  height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()" class="button icon arrowleft">Back</a><a href="javascript:gethelp('submenu1.php','<?php echo "$LDMedDepot $LDPharmaDb" ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  </a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  </a></td>
</tr>
<tr valign=top >
<td  valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000">
<?php if($from=="dbankpass")
{
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
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'settings_tree.gif','0','',FALSE) ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <a href="<?php echo $root_path ?>modules/products/products-database-functions-insert.php<?php echo URL_APPEND."&userck=$userck"?>&cat=medstock"><?php echo $LDNewProduct ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewProductTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'eyeglass.gif','0','',FALSE) ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="<?php echo $root_path ?>modules/products/products-database-functions-such.php<?php echo URL_APPEND."&userck=$userck"?>&cat=medstock"><?php echo $LDSearch ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDSearchDb ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0','',FALSE) ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="<?php echo $root_path ?>modules/products/products-database-functions-manage.php<?php echo URL_APPEND."&userck=$userck"?>&cat=medstock"><nobr><?php echo $LDManage ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPharmaDbTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
             
              <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'icn_rad.gif','0','',FALSE) ?>></td>
                <TD vAlign=top width=150><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<a href="medstock-report.php<?php echo URL_APPEND."&userck=$userck"?>"><?php echo $LDReports ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDReportsTxt ?></nobr></FONT></TD></TR>

		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
<p>
<a href="<?php echo "$breakfile" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','',FALSE) ?>  alt="<?php echo $LDClose ?>" align="middle"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
<tr>
<td  height=70 colspan=2>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
