<?php

define('ROW_MAX',15); # define here the maximum number of rows for displaying the parameters

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

# Create lab object
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab();

require($root_path.'include/inc_labor_param_group.php');
						
if(!isset($parameterselect)||$parameterselect=='') $parameterselect='priority';

$parameters=$paralistarray[$parameterselect];					
$paramname=$parametergruppe[$parameterselect];

$pitems=array('msr_unit','median','lo_bound','hi_bound','lo_critical','hi_critical','lo_toxic','hi_toxic');

# Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');
    
	//echo $lab_obj->getLastQuery();
			
	# Get the test test groups
	$tgroups=&$lab_obj->TestGroups();
	# Get the test parameter values
	$tparams=&$lab_obj->TestParams($parameterselect);

	$breakfile="labor.php".URL_APPEND;

// echo "from table ".$linecount;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Laborwerte Eingabe</TITLE>

<script language="javascript" name="j1">
<!--        
function chkselect(d)
{
 	if(d.parameterselect.value=="<?php echo $parameterselect ?>"){
		return false;
	}
}

function editParam(nr)
{
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_param_edit.php?sid=<?php echo "$sid&lang=$lang" ?>&nr="+nr;
	editparam_<?php echo $sid ?>=window.open(urlholder,"editparam_<?php echo $sid ?>","width=500,height=400,menubar=no,resizable=yes,scrollbars=yes");
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php  echo $LDTestParameters; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_param_config.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td  bgcolor=#dde1ec colspan=2>

<FONT    SIZE=-1  FACE="Arial">


<table border=0 bgcolor=#ffdddd cellspacing=1 cellpadding=1 width="100%">
<tr>
<td  bgcolor=#ff0000 colspan=2><FONT SIZE=2  FACE="Verdana,Arial" color="#ffffff">
<b><?php echo $parametergruppe[$parameterselect]; ?></b>
</td>
</tr>
<tr>
<td  colspan=2>


<table border="0" cellpadding=2 cellspacing=1>

<tr>
<td class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDParameter ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDMsrUnit ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDMedian ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDLowerBound ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDUpperBound ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDLowerCritical ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDUpperCritical ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDLowerToxic ?></td>
<td  class="a12_b" bgcolor="#fefefe">&nbsp;<?php echo $LDUpperToxic ?></td>
<td  bgcolor="#fefefe">&nbsp;</td>

</tr>
	
<?php 
	
$toggle=0;
if(is_object($tparams)){
while($tp=$tparams->FetchRow()){
	echo '
	<tr>';

	if($toggle) $bgc='#ffffee'; else $bgc='#efefef';
	$toggle=!$toggle;
	
	echo '<td bgcolor="'.$bgc.'" class="a12_b"><nobr>&nbsp;';
	if(isset($parameters[$tp['id']])&&!empty($parameters[$tp['id']])) echo $parameters[$tp['id']];
		else echo $tp['name'];
	
	echo '&nbsp;</nobr></td>';

	while(list($x,$v)=each($pitems)){
		echo '
			<td bgcolor="'.$bgc.'"  class="a12_b">';
		if($x){
			if($tp[$v]>0) echo $tp[$v];
		}else{
			echo $tp[$v];
		}
		echo '&nbsp;
			</td>';
	}
	reset($pitems);
	
	echo '
			<td bgcolor="'.$bgc.'"  class="a12_b">
			<a href="javascript:editParam('.$tp['nr'].')"><img '.createLDImgSrc($root_path,'edit_sm.gif','0').'></a>
			</td>';
	echo '
		</tr>';
 }
 }
?>
</table>
</td>
</tr>

</table>


<form action=<?php echo $thisfile; ?> method=post onSubmit="return chkselect(this)" name="paramselect">
<table border=0>
<tr>
<td colspan=3><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDSelectParamGroup ?></b>
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDParamGroup ?>:
</td>

<td >
<select name="parameterselect" size=1>
<?php 

	while($tg=$tgroups->FetchRow())
      {
		echo '<option value="'.$tg['group_id'].'"';
		if($parameterselect==$tg['group_id']) echo ' selected';
		echo '>';
		if(isset($parametergruppe[$tg['group_id']])&&!empty($parametergruppe[$tg['group_id']])) echo $parametergruppe[$tg['group_id']];
			else echo $tg['name'];
		echo '</option>';
		echo "\n";
	  }	

?>
</select>
</td>

<td>
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<FONT SIZE=-1  FACE="Arial">&nbsp;<input  type="image" <?php echo createLDImgSrc($root_path,'auswahl2.gif','0') ?>>
</td>
</tr>
</tr>

</table>

</form>

</FONT>
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
