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
$local_user='ck_prod_order_user';
require_once('../include/inc_front_chain_lang.php');
switch($cat)
{
	case "pharma": $breakfile="apotheke.php?sid=".$sid."&lang=".$lang;
	                       break;
    case "medlager": $breakfile="medlager.php?sid=".$sid."&lang=".$lang;
	                       break;
}
?>
<html>
<head>
<?php echo setCharSet(); ?>

<script language="javascript">
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
</head>
<body bgcolor="#008000"   topmargin=0 leftmargin=0  marginwidth=0 marginheight=0>
<table border=0 width=100%>
  <tr>
    <td align=center valign=top width=50%><font face="Verdana, Arial" size=3 color=#00ff00><b><?php echo $LDBasket ?></b></font></td>
    <td align=center valign=top><font face="Verdana, Arial" size=3 color=#00ff00><b><?php echo $LDCatalog ?></b></td>
	 <td align=right valign=top><nobr><a href="javascript:gethelp('products.php','head','main','<?php echo $cat ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile; ?>" target=_parent><img <?php echo createLDImgSrc('../','close2.gif','0') ?> 
	<?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
  </font></tr>
</table>

</body>
</html>
