<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='search.php';
define('LANG_FILE','finance.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the insurance object 
require_once($root_path.'include/care_api_classes/class_insurance.php');
$ins_obj=new Insurance;

$breakfile='insurance_co_manage.php'.URL_APPEND;
$thisfile=basename(__FILE__);

# Initialize page's control variables
if($mode!='paginate'){
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
}else{
	$searchkey=$HTTP_SESSION_VARS['sess_searchkey']; # dummy search key to get past the search routine
}
# Set the sort parameters
if(empty($oitem)) $oitem='name';
if(empty($odir)) $odir='ASC';

# Get global configuration
$GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('pagin_insurance_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_insurance_search_max_block_rows'])) $GLOBAL_CONFIG['pagin_insurance_search_max_block_rows']=MAX_BLOCK_ROWS; # Last resort, use the default defined at the start of this page

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);
# Adjust the max nr of rows in a block
$pagen->setMaxCount($GLOBAL_CONFIG['pagin_insurance_search_max_block_rows']);

if(isset($mode)&&($mode=='search'||$mode=='paginate')&&!empty($searchkey)){

	# Convert wildcards 
	$searchkey=strtr($searchkey,'*?','%_');
	# Save the search keyword for eventual pagination routines
	if($mode=='search') $HTTP_SESSION_VARS['sess_searchkey']=$searchkey;
	
	# Search for the firms
	$firms=$ins_obj->searchLimitActiveFirm($searchkey,$GLOBAL_CONFIG['pagin_insurance_search_max_block_rows'],$pgx,$oitem,$odir);
	//echo $ins_obj->getLastQuery();
	# Get the resulting record count
	$linecount=$ins_obj->LastRecordCount();
	$pagen->setTotalBlockCount($linecount);
	# Count total available data
	if(isset($totalcount)&&$totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		$totalcount=$ins_obj->searchCountActiveFirm($searchkey);
		//echo $totalcount;
		//echo $ins_obj->getLastQuery();
		$pagen->setTotalDataCount($totalcount);
	}
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);
}
	
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

# Set color values for the search mask
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#abcdef';
$entry_body_bgcolor='#ffffff';
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

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus();document.searchform.searchkey.select()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDInsuranceCo :: $LDSearch" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('insurance_search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
 <FONT  SIZE=2  FACE="verdana,Arial">
&nbsp;
<br>
<!--  The search mask  -->
	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php 
	   		$searchprompt=$LDSearchPrompt;
	    	include($root_path.'include/inc_searchmask.php'); 
		?></td>
     </tr>
   </table>
<br>
<?php
if(is_object($firms)){
	if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 

?>
<table border=0 cellpadding=2 cellspacing=1>
  <tr>
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php echo $pagen->makeSortLink($LDFirmID,'firm_id',$oitem,$odir);  ?></b>
	</td>
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php echo $pagen->makeSortLink($LDInsuranceCoName,'name',$oitem,$odir);  ?></b>
	</td>
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php echo $pagen->makeSortLink($LDMainPhoneNr,'phone_main',$oitem,$odir);  ?></b>
	</td>
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php echo $pagen->makeSortLink($LDMainFaxNr,'fax_main',$oitem,$odir);  ?></b>
	</td>
      <td  class=pblock background="<?php echo $bgc ?>"><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php echo $pagen->makeSortLink($LDEmailAddress,'addr_email',$oitem,$odir);  ?></b>
	</td>
<!--     <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDFirmID ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDInsuranceCoName ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDMainPhoneNr ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDMainFaxNr ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDEmailAddress ?></b></td>
 --></td>
  </tr> 
<?php
	$toggle=0;
	while($firm=$firms->FetchRow()){
		if($toggle) $bgc='#dddddd';
			else $bgc='#efefef';
		$toggle=!$toggle;
?>
  <tr  bgcolor="<?php echo $bgc ?>">
    <td class=pblock><a href="insurance_co_info.php<?php echo URL_APPEND.'&retpath=search&firm_id='.$firm['firm_id']; ?>"><?php echo $firm['firm_id']; ?></a></td>
    <td class=pblock><a href="insurance_co_info.php<?php echo URL_APPEND.'&retpath=search&firm_id='.$firm['firm_id']; ?>"><?php echo $firm['name']; ?></a></td>
    <td class=pblock><?php echo $firm['phone_main']; ?></td>
    <td class=pblock><?php echo $firm['fax_main']; ?></td>
    <td class=pblock><?php if($firm['addr_email']){ echo '<img '.createComIcon($root_path,'email.gif','0').'>'; ?> <a href="mailto:<?php echo $firm['addr_email']; ?>"><?php echo $firm['addr_email']; ?></a><?php } ?></td>
</td>
  </tr> 
<?php
	}
	echo '
	<tr><td colspan=4><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious).'</td>
	<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext).'</td>
	</tr>';
?>
  </table>
<?php
}elseif($mode=='search'||$mode=='paginate'){
	echo str_replace('~nr~','0',$LDSearchFound); 
}
?>
<p>
</FONT>
<form action="insurance_co_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
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
