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
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "address_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='search.php';
define('LANG_FILE','place.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_address.php');
$address_obj=new Address;

$breakfile='address_manage.php'.URL_APPEND;
$thisfile=basename(__FILE__);

# Initialize page's control variables
if($mode!='paginate'){
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	# Set the sort parameters
	if(empty($oitem)) $oitem='name';
	if(empty($odir)) $odir='ASC';
}

$GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('address_list_max_block_rows');
if(empty($GLOBAL_CONFIG['address_list_max_block_rows'])) $GLOBAL_CONFIG['address_list_max_block_rows']=MAX_BLOCK_ROWS; # Last resort, use the default defined at the start of this page

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);
# Adjust the max nr of rows in a block
$pagen->setMaxCount($GLOBAL_CONFIG['address_list_max_block_rows']);

# Get all the active firms info
//$address=$address_obj->getAllActiveCityTown();
$address=&$address_obj->getLimitActiveCityTown($GLOBAL_CONFIG['address_list_max_block_rows'],$pgx,$oitem,$odir);
# Get the resulting record count
//echo $address_obj->getLastQuery();
$linecount=$address_obj->LastRecordCount();
$pagen->setTotalBlockCount($linecount);
# Count total available data
if(isset($totalcount)&&$totalcount){
	$pagen->setTotalDataCount($totalcount);
}else{
	$totalcount=$address_obj->countAllActiveCityTown();
	$pagen->setTotalDataCount($totalcount);
}

$pagen->setSortItem($oitem);
$pagen->setSortDirection($odir);
	
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDAddress :: $LDListAll" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('address_list.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
 <FONT  SIZE=2  FACE="verdana,Arial">
 &nbsp;
 <br>
<?php 
if(is_object($address)){
	
	if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 


?>
<table border=0 cellpadding=2 cellspacing=1>
  <tr>
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
	  	if($oitem=='name') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDCityTownName,'name',$odir,$flag); 
			 ?></b>
	</td>

      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
	  	if($oitem=='iso_country_id') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDISOCountryCode,'iso_country_id',$odir,$flag); 
			 ?></b>
	</td>
	
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
	  	if($oitem=='unece_locode_type') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDUNECELocalCode,'unece_locode_type',$odir,$flag); 
			 ?></b>
	</td>

      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
	  	if($oitem=='info_url') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDWebsiteURL,'info_url',$odir,$flag); 
			 ?></b>
	</td>

  </tr> 
<?php
	$toggle=0;
	while($addr=$address->FetchRow()){
		if($toggle) $bgc='#dddddd';
			else $bgc='#efefef';
		$toggle=!$toggle;
?>
  <tr  bgcolor="<?php echo $bgc ?>">
    <td class=pblock><a href="citytown_info.php<?php echo URL_APPEND.'&retpath=list&nr='.$addr['nr']; ?>"><?php echo $addr['name']; ?></a></td>
    <td class=pblock><?php echo $addr['iso_country_id']; ?></td>
    <td class=pblock><?php echo $addr['unece_locode']; ?></td>
    <td class=pblock><a href="<?php echo $addr['info_url']; ?>"><?php echo $addr['info_url']; ?></a></td>
</td>
  </tr> 
<?php
	}
	echo '
	<tr><td colspan=3><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious).'</td>
	<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext).'</td>
	</tr>';
?>
  </table>
<?php
}
?>
<p>
</FONT>
<form action="citytown_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="retpath" value="list">
<input type="submit" value="<?php echo $LDNeedEmptyFormPls ?>">
</form>
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
