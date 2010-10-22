<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Person methods.
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Person extends Core {
	/**#@+
	* @access private
	*/
	/**
	* Table name for person registration data.
	* @var string
	*/
    var $tb_person='care_person';
	/**
	* Table name for city town name.
	* @var string
	*/
	var $tb_citytown='care_address_citytown';
	/**
	* Table name for ethnic origin.
	* Add by Jean-Philippe LIOT 13/05/2004
	* @var string
	*/
	var $tb_ethnic_orig='care_type_ethnic_orig';
	/**
	* Table name for encounter data.
	* @var string
	*/
	var $tb_enc='care_encounter';
	/**
	* Table name for employee data.
	* @var string
	*/
	var $tb_employ='care_personell';
	/**
	* SQL query
	*/
	var $sql;
	/**#@-*/
	/**
	* PID number
	* @var int
	*/
	var $pid;
	/**
	* Sql query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Universal flag
	* @var boolean
	*/
	var $ok;
	/**
	* Internal data buffer
	* @var array
	*/
	var $data_array;
	/**
	* Universal buffer
	* @var mixed
	*/
	var $buffer;
	/**
	* Returned row buffer
	* @var array
	*/
	var $row;
	/**
	* Returned person data buffer
	* @var array
	*/
	var $person=array();
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Valid number flag
	* @var boolean
	*/
	var $is_nr=false;
	/**
	* Field names of basic registration data to be returned.
	* @var array
	*/
	var $basic_list='pid,title,name_first,name_last,name_2,name_3,name_middle,name_maiden,name_others,date_birth,
				           sex,addr_str,addr_str_nr,addr_zip,addr_citytown_nr,citizenship,photo_filename,email,sss_nr,nat_id_nr,region,district,ward';
	/**
	* Field names of table care_person
	* @var array
	*/
	var  $elems_array=array(
				'pid',
				'selian_pid',
				 'title',
				 'date_reg',
				 'name_last',
				 'name_first',
				 'date_birth',
				 'sex',
				 'name_2',
				 'name_3',
				 'name_middle',
				 'name_maiden',
				 'name_others',
				 'date_birth',
				 'blood_group',
				 'rh',
				 'addr_str',
				 'addr_str_nr',
				 'addr_zip',
				 'addr_citytown_nr',
				 'citizenship',
				 'phone_1_code',
				 'phone_1_nr',
				 'phone_2_code',
				 'phone_2_nr',
				 'cellphone_1_nr',
				 'cellphone_2_nr',
				 'fax',
				 'email',
				 'civil_status',
				 'photo_filename',
				 'ethnic_orig',
				 'org_id',
				 'sss_nr',
				 'nat_id_nr',
				 'religion',
				 'region',
				 'district',
				 'ward',
				 'mother_pid',
				 'father_pid',
				 'contact_person',
				 'contact_pid',
				 'contact_relation',
				 'death_date',
				 'death_encounter_nr',
				 'death_cause',
				 'death_cause_code',
				 'status',
				 'history',
				 'modify_id',
				 'modify_time',
				 'create_id',
				 'create_time',
				 'insurance_category',
				 'insurance_ID',
				 'ctc_nr',
				 'hiv_nr',
				 'diabetic_nr',
				 'nhif_nr');
	/**
	* Constructor
	* @param int PID number
	*/
	function Person ($pid='') {
	    $this->pid=$pid;
		$this->ref_array=$this->elems_array;
		$this->coretable=$this->tb_person;
	}
	/**
	* Sets the PID number.
	* @access public
	* @param int PID number
	*/
	function setPID($pid) {
	    $this->pid=$pid;
	}

	/**
	* Resolves the PID number to used in the methods.
	* @access public
	* @param int PID number
	* @return boolean
	*/
	function internResolvePID($pid) {
	    if (empty($pid)) {
		    if(empty($this->pid)) {
			    return false;
			} else { return true; }
		} else {
		     $this->pid=$pid;
			return true;
		}
	}
	/**
	* Checks if PID number exists in the database.
	* @access public
	* @param int PID number
	* @return boolean
	*/
	function InitPIDExists($init_nr){
		global $db;
		// Patch for db where the pid does not start with the predefined init
		//$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		$this->sql="SELECT pid FROM $this->tb_person";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Checks if PID number exists in the database.
	* @access public
	* @param int PID number
	* @return boolean
	*/
	function SelianFileExists($selian_pid){
		global $db;
		// Patch for db where the pid does not start with the predefined init
		//$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		$this->sql="SELECT selian_pid FROM $this->tb_person WHERE selian_pid=$selian_pid";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			} else { return false; }
		} else { return false; }
	}





	 /***************************************************
	  *                                                 *
	  *       This part modified by: DENNIS MOLLEL      *
	  *            deemagics@yahoo.com                  *
	  *                                                 *
	  *            date: October - 2008                 *
	  *                                                 *
	  ***************************************************/


	function GetNewSelianFileNumber(){
		global $db;
		// Patch for db where the pid does not start with the predefined init
		//$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		$this->sql="SELECT max(selian_pid) as maximum FROM $this->tb_person";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
						$this->row['maximum']+1; // date('y'). '/'.
				return ($newfno=$this);
			} else { return false; }
		} else { return false; }
	}

	function GetNewDCMCFileNumber(){
		global $db;
		$this->sql="SELECT max(selian_pid) as fileno FROM care_person";
		$this->result=$db->Execute($this->sql);
		($this->row=$this->result->FetchRow())? print intval($this->row['fileno']+1) : print '';
	}

	function GetPidFromEncounter($encounter_nr) {
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT pid FROM care_encounter where encounter_nr=".$encounter_nr;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row['pid']);
			} else { return false; }
		} else { return false; }
	}


     // get department number

	function getDept($encounter_nr){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT current_dept_nr FROM care_encounter where encounter_nr=".$encounter_nr;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row['current_dept_nr']);
			} else { return false; }
		} else { return false; }
	}

	/**
	 *
	 * Get Departments those who send a request for repair Support
	 *
	 * TECH MODULE
	 *
	 */


	function printTechDepartments(){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT dept FROM care_tech_repair_job";
		$this->result=$db->Execute($this->sql);

		echo '<select name="dept" class="other">';
			while($this->row = $this->result->FetchRow()){
	        	echo '<option value="'.$this->row[0].'">'.$this->row[0].'</option>';
	        }
	   echo '</select>';
	}



	/**
	 * find file number with PID
	 */

	function GetFileNoFromPID($pid){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT selian_pid FROM care_person where pid=".$pid;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return ( '0' ); }
		} else { return ( '0' ); }
	}

	/**
	 *
	 * GETS Name of a notes by using Notes_Type Number
	 *
	 */

	function GetNameOfNotesFromType($type){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name FROM care_type_notes where nr='".$type."'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return false; }
		} else { return false; }
	}

	function FindoutPatientWardStatus($encounter_nr,$out,$in){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT current_ward_nr FROM care_encounter where encounter_nr='$encounter_nr'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
			  ($this->row[0]!=0)? print $out : print $in;
			} else { return false; }
		} else { return false; }
	}



	/**
	 *
	 * Require first and last name using BatchNo
	 *
	 */

	function GetNamesFromBatchNo($bachno){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_first, name_last FROM care_person where pid=".$bachno;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return (ucfirst($this->row[1]) . ' '. ucfirst($this->row[0]));
			} else { return false; }
		} else { return false; }
	}

	/**
	 * DCMC hospital
	 * POOR FUND program insertion
	 */
	function dentalPoorFundInsert($geta){
		global $db;
		//$db->debug=TRUE;

		$items = explode('|',$geta);

		$this->sql="DELETE FROM care_tz_billing_special where encounter_nr = '$items[0]' AND billno = '$items[6]'";

		$this->Transact();

		$this->sql="INSERT INTO care_tz_billing_special SET " .
															"" .
															"encounter_nr = '$items[0]', " .
															"paid = '$items[1]', " .
															"type = '$items[2]', " .
															"total = '$items[3]', " .
															"remain = '$items[4]', " .
															"fullname = '$items[5]', " .
															"billno = '$items[6]', " .
															"dept_nr='43', " .
															"date='" . date('Y-m-d') ."'" .
															"" .
															"";
		//echo $this->sql;

		return $this->Transact();
	}

	/**
	 *
	 * SAVE NEW NOTE FOR A PATIENT
	 *
	 */

	function SaveNewPatientNote($xb2){
		global $db;
		//$db->debug=TRUE;

		$rex = explode('+',$xb2);

		$this->sql="INSERT INTO care_encounter_notes SET " .
															"" .
															"encounter_nr = '$rex[0]', " .
															"type_nr = '$rex[1]', " .
															"short_notes = '$rex[2]', " .
															"notes = '$rex[3]', " .
															"personell_name = '$rex[4]', " .
															"date = '" . date('Y-m-d') . "', " .
															"create_id = '$rex[4]', " .
															"create_time = '". date('Y-m-d H:m:s') . "', " .
															"modify_time = '". date('Y-m-d H:m:s') . "', " .
															"history = " . "'Created: " . date('Y-m-d H:m:s') . " : " . $rex[4] . "'" .
															"";
		//echo $this->sql;

		return $this->Transact();
	}



	/**
	 * Get total amount paid for a support POORFUND program (DENTAL BILLING)
	 */

	function getDentalPoorFund($encounter_nr,$bilno){
		global $db;
		$this->sql="SELECT paid,type FROM care_tz_billing_special where encounter_nr='$encounter_nr' AND billno='$bilno'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0] . '-' . $this->row[1]);
			} else { return false; }
		} else { return false; }
	}

	/**
	 *
	 * GET ALERGY FROM A PATIENT
	 *
	 */

	 function LookForAlergy($pid){
	 	global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_others, blood_group, rh FROM care_person where pid='$pid'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				$alg = 'Patient Alergy: ';
				($this->row[0])? $alg .= '<b>' . $this->row[0].'</b>' : $alg .= '<b>' . 'None;' . '</b>';

				$blood = 'Blood Group: ';
				($this->row[1])? $blood .= '<b>' . $this->row[1] . '</b>' : $blood .= '<b>None;</b>';

				$oneline = '<div style="background-color:lime; padding:4px; width:100%">';

				$oneline .= $alg . '<hr style="border:1px solid maroon;"/>' . $blood;
				($this->row[2])? $oneline .= ' &nbsp;Rhesus: ' . '<b>'.$this->row[2].'</b>' : $oneline = $oneline;

				$oneline .= '</div>';

				echo $oneline;

			} else { return $this->sql; }
		} else { return false; }

	 }

	 function PrintAlergyBloodRhesus($pid){
	 	global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_others, blood_group,rh FROM care_person where pid='$pid'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				$all4one = $this->row[0].'|'.$this->row[1].'|'.$this->row[2];
				return $all4one;
			} else { return $this->sql; }
		} else { return false; }

	 }


	 /**
	  *
	  * Radiology Batch No.
	  *
	  */
	function FindRadiologyBatchNo($pn){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT max(batch_nr) FROM care_test_findings_radio where encounter_nr='$pn'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return 'none'; }
		} else { return false; }
	}

	/**
	 *
	 * PERSONELL REGISTRATION FUNCTION
	 *
	 */

	function personelregs(){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT nr,name FROM care_role_person";
		$this->result=$db->Execute($this->sql);
			while($this->row = $this->result->FetchRow()){

	        	echo '<option value="'.$this->row[0].'">'.$this->row[1].'</option>';

	        }
	}
	/**
	 *
	 *  request PID from fileno
	 *
	 */

	function GetPidFromFileNo($filenr){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT pid FROM care_person where selian_pid='$filenr'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row['pid']);
			} else { return $this->sql; }
		} else { return false; }
	}


	/**
	 *
	 * PATIENT NAME FROM PID
	 *
	 */

	function GetPatientNameFromPid($pid){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_first, name_last FROM care_person where pid=".$pid;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				echo ucfirst($this->row['name_last']) . ' ' . ucfirst($this->row['name_first']);
			} else { return false; }
		} else { return false; }

	}


	/**
	 *
	 * PRINT PATIENT HISTORY (NOTES)
	 *
	 */

	function PrintPatientNotes($pid,$note,$color1,$color2,$recs,$enno){

		global $db;
		//$db->debug=TRUE;

		$nipo = FALSE;
		$notename = '';
		$none = '';
		$cc='1';

		$this->sql="SELECT date, notes, create_id, short_notes, encounter_nr, type_nr FROM care_encounter_notes WHERE encounter_nr IN (SELECT encounter_nr FROM care_encounter WHERE pid = '$pid') ORDER BY encounter_nr DESC  limit 0,15";
		$this->result=$db->Execute($this->sql);

		while($this->row = $this->result->FetchRow()){

 			$nipo = TRUE;

 			$printThiSs=TRUE;

 			$prowexist = '<tr style="background:yellow;">';

			($cc=='1')? $prrow = '<tr style="background:white;">' : $prrow = '<tr style="background:#F1F5F1;">';

			($this->row[4] == $enno)? print $prowexist : print $prrow;

			($cc=='1')? $cc='2' : $cc = '1';

		            echo '<td valign="top">'.date('d/M/Y', strtotime($this->row[0])).'</td>';
		            echo '<td valign="top" style=" padding-bottom:15px;">' .
		            		'';

		            		if ($this->row[5]){
		            				$bc = new person;
		            				$notename = $bc->GetNameOfNotesFromType($this->row[5]);

					               echo '' .
					            		'' .
					            		'<div style="border-bottom:1px dotted #ccc; padding:2px; margin-bottom:10px; width:97%; font-weight:normal; color: #359F45;">' .

					            				'<b>&curren;' . $notename . '</b>';

					            		($this->row[3])? print '<br><br><span style="color:red;"> <b>Brief: </b>'.nl2br($this->row[3]) . '</span>' : print $none;

					               echo '</div>' .
					            		'';
		            		}
		               echo '' .
		            		'<div style="width:100%;">' .
		            	  			''.nl2br($this->row[1]).'' .
		            	  	'</div>' .
		            	  	'' .
		            	  	'</td>';
		            echo '<td valign="top">'.$this->row[2].'</td>';
		          echo '</tr>';

			}// end while


				if (!$nipo){
					echo '<tr style="background:white;">';
					  echo '<td colspan="3" align="center" style="padding:20px;"> ' . $note . ' </td>';
					echo '</tr>';
				}


	}


	/**
	 *
	 * POOR FUND BILLING PRINT REPORT
	 *
	 */


	function GetRowsFromSpecial($mnth,$yrs,$type,$ca,$cb,$action){
		global $db;
		//$db->debug=TRUE;

		$dt = $yrs . '-' . $mnth . '%';
		$cc='0';
		$toto = 0;
		$nipo = FALSE;
		$this->sql="SELECT encounter_nr,date,fullname,remain,paid,billno FROM care_tz_billing_special WHERE date like '$dt' AND type = '$type' ORDER BY encounter_nr DESC";
		$this->result=$db->Execute($this->sql);

			 echo ' </td>
					</tr>
					<tr  valign=top>
					  <td colspan="5">' .
					  '<table width="' .
					  '' .
					  '' ;

						($action == 'prnt') ? print '95%' : print '60%';

				echo  '' .
					  '' .
					  '"border="0" align="left" cellpadding="5" cellspacing="1" class="tablebg">
					    <tr class="searchtxthead" id="rowhead" valign="middle">
					      <td width="10%" height="25" nowrap>S/No</td>
					      <td width="10%" nowrap>Attendant Date </td>
					      <td width="20%" nowrap>Name</td>
					      <td width="50%" nowrap>No. of Procedures done </td>
					      <td width="10%" align="center" nowrap>Not paid</td>
					    </tr>';

			while($this->row = $this->result->FetchRow()){

				  $nipo = TRUE;

				  $billno = $this->row[5];

				  $getpid_obj = new person;

				  $myid = $getpid_obj->GetPidFromEncounter($this->row[0]);

				  echo '<tr class="';

				  if ($cc=='0'){echo $ca; $cc='1';} else{echo $cb; $cc='0';}

				  echo '" valign="top">';
			      echo '<td nowrap>'. $myid .'</td>'; //
			      echo '<td nowrap>'. $this->row[1] .'</td>';
			      echo '<td nowrap>'. nl2br($this->row[2]) .'</td>';
			      echo '<td nowrap>';

			      $this->totorows=$db->Execute("SELECT nr FROM care_tz_billing_archive_elem WHERE nr = '$billno'");

				  $this->tt = $this->totorows->FetchRow();

				  $ennoz=$this->row[0];

			      if ($this->tt[0]>0){


						$this->rr=$db->Execute("SELECT description, price, amount FROM care_tz_billing_archive_elem WHERE nr = '$billno'");

								echo '<table width="100%" border="0" align="right" cellpadding="4" cellspacing="1">';

									$counttoto = 0;

									while($this->mm = $this->rr->FetchRow()){

											echo '<tr valign="top" style="font:normal 12px Tahoma, monospace; color:black; ">';

												echo '<td align="left" style="border-bottom:1px dotted #F2F2F2; " nowrap> ' . $this->mm[0] .' </td>';

												echo '<td align="right" style="border-bottom:1px dotted #F2F2F2; "> ' . ($this->mm[1]*$this->mm[2]) .'.00 </td>';

												$counttoto += intval($this->mm[1]*$this->mm[2]);

											echo '</tr>';


									}

							   echo '   <tr style="font:normal 12px Tahoma, monospace; color:black; ">
								  			<td width="70%" align="right" valign="middle"><strong>Grand Total:</strong></td>
										    <td width="30%" align="right" valign="middle" bgcolor="#FFFFFF" style="border-bottom:1px solid #F2F2F2; border-top:1px solid #F2F2F2;">' .
										    	'<strong>'  .
										    	$counttoto  .
										    	'.00' .
										    	'</strong>' .
									    	'</td>
									  </tr>';
							   echo '   <tr style="font:normal 12px Tahoma, monospace; color:black; ">
								  			<td width="70%" align="right" valign="middle"><strong>Total Paid:</strong></td>
										    <td width="30%" align="right" valign="middle" bgcolor="#FFFFFF" style="border-bottom:1px solid #F2F2F2; border-top:1px solid #F2F2F2;">' .
										    	'<strong>'  .
										    	  $this->row[4].
										    	'.00' .
										    	'</strong>' .
									    	'</td>
									  </tr>
									</table>';
									$showme='yes';

			      			}

							//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

							else {
									echo 'no description found';
									$showme='no';
									}


				  echo '</td>';
			      echo '<td align="right" valign="bottom">' .
			      			'<div style="width:100%;padding-bottom:3px; border-bottom:1px solid #F2F2F2; font-weight:bold;">' .
			      			'' ;

			      			($showme == 'yes')? print $this->row[3] : print '0';

			      			($showme == 'no')?  $toto=$toto : $toto += $this->row[3];

			      	   echo '.00</div></td>' .
			      			'' .
			      			'';
			      echo '</tr>';

			      $showme = 'yes';

			}




		if (intval($toto)!=0){
					 echo '<tr class="';
					 	if ($cc=='0'){echo $ca;} else{echo $cb;}
					 echo '"  style="text-align:right;font:bold 12px Tahoma,Monospace;">';
					 echo '<td colspan="4">Total: </td>';
					 echo '<td>'. $toto .'.00</td>';
					 echo '</tr></table>';
				  }

		else {
					 echo '<tr class="';
					 	if ($cc=='0'){echo $ca;} else{echo $cb;}
					 echo '">';
					 echo '<td colspan="5" align="center">No Record Found</td>';
					 echo '</tr></table>';
			}
	}

	/**
	 *
	 * GENERATE IMAGE FOR A PATIENT NOTES ICON
	 *
	 */

	function CreateIconNotesForPatient($pid){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT create_id FROM care_encounter_notes WHERE encounter_nr IN (SELECT encounter_nr FROM care_encounter WHERE pid = '$pid') ORDER BY encounter_nr DESC  limit 0,1";
		$this->result=$db->Execute($this->sql);

		($this->row = $this->result->FetchRow())?

		print 'gui/img/common/default/history1.gif"  ' .
			  'title="View Patient History &raquo;" border="0"' // if patient Notes exists

						:

		print 'gui/img/common/default/history.gif"' . // if no notes exists for a patient
			  ' title="No history, Enter Patient Notes now &raquo;" border="0"';


	}


	/**
	 *
	 * PATIENT NOTE TYPE
	 * for selection menu (dropdown)
	 *
	 */

	function GetTypesOfNotes(){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT nr,name FROM care_type_notes";
		$this->result=$db->Execute($this->sql);

		echo '<select name="types">';
			while($this->row = $this->result->FetchRow()){
	        	echo '<option value="'.$this->row[0].'"';
	        		($this->row[0] == '4')? print ' selected ' : print ' ';
	        	echo '>'.$this->row[1].'</option>';
	        }
        echo '</select>';
	}

	/**
	 *
	 * check if Technical support Request was replied
	 *
	 */
	function CheckItHasReply($dpt){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT * FROM care_tech_repair_done where dept = '$dpt'";
		$this->result=$db->Execute($this->sql);
		if($this->row=$this->result->FetchRow()){
			return $this->row[0];
		} else { return (''); }
	}

	/**
	 *
	 * 	PRINT SEARCH RESULT FROM TECH MODULE
	 *
	 */

	function PrintTechSearchedRows($m, $y){
		global $db;
		//$db->debug=TRUE;
		$dt = $y . '-' . $m . '-%';
		$this->sql="SELECT tdate, dept, job, reporter FROM care_tech_repair_job where tdate like '$dt'";
		$this->result=$db->Execute($this->sql);

		$cc='1';
		$ys = 'Yes';
		$ns = '<a href="../tech/technik-reparatur-melden.php?sid=&ntid=false&lang=en" title ="Click here to reply this &raquo;">Reply</a>';

		$wapo = '';

		$nipo=FALSE;

			while($this->row = $this->result->FetchRow()){

			($cc=='1')? $prrow = '<tr style="background:white;">' : $prrow = '<tr style="background:#F1F5F1;">';

			($cc=='1')? $cc='2' : $cc = '1';

				  echo  $prrow;
				  echo '  <td align="center" valign="top"> '             .  date('d/m/Y', strtotime($this->row[0])) .            ' </td>';
				  echo '  <td align="left" valign="top"> '               .  $this->row[1] .            ' </td>';
				  echo '  <td align="left" valign="top"> '               .  nl2br($this->row[2]) .     ' </td>';
				  echo '  <td align="center" valign="top"> '             .  $this->row[3] .            ' </td>';

				  $obb = new person;

				  $wapo = $obb -> CheckItHasReply($this->row[1]);

				  echo '  <td align="center" valign="top">';

				    ($wapo != '') ?  print '<a href="#"' .
				    								   'onclick="window.open(\'../reporting_tz/gui/gui_tech_replies_result_dcmc.php?dp='.

				    								   $this->row[1] .

													   '\',\'freed\',\'scrolbars=yes,width=500,height=600\');"> ' .

				    								   $ys . ' </a>'

				    								   :

				    								   Print $ns;

				    echo '</td>';


				  echo '</tr>';

	        } // end while

	}  //  end function


	/**
	 *
	 * Print Replies for the Specified type of Problem
	 *
	 */

	function PrintRepliedReports($dpt){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT tdate, reporter, job  FROM care_tech_repair_done where dept = '" . $dpt . "'";
		$this->result=$db->Execute($this->sql);

		$nipo = '';

		echo '<table border="0" align="center" cellpadding="3" cellspacing="1" class="tbd">
			  <tr class="footer" id="rowhead">
			    <td height="25" colspan="2" align="center"><span class="searchhead">' .
			    		'' .
			    		'' .
			    		'Replies for: ' .
			    		'' .
			    		'<u>' .
			    		'' .
			    		'' . $dpt .
			    		'' .
			    		'</u>' .
			    		'' .
			    		'</span></td>
			  </tr>';

			while($this->row = $this->result->FetchRow()){

					 ($nipo!='yes')? print '' : print '<tr class="whiterow"><td height="20" colspan="2" align="right" valign="top">&nbsp;</td></tr>';

					 echo ' ' .
					 		'<tr class="whiterow">
							    <td align="right" valign="top">' .
							    '' .
							    'Date:' .
							    '' .
							    '</td>
							    <td width="295" align="left" valign="top" class="colorrow">' .
							    '' .
							    '' . date('d/m/Y', strtotime($this->row[0])) .
							    '' .
							    '</td>
							</tr>' .
							'' .
							'
							<tr class="whiterow">
							    <td align="right" valign="top">' .
							    '' .
							    'Technician:' .
							    '' .
							    '</td>
							    <td align="left" valign="top" class="colorrow">' .
							    '' .
							    '' . $this->row[1] .
							    '' .
							    '</td>
							</tr>' .
							'' .
							'
							<tr class="whiterow">
							    <td height="71" align="right" valign="top">' .
							    '' .
							    'Descriptions:' .
							    '' .
							    '</td>
							    <td align="left" valign="top" class="colorrow">' .
							    '' .
							    '' . nl2br($this->row[2]) .
							    '' .
							    '</td>
							</tr>';

			  $nipo = 'yes';

			}


		($nipo == 'yes') ? print '' : print '<tr class="whiterow"><td height="20" colspan="2" align="right" valign="top">No record Found </td></tr>';

		echo '<tr class="footer">
			    <td colspan="2">****END****</td>
			  </tr>
			</table>';

	}



	 /***************************************************
	  *                                                 *
	  *           END OF MY EDITION PART                *
	  *                                                 *
	  ***************************************************/



	/**
	* Prepares the internal buffer array for insertion routine.
	* @access private
	*/
	function prepInsertArray(){
#        global $HTTP_POST_VARS;
		$x='';
		$v='';

		$this->data_array=NULL;
		if(!isset($_POST['create_time'])||empty($_POST['create_time'])) $_POST['create_time']=date('YmdHis');
		#print_r ($this->elems_array);
		#print '<hr>';
		while(list($x,$v)=each($this->elems_array)) {
	    	if(isset($_POST[$v])&&!empty($_POST[$v])) $this->data_array[$v]=$_POST[$v];

	    }
    }
	/**
	* Database transaction. Uses the adodb transaction method.
	* @access private
	*/
	function Transact($sql='') {

	    global $db;
        if(!empty($sql)) $this->sql=$sql;
        $db->BeginTrans();
        $this->ok=$db->Execute($this->sql);
        if($this->ok) {
            $db->CommitTrans();
			return true;
        } else {
        	//echo 'DEBUG: '.$this->sql;
	        $db->RollbackTrans();
			return false;
	    }
    }
	/**
	* Inserts the data into the care_person table.
	* @access private
	* @param int PID number
	* @return boolean
	*/
    function insertDataFromArray(&$array) {
    	global $db;
		$x=''; # magix
		$v='';
		$index='';
		$values='';
		if(!is_array($array)) return false;
		while(list($x,$v)=each($array)) {
				if($x!='insurance_category')
				{
			    $index.="$x,";
			    $values.="'$v',";
		  	}
		  	else
		  	{
		  		$ins_cat = $v;
		  	}
		}
		if($ins_cat) $ins_value=', 1';
		if($ins_cat=="silver")
		{
			$ins_index=", insurance_silver";
		}
		elseif($ins_cat=="gold")
		{
			$ins_index=", insurance_gold";
		}
		elseif($ins_cat=="friedkin")
		{
			$ins_index=", insurance_friedkin";
		}
		elseif($ins_cat=="selian")
		{
			$ins_index=", insurance_selian_stuff";
		}
		$index=substr_replace($index,'',(strlen($index))-1);
		$values=substr_replace($values,'',(strlen($values))-1);

		$pid_counter_min = PID_PREFIX*1000000+1;
		$pid_counter_max = $pid_counter_min+999999;

		$SQLStatement = "SELECT max(pid) AS pid FROM care_person WHERE pid >=".$pid_counter_min." AND pid <=".$pid_counter_max;

		$rs = $db->Execute($SQLStatement);
		if ($db_pid = $rs->FetchRow())
		{
				if($db_pid['pid'])
				{
					$insert_pid = ($db_pid['pid']+1);
				}
				else
				{
					$insert_pid = $pid_counter_min;
				}
		}
		else
		{
				$insert_pid = $pid_counter_min;
		}

		$this->sql="INSERT INTO $this->tb_person (".$index.$ins_index.") VALUES (".$values.$ins_value.")";
		return $this->Transact();
	}
	/**
	* Inserts the data from the internal buffer array into the care_person table.
	*
	* The data must be packed in the buffer array with index keys as outlined in the <var>$elems_array</var> array.
	* @access public
	* @return boolean
	*/
	function insertDataFromInternalArray() {
	    //$this->data_array=NULL;
		$this->prepInsertArray();
		# Check if  "create_time" key has a value, if no, create a new value
		if(!isset($this->buffer_array['create_time'])||empty($this->buffer_array['create_time'])) $this->buffer_array['create_time']=date('YmdHis');
		$this->data_array['date_birth']=date('Y-m-d',strtotime($this->data_array['date_birth']));
		return $this->insertDataFromArray($this->data_array);
	}

/*    function updateDataFromArray(&$array,$item_nr='') {

		$x='';
		$v='';
		$sql='';

		if(!is_array($array)) return false;
		if(empty($item_nr)||!is_numeric($item_nr)) return false;
		while(list($x,$v)=each($array)) {
			if(stristr($v,'concat')||stristr($v,'null')) $sql.="$x= $v,";
		    	else $sql.="$x='$v',";
		}
		$sql=substr_replace($sql,'',(strlen($sql))-1);

        $this->sql="UPDATE $this->tb_person SET $sql WHERE pid=$item_nr";

		return $this->Transact();
	}
*/

	/**
	* Gets all person registration information based on its PID number key.
	*
	* The returned adodb record object contains a row or array.
	* This array contains data with the following index keys:
	* - all index keys as outlined in the <var>$elems_array</var> array
	* - addr_citytown_name = name of the city or town
	*
	* @access public
	* @param int PID number
	* @return mixed adodb object or boolean
	*/
	function getAllInfoObject($pid='') {
	    global $db;
	    $db->debug=FALSE;
		if(!$this->internResolvePID($pid)) return false;
	    $this->sql="SELECT p.*, citizenship AS addr_citytown_name,ethnic.name AS ethnic_orig_txt, tribe.tribe_name , religion.name ,region.region_name  ,district.district_name ,ward.ward_name
					FROM $this->tb_person AS p

					LEFT JOIN care_tz_tribes AS tribe ON p.name_maiden=tribe.tribe_id
					LEFT JOIN care_tz_religion AS religion ON p.religion=religion.nr
					LEFT JOIN care_tz_region AS region ON p.email=region.region_id
					LEFT JOIN care_tz_district AS district ON p.sss_nr=district.district_id
					LEFT JOIN care_tz_ward AS ward ON p.nat_id_nr=ward.ward_id
					LEFT JOIN  $this->tb_ethnic_orig AS ethnic ON p.ethnic_orig=ethnic.nr
					WHERE p.pid='$this->pid' ";
        $this->result=$db->Execute($this->sql);
        if($this->result->RecordCount()) {
            if($this->result->RecordCount()) {
				 return $this->result;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Same as getAllInfoObject() but returns a 2 dimensional array.
	*
	* The returned  data in the array have the following index keys:
	* - all index keys as outlined in the <var>$elems_array</var> array
	* - citytown = name of the city or town
	*
	* @access public
	* @param int PID number
	* @return mixed array or boolean
	*/
	function getAllInfoArray($pid='') {
	    global $db;
		 $x='';
		 $v='';
		if(!$this->internResolvePID($pid)) return false;

	    $this->sql="SELECT p.* , addr.name AS citytown
					FROM $this->tb_person AS p LEFT JOIN $this->tb_citytown AS addr ON p.addr_citytown_nr=addr.nr
					WHERE p.pid=$this->pid";

        	if($this->result=$db->Execute($this->sql)) {

			if($this->result->RecordCount()) {
				return $this->row=$this->result->FetchRow();
			} else { return false; }
		} else { return false; }
	}


	/**
	* Gets a particular registration item based on its PID number.
	*
	* Use this preferably after the person registration data was successfully preloaded in the internal buffer with the <var>preloadPersonInfo()</var> method.
	* For details on field names of items that can be fetched, see the <var>$elems_array</var> array.
	* @access private
	* @param string Field name of the item to be fetched
	* @param int PID number
	* @return mixed string, integer, or boolean
	*/
	function getValue($item,$pid='') {
	    global $db;

	    if($this->is_preloaded) {
		    if(isset($this->person[$item])) return $this->person[$item];
		        else  return false;
		} else {
		    if(!$this->internResolvePID($pid)) return false;
		    $this->sql="SELECT $item FROM $this->tb_person WHERE pid=$this->pid";
		    //return $this->sql;
           		 if($this->result=$db->Execute($this->sql)) {
                		if($this->result->RecordCount()) {
				     $this->person=$this->result->FetchRow();
				     return $this->person[$item];
			    } else { return false; }
		    } else { return false; }
		}
	}
	/**
	* Gets registration items based on an item list and PID number.
	*
	* For details on field names of items that can be fetched, see the <var>$elems_array</var> array.
	* Several items can be fetched at once but their field names must be separated by comma.
	* @access public
	* @param string Field names of items to be fetched separated by comma.
	* @param int PID number
	* @return mixed
	*/
	function getValueByList($list,$pid='') {
	    global $db;

		if(empty($list)) return false;
		if(!$this->internResolvePID($pid)) return false;
		$this->sql="SELECT $list FROM $this->tb_person WHERE pid=$this->pid";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				$this->person=$this->result->FetchRow();
				return $this->person;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Preloads the person registration data in the internal buffer <var>$person</var>.
	*
	* The preload success status is stored in the <var>$is_preloaded</var> variable.
	* The buffered adodb record object contains a row or array.
	* This array contains data with index keys as outlined in the <var>$elems_array</var> array
	*
	* @access public
	* @param int PID number
	* @return boolean
	*/
	function preloadPersonInfo($pid) {
	    global $db;

		if(!$this->internResolvePID($pid)) return false;
		$this->sql="SELECT * FROM $this->tb_person WHERE pid=$this->pid";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 $this->person=$this->result->FetchRow();
				 $this->is_preloaded=true;
				 return true;
			} else { return false; }
		} else { return false; }
	}
	/**#@+
	*
	* Use this preferably after the person registration data was successfully preloaded in the internal buffer with the <var>preloadPersonInfo()</var> method.
	* @access public
	* @return string
	*/
	/**
	* Returns person's first name.
	*/
	function FirstName() {
        return $this->getValue('name_first');
	}
	/**
	* Returns person's last or family name.
	*/
	function LastName() {
		$n1 = $this->getValue('name_2');
		$n2 = $this->getValue('name_last');
        return  ($n1=='')?$n2:$n1;
	}
	/**
	* Returns person's second name.
	*/
	function SecondName() {
        return  $this->getValue('name_2');
	}
	/**
	* Returns person's third name.
	*/
	function ThirdName() {
		$n1 = $this->getValue('name_2');
		$n2 = $this->getValue('name_last');
        return  ($n1=='')?$n2:$n1;
	}
	/**
	* Returns person's middle name.
	*/
	function MiddleName() {
        return  $this->getValue('name_middle');
	}
	/**
	* Returns person's maiden (unmarried) name.
	*/
	function MaidenName() {
        return  $this->getValue('name_maiden');
	}
	/**
	* Returns person's other name(s).
	*/
	function OtherName() {
        return  $this->getValue('name_others');
	}
	/**
	* Returns person's date of birth.
	*/
	function BirthDate() {
        return  $this->getValue('date_birth');
	}
	/**
	* Returns street number. Not stricly numeric. Could be alphanumeric.
	*/
	function StreetNr() {
        return  $this->getValue('addr_str_nr');
	}
	/**
	* Returns street name.
	*/
	function StreetName() {
        return  $this->getValue('addr_str');
	}
	/**
	* Returns ZIP code.
	*/
	function ZIPCode() {
        return  $this->getValue('addr_zip');
	}
	/**
	* Returns the valid address status. Returns 1 or 0.
	*/
	function isValidAddress() {
        return  $this->getValue('addr_is_valid');
	}
	/**
	* Returns the city or town code number. Reserved.
	*/
	function CityTownCode() {
        return  $this->getValue('addr_citytown_nr');
	}
	/**
	* Returns citizenship.
	*/
	function Citizenship() {
        return  $this->getValue('citizenship');
	}
	/**
	* Returns first phone area code.
	*/
	function FirstPhoneAreaCode() {
        return  $this->getValue('phone_1_code');
	}
	/**
	* Returns first phone number. Can be used as private phone number.
	*/
	function FirstPhoneNumber() {
        return  $this->getValue('phone_1_nr');
	}
	/**
	* Returns second phone area code.
	*/
	function SecondPhoneAreaCode() {
        return  $this->getValue('phone_2_code');
	}
	/**
	* Returns second phone number. Can be used as business phone number.
	*/
	function SecondPhoneNumber() {
        return  $this->getValue('phone_2_nr');
	}
	/**
	* Returns first cellphone number. Can be used as private cellphone number.
	*/
	function FirstCellphoneNumber() {
        return  $this->getValue('cellphone_1_nr');
	}
	/**
	* Returns second cellphone number.Can be used as business cellphone number
	*/
	function SecondCellphoneNumber() {
        return  $this->getValue('cellphone_2_nr');
	}
	/**
	* Returns fax number.
	*/
	function FaxNumber() {
        return  $this->getValue('fax');
	}
	/**
	* Returns email address.
	*/
	function EmailAddress() {
        return  $this->getValue('email');
	}
	/**
	* Returns sex.
	*/
	function Sex() {
        return  $this->getValue('sex');
	}
	/**
	* Returns title.
	*/
	function Title() {
        return  $this->getValue('title');
	}
	/**
	* Returns filename of stored id photo.
	*/
	function PhotoFilename() {
        return  $this->getValue('photo_filename');
	}
	/**
	* Returns ethnic origin.
	*/
	function EthnicOrigin() {
        return  $this->getValue('ethnic_origin');
	}
	/**
	* Returns organization id.
	*/
	function OrgID() {
        return  $this->getValue('org_id');
	}
	/**
	* Returns social security (system) number.
	*/
	function SSSNumber() {
        return  $this->getValue('sss_nr');
	}
	/**
	* Returns national id number.
	*/
	function NationalIDNumber() {
        return  $this->getValue('nat_id_nr');
	}
	/**
	* Returns religion.
	*/
	function Religion() {
        return  $this->getValue('religion');
	}
	/**
	* Returns pid number of mother.
	*/
	function MotherPID() {
        return  $this->getValue('mother_pid');
	}
	/**
	* Returns pid number of father.
	*/
	function FatherPID() {
        return  $this->getValue('father_pid');
	}
	/**
	* Returns date of death. In case person is deceased.
	*/
	function DeathDate() {
        return  $this->getValue('death_date');
	}
	/**
	* Returns case of death. In case person is deceased.
	*/
	function DeathCause() {
        return  $this->getValue('death_cause');
	}
	/**
	 * returns a list of other hospital numbers
	 *
	 * Added by Kurt Brauchli
	 * @access public
	 * @return Associative array
	 */
	function OtherHospNrList(){
		global $db;
		if($this->pid){
			$sql = "SELECT * FROM care_person_other_number WHERE pid=".$this->pid." AND status NOT IN ($this->dead_stat)";
			$result = $db->Execute($sql);
			if( !$result )
				return false;

			unset($other_hosp_no);
			while( $row = $result->FetchRow() ){
				$other_hosp_no[$row['org']] = $row['other_nr'];
			}
			return $other_hosp_no;
		}else{
			return FALSE;
		}
	}
	/**
	 * Sets the number for other hospitals (orgs)
	 *
	 * Added by Kurt Brauchli. Enhanced by Elpidio Latorilla 2004-05-23
	 * @access public
	 * @param string The other hospital, org , or institution
	 * @param int The other number
	 * @param string User id
	 * @return Boolean
	 */
	function OtherHospNrSet($org='',$other_nr='',$user='system'){
		global $db;

		if(empty($org)) return FALSE;
		if(empty($other_nr)){
			// if number field is empty, delete other number
			//$this->sql = "DELETE FROM care_person_other_number  WHERE org='$org' AND pid=".$this->pid;
			// We do not delete the record but instead set its status to "deleted"
			$this->sql = "UPDATE care_person_other_number
							SET status='deleted',
								history=".$this->ConcatHistory("Deleted ".date('Y-m-d H:i:s')." ".$user."\n").",
								modify_id='$user',
								modify_time='".date('YmdHis')."'
							WHERE org='$org' AND pid=".$this->pid;
		}else{
			$this->sql = "SELECT other_nr FROM care_person_other_number  WHERE org='$org' AND pid='$this->pid'";

			if($result = $db->Execute( $this->sql )){
				if( $row = $result->FetchRow() ){
					$this->sql = "UPDATE care_person_other_number ";

					# If old number equals new number, we just set the status to "normal"
					# else change the number but document the old number in history

					if($row['other_nr']==$other_nr){
						$this->sql.="SET status='normal',
									history=".$this->ConcatHistory("Reactivated ".date('Y-m-d H:i:s')." ".$user."\n").", ";
					}else{
						$this->sql.="SET other_nr='$other_nr',
									status='normal',
									history=".$this->ConcatHistory("Changed (".$row['other_nr'].") -> ($other_nr) ".date('Y-m-d H:i:s')." ".$user."\n").", ";
					}

					$this->sql.=" modify_id='$user', modify_time='".date('YmdHis')."' WHERE org='$org' AND pid=".$this->pid;

				}else{
					$this->sql = "INSERT INTO care_person_other_number (pid,other_nr,org,status,history,create_id,create_time) ".
								" VALUES( ".$this->pid.",
										'$other_nr',
										'$org',
										'normal',
										'Created ".date('Y-m-d H:i:s')." ".$user."\n',
										'$user',
										'".date('YmdHis')."'
										)";
				}
			}
		}
		//$db->Execute($sql);
		return $this->Transact($this->sql);
	}
	/**
	* Returns table record's technical status.
	*/
	function RecordStatus() {
        return  $this->getValue('status');
	}
	/**
	* Returns table record's history.
	*/
	function RecordHistory() {
        return  $this->getValue('history');
	}
	/**#@-*/
	/**
	* Returns encounter number in case person died during that encounter.
	* @access public
	* @return int
	*/
	function DeathEncounterNumber() {
        return  $this->getValue('death_encounter_nr');
	}
	/**
	* Returns city or town name based on its "nr" key.
	* @access public
	* @return mixed string or boolean
	*/
	function CityTownName($code_nr=''){
	    global $db;
		if(!$this->is_preloaded) $this->sql="SELECT name FROM $this->tb_citytown WHERE nr=$code_nr";
            else $this->sql="SELECT name FROM $this->tb_citytown WHERE nr=".$this->CityTownCode();

		//echo $this->sql;exit;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 $this->row=$this->result->FetchRow();
				 return $this->row['name'];
			} else { return false; }
		} else { return false; }
    }
	/**
	* Returns person registration items as listed in the <var>$basic_list</var> array based on pid key.
	*
	* The data is returned as associative array.
	* @access public
	* @param int PID number
	* @return mixed string or boolean
	*/
	function BasicDataArray($pid){
        if(!$this->internResolvePID($pid)) return false;
		return $this->getValueByList($this->basic_list,$this->pid);
	}
	/**
	* Adds a "View" note in the history field of the person's registration record.
	*
	* @access public
	* @param string Name of viewing person
	* @param int PID number
	* @return mixed string or boolean
	*/
	function setHistorySeen($encoder='',$pid=''){
	    global $db, $dbtype;
	    //$db->debug=true;
		if(empty($encoder)) return false;
		if(!$this->internResolvePID($pid)) return false;
        /*
		if($dbtype=='mysql')
			$this->sql="UPDATE $this->tb_person SET history= CONCAT(history,'\nView ".date('Y-m-d H:i:s')." = $encoder') WHERE pid=$this->pid";
		else
			$this->sql="UPDATE $this->tb_person SET history= history || '\nView ".date('Y-m-d H:i:s')." = $encoder' WHERE pid=$this->pid";
		*/
        $this->sql="UPDATE $this->tb_person SET history=".$this->ConcatHistory("\nView ".date('Y-m-d H:i:s')." = $encoder")." WHERE pid=$this->pid";

		if($this->Transact($this->sql)) {return true;}
		   else  {echo $this->sql;return false;}
	}
	/**
	* Checks if a person is currently admitted (either inpatient & outpatient).
	*
	* If person is currently admitted, his current encounter number is returned, else FALSE.
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
	*/
	function CurrentEncounter($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT encounter_nr FROM $this->tb_enc WHERE pid='$pid' AND (is_discharged='' OR is_discharged=0) AND encounter_status <> 'cancelled' AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($buf->RecordCount()) {
				$buf2=$buf->FetchRow();
				//echo $this->sql;
				return $buf2['encounter_nr'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Gets all encounters of a person based on its pid key.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - encounter_nr = the encounter number
	* - encounter_class_nr = encountr class number, contains 1 (inpatient) or 2 (outpatient), etc.
	* - is_discharged = discharge flag, contains 0 (not discharged) or  1 (discharged)
	* - discharge_date = date of discharge (end of encounter)
	*
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
	*/
	function EncounterList($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT encounter_nr,encounter_date,encounter_class_nr,is_discharged,discharge_date FROM $this->tb_enc WHERE pid='$pid' AND status NOT IN ($this->dead_stat)";
		if($this->res['_enl']=$db->Execute($this->sql)){
		    if($this->rec_count=$this->res['_enl']->RecordCount()) {
				return $this->res['_enl'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Searches and returns a list of persons based on search key.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - pid = the PID number
	* - name_last = person's last or family name
	* - name_first = person's first or given name
	* - date_birth = date of birth
	* - sex = sex
	*
	* @access public
	* @param string Search keyword
	* @param string Sort by the item name, default = name_last (last/family name)
	*�@param string Sort direction, default = ASC (ascending)
	* @return mixed integer or boolean
	*/
	function Persons($searchkey='',$order_item='name_last',$order_dir='ASC'){
	    global $db, $sql_LIKE;
		$searchkey=trim($searchkey);
		$searchkey=strtr($searchkey,'*?','%_');
		if(is_numeric($searchkey)) {
			$searchkey=(int) $searchkey;
			$this->is_nr=true;
			$order_item='pid';
			if(empty($order_dir)) $order_dir='DESC';
		} else {
			if(empty($order_item)) $order_item='name_last';
			if(empty($order_dir)) $order_dir='ASC';
			$this->is_nr=false;
		}

		return $this->SearchSelect($searchkey,'','',$order_item,$order_dir);
/*
		$this->sql="SELECT pid, name_last, name_first, date_birth, sex FROM $this->tb_person WHERE status NOT IN ($this->dead_stat) ";
		if(!empty($searchkey)){
			$this->sql.=" AND (name_last $sql_LIKE '$searchkey%'
			                		OR name_first $sql_LIKE '$searchkey%'
			                		OR pid $sql_LIKE '$searchkey' )";
		}
		$this->sql.="  ORDER BY $order_item $oder_dir";
		if($this->res['pers']=$db->Execute($this->sql)){
		    if($this->rec_count=$this->res['pers']->RecordCount()) {
				return $this->res['pers'];
			}else{return false;}
		}else{return false;}
*/
	}
	/**
	* Searches and returns a block list of persons based on search key.
	*
	* The following can be set:
	* - maximum number of rows in the returned list
	* - beginning row offset
	* - Field name for sorting
	* - Sort direction
	* - A boolean flag to include the first name in searching
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - pid = the PID number
	* - name_last = person's last or family name
	* - name_first = person's first or given name
	* - date_birth = date of birth in YYYY-mm-dd format
	* - sex = sex
	* - death_date = The date the person died (if applicable)
	* - addr_zip = Address zip code
	* - status = Record status
	*
	* @access public
	* @param string Search keyword
	* @param string Sort by the item name, default = name_last (last/family name)
	*�@param string Sort direction, default = ASC (ascending)
	* @return mixed integer or boolean
	*/
	function SearchCount()
	{
		return $this->rec_count;
	}
	function SearchSelect($searchkey='',$maxcount=100,$offset=0,$oitem='name_last',$odir='ASC',$fname=FALSE){
		global $db, $sql_LIKE, $root_path;
		$db->debug=false;
		if(empty($maxcount)) $maxcount=100;
		if($searchkey=='*') $maxcount=1000;
		if(empty($offset)) $offset=0;

		include_once($root_path.'include/inc_date_format_functions.php');

		# convert * and ? to % and &
		$searchkey=strtr($searchkey,'*?','%_');
		$searchkey=trim($searchkey);
		$suchwort=$searchkey;

		if(is_numeric($suchwort)) {
			$suchwort=(int) $suchwort;
			//$numeric=1;
			$this->is_nr=TRUE;

			//if($suchwort<$GLOBAL_CONFIG['person_id_nr_adder']){
			//	   $suchbuffer=(int) ($suchwort + $GLOBAL_CONFIG['person_id_nr_adder']) ;
			//}

			if(empty($oitem)) $oitem='pid';
			if(empty($odir)) $odir='DESC'; # default, latest pid at top


			$sql2="	WHERE pid like '%$suchwort%' OR selian_pid like '%$suchwort%' ";

		} else {

			$OTEN = " OR  (pid like '%$suchwort%' OR selian_pid like '%$suchwort%')";
			# Try to detect if searchkey is composite of first name + last name
			if(stristr($searchkey,',')){
				$lastnamefirst=TRUE;
			}else{
				$lastnamefirst=FALSE;
			}

			$searchkey=strtr($searchkey,',',' ');
			$cbuffer=explode(' ',$searchkey);

			# Remove empty variables
			for($x=0;$x<sizeof($cbuffer);$x++){
				$cbuffer[$x]=trim($cbuffer[$x]);
				if($cbuffer[$x]!='') $comp[]=$cbuffer[$x];
			}

			# Arrange the values, ln= lastname, fn=first name, bd = birthday
			if($lastnamefirst){
				$fn=$comp[1];
				$ln=$comp[0];
				$bd=$comp[2];
			}else{
				$fn=$comp[0];
				$ln=$comp[1];
				$bd=$comp[2];
			}
			# Check the size of the comp
			if(sizeof($comp)>1){

				$sql2=" WHERE (name_last $sql_LIKE '%$suchwort%' OR name_2 $sql_LIKE '%$suchwort%' OR name_first $sql_LIKE '%$suchwort%')";
				if(!empty($bd)){
					$DOB=@formatDate2STD($bd,$date_format);
					if($DOB=='') {
						$sql2.=" AND date_birth $sql_LIKE '$bd%' ";
					}else{
						$sql2.=" AND date_birth = '$DOB' ";
					}
				}
			}else{
				# Check if * or %
				if($suchwort=='%'||$suchwort=='%%'){
					$sql2=" WHERE status NOT IN ($this->dead_stat)";
				}else{
					# Check if it is a complete DOB
					$DOB=@formatDate2STD($suchwort,$date_format);
					if($DOB=='') {
						if(defined('SHOW_FIRSTNAME_CONTROLLER')&&SHOW_FIRSTNAME_CONTROLLER){
							if($fname){
								$sql2=" WHERE name_2 $sql_LIKE '%$suchwort%' OR name_last $sql_LIKE '%$suchwort%' OR name_first $sql_LIKE '%$suchwort%'";
							}else{
								$sql2=" WHERE name_first $sql_LIKE '%$suchwort%' ";
							}
						}else{
							$sql2=" WHERE name_first $sql_LIKE '%$suchwort%' ";
						}
					}else{
						$sql2=" WHERE date_birth LIKE '%$DOB%'";
					}

					$sql2.=" AND status NOT IN ($this->dead_stat) ";
				}
			}
		 }

		$this->buffer=$this->tb_person.$sql2;

		# print $this->buffer;

		# Save the query in buffer for pagination
		//$this->buffer=$fromwhere;
		//$sql2.=' AND status NOT IN ("void","hidden","deleted","inactive")  ORDER BY '.$oitem.' '.$odir;
		# Set the sorting directive
		if(isset($oitem)&&!empty($oitem)) $sql3 =" ORDER BY $oitem $odir";
		#print mysql_error();

		$this->sql='SELECT pid, selian_pid, name_2, name_first, date_birth, addr_zip, sex, death_date, status,name_last FROM '.$this->buffer.$sql3;//.$OTEN;
		#echo '<hr />'.$this->sql;

		if($this->res['ssl']=$db->SelectLimit($this->sql,$maxcount,$offset)){
			if($this->rec_count=$this->res['ssl']->RecordCount()) {
				return $this->res['ssl'];
			}else{return false;}
		}else{return false;}

	}
	/**
	* Checks if the person is currently employed in this hospital.
	*
	* If currently employed the employee number is returned, else FALSE.
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
	*/
	function CurrentEmployment($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT nr FROM $this->tb_employ
							WHERE pid='$pid' AND is_discharged IN ('',0) AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
			if($buf->RecordCount()){
				$buf2=$buf->FetchRow();
				return $buf2['nr'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Sets death information.
	*
	* The data must be passed by reference with associative array.
	* Data array must have the following index keys.
	* - 'death_date' = date of death
	* - 'death_encounter_nr' = encounter number in case person died during that encounter
	* - 'death_cause' = text of death cause
	* - 'death_cause_code' = code of death cause (if available)
	* - 'history' = text to be appended to "history" item
	* - 'modify_id' = name of user
	* - 'modify_time' = time of this modification in yyyymmddhhMMss format
	*
	* @access public
	* @param int PID number
	* @param array Death information.
	* @return mixed integer or boolean
	*/
	function setDeathInfo($pid,&$data){
		$this->setDataArray($data);
		$this->setWhereCondition("pid=$pid");
		return $this->updateDataFromInternalArray($pid);
	}
	/**
	* Returns the PID ('nr' of a column) based on OID key
	*
	* Special for postgresql or dbms that returns an OID key after an insert
	*
	* @access public
	* @param int OID return insert key of a column
	* @return mixed integer or boolean
	*/
	function postgre_PIDbyOID($oid=0){
		if(!$oid) return false;
		else return $this->postgre_Insert_ID($this->tb_person,'pid',$oid);
	}

	/**
	* returns basic data of living person(s) based on family name, first name & b-day
	*
	* @access public
	* @param array The data keys
	* @param boolean Flags if non-living persons are also returned. Default = FALSE
	* @return mixed array or boolean
	*/
	function PIDbyData(&$data,$deadtoo=FALSE){
		global $db, $sql_LIKE, $dbf_nodate;
		$this->sql="SELECT pid,name_last,name_first,date_birth,sex FROM $this->tb_person WHERE name_last $sql_LIKE '".$data['name_last']."'
					AND name_first $sql_LIKE '".$data['name_first']."'
					AND date_birth='".$data['date_birth']."'
					AND sex $sql_LIKE '".$data['sex']."'";
		if(!$deadtoo) $this->sql.=" AND death_date='$dbf_nodate'";
		if($res['pbd']=$db->Execute($this->sql)){
		    if($res['pbd']->RecordCount()) {
				return $res['pbd'];//
			}else{return false;}
		}else{return false;}
	}
	/**
	* Sets the  filename if the person in the databank
	*
	* @access public
	* @param int PID number
	* @param string Filename
	* @return mixed string or boolean
	*/
	function setPhotoFilename($pid='',$fn=''){
	    global $db; // $_SESSION;
		if(empty($pid)||empty($fn)) return false;
		if(!$this->internResolvePID($pid)) return false;

		 $this->sql="UPDATE $this->tb_person SET photo_filename='$fn',
		 			history=".$this->ConcatHistory("\nPhoto set ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name'])." WHERE pid=$this->pid";
		return $this->Transact($this->sql);
	}
	function showPID($pid)
	{
		return $pid;
		/*
		if(strlen($pid)<8)
		{
			for($i=0;$i<(8-strlen($pid));$i++)
			{
				$pid_zero.='0';
			}

		}
		$altered_pid = chunk_split($pid_zero.$pid, 2, '/');
		return substr($altered_pid,0,strlen($altered_pid)-1);
		*/
	}
	function setPatientIsTransmit2ERP($pid,$transmit) {
	    global $db;
	    $db->debug=false;
	    $this->sql="update $this->tb_person SET is_transmit2ERP='$transmit' where pid='$pid'";
	    $db->Execute($this->sql);
	}
}
?>