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

$thisfile="products-datenbank-functions-datadelete.php";
switch($cat)
{
	case "pharma":
							$title=$LDPharmacy;
							$dbtable="care_pharma_products_main";
							$imgpath="../pharma/img/";
							$breakfile="apotheke-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$dbtable="care_med_products_main";
							$imgpath="../med_depot/img/";
							$breakfile="medlager-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

if(($mode=='delete')&&($sure)&&($keyword!='')&&($keytype!="")) 
{

$deleteok=false;


//init db parameters
/* Establish db connection */
require('../include/inc_db_makelink.php');
 	if($link&&$DBLink_OK) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' WHERE  '.$keytype.'="'.$keyword.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					header ("location:products-datenbank-functions-manage.php?sid=$sid&lang=$lang&from=deleteok&cat=$cat&userck=$userck");
					$deleteok=true;
				}
			echo $sql;
		}
  		 else { echo "$LDDbNoLink<br>"; } 
}

	//simulate update to search the keyword
	$update=true;
 	require("../include/inc_products_search_mod.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> <?php echo $title ?> - Verwalten </TITLE>

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

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$LDPharmacy $LDPharmaDb $LDManage" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products_db.php','delete','<?php echo $from ?>','<?php echo $cat ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
       <td><img '.createMascot('../','mascot1_r.gif','0','middle').'></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDConfirmDelete.'</font><br>
		<font size=2>'.$LDAlertDelete.'</font><p>
		<a href="products-datenbank-functions-manage.php?sid='.$sid.'&lang='.$lang.'&keyword='.$keyword.'&userck='.$userck.'&cat='.$cat.'&mode=search"><b><font color="#ff0000"><< '.$LDNoBack.'</font></b></a></td>
     </tr>
   </table>	';
}
else
{
	if(!$deleteok) echo'
			<img '.createMascot('../','mascot1_r.gif','0','middle').'><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDNoDelete.'</font><p>';
}
	//simulate saved condition to force the static display of data
	$saveok=true;

require("../include/inc_products_search_result_mod.php");


?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0','right') ?>></a>


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
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
