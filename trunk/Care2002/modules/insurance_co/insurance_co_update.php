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
define('LANG_FILE','finance.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
/* Load the insurance object */
require_once($root_path.'include/care_api_classes/class_insurance.php');
$ins_obj=new Insurance;

switch($retpath)
{
	case 'list': $breakfile='insurance_co_list.php'.URL_APPEND; break;
	case 'search': $breakfile='insurance_co_search.php'.URL_APPEND; break;
	default: $breakfile='insurance_co_manage.php'.URL_APPEND; 
}

if(isset($firm_id)&&$firm_id){
	if(isset($mode)&&$mode=='update'){
		if($ins_obj->updateFirmInfoFromArray($firm_id,$HTTP_POST_VARS)){
    		header("location:insurance_co_info.php?sid=$sid&lang=$lang&firm_id=$firm_id&mode=show&save_ok=1&retpath=$retpath");
			exit;
		}else{
			echo $ins_obj->getLastQuery();
			$mode='bad_data';
		}	
	}elseif($row=$ins_obj->getFirmInfo($firm_id)){
		if(is_object($row)){
			$firm=$row->FetchRow();
			/* Globalize the array values */
			extract($firm);
		}
	}
}else{
	// Redirect to search function
}
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
function check(d)
{
	if((d.name.value=="")){
		alert("<?php echo "$LDAlertFirmName \\n $LDPlsEnterInfo"; ?>");
		d.name.select();
		return false;
	}else if((d.addr_mail.value=="")){
		alert("<?php echo "$LDAlertMailingAddress \\n $LDPlsEnterInfo"; ?>");
		d.addr_mail.select();
		return false;
	}else if((d.addr_billing.value=="")){
		alert("<?php echo "$LDAlertBillingAddress \\n $LDPlsEnterInfo"; ?>");
		d.addr_billing.select();
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDInsuranceCo :: $LDUpdateData" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','new')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
			echo "$LDDataNoSave<br>$LDPlsCheckData";
			break;
		}
		case 'firm_exists':
		{
			echo "$LDFirmExists<br>$LDDataNoSave<br>$LDPlsChangeFirmID";
		}
		default:
		{
			echo "$LDDataNoSave<br>$LDPlsCheckData";
			break;
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
<form action="<?php echo $thisfile; ?>" method="post" name="insurance_co" onSubmit="return check(this)">
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<table border=0>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDInsuranceCoID ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><?php echo $firm_id ?><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDInsuranceCoName ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="name" size=50 maxlength=60 value="<?php echo $name ?>"><br></td>
  </tr> 
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000></font><?php echo $LDAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><textarea name="addr" cols=40 rows=4 wrap="physical"><?php echo $addr ?></textarea></td>
  </tr>
   <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDMailingAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><textarea name="addr_mail" cols=40 rows=4 wrap="physical"><?php echo $addr_mail ?></textarea></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><font color=#ff0000><b>*</b></font><?php echo $LDBillingAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><textarea name="addr_billing" cols=40 rows=4 wrap="physical"><?php echo $addr_billing ?></textarea></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDEmailAddress ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="addr_email" size=50 maxlength=60 value="<?php echo $addr_email ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDMainPhoneNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="phone_main" size=50 maxlength=60 value="<?php echo $phone_main ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDAuxPhoneNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="phone_aux" size=50 maxlength=60 value="<?php echo $phone_aux ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDMainFaxNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="fax_main" size=50 maxlength=60 value="<?php echo $fax_main ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDAuxFaxNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="fax_aux" size=50 maxlength=60 value="<?php echo $fax_aux ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPerson ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="contact_person" size=50 maxlength=60 value="<?php echo $contact_person ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPersonEmailAddr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="contact_email" size=50 maxlength=60 value="<?php echo $contact_email ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPersonPhoneNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="contact_phone" size=50 maxlength=60 value="<?php echo $contact_phone ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock align=right background="<?php echo $bgc ?>"><?php echo $LDContactPersonFaxNr ?>: </td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" ><input type="text" name="contact_fax" size=50 maxlength=60 value="<?php echo $contact_fax ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></td>
    <td class=pblock  align=right><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="firm_id" value="<?php echo $firm_id ?>">
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
