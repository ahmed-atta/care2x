<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','place.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_address.php');
$address_obj=new Address;

switch($retpath)
{
	case 'list': $breakfile='citytown_list.php'.URL_APPEND; break;
	case 'search': $breakfile='citytown_search.php'.URL_APPEND; break;
	default: $breakfile='citytown_manage.php'.URL_APPEND; 
}

if(isset($nr)&&$nr&&($row=&$address_obj->getCityTownInfo($nr))){
	$address=$row->FetchRow();
	$edit=true;
}else{
	# Redirect to search function
}

$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDCityTown :: $LDData" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('address_info.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php
if(isset($save_ok)&&$save_ok){ 
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>><font face="Verdana, Arial" size=3 color="#880000">
<b>
<?php 
 	echo $LDAddressInfoSaved;
?>
</b></font>
<?php 
} 
?>
<table border=0 cellpadding=4 >
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDCityTownName ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $address['name'] ?><br></td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000></font><?php echo $LDISOCountryCode ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $address['iso_country_id']; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDWebsiteURL ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><a href="<?php echo $address['info_url']; ?>"><?php echo nl2br($address['info_url']); ?></a></td>
  </tr>
   <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDUNECELocalCode ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $address['unece_locode']; ?></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECEModifier ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $address['unece_modifier']; ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECELocalCodeType ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php if($address['unece_locode_type']) echo $address['unece_locode_type'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECECoordinates ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php if($address['unece_coordinates']) echo $address['unece_coordinates'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock><a href="citytown_update.php<?php echo URL_APPEND.'&retpath='.$retpath.'&nr='.$address['nr']; ?>"><img <?php echo createLDImgSrc($root_path,'update.gif','0') ?>></a></td>
    <td class=pblock  align=right><a href="citytown_list.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'list_all.gif','0') ?>></a> <a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a></td>
  </tr>
</table>
<p>
<form action="citytown_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="submit" value="<?php echo $LDNeedEmptyFormPls ?>">
</form>
</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
