<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$thisfile="products-datenbank-functions-such.php";

switch($cat)
{
	case "pharma":	
							$title=$LDPharmacy;
							$breakfile=$root_path."modules/pharmacy/apotheke-datenbank-functions.php".URL_APPEND."&userck=$userck";
							$imgpath=$root_path."pharma/img/";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$breakfile=$root_path."modules/med_depot/medlager-datenbank-functions.php".URL_APPEND."&userck=$userck";
							$imgpath=$root_path."med_depot/img/";
							break;
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

require($root_path."include/inc_products_search_mod.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <script language="javascript" >
<!-- 

function pruf(d)
{
	if(d.keyword.value=="")
	{
		d.keyword.focus();
		 return false;
	}
	return true;
}

// -->
</script> 

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.select()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$title $LDPharmaDb $LDSearch" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products_db.php','search','<?php echo $from ?>','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
  <form action="<?php echo $thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><?php echo $LDSearchWordPrompt ?></font>
	  <br><p></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDSearchKey ?>:</td>
      <td><input type="text" name="keyword" size=40 maxlength=40 value="<?php echo $keyword ?>">
          </td>
    </tr>
   

    <tr >
     
      <td ><input type="reset" value="<?php echo $LDReset ?>" onClick="document.suchform.keyword.focus()">
                      </td>
     <td align=right><input type="submit" value="<?php echo $LDSearch ?>" >
           </td>
   </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid?>">
  <input type="hidden" name="lang" value="<?php echo $lang?>">
  <input type="hidden" name="cat" value="<?php echo $cat?>">
<input type="hidden" name="userck" value="<?php echo $userck ?>">
  <input type="hidden" name="mode" value="search">
  </form>

<hr>
<?php
require($root_path."include/inc_products_search_result_mod.php");
?>

<form action="<?php echo $breakfile?>" method="post">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="userck" value="<?php echo $userck ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border=0 width=103 height=24 alt="<?php echo $LDBack2Menu ?>" align="left">
</form>
<?php if ($from=="multiple")
echo '
<form name=backbut onSubmit="return false">
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="userck" value="'.$userck.'">
<input type="submit" value="'.$LDBack.'" onClick="history.back()">
</form>
';
?>
</ul>
</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
