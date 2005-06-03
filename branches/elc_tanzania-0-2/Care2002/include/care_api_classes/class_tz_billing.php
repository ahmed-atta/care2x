<?PHP

require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Billing methods for tanzania (the product-module is completely rewritten by Robert Meggle. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle
* @version beta 1.0.0
* @copyright 2005 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/

/*
Class Structure:

Class Core
    |
    `---> Class Encounter
              |
              `----> Class Bill
*/              

class Bill extends Encounter {
  
  // Properties

	var $fields_tbl_bill=array(
                  'encounter_nr',
                  'first_date',
                  'create_id'); 
									
  var $tbl_bill='care_tz_billing';
  var $tbl_bill_elements='care_tz_billing_elem';
  var $tbl_lab_param='care_tz_laboratory_param';
  var $tb_drug_list='care_tz_druglist';
  var $tbl_lab_requests='care_test_request_chemlabor';
  var $fields_tbl_bill_elements=array (
                  'nr',
                  'date_change',
                  'is_labtest',
                  'is_medicine',
                  'is_comment',
                  'is_paid', 
                  'amount',
                  'description');
                  
  var $result;
  var $sql;
  var $debug;
  var $records;
  var $parameter_array;
  var $index;
  var $value;
  var $chemlab_testindex;
  var $chemlab_testname;
  var $chemlab_amount;
  var $price;
  var $medical_item_name;
  var $medical_item_amount;
  
  //------------------------------------------------------------------------------
  
  // Constructor
  function Bill() {
  }
  
  // Methods:
  
  /******************************************************************************
  *  PRIVATE
  **/
  
  function _GetPendingResults($encounter_nr=FALSE) {
    /*
    * This private method goes through the main tables and returns an
    * result array (adodb) with hits or FALSE
    *
    * Definition of a pending bill:
    *   ************************************************************************
    *   ** A pending bill is a record that is not given by the billing table  **
    *   ** care_tz_billing (encounter_nr) but there are entries in the tables **
    *   ** care_test_request_chemlabor (encounter_nr) and                     **
    *   ** care_encounter_prescription (encounter_nr)                         **
    *   ************************************************************************    
    *  if $encounter_nr is set, then this private function just returns the
    *  records for this encounter. Default is FALSE for this value and this
    *  method returns a list of all
    */
    
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;    
  }
  
  /******************************************************************************
  *  PUBLIC
  **/

  function GetFirstPid() {
    global $db, $root_path;
    /*
    * Definition of a pending bill:
    *   ************************************************************************
    *   ** A pending bill is a record that is not given by the billing table  **
    *   ** care_tz_billing (encounter_nr) but there are entries in the tables **
    *   ** care_test_request_chemlabor (encounter_nr) and                     **
    *   ** care_encounter_prescription (encounter_nr)                         **
    *   ************************************************************************    
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0',
                    PRIMARY KEY ( `encounter_nr` )
                    ) TYPE = MyISAM;";
      $this->results = $db->Execute($this->sql);

    // ------> Section Chemlab <----------------
    // insert all entries of care_test_request_chemlab into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr)
                      SELECT  
                          	ctrc.encounter_nr as encounter_nr
                          FROM $this->tbl_lab_requests ctrc  
                            LEFT JOIN $this->tbl_bill ctb 
                            ON ctrc.encounter_nr = ctb.encounter_nr 
                            GROUP BY ctb.encounter_nr";    
    $this->results = $db->Execute($this->sql);
    
    // ------> Section Prescriptions <----------------
    // insert all entries of care_encounter_prescription into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr) 
                  SELECT 
                  	cep.encounter_nr as encounter_nr 
                  FROM care_encounter_prescription cep 
                  	LEFT JOIN care_tz_billing ctb 
                  		ON cep.encounter_nr = ctb.encounter_nr
                  GROUP BY ctb.encounter_nr";
    $this->results = $db->Execute($this->sql);
    
    // --------> final result <---------------
    // get the first encounter_nr out of the temporary billing table, that
    // is what we need!
    $this->sql = "SELECT ce.pid AS PID FROM tmp_care_tz_billing 
                	INNER JOIN care_encounter ce
                		ON ce.encounter_nr = tmp_care_tz_billing.encounter_nr
                  ORDER BY ce.encounter_nr DESC LIMIT 1";
    $this->results = $db->Execute($this->sql);
		if($this->first_pn=$this->results->FetchRow()) {
    	return $this->first_pn['PID'];
  	} else {
  	  return FALSE;
  	}
  }

  //------------------------------------------------------------------------------  
  function getAllEncounters() {
		global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;		
    if ($this->debug) echo "<br><b>statement from Method: class_tz_billing::GetAllEncounters:</b><br>"; 
		$this->sql="SELECT 
            encounter_nr
    FROM care_encounter
    
    ORDER BY encounter_nr DESC";						              
    
		$this->result=$db->Execute($this->sql);
		$i=0;
		while($encounters=$this->result->FetchRow()) {
			$enc_array[$i] = $encounters['encounter_nr'];
    	$i++;
  	}
  	return $enc_array;
	}
  //------------------------------------------------------------------------------  
  
  function GetAllEncountersOfPendingBills() {
    /**
    * This is e.g. for the left side navigation include
    */
    global $db, $root_path;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    /**
    * This function returns TRUE if there are some new items for that encounter number
    * that should be transfered into the billing table
    *
    **/
    
    if ($this->debug) echo "<b>class_tz_billing::GetAllEncountersOfPendingBills($encounter_nr)</b><br>";
    
    // include here the always repeading sql-statements to find out the pending bills:
    require($root_path."modules/billing_tz/inc_basic_statements/inc_temp_pending_bills_sql.php");
    
    $this->sql = "DROP TABLE tmp_care_tz_billing";
    $db->Execute($this->sql);
    
    return $this->results;
    
  }
  
  //------------------------------------------------------------------------------  
  
  function PendingBillObjects($encounter_nr) {
    global $db, $root_path;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    /**
    * This function returns TRUE if there are some new items for that encounter number
    * that should be transfered into the billing table
    *
    **/
    
    if ($this->debug) echo "<b>class_tz_billing::PendingBillObjects($encounter_nr)</b><br>";
    
    if (empty($encounter_nr)) {
      return FALSE;
    }

      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0',
                    PRIMARY KEY ( `encounter_nr` )
                    ) TYPE = MyISAM;";
      $this->results = $db->Execute($this->sql);

    // ------> Section Chemlab <----------------
    // insert all entries of care_test_request_chemlab into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr)
                      SELECT  
                          	ctrc.encounter_nr as encounter_nr
                          FROM $this->tbl_lab_requests ctrc  
                            LEFT JOIN $this->tbl_bill ctb 
                            ON ctrc.encounter_nr = ctb.encounter_nr 
                            AND ctrc.encounter_nr=".$encounter_nr."
                            GROUP BY ctb.encounter_nr";    
    $this->results = $db->Execute($this->sql);
    
    // ------> Section Prescriptions <----------------
    // insert all entries of care_encounter_prescription into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr) 
                  SELECT 
                  	cep.encounter_nr as encounter_nr 
                  FROM care_encounter_prescription cep 
                  	LEFT JOIN care_tz_billing ctb 
                  		ON cep.encounter_nr = ctb.encounter_nr
                  WHERE cep.encounter_nr=".$encounter_nr." 
                  GROUP BY ctb.encounter_nr";
    $this->results = $db->Execute($this->sql);
    
    
    $this->sql = "SELECT encounter_nr FROM tmp_care_tz_billing where encounter_nr='".$encounter_nr."'";
    $this->result=$db->Execute($this->sql);
    
    if ($this->result->RecordCount()) {
      $this->sql="DROP TABLE tmp_care_tz_billing";
      $db->Execute($this->sql);
      if ($this->debug) echo "...there are generally pending bills for this encounter...<br>";
      return TRUE; // The item is still in this table
    } else {
      $this->sql="DROP TABLE tmp_care_tz_billing";
      $db->Execute($this->sql);
      if ($this->debug) echo "...NO PENDING BILLS FOR THIS ENCOUNTER...<br>";
      return FALSE; // There is no item with this encounter_nr in the table
    }
  }
  
  //------------------------------------------------------------------------------  
  
  function CreateNewBill($encounter_nr) {
    global $db;
    /**
    * Returns the ident bill number 
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::CreateNewBill()</b><br>";
    $this->sql = "INSERT INTO care_tz_billing (encounter_nr, first_date, create_id) VALUES ('".$encounter_nr."','".time()."','') ";    
    $this->request = $db->Execute($this->sql);
    return $db->Insert_ID();
  }
  
  //------------------------------------------------------------------------------  
  
  function GetPendingLaboratoryBills($encounter_nr) {
    global $db, $root_path;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0',
                    PRIMARY KEY ( `encounter_nr` )
                    ) TYPE = MyISAM;
                ";
      $this->results = $db->Execute($this->sql);

    // ------> Section Chemlab <----------------
    // insert all entries of care_test_request_chemlab into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr)
                      SELECT  
                          	ctrc.encounter_nr as encounter_nr
                          FROM $this->tbl_lab_requests ctrc  
                            LEFT JOIN $this->tbl_bill ctb 
                            ON ctrc.encounter_nr = ctb.encounter_nr 
                            GROUP BY ctb.encounter_nr";    
    $this->results = $db->Execute($this->sql);
    
    
    // now we have all pending bills in this temporary table. The next step is to find out
    // what encounters are for laboratory and if there is this encounter_nr in it.
    
    $this->sql = "SELECT tmp_care_tz_billing.encounter_nr FROM tmp_care_tz_billing 
                    LEFT JOIN care_test_request_chemlabor ctrc 
                        ON ctrc.encounter_nr=tmp_care_tz_billing.encounter_nr
                  where tmp_care_tz_billing.encounter_nr=".$encounter_nr." 
                  GROUP BY tmp_care_tz_billing.encounter_nr";

    $this->result = $db->Execute($this->sql);
    
    $this->sql = "DROP TABLE tmp_care_tz_billing";
    $db->Execute($this->sql);
    
    return ($this->result) ? $this->result : FALSE;
  }

	//------------------------------------------------------------------------------  
	
	function GetPendingPrescriptionBills($encounter_nr) {
    global $db, $root_path;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

    // include here the always repeading sql-statements to find out the pending bills:
    // require($root_path."modules/billing_tz/inc_basic_statements/inc_temp_pending_bills_sql.php");

      $this->sql = "CREATE TEMPORARY TABLE 
                         tmp_care_tz_billing 
                    (
                   `encounter_nr` BIGINT ( 20 ) NOT NULL DEFAULT '0',
                    PRIMARY KEY ( `encounter_nr` )
                    ) TYPE = MyISAM;";
      $this->results = $db->Execute($this->sql);

    
    // ------> Section Prescriptions <----------------
    // insert all entries of care_encounter_prescription into temporary billing table
    $this->sql = "INSERT INTO tmp_care_tz_billing (encounter_nr) 
                  SELECT 
                  	cep.encounter_nr as encounter_nr 
                  FROM care_encounter_prescription cep 
                  	LEFT JOIN care_tz_billing ctb 
                  		ON cep.encounter_nr = ctb.encounter_nr
                  WHERE cep.encounter_nr=".$encounter_nr." 
                  GROUP BY ctb.encounter_nr";
    $this->results = $db->Execute($this->sql);
    


    $this->sql = "SELECT tmp_care_tz_billing.encounter_nr FROM tmp_care_tz_billing 
                    LEFT JOIN care_encounter_prescription cep 
                        ON cep.encounter_nr=tmp_care_tz_billing.encounter_nr
                  where tmp_care_tz_billing.encounter_nr=".$encounter_nr."
                  GROUP BY tmp_care_tz_billing.encounter_nr";

    $this->result = $db->Execute($this->sql);
    
    $this->sql = "DROP TABLE tmp_care_tz_billing";
    $db->Execute($this->sql);
    
    return ($this->result) ? $this->result : FALSE;
	}
	//------------------------------------------------------------------------------  
	
	function StoreToPendingBills($requests,$bill_number,$kind_of){
	  
	  /**
	  * Class to store the pending items into the billing table.
	  * Note that the $request should have following informations:
	  * encounter_nr , parameters and price
	  */
	  global $db;
	  $this->debug=FALSE;
	  if ($this->debug) echo "<b>class_tz_billing::StoreToPendingBills($requests,$bill_number,$kind_of)</b><br>";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b> class_tz_billing::StoreToPendingBills($requests,$bill_number,$kind_of)</b><br>";
    if (empty($kind_of)) {
      if ($this->debug) echo "<b> NO KIND-OF PARAMETER IS GIVEN!!</b><br>";
      return FALSE;
    }

		$requests->MoveFirst();
		$enc=0;
		$current_encounter="";
		
		if ($kind_of=="laboratory") {
		  if ($this->debug) echo "  <h1>...this is a laboratory item</h1><br>";
		  if ($this->debug) echo "  ...we have ".$requests->RecordCount()." items to manage<br>";
		  while ($this->records=$requests->FetchRow()) {
		    if ($this->debug) echo "<b>".$this->records[0]."</b><br>";
		    // get the parameter string of the laboratory tasks...
		    $this->sql = "select 
		                          encounter_nr, 
		                          parameters 
		                  FROM care_test_request_chemlabor
                      WHERE encounter_nr=".$this->records[0]." 
                      GROUP BY encounter_nr";
        $this->parameters = $db->Execute($this->sql);
        if ($this->records=$this->parameters->FetchRow()) {
          if ($this->debug) echo $this->records['parameters']."<br>";
          parse_str($this->records['parameters'],$this->parameter_array);
          while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
      				//Strip the string baggage off to get the task id
      				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
              $this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
              $this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
              if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount."<br>";
              // we have it all... now we store it into the billing-elements-table
              $this->sql ="INSERT INTO care_tz_billing_elem (nr, date_change, is_labtest, is_medicine, amount, price, description)
  									 			VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$this->chemlab_testname."')";
  					  $db->Execute($this->sql);
  									 			
    			  }          
        }
		  }
		}
		
		if ($kind_of=="prescription") {
		  if ($this->debug) echo "  <h1>...this is a prescription item</h1><br>";
		  if ($this->debug) echo "  ...we have ".$requests->RecordCount()." items to manage<br>";		  
		  if ($this->records=$requests->FetchRow()) {
		    if ($this->debug) echo "<b>".$this->records[0]."</b><br>";
		    // get the parameter string of the laboratory tasks...
		    $this->sql = "select 
		                          encounter_nr, 
		                          article,notes,
		                          dosage,
		                          price
		                  FROM care_encounter_prescription
                      WHERE encounter_nr=".$this->records[0];
        $this->parameters = $db->Execute($this->sql);
        while ($this->records=$this->parameters->FetchRow()) {
          if ($this->debug) echo $this->records['article']."<br>";
          $this->medical_item_name  =$this->records['article'];
          $this->medical_item_name  .= "(".$this->records['notes'].")";
          $this->medical_item_amount=$this->records['dosage'];
          $this->price              =$this->records['price'];
          // The amount of this medical item could be translated into the real amount...
          $this->medical_item_amount = $this->ConvertMedicalItemAmount($this->medical_item_amount);
          $this->sql ="INSERT INTO care_tz_billing_elem (nr, date_change, is_labtest, is_medicine, amount, price, description)
								 			VALUES (".$bill_number.",".time().",0,1,'".$this->medical_item_amount."','".$this->price."','".$this->medical_item_name."')";
				  $db->Execute($this->sql);          
        }
      }
		}
		
	  return TRUE;
	}
	
	//------------------------------------------------------------------------------
	
	function ConvertMedicalItemAmount ( $amount ) {
	  return $amount;
	}

  //------------------------------------------------------------------------------

  function GetPriceOfItem($item_number) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT unit_price as price FROM $this->tb_drug_list WHERE item_id = '$item_number' ";
    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;
		            return $v['price'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetPriceOfItem($item_number) 
  
  //------------------------------------------------------------------------------
  
  function GetPrescriptionDetails() {
  }
  
  //------------------------------------------------------------------------------

  function GetNameOfItem($item_number) {
    global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
    $this->sql="SELECT item_description as description FROM $this->tb_drug_list WHERE item_id = '$item_number' ";
    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;
		            return $v['description'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetNameOfDrug($item_number) 
  
  //------------------------------------------------------------------------------
  
  function GetBillNumbersFromPID($pid) {
  	global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
  	$this->sql="SELECT cb.nr FROM ".$this->tbl_bill." cb, ".$this->tbl_bill_elements." cbe, care_encounter ce, care_person cp
					 WHERE cb.encounter_nr = ce.encounter_nr
					 AND ce.pid = cp.pid
					 AND cbe.nr = cb.nr
					 AND cp.pid = $pid
					 GROUP BY cb.nr";
		return $db->Execute($this->sql);
	}
  
  //------------------------------------------------------------------------------

  function VerifyBill($bill_nr) {
  	global $db;
  	$this->sql="SELECT nr FROM ".$this->tbl_bill." WHERE nr=".$bill_nr;
		return $db->Execute($this->sql);
	}
  
  //------------------------------------------------------------------------------

  
  function GetElemsOfBill($nr,$what_kind_of) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  	if ($what_kind_of=="prescriptions")
  	  $sql_where = " AND is_medicine=1 ";

  	if ($what_kind_of=="laboratory")
  	  $sql_where = " AND is_labtest=1 ";

  	  
  	$this->sql="SELECT * FROM ".$this->tbl_bill_elements."
					 WHERE nr = ".$nr." ".$sql_where."
					 ORDER BY date_change ASC";
		return $db->Execute($this->sql);
	}
	
	//------------------------------------------------------------------------------
	
	function GetNameOfLAboratoryFromID($id)	{
		global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;		
  	$this->sql="SELECT name FROM ".$this->tbl_lab_param."
					 WHERE id = '".$id."'";
		$this->result = $db->Execute($this->sql);
		if ($this->records=$this->result->FetchRow())
  		return $this->records['name'];
	}
	
	//------------------------------------------------------------------------------

	function GetPriceOfLAboratoryItemFromID($id)	{
		global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;		
  	$this->sql="SELECT price FROM ".$this->tbl_lab_param."
					 WHERE id = '".$id."'";
		$this->result = $db->Execute($this->sql);
		if ($this->records=$this->result->FetchRow())
  		return $this->records['price'];
	}
	
	//------------------------------------------------------------------------------
	
	function DisplayBillHeadline($bill_nr, $batch_nr) {
	  
	  $enc_obj = New Encounter;
	  $encoded_batch_number = $enc_obj->ShowPID($batch_nr);
	  $enc_number = $enc_obj->GetBatchFromEncounterNumber($batch_nr);
	  
		

	  
	  if ($enc_obj->EncounterExists($enc_number)) {
	    // Load the encounter data:
	    $enc_data = $enc_obj->loadEncounterData($enc_number);
  	  
  	  echo '		
  	  <table border="0" cellspacing=1 cellpadding=0 width="50%">
  				<tr>
  					<td class="adm_item"><b>Batch file no.</b></td>
  					<td class="adm_item"><b>'.$encoded_batch_number.'</b></td>
  					<td rowspan="7">&nbsp;<td>
  				</tr>
  				<tr>
  					<td class="adm_item">Surname/Ukoo:</td>
  					<td bgcolor="#ffffee" class="vi_data"><b>'.$enc_obj->LastName($enc_number).'</b></td>
  				</tr>
  				<tr>
  					<td class="adm_item">First name:</td>
  					<td bgcolor="#ffffee" class="vi_data">'.$enc_obj->FirstName($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item">Trade:</td>
  					<td bgcolor="#ffffee" class="vi_data">'.$enc_obj->Trade($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item">Date of birth:</td>
  					<td bgcolor="#ffffee" class="vi_data">'.$enc_obj->BirthDate($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item">Sex:</td>
  					<td class="adm_input">'.$enc_obj->Sex($enc_number).'</td>
  				</tr>
  				<tr>
  					<td class="adm_item"><b>Bill Number:</b></td>
  					<td class="adm_item"><b>'.$bill_nr.'</b></td>
  				</tr>
  				
  		</table>';
      return TRUE;	  
    }
  return FALSE;
	} 
	
	//------------------------------------------------------------------------------  
	
	function DisplayLaboratoryBill($bill_nr,$edit_fields) {

  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Laboratory</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo ($edit_fields) ? 'Edit this' : 'Already paid?';
      				echo '</b><td>
      			</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_labtest']==1)
      				{
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";
      					
      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td>'.$pos_nr.'</td>
        				<td>'.$this->chemlab_testname.'</td>
        				<td>'.$this->price.'</td>
        				<td>'.$bill_elems_row['amount'].'</td>
        				<td>'.number_format($part_sum,2,',','.').'</td>
        				<td>
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes</td></tr>";
        				}
        				else
        				{
        					echo "No</td></tr>";
        					$sum_to_pay += $part_sum;
        				}

      				
      			}

      			echo '
      			
      			<tr>
      			  <td colspan="3">&nbsp;</td>
      				<td><b>Sum:</b></td>      			
      				<td><b>'.number_format($sum,2,',','.').'</b></td>
      				<td>&nbsp;</td>
      			</tr>';

      			echo '
      			<tr>
      			  <td colspan="3">&nbsp;</td>
      				<td><b>Sum to pay:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b></td>
      				<td><b>&nbsp;</b></td>       			
      				
      			</tr>';
      			echo '</table>';
      			echo '
      		</td>
      	</tr>';
      	
  	echo'
  	</table>';
	  
	}
	
	//------------------------------------------------------------------------------  
	
	function DisplayPrescriptionBill($bill_nr, $edit_fields){
  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Prescriptions</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfBill($bill_nr,"prescriptions");
      			
      			echo '<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>Already paid?</b><td>
      			</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					//$task_arr = $this->GetTaskDataFromID($bill_elems_row['description']);
      					$desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				}
      				$part_sum = ($price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td>'.$pos_nr.'
      				  </td>
        				<td>'.$desc.'
        				</td>
        				<td>'.$price.'
        				</td>
        				<td>'.$bill_elems_row['amount'].'
        				</td>
        				<td>'.number_format($part_sum,2,',','.').'
        				</td>
        				<td>
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes";
        				}
        				else
        				{
        					echo "No";
        					$sum_to_pay += $part_sum;
        				}
        				echo '
      				</td>
      				</tr>';
      				
      			}
      			echo '
      			<tr>
      				<td colspan="3">&nbsp;</td>
      				<td><b>Sum:</b></td>
      				<td><b>'.number_format($sum,2,',','.').'</b></td>
      				<td>&nbsp;</td>
      			</tr>';

      			echo '
      			<tr>
      				<td colspan="3">&nbsp;</td>
      				<td><b>Sum to pay:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b></td>
      				<td>&nbsp;</td>
      			</tr>';
      			echo '</table>';
      			echo '
      		</td>
      	</tr>';
  	echo'
  	</table>';
	  
	  return TRUE;
	}


//------------------------------------------------------------------------------  
	

	function DisplayBills($batch_nr, $specific_bill, $edit_fields) {
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
		*/
		global $db;
		//if($edit_fields) echo '<form method="post" action="#" name="edit_bill">';
  	echo '
  	<table width="800" border="1">

  		';
  		if($specific_bill>0)
  		{
  			$billnumbers=$this->VerifyBill($specific_bill);
  		}
  		else
  		{
  			$billnumbers=$this->GetBillNumbersFromPID($batch_nr);
  		}
  		while($bills=$billnumbers->FetchRow())	
  		{ 
				echo '
					<tr>
						<td>';
						$this->DisplayBillHeadline($bills['nr'], $batch_nr);
						echo '
						</td>
					</tr>';
  			$sum_to_pay =0;
  			$sum = 0;
  			
  			$billelems=$this->GetElemsOfBill($bills['nr'],"laboratory");
				if($bill_elems_row=$billelems->FetchRow())
				{			
	  			echo '
	  			<tr>
	  				<td valign="top">';
	  					$this->DisplayLaboratoryBill($bills['nr'],$edit_fields);
	      	echo '
	      		</td>
	      	</tr>';
      	}
      	$billelems=$this->GetElemsOfBill($bills['nr'],"prescriptions");
				if($bill_elems_row=$billelems->FetchRow())
				{
					echo '
	  			<tr>
	  				<td valign="top">';
	  					$this->DisplayPrescriptionBill($bills['nr'],$edit_fields);
	      		echo '
	      		</td>
	      	</tr>';
      	}
      	
      	// is there the edit_fields flag set, then there should be finished the formular with the submit button. 
      	// If not, then show the three kinds of the main folder.
      	echo '
			    <tr>
			  		<td>
			        <a href="javascript:printOut()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" width="99" height="24" alt="Print this form"></a> 
			        <a href="pharmacy_tz_pending_prescriptions.php?&mode=done&pn='.$pn.'&prescription_date='.$prescription_date.'>"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="It´s done! Move the form to the archive"></a>
			        <a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="absmiddle" width="120" height="24"></a>
			  		</td>
			  	</tr>';
  		}
  	echo'

  	</table>';
	  //if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}
	
	//------------------------------------------------------------------------------  
	

}
	
?>