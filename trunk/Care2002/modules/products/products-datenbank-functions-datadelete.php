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
$local_user='ck_prod_db_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$thisfile=basename(__FILE__);
switch($cat)
{
	case "pharma":
							$title=$LDPharmacy;
							$dbtable="care_pharma_products_main";
							$imgpath=$root_path."pharma/img/";
							$breakfile=$root_path."modules/pharmacy/apotheke-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$dbtable="care_med_products_main";
							$imgpath=$root_path."med_depot/img/";
							$breakfile=$root_path."modules/med_depot/medlager-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

if(($mode=='delete')&&($sure)&&($keyword!='')&&($keytype!="")) 
{

$deleteok=false;


//init db parameters
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
 	if($dblink_ok) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' WHERE  '.$keytype.'="'.$keyword.'"';
        		if($ergebnis=$db->Execute($sql))
				{
					header ("location:products-datenbank-functions-manage.php".URL_REDIRECT_APPEND."&from=deleteok&cat=$cat&userck=$userck");
					$deleteok=true;
				}
			echo $sql;
		}
  		 else { echo "$LDDbNoLink<br>"; } 
}

	//simulate update to search the keyword
	$update=true;
 	require($root_path."include/inc_products_search_mod.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> <?php echo $title ?> - Verwalten </TITLE>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$LDPharmacy $LDPharmaDb $LDManage" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products_db.php','delete','<?php echo $from ?>','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>



<?php 
if(!$sure)
{
	 echo '
	 	<table border=0>
     <tr>
       <td><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDConfirmDelete.'</font><br>
		<font size=2>'.$LDAlertDelete.'</font><p>
		<a href="products-datenbank-functions-manage.php'.URL_APPEND.'&keyword='.$keyword.'&userck='.$userck.'&cat='.$cat.'&mode=search"><b><font color="#ff0000"><< '.$LDNoBack.'</font></b></a></td>
     </tr>
   </table>	';
}
else
{
	if(!$deleteok) echo'
			<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDNoDelete.'</font><p>';
}
	//simulate saved condition to force the static display of data
	$saveok=true;

require($root_path."include/inc_products_search_result_mod.php");


?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','right') ?>></a>


<?php if(!$sure)

echo'
	<form action="'.$thisfile.'" method="get" name=delform>
 <input type="hidden" name="sure" value="1">
 <input type="hidden" name="sid" value="'.$sid.'">
 <input type="hidden" name="lang" value="'.$lang.'">
 <input type="hidden" name="mode" value="delete">
 <input type="hidden" name="cat" value="'.$cat.'">
 <input type="hidden" name="userck" value="'.$userck.'">
 <input type="hidden" name="keyword" value="'.$keyword.'">
 <input type="hidden" name="keytype" value="'.$keytype.'">
  <input type="submit" value="'.$LDYesDelete.'">
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
</td></tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
