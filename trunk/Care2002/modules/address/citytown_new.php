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
	default: $breakfile='address_manage.php'.URL_APPEND; 
}

if(!isset($mode)){
	$mode='';
	$edit=true;		
}else{
	switch($mode)
	{
		case 'save':
		{
			# Validate important data
			$HTTP_POST_VARS['name']=trim($HTTP_POST_VARS['name']);
			if(!empty($HTTP_POST_VARS['name'])){
				# Check if address exists
				if($address_obj->CityTownExists($HTTP_POST_VARS['name'],$HTTP_POST_VARS['iso_country_id'])){
					# Do notification 
					$mode='citytown_exists';
				}else{
					if($address_obj->saveCityTownInfoFromArray($HTTP_POST_VARS)){
						# Get the last insert ID
						$insid=$db->Insert_ID();
						# Resolve the ID to the primary key
						$nr=$address_obj->LastInsertPK('nr',$insid);

    					header("location:citytown_info.php?sid=$sid&lang=$lang&nr=$nr&mode=show&save_ok=1&retpath=$retpath");
						exit;
					}else{echo "$sql<br>$LDDbNoSave";}
				}
			}else{
					$mode='bad_data';
			}
			break;
		}
	} // end of switch($mode)
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
function check(d)
{
	if((d.name.value=="")){
		alert("<?php echo "$LDAlertNoCityTownName \\n $LDPlsEnterInfo"; ?>");
		d.name.focus();
		return false;
	}else{
		return true;
	}
}
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDAddress :: $LDNewCityTown" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('address_new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php
if(!empty($mode)){ 
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?>></td>
    <td valign="bottom"><br><font face="Verdana, Arial" size=3 color="#880000"><b>
<?php 
	switch($mode)
	{
		case 'bad_data':
		{
			echo $LDAlertNoCityTownName;
			break;
		}
		case 'citytown_exists':
		{
			echo "$LDCityTownExists<br>$LDDataNoSave";
		}
	}
?>
	</b></font><p>
</td>
  </tr>
</table>
<?php 
} 
?>
&nbsp;<br>

<form action="<?php echo $thisfile; ?>" method="post" name="citytown" onSubmit="return check(this)">
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<table border=0>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDCityTownName ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="name" size=50 maxlength=60 value="<?php echo $name ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDISOCountryCode ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="iso_country_id" size=50 maxlength=3 value="<?php echo $iso_country_id ?>"><br></td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECELocalCode ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="unece_locode" size=50 maxlength=60 value="<?php echo $unece_locode ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECEModifier ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="unece_modifier" size=50 maxlength=60 value="<?php echo $unece_modifier ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECELocalCodeType ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="unece_locode_type" size=50 maxlength=60 value="<?php echo $unece_locode_type ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDUNECECoordinates ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="unece_coordinates" size=50 maxlength=60 value="<?php echo $unece_coordinates ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDWebsiteURL ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="info_url" size=50 maxlength=60 value="<?php echo $info_url ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></td>
    <td class=pblock  align=right><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
</form>
<p>

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
