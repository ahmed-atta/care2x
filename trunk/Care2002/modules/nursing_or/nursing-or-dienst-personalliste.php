<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('or.php','departments.php');
define('LANG_FILE','doctors.php');
if($HTTP_SESSION_VARS['sess_user_origin']=='personell_admin'){
	$local_user='aufnahme_user';
	if(!isset($saved)||!$saved){
		$mode='search';
		$searchkey=$nr;
	}
	$breakfile=$root_path.'modules/personell_admin/personell_register_show.php'.URL_APPEND.'&target=personell_reg&personell_nr='.$nr;
}else{
	$local_user='ck_op_dienstplan_user';
	$breakfile=$root_path.$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND.'&dept_nr='.$dept_nr;
}
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

if(!isset($dept_nr)||!$dept_nr){
	header('Location:nursing-or-select-dept.php'.URL_REDIRECT_APPEND.'&target=plist&retpath='.$retpath);
	exit;
}


$filename=$root_path."global_conf/$lang/doctors_abt_list.pid";
if (file_exists($filename))
{
	$abtname=get_meta_tags($filename);
}	

$thisfile=basename(__FILE__);

/************** resolve dept only *********************************/
require($root_path.'include/inc_resolve_dept_dept.php');


/* Load the department list with oncall doctors */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
$dept_list=&$dept_obj->getAllMedical();
/* Load the dept doctors */
require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$nurses=&$pers_obj->getNursesOfDept($dept_nr);
/* Load global values */
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('personell_%');

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

switch($ipath)
{
	case 'menu': $rettarget=$root_path.'main/op-doku.php'.URL_APPEND; break;
	case 'qview': $rettarget="nursing-or-dienst-schnellsicht.php".URL_APPEND."&hilitedept=$dept_nr"; break;
	case 'plan': $rettarget="nursing-or-dienstplan-planen.php".URL_APPEND."&dept_nr=$dept_nr&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; break;
	default: $rettarget="javascript:window.history.back()";
}

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
	/* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
	// get orig data
	switch($mode)
	{
		case 'search':
			$search_result=&$pers_obj->searchPersonellBasicInfo($searchkey);
		break;
	}
}
  else { echo "$LDDbNoLink<br>"; } 

/* Load the common icons */
$img_options_contact=createComIcon($root_path,'violet_phone.gif','0');
$img_options_delete=createComIcon($root_path,'delete2.gif','0');

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}

div.a3 {font-family: arial; font-size: 14; margin-left: 3; margin-right:3; }
.v12 {font-family: verdana; font-size: 12; }
.v12_n {font-family: verdana; font-size: 12; color:#0000cc }

.infolayer {
	position:absolute;
	visibility: hide;
	left: 100;
	top: 10;

}

</style>
<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,d){
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");
}
function deleteItem(nr){
	if(confirm('<?php echo $LDSureToDeleteEntry; ?>')){
		window.location.replace("nursing-or-list-add.php<?php echo URL_REDIRECT_APPEND; ?>&item_nr="+nr+"&dept_nr=<?php echo $dept_nr.'&mode=delete&retpath='.$retpath; ?>");
	}
}
-->
</script>
<script language="javascript">
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<?php require($root_path.'include/inc_js_gethelp.php'); ?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onLoad="document.searchform.searchkey.focus()" >

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG><?php echo $LDNursesList ?> <font color="<?php echo $cfg['top_txtcolor']; ?>">::
<?php 
$buf=$dept_obj->LDvar();
if(isset($$buf)&&!empty($$buf)) echo strtoupper($$buf);
	else echo strtoupper($dept_obj->FormalName()); 
?></font>
</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="<?php echo $breakfile; ?>"><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a><a href="javascript:gethelp('op_duty.php','personlist','<?php echo $rows ?>')"><img 
<?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>></a><a href="<?php echo $rettarget ?>"><img 
<?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a></td>
</tr>
<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p>
<ul>
<p><br>
<font face="arial,verdana,helvetica" size=2>
<?php
if(is_object($nurses)&&$nurses->RecordCount()){
?>
<table border=0  bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
  <tr>
    <td>
	
	<table border=0  cellspacing=1>
  	<tr bgcolor="#cfcfcf" >
    <td  align=center class="v13" colspan=3><nobr>&nbsp;<?php echo $LDFamilyName; ?></nobr></td>
    <td  align=center class="v13" colspan=2><font color="#006600"><nobr>&nbsp;<?php echo $LDGivenName; ?></nobr></td>
    <td  align=center  class="v13" colspan=2><font color="#ff0000"><nobr>&nbsp;<?php echo $LDDateOfBirth; ?></nobr></td>
    <td  align=center  class="v13" colspan=2><nobr>&nbsp;<?php echo $LDFunction; ?></nobr></td>
    <td  align=center  class="v13" colspan=2><nobr>&nbsp;<?php echo $LDMoreInfo; ?></nobr></td>
    <td  align=center  class="v13" colspan=2><nobr>&nbsp;</nobr></td>
  	</tr>
	
	<?php 
		while($row=$nurses->FetchRow()){
	?>
  	<tr bgcolor="#ffffff">
    <td  class="v13" colspan=3><nobr>&nbsp;<?php echo $row['name_last']; ?></nobr></td>
    <td  class="v13" colspan=2><nobr><font color="#006600">&nbsp;<?php echo $row['name_first']; ?></nobr></td>
    <td  class="v13" colspan=2><font color="#ff0000">&nbsp;<?php echo formatDate2Local($row['date_birth'],$date_format); ?></td>
    <td  class="v13" colspan=2><nobr>&nbsp;<?php echo $row['job_function_title']; ?></nobr></td>
    <td  class="v13" colspan=2>&nbsp;<?php echo '
						<font face=arial size=2>&nbsp;
							<a href="javascript:popinfo(\''.$row['personell_nr'].'\',\''.$dept_nr.'\')" title="'.$LDContactInfo.'">
							<img '.$img_options_contact.' alt="'.$LDShowData.'"></a>&nbsp;';	 ?></td>
	<td><a href="javascript:deleteItem('<?php echo $row['nr']; ?>')" title="<?php echo $LDDelete; ?>">
							<img <?php echo $img_options_delete.' alt="'.$LDDelete.'"'; ?>></a>&nbsp</td>  	
							
							
	</tr>
	
	<?php
	}
	?>
	
  	</table>
  
  </td>
  </tr>
</table>
<?php
}else{
 echo '
 	<table border=0>
    <tr>
      <td><img '.createMascot($root_path,'mascot1_r.gif','0','left').'  ></td>
      <td><font face="verdana,arial" size=3><b>'.$LDNoPersonList.'</b></td>
    </tr>
  </table>';
}
?>
<hr>
<font face="arial,verdana,helvetica" size=3 color="#990000"><b><?php echo $LDAddNurseToList; ?></b></font>
	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php

            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
		</td>
    </tr>
   </table>
<?php
if($mode=='search'){
	if(!$pers_obj->record_count) $pers_obj->record_count=0;
	echo '<p>'.str_replace("~nr~",$pers_obj->record_count,$LDSearchFound).'<p>';
		  
	if ($pers_obj->record_count) { 

	/* Load the common icons */
	$img_options_add=createComIcon($root_path,'add.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDPersonellNr; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDFamilyName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDGivenName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDDateOfBirth; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDFunction; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDAdd; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDMoreInfo; ?></td>

<?php
/*				for($i=0;$i<sizeof($fieldname);$i++) {
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}*/					
					echo"</tr>";

					while($row=$search_result->FetchRow())
					{
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
                        echo '&nbsp;'.($row['nr']+$GLOBAL_CONFIG['personell_nr_adder']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($row['date_birth'],$date_format);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['job_function_title']);
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href=nursing-or-list-add.php'.URL_APPEND.'&nr='.$row['nr'].'&dept_nr='.$dept_nr.'&mode=save&retpath='.$retpath.'" title="'.$LDAddNurseToList.'">
							<img '.$img_options_add.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td>';
						echo '
						<td><font face=arial size=2>&nbsp;
							<a href="javascript:popinfo(\''.$row['nr'].'\',\''.$dept_nr.'\')" title="'.$LDContactInfo.'">
							<img '.$img_options_contact.' alt="'.$LDShowData.'"></a>&nbsp;</td>';						
						echo '</tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
					    /* Set the appending nr for the searchform */
					    $searchform_count=2;
					?>
			<p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
</td>
     </tr>
   </table>
					<?php
					}
	}
}
?>
<hr>
<form action=<?php echo $thisfile ?> name="deptform">
<?php echo $LDChgDept ?>
<select name="dept_nr" >
<?php
while(list($x,$v)=each($dept_list))
	{
		echo '
		<option value="'.$v['nr'].'" ';
		if($dept_nr==$v['nr']) echo 'selected';
		echo '>';
		if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
			else echo $v['name_formal'];
		echo '</option>';
	}?>
</select>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="submit" value="<?php echo $LDChange ?>">
</form>
<p>
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>
</ul>
</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
