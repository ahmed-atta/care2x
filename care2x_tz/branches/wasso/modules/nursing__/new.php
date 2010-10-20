	<?php

	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');
	require($root_path.'include/inc_environment_global.php');

	$lang_tables[]='departments.php';
	define('LANG_FILE','nursing.php');
	define('NO_2LEVEL_CHK',1);
	require_once($root_path.'include/inc_front_chain_lang.php');
	/**
	* If the script call comes from the op module replace the user cookie with the user info from op module
	*/
	//$db->debug=true;
	if(isset($op_shortcut)&&$op_shortcut){
		$HTTP_COOKIE_VARS['ck_pflege_user'.$sid]=$op_shortcut;
		setcookie('ck_pflege_user'.$sid,$op_shortcut,0,'/');
		$edit=1;
	}elseif($HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid]){
		setcookie('ck_pflege_user'.$sid,$HTTP_COOKIE_VARS['ck_op_pflegelogbuch_user'.$sid],0,'/');
		$edit=1;
	}elseif($HTTP_COOKIE_VARS['aufnahme_user'.$sid]){
		setcookie('ck_pflege_user'.$sid,$HTTP_COOKIE_VARS['aufnahme_user'.$sid],0,'/');
		$edit=1;
	}elseif(!$HTTP_COOKIE_VARS['ck_pflege_user'.$sid]){
		//if($edit) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;};
	}
	/* Load the visual signalling defined constants */
	require_once($root_path.'include/inc_visual_signalling_fx.php');
	require_once($root_path.'global_conf/inc_remoteservers_conf.php');

	/* Retrieve the SIGNAL_COLOR_LEVEL_ZERO = for convenience purposes */
	$z = SIGNAL_COLOR_LEVEL_ZERO;
	/* Retrieve the SIGNAL_COLOR_LEVEL_FULL = for convenience purposes */
	$f = SIGNAL_COLOR_LEVEL_FULL;

	$HTTP_SESSION_VARS['sess_user_origin']='nursing';

	/* Create department object and load all medical depts */
	require_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj= new Department;
	$medical_depts=$dept_obj->getAllMedical();
	/* Create encounter object */
	require_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj= new Encounter;

	/* Load global configs */
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$GLOBAL_CONFIG=array();
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');

	/* Establish db connection */
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok)
	{
	    /* Load date formatter */
		include_once($root_path.'include/inc_date_format_functions.php');
			$enc_obj->where=" encounter_nr=$pn";
		    if( $enc_obj->loadEncounterData($pn)) {
	/*			switch ($enc_obj->EncounterClass())
				{
			    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			                   break;
					case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
								break;
					default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
				}
	*/
				$full_en=$pn;

				if( $enc_obj->is_loaded){
					$result=&$enc_obj->encounter;
					$rows=$enc_obj->record_count;

						if($result['is_discharged']) $edit=0;

						$event_table= 'care_encounter_event_signaller';

						/* If mode = save_event_changes, save the color bar status */

						if($mode=='save_event_changes')
						{
						   $sql_buf='';

						   /* prepare the rose_x part sql query */

						   for ($i=1;$i<25;$i++)
						   {
						       $buf='rose_'.$i;

							   $sql_buf.=$buf." ='".$$buf."', ";
						   }

						   /* prepare the green_x part */

						   for ($i=1;$i<8;$i++)
						   {
						       $buf='green_'.$i;

							   $sql_buf.=$buf."='".$$buf."', ";
						   }

						   /* append the additional color event signallers */

						   $sql_buf.="yellow='$yellow', black='$black', blue_pale='$blue_pale', brown='$brown',
						                   pink='$pink', yellow_pale='$yellow_pale', red='$red', green_pale='$green_pale',
										   violet='$violet', blue='$blue', biege='$biege', orange='$orange'";


						   $sql = "UPDATE $event_table SET $sql_buf WHERE encounter_nr='$pn'";

						 //  echo $sql;

						   if ($event_result=$enc_obj->Transact($sql))
						   {
						     if (!$db->Affected_Rows())
						      {
	                            /* If entry not yet existing, insert data */

						        /* prepare the rose_x part sql query */

							    $set_str='';
								$sql_buf='';

						        for ($i=1;$i<25;$i++)
						       {

						          $buf='rose_'.$i;

								  $set_str.=$buf.', ';

							       $sql_buf.="'".$$buf."', ";
						       }

						       /* prepare the green_x part */

						       for ($i=1;$i<8;$i++)
						      {
						          $buf='green_'.$i;

								  $set_str.=$buf.', ';

							       $sql_buf.="'".$$buf."', ";
						       }

						   /* append the additional color event signallers */

						   $set_str.='yellow, black, blue_pale, brown,
						                   pink, yellow_pale, red, green_pale,
										   violet, blue, biege, orange';

						   /* prepare the values part */

						   $sql_buf.="'$yellow', '$black', '$blue_pale', '$brown',
						                   '$pink', '$yellow_pale', '$red', '$green_pale',
										   '$violet', '$blue', '$biege', '$orange'";

							$sql = "INSERT INTO $event_table (encounter_nr, $set_str) VALUES ('$pn', $sql_buf)";

						    if($event_result=$enc_obj->Transact($sql))
						    {
						       $event=&$HTTP_POST_VARS;

							   $mode='changes_saved';
							    //echo "ok insertd $sql";
						    }
							else
							{
							    //echo "failed insert $sql";
							    $mode='';
							}

					      }
						  else
						  {
						      $mode='changes_saved';
							   //echo "update ok $sql";
						  }
						}
						else
						{
						      $mode='';
							   //echo " failed update $sql";
						}
				    }

					//echo $sql;

				   if(!isset($mode) || ($mode=='') || ($mode=='changes_saved'))
				   {
						/* Get the color event signaller data */

						$sql="SELECT * FROM ".$event_table." WHERE encounter_nr='".$pn."'";

						if($event_result=$db->Execute($sql))
						{
						   if($event_result->RecordCount())
						   {
						      $event=$event_result->FetchRow();
							}
						    else
							{
							   /* If no event entry yet, create event array with zeros */
							   $event=array('yellow'=>$z,'black'=>$z,'blue_pale'=>$z,'brown'=>$z,'pink'=>$z,'yellow_pale'=>$z,'red'=>$z,'green_pale'=>$z,'violet'=>$z,'blue'=>$z,'biege'=>$z,'orange'=>$z);
							   /* Add the green_n */
							   for ($i=1;$i<8;$i++)
							   {
							       $event['green_'.$i]=$z;
							    }
								/* Add the rose_n */
							   for ($i=1;$i<25;$i++)
							   {
							       $event['rose_'.$i]=$z;
							    }
						    }

						}
				   }
				} // end of if($rows)
		  }else{ // end of if ($ergebnis)
		  	echo "<p>$sql$LDDbNoRead";
			exit;
		}
	}else{
		echo "$LDDbNoLink<br>$sql<br>";
	}

	$fr=strtolower(str_replace('.','-',($result['encounter_nr'].'_'.$result['name_last'].'_'.$result['name_first'].'_'.$result['date_birth'])));

	# Start Smarty templating here
	 /**
	 * LOAD Smarty
	 */
	 # Note: it is advisable to load this after the inc_front_chain_lang.php so
	 # that the smarty script can use the user configured template theme

	 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
	 $smarty = new smarty_care('nursing');

	# Title in toolbar
	 $smarty->assign('sToolbarTitle',"$LDPatDataFolder $station");

	 # hide return button
	 $smarty->assign('pbBack',FALSE);

	 # href for help button
	 $smarty->assign('pbHelp',"javascript:gethelp('patient_charts.php','Patient&acute;s chart folder :: Overview','','$station','Main folder')");

	 # href for close button
	 $smarty->assign('breakfile','javascript:window.close()');

	 # Window bar title
	 $smarty->assign('sWindowTitle',ucfirst($result[name_last]).",".ucfirst($result[name_first])." ".$result[date_birth]." ".$LDPatDataFolder);

	 # Body Onload js
	 $sOnLoadJs = 'onLoad="initwindow();';
	 if($mode=='changes_saved') $sOnLoadJs = $sOnLoadJs.'window.opener.location.reload();';
	 $sOnLoadJs = $sOnLoadJs.'"';
	 $smarty->assign('sOnLoadJs',$sOnLoadJs);

	//-- get dept_nr
	if (isset($_SESSION['deptnr'])){$dept_nr = $_SESSION['deptnr'];}


	# Collect js code

	ob_start();

	?>

	<script language="javascript">
	<!--
	  var urlholder;
	  var changed_flag=0;

	function initwindow(){
		if (window.focus) window.focus();
		//window.resizeTo(800,600);
	}

	function getinfo(patientID){
		urlholder="nursing-station.php?route=validroute&patient=" + patientID + "&user=<?php echo $aufnahme_user.'"' ?>;
		patientwin=window.open(urlholder,patientID,"menubar=no,resizable=yes,scrollbars=yes");
		patientwin.moveTo(0,0);
		patientwin.resizeTo(screen.availWidth,screen.availHeight);
	}

	function enlargewin(){
		window.moveTo(0,0);
		 //window.resizeTo(1000,740);
		window.resizeTo(screen.availWidth,screen.availHeight);
	}

	function xmakekonsil(v)
	{
	    var x=v;
	/*	if((v=="patho")||(v=="inmed")||(v=="radio")||(v=="baclabor")||(v=="blood")||(v=="chemlabor"))
		{
	*/
		   if((v=="inmed")||(v=="allamb")||(v=="unfamb")||(v=="sono")	||(v=="nuklear"))
		   {
		     v="generic";
		   }
		   location.href="nursing-station-patientdaten-doconsil-"+v+".php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&konsil="; ?>"+x+"&target="+v;
	/*	}
		else
		{v="radio";
		location.href="ucons.php?sid=<?php echo "$sid&lang=$lang&station=$station&pn=$pn&konsil="; ?>"+v;
		}
	*/	//enlargewin();
	}
	function makekonsil(d)
	{
		if(d!=""){
		   location.href="nursing-station-patientdaten-doconsil-router.php?sid=<?php
		   //echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&dept_nr=";
		   echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&dept_id=";
		   ?>"+d;
		}
	}
	function pullbar(cb)
	{
	    var buf;

		eval("buf = document.patient_folder." + cb.name + ".value");

		buf=parseInt(buf);

		if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
		{ eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $z ?>_"+cb.name+".gif'");
			 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
		}
			else
			{
			 eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $f ?>_"+cb.name+".gif'");
			 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
			}
		changed_flag=1;
	}

	function pullGreenbar(cb)
	{
	    var buf;

		eval("buf = document.patient_folder." + cb.name + ".value");

	     buf=parseInt(buf);

		if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
		{ eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $z ?>_green.gif'");
			 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
		}
			else
			{
			 eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $f ?>_green.gif'");
			 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
			}
		changed_flag=1;
	}

	function pullRosebar(cb)
	{
	    var buf;

		eval("buf = document.patient_folder." + cb.name + ".value");

	     buf=parseInt(buf);

		if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
		{ eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $z ?>_rose.gif'");
			 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
		}
			else
			{
			 eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $f ?>_rose.gif'");
			 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
			}
		changed_flag=1;
	}

	function isColorBarUpdated()
	{
	   if (changed_flag==1) return true;
	     else return false;
	}
	function winClose(){
		window.opener.location.reload();
		window.close();
	}
	function openDRGComposite(){
	<?php if($cfg['dhtml'])
		echo '
				w=window.parent.screen.width;
				h=window.parent.screen.height;';
		else
		echo '
				w=800;
				h=650;';
	?>

		drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=".$pn."&edit=$edit&ln=$name_last&fn=$name_first&bd=$date_birth&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $encounter_nr."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
		window.drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>.moveTo(0,0);
	}

	//-->
	</script>
	<?php

	$sTemp = ob_get_contents();
	ob_end_clean();
	$smarty->append('JavaScript',$sTemp);

	# Buffer page output

	ob_start();

	?>

	<ul><p><br>

	 <form  method="post" name="patient_folder" onSubmit="return isColorBarUpdated()">


	<?php

	# internal function for the following lines of code only
	function ha(){
		global $edit;
		if ($edit) return '<a href="#">';
	}
	function he(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullbar(this)"></a><a href="#">';
			else return  '>';
	}
	function hx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullbar(this)"></a>';
			else return '>';
	}
	function gx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullGreenbar(this)"></a>';
			else return '>';
	}
	function rx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullRosebar(this)"></a>';
			else return '>';
	}


			require_once($root_path.'include/care_api_classes/class_notes_nursing.php');
			include_once($root_path.'include/care_api_classes/class_person.php');

			$pobj= new Person;

			$pid=$pobj->GetPidFromEncounter($pn);
	?>


	<script language="javascript" type="text/javascript">
		function hideme(str,div,ht){
			if (document.getElementById(str).value == "+"){
					document.getElementById(str).value="-";
					document.getElementById(div).style.height=ht;
				}
			else {
					document.getElementById(str).value="+";
					document.getElementById(div).style.height="30px";
					}
		}
	</script>

	<style type="text/css">
		<!--
		.heading {
			font-family: Tahoma, monospace;
			font-size: 11px;
			color: white;
			background-color: #696969;
			font:bold 11px Tahoma; color:white; text-transform:uppercase;
			}
		-->
	</style>


	<?php	echo '<table width="868" border="0" cellpadding="1" cellspacing="1" style="width:400px; overflow:hidden;">';
	//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	?>


<!-- NOTES AND APPOINTMENTS -->
  <tr>
    <td  colspan="3" align="center" valign="top" bgcolor="#696969">
	<div id="pDiv" style="width:400px; overflow:hidden; height:30px; background-color:#A7A7A7; padding:2px;">
      <span style="float:left; background-color:#696969; text-align:center; white-space:nowrap; width:400px; margin:0px 0px 3px 0px; background-color:#696969; color:white; border-bottom:1px solid maroon; font:bold 11px Tahoma, monospace; ">

			<table width="400px" height="28" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr align="center" valign="middle">
				  <td width="30px" height="28">&nbsp;</td>
				  <td width="340px" align="center" class="heading">
				  Notes and Appointments
				  </td>
				  <td width="30px"><input id="pNb" onClick="hideme('pNb','pDiv',115)" type="button" value="+" style="width:20px; width:20px; border:1px solid maroon; font-weight:bold; margin:2px;"> </td>
				</tr>
	    </table>

	  </span>
	  <br>

		<?php echo '' .// view notes
				   '<input style="width:220px; overflow:hidden; border:1px solid white; margin:0px 0px 9px 6px;" type = "button" value = "View Patient Notes" onClick="window.location.href=\'../../modules/dental/gui_patient_history.php?sid='.$sid.'&ntid=false&lang=en&pid='.$pid.'&encounter='. $pn .'&frm=chart\'">' .
				   '' .
				   '<br />' .
				   '' . // enter new note
				   '<input style="width:220px; overflow:hidden; border:1px solid white; margin:0px 0px 7px 6px;" type = "button" value = "Enter Patient Notes" onClick="window.location.href=\'../../modules/dental/gui_patient_history.php?sid='.$sid.'&ntid=false&lang=en&pid='.$pid.'&mode=new&encounter='. $pn .'&frm=chart\'">' .
				   '' .
				   '<br />' .
				   '' .
				   '<input  style="width:220px; overflow:hidden; border:1px solid white; margin:0px 0px 7px 6px;" type="button" onClick="javascript:window.location.href=\''.$root_path.'modules/appointment_scheduler/appt_main_pass.php?sid='.$sid.'&ntid=false&lang=en&dept_nr=43&'. $_SESSION['deptnr'] .'dept_name=\'" value="Appointments">' .
				   ''; ?>

    </div>
   </td>
  </tr>

  <!-- RADIOLOGY -->
  <tr>
    <td  colspan="3" align="center" valign="top" bgcolor="#696969">
	<div id="jj" style="width:400px; overflow:hidden; height:85px; background-color:#A7A7A7; padding:2px;">
      <span style="float:left; background-color:#696969; text-align:center; white-space:nowrap; width:400px; margin:0px 0px 3px 0px; background-color:#696969; color:white; border-bottom:1px solid maroon; font:bold 11px Tahoma, monospace; ">

			<table width="400px" height="28" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr align="center" valign="middle">
				  <td width="30px" height="28">&nbsp;</td>
				  <td width="340px" align="center" class="heading">
				  Radiology</td>
				  <td width="30px"><input id="jk" onClick="hideme('jk','jj',85)" type="button" value="-" style="width:20px; width:20px; border:1px solid maroon; font-weight:bold; margin:2px;"> </td>
				</tr>
	    </table>

	  </span>
	  <br>
		<center>
		<?php echo '' .// RADIOLOGY REQUEST
				   '<input style="width:220px; overflow:hidden; border:1px solid maroon; margin:0px 6px 7px 0px;" type="button" onClick="javascript:window.location.href=\''.$root_path.'modules/nursing/nursing-station-patientdaten-doconsil-radio.php?sid='.$sid.'&ntid=false&lang=en&pn='. $pn .'&edit=1&status=&target=radio&user_origin=lab&noresize=1&mode=\'" value="Radiology Request">' .
				   '' .
				   '' . // RADIOLOGY REPORTS
				   '<input style="width:220px; overflow:hidden; border:1px solid maroon; margin:0px 6px 7px 0px;" type="button" onClick="javascript:window.location.href=\''.$root_path.'modules/registration_admission/show_prescription.php?sid='.$sid.'&ntid=false&lang=en&mode=new&show=xray&disablebuttons=true&externalcall=TRUE&backpath=#\'" value="Radiology Report">' .
				   ''; ?>
		</center>
    </div>
   </td>
  </tr>






</table>


	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
	<input type="hidden" name="pn" value="<?php echo $pn ?>">

	<?php
	# If in edit mode create the hidden items
	if($edit){
	?>

	<input type="hidden" name="yellow" value="<?php echo $event['yellow'] ?>">
	<input type="hidden" name="black" value="<?php echo $event['black'] ?>">
	<input type="hidden" name="blue_pale" value="<?php echo $event['blue_pale'] ?>">
	<input type="hidden" name="brown" value="<?php echo $event['brown'] ?>">
	<input type="hidden" name="pink" value="<?php echo $event['pink'] ?>">
	<input type="hidden" name="yellow_pale" value="<?php echo $event['yellow_pale'] ?>">
	<input type="hidden" name="red" value="<?php echo $event['red'] ?>">
	<input type="hidden" name="green_pale" value="<?php echo $event['green_pale'] ?>">
	<input type="hidden" name="violet" value="<?php echo $event['violet'] ?>">
	<input type="hidden" name="blue" value="<?php echo $event['blue'] ?>">
	<input type="hidden" name="biege" value="<?php echo $event['biege'] ?>">
	<input type="hidden" name="orange" value="<?php echo $event['orange'] ?>">
	<input type="hidden" name="green_1" value="<?php echo $event['green_1'] ?>">
	<input type="hidden" name="green_2" value="<?php echo $event['green_2'] ?>">
	<input type="hidden" name="green_3" value="<?php echo $event['green_3'] ?>">
	<input type="hidden" name="green_4" value="<?php echo $event['green_4'] ?>">
	<input type="hidden" name="green_5" value="<?php echo $event['green_5'] ?>">
	<input type="hidden" name="green_6" value="<?php echo $event['green_6'] ?>">
	<input type="hidden" name="green_7" value="<?php echo $event['green_7'] ?>">
	<input type="hidden" name="rose_1" value="<?php echo $event['rose_1'] ?>">
	<input type="hidden" name="rose_2" value="<?php echo $event['rose_2'] ?>">
	<input type="hidden" name="rose_3" value="<?php echo $event['rose_3'] ?>">
	<input type="hidden" name="rose_4" value="<?php echo $event['rose_4'] ?>">
	<input type="hidden" name="rose_5" value="<?php echo $event['rose_5'] ?>">
	<input type="hidden" name="rose_6" value="<?php echo $event['rose_6'] ?>">
	<input type="hidden" name="rose_7" value="<?php echo $event['rose_7'] ?>">
	<input type="hidden" name="rose_8" value="<?php echo $event['rose_8'] ?>">
	<input type="hidden" name="rose_9" value="<?php echo $event['rose_9'] ?>">
	<input type="hidden" name="rose_10" value="<?php echo $event['rose_10'] ?>">
	<input type="hidden" name="rose_11" value="<?php echo $event['rose_11'] ?>">
	<input type="hidden" name="rose_12" value="<?php echo $event['rose_12'] ?>">
	<input type="hidden" name="rose_13" value="<?php echo $event['rose_13'] ?>">
	<input type="hidden" name="rose_14" value="<?php echo $event['rose_14'] ?>">
	<input type="hidden" name="rose_15" value="<?php echo $event['rose_15'] ?>">
	<input type="hidden" name="rose_16" value="<?php echo $event['rose_16'] ?>">
	<input type="hidden" name="rose_17" value="<?php echo $event['rose_17'] ?>">
	<input type="hidden" name="rose_18" value="<?php echo $event['rose_18'] ?>">
	<input type="hidden" name="rose_19" value="<?php echo $event['rose_19'] ?>">
	<input type="hidden" name="rose_20" value="<?php echo $event['rose_20'] ?>">
	<input type="hidden" name="rose_21" value="<?php echo $event['rose_21'] ?>">
	<input type="hidden" name="rose_22" value="<?php echo $event['rose_22'] ?>">
	<input type="hidden" name="rose_23" value="<?php echo $event['rose_23'] ?>">
	<input type="hidden" name="rose_24" value="<?php echo $event['rose_24'] ?>">
	<input type="hidden" name="mode" value="save_event_changes">
	<!-- dony by d.r. from merotech
	<input type="submit" value="<?php echo $LDSaveChanges ?>">-->
	<?php
	}

	  //echo '<a href="javascript:winClose()"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'></a>';
	?>

	</form>

	</ul>
	<?php

	$sTemp = ob_get_contents();
	ob_end_clean();

	# Assign page output to the mainframe template

	$smarty->assign('sMainFrameBlockData',$sTemp);
	 /**
	 * show Template
	 */
	 $smarty->display('common/mainframe.tpl');

	?>
