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

/* Start initializations */
define('LANG_FILE','konsil.php');
echo "prova";
/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab'){
	$local_user='ck_lab_user';
	$breakfile="labor.php?sid=".$sid."&lang=".$lang; 
}elseif($user_origin=='amb'){
	$local_user='ck_lab_user';
	$breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND;
}else{
	$local_user='ck_pflege_user';
	$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/inc_front_chain_lang.php'); # call the script lock

$thisfile=basename(__FILE__);

$bgc1='#cde1ec'; /* The main background color of the form */
$abtname=get_meta_tags($root_path."/global_conf/$lang/konsil_tag_dept.pid");
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$abtname[$subtarget];

$db_request_table=$subtarget;

/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	

     require_once($root_path.'include/inc_date_format_functions.php');
     
	   
	 if(!isset($mode))   $mode='';
		
		  switch($mode)
		  {
		     case 'update':
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
                                          entry_date='".formatDate2Std($entry_date,$date_format)."',
										  journal_nr='".$journal_nr."',
										  blocks_nr='".$blocks_nr."',
										  deep_cuts='".$deep_cuts."',
										  special_dye='".$special_dye."',
										  immune_histochem='".$immune_histochem."',
										  hormone_receptors='".$hormone_receptors."',
										  specials='".$specials."',
										  modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									
									 header("location:".$thisfile.URL_REDIRECT_APPEND."&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								break; // end of case 'save'
			
			 default: $mode="";
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get the pending test requests */
		  {
		                $sql="SELECT batch_nr,encounter_nr,send_date,dept_nr FROM care_test_request_".$subtarget." 
						         WHERE (status='pending' OR status='') ORDER BY  send_date DESC";
		                if($requests=$db->Execute($sql))
       		            {
						
				            $batchrows=$requests->RecordCount();
	                        if($batchrows && (!isset($batch_nr) || !$batch_nr)) 
					        {
						       $test_request=$requests->FetchRow();
							   
                               /* Check for the patietn number = $pn. If available get the patients data */
		                       $pn=$test_request['encounter_nr'];
						       $batch_nr=$test_request['batch_nr'];
							}
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode='update';   
		   }	
		       
	   
     /* Check for the patietn number = $pn. If available get the patients data */
     if($batchrows && $pn)
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

			$result=&$enc_obj->encounter;

			$sql="SELECT * FROM care_test_request_".$subtarget." WHERE batch_nr='".$batch_nr."'";
			if($ergebnis=$db->Execute($sql)){
				if($editable_rows=$ergebnis->RecordCount()){
					$stored_request=$ergebnis->FetchRow();
					$edit_form=1;
				}
            }else{
				echo "<p>$sql<p>$LDDbNoRead"; 
			}	
		}					   
	}
}else{
	echo "$LDDbNoLink<br>$sql<br>"; 
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>

<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 

function chkForm(d)
{ 
/*  if(d.journal_nr.value=="" && d.blocks_nr.value=="" && d.deep_cuts.value=="" && d.special_dye.value=="" && d.immune_histochem.value=="" && d.hormone_receptors.value=="" && d.specials.value=="" ) return false;
*/
    if(d.journal_nr.value=="" && d.blocks_nr.value=="" ) return false;
    else return true; 
}


function printOut()
{
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); " 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDPendingTestRequest." (#".$stored_request['batch_nr']." ".$stored_request['room_nr']." ".$stored_request['dept'].")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('pending_patho.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>

<?php
if($batchrows)
{
?>

<table border=0>
  <tr valign="top">
<!-- left frame for the requests list -->
    <td>
	<FONT  SIZE=1  FACE="verdana">  
<?php 

/* The following routine creates the list of pending requests */
require($root_path.'include/inc_test_request_lister_fx.php');

?></td>
<!--  right frame for the request form -->
    <td >
        <form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
		
		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?> title="<?php echo $LDSaveEntry ?>"> 
        <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
<?php
if($stored_request['entry_date'] && $stored_request['entry_date']!="0000-00-00")	
{
?>	
		
        <a href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['entry_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img <?php echo createLDImgSrc($root_path,'enter_result.gif','0','absmiddle') ?> alt="<?php echo $LDEnterResult ?>"></a>
<?php
}
?>

		<table   cellpadding="0" cellspacing=1 border="0" width=700>

		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>">
		<td  width=40%>
		<?php
        if($edit || $read_form)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php'.URL_REDIRECT_APPEND.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
        ?>
     </td> 
		<td class=fva2_ml10><div class="fva2_ml10">
		
		<table border=0  cellpadding=0 cellspacing=0 width=100%>
    <tr>
      <td rowspan=8 align="left" valign="top"><font size=4 color="#0000ff"><b><?php echo $formtitle ?></b></font><br>
	  <font size=1 color="#000099"><?php echo $LDTel ?>
	  </td>
      <td class="fvag_ml10" align="right"><?php echo $LDEntryDate ?> 
	  <?php
	  if($stored_request['status']=='pending')
		   {
		?>
			   	<a href="javascript:show_calendar('form_test_request.entry_date','<?php echo $date_format ?>')">
				<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>

		<?php	           
		}
		?>
	  </td>
      <td>
	  <?php 
	    

		   if($stored_request['status']=='pending')
		   {
				echo '
	                   <input type="text" name="entry_date" size=10 maxlength=10 value="';
					   
			   if($stored_request['entry_date'] && $stored_request['entry_date']!="0000-00-00") echo formatDate2Local($stored_request['entry_date'],$date_format);
			    else echo formatDate2Local(date('Y-m-d'),$date_format);
			   
			   echo '" onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">&nbsp;';
	
		    }
			else 
			{
			   echo '<font face="verdana" size=2 color="#000000">'.$stored_request['entry_date'].'</font>&nbsp;';
			}

	  ?>
			   </td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDJournalNumber ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('journal_nr'); ?></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDBlockNumber ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('blocks_nr'); ?></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDDeepCuts ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('deep_cuts'); ?></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDSpecialDye ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('special_dye'); ?></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDImmuneHistoChem ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('immune_histochem'); ?></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDHormoneReceptors ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('hormone_receptors'); ?></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDSpecials ?> &nbsp;</td>
      <td>
	  <?php printLabInterns('specials'); ?></td>
    </tr>
  </table>
  		</div>
		</td></tr>


<!-- Second row  -->
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2><font color="#000099">	   
		
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
    <tr>
      <td><div class=fva0_ml10><?php 
	    if($stored_request['quick_cut']) echo '<img '.createComIcon($root_path,'chkbox_chk.gif','0','absmiddle').'>'; 
	      else echo '<img '.createComIcon($root_path,'chkbox_blk.gif','0','absmiddle').'>';  
		echo '&nbsp;<b>'.$LDSpeedCut.'</b>'; 
		?></td>
      <td><div class=fva0_ml10><?php 
	  echo $LDRelayResult ?>&nbsp;<font face="courier" size=2 color="#000000"><?php echo $stored_request['qc_phone'] ?></font></td>
      <td rowspan=2 align="right" >
	  <?php 
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
     ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td><div class=fva0_ml10> <?php
	    if($stored_request['quick_diagnosis']) echo '<img '.createComIcon($root_path,'chkbox_chk.gif','0').' '; 
	      else echo '<img '.createComIcon($root_path,'chkbox_blk.gif','0').' ';  
		echo 'align="absmiddle">&nbsp;<b>'.$LDSpeedTest.'</b>'; 	  
	  ?> </td>
      <td><div class=fva0_ml10><?php echo $LDRelayResult ?>&nbsp;<font face="courier" size=2 color="#000000"><?php echo $stored_request['qd_phone'] ?></font></td>
    </tr>
  </table>
  </div></td>
<!-- 			<td  valign=top><div class=fva0_ml10><font color="#000099">
		 <?php echo $LDSpecialNotice ?>:<br>
		<input type="text" name="specials" size=55 maxlength=60>
		
  </div></td> -->
</tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td valign="top" width=40%>
		<div class=fva2_ml10><p><br>
		<b><?php echo $LDMatType ?>:</b><br>
			<?php
	    if($stored_request['material_type']=="pe") echo '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle').'> '; 
	      else echo '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle').'> ';  
		echo '&nbsp;'.$LDPE.'</b>'; 	  
	?><br>
  	<?php 
	    if($stored_request['material_type']=="op_specimen") echo '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle').'> '; 
	      else echo '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle').'> ';  
		echo '&nbsp;'.$LDSpecimen.'</b>'; 	  
	?><br>
	<?php 
	    if($stored_request['material_type']=="shave") echo '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle').'> '; 
	      else echo '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle').'> ';  
		echo '&nbsp;'.$LDShave.'</b>'; 	  
	?><br>
  	 <?php
	    if($stored_request['material_type']=="cytology") echo '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle').'> '; 
	      else echo '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle').'> ';  
		echo '&nbsp;'.$LDCytology.'</b>'; 	  
	 ?><br>
		</td>
		<td valign="top"><font face="courier" size=2><?php  echo nl2br(stripslashes($stored_request['material_desc']))?></font>
				</td>
		</tr>	
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  colspan=2><div class="fva0_ml10"><font color="#000099">	 
		<b><?php echo $LDLocalization ?></b><br><img src="../../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo nl2br(stripslashes($stored_request['localization'])); ?></font>
  </div></td>
</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDClinicalQuestions ?></b><br><img src="../../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['clinical_note'])); ?></font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDExtraInfo ?></b><font size=1 face="arial"> <?php echo $LDExtraInfoSample ?><br><img src="../../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['extra_note'])); ?></font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDRepeatedTest ?></b><font size=1 face="arial"> <?php echo $LDRepeatedTestPls ?><br><img src="../../gui/img/common/default/pixel.gif" border=0 width=20 height=30 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['repeat_note'])); ?></font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDForGynTests ?></b>
		
		<table border=0 cellpadding=1 cellspacing=1 width=100%>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDLastPeriod ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_last_period']) echo stripslashes($stored_request['gyn_last_period']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDMenopauseSince ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_menopause_since']) echo stripslashes($stored_request['gyn_menopause_since']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDHormoneTherapy ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_hormone_therapy']) echo stripslashes($stored_request['gyn_hormone_therapy']) ?></font>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDPeriodType ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_period_type']) echo stripslashes($stored_request['gyn_period_type']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDHysterectomy ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_hysterectomy']) echo stripslashes($stored_request['gyn_hysterectomy']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDIUD ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_iud']) echo stripslashes($stored_request['gyn_iud']) ?></font>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDGravidity ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_gravida']) echo stripslashes($stored_request['gyn_gravida']) ?></font></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDContraceptive ?></td>
      <td><font face="courier" size=2 color="#000000"><?php if($stored_request['gyn_contraceptive']) echo stripslashes($stored_request['gyn_contraceptive']) ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td width=40%><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDOpDate ?>:
		<font face="courier" size=2 color="#000000"><?php  echo formatDate2Local($stored_request['op_date'],$date_format); ?></font>
  </div></td>
			<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor."/".$LDDept ?>:
		<font face="courier" size=2 color="#000000"><?php echo stripslashes($stored_request['doctor_sign']) ?></font>
		&nbsp;
  </div></td>
</tr>

		</table>
<?php

require($root_path.'include/inc_test_request_hiddenvars.php');

?>	<br>
		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?> title="<?php echo $LDSaveEntry ?>"> 
        <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
<?php
if($stored_request['entry_date'] && $stored_request['entry_date']!="0000-00-00")	
{
?>	
		
        <a href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['entry_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img <?php echo createLDImgSrc($root_path,'enter_result.gif','0','absmiddle') ?> alt="<?php echo $LDEnterResult ?>"></a>
<?php
}
?>
     </form>
</td>
</tr>
</table>        	

<?php
}
else
{
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font size=3 face="verdana,arial" color="#990000"><b><?php echo $LDNoPendingRequest ?></b></font>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php
}
?>

	</td>
  </tr>
</table>

<p>

<?php
require($root_path.'include/inc_load_copyrite.php');?>
</BODY>
</HTML>
