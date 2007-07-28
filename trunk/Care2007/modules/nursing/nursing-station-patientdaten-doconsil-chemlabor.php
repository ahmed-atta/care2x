<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

/**
* Funtion prepareTestElemenst() will process the POST vars containg the test elements
* and other variables: sampling day & sampling time
* return: 1= if  test element(s) set, (paramlist is not empty), 
* return: 0 = if no test element set, (paramlist empty)
*/
function prepareTestElements()
{
    global $HTTP_POST_VARS, $paramlist, $sday, $sample_time;
	
	/* Prepare the parameters 
	*  Check the first char of the POST_VARS. Concatenate all POST vars with
	*  the content having "_" as the first character , then save it to  "parameters"
	*/
	$paramlist='';
					   
	while(list($x,$v)=each($HTTP_POST_VARS)){
    	if((substr($x,0,1)=='_')&&($HTTP_POST_VARS[$x]==1)){
	    	if($paramlist==''){
				$paramlist=$x.'=1';
			}else{
				$paramlist.='&'.$x.'=1';
			}
		}
	}
								
	/* If the paramlist is not empty then the user had set a test parameter,
	*  go ahead and prepare the other data for saving
	*  otherwise, the user sent a form without setting any test parameter.
	*  In such a case, do not save data and show the form again.
	*/
	if($paramlist!=''){
		/* Prepare the sampling minutes */
		for($i=15;$i<46;$i=$i+15){
			$hmin="min_".$i;
			if($HTTP_POST_VARS[$hmin]){
				$tmin=$i;
				break;
			}
		}
		if(!$tmin) $tmin=0;
							
		/* Prepare the sampling ten hours */
		if($HTTP_POST_VARS['hrs_20']) $th=20;
			elseif($HTTP_POST_VARS['hrs_10']) $th=10;
								
		/* Prepare the sampling one hours */
		for($i=0;$i<10;$i++){
			$h1s='hrs_'.$i;
			if($HTTP_POST_VARS[$h1s]){
				$to=$i;
				break;
			}
		}
		if(!$to) $to=0;
								
		/* Prepare the weekday */
		for($i=0;$i<7;$i++){
			$tday="day_".$i;
			if($HTTP_POST_VARS[$tday]){
				$sday=$i;
				break;
			}
		}
								
		/* Finalize sampling time in TIME format */
		$sample_time=($th+$to).":".$tmin.":00";
								
		return 1;
	}else{ 
		return 0;
	}
}

/* Start initializations */
define('LANG_FILE','konsil_chemlabor.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/

if($user_origin=='lab'){
  $local_user='ck_lab_user';
  $breakfile=$root_path."modules/laboratory/labor.php".URL_APPEND;
}else{
  $local_user='ck_pflege_user';
  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/inc_front_chain_lang.php'); ///* invoke the script lock*/

$thisfile='nursing-station-patientdaten-doconsil-chemlabor.php';

$bgc1='#fff3f3'; /* The main background color of the form */
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$edit_form=0;
$read_form=0;
$db_request_table=$target;
$paramlist='';
$sday='';
$sample_time='';
$data=array();

$formtitle=$abtname[$konsil];
define('_BATCH_NR_INIT_',10000000); 
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; patho = 20000000; baclabor = 30000000; blood = 40000000; generic = 50000000;
*/
						
/* Here begins the real work */

 /* Check for the patietn number = $pn. If available get the patients data, otherwise set edit to 0 */
if(isset($pn)&&$pn) {	
    include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	
	if($enc_obj->loadEncounterData($pn)){
		$edit=true;
/*		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
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
*/		$full_en=$pn;					
		$HTTP_SESSION_VARS['sess_en']=$pn;	
		$HTTP_SESSION_VARS['sess_full_en']=$full_en;	
		
		include_once($root_path.'include/care_api_classes/class_diagnostics.php');
		$diag_obj=new Diagnostics;
		$diag_obj->useChemLabRequestTable();
		
	}else{
    	$edit=0;
	  	$mode='';
	  	$pn='';
   }		
}

	if(!isset($mode)) $mode='';
	
	switch($mode){
		case 'save':
							  if(prepareTestElements())
							  {
								$data['batch_nr']=$batch_nr;
								$data['encounter_nr']=$pn;
								$data['room_nr']=$room_nr;
								$data['dept_nr']=$dept_nr;
								$data['parameters']=$paramlist;
								$data['doctor_sign']=$doctor_sign;
								$data['highrisk']=$_highrisk_;
								$data['notes']=$notes;
								$data['send_date']=date('Y-m-d H:i:s');
								$data['sample_time']=$sample_time;
								$data['sample_weekday']=$sday;
								$data['status']=$status;
								$data['history']="Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n";
								$data['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
								$data['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
								$data['create_time']='NULL';
								$diag_obj->setDataArray($data);
							    if($diag_obj->insertDataFromInternalArray()){
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									//echo $sql;
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php".URL_REDIRECT_APPEND."&edit=$edit&saved=insert&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=chemlabor&noresize=$noresize&batch_nr=$batch_nr");
									 exit;
								}else{
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode='';
								 }
		                    } //end of prepareTestElements()
								
							break; // end of case 'save'
							
			case 'update':
							  if(prepareTestElements()){
								//echo $sql;
								$data['room_nr']=$room_nr;
								$data['dept_nr']=$dept_nr;
								$data['parameters']=$paramlist;
								$data['doctor_sign']=$doctor_sign;
								$data['highrisk']=$_highrisk_;
								$data['notes']=$notes;
								$data['sample_time']=$sample_time;
								$data['sample_weekday']=$sday;
								$data['status']=$status;
								$data['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
								$data['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
								$diag_obj->setDataArray($data);
								$diag_obj->setWhereCond(" batch_nr=$batch_nr");
							    if($diag_obj->updateDataFromInternalArray($batch_nr)){									
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php".URL_REDIRECT_APPEND."&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=chemlabor&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								  
		                        } //end of prepareTestElements()
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test request when its status is either "pending" or "draft"
			*  otherwise it is not editable anymore which happens when the lab has already processed the request,
			*  or when it is discarded, hidden, locked, or otherwise. 
			*
			*  If the "parameter" element is not empty, parse it to the $stored_param variable
			*/
			case 'edit':
						//echo $batch_nr;
		                $sql="SELECT * FROM care_test_request_".$db_request_table."  WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft' OR status='')";
		               // echo $sql;
						if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   if($stored_request['parameters']!='')
							   {
							   
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['parameters'],$stored_param);
							      $edit_form=1;
							   }
					         }
			             }
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode="";
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get a new batch number */
		  {
		                $sql="SELECT batch_nr FROM care_test_request_".$db_request_table."  ORDER BY batch_nr DESC";
		                if($ergebnis=$db->SelectLimit($sql,1))
       		            {
				            if($batchrows=$ergebnis->RecordCount())
					        {
						       $bnr=$ergebnis->FetchRow();
							   $batch_nr=$bnr['batch_nr'];
							   if(!$batch_nr) $batch_nr=_BATCH_NR_INIT_; else $batch_nr++;
					         }
					         else
					         {
					            $batch_nr=_BATCH_NR_INIT_;
					          }
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode="save";   
		   }

if(!isset($edit)) $edit=FALSE;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle', "$LDDiagnosticTest :: $LDCentralLab");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('request_chemlab.php','$pn')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle', "$LDDiagnosticTest :: $LDCentralLab");

 # Prepare new form start button
 if($user_origin=='lab' && $pn){
 	$smarty->assign('gifAux1',createLDImgSrc($root_path,'newpat2.gif','0'));
	$smarty->assign('pbAux1',$thisfile.URL_APPEND."&station=$station&user_origin=$user_origin&status=$status&target=$target&noresize=$noresize");
}

# Prepare Body onLoad javascript code
$sTemp = 'onLoad="if (window.focus) window.focus(); loadM(\'form_test_request\');';
if($pn=="") $sTemp = $sTemp .'document.searchform.searchkey.focus();';

$smarty->assign('sOnLoadJs',$sTemp .'"');

 # collect extra javascript code
 ob_start();
?>

<style type="text/css">
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 

function chkForm(d){
   return true 
}

function loadM(fn){
	mBlank=new Image();
	mBlank.src="b.gif";
	mFilled=new Image();
	mFilled.src="f.gif";
	
	form_name=fn;
}

function setM(m){
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)	{
	   marker.src=mFilled.src;
	   element.value='1';
	  // alert(element.name+element.value);
	}else{
	    marker.src=mBlank.src;
		element.value='0';
	  // alert(element.name+element.value);
	 }
}

function setThis(prep,elem,begin,end,step){
  for(i=begin;i<end;i=i+step)  {
     x=prep + i;
     if(elem!=i)     {
       eval("marker=document.images."+x);
	   if(marker.src==mFilled.src)  setM(x);
     }
  }
  setM(prep+elem);
}

function sendLater(){
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut(){
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=chemlabor&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn; ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
 
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

# Show list and actual form

 if(!$noresize){

?>

<script>	
      window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>

<?php 
}
?>

<ul>
<?php

if($edit){

?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>">
<?php

/* If in edit mode display the control buttons */

$controls_table_width=745;

require($root_path.'include/inc_test_request_controls.php');

}elseif(!$read_form && !$no_proc_assist){

?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td class="prompt"><?php echo $LDPlsSelectPatientFirst ?></td>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0','',TRUE) ?>></td>
  </tr>
</table>
<?php
}
?>
   

<!-- outermost table for the form -->
<table border=0 cellpadding=1 cellspacing=0 bgcolor="#606060">
  <tr>
    <td>
	
	<!-- table for the form simulating the border -->
	<table border=0 cellspacing=0 cellpadding=0 bgcolor="white">
   <tr>
     <td>
	 
	 <!-- Here begins the table for the form  -->
	 
		<table   cellpadding=0 cellspacing=0 border=0 width=745>
	<tr  valign="top">

      <td bgcolor="<?php echo $bgc1 ?>">
	  <div class="lmargin">
	  <font size=3 color="#990000" face="arial">
       <?php echo $LDHospitalName ?><br>
       <?php echo $LDCentralLab ?><p><font size=2>
	   <?php echo $LDRoomNr ?>
	   <?php if($edit)
	   {
	   ?>
	    <input type="text" name="room_nr" size=10 maxlength=10 
	    value="<?php 
	                    if($edit_form||$read_form) echo stripslashes($stored_request['room_nr']); 
						 else   echo $HTTP_COOKIE_VARS['ck_thispc_room'] 
				   ?>">
		<?php
		}
		else
		{
		   if($edit_form||$read_form) echo stripslashes($stored_request['room_nr']);
		}
		?>
	   <p>
	    <!--  Table for the day and month code -->
   <table border=0 cellspacing=0 cellpadding=0>
   <!-- Sampling time, day, minutes row -->
   <tr align="center">
   <td colspan=4><font size=1 face="arial" color= "purple"><?php echo $LDSamplingTime ?></td>
   <td colspan=3><font size=1 face="arial" color= "purple"><?php echo $LDDay ?></td>
   <td bgcolor= "#990000"><img src="p.gif" width=1 height=1></td>
   <td colspan=3><font size=1 face="arial" color= "purple"><?php echo $LDMinutes ?></td>

   </tr>
   <!-- Day row  -->
   <tr align="center">
   <?php
	for($i=1;$i<8;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$LDShortDay[$i]."</td>";
	?>
   <td bgcolor= "#990000"><img src="p.gif" width=1 height=1></td>
   <td><font size=1 face="verdana,arial" color= "#990000">15</td>
   <td><font size=1 face="verdana,arial" color= "#990000">30</td>
   <td><font size=1 face="verdana,arial" color= "#990000">45</td>

   </tr>

   <tr align="center">
   <?php
 
    if(($edit_form||$read_form))  $day_names=(int)$stored_request['sample_weekday'];
      else   $day_names=(int)date('w');
	  
    if(!$day_names) $day_names=7;
	
	for($i=1;$i<8;$i++)
	{
	   echo 	'
	   <td>';
	   if($edit) echo '<a href="javascript:setThis(\'day_\',\''.$i.'\',1,8,1)">';
	   if($day_names==$i)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6 id="day_'.$i.'">';
	   if($edit) echo '</a><input type="hidden" name="day_'.$i.'" value="'.$v.'">';
	   echo '</td>';
	}
	/* Divide line */
	echo  ' <td bgcolor= "#990000"><img src="p.gif" width=1 height=1></td>';
	
   if(($edit_form||$read_form)&&$stored_request['sample_time'])
   {
      list($hour,$quarter_mins)=explode(":",$stored_request['sample_time']);
    }

	/* Get the quarter minutes*/
    if(!$edit_form&&!$read_form)
	{
	  $quarter_mins=(int)date('i');
	}
	 
   if($quarter_mins>44)
   {
     $quarter_mins=45;
   }
   elseif($quarter_mins>29)
   {
     $quarter_mins=30;
   }
   elseif($quarter_mins>14)
   {
     $quarter_mins=15;
   }
   else $quarter_mins=0;

	/* For the 10's */
	
      echo 	'<td>';
      if($edit) echo '<a href="javascript:setThis(\'min_\',\'15\',15,46,15)">';
	  if($quarter_mins==15)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6 id="min_15">';
	   if($edit) echo '</a><input type="hidden" name="min_15" value="'.$v.'">';
	   echo '</td>';

	   
	/* For the 30's */

	   echo 	'<td>';
	   if($edit) echo '<a href="javascript:setThis(\'min_\',\'30\',15,46,15)">';
	   if($quarter_mins==30)
      {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }

	   echo ' border=0 width=18 height=6 id="min_30">';
	   if($edit) echo '</a><input type="hidden" name="min_30" value="'.$v.'">';
	   echo '</td>';
	   
	/* For the 45's */

	   echo 	'<td>';
	   if($edit) echo '<a href="javascript:setThis(\'min_\',\'45\',15,46,15)">';
	   if($quarter_mins==45) 
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6 id="min_45">';
	   if($edit) echo '</a><input type="hidden" name="min_45" value="'.$v.'">';
	   echo '</td>';
	?>
   </tr>
   <!-- 10, 20 Time row -->
      <tr align="center">
   <td ><font size=1 face="arial" >&nbsp;</td>
   <td ><font size=1 face="verdana,arial" color= "#990000">10</td>
   <td><font size=1 face="verdana,arial" color= "#990000">20</td>
   <td colspan=8><font size=1 face="arial" color= "purple">&nbsp;</td>
   </tr>
   <!-- Input blocks for 10, 20 Time row -->
      <tr align="center">
   <td ><font size=1 face="arial" color= "purple"></td>
   <?php
   
   $hour_tens=0;
   $hour_ones=0;

    if(!$edit_form&&!$read_form)
	{
       $hour=(int)date('H');
	}
	
   if($hour>19)
   {
     $hour_tens=20;
	 $hour_ones=$hour-$hour_tens;
   }
   elseif($hour>9)
   {
     $hour_tens=10;
	 $hour_ones=$hour-$hour_tens;
   }
   else
   {
    $hour_ones=$hour;
   }	  
	   echo '
	   <td>';
	   if($edit) echo '<a href="javascript:setThis(\'hrs_\',\'10\',10,21,10)">';
	   if($hour_tens==10)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6 id="hrs_10">';
	   if($edit) echo '</a><input type="hidden" name="hrs_10" value="'.$v.'">';
	   echo '</td>';

	   echo '
	   <td>';
	   if($edit) echo '<a href="javascript:setThis(\'hrs_\',\'20\',10,21,10)">';
	   if($hour_tens==20)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6 id="hrs_20">';
	   if($edit) echo '</a><input type="hidden" name="hrs_20" value="'.$v.'">';
	   echo '</td>';
   ?>
   <td colspan=8><font size=1 face="arial" color= "purple"></td>

   </tr>
   
   <tr align="center">
   <?php
	for($i=0;$i<7;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   <td></td>
   <?php
	for($i=7;$i<10;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   </tr>
   <tr>
	<?php
   
	for($i=0;$i<7;$i++)
	{
	   echo 	'
	   <td>';
	   if($edit) echo '<a href="javascript:setThis(\'hrs_\',\''.$i.'\',0,10,1)">';
	   if($hour_ones==$i)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6  id="hrs_'.$i.'">';
	   if($edit) echo '</a><input type="hidden" name="hrs_'.$i.'" value="'.$v.'">';
	   echo '</td>';
	}
	?>
   <td></td>
	<?php
	for($i=7;$i<10;$i++)
	{
	   echo 	'
	   <td>';
	   if($edit) echo '<a href="javascript:setThis(\'hrs_\',\''.$i.'\',0,10,1)">';
	   if($hour_ones==$i)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6 id="hrs_'.$i.'">';
	   if($edit) echo '</a><input type="hidden" name="hrs_'.$i.'" value="'.$v.'">';
	   echo '</td>';
	}
	?>
   </tr>
 </table>
 </div>
</td>

<!-- Middle block of first row -->
      <td bgcolor="<?php echo $bgc1 ?>">
		 <table border=0 cellpadding=10 bgcolor="#ee6666">
     <tr>
       <td>
   
<?php

      if($edit)
        {
		    echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
        elseif(empty($pn))
		{
		    $searchmask_bgcolor='white';
            include($root_path.'include/inc_test_request_searchmask.php');
        }
?>
</td>
     </tr>
   </table>
</td>


         <td  bgcolor="<?php echo $bgc1 ?>"  align="right">
<!--  Block for the casenumber codes -->  
 <table border=0 cellspacing=0 cellpadding=0>
<?php

for($n=0;$n<8;$n++)
{

	if($n==2)
	{
	   echo '<tr><td colspan=10><img src="p.gif" width=1 height=2></td></tr>
	           <tr><td bgcolor="#ffcccc" colspan=10><img src="p.gif" width=1 height=1></td></tr>';
	 }
?>
   <tr align="center">
   <?php
	for($i=0;$i<10;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   </tr>

   
   <tr>
	<?php
	
	for($i=0;$i<10;$i++)
	{
	   echo 	'<td>';
	   if(substr($full_en,$n,1)==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
<?php
}
?>

  <tr>
    <td colspan=10 align="right">
	<?php
    
	/* Barcode for the batch nr */
	
		    echo '<font size=1 color="#990000" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
    /**
	*  The barcode image is first searched in the cache. If present, it will be displayed.
	*  Otherwise an image will be generated, stored in the cache and displayed.
	*/
	$in_cache=1;
	
	if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5&label=1&form_file=1' border=0 width=0 height=0>";
	      if(!file_exists($root_path.'cache/barcodes/form_'.$batch_nr.'.png'))
	     {
             echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
			 $in_cache=0;
		 }
	}

    if($in_cache)   echo '<img src="'.$root_path.'cache/barcodes/form_'.$batch_nr.'.png"  border=0>';
	
	/* Prepare the narrow batch nr barcode for specimen labels */
	if(!file_exists('../cache/barcodes/lab_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=60&xres=1&font=5&label=1&form_file=lab' border=0 width=0 height=0>";
	}
?>	
	</td>
  </tr>

 </table>

    </td>

	</tr>
<!--  The  row for batch number -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td align="right"  colspan=3>
	<font size=1 color="purple" face="verdana,arial"><?php echo $LDBatchNumber ?><font color="#000000" size=2> <?php echo $batch_nr ?>
	<?php
	for($i=0;$i<30;$i++)
	{
	   if(substr($result['patnum'],$n,1)==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle">';
	}
	?>
    </td>

	</tr>	
	
	</table>
	
<!--  The test parameters begin  -->
	
<table border=0 cellpadding=0 cellspacing=0 width=745 bgcolor="<?php echo $bgc1 ?>">
 <?php

# Start buffering the output
ob_start();

    $tdcount=0; /* $tdcount limits the number of  columns (7) for test elements */

    while(list($x,$v)=each($LD_Elements))
	{

	  if(!$tdcount) echo '
	  <tr class="lab">';
	  
	   /* If test element is part of emergency program change bgcolor */

	   if(strpos($x,"_emx_")!==FALSE) $tdbgcolor='bgcolor="#f9def9"'; else  $tdbgcolor="";

	  if(strpos($x,"tx_")!==FALSE)
	  {
	    echo '
		                  <td bgcolor="#ee6666" width=104 colspan=2><font color="white">&nbsp;<b>'.$v.'</b></font></td>';
	  }
	  else
	  {
		 
		 $inp_v=0; /* Initialize input value to 0 */

	     if(strpos($x,"_x_")!==FALSE) /* Check if the element has two marker fields */
		 {
		    $elem_index=explode("_x_",$x);
			
			/* The first marker field on the left */
	        echo '
			         <td '.$tdbgcolor.'>';
		    if($edit) echo '<a href="javascript:setM(\''.$elem_index[0].'\')">';
			if($edit_form||$read_form)
			{
			   if($stored_param[$elem_index[0]])
			   {
			      echo '<img src="f.gif"';
				  $inp_v=1;
				}
				else
				{
				  echo '<img src="b.gif"';
				}
			}
			else
			{
			   echo '<img src="b.gif"';
			}
			
			echo ' border=0 width=18 height=6 id="'.$elem_index[0].'">';
			
			if($edit) echo '</a><input type="hidden" name="'.$elem_index[0].'" value="'.$inp_v.'">';
			
			/* The second marker field on the right */
			echo $v.'</td>
			         <td align="right" '.$tdbgcolor.'>';
			if($edit) echo '<a href="javascript:setM(\''.$elem_index[1].'\')">';
			
			$inp_v=0;
			
			if($edit_form||$read_form)
			{
			   if($stored_param[$elem_index[1]])
			   {
			      echo '<img src="f.gif"';
				  $inp_v=1;
				}
				else
				{
				  echo '<img src="b.gif"';
				}
			}
			else
			{
			   echo '<img src="b.gif"';
			}
			
			echo ' border=0 width=18 height=6 id="'.$elem_index[1].'">';
			
			if($edit) echo '</a><input type="hidden" name="'.$elem_index[1].'" value="'.$inp_v.'">';
			echo '</td>';
		 }
		 else 
		 { 
		    /* Other wise when the element has a single marker field */
			echo '
			          <td '.$tdbgcolor.'>';
			if($edit) echo '<a href="javascript:setM(\''.$x.'\')">';
			if($edit_form||$read_form)
			{
			   if($stored_param[$x])
			   {
			      echo '<img src="f.gif"';
				  $inp_v=1;
				}
				else
				{
				  echo '<img src="b.gif"';
				}
			}
			else
			{
			   echo '<img src="b.gif"';
			}
			
			echo ' border=0 width=18 height=6 id="'.$x.'">';
			
			if($edit) echo '</a><input type="hidden" name="'.$x.'" value="'.$inp_v.'">';
			echo $v.'</td>';
			
		   /* Check for the code of telephone then show telephone icon*/

		   if(strpos($x,"_telx_")!==FALSE)
		   {
		      echo '
			          <td align="right" '.$tdbgcolor.'><img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle',TRUE).'></td>';
	        }
			else
			{ 
		      echo '
			          <td '.$tdbgcolor.'></td>';
		    }
		 }
	   }
	  
	  if($tdcount==6)
	  {
	     echo '
		 </tr>
		 <tr>';
		 $tdcount=0;
		 
		 for ($i=0;$i<6;$i++)   echo '<td bgcolor="#ffcccc" colspan=2 width=104><img src="p.gif"  width=1 height=1></td><td width=2></td>';
		   echo '<td bgcolor="#ffcccc" colspan=2 width=104><img src="p.gif"  width=1 height=1></td>';
		 echo '
		 </tr>';
	   }
	   else
	  {
	     echo '<td bgcolor="white" width=2><img src="p.gif" width=2 height=1></td>';
		 $tdcount++;
	   }
	}
//$sTemp=ob_get_contents();
ob_end_flush();
//echo $sTemp;
?>
  <tr>
    <td colspan=9><input type="text" name="doctor_sign" size=40 maxlength=40 value="<?php if($edit_form||$read_form) echo stripslashes($stored_request['doctor_sign']); ?>"></td>
    <td colspan=11><input type="text" name="notes" size=65 maxlength=60 value="<?php if($edit_form||$read_form) echo stripslashes($stored_request['notes']); ?>"></td>
  </tr>
  <tr>
    <td colspan=20><font size=2 face="verdana,arial" color="purple">&nbsp;<?php echo $LDEmergencyProgram.' &nbsp;&nbsp;&nbsp;<img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle',TRUE).'> '.$LDPhoneOrder ?></td>
  </tr>

</table><!-- End of the main table holding the form -->
 
 	 </td>
   </tr>
 </table><!-- End of table simulating the border -->
 
	</td>
  </tr>
</table><!--  End of the outermost table bordering the form -->
<p>

<?php
if($edit)
{

/* If in edit mode display the control buttons */
require($root_path.'include/inc_test_request_controls.php');

require($root_path.'include/inc_test_request_hiddenvars.php');

?>

</form>

<?php
}
?>

</ul>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the page output to main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
