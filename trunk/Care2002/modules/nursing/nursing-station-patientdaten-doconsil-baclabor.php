<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
function prepareTestParameters($param_type)
{
    global $HTTP_POST_VARS;
	
	$paramlist="";
							   
	while(list($x,$v)=each($HTTP_POST_VARS))
	{
		if(substr_count($x,$param_type) && ($HTTP_POST_VARS[$x]==1))
		{
			if($paramlist=="") $paramlist=$x."=1";
				else $paramlist.="&".$x."=1";
		}
	}
    reset($HTTP_POST_VARS);		
	return $paramlist;
}

								
function prepareSampleDate()
{
    global $HTTP_POST_VARS;
	
								
								/* Prepare the weekday */
								for($i=0;$i<7;$i++)
								{
								   $tday="day_".$i;
								   if($HTTP_POST_VARS[$tday])
								   {
									  $sday=$i;
									  break;
									}
								}
								/* Prepare the month */
								for($i=1;$i<13;$i++)
								{
								   $tmon="month_".$i;
								   if($HTTP_POST_VARS[$tmon])
								   {
									  $smon=$i;
									  break;
									}
								}
								
								/* Finalize sampling date in DATE format */
								return date('Y')."-".$smon."-".$sday;
}

define('LANG_FILE','konsil.php');

/* Globalize the variables */


/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/

if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile=$root_path."modules/laboratory/labor.php".URL_APPEND;
}
else
{
  $local_user='ck_pflege_user';
  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);

$bgc1='#fff3f3'; 
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");

$db_request_table=$target;

$formtitle=$abtname[$target];
define('_BATCH_NR_INIT_',30000000); 
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; patho = 20000000; baclabor = 30000000; blood = 40000000; generic = 50000000;
*/
						
/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
     /* Check for the patietn number = $pn. If available get the patients data, otherwise set edit to 0 */
     if(isset($pn)&&$pn)
	 {		
		include_once($root_path.'include/care_api_classes/class_encounter.php');
		$enc_obj=new Encounter;
	    if( $enc_obj->loadEncounterData($pn)) {
		
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
			if($enc_obj->is_loaded){
			$result=&$enc_obj->encounter;
			}
		}else{
	      $edit=0;
		  $mode="";
		  $pn="";
	   }		
     }
	   
	 if(!isset($mode))   $mode="";
		
		  switch($mode)
		  {
				     case 'save':
							  
							  $material_type_list = &prepareTestParameters('_mx_');  /* _mx_ = test material */
							  $test_type_list = &prepareTestParameters('_tx_');          /* _tx_ = test type */
							  
							  if($material_type_list || $test_type_list)
							  {
							     $sql="INSERT INTO care_test_request_".$db_request_table."
										(
										batch_nr,	   
										encounter_nr,		
										dept_nr,		  
										material,
										test_type,	
										material_note,
										diagnosis_note,
										immune_supp,
										send_date,	
										sample_date,	
										status,		 
										history,		 
										modify_id, 
										create_id, 
										create_time
										)
									 	VALUES
										(
										'".$batch_nr."',   
										'".$pn."',		  
										'".$dept_nr."',
										'".$material_type_list."',
										'".$test_type_list."',
										'".htmlspecialchars($material_note)."',
										'".htmlspecialchars($diagnosis_note)."',
										'".$immune_supp."',
										'".date('Y-m-d')."',
										'".date('Y-m-d')."',
										'".$status."',  
										'Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."', 
										'".$HTTP_SESSION_VARS['sess_user_name']."', 
										'".$HTTP_SESSION_VARS['sess_user_name']."', 
										NULL
										)";

							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=$sid&lang=$lang&edit=$edit&saved=insert&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&noresize=$noresize&batch_nr=$batch_nr");
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode="";
								  }
		                        } //end of prepareTestElements()
								
								break; // end of case 'save'
		     case 'update':
							
							  $material_type_list = &prepareTestParameters('_mx_');  /* _mx_ = test material */
							  $test_type_list = &prepareTestParameters('_tx_');          /* _tx_ = test type */
							  
							  if($material_type_list || $test_type_list)
							  {
							     $sql="UPDATE care_test_request_".$db_request_table." SET
										  dept_nr='".$dept_nr."',	
										  material='".$material_type_list."',  
										  test_type='".$test_type_list."',	
										  material_note='".htmlspecialchars($material_note)."',        
										  diagnosis_note='".htmlspecialchars($diagnosis_note)."',
										  immune_supp='".$immune_supp."',							
										  status='".$status."',		 
										  history=CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."'), 
										  modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										  WHERE batch_nr='".$batch_nr."'";
										
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=$sid&lang=$lang&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&batch_nr=$batch_nr&noresize=$noresize");
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
			*  If the "material" element is not empty, parse it to the $stored_material variable
			*  If the "test_type" element is not empty, parse it to the $stored_test_type variable
			*/
			case 'edit':
			
		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft')";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   if($stored_request['material']!="")
							   {
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['material'],$stored_material);
							      $edit_form=1;
							   }
							   
							   if($stored_request['test_type']!="")
							   {
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['test_type'],$stored_test_type);
							      $edit_form=1;
							   }
					         }
			             }
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode="";
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get a new batch number */
		  {
		                $sql="SELECT batch_nr FROM care_test_request_".$db_request_table." ORDER BY batch_nr DESC LIMIT 1";
		                if($ergebnis=$db->Execute($sql))
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

	   //include_once($root_path.'include/inc_date_format_functions.php');	
       //
}else{ 
	echo "$LDDbNoLink<br>$sql<br>";
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
<style type="text/css">

.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000000;}
.lab {font-family: arial; font-size: 9; color:purple;}

</style>

<script language="javascript">
<!-- 

function chkForm(d)
{ 
   return true 
}


function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="b.gif";
	mFilled=new Image();
	mFilled.src="f.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value=1;
	   //alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value=0;
	   //alert(element.name+element.value);
	 }
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut()
{
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js">
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js">
</script>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); loadM('form_test_request');  
<?php if($pn=="") echo "document.searchform.searchkey.focus();" ?>" 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<?php if(!$noresize)
{
?>

<script>	
      window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>

<?php 
}
?>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDDiagnosticTest; //if($user_origin!="lab") echo " (".$station.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<?php 
if($user_origin=='lab')
{
?>
<a href="<?php echo $thisfile."?sid=$sid&lang=$lang&station=$station&user_origin=$user_origin&status=$status&target=baclabor&subtarget=baclabor&noresize=$noresize"; ?>"><img <?php echo createLDImgSrc($root_path,'newpat2.gif','0') ?>></a>
&nbsp;
<?php
}
?><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<?php
if($edit)
{
?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php

/* If in edit mode display the control buttons */

$controls_table_width=745;

require($root_path."include/inc_test_request_controls.php");

}
elseif(!$read_form && !$no_proc_assist)
{
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0') ?>></td>
  </tr>
</table>
<?php
}
?>

<!--  Here starts the table of the form  -->
  <table   cellpadding=0 cellspacing=0 border=0 width=745>
		

    <tr >
      <td colspan=4 bgcolor="#ffe3e3"  align="center"><font size=3 color="#cc0000" face="verdana,arial"><b> <?php echo $LDCentralLab." - ".$formtitle ?></b></td>
    </tr>

  <tr bgcolor="#ee6666">
    <td><font size=1 color="#ffffff" face="arial"><b><?php echo strtoupper($LDMaterial); ?></b></td>
    <td><font size=1 color="#ffffff" face="arial"><b><?php echo strtoupper($LDRequestedTest); ?></b></td>
    <td align="center"><font size=1 color="#ffffff" face="verdana,arial"><b><?php echo strtoupper($LDLabel); ?></b></td>
    <td bgcolor="<?php echo $bgc1 ?>"></td>
  </tr>

		<tr  valign="top">

      <td bgcolor="<?php echo $bgc1 ?>"><font size=1 color="#990000" face="arial">
	  <table border=0 cellpadding=0 cellspacing=0 class="lab">
    
  
<?php
  while(list($x,$v)=each($LDBacLabMaterialType))
	{
	   list($x2,$v2)=each($LDBacLabMaterialType); 
	   echo '
	   <tr>
	   <td><font size=1 color="#990000" face="arial">'.$v.'&nbsp;</td>
	   <td><font size=1 color="#990000" face="arial">'.$v2.'&nbsp;</td>
	   </tr>
	   <tr>
	   <td>';
	   
	   if($edit) echo '<a href="javascript:setM(\''.$x.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_material[$x])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x.'" value="'.$inp_v.'">';
	   echo '</td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x2.'\')">';
	   	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_material[$x2])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x2.'">';

	   if($edit) echo '</a><input type="hidden" name="'.$x2.'" value="'.$inp_v.'">';
	   echo '</td>
	   </tr>';
	 }

?>		
   </table>

</td>
      <td bgcolor="<?php echo $bgc1 ?>"><font size=1 color="#990000" face="arial">
	  <table border=0 cellpadding=0 cellspacing=0 class="lab">
  
<?php
  while(list($x3,$v3)=each($LDBacLabTestType))
	{
	   list($x4,$v4)=each($LDBacLabTestType);
	   echo '
	   <tr>
	   <td><font size=1 color="#990000" face="arial">'.$v3.'&nbsp;</td>
	   <td><font size=1 color="#990000" face="arial">'.$v4.'&nbsp;</td>
	   </tr>
	   <tr>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x3.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_test_type[$x3])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x3.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x3.'" value="'.$inp_v.'">';
	   echo '</td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x4.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_test_type[$x4])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x4.'">';
	   if($edit) echo '</a><input type="hidden" name="'.$x4.'" value="'.$inp_v.'">';
	   echo '</td>
	   </tr>';
	 }

?>		
   </table>

</td>


         <td  bgcolor="<?php echo $bgc1 ?>"  align="right">
		 <table border=0 cellpadding=10 bgcolor="#ee6666">
     <tr>
       <td>
   
<?php
                 /* The patient label */
 if($edit)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
        elseif($pn=="")
		{
		    $searchmask_bgcolor="#ffffff";
            include($root_path.'include/inc_test_request_searchmask.php');
        }
?>
</td>
     </tr>
   </table>
    </td>

<!-- The right block for the case nr code and sampling date code -->
<td align="right" bgcolor="<?php echo $bgc1 ?>">

   <table border=0 cellspacing=0 cellpadding=0>
<?php
for($n=0;$n<8;$n++)
{
?>
   <tr align="center">
   <!--  The case numbe code  -->
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

 </table>
 
 <!-- Barcode for the batch nr  -->
 <?php
 	$in_cache=1;
	
	if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5&label=1&form_file=1' border=0 width=0 height=0>";
	      if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	     {
             echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
			 $in_cache=0;
		 }
	}

    if($in_cache)   echo '<img src="'.$root_path.'cache/barcodes/form_'.$batch_nr.'.png"  border=0>';
?>

<!--  Table for the day and month code -->
   <table border=0 cellspacing=0 cellpadding=0>
   <tr align="center">
   <?php
	for($i=1;$i<11;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   <td><font size=1 face="arial" color= "#990000">20</td>

   <td><font size=1 face="arial" color= "#990000">30</td>

   </tr>

   <tr align="center">
   <?php
   
   $day_tens=0;
   $day_ones=0;
   
   if($edit_form || $read_form )
   {
      /* Process the sampling date, isolate the elements from the DATE format */
      list($yearval,$monval,$dayval) = explode("-",$stored_request['sample_date']);
   }
   else
   {
      /* If fresh form, assume today */
      $yearval=(int)date('Y');
      $dayval=(int)date('d');
	  $monval=(int)date('m');
   }
   
   /* Process the day of the week, separate the 10's from ones */
   
   if($dayval>29)
   {
     $day_tens=30;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>19)
   {
     $day_tens=20;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>10)
   {
     $day_tens=10;
	 $day_ones=$dayval-$day_tens;
   }
   else
   {
    $day_ones=$dayval;
   }
   //echo $day_ones." ".$day_tens;
	for($i=1;$i<10;$i++)
	{
	   echo 	'<td>';
	   if($day_ones==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	/* For the 10's */
	
   echo 	'<td>';
	  if($day_tens==10) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 20's */

	   echo 	'<td>';
	   if($day_tens==20) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 30's */

	   echo 	'<td>';
	   if($day_tens==30) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	?>
   </tr>
   <tr>
   <?php
	for($i=1;$i<13;$i++)
	   echo 	 "<td><font size=1 face=\"arial\" color= \"#990000\">".$LDShortMonth[$i]."&nbsp;</td>";
	?>

   </tr>
   <tr>
	<?php
	
	for($i=1;$i<13;$i++)
	{
	   echo 	'<td>';
	   if($monval==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
  <tr>
    <td><font size=1>&nbsp;</td>
  </tr>

 </table>

</td>
	</tr>
<!--  The red row for batch number -->
	<tr bgcolor="#ee6666">	    

	<td colspan=4><font size=1 color="#ffffff" face="verdana,arial">
	<b><?php echo $LDBatchNumber." ".$batch_nr ?>  </b>
    </td>

	</tr>	
<!--  The row for material and diagnosis -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td ><font size=3 color="#cc0000" face="verdana,arial">
	<b><?php echo $LDMaterial ?></b><br>
	<b><?php echo $LDDiagnosis ?></b></font>
	<font size=1 color="#990000" face="verdana,arial">
	<?php echo $LDImmuneSupp ?> 	
    </td>
	
	<td colspan=3><font size=3 color="#cc0000" face="verdana,arial">
	<input type="text" name="material_note" size=40 maxlength=40 value="<?php if($edit_form || $read_form) echo stripslashes($stored_request['material_note']); ?>">
                 <br>
	<input type="text" name="diagnosis_note" size=40 maxlength=40 value="<?php if($edit_form || $read_form) echo stripslashes($stored_request['diagnosis_note']); ?>"><br>
	</font>
	<font size=1 color="#990000" face="verdana,arial">
	<input type="radio" name="immune_supp" value=1 <?php if(($edit_form || $read_form) && $stored_request['immune_supp']) echo "checked" ; ?>> <?php echo $LDYes ?>	<input type="radio" name="immune_supp" value=0  <?php if(!$mode || !$stored_request['immune_supp'] ) echo "checked" ; ?>> <?php echo $LDNo ?><br>
    </td>

	</tr>	
	</table>
<p>

<?php
if($edit)
{

/* If in edit mode display the control buttons */
require($root_path."include/inc_test_request_controls.php");

require($root_path."include/inc_test_request_hiddenvars.php");

?>

</form>

<?php
}
?>

</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');?>
</BODY>
</HTML>
