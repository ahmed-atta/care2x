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
define('LANG_FILE','lab.php');
/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  if($target=='radio') $breakfile=$root_path.'modules/radiology/radiolog.php'.URL_APPEND;
   else $breakfile=$root_path.'modules/laboratory/labor.php'.URL_APPEND;
}
else
{
  $local_user='ck_pflege_user';
  $breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND.'&pn='.$pn.'&station='.$station.'&edit='.$edit.'&user_origin='.$user_origin;
}

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$thisfile='labor_test_request_aftersave.php';

$db_request_table=$target;

 /* Check for the patietn number = $pn. If available get the patients data, */
if(isset($pn)&&$pn) {	
    include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	
	if($enc_obj->loadEncounterData($pn)){
		$edit=true;
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('patient_%');	
		switch ($enc_obj->EncounterClass())
		{
		    case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
			case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
			default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		}						
		$HTTP_SESSION_VARS['sess_en']=$pn;	
		$HTTP_SESSION_VARS['sess_full_en']=$full_en;	
	}	
}

/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	

     require_once($root_path.'include/inc_date_format_functions.php');
     
	   
	 if(!isset($mode))   $mode='';
  
	   
			if($enc_obj->is_loaded) 
					{

		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
								  if($target=='baclabor')
								  {
								  	  parse_str($stored_request['material'],$stored_material);
							          parse_str($stored_request['test_type'],$stored_test_type);
								   }
								   elseif($target=='chemlabor')
								   {
								       if($stored_request['parameters']!='') parse_str($stored_request['parameters'],$stored_param);
								   }							   					      
							   $read_form=1;
							   $printmode=1;
							}
			             }
						else
					     {
						     echo "<p>$sql<p>$LDDbNoRead"; 
						  }					
				}   
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }
		
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
if($dept_obj->preloadDept($stored_request['testing_dept'])){
	$buffer=$dept_obj->LDvar();
	if(isset($$buffer)&&!empty($$buffer)) $formtitle=$$buffer;
		else $formtitle=$dept_obj->FormalName();
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}

<?php if($target=='baclabor') 
{
?>
.lab {font-family: arial; font-size: 9; color:#ee6666;}
<?php 
}
else
{
?>
.lab {font-family: arial; font-size: 9; color:purple;}
<?php
}
?>

.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 
function printOut()
{
	urlholder="labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}
// -->
</script>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>  
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>
 

<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo $LDTestRequest ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('request_aftersave.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br><ul>
<p>


<table border=0>
  <tr valign="top">
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><FONT    SIZE=4  FACE="verdana,Arial" color="#990000">
	<?php 
	    if($status=="draft") echo $LDFormSaved[$saved]; else echo $LDRequestSent[$saved]; 
		echo $LDWhatToDo;
	?><p>
<FONT    SIZE=2  FACE="verdana,Arial" color="#990000">
           <a href="javascript:printOut()"><img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDPrintForm ?></a><br>
<!-- COMMENTATO DA NOI PERCHE CREA I DUE LINK CHE NN SERVONO-->
<!--
           <a href="<?php echo $root_path ?>modules/nursing/nursing-station-patientdaten-doconsil-<?php echo $target ?>.php<?php echo URL_APPEND ?>&pn=<?php echo $pn ?>&edit=<?php echo $edit ?>&station=<?php echo $station ?>&target=<?php echo $target ?>&dept_nr=<?php echo $dept_nr ?>&user_origin=<?php echo $user_origin ?>&noresize=<?php echo $noresize ?>&mode=edit&batch_nr=<?php echo $batch_nr ?>"><img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDEditForm ?></a><br>
	       <a href="<?php echo $root_path ?>modules/nursing/nursing-station-patientdaten-doconsil-<?php echo $target ?>.php<?php echo URL_APPEND ?>&pn=<?php echo $pn ?>&edit=<?php echo $edit ?>&station=<?php echo $station ?>&target=<?php echo $target ?>&dept_nr=<?php echo $dept_nr ?>&user_origin=<?php echo $user_origin ?>&noresize=<?php echo $noresize ?>&mode="><img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDNewFormSamePatient ?></a><br>
           <?php
		   if($user_origin=='lab')
		   {
		   ?>
		   <a href="<?php echo $root_path ?>modules/nursing/nursing-station-patientdaten-doconsil-<?php echo $target ?>.php<?php echo URL_APPEND ?>&edit=0&station=<?php echo $station ?>&target=<?php echo $target ?>&dept_nr=<?php echo $dept_nr ?>&user_origin=<?php echo $user_origin ?>&noresize=<?php echo $noresize ?>"><img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDNewFormOtherPatient ?></a><br>
-->    
       <?php
		   }
		   ?>
           <a href="<?php echo $breakfile ?>"><img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>> <?php echo $LDEndTestRequest ?></a><p>
        </td>
  </tr>
</table>



<?php
/* The main background color of the form */
switch($target)
{ 
  case 'generic':         $bgc1='#bbdbc4'; break;
  case 'patho':         $bgc1='#cde1ec'; break;
  case 'radio':          $bgc1='#ffffff'; break;
  case 'blood':          $bgc1='#99ffcc'; break;
  case 'baclabor':          $bgc1='#fff3f3'; break;
  case 'chemlabor':   $bgc1='#fff3f3';
                               if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_chemlabor.php'))
							   {
							      include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_chemlabor.php');
							    }
								else
								{ 
								   include_once($root_path.'language/en/lang_en_konsil_chemlabor.php');
								}
                               break;
  default:  $bgc1='#ffffff'; break; 
}
/*$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$formtitle=$abtname[$target];
*/
require_once($root_path.'include/inc_test_request_printout_fx.php');

if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil.php')){  
   include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil.php');
}else{  
   include_once($root_path.'language/en/lang_en_konsil.php');
}
/* Load the form for printing out */
$edit=0;
if($target=='baclabor') include($root_path.'include/inc_test_findings_form_baclabor.php');
 else include($root_path.'include/inc_test_request_printout_'.$target.'.php');
?>  
</ul>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
