<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_products.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
</head>
<body bgcolor="#008000"   topmargin=0 leftmargin=0  marginwidth=0 marginheight=0>
<table border=0 width=100%>
  <tr>
    <td align=center valign=top width=50%><font face="Verdana, Arial" size=3 color=#00ff00><b><?=$LDBasket ?></b></font></td>
    <td align=center valign=top><font face="Verdana, Arial" size=3 color=#00ff00><b><?=$LDCatalog ?></b></td>
	 <td align=right valign=top><nobr><a href="javascript:gethelp('products.php','head','main','<?=$cat ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="apotheke.php?sid=<?="$ck_sid&lang=$lang" ?>" target=_parent><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 
	<?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
  </font></tr>
</table>

</body>
</html>
