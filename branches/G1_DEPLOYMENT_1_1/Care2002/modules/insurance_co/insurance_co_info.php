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
define('LANG_FILE','finance.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_insurance.php');
$ins_obj=new Insurance;

switch($retpath)
{
	case 'list': $breakfile='insurance_co_list.php'.URL_APPEND; break;
	case 'search': $breakfile='insurance_co_search.php'.URL_APPEND; break;
	default: $breakfile='insurance_co_manage.php'.URL_APPEND; 
}

if(isset($firm_id)&&$firm_id&&($row=$ins_obj->getFirmInfo($firm_id))){
	$firm=$row->FetchRow();
	$edit=true;
}else{
	// Redirect to search function
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDInsuranceCo :: $LDData" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('insurance_info.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
 	echo $LDFirmInfoSaved;
?>
</b></font>
<?php 
} 
?>
<table border=0 cellpadding=4 >
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDInsuranceCoID ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['firm_id'] ?><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDInsuranceCoName ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['name'] ?><br></td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000></font><?php echo $LDAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo nl2br($firm['addr']); ?></td>
  </tr>
   <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDMailingAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo nl2br($firm['addr_mail']); ?></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"></font><?php echo $LDBillingAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo nl2br($firm['addr_billing']); ?></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDEmailAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><a href="mailto:<?php echo $firm['addr_email']; ?>"><?php echo $firm['addr_email'] ?></a><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDMainPhoneNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['phone_main'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDAuxPhoneNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['phone_aux'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDMainFaxNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['fax_main'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDAuxFaxNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['fax_aux'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPerson ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['contact_person'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPersonEmailAddr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><a href="mailto:<?php echo $firm['contact_email']; ?>"><?php echo $firm['contact_email'] ?></a><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPersonPhoneNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['contact_phone'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPersonFaxNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm['contact_fax'] ?><br></td>
  </tr>
  <tr>
    <td class=pblock><a href="insurance_co_update.php<?php echo URL_APPEND.'&retpath='.$retpath.'&firm_id='.$firm['firm_id']; ?>"><img <?php echo createLDImgSrc($root_path,'update.gif','0') ?> border="0"></a></td>
    <td class=pblock  align=right><a href="insurance_co_list.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'list_all.gif','0') ?> border="0"></a><a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<p>
<form action="insurance_co_new.php" method="post">
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
