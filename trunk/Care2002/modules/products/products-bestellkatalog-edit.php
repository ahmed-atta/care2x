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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$thisfile=basename(__FILE__);

$invalid=0; // Set a toggler flag
if(isset($cat))
{
    switch($cat)
    {
	case "pharma":	$title=$LDPharmacy;
							$breakfile=$root_path."modules/pharmacy/apotheke.php".URL_APPEND;
							break;
	case "medlager":$title=$LDMedDepot;
							$breakfile=$root_path."modules/med_depot/medlager.php".URL_APPEND;
							break;
	default:  $invalid=1;
    }
}
else $invalid=1;

if ($invalid) 
{
    header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); 
	exit;
}
if(!isset($dept)||empty($dept))
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&$HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	elseif(isset($HTTP_COOKIE_VARS['ck_thispc_station'])&&$HTTP_COOKIE_VARS['ck_thispc_station']) $dept=$HTTP_COOKIE_VARS['ck_thispc_station'];
	 elseif(isset($HTTP_COOKIE_VARS['ck_thispc_room'])&&$HTTP_COOKIE_VARS['ck_thispc_room']) $dept=$HTTP_COOKIE_VARS['ck_thispc_room'];
	 	 else $dept='plop'; //simulate plop dept
}

if(($mode=='search')&&($keyword!='')&&($keyword!='%'))
 {
 	if($keyword=="*%*") $keyword="%";
 	 include($root_path.'include/inc_products_search_mod.php');
 }
	else if(($mode=='save')&&($bestellnum!='')&&($artname!=''))
	{
		include($root_path.'include/inc_products_ordercatalog_save.php');
	}

if(($mode=='delete')&&($keyword!='')) 
{
	include($root_path.'include/inc_products_ordercatalog_delete.php');
}
?>
<html>
<head>
<?php echo setCharSet(); ?>
<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}

</script>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 onLoad="document.smed.keyword.focus()"
<?php echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo  $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$title-$LDCatalog-$dept" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products.php','maincat','','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<form action="<?php echo $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?php echo $LDSearchWordPrompt ?>:
<br>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="cat" value="<?php echo $cat ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="submit" value="<?php echo $LDSearchArticle ?>">
</font>
</form>
<font face="Verdana, Arial" size=2>
<?php if (($mode=='search')&&($keyword!='')) 
{
	//set order catalog flag
	$bcat=true;
	include("inc_products_search_result_mod.php");
}

if($linecount==1)
echo '
	<form action="'.$thisfile.'" method="get" name="tocatform">
 	<input type="hidden" name="sid" value="'.$sid.'">
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
<?php
// get the actual order catalog

require($root_path.'include/inc_products_ordercatalog_getactual.php');

// show the actual order catalog
require($root_path."include/inc_products_ordercatalog_show.php");
?>
<p>

<p>
<a href="<?php echo "$breakfile" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>

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

</body>
</html>
