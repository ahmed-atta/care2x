<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_products.php");
require("../req/config-color.php");

$thisfile="products-bestellkatalog-edit.php";

switch($cat)
{
	case "pharma":	$title=$LDPharmacy;
							$breakfile="apotheke.php?sid=$ck_sid&lang=$lang";
							break;
	case "medlager":$title=$LDMedDepot;
							$breakfile="medlager.php?sid=$ck_sid&lang=$lang";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

if(!$dept)
{
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
	elseif($ck_thispc_station) $dept=$ck_thispc_station;
	 elseif($ck_thispc_room) $dept=$ck_thispc_room;
	 	 else $dept="plop"; //simulate plop dept
}


if(($mode=="search")&&($keyword!="")&&($keyword!="%"))
 {
 	if($keyword=="*%*") $keyword="%";
 	 include("../req/products-search-mod.php");
 }
	else if(($mode=="save")&&($bestellnum!="")&&($artname!=""))
	{
		include("../req/products-ordercatalog-save.php");
	}

if(($mode=="delete")&&($keyword!="")) 
{
	include("../req/products-ordercatalog-delete.php");
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? 
require("../req/css-a-hilitebu.php");
?>
<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<? print $ck_sid; ?>&keyword="+b+"&mode=search&cat=<?=$cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>

</head>
<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 onLoad="document.smed.keyword.focus()"
<? print "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print  $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?="$title-$LDCatalog-$dept" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('products.php','maincat','','<?=$cat ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<form action="<? print $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?=$LDSearchWordPrompt ?>:
<br>
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="cat" value="<?=$cat ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="submit" value="<?=$LDSearchArticle ?>">
</font>
</form>
<font face="Verdana, Arial" size=2>
<?
if (($mode=="search")&&($keyword!="")) 
{
	//set order catalog flag
	$bcat=true;
	include("../req/products-search-result-mod.php");
}

if($linecount==1)
print '
	<form action="'.$thisfile.'" method="get" name="tocatform">
 	<input type="hidden" name="sid" value="'.$ck_sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
  <input type="hidden" name="artname" value="'.$zeile[artikelname].'">
  <input type="hidden" name="bestellnum" value="'.$zeile[bestellnum].'">
  <input type="hidden" name="proorder" value="'.$zeile[proorder].'">
  <input type="hidden" name="hit" value="0">
  <input type="hidden" name="mode" value="save">
  <input type="hidden" name="cat" value="'.$cat.'">
  <input type="submit" value="'.$LDPut2Catalog.'">
   </form>';
?>

</font>
<hr>
<?
// get the actual order catalog

require("../req/products-ordercatalog-getactual.php");

// show the actual order catalog
require("../req/products-ordercatalog-show.php");
?>
<p>

<p>
<a href="<?="$breakfile" ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0  alt="<?=$LDClose ?>"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top  >
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</body>
</html>
