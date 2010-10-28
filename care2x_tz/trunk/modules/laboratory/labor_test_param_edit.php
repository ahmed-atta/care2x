<?php
define('ROW_MAX',15); # define here the maximum number of rows for displaying the parameters

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org,
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');
$thisfile=basename(__FILE__);

//$db->debug=true;

# Create lab object
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab();

require($root_path.'include/inc_labor_param_group.php');



# Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');


if($mode=='save'){
	# Save the nr

	$_POST['modify_id']=$_SESSION['sess_user_name'];
	$_POST['history']=$lab_obj->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
	# Set to use the test params
	$lab_obj->useTestParams();
	# Point to the data array
	$saveparam = $_POST;
	$saveparam['price'] = $lab_obj->CheckNumber($saveparam['price']);

	// ****************************************************
	// Decide here if it is an update or an isert:
	if($saveparam['nr']!=0 && $saveparam['nr'])	{
			$action = $lab_obj->UpdateParams($saveparam);
	} else	{
			$action = $lab_obj->InsertParams();
	} // end of if($saveparam['nr']!=0 && $saveparam['nr'])
	// ****************************************************


	//echo $action;

	if($action){
?>

<script language="JavaScript">
<!-- Script Begin
window.opener.location.reload();
window.close();
//  Script End -->
</script>

<?php
		exit;
	}
	else echo $lab_obj->getLastQuery();
# end of if(mode==save)
}

$pnames=array($LDParameter,$LDMsrUnit,$LDMedian,$LDUpperBound,$LDLowerBound,$LDUpperCritical,$LDLowerCritical,$LDUpperToxic,$LDLowerToxic,$LDAdd_label,$LDis_enabled,"status");
$pitems=array('name','msr_unit','median','hi_bound','lo_bound','hi_critical','lo_critical','hi_toxic','lo_toxic','add_label','is_enabled','status');
# Get the test parameter values
if($tparam=&$lab_obj->getTestParam($nr)){
	$tp=$tparam->FetchRow();
	$ttest=&$lab_obj->TestGroupByID($tp['id']);
}else{
	$tp=false;
}
if($nr==0)
{
	$tp['name'] = $LDNewParam;
	$tp['group_id'] = $parameterselect;
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Laborwerte Eingabe</TITLE>

<script language="javascript" name="j1">
<!--
function editParam(nr)
{
	urlholder="labor_test_param_edit?sid=<?php echo "$sid&lang=$lang" ?>&nr="+nr;
	editparam_<?php echo $sid ?>=window.open(urlholder,"editparam_<?php echo $sid ?>","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a12_b{font-family:arial; font-size:12; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php

/*if($newid) echo ' onLoad="document.datain.test_date.focus();" ';*/
 if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; }
 ?>>

<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;
<?php
	echo $tp['name'];
 ?>
 </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right >
	<nobr>
	<a href="javascript:gethelp('lab_test_parameters.php','Laboratories :: Test Parameters')">
	<img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>
		<?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
	<a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>
	<?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
	</nobr></td>
</tr>
<tr align="center">
<td  bgcolor=#dde1ec colspan=2>

<FONT    SIZE=-1  FACE="Arial">


<table border=0 bgcolor=#ffdddd cellspacing=1 cellpadding=1 width="100%">
<tr>
<td  bgcolor=#ff0000 colspan=2><FONT SIZE=2  FACE="Verdana,Arial" color="#ffffff">
<b>
<?php echo $parametergruppe[$tp['group_id']]; ?>
</b>
</td>
</tr>
<tr>
<td  colspan=2>

<form action="<?php echo $thisfile; ?>" method="post" name="paramedit">

<table border="0" cellpadding=2 cellspacing=1>

<?php

$toggle=0;

if($tp){

	if($toggle) $bgc='#ffffee'; else $bgc='#efefef';
	$toggle=!$toggle;

	for($i=0;$i<sizeof($pitems);$i++){

		if($pitems[$i]=="add_label")
		{
			echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;Postive & Negative</td>
			<td bgcolor="'.$bgc.'"  class="a12_b">
			';
		}
		else
		{
			if($pnames[$i]!="status")
			{
				echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$pnames[$i].'</td>
				<td bgcolor="'.$bgc.'"  class="a12_b">
				';
			}
		}
			if($pitems[$i]=="add_label")
			{
				echo '<input type="radio" name="status" value="showPosNeg"';
				if($tp['status'] == 'showPosNeg') echo ' checked ';
				echo '>Show <input type="radio" name="status" value=""';
				if($tp['status'] == null) echo ' checked ';
				/*if($tp[$pitems[$i]]=="checkbox") echo ' checked ';
				echo '>Checkbox';
				echo '<input type="radio" name="add_type" value=""';*/

				//if(!trim($tp[$pitems[$i]]) || !$tp[$pitems[$i]]=="text" || !$tp[$pitems[$i]]=="radio") echo ' checked ';
				echo '>Hide';

			}
			elseif($pitems[$i]=="is_enabled")
			{
				echo '<input type="radio" name="is_enabled" value="1"';
				if($ttest['is_enabled']=="1") echo ' checked ';
				echo '>Show <input type="radio" name="is_enabled" value="0"';
				if($ttest['is_enabled']!="1") echo ' checked ';
				echo '>Hide';
			}
			elseif($pitems[$i]=="price")
			{
				//echo'	<input type="text" name="'.$pitems[$i].'" size=30 maxlength=30 value="'.$tp[$pitems[$i]].'"> '.$LDTSH;
			}
			else
			{
				if($pnames[$i]!="status")
				{
					echo'	<input type="text" name="'.$pitems[$i].'" size=30 maxlength=30 value="'.$tp[$pitems[$i]].'">';
				}
			}
			echo '&nbsp;
			</td></tr>
			';
	}


/*	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDParameter.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="name" size=15 maxlength=15 value="'.$tp['name'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMsrUnit.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="msr_unit" size=15 maxlength=15 value="'.$tp['msr_unit'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMedian.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="median" size=15 maxlength=15 value="'.$tp['median'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_bound" size=15 maxlength=15 value="'.$tp['hi_bound'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_bound" size=15 maxlength=15 value="'.$tp['lo_bound'].'">&nbsp;
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_critical" size=15 maxlength=15 value="'.$tp['hi_critical'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_critical" size=15 maxlength=15 value="'.$tp['lo_critical'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_toxic" size=15 maxlength=15 value="'.$tp['hi_toxic'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_toxic" size=15 maxlength=15 value="'.$tp['lo_toxic'].'">&nbsp;
			</td></tr>
			';
*/ }
?>
</table>
<input type=hidden name="add_label" value ="Positive">
<input type=hidden name="add_type" value ="radio">
<input type=hidden name="parameterselect" value="<?php echo $parameterselect; ?>">
<input type=hidden name="nr" value="<?php echo $nr; ?>">
<input type=hidden name="id" value="<?php echo $tp['id']; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="mode" value="save">
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>

</td>
</tr>
</table>
</form>
</FONT>
<p>
</td>
</tr>
</table>
</BODY>
</HTML>
