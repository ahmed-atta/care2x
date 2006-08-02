<?PHP

require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');

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
    `---> Class Notes
              |
              `--->Class Encounter
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
  
  var $tbl_bill_archive='care_tz_billing_archive';
  var $tbl_bill_archive_elements='care_tz_billing_archive_elem';
  
  
  var $tbl_lab_param='care_tz_laboratory_param';
  var $tb_drug_list='care_tz_druglist';
  var $tbl_prescriptions='care_encounter_prescription';
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
  var $item_number;
  
  
  //------------------------------------------------------------------------------
  
  // Constructor
  function Bill() {
  }
  
  // Methods:
  
  /******************************************************************************
  *  PRIVATE
  **/

  
  function _check_tbl_exists($tbl_name) {
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;        
      $this->sql="SELECT * FROM $tbl_name LIMIT 0";
      return ($db->Execute($this->sql)) ? true : false;
  }

  function _delete_tbl($tbl_name) {
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;        
      $this->sql="DROP TABLE $tbl_name";
      return ($db->Execute($this->sql)) ? true : false;
  }


  //------------------------------------------------------------------------------    

  
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
    
    /* 
    * Note: 10.June 2005 by RM: This is an old function out of an billing experiment,
    * there is the possibility that this function is not working correctely but I haven't 
    * fond an error right now. Never touch a running and working routine... But:
    * If there is a need for it, please replace this function and note that there are
    * now flags in the pending encounter and laboratory table to determine this result.
    * This function should return the first pid what could have pending bills.
    */
    
    
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
		$this->sql="SELECT 
							care_person.selian_pid,
							care_person.pid,
              name_first, 
              name_last, 
              bi.encounter_nr,
              bi.first_date,
              care_person.pid as batch_nr
      FROM care_encounter, care_person, care_tz_billing bi, care_tz_billing_elem biel 
      WHERE care_encounter.pid = care_person.pid 
            AND bi.encounter_nr = care_encounter.encounter_nr
            AND biel.nr = bi.nr
            
      group by batch_nr
      ORDER BY batch_nr ASC LIMIT 1";	
    $this->results = $db->Execute($this->sql);
		if($this->first_pn=$this->results->FetchRow()) {
    	return $this->first_pn['pid'];
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
  
  function CheckForPendingBill($encounter_nr) {
    /**
    * returns TRUE if there is a pending Bill existing for this encounter
    */
    global $db;
    $this->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::CheckForExistingBill($encounter_nr)</b><br>";
    $this->sql="select encounter_nr FROM care_tz_billing where encounter_nr=$encounter_nr LIMIT 0,1";
    $this->result=$db->Execute($this->sql);
    
    return ($this->result->RecordCount())? TRUE : FALSE;
  }

  
  //------------------------------------------------------------------------------  
  
  function PendingBillObjects($encounter_nr) {
    /**
    * returns TRUE if at least one item in the billing table are missing...
    */
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::GetPendingObjects($encounter_nr)</b><br>";
    // prescription:
    // read all items out of the prescription table where no bill_number is given for this encounter
    $this->sql = "select 
                  	article_item_number 
                  from $this->tbl_prescriptions
                  where bill_number = 0 AND encounter_nr=".$encounter_nr;
    $this->result=$db->Execute($this->sql); 
    if ($this->result->RecordCount()>0) 
      return TRUE;
      
    //laboratory:
    // read all items out of the laboratory table where no bill_number is given for this encounter
    $this->sql="select 
                        encounter_nr 
                FROM 
                  $this->tbl_lab_requests
                where bill_number = 0 AND encounter_nr=".$encounter_nr;
		// echo $this->sql;                
    $this->result=$db->Execute($this->sql); 
    if ($this->result->RecordCount()>0) 
      return TRUE;

    return FALSE; // We have nothing to do... no pending issues in the tables!                
                
  }
  
  //------------------------------------------------------------------------------  
 
  function DisplayArchivedBillHeadlines() {
    global $db;
    $enc_obj = New Encounter;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::DisplayArchivedBillHeadlines</b><br>";    
    $this->sql="SELECT `nr`, `encounter_nr`, `first_date` FROM care_tz_billing_archive order by first_date DESC";
    $this->request=$db->Execute($this->sql);
    $color_change=FALSE;
    while ($this->res=$this->request->FetchRow()) {

      if ($color_change) {
        $BGCOLOR='bgcolor="#ffffdd"';
        $color_change=FALSE;
      } else {
        $BGCOLOR='bgcolor="#ffffaa"';
        $color_change=TRUE;
      }
  	  //$encoded_batch_number = $enc_obj->ShowPID($batch_nr);
  	  $enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);      
  	  
      $this->bill_number=$this->res['nr'];
      $this->encounter_number=$this->res['encounter_nr'];
      $this->batch_number=$enc_obj->GetBatchFromEncounterNumber($this->encounter_number);
      $this->date=$this->res['first_date'];
      $enc_data = $enc_obj->loadEncounterData($this->encounter_number);
  		echo '<script language="javascript" >
            <!-- 
            function printOut_'.$this->bill_number.'()
            {
            	urlholder="show_bill.php?bill_number='.$this->bill_number.'&batch_nr='.$this->batch_number.'&printout=TRUE&show_archived_bill=TRUE";
            	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
              
            }
            // -->
            </script> 
            ';

      echo '<tr>
  					  <td '.$BGCOLOR.'><div align="center"><a href="javascript:printOut_'.$this->bill_number.'()">'.$this->bill_number.'</a></div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.date("d.m.Y",$this->date).'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$enc_obj->ShowPID($this->batch_number).'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$this->encounter_number.'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$enc_obj->FirstName($enc_data).' '.$enc_obj->LastName($enc_data).'</div></td>
  					</tr> ';
    }
  }
  
  
  //------------------------------------------------------------------------------  
  
  function GetBill($encounter_nr) {
    global $db;
    /**
    * Returns the ident bill number 
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetBill()</b><br>";
    $this->sql = "SELECT nr FROM $this->tbl_bill WHERE encounter_nr=".$encounter_nr." limit 0,1 ";    
    $this->request = $db->Execute($this->sql);
    if ($this->result=$this->request->FetchRow())
      return $this->result[0];
    
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
  	function StoreToBill($encounter_nr, $bill_number){
	  global $db;
	  $this->debug=FALSE;
	  if ($this->debug) echo "<b>class_tz_billing::StoreToBill(encounter_nr: $encounter_nr, bill_number: $bill_number)</b><br>";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    // do we have pending issues of prescriptions?
    // read all items out of the prescription table
    $this->sql = "select 
                  	article_item_number,
                    article,
                    notes,
                    dosage,
                    price
                  from $this->tbl_prescriptions
                  where bill_number = 0 AND encounter_nr=".$encounter_nr;
    $this->result=$db->Execute($this->sql); 
    while ($this->records=$this->result->FetchRow()) {        
        $this->item_number=$this->records['article_item_number'];
        $this->medical_item_name  =$this->records['article'];
        $this->medical_item_name  .= "(".$this->records['notes'].")";
        $this->medical_item_amount=$this->records['dosage'];
        $this->price              =$this->records['price'];
        // The amount of this medical item could be translated into the real amount...
        $this->medical_item_amount = $this->ConvertMedicalItemAmount($this->medical_item_amount);
        $this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, amount_doc, price, description)
							 			VALUES (".$bill_number.",".time().",0,1,'".$this->medical_item_amount."','".$this->medical_item_amount."','".$this->price."','".$this->medical_item_name."')";
			  $db->Execute($this->sql);          
  
        // Mark these lines in the table prescription as "still billed". We can do this
        // in that way: Insert the billing number where we can find this article again...
        $this->sql="UPDATE $this->tbl_prescriptions SET bill_number='".$bill_number."', bill_status='pending' WHERE bill_number = 0 AND encounter_nr=".$encounter_nr;
        $db->Execute($this->sql);
    }
    
    // And now the laboratory...
    $this->sql = "select 
                          encounter_nr, 
                          parameters 
                  FROM $this->tbl_lab_requests
                  WHERE encounter_nr=".$encounter_nr." AND bill_number = 0";
    $this->parameters = $db->Execute($this->sql);
    while ($this->records=$this->parameters->FetchRow()) {
      if ($this->debug) echo $this->records['parameters']."<br>";
      parse_str($this->records['parameters'],$this->parameter_array);
      while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
  				//Strip the string baggage off to get the task id
  				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
          $this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
          $this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
          if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount."<br>";
          // we have it all... now we store it into the billing-elements-table
          $this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, price, description)
								 			VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$this->chemlab_testname."')";
				  $db->Execute($this->sql);
								 			
			  }          
    }
    // Mark these lines in the table prescription as "still billed". We can do this
    // in that way: Insert the billing number where we can find this article again...
    $this->sql="UPDATE $this->tbl_lab_requests SET bill_number='".$bill_number."' , bill_status='pending' WHERE bill_number = 0 AND encounter_nr=".$encounter_nr;
    $db->Execute($this->sql);

	}
	
	function StorePrescriptionItemToBill($pid, $prescriptions_nr, $bill_number, $price, $dosage, $notes, $insurance){
	  global $db, $root_path;
	  $this->debug=FALSE;
	  if ($this->debug) echo "<b>class_tz_billing::StorePrescriptionItemToBill(prescriptions_nr: $prescriptions_nr, bill_number: $bill_number)</b><br>";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
	  require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
	  $insurance_tz = New Insurance_tz();
	  $contract = $insurance_tz->CheckForValidContract($pid); 
    // do we have pending issues of prescriptions?
    // read all items out of the prescription table
    $this->sql = "
    INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, amount_doc, price, description, notes, balanced_insurance, insurance_id, prescriptions_nr)
    SELECT '".$bill_number."', '".time()."' AS date_change, 0, 1, '".$dosage."', dosage, price, article, '".$notes."', '".$insurance."', '".$contract['id']."', '".$prescriptions_nr."'
    FROM $this->tbl_prescriptions WHERE nr = $prescriptions_nr";
    $this->result=$db->Execute($this->sql); 
	
	}
	
	
	//------------------------------------------------------------------------------  

	function StoreLaboratoryItemToBill($pid, $batch_nr, $bill_number, $insurance){
	  global $db, $root_path;
	  $this->debug=false;
	  if ($this->debug) echo "<b>class_tz_billing::StorePrescriptionItemToBill(prescriptions_nr: $prescriptions_nr, bill_number: $bill_number)</b><br>";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    // do we have pending issues of prescriptions?
    // read all items out of the prescription table
    $this->sql = "select 
                          encounter_nr, 
                          parameters 
                  FROM $this->tbl_lab_requests
                  WHERE batch_nr=".$batch_nr;
    $this->parameters = $db->Execute($this->sql);
    while ($this->records=$this->parameters->FetchRow()) {
      if ($this->debug) echo $this->records['parameters']."<br>";
      parse_str($this->records['parameters'],$this->parameter_array);
      while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
  				//Strip the string baggage off to get the task id
  				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
          $this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
          $this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
          if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount." and a price of ".$this->price."<br>";
          require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
		  $insurance_tz = New Insurance_tz();
		  $contract = $insurance_tz->CheckForValidContract($pid); 
          // we have it all... now we store it into the billing-elements-table
          $this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, price, balanced_insurance, insurance_id, description)
								 			VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$insurance."','".$contract['id']."','".$this->chemlab_testname."')";
				  $db->Execute($this->sql);
				  $insurance=0;
			  }          
    }
    // Mark these lines in the table prescription as "still billed". We can do this
    // in that way: Insert the billing number where we can find this article again...
    $this->sql="UPDATE $this->tbl_lab_requests SET bill_number='".$bill_number."' , bill_status='pending' WHERE batch_nr=".$batch_nr;
    $db->Execute($this->sql);
	}
	
	
	//------------------------------------------------------------------------------  
	
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

  function GetArchivedBill($bill_nr) {
  	global $db;
  	$this->sql="SELECT nr FROM care_tz_billing_archive WHERE nr=".$bill_nr;
		return $db->Execute($this->sql);
	}


  //------------------------------------------------------------------------------

  function VerifyBill($bill_nr) {
  	global $db;
  	$this->sql="SELECT nr FROM ".$this->tbl_bill." WHERE nr=".$bill_nr;
  	//echo $this->sql;
		return $db->Execute($this->sql);
	}
  

  //------------------------------------------------------------------------------

  
  function GetElemsOfArchivedBill($nr,$what_kind_of) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  	if ($what_kind_of=="prescriptions")
  	  $sql_where = " AND is_medicine=1 ";

  	if ($what_kind_of=="laboratory")
  	  $sql_where = " AND is_labtest=1 ";

  	  
  	$this->sql="SELECT * FROM care_tz_billing_archive_elem
					 WHERE nr = ".$nr." ".$sql_where."
					 ORDER BY date_change ASC";
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
	

  function GetElemsOfBillByPrescriptionNr($nr) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  
  	$this->sql="SELECT * FROM ".$this->tbl_bill_elements."
					 WHERE prescriptions_nr = ".$nr;
		return $db->Execute($this->sql);
	}
	
	//------------------------------------------------------------------------------
	
  function GetElemsOfBillByPrescriptionNrArchive($nr) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  
  	$this->sql="SELECT * FROM ".$this->tbl_bill_archive_elements."
					 WHERE prescriptions_nr = ".$nr;
					 //echo $this->sql;
		return $db->Execute($this->sql);
	}
	
	//------------------------------------------------------------------------------
	
  function GetBillByBatchNr($nr) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  
  	$this->sql="SELECT bill_number FROM care_test_request_chemlabor WHERE batch_nr=$nr";
  	$this->result= $db->Execute($this->sql);
		return $this->result->FetchRow();
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
	  $enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);
	  
		

	  
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
  					<td class="adm_item">Encounter/Reg.Nr.:</td>
  					<td bgcolor="#ffffee" class="vi_data"><b>'.$enc_number.'</b></td>
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
	
	function DisplayArchivedLaboratoryBill($bill_nr,$edit_fields) {
		
    global $root_path;
    $sum_price=0;

  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Laboratory</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfArchivedBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>' .
      				'<td><b>Paid by Insurance</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo 'Already paid?';
      				echo '</b><td>';
      				//if ($edit_fields) echo "<td>Edit</td>";
              echo '</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";
      					
      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'</td>
        				<td width="200">'.$this->chemlab_testname.'</td>
        				<td width="100">'.$this->price.'</td>
        				<td width="100">'.$bill_elems_row['amount'].'</td>' .
        				'<td width="100">';
        				if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,',','.');
        				else echo '0,00';
						echo '</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'</td>
        				<td width="100">
        				';
        				if($bill_elems_row['is_paid']==1)
        				{ 
        					echo "Yes</td>";
        				}
        				else
        				{
        					echo "No</td>";
        					$sum_to_pay += $part_sum;
        				}
        				echo "<td>&nbsp;</td>";
        				//if ($edit_fields) echo '<td><a href="billing_tz_edit.php?mode=edit_elem&billing_item='.$this->tbl_bill_elem_ID.'"><img src="'.$root_path.'gui/img/common/default/bul_arrowgrnsm.gif" border="0"></td>';
                echo "</tr>";
      				
      			}

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><b>open item accounting:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>======</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			
      			echo '</table>';
      			echo '
      	  </td>
      	</tr>';
      	
  	echo'
  	</table>';
	  
	}	
	
	//------------------------------------------------------------------------------  
	
	function DisplayLaboratoryBill($bill_nr,$edit_fields) {
		
		global $root_path, $billnr, $batch_nr;
    $sum_price=0;

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
      				<td><b>Amount</b></td>' .
      				'<td><b>Paid by Insurance</b></td>
      				<td><b>part. sum</b></td>
      			</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";
      					
      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'</td>
        				<td width="200">'.$this->chemlab_testname.'</td>
        				<td width="100">'.$this->price.'</td>
        				<td width="100">'.$bill_elems_row['amount'].'</td>' .
        				'<td width="100">';
						if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,',','.');
        				else echo '0,00';
						echo '</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'</td>
        			</tr>';
      				
      			}

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td>----------</td>      			
						</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
						</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>----------</td>      			
						</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><b>open item accountingb:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
						</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>======</td>      			
						</tr>
					</table>			
      	</td>
      </tr>
  	</table>';
	  
	}
	
	//------------------------------------------------------------------------------  
	
	function DisplayArchivedPrescriptionBill($bill_nr, $edit_fields){
		
	  global $root_path;
  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Prescriptions</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfArchivedBill($bill_nr,"prescriptions");
      			
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>' .
      				'<td><b>Paid by Insurance</b></td>
      				<td><b>part. sum</b></td>
      				<td><b>';
      				echo 'Already paid?';
      				echo '</b><td>';
      				//if ($edit_fields) echo "<td>Edit</td>";
              echo '</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				}
      				$part_sum = ($price*$bill_elems_row['amount'])-$bill_emes_row['balanced_insurance'];
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'
      				  </td>
        				<td width="200">'.$desc.'
        				</td>
        				<td width="100">'.$price.'
        				</td>
        				<td width="100">'.$bill_elems_row['amount'].'
        				</td>' .
        				'<td width="100">';
						if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,',','.');
        				else echo '0,00';
						echo '</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'
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
        				echo "<td>&nbsp;</td>";
        				//if ($edit_fields) echo '<td><a href="billing_tz_edit.php?mode=edit_elem&billing_item='.$this->tbl_bill_elem_ID.'"><img src="'.$root_path.'gui/img/common/default/bul_arrowgrnsm.gif" border="0"></td>';
                echo "</tr>";
      				
      			}
      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      			  <td>&nbsp;</td>
      				<td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>----------</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><b>open item accountingc:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
      				<td><b>&nbsp;</b></td>   
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>======</td>      			
      				<td>&nbsp;</td>
      				<td>&nbsp;</td>';
      			//if ($edit_fields) echo '<td>&nbsp;</td>';
      			echo "</tr>";

      			
      			echo '</table>';
      			echo '
      		</td>
      	</tr>';
      	
  	echo'
  	</table>';
	  	  
	  return TRUE;
	}

	//------------------------------------------------------------------------------  
	
	function DisplayPrescriptionBill($bill_nr, $edit_fields){
		
	  global $root_path, $billnr, $batch_nr;
  	echo '
  	<table width="800" border="1">

  		';
  			echo '
  			<tr>
  				<td valign="top" width="100">';
  					//echo 'Bill Nr. '.$bills['nr'].'</td><td>';
  					echo '<p class="billing_topic"><br>Prescriptions/Other</p> </td><td>';
      			
      			$billelems=$this->GetElemsOfBill($bill_nr,"prescriptions");
      			
      			echo '
      			<table width="100%" height="100%">
      			<tr>
      			  <td><b>Position Nr.</b></td>
      				<td><b>Article</b></td>
      				<td><b>Price</b></td>
      				<td><b>Amount</b></td>' .
      				'<td><b>Paid by Insurance</b></td>
      				<td><b>part. sum</b></td>
						</tr>';
      			
      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				}
      				$part_sum = ($price*$bill_elems_row['amount']-$bill_elems_row['balanced_insurance']);
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td width="100">'.$pos_nr.'</td>
        				<td width="200">'.$desc.'</td>
        				<td width="50">'.$price.'</td>
        				<td width="50">'.$bill_elems_row['amount'].'</td>' .
        				'<td width="100">';
						if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,',','.');
        				else echo '0,00';
						echo '</td>
        				<td width="100">'.number_format($part_sum,2,',','.').'</td>
							</tr>';
      				
      			}
      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  	'<td>&nbsp;</td>
      				<td>----------</td>      			
      			</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><i>total amount:</i></td>
      				<td><i>'.number_format($sum,2,',','.').'</i> </td>
      			</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
              <td>----------</td>
            </tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><b>open item accounting:</b></td>
      				<td><b>'.number_format($sum_to_pay,2,',','.').'</b> </td>
						</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      			  <td>&nbsp;</td>
              <td>======</td>      			
						</tr>
					</table>
				</td>
      </tr>
  	</table>';
	  	  
	  return TRUE;
	}


//------------------------------------------------------------------------------  

function EditBillElement($id) {
  global $root_path, $db;
  // get the elements out of this billing-table:
  $this->sql = "SELECT 
                      care_tz_billing_elem.nr,
                      care_tz_billing.encounter_nr, 
                      care_tz_billing_elem.description,
                      care_tz_billing_elem.price,
                      care_tz_billing_elem.amount,
                      care_tz_billing_elem.amount_doc,
                      care_tz_billing_elem.is_paid
                FROM 
                  care_tz_billing_elem 
                    INNER JOIN care_tz_billing 
                      ON care_tz_billing.nr=care_tz_billing_elem.nr 
                WHERE care_tz_billing_elem.ID=".$id;
  $this->result = $db->Execute($this->sql);
  if ($this->row=$this->result->FetchRow()) {
	  $enc_obj = New Encounter;
	  
    $this->bill_number=$this->row['nr'];
    
    $this->encounter_nr=$this->row['encounter_nr'];
    $this->batch_nr=$enc_obj->GetBatchFromEncounterNumber($this->encounter_nr);
    
    $this->description=$this->row['description'];
    $this->price=$this->row['price'];
    $this->amount=$this->row['amount'];
    $this->amount_doc=$this->row['amount_doc'];
    
    $this->payed_status_checked = '';
    $this->outstanding_checked  = '';
    if ($this->is_paid=$this->row['is_paid'])
        $this->payed_status_checked = 'checked';
    else
        $this->outstanding_checked = 'checked';
  }
  
  //echo $this->batch_nr;
  $this->DisplayBillHeadline($this->bill_number, $this->batch_nr);
  
  echo '<table width="800" border="1">';
  echo '
<link rel="stylesheet" href="'.$root_path.'css/themes/default/default.css" type="text/css">
<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="warnprompt" >
            <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Billing: modification item</font> </td>
            <td bgcolor="#99ccff" align=right>&nbsp; </td>
          </tr>
       </table>
 		</td>
	</tr>
	<tr>
    <td bgcolor=#ffffff valign=top> 
      <font class="warnprompt"><br></font>
      <form ENCTYPE="multipart/form-data" action="billing_tz_edit.php" method="post" name="inputform">
	      <table border=0 cellspacing=1 cellpadding=3>
            <tbody class="submenu">
              <tr> 
                <td align=right width=339 >description</td>
                <td width="339"><input type="text" name="description" value="'.$this->description.'"  size=50 maxlength=50></td>
                <td width="37" rowspan=14 valign=top> <br> </td>
              </tr>
              <tr> 
                <td align=right width=339>price</td>
                <td><input name="price" type="text" value="'.$this->price.'"  size=10 maxlength=10> 
                </td>
              </tr>
              <tr> 
                <td align=right> Amount</td>
                <td><input type="text" name="amount" value="'.$this->amount.'"  size=10 maxlength=10>
                ';
                
                if($this->amount_doc!=$this->amount)
                	echo '(Prescribed amount: '.$this->amount_doc.')';
                
                echo ' 
                </td>
              </tr>
              <tr> 
                <td align=right width=339> payment status of this billing item</td>
                <td> 
                    <input type="radio" name="payment_status" value="paid" '.$this->payed_status_checked.'> paid
                    <input name="payment_status" type="radio" value="outstanding" '.$this->outstanding_checked.'> outstanding
                </td>
              </tr>
              <tr> 
                <td colspan="2" align=right>&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width=339>&nbsp;</td>
                <td align=right> 
                    Prepare this dataset for 
                    <select name="specific_mode">
                      <option value="delete">Delete</option>
                      <option value="update" selected>Update</option>
                    </select> 
                    <input type="hidden" name="mode" value="modfication">
                    <input type="hidden" name="bill_elem_number" value="'.$id.'">
                    <input type="hidden" name="encounter_nr" value="'.$this->encounter_nr.'">
                    <input type="hidden" name="batch_nr" value="'.$this->batch_nr.'">
                    <input type="submit" value="OK"> 
                  </td>
              </tr>
            </tbody>
          </table>
        </form>
      <a href="'.$root_path.'modules/billing_tz/billing_tz_pending.php"><img src="'.$root_path.'gui/img/control/default/en/en_cancel.gif" border=0 align="left" width="103" height="24" alt="Cancel and go back"></a>									
		  </td>
  	</tr>
		<tr valign=top >
		  <td bgcolor=#cccccc>
  		  <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
        <tr>
          <td align="center">
            <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
              <tr>
   	            <td>
	                <div class="copyright"></div>
	              </td>
              <tr>
            </table>
          </td>
        </tr>
        </table>
		  </td>
  	</tr>
	</tbody>
 </table>';
  echo '</table>';      
  return TRUE;
}
//------------------------------------------------------------------------------  

function update_bill_element($bill_elem_number, $is_paid, $amount, $price, $description) {
  global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  $this->sql="UPDATE care_tz_billing_elem SET 
                `is_paid` = '".$is_paid."',
                `amount` = '".$amount."',
                `price` = '".$price."',
                `description` = '".$description."'
             WHERE `ID` = '".$bill_elem_number."'";
  $db->Execute($this->sql);
  return TRUE;
}

function update_bill_element_allpaid($billnr, $is_paid) {
  global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  $this->sql="UPDATE care_tz_billing_elem SET 
                `is_paid` = '".$is_paid."'
             WHERE `nr` = ".$billnr;
  $db->Execute($this->sql);
  return TRUE;
}

//------------------------------------------------------------------------------  


//------------------------------------------------------------------------------  

function delete_bill_element($bill_elem_number) {
  global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  $this->sql="DELETE FROM care_tz_billing_elem 
             WHERE `ID` = '".$bill_elem_number."'";
  $db->Execute($this->sql);
  return TRUE;
}


//------------------------------------------------------------------------------  
	
	function DisplayArchivedBills($batch_nr, $specific_bill, $edit_fields) {
		
	  if (func_num_args()>3)
	    $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
		*/
		global $db;
		
  	echo '
  	<table width="800" border="1">

  		';
  			$billnumbers=$this->GetArchivedBill($specific_bill);

  		while($bills=$billnumbers->FetchRow()) { 

        if ($printout==FALSE) {
      		//Java script for print out the bill
      		// We have to place it here, because here is one place where we have the bill number what is 
      		// definetly displayed on the user-screen 
      		echo '<script language="javascript" >
                <!-- 
                function printOut_'.$bills['nr'].'()
                {
                	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
                	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                  
                }
                // -->
                </script> 
                ';
        }
  		  
				echo '
					<tr>
						<td>';
						$this->DisplayBillHeadline($bills['nr'], $batch_nr);
						echo '
						</td>
					</tr>';
  			$sum_to_pay =0;
  			$sum = 0;
  			
  			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"laboratory");
				if($bill_elems_row=$billelems->FetchRow())
				{			
	  			echo '
	  			<tr>
	  				<td valign="top">';
	  					$this->DisplayArchivedLaboratoryBill($bills['nr'],$edit_fields);
	      	echo '
	      		</td>
	      	</tr>';
      	}
      	$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"prescriptions");
				if($bill_elems_row=$billelems->FetchRow())
				{
					echo '
	  			<tr>
	  				<td valign="top">';
	  					$this->DisplayArchivedPrescriptionBill($bills['nr'],$edit_fields);
	      		echo '
	      		</td>
	      	</tr>';
      	}
      	
      	// is there the edit_fields flag set, then there should be finished the formular with the submit button. 
      	// If not, then show the three kinds of the main folder.
      	echo '
			    <tr>
			  		<td>';
       echo '</td>
			  	</tr>';
  		}
  	echo'

  	</table>';
	}

//------------------------------------------------------------------------------  
	
	function DisplayBills($batch_nr, $specific_bill, $edit_fields) {
		
	  if (func_num_args()>3)
	    $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
		*/
		global $db, $user_origin;
		
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
  		if ($billnumbers) {
    		while($bills=$billnumbers->FetchRow()) { 
  
          if ($printout==FALSE) {
        		//Java script for print out the bill
        		// We have to place it here, because here is one place where we have the bill number what is 
        		// definetly displayed on the user-screen 
        		echo '<script language="javascript" >
                  <!-- 
                  function printOut_'.$bills['nr'].'()
                  {
                  	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
                  	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                    
                  }
                  // -->
                  </script> 
                  ';
          }
    		  
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
  			  		<td>';
  			 
  			 $show_printout_button = FALSE;
  			 $show_done_button=FALSE;
  			 $show_edit_button=FALSE;
  			 $enc_obj = New Encounter;
  			 $encounter_nr = $enc_obj->GetEncounterFromBatchNumber($batch_nr);
         if ($printout==FALSE) {
    			 if (!$show_printout_button) echo '<a href="javascript:printOut_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" width="99" height="24" alt="Print this form"></a> ';
    			 
    			 if ($edit_fields) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif"> &nbsp;&nbsp;&nbsp; To transfere this pending bill into the archive: <a href="billing_tz_pending.php?&mode=done&user_origin='.$user_origin.'&bill_number='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="It´s done! Move the form to the archive"></a>&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif">';
    			 if (!$edit_fields) echo '<a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="absmiddle" width="120" height="24"></a>';
    		 }
         echo '</td>
  			  	</tr>';
    		}
    	} else {
    	  echo '<br><br><tr><td><div align="center"><h1>No pending bills available</h1><div></td></tr>';
      }
  	echo'

  	</table>';
	  //if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}
	
	//------------------------------------------------------------------------------  
	
	function ArchiveBill($bill_number) {
	  global $db;
	  $debug=FALSE;
	  if ($debug) echo "<b>class_tz_billing::ArchiveBill($bill_number)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
    
    $this->sql = "INSERT INTO care_tz_billing_archive 
                      (`nr`,`encounter_nr`, `first_date`, `create_id`)	  
                  SELECT `nr`, `encounter_nr`, `first_date`, `create_id` FROM care_tz_billing WHERE `nr`=".$bill_number;
    $this->result=$db->Execute($this->sql);
    
    if ($db->Insert_ID())
      $CARE_TZ_BILLING_ARCHIVED=TRUE;

    $this->sql = "INSERT INTO care_tz_billing_archive_elem 
                      (`nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, `is_paid`, `amount`, `price`, `description`, `item_number`, `prescriptions_nr`)	  
                  SELECT `nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, 1, `amount`, `price`, `description`, `item_number`, `prescriptions_nr` FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
    $this->result=$db->Execute($this->sql);

    if ($db->Insert_ID())
      $CARE_TZ_BILLING_ELEM_ARCHIVED=TRUE;      
    
    if ($CARE_TZ_BILLING_ARCHIVED && $CARE_TZ_BILLING_ELEM_ARCHIVED) {
      $this->sql = "UPDATE care_encounter_prescription SET bill_status='archived' WHERE bill_number=".$bill_number;
      $db->Execute($this->sql);
      $this->sql = "UPDATE care_test_request_chemlabor SET bill_status='archived' WHERE bill_number=".$bill_number;
      $db->Execute($this->sql);
      $this->DeleteBillFromPendingList($bill_number);
      return TRUE;
    }
    return FALSE;
	}
	
	function DeleteBillFromPendingList($bill_number) {
	  global $db;
	  $debug=FALSE;
	  if ($debug) echo "<b>class_tz_billing::DeleteBillFromPendingList($bill_number)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
    $this->sql = "DELETE FROM care_tz_billing WHERE `nr`=".$bill_number;
    $db->Execute($this->sql);
    $this->sql = "DELETE FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
    $db->Execute($this->sql);
    return TRUE;
  }

  //------------------------------------------------------------------------------  
  
  function GetNewQuotation_Prescriptions($encounter_nr) {
    global $db;
    /**
    * Returns all new prescriptions in a recordset. If no Encounter-Nr is given 
    * the result-list is grouped by encounters
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Prescriptions()</b><br>";
    if($encounter_nr>0) 
    	$where_encounter='AND cep.encounter_nr = '.$encounter_nr;
    else 
    {
    	$where_encounter='GROUP BY cep.encounter_nr, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth';
    	$anzahl= 'count(*) AS anzahl,';
    }
    $this->sql = "SELECT $anzahl cep.*, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth
									FROM `care_encounter_prescription` cep, care_encounter ce, care_person cp
									WHERE cep.encounter_nr = ce.encounter_nr
									AND ce.pid = cp.pid
									AND cep.bill_number = 0
									AND (isnull(cep.is_disabled) OR cep.is_disabled='')
									$where_encounter
									ORDER BY cep.prescribe_date DESC , cep.encounter_nr ASC";    
    $this->request = $db->Execute($this->sql);
    return $this->request;
    
  }
  
  //------------------------------------------------------------------------------  

  function GetNewQuotation_Laboratory($encounter_nr) {
    global $db;
    /**
    * Returns all new laboratory requests in a recordset. If no Encounter-Nr is given 
    * the result-list is grouped by encounters
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Prescriptions()</b><br>";
    if($encounter_nr>0) 
    	$where_encounter='AND ctr.encounter_nr = '.$encounter_nr;
    else 
    {
    	$where_encounter='GROUP BY ctr.encounter_nr, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth';
    	$anzahl= 'count(*) AS anzahl,';
    }
    $this->sql = "SELECT $anzahl ctr.*, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth
									FROM `care_test_request_chemlabor` ctr, care_encounter ce, care_person cp
									WHERE ctr.encounter_nr = ce.encounter_nr
									AND ce.pid = cp.pid
									AND ctr.bill_number = 0
									AND (isnull(ctr.is_disabled) OR ctr.is_disabled='')
									$where_encounter
									ORDER BY ctr.modify_time DESC , ctr.encounter_nr ASC";    
    $this->request = $db->Execute($this->sql);
    return $this->request;
    
  }
  
  //------------------------------------------------------------------------------  
    
    function GetLaboratoryCount($encounter_nr) {
    global $db;
    /**
    * Returns all new laboratory requests in a recordset. If no Encounter-Nr is given 
    * the result-list is grouped by encounters
    */
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Prescriptions()</b><br>";
  	$where_encounter='AND ctr.encounter_nr = '.$encounter_nr;
  	$where_encounter='GROUP BY ctr.encounter_nr, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth';
  	$anzahl= 'count(*) AS anzahl,';
    
	$this->sql = "SELECT $anzahl ctr.*, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth
									FROM `care_test_request_chemlabor` ctr, care_encounter ce, care_person cp
									WHERE ctr.encounter_nr = ce.encounter_nr
									AND ce.pid = cp.pid
									AND ctr.bill_number = 0
									AND (isnull(ctr.is_disabled) OR ctr.is_disabled='')
									$where_encounter
									ORDER BY ctr.modify_time DESC , ctr.encounter_nr ASC";    
    $this->request = $db->Execute($this->sql);
    return $this->request->FetchRow();
    
  }
  
  //------------------------------------------------------------------------------  
   
	function DeleteNewPrescription($nr,$reason) {
	  global $db;
	  $debug=FALSE;
	  if ($debug) echo "<b>class_tz_billing::DeleteNewPrescription($nr)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
	  if(!$nr) return false;
    $this->sql = "UPDATE care_encounter_prescription SET
    	is_disabled = '$reason'
    	WHERE `nr`=".$nr;
    $db->Execute($this->sql);
    return TRUE;
  }

  //------------------------------------------------------------------------------  
  
	function DeleteNewLaboratory($nr,$reason) {
	  global $db;
	  $debug=false;
	  if ($debug) echo "<b>class_tz_billing::DeleteNewLaboratory($nr)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
	  if(!$nr) return false;
    $this->sql = "UPDATE care_test_request_chemlabor SET
    	is_disabled = '$reason'
    	WHERE `batch_nr`=".$nr;
    $db->Execute($this->sql);
    return TRUE;
  }
  

  //------------------------------------------------------------------------------  
  
  
	function UpdateBillNumberNewPrescription($nr,$bill_number) {
	  global $db;
	  $debug=FALSE;
	  if ($debug) echo "<b>class_tz_billing::DeleteNewPrescription($nr)</b><br>";
	  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;	  
	  if(!$nr) return false;
    $this->sql = "UPDATE care_encounter_prescription SET
    	bill_number = '$bill_number'
    	WHERE `nr`=".$nr;
    $db->Execute($this->sql);
    return TRUE;
  }

  //------------------------------------------------------------------------------  
  
  
  function ShowNewQuotations()
  {
  	global $db;
  	$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotations()</b><br>";
    
/*
	$result_pres = $this->GetNewQuotation_Prescriptions(0); 
	$result_lab = $this->GetNewQuotation_Laboratory(0);
	 if($result_pres && $result_lab)
    {
		
	    while ($row_pres=$result_pres->FetchRow())		 
		//{
		while ($row_lab=$result_lab->FetchRow())
	  		//{
	    
		//echo $row_pres['prescribe_date'] ;
		//echo " <br>";
		//echo substr($row_lab['modify_time'],0,10) ;
			if($row_pres['prescribe_date']<(substr($row_lab['modify_time'],0,10)))
			{
	
	*/
	$result = $this->GetNewQuotation_Prescriptions(0);     
    $color_change=FALSE;
    if($result)
    {
	    while ($row=$result->FetchRow())
	    {
    		$counter++;
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
	      $labinfo = $this->GetLaboratoryCount($row['encounter_nr']);
	      if(empty($labinfo['anzahl'])) $labinfo['anzahl'] = 0;
					echo '
          <tr>
          	<form method="POST" action="billing_tz_quotation_create.php">
					  <td '.$BGCOLOR.'><div align="center">'.$row['prescribe_date'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['anzahl'].' pres.<br>'.$labinfo['anzahl'].' req.</div></td>
					  <td '.$BGCOLOR.'><div align="center"><input type="hidden" name="namelast" value="'.$row['name_last'].'"><input type="hidden" name="namefirst" value="'.$row['name_first'].'"><input type="hidden" name="countpres" value="'.$row['anzahl'].'"><input type="hidden" name="countlab" value="'.$labinfo['anzahl'].'"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					  </form>
					</tr>';
				$alreadyshown[$row['encounter_nr']] = $row['encounter_nr'];
	    }
			    
			//}//for prakash code
			//else
			//{//for prakash code	
				
				$result = $this->GetNewQuotation_Laboratory(0);
			    if($result)
			    {
				    while ($row=$result->FetchRow())
				    {
			    		if(!$alreadyshown[$row['encounter_nr']])
			    		{
			    		$counter++;
			    		
				      if ($color_change) {
				        $BGCOLOR='bgcolor="#ffffdd"';
				        $color_change=FALSE;
				      } else {
				        $BGCOLOR='bgcolor="#ffffaa"';
				        $color_change=TRUE;
				      }
				      if(empty($labinfo['anzahl'])) $labinfo['anzahl'] = 0;
								echo '
			          <tr>
			          	<form method="POST" action="billing_tz_quotation_create.php">
								  <td '.$BGCOLOR.'><div align="center">'.substr($row['modify_time'],0,10).'</div></td>
								  <td '.$BGCOLOR.'><div align="center">'.$row['encounter_nr'].'</div></td>
								  <td '.$BGCOLOR.'><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
								  <td '.$BGCOLOR.'><div align="center">'.$row['selian_pid'].'</div></td>
								  <td '.$BGCOLOR.'><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
								  <td '.$BGCOLOR.'><div align="center">'.$row['date_birth'].'</div></td>
								  <td '.$BGCOLOR.'><div align="center">0 pres.<br>'.$row['anzahl'].' req.</div></td>
								  <td '.$BGCOLOR.'><div align="center"><input type="hidden" name="namelast" value="'.$row['name_last'].'"><input type="hidden" name="namefirst" value="'.$row['name_first'].'"><input type="hidden" name="countpres" value="0"><input type="hidden" name="countlab" value="'.$row['anzahl'].'"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
								  </form>
								</tr>';
							}
				    }
	    	}
			
			//}//for prakash code
			//}//for prakash code
	    if(!$counter)
	    	echo '<tr><td colspan="8" align="center">Nothing to do :)</td></tr>';
	 	}
	  else
	  	echo '<tr><td colspan="8" align="center">Huston we have a problem. Database error :(</td></tr>';
  }
  
  //------------------------------------------------------------------------------  
  
  function ShowNewQuotation_Laboratory()
  {
  	global $db;
  	$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotation_Laboratory()</b><br>";
    $result = $this->GetNewQuotation_Laboratory(0);
    if($result)
    {
    	$color_change=FALSE;
	    while ($row=$result->FetchRow())
	    {
    		$counter++;
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
					echo '
          <tr>
          	<form method="POST" action="billing_tz_quotation_create.php">
					  <td '.$BGCOLOR.'><div align="center">'.substr($row['modify_time'],0,10).'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['anzahl'].' req.</div></td>
					  <td '.$BGCOLOR.'><div align="center"><input type="hidden" name="createmode" value="laboratory"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					  </form>
					</tr>';
	    }
	    if(!$counter)
	    	echo '<tr><td colspan="8" align="center">Nothing to do :)</td></tr>';
	 	}
	  else
	  	echo '<tr><td colspan="8" align="center">Huston we have a problem. Database error :(</td></tr>';
  }
  
  //------------------------------------------------------------------------------  
  
	function ShowNewQuotationEncounter_Prescriptions($encounter_nr,&$id_array)
  {
  	global $db;
  	$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotationEncounter_Prescriptions()</b><br>";
    $result = $this->GetNewQuotation_Prescriptions($encounter_nr);
    if($result)
    {
    	$color_change=FALSE;
	    while ($row=$result->FetchRow())
	    {
    
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
	      $id_array['pressum_'.$row['nr']]= true;
	      if(strlen($row['dosage'])<1) $row['dosage']=0;
	      echo '
          <tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="600">
					  		<tr bgcolor="#ffffaa">
					  			<td width="200">
					  				<div align="left">'.$row['prescribe_date'].'</div>
					  			</td>
					  			<td width="200">
					  				<div align="center">'.$row['article'].'</div>
					  			</td width="200">
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="180">
					  					<tr>
					  						<td width="60"><input type="radio" value="bill" name="modepres_'.$row['nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['nr'].'\',true,\''.$row['nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="center"><input checked type="radio" value="ignore" name="modepres_'.$row['nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['nr'].'\',false,\''.$row['nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><input type="radio" value="delete" name="modepres_'.$row['nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['nr'].'\',false,\''.$row['nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				
					  				
										
					  				</div>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffffdd" id="tr_'.$row['nr'].'" style="display: none;">
					  			<td valign="top">
					  				Notes:<br>
					  				<textarea rows="3" cols="22" name="notes_'.$row['nr'].'">'.$row['notes'].'</textarea>
					  			</td>
					  			<td valign="top">
					  				<table border="0" cellpadding="0" width="200">
					  					<tr>
					  						<td width="100">Price:</td>
					  						<td align="right"><input type="hidden" name="showprice_'.$row['nr'].'" id="showprice_'.$row['nr'].'" value="'.$row['price'].'">'.$row['price'].' TSH</td>
					  					</tr>
					  					<tr>
					  						<td>Dosage:</td>
					  						<td align="right"><input onkeyup="calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.$row['dosage'].'" name="dosage_'.$row['nr'].'"></td>
					  					</tr>
					  					<tr>
					  						<td>Insurance:</td>
					  						<td align="right"><input onkeyup="calc_article(\''.$row['nr'].'\')" type="text" size="4" value="0" name="insurance_'.$row['nr'].'"></td>
					  					</tr>
					  				</table>
					  			</td>
					  			<td valign="top">
					  				<u>Pricing:</u><br>
					  				<div  id="div_'.$row['nr'].'"></div>
					  			</td>
					  		</tr>
					  	</table>
					  </td>
					</tr>';
					
	    }
	 	}
	  else
	  	echo '<tr><td colspan="8">Nothing to do :)</td></tr>';
  }
  //------------------------------------------------------------------------------  
  
	function ShowNewQuotationEncounter_Laboratory($encounter_nr, &$id_array)
  {
  	global $db,$root_path;
  	$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotationEncounter_Laboratory()</b><br>";
    $result = $this->GetNewQuotation_Laboratory($encounter_nr);
    if($result)
    {
    	$color_change=FALSE;
	    while ($row=$result->FetchRow())
	    {
    
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
    		parse_str($row['parameters'],$tests);
				while(list($x,$v)=each($tests))
				{
					$tests_arr[strtok(substr($x,5),"_")] = $v;
				}
				require_once($root_path.'include/care_api_classes/class_lab.php');
				if(!isset($lab_obj)) $lab_obj=new Lab($encounter_nr);

				
	      echo '
          <tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="600">
					  		<tr bgcolor="#ffffaa">
					  			<td width="200">
					  				<div align="left">'.substr($row['modify_time'],0,4).'-'.substr($row['modify_time'],5,2).'-'.substr($row['modify_time'],8,2).'</div>
					  			</td>
					  			<td width="200">
					  				<div align="center">'; 
					  				$sum=0;
					  				$desc=false;
					  				$pricelist=false;
										while(list($x,$v)=each($tests_arr))
										{
											$labrow = $lab_obj->TestParamsDetails($x);
											$desc .=$labrow['name'].', ';
											$pricelist.= $labrow['name'].': '.$labrow['price'].'<br>';
											$sum += $labrow['price'];
											
										}
					  				
					  				echo $desc.'</div>
					  			</td width="200">
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="180">
					  					<tr>
					  						<td width="60"><input type="radio" value="bill" name="modelab_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',true,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="center"><input checked type="radio" value="ignore" name="modelab_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',false,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><input type="radio" value="delete" name="modelab_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',false,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				
					  				
										
					  				</div>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffffdd" id="tr_'.$row['batch_nr'].'" style="display: none;">
					  			<td valign="top">
					  				'.$pricelist.'= '.$sum.' TSH
					  			</td>
					  			<td valign="top">
					  				<table border="0" cellpadding="0" width="200">
					  					<tr>
					  						<td width="100">Price:</td>
					  						<td align="right"><input type="hidden" id="showprice_'.$row['nr'].'" name="showprice_'.$row['batch_nr'].'" value="'.$sum.'">'.$sum.' TSH<input onChange="calc_article(\''.$row['batch_nr'].'\');" type="hidden" value="1" name="dosage_'.$row['batch_nr'].'"></td>
					  					</tr>
					  					<tr>
					  						<td>Insurance:</td>
					  						<td align="right"><input onkeyup="calc_article(\''.$row['batch_nr'].'\')" type="text" size="4" value="0" name="insurance_'.$row['batch_nr'].'"> TSH</td>
					  					</tr>
					  				</table>
					  			</td>
					  			<td valign="top">
					  				<u>Pricing:</u><br>
					  				<div  id="div_'.$row['batch_nr'].'"></div>
					  			</td>
					  		</tr>
					  	</table>
					  </td>
					</tr>';
				
				
				
/*					echo '
          <tr>
					  <td '.$BGCOLOR.'><div align="center">'.$row['modify_time'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$desc.'</div></td>
					  <td '.$BGCOLOR.'><div align="center"><input type="radio" value="bill" name="modelab_'.$row['batch_nr'].'"></div></td>
					  <td '.$BGCOLOR.'><div align="center"><input checked type="radio" value="ignore" name="modelab_'.$row['batch_nr'].'"></div></td>
						<td '.$BGCOLOR.'><div align="center"><input type="radio" value="delete" name="modelab_'.$row['batch_nr'].'"></div></td>
					</tr>';
					
					*/
					$id_array['pressum_'.$row['batch_nr']]= true;
	    }
	 	}
	  else
	  	echo '<tr><td colspan="5">Nothing to do :)</td></tr>';
  }

}


	
?>