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
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');
switch($cat)
{
	case "pharma": $breakfile=$root_path."modules/pharmacy/apotheke.php".URL_APPEND;
	                       break;
    case "medlager": $breakfile=$root_path."modules/med_depot/medlager.php".URL_APPEND;
	                       break;
}
?>
<html>
<head>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</head>
<body bgcolor="#008000"   topmargin=0 leftmargin=0  marginwidth=0 marginheight=0>
<table border=0 width=100%>
  <tr>
    <td align=center valign=top width=50%><font face="Verdana, Arial" size=3 color=#00ff00><b><?php echo $LDBasket ?></b></font></td>
    <td align=center valign=top><font face="Verdana, Arial" size=3 color=#00ff00><b><?php echo $LDCatalog ?></b></td>
	 <td align=right valign=top><nobr><a href="javascript:gethelp('products.php','head','main','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile; ?>" target=_parent><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> 
	<?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
  </font></tr>
</table>

</body>
</html>
