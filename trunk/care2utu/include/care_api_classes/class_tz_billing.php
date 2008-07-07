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
  var $tb_drugsandservices='care_tz_drugsandservices';
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
	var $user_id;


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
    $this->debug=false;
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

 function DisplayArchivedBillHeadlines($no) {
    global $db;
    $enc_obj = New Encounter;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>class_tz_billing::DisplayArchivedBillHeadlines</b><br>";
	 $this->sql_pid="SELECT `pid` FROM care_person where selian_pid like '%$no%' OR name_first like '%$no%' OR name_last like '%$no%' ";
      $this->request_pid=$db->Execute($this->sql_pid);
      $color_change=FALSE;
     while ($this->res_pid=$this->request_pid->FetchRow()){
	  $pid=$this->res_pid['pid'];

	 $this->sql_enr="SELECT `encounter_nr` FROM care_encounter where pid= '$pid' ";
      $this->request_enr=$db->Execute($this->sql_enr);
      $color_change=FALSE;
     while ($this->res_enr=$this->request_enr->FetchRow()){
      $enr=$this->res_enr['encounter_nr'];

    $this->sql="SELECT `nr`, `encounter_nr`, `first_date` FROM care_tz_billing_archive where encounter_nr='$enr'   order by nr DESC";
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
  }//
  }//
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
    echo $this->sql;
    if ($this->result=$this->request->FetchRow())
      return $this->result[0];

  }

  //------------------------------------------------------------------------------

  function GetAllPendingBillNumbers() {
    global $db;
    /**
    * Returns array of all pending bill numbers
    */
    $this->debug=TRUE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetAllPendingBillNumbers()</b><br>";
    $this->sql = "SELECT nr FROM $this->tbl_bill";
    $this->request = $db->Execute($this->sql);
    if ($this->result=$this->request->GetArray()) {
      return $this->result;
    } else {
      return FALSE;
    } // end of


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
	  $this->debug=false;
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
	  if ($this->debug) echo "<b>class_tz_billing::StorePrescriptionItemToBill($pid, $prescriptions_nr, $bill_number, $price, $dosage, $notes, $insurance)</b><br>";
	  if ($this->debug) echo "prescriptions_nr: $prescriptions_nr, bill_number: $bill_number";
	  ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
	  require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
	  $insurance_tz = New Insurance_tz();
	  $contract = $insurance_tz->CheckForValidContract($pid);
    // do we have pending issues of prescriptions?
    // read all items out of the prescription table
    $this->sql = "
    INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, amount_doc, price, description, notes, item_number, balanced_insurance, insurance_id, prescriptions_nr)
    SELECT '".$bill_number."', '".time()."' AS date_change, 0, 1, '".$dosage."', dosage, $price, article, '".$notes."', article_item_number, '".$insurance."', '".$contract['id']."', '".$prescriptions_nr."'
    FROM $this->tbl_prescriptions WHERE nr = $prescriptions_nr";
	//echo ($this->sql);
    $this->result=$db->Execute($this->sql);
    if ($this->debug) echo $this->sql;

	}


	//------------------------------------------------------------------------------

	function StoreLaboratoryItemToBill($pid, $batch_nr, $bill_number, $insurance){
	  global $db, $root_path;
	  $this->debug=FALSE;
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
				  //echo $this->sql;
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
    $this->sql="SELECT unit_price as price FROM $this->tb_drugsandservices WHERE item_id = '$item_number' ";
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
    $this->sql="SELECT item_description as description FROM $this->tb_drugsandservices WHERE item_id = '$item_number' ";
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


  function CreateBalanceBill($insurance_id, $value) {
    global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
    $this->sql="SELECT b.nr, b.encounter_nr FROM care_tz_billing_archive b, care_tz_billing_archive_elem be WHERE be.nr = b.nr AND be.insurance_id=".$insurance_id." ORDER by b.id DESC Limit 0,1";
	$this->result = $db->Execute($this->sql);
	if($this->row = $this->result->FetchRow())
	{
		$this->sql="INSERT INTO care_tz_billing_archive SET nr='balanced".$this->row['nr']."', encounter_nr=".$this->row['encounter_nr'].", first_date=".time().", creation_date=".time();
		$this->result = $db->Execute($this->sql);
		$this->sql="INSERT INTO care_tz_billing_archive_elem SET nr='balanced".$this->row['nr']."', date_change=".time().", is_labtest=0, is_medicine=0, is_comment=0, is_paid=1, amount=1, price=0, balanced_insurance=".$value.", insurance_id=".$insurance_id.", item_number=0, prescriptions_nr=0";
		$this->result = $db->Execute($this->sql);
		return true;
	}
	return false;
  }

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
					 WHERE nr = '".$nr."' ".$sql_where."
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

	// -----------------------------------------------------------------------------

	function GetBillTimestamp($bill_nr) {
	    global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if(!$bill_nr) return false;
	    $this->sql="SELECT first_date FROM care_tz_billing WHERE nr=".$bill_nr;
		$this->result = $db->Execute($this->sql);
		if($this->row = $this->result->FetchRow())
		{
			return $this->row['first_date'];
		}
		$this->sql="SELECT first_date FROM care_tz_billing_archive WHERE nr=".$bill_nr;
		$this->result = $db->Execute($this->sql);
		if($this->row = $this->result->FetchRow())
		{
			return $this->row['first_date'];
	  	}
	  	return false;
	}

	//------------------------------------------------------------------------------

	function GetBillCostSummaryInTimeframe($PID, $start, $end) {
	    global $db;
	    $debug=FALSE;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if ($debug) echo 'PID: '.$PID.' - Start: '.$start.' - End: '.$end.'<br>';
	    /*
	    $this->sql="SELECT nr FROM care_tz_billing b, care_encounter e WHERE first_date>".$start." AND first_date <=".$end." AND e.encounter_nr = b.encounter_nr AND e.pid=".$PID;
		if($this->result = $db->Execute($this->sql))
			while($this->row = $this->result->FetchRow())
			{
				$balanced_insurance = false;
				$this->elemsofbill = $this->GetElemsOfBill($this->row['nr'], false);
				while($this->elems = $this->elemsofbill->FetchRow())
				{
					$balanced_insurance += $this->elems['balanced_insurance'];
				}
				$return[$this->row['nr']] = $balanced_insurance;
			}
		*/

		$this->sql="SELECT nr FROM care_tz_billing_archive b, care_encounter e WHERE first_date>".$start." AND first_date <=".$end." AND e.encounter_nr = b.encounter_nr AND e.pid=".$PID;
		if($this->result = $db->Execute($this->sql))
			while($this->row = $this->result->FetchRow())
			{
				$balanced_insurance = false;
				$this->elemsofbill = $this->GetElemsOfArchivedBill($this->row['nr'], false);
				while($this->elems = $this->elemsofbill->FetchRow())
				{
					$balanced_insurance += $this->elems['balanced_insurance'];
				}
				$return[$this->row['nr']] = $balanced_insurance;
			}
	  	return $return;
	}

	//------------------------------------------------------------------------------

	function DisplayBillHeadline($bill_nr, $batch_nr) {
	  global $LDBatchFileNr,$LDEncounterNr,$LDLastName,$LDFirstName,$LDBday,$LDSex,$LDBillNumber;

	  // Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
	  if (func_num_args()>2)
	    $printout=func_get_arg (2);


	  $enc_obj = New Encounter;
	  $encoded_batch_number = $enc_obj->ShowPID($batch_nr);
	  $enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);

	  $bill_head=$enc_obj->GetHospitalAddress();
	  $bill_logo=$enc_obj->GetHospitalLogo();
	  $bill_name=$enc_obj->GetHospitalName();


	  if ($enc_obj->EncounterExists($enc_number)) {
	    // Load the encounter data:
	    $enc_data = $enc_obj->loadEncounterData($enc_number);
		echo ($printout) ? '<table width="100%"  border="0" cellspacing=1 cellpadding=0 align="center" >' : '<table width="100%" border="0" cellspacing=1 cellpadding=0 >';
  	  echo '<tr><td></td><td width="40%"><b><table border=0 width="100%" align="left"><tr><td align="center"><b>'.$bill_head. '</td></tr></table></td><td align="right"><img src="../../'.$bill_logo.'" border=0 align="absmiddle" alt=""></td></tr>	' ;

  	  echo ($printout) ? '<table width="200"  border="0" cellspacing=1 cellpadding=0 >' : '<table width="100%"  border="0" cellspacing=1 cellpadding=0 >';

  	  echo '<tr>
  				<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4"><b>'.$LDBatchFileNr.'</b></font></span></span></td>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$encoded_batch_number.'</font></span></span></b></td>

  				</tr>
  				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">Admission-Nr.:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_number.'</font></span></span></b></td>
  				</tr>
  				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">Surname/Ukoo:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->LastName($enc_number).'</font></span></span></b></td>
  				</tr>
  				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">First name:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->FirstName($enc_number).'</font></span></span></td>
  				</tr>
  				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">Date of birth:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->BirthDate($enc_number).'</font></span></span></td>
  				</tr>
  				<tr>
  					<td class="headline""><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDSex.':</font></span></span></td>
  					<td class="adm_input"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->Sex($enc_number).'</font></span></span></td>
  				</tr>' .
  						'<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">Bill Date</font></span></span></td>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.date('d-m-Y').'</font></span></span></td>
  				</tr>
  				<tr>
  					<td class="headline"><b><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDBillNumber.'</font></span></span></b></td>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$bill_nr.'</font></span></span></b></td>
  				</tr>
		<tr>




  				</table>';
      return TRUE;
    }
  return FALSE;
	}

	//------------------------------------------------------------------------------





	function DisplayArchivedLaboratoryBill($bill_nr,$edit_fields) {

   	global $root_path, $billnr, $batch_nr;
   	global $LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDLaboratory;
    $sum_price=0;

  	echo '
  	<table width="100%" border="0" class="table_content">
  			<tr>
  				<!--<td  valign="top" >
					<p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDLaboratory.'</font></span></span></p>
				</td>-->
				<td>';

      			$billelems=$this->GetElemsOfArchivedBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;
      			echo '
      			<table width="100%" height="100%" class="table_content">
	      			<tr>
	      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">Position Nr.</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></td>' .
	      				'<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></td>
	      			</tr>';

      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				$insurance_used +=$bill_elems_row['balanced_insurance'];
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";

      				}
      				$part_sum = ($this->price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
      				$sum += $part_sum;
      				echo '
      				<tr>
      				  <td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$pos_nr.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$this->chemlab_testname.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$this->price.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$bill_elems_row['amount'].'</font></span></span></td>' .
        				'<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">';
						if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,',','.');
        				else echo '0,00';
						echo '</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,',','.').'</font></span></span></td>
        			</tr>';

      			}

      			echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>----------</td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.$LDtotalamount.'</font></span></span></i></td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.number_format($sum,2,',','.').'</font></span></span></i> </td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              	  <td>----------</td>
				</tr>
			</table>
			</td>
		</tr>
  	</table>';
	return $sum;

	}

	//------------------------------------------------------------------------------

	function DisplayLaboratoryBill($bill_nr,$edit_fields) {

	global $root_path, $billnr, $batch_nr;
	global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDLaboratory;
    $sum_price=0;

	// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
	  if (func_num_args()>2)
	    $printout=func_get_arg (2);

	$billelems=$this->GetElemsOfBill($bill_nr,"laboratory");

	// **********************************************************************************************************
	// Start of the integrated table for this section
	echo ($printout) ? '<table border="0" width="100%">': '<table border="0" width="100%" class="table_content">';

	while($bill_elems_row=$billelems->FetchRow()) {
		$mySum = 0; // this is the tota sum to pay for each lab-test
		$insurance_used = 0;
		$pos_nr+=1;
		$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
		$insurance_used +=$bill_elems_row['balanced_insurance'];
		if($bill_elems_row['is_labtest']==1)
		{
		  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
			$this->chemlab_testname=$bill_elems_row['description'];
			$this->price=$bill_elems_row['price'];
			if (empty($this->price)) $this->price="0,00";

		}

		// headline
		echo '<tr>';
			echo '<td colspan="2"><b>'.$this->chemlab_testname.'</b></td>';
		echo '</tr>';

		// price
		echo '<tr>';
			echo '<td>'.$LDPrice.'</td>';
			echo '<td>'.$this->price.'</td>';
		echo '</tr>';

		// Quantitiy
		echo '<tr>';
			echo '<td>Quatity</td>';
			echo '<td>'.$bill_elems_row['amount'].'</td>';
		echo '</tr>';


		$mySum = $this->price * $bill_elems_row['amount'];

		// How much is covered by insurance
		echo '<tr>';
			echo '<td>'.$LDPaidbyInsurance.'</td>';
			echo '<td>'.number_format($insurance_used,2,',','.').'</td>';
		echo '</tr>';

		$mySum = $mySum - $insurance_used;


		// The total of this price (current price - covered by insurance)
		echo '<tr>';
			echo '<td>'.$LDpartSum.'</td>';
			echo '<td><b>'.number_format($mySum,2,',','.').'<b></td>';
		echo '</tr>';

		$sum = $sum + $mySum;

		// End of details for this lab-test
		echo '<tr>';
			echo '<td colspan="2"><hr></td>';
		echo '</tr>';



	} // end of while($bill_elems_row=$billelems->FetchRow()) {

	echo "</table>";
	// end of the integrated table of this section
	// **********************************************************************************************************

	return $sum;
	}

	//------------------------------------------------------------------------------


function DisplayCompanyLaboratoryBill($bill_nr,$edit_fields) {

	global $root_path, $billnr, $batch_nr;
	global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDLaboratory;
    $sum_price=0;


      			$billelems=$this->GetElemsOfBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;

      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
      				$insurance_used +=$bill_elems_row['balanced_insurance'];
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";

      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum += $part_sum;

      				$insurance_amt +=$bill_elems_row['balanced_insurance'];
      			}
      			//$sum -= $insurance_used;
      			if($insurance_used) {
      				echo "Insurance is used";

					$pos_nr += 1;

      			}
//if($sum==0)$sum=$insurance_amt;
    return $sum;
	}

	//------------------------------------------------------------------------------




	function DisplayArchivedPrescriptionBill($bill_nr, $edit_fields){

	global $root_path, $billnr, $batch_nr;
	global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,$LDtotalamount,
	       $LDPrescriptionOther;

  	echo '
  	<table width="100%" border="0" class="table_content">
  			<tr>
  			<!--	<td valign="top" >
  					<p class="billing_topic"><br>'.$LDPrescriptionOther.'</p>
  				</td>-->
  				<td>';

      			$billelems=$this->GetElemsOfArchivedBill($bill_nr,"prescriptions");

      			echo '
      			<table border="0" width="100%" class="table_content">
      			<tr>
      			  <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPositionNr.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></b></td>
				</tr>';

      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$insurance_used += $bill_elems_row['balanced_insurance'];
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
      				  <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$pos_nr.'</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$desc.'</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$price.'</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$bill_elems_row['amount'].'</font></span></span></td>' .
        				'<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
						if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,',','.');
        				else echo '0,00';
						echo '</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,',','.').'</font></span></span></td>
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
      				<td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDtotalamount.'</font></span></span></i></td>
      				<td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format($sum,2,',','.').'</font></span></span></i> </td>
      			</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              	  <td>----------</td>
            	</tr>
            </table>
		</td>
	</tr>
  	</table>';

	  return $sum;
	}

	//------------------------------------------------------------------------------

	function DisplayPrescriptionBill($bill_nr, $edit_fields){

	global $root_path, $billnr, $batch_nr;
	global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,
	       $LDPrescriptionOther;

	// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
	if (func_num_args()>2)
	  $printout=func_get_arg (2);

	$this->debug = TRUE;
  	echo ($printout) ? '<table width="200" border="1">':'<table width="600" border="0" class="table_content">';
  	echo '
  			<tr>
  				<!--<td valign="top" >
  					<p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDPrescriptionOther.'</font></span></span></p>
  				</td>-->
  				<td>';

      			$billelems=$this->GetElemsOfBill($bill_nr,"prescriptions");

      			echo '<table border="0" width="100%">';
      			while($bill_elems_row=$billelems->FetchRow()) {
      				$insurance_used += $bill_elems_row['balanced_insurance'];
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				}
      				$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
      				if($this->debug) '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
      				$sum += $part_sum;

                    // description of the item
	   				echo '<tr>';
      					echo '<td colspan="2"><b>'.$desc.'</b></td>';
      				echo '</tr>';
      				// price out of the list:
	   				echo '<tr>';
      					echo '<td>'.$LDPrice.'</td>';
      					echo '<td>'.$price.'</td>';
      				echo '</tr>';
      				// Quantity...
	   				echo '<tr>';
      					echo '<td>Quatity</td>';
      					echo '<td>'.$bill_elems_row['amount'].'</td>';
      				echo '</tr>';
     				// How much is covered by insurance
	   				echo '<tr>';
      					echo '<td>'.$LDPaidbyInsurance.'</td>';
      					if($bill_elems_row['balanced_insurance']>0)
      						echo '<td>'.number_format($bill_elems_row['balanced_insurance'],2,',','.').'</td>';
      					else
      						echo '<td>0,00</td>';

      				echo '</tr>';
      				// Show the calculated sum of it now
	   				echo '<tr>';
      					echo '<td><b>'.$LDpartSum.'</b></td>';
      					echo '<td><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],2,',','.').'</b></td>';
      				echo '</tr>';
					// an emtpy row
	   				echo '<tr>';
      					echo '<td colspan="2"><hr>&nbsp;</td>';
      				echo '</tr>';


      			} // end of while($bill_elems_row=$billelems->FetchRow())

      			$sum -= $bill_elems_row['balanced_insurance'];
	  echo '</table>';

	  return $sum;
	}


//------------------------------------------------------------------------------

function DisplayCompanyPrescriptionBill($bill_nr, $edit_fields){

	global $root_path, $billnr, $batch_nr;
	global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,
	       $LDPrescriptionOther;
	       global $db;
	$this->debug = TRUE;

      			$billelems=$this->GetElemsOfBill($bill_nr,"prescriptions");

      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$insurance_used += $bill_elems_row['balanced_insurance'];
      				$pos_nr+=1;
      				if($bill_elems_row['is_medicine']==1)
      				{
      					$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					 $desc = $bill_elems_row['description'];
      					$price = $bill_elems_row['price'];
      				 $sql="select distinct(purchasing_class) from care_tz_drugsandservices where item_description='$desc'";
				    $result=$db->Execute($sql);
				    $purchasing_class_row=$result->FetchRow();
					 $purchasing_class=$purchasing_class_row['purchasing_class'];
				    switch($purchasing_class)
				    {
				    	case "xray":
						$xray_amt += $price*$bill_elems_row['amount'];
						break;
						case "smallop":
						$dress_amt += $price*$bill_elems_row['amount'];
						break;
						case "bigop":
						$surgery_amt += $price*$bill_elems_row['amount'];
						break;
						case "dental":
						$dental_amt += $price*$bill_elems_row['amount'];
						break;
						case "drug_list":
						$drug_amt1 += $price*$bill_elems_row['amount'];
						break;
						case "special_others_list":
						$drug_amt2 += $price*$bill_elems_row['amount'];
						break;
						case "supplies":
						$drug_amt3 += $price*$bill_elems_row['amount'];
						break;
						case "service":
						$service_amt += $price*$bill_elems_row['amount'];
						break;
						default:
							$others_amt += $price*$bill_elems_row['amount'];
							//return FALSE;
				    }

      				}
      				$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
      				if($this->debug) '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
      				$sum += $part_sum;

						 //$insurance_amt +=$bill_elems_row['balanced_insurance'];

      			}
      			//$sum -= $bill_elems_row['balanced_insurance'];
			//$total_laboratory = $this->DisplayCompanyLaboratoryBill($bills['nr'],$edit_fields);
				//echo $insurance_amt;
				$drug_amt=$drug_amt1+$drug_amt2+$drug_amt3;



				$billelems=$this->GetElemsOfBill($bill_nr,"laboratory");
      			//echo "edit fields is set to:".$edit_fields;

      			while($bill_elems_row=$billelems->FetchRow())
      			{
      				$pos_nr+=1;
      				$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
      				$insurance_used_lab +=$bill_elems_row['balanced_insurance'];
      				if($bill_elems_row['is_labtest']==1)
      				{
      				  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
      					$this->chemlab_testname=$bill_elems_row['description'];
      					$this->price=$bill_elems_row['price'];
      					if (empty($this->price)) $this->price="0,00";

      				}
      				$part_sum = ($this->price*$bill_elems_row['amount']);
      				$sum_lab += $part_sum;

      				$insurance_amt +=$bill_elems_row['balanced_insurance'];
      			}
      			$sum_lab -= $insurance_used_lab;

		if($sum_lab==0)$sum_lab=$insurance_amt;


				$sum=$drug_amt+$others_amt+$service_amt+$dental_amt+$surgery_amt+$dress_amt+$xray_amt;
				$total_amt=$sum_lab+$drug_amt+$others_amt+$service_amt+$dental_amt+$surgery_amt+$dress_amt+$xray_amt;


				echo '<table border="2" width="100%">

  		<tr>
  				<tr><td>Service(TSH)</td><td>'.number_format(($service_amt),2,',','.').'</td></tr>
		  		<tr><td>Labs(TSH)</td><td>'.number_format(($sum_lab),2,',','.').'</td></tr>
		  		<tr><td>X-Ray(TSH)</td><td>'.number_format(($xray_amt),2,',','.').'</td></tr>
		  		<tr><td>Dawa(TSH)</td><td>'.number_format(($drug_amt),2,',','.').'</td></tr>
		  		<tr><td>Proc/Surg(TSH)</td><td>'.number_format(($surgery_amt),2,',','.').'</td></tr>
		  		<tr><td>Dress(TSH)</td><td>'.number_format(($dress_amt),2,',','.').'</td></tr>
		  		<tr><td>Dental(TSH)</td><td>'.number_format(($dental_amt),2,',','.').'</td></tr>
		  		<tr><td>Others(TSH)</td><td>'.number_format(($others_amt),2,',','.').'</td></tr>
		  		<tr><td>Total(TSH)</td><td>'.number_format(($total_amt),2,',','.').'</td></tr>

		</tr>


  	  				</table>';



	  return $sum;
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

	function DisplayArchivedBills($batch_nr, $specific_bill, $edit_fields)
	{
  		  global $db, $insurancebudget, $used_budget, $ceiling, $insurance_tz, $bill_obj;
  		  global $LDInsurance,$LDOldBudget,$LDUsedBudget,$LDOverdrawnBudget,$LDOverdrawnPayment,
  		  		 $LDNoCompanyCredit,$LDCompanyCredit,$LDLabTotal,$LDPrescTotal,$LDSumtopay,
  		  		 $LDInsuranceTotal,$LDSummary;

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
	  	<table width="200"  border="0" align="center" class="table_content">';
  		$billnumbers=$this->GetArchivedBill($specific_bill);
  		if ($billnumbers)
    		while($bills=$billnumbers->FetchRow())
    		{

				$bill_timestamp = $bill_obj->GetBillTimestamp($bills['nr']);

				$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($batch_nr,$bill_timestamp);
				$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($batch_nr, $matchingContract['start_date'], $bill_timestamp);
				$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
				$used_budget = array_sum($matchingBills);
				$insurancebudget = $ceiling-$used_budget;

				if ($printout==FALSE) {
						//Java script for print out the bill
					// We have to place it here, because here is one place where we have the bill number what is
					// definetly displayed on the user-screen
				/*	echo '<script language="javascript" >
				      <!--
				      function printOut_'.$bills['nr'].'()
				      {
				      	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }
				      // -->
				      </script>
				      ';*/
				}
  				echo '
  					<tr>
  						<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
  						$this->DisplayBillHeadline($bills['nr'], $batch_nr);
  						echo '
  						</font></span></span></td>
  					</tr>';
    			$sum_to_pay =0;
    			$sum = 0;

    			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"laboratory");
  				if($bill_elems_row=$billelems->FetchRow())
  				{
	  	  			echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
	  	  					$total_laboratory = $this->DisplayArchivedLaboratoryBill($bills['nr'],$edit_fields);
		  	      		echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
	        	}
	        	$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"prescriptions");
  				if($bill_elems_row=$billelems->FetchRow())
  				{
  					echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
	  	  					$total_prescription = $this->DisplayArchivedPrescriptionBill($bills['nr'],$edit_fields);
		  	      		echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
	        	}
	        	if($insurancebudget<0)
	        	{
	        		echo '<tr><td><table border="0" ><tr><td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDInsurance.'</font></span></span></td><td><table  border="0" align="right"><tr>
	        				<td align="right" ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOldBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget+$used_budget),2,',','.').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDUsedBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($used_budget),2,',','.').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnBudget.'</font></span></span></td>
	        				<td colspan="2">
	        					<font color="FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format(($insurancebudget),2,',','.').'</font></span></span></font>
	        				</td>
	        			  </tr>';
	        		$contract = $insurance_tz->CheckForValidContract($batch_nr,0,$insurance_tz->GetCompanyFromPID($batch_nr));
	        		if($contract['gets_company_credit'])
	        		{
	        			  echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDCompanyCredit.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget*-1),2,',','.').'
	        				</font></span></span></td>
	        			  </tr>';
	        		}
	        		else
	        		{
	        			  echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnPayment.'</font></span></span></td>
	        				<td width="150"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDNoCompanyCredit.'</font></span></span></td><td>
	        					<i>'.number_format(($insurancebudget*-1),2,',','.').'</font></span></span><br>
	        					----------</i>
	        				</td>
	        			  </tr><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
	        			  $sum_to_pay += $insurancebudget*-1;

	        		}
	        		echo '</font></span></span></table></td></tr></td></tr></table>';
	  	      		echo '
	  	      		</td>
	  	      		</tr>';
        		}
        		$sum_to_pay += $total_laboratory;
        		$sum_to_pay += $total_prescription;
				echo '
				<tr>
					<td>
						<table  border="0" class="headline" align="right">
							<tr>
								<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$LDSummary.'</font></span></span></td>
								<td>
									<table border="0">
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDLabTotal.'
											</font></span></span></td>
											<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_laboratory),2,',','.').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDPrescTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_prescription),2,',','.').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDInsuranceTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												';
												if($insurancebudget<0) echo number_format(($insurancebudget*-1),2,',','.');
												else echo '0,00';
												echo '
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right">
												<b><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$LDSumtopay.'</font></span></span></b>
											</td>
											<td><b><font color="#FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($sum_to_pay),2,',','.').'</font><br>
												=======</b>
											</font></span></span></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>';
    		}
	}


//------------------------------------------------------------------------------

	function DisplayBills($batch_nr, $specific_bill, $edit_fields) {
	  global $insurancebudget, $used_budget, $ceiling, $insurance_tz, $bill_obj,$HTTP_SESSION_VARS,$sid;
	  global $LDInsurance,$LDOldBudget,$LDUsedBudget,$LDOverdrawnBudget,$LDOverdrawnPayment,
  		  	 $LDNoCompanyCredit,$LDCompanyCredit,$LDLabTotal,$LDPrescTotal,$LDSumtopay,
  		  	 $LDInsuranceTotal,$LDSummary,$LDNoPendingBills,$LDTranferPendingBillArchive,$LDDone;
	 $this->debug=FALSE;
	  if (func_num_args()>3)
	    $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
		*/
		global $db,$user_origin;

	  	echo ($printout) ? '<table width="200"  border="1">' : '<table width="600"  border="0" class="table_content">';
  		if($specific_bill>0)
  		{
  			$billnumbers=$this->VerifyBill($specific_bill);
  		}
  		else
  		{
  			$billnumbers=$this->GetBillNumbersFromPID($batch_nr);
  		}
  		if ($billnumbers) {
    		while($bills=$billnumbers->FetchRow())
    		{

    			$ALL_PAID_BY_INSURANCE=FALSE;
				$bill_timestamp = $bill_obj->GetBillTimestamp($bills['nr']);
				$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($batch_nr,$bill_timestamp);
				$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($batch_nr, $matchingContract['start_date'], $bill_timestamp);
				$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
				$used_budget = array_sum($matchingBills);
				$insurancebudget = $ceiling-$used_budget;
				$this->debug=FALSE;

				if ($this->debug) {
					echo "ceiling = $ceuling<br> ";
					echo "used_budget = $used_budget<br> ";
					echo "insurancebudget = $insurancebudget<br> ";
					print_r  ($matchingContract);
				}
				if (!is_array($matchingContract['Member']) && $matchingContract['company_id']>0) {
					if ($this->debug) echo "<br><b>there is no ceiling but insured</b><br>";
					$used_budget=0;
					$insurancebudget=1; // must be greater than 0 (workaround, see below)
					$ALL_PAID_BY_INSURANCE=TRUE;
				}

				if ($printout==FALSE) {
						//Java script for print out the bill
					// We have to place it here, because here is one place where we have the bill number what is
					// definetly displayed on the user-screen
					echo '<script language="javascript" >
				      <!--
				      function printOut_'.$bills['nr'].'()
				      {
				      	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=380,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }
				      function printOut1_'.$bills['nr'].'()
				      {
				      	urlholder="show_company_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=380,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }

				      // -->
				      </script>
				      ';
				}
  				echo '
  					<tr>
  						<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
  						$this->DisplayBillHeadline($bills['nr'], $batch_nr, $printout);
  						echo '
  						</font></span></span></td>
  					</tr>';
    			$sum_to_pay =0;
    			$sum = 0;

    			$billelems=$this->GetElemsOfBill($bills['nr'],"laboratory");
  				if($bill_elems_row=$billelems->FetchRow())
  				{
	  	  			echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
	  	  					$total_laboratory = $this->DisplayLaboratoryBill($bills['nr'],$edit_fields, $printout);
		  	      		echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
	        	}
	        	$billelems=$this->GetElemsOfBill($bills['nr'],"prescriptions");
  				if($bill_elems_row=$billelems->FetchRow())
  				{
  					echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
	  	  					$total_prescription = $this->DisplayPrescriptionBill($bills['nr'],$edit_fields, $printout);
		  	      		echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
	        	}
	        	if($insurancebudget<0) 	{
	        		echo '<tr><td><table border="1" ><tr><td >#<span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDInsurance.'</font></span></span></td><td><table  border="0" align="right"><tr>
	        				<td align="right" ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOldBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget+$used_budget),2,',','.').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOldBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($used_budget),2,',','.').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnBudget.'</font></span></span></td>
	        				<td colspan="2">
	        					<font color="FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format(($insurancebudget),2,',','.').'</font></span></span></font>
	        				</td>
	        			  </tr>';
	        		$contract = $insurance_tz->CheckForValidContract($batch_nr,0,$insurance_tz->GetCompanyFromPID($batch_nr));
	        		if($contract['gets_company_credit'])
	        		{
	        			  echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDCompanyCredit.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget*-1),2,',','.').'
	        				</font></span></span></td>
	        			  </tr>';
	        		}
	        		else
	        		{
	        			  echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnPayment.'</font></span></span></td>
	        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDNoCompanyCredit.'</font></span></span></td><td>
	        					<i><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format(($insurancebudget*-1),2,',','.').'<br>
	        					----------</i>
	        				</font></span></span></td>
	        			  </tr>';
	        			  $sum_to_pay += $insurancebudget*-1;

	        		}
	        		echo '</table></td></tr></td></tr></table>';
	  	      		echo '
	  	      		</td>
	  	      		</tr>';
        		}


        		$sum_to_pay += $total_laboratory;
        		$sum_to_pay += $total_prescription;
				echo '
				<tr>
					<td>';
						echo ($printout) ? '<table  border="1" align="left">' : '<table  border="0" align="right" class="headline">';


						echo '<tr>
								<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDSummary.'</font></span></span></td>
								<td>
									<table border="0" >
										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.$LDLabTotal.'
											</font></span></span></td>
											<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.number_format(($total_laboratory),2,',','.').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.$LDPrescTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.number_format(($total_prescription),2,',','.').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.$LDInsuranceTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												';
												if($insurancebudget<0)
													echo number_format(($insurancebudget*-1),2,',','.');
												elseif ($ALL_PAID_BY_INSURANCE)
													echo number_format((($total_laboratory+$total_prescription)*-1),2,',','.');
												else echo '0,00';
												echo '
											</font></span></span></td>
										</tr>
										<tr>
											<td align="left">
												<span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDSumtopay.'</b>
											</font></span></span></td>
											<td><font color="#FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.number_format(($sum_to_pay),2,',','.').'</font></span></span></font><br>
												=======</b>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>';
	        	// is there the edit_fields flag set, then there should be finished the formular with the submit button.
	        	// If not, then show the three kinds of the main folder.
	        	echo '
	  			    <tr>
	  			  		<td>';
				$show_printout_button = TRUE;
				$show_done_button=TRUE;
				$show_edit_button=TRUE;
				$enc_obj = New Encounter;
				$encounter_nr = $enc_obj->GetEncounterFromBatchNumber($batch_nr);
		     	if ($printout==FALSE)
		     	{
					 if ($show_printout_button) echo '<a href="javascript:printOut_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" alt="Print this form"></a> ';
					   if ($show_printout_button) echo '<a href="javascript:printOut1_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_companybill.gif" border=0 align="absmiddle" ></a> ';
					 if ($edit_fields) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif"> &nbsp;&nbsp;&nbsp; '.$LDTranferPendingBillArchive.' <a href="billing_tz_pending.php?&mode=done&user_origin='.$user_origin.'&patient='.$_REQUEST['patient'].'&bill_number='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="'.$LDDone.'"></a>&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif">';
					 if (!$edit_fields) echo '<a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="absmiddle" width="120" height="24"></a>';
				}
	         	echo '</td>
	  			  	</tr>';
    		}
    	}
    	else
    	{
    	  echo '<br><br><tr><td><div align="center"><h1>'.$LDNoPendingBills.'</h1><div></td></tr>';
      	}
	  	echo'

	  	</table>';
	  	echo ($printout) ? '<font color="#FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">Billed by:'.$HTTP_SESSION_VARS['sess_user_name'].'</font></span></span></font><br>' : '';

	  //if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}

	//------------------------------------------------------------------------------


function DisplayCompanyBills($batch_nr, $specific_bill, $edit_fields) {
	  global $insurancebudget, $used_budget, $ceiling, $insurance_tz, $bill_obj;
	  global $LDInsurance,$LDOldBudget,$LDUsedBudget,$LDOverdrawnBudget,$LDOverdrawnPayment,
  		  	 $LDNoCompanyCredit,$LDCompanyCredit,$LDLabTotal,$LDPrescTotal,$LDSumtopay,
  		  	 $LDInsuranceTotal,$LDSummary,$LDNoPendingBills,$LDTranferPendingBillArchive,$LDDone;
	 $this->debug=FALSE;
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
	  	<table width="325" border="1">';
  		if($specific_bill>0)
  		{
  			$billnumbers=$this->VerifyBill($specific_bill);
  		}
  		else
  		{
  			$billnumbers=$this->GetBillNumbersFromPID($batch_nr);
  		}
  		if ($billnumbers) {
    		while($bills=$billnumbers->FetchRow())
    		{

    			$ALL_PAID_BY_INSURANCE=FALSE;
				$bill_timestamp = $bill_obj->GetBillTimestamp($bills['nr']);
				$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($batch_nr,$bill_timestamp);
				$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($batch_nr, $matchingContract['start_date'], $bill_timestamp);
				$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
				$used_budget = array_sum($matchingBills);
				$insurancebudget = $ceiling-$used_budget;
				$this->debug=FALSE;

				if ($this->debug) {
					echo "ceiling = $ceuling<br> ";
					echo "used_budget = $used_budget<br> ";
					echo "insurancebudget = $insurancebudget<br> ";
					print_r  ($matchingContract);
				}
				if (!is_array($matchingContract['Member']) && $matchingContract['company_id']>0) {
					if ($this->debug) echo "<br><b>there is no ceiling but insured</b><br>";
					$used_budget=0;
					$insurancebudget=1; // must be greater than 0 (workaround, see below)
					$ALL_PAID_BY_INSURANCE=TRUE;
				}

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
				      function printOut1_'.$bills['nr'].'()
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
	  	  					$total_laboratory = $this->DisplayCompanyLaboratoryBill($bills['nr'],$edit_fields);
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
	  	  					$total_prescription = $this->DisplayCompanyPrescriptionBill($bills['nr'],$edit_fields);
		  	      		echo '
		  	      		</td>
		  	      	</tr>';
	        	}
	        	if($insurancebudget<0) 	{
	        		echo '<tr><td><table border="1" width="200"><tr><td width="105">#'.$LDInsurance.'</td><td><table width="200" border="0" align="right"><tr>
	        				<td align="right" width="408">'.$LDOldBudget.'</td>
	        				<td colspan="2">
	        					'.number_format(($insurancebudget+$used_budget),2,',','.').'
	        				</td>
	        			  </tr>
	        			  <tr>
	        				<td align="right">'.$LDOldBudget.'</td>
	        				<td colspan="2">
	        					'.number_format(($used_budget),2,',','.').'
	        				</td>
	        			  </tr>
	        			  <tr>
	        				<td align="right">'.$LDOverdrawnBudget.'</td>
	        				<td colspan="2">
	        					<font color="FF0000">'.number_format(($insurancebudget),2,',','.').'</font>
	        				</td>
	        			  </tr>';
	        		$contract = $insurance_tz->CheckForValidContract($batch_nr,0,$insurance_tz->GetCompanyFromPID($batch_nr));
	        		if($contract['gets_company_credit'])
	        		{
	        			  echo '<tr>
	        				<td align="right">'.$LDCompanyCredit.'</td>
	        				<td colspan="2">
	        					'.number_format(($insurancebudget*-1),2,',','.').'
	        				</td>
	        			  </tr>';
	        		}
	        		else
	        		{
	        			  echo '<tr>
	        				<td align="right">'.$LDOverdrawnPayment.'</td>
	        				<td width="150">'.$LDNoCompanyCredit.'</td><td>
	        					<i>'.number_format(($insurancebudget*-1),2,',','.').'<br>
	        					----------</i>
	        				</td>
	        			  </tr>';
	        			  $sum_to_pay += $insurancebudget*-1;

	        		}
	        		echo '</table></td></tr></td></tr></table>';
	  	      		echo '
	  	      		</td>
	  	      		</tr>';
        		}


        		$sum_to_pay += $total_laboratory;
        		$sum_to_pay += $total_prescription;


        		/*if($total_prescription==0)
        		{
        			 echo '<table border="2">

		  		<tr><td>Service(TSH)</td><td>'.number_format(($service_amt),2,',','.').'</td></tr>
		  		<tr><td>Labs(TSH)</td><td>'.number_format(($total_laboratory),2,',','.').'</td></tr>
		  		<tr><td>X-Ray(TSH)</td><td>'.number_format(($xray_amt),2,',','.').'</td></tr>
		  		<tr><td>Dawa(TSH)</td><td>'.number_format(($drug_amt),2,',','.').'</td></tr>
		  		<tr><td>Proc/Surg(TSH)</td><td>'.number_format(($surgery_amt),2,',','.').'</td></tr>
		  		<tr><td>Dress(TSH)</td><td>'.number_format(($dress_amt),2,',','.').'</td></tr>
		  		<tr><td>Dental(TSH)</td><td>'.number_format(($dental_amt),2,',','.').'</td></tr>
		  		<tr><td>Others(TSH)</td><td>'.number_format(($others_amt),2,',','.').'</td></tr>
		  		<tr><td>Total(TSH)</td><td>'.number_format(($total_laboratory),2,',','.').'</td></tr>

  			<tr>

		</tr>

  	  				</table>';
        		} */

				echo '
				<tr>
					<td>
						<!--<table width="200" border="1">
							<tr>
								<td width="100">'.$LDSummary.'</td>
								<td>
									<table border="0" width="200">
										<tr>
											<td align="right">
												'.$LDLabTotal.'
											</td>
											<td width="105">
												'.number_format(($total_laboratory),2,',','.').'
											</td>
										</tr>
										<tr>
											<td align="right">
												'.$LDPrescTotal.'
											</td>
											<td>
												'.number_format(($total_prescription),2,',','.').'
											</td>
										</tr>
										<tr>
											<td align="right">
												'.$LDInsuranceTotal.'
											</td>
											<td>
												';
												if($insurancebudget<0)
													echo number_format(($insurancebudget*-1),2,',','.');
												elseif ($ALL_PAID_BY_INSURANCE)
													echo number_format((($total_laboratory+$total_prescription)*-1),2,',','.');
												else echo '0,00';
												echo '
											</td>
										</tr>
										<tr>
											<td align="right">
												<b>'.$LDSumtopay.'</b>
											</td>
											<td><b><font color="#FF0000">
												'.number_format(($sum_to_pay),2,',','.').'</font><br>
												=======</b>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>-->
					</td>
						<tr><td><font size="4">Patient Sign:.........................</font></td></tr>
				</tr>';
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
		     	if ($printout==FALSE)
		     	{
					 if (!$show_printout_button) echo '<a href="javascript:printOut_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" width="99" height="24" alt="Print this form"></a> ';
					   if (!$show_printout_button) echo '<input type="button" value="CompanyBill" onclick="javascript:printOut1_'.$bills['nr'].'()">';
					 if ($edit_fields) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif"> &nbsp;&nbsp;&nbsp; '.$LDTranferPendingBillArchive.' <a href="billing_tz_pending.php?&mode=done&user_origin='.$user_origin.'&bill_number='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="'.$LDDone.'"></a>&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif">';
					 if (!$edit_fields) echo '<a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="absmiddle" width="120" height="24"></a>';
				}
	         	echo '</td>
	  			  	</tr>';
    		}
    	}
    	else
    	{
    	  echo '<br><br><tr><td><div align="center"><h1>'.$LDNoPendingBills.'</h1><div></td></tr>';
      	}
	  	echo'

	  	</table>';
	  //if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}

	//------------------------------------------------------------------------------






	function ArchiveBill($bill_number) {
	  global $db;
	  global $user_id,$sid,$local_user;
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
                      (`nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, `is_paid`, `amount`, `price`, `balanced_insurance`, `insurance_id`, `description`, `item_number`, `prescriptions_nr`)
                  SELECT `nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, 1, `amount`, `price`, `balanced_insurance`, `insurance_id`, `description`, `item_number`, `prescriptions_nr` FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
    $this->result=$db->Execute($this->sql);


    if ($db->Insert_ID())
      $CARE_TZ_BILLING_ELEM_ARCHIVED=TRUE;


    $user_id=$_SESSION['sess_user_name'];


	$this->sql = "UPDATE care_tz_billing_archive_elem SET user_id='$user_id' WHERE nr=".$bill_number;
      $db->Execute($this->sql);


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

  function GetQuotationStatus($in_outpatient)
	{
		if($in_outpatient == 'inpatient')
		{
			return "AND care_encounter.encounter_class_nr = 1";
		}
			else if($in_outpatient == 'outpatient' )
		{
			return "AND care_encounter.encounter_class_nr = 2";
		}
			else
		{
			return "";
		}
	}

  //------------------------------------------------------------------------------

  function GetNewQuotation_Prescriptions($encounter_nr,$in_outpatient) {
    global $db;
    /**
    * Returns all new prescriptions in a recordset. If no Encounter-Nr is given
    * the result-list is grouped by encounters
    */

	$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);

    $this->debug=false;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Prescriptions()</b><br>";

   if($encounter_nr>0)
    	$where_encounter='AND care_encounter_prescription.encounter_nr = '.$encounter_nr;
    else
    {
    	$where_encounter='GROUP BY care_encounter_prescription.encounter_nr, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
    	$anzahl= 'count(*) AS anzahl,';
    }
   $this->sql = "SELECT $anzahl  		care_encounter_prescription.*, " .
    		"							care_person.pid, " .
    		"							care_person.selian_pid, " .
    		"							care_person.name_first, " .
    		"							care_person.name_last, " .
    		"							care_person.date_birth," .
    		"							care_tz_drugsandservices.unit_price," .
    		"							care_tz_drugsandservices.unit_price_1," .
    		"							care_tz_drugsandservices.unit_price_2," .
    		"							care_tz_drugsandservices.unit_price_3" .
    		"							from care_encounter_prescription
										INNER JOIN care_encounter ON care_encounter.encounter_nr=care_encounter_prescription.encounter_nr
										INNER JOIN care_person On care_person.pid=care_encounter.pid
										INNER JOIN care_tz_drugsandservices ON care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id
									WHERE care_encounter_prescription.bill_number = 0 $and_in_outpatient

									AND 	(isnull(care_encounter_prescription.is_disabled)
									OR care_encounter_prescription.is_disabled='')
									$where_encounter
									ORDER BY care_encounter_prescription.prescribe_date DESC , care_encounter_prescription.encounter_nr ASC";

    $this->request = $db->Execute($this->sql);
    return $this->request;

  }

  //------------------------------------------------------------------------------

  function GetNewQuotation_Laboratory($encounter_nr,$in_outpatient) {

	/*$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);

    global $db;
    /**
    * Returns all new laboratory requests in a recordset. If no Encounter-Nr is given
    * the result-list is grouped by encounters
    */
  /*  $this->debug=true;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Laboratory()</b><br>";
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
    return $this->request;*/

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
    if ($this->debug) echo "<br><b>Method class_tz_billing::GetLaboratoryCount()</b><br>";
  	$where_encounter='AND ctr.encounter_nr = '.$encounter_nr;
  	$where_encounter.=' GROUP BY ctr.encounter_nr, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth';
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


  function ShowNewQuotations($in_outpatient,$sid)
  {

  	global $db;
  	$counter=0;
  	$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotations()</b><br>";

	$result = $this->GetNewQuotation_Prescriptions(0,$in_outpatient);


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
	      $labinfo = $this->GetLaboratoryCount($row['encounter_nr'], $in_outpatient);
	      if(empty($labinfo['anzahl'])) $labinfo['anzahl'] = 0;


					echo '
          <tr>
          			<form method="GET" action="billing_tz_quotation_select_pricelist.php">
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['prescribe_date'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['anzahl'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center"><input type="hidden" name="namelast" value="'.$row['name_last'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" name="namefirst" value="'.$row['name_first'].'"><input type="hidden" name="countpres" value="'.$row['anzahl'].'"><input type="hidden" name="countlab" value="'.$labinfo['anzahl'].'"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					  </form>
					</tr>';
				$alreadyshown[$row['encounter_nr']] = $row['encounter_nr'];


	    	}

/*			$result = $this->GetNewQuotation_Laboratory(0,$in_outpatient);
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
			          	<form method="GET" action="billing_tz_quotation_create.php">
								  <td '.$BGCOLOR.' class="td_content"><div align="center">'.substr($row['modify_time'],0,10).'</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['encounter_nr'].'</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['selian_pid'].'</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['date_birth'].'</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center">0 pres.<br>'.$row['anzahl'].' req.</div></td>
								  <td '.$BGCOLOR.' class="td_content"><div align="center"><input type="hidden" name="namelast" value="'.$row['name_last'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" name="namefirst" value="'.$row['name_first'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" name="countpres" value="0"><input type="hidden" name="countlab" value="'.$row['anzahl'].'"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					   </form>
					 </tr>';
							}
				    }
	    	}*/


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
					  <td '.$BGCOLOR.'><div align="center"><input type="hidden" name="createmode" value="laboratory"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
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

	function GetMeaningOfPrices($pricing_field) {
		/*
		 * This Mehtord returns description to an column of prices of the pricing
		 * table care_tz_drugsandservices, columns unit_price,unit_price_1,unit_price_2,unit_price_3
		 */
		 global $db;
		 $this->debug=FALSE;
    	 ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		  $this->sql = 'SELECT ShowDescription FROM care_tz_drugsandservices_description WHERE `Fieldname`="'.$pricing_field.'"';

    	 $this->request = $db->Execute($this->sql);
    	 if ($row=$this->request -> FetchRow())
    	 	return $row['ShowDescription'];
    	 else
    	 	return "N/A";

	} // end of function GetMeaningOfPrices($pricing_field)

	//------------------------------------------------------------------------------

	function ShowNewQuotationEncounter_Prescriptions($encounter_nr,&$id_array)
    {

 	global $db, $insurancebudget;
	if (func_num_args()>2) {
		$IS_PATIENT_INSURED=func_get_arg(2);
	}

  	# 4 lang
  	global $LDNotes, $LDDosage,$LDPrice,$LDInsurance,$LDPricing,$LDTSH,$LDPricing,$LDNothingtodo,$test;

  	$this->debug=false;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotationEncounter_Prescriptions()</b><br>";

    $result = $this->GetNewQuotation_Prescriptions($encounter_nr);

    if($result)
    {
    	$unit_price_description=$this->GetMeaningOfPrices('unit_price');
    	$unit_price_1_description=$this->GetMeaningOfPrices('unit_price_1');
    	$unit_price_2_description=$this->GetMeaningOfPrices('unit_price_2');
    	$unit_price_3_description=$this->GetMeaningOfPrices('unit_price_3');

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


	      // Check if unit_price is NULL -> replace it with 0 as number
	      if (empty($row['unit_price']))
	      	$unit_price="0";
	      else
	      	$unit_price=$row['unit_price'];
		  // replace , to . if needed:
	      $unit_price = strtr($unit_price, ',','.');

	      // Check if unit_price_1 is NULL -> replace it with 0 as number
	      if (empty($row['unit_price_1']))
	      	$unit_price_1="0";
	      else
	      	$unit_price_1=$row['unit_price_1'];

		  // replace , to . if needed:
	      $unit_price_1 = strtr($unit_price_1, ',','.');


	      // Check if unit_price_2 is NULL -> replace it with 0 as number
	      if (empty($row['unit_price_2']))
	      	$unit_price_2="0";
	      else
	      	$unit_price_2=$row['unit_price_2'];

		  // replace , to . if needed:
	      $unit_price_2 = strtr($unit_price_2, ',','.');


	      // Check if unit_price_3 is NULL -> replace it with 0 as number
	      if (empty($row['unit_price_3']))
	      	$unit_price_3="0";
	      else
	      	$unit_price_3=$row['unit_price_3'];

		  // replace , to . if needed:
	      $unit_price_3 = strtr($unit_price_3, ',','.');

	      echo '
          <tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="620">
					  		<tr bgcolor="#ffffaa">
					  			<td width="150">
					  				<div align="left">'.$row['prescribe_date'].'</div>
					  			</td>
					  			<td width="250">
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
					  				'.$LDNotes.'<br>
					  				<textarea rows="3" cols="22" name="notes_'.$row['nr'].'">'.$row['notes'].'</textarea>
					  			</td>
					  			<td valign="top">
					  				<table border="0" cellpadding="0" cellspacing="0" width="250"  class="table_content">
					  					<tr >
					  						<td width="5">'.$LDPrice.'</td>
					  						<td align="right">

					  							                                                    <input type="hidden" name="showprice_'.$row['nr'].'" id="showprice_'.$row['nr'].'" value="'.$unit_price.'">'.$row['price'].' '.$LDTSH.'
					  								<br><font size="1">'.$unit_price_description.':'.$unit_price.' '.$LDTSH.'  <input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price.'"'; if($_REQUEST['unit_price']==1)  echo 'checked ';  echo ' onclick="document.forms[0].elements[\'showprice_\' + '.$row['nr'].'].value = '.$unit_price.';calc_article('.$row['nr'].')"></font>
					  								<br><font size="1">'.$unit_price_1_description.':'.$unit_price_1.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_1.'"'; if($_REQUEST['unit_price']==2)  echo 'checked ';  echo '  onclick="document.forms[0].elements[\'showprice_\' + '.$row['nr'].'].value = '.$unit_price_1.';calc_article('.$row['nr'].')"></font>
					  								<br><font size="1">'.$unit_price_2_description.':'.$unit_price_2.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_2.'"'; if($_REQUEST['unit_price']==3)  echo 'checked ';   echo ' onclick="document.forms[0].elements[\'showprice_\' + '.$row['nr'].'].value = '.$unit_price_2.';calc_article('.$row['nr'].')"></font>
					  								<br><font size="1">'.$unit_price_3_description.':'.$unit_price_3.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_3.'"'; if($_REQUEST['unit_price']==4)  echo 'checked ';   echo ' onclick="document.forms[0].elements[\'showprice_\' + '.$row['nr'].'].value = '.$unit_price_3.';calc_article('.$row['nr'].')"> </font><br></td>
					  					</tr>
					  					<tr>
					  						<td>'.$LDDosage.'</td>
					  						<td align="right"><input onkeyup="calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.$row['dosage'].'" name="dosage_'.$row['nr'].'"></td>
					  					</tr>';
									if ($IS_PATIENT_INSURED){
									echo '
					  					<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="right"><input onkeyup="calc_article(\''.$row['nr'].'\')" type="text" size="4" value="'.($row['dosage']*$row['price']).'" name="insurance_'.$row['nr'].'"></td>
					  					</tr>';
									}
									echo '
					  				</table>
					  			</td>
					  			<td valign="top">
					  				<u>'.$LDPricing.'</u><br>
					  				<div  id="div_'.$row['nr'].'"></div>
					  			</td>
					  		</tr>
					  	</table>
					  </td>
					</tr>';

	    }
	 	} // end of if($result)
	  else
	  	echo '<tr><td colspan="8">'.$LDNothingtodo.'</td></tr>';
  }



  //------------------------------------------------------------------------------

	function ShowNewQuotationEncounter_Laboratory($encounter_nr, &$id_array)
  {
  	global $db,$root_path, $insurancebudget;
  	global $LDInsurance,$LDPricing,$LDPricing;

	if (func_num_args()>2) {
		$IS_PATIENT_INSURED=func_get_arg(2);
	}


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
					  					</tr>';

									if ($IS_PATIENT_INSURED) echo '
					  					<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="right"><input onkeyup="calc_article(\''.$row['batch_nr'].'\')" type="text" size="4" value='.$sum.' name="insurance_'.$row['batch_nr'].'"> TSH</td>
					  					</tr>';
									echo '
					  				</table>
					  			</td>
					  			<td valign="top">
					  				<u>'.$LDPricing.'</u><br>
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
	  	echo '<tr><td colspan="5">'.$LDPricing.'</td></tr>';
  }

function new_reg($encounter,$reg,$prescriber)
	{
	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;


  	  $this->sql="SELECT `item_id`, `item_description`, `unit_price` FROM care_tz_drugsandservices where item_description='".$reg."'";
    $this->request=$db->Execute($this->sql);
    while ($this->res=$this->request->FetchRow()) {

     $item_id=$this->res['item_id'];
      $item_description=$this->res['item_description'];
      $unit_price=$this->res['unit_price'];


					$this->sql="insert into care_encounter_prescription(encounter_nr,article,article_item_number,price,prescribe_date,prescriber,history,modify_time,dosage)values('".$encounter."','".$item_description."','".$item_id."','".$unit_price."','".date('Y-m-d')."','".$prescriber."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','1')";
  					#$this->sql="insert into care_encounter_prescription(encounter_nr)values('".$encounter."')";
  					$db->Execute($this->sql);


    }
  return TRUE;
	}


function disable_reg($encounter_nr,$type,$reg)
	{
	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$sql="Select * from care_encounter_prescription where encounter_nr=$encounter_nr  ";


	$sql2="select * from care_encounter_prescription as a
			inner join care_tz_drugsandservices as b on a.article_item_number = b.item_id
			where a.encounter_nr=$encounter_nr AND (isnull(a.is_disabled) OR a.is_disabled='')  AND b.item_number like '$type%'";

	//echo $sql2;
	$result=$db->Execute($sql2);

	while($encounter=$result->FetchRow())
	{
		$article_nr=$encounter['article_item_number'];
	}


  	$sql="Update care_encounter_prescription
				set is_disabled='Disabled by Registration officer'
				where encounter_nr=$encounter_nr and article_item_number=$article_nr";
  	$db->Execute($sql);

  	//echo $sql;



	// Update the care_encounter_prescripting with new information given at admission process.

	// Lösche die Einträge aus care_encounter_prescription, welche Registration oder Consultaiton fee betreffen

	// Verwende new_reg um eben dieses element was gelöscht wurde wieder anzulegen

}
//-------------------------------------

function CountArchivedBill() {
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;


    $sql= "SELECT distinct count(nr) as 'anzahl' FROM care_tz_billing_archive";
    $result=$db->Execute($sql);

    while($anzahl=$result->FetchRow())
	{
		return $anzahl['anzahl'];
	}
}
//-------------------------------------

function DisplayAllArchivedBill($txtsearch,$searchtyp, $start_timeframe,$end_timeframe, $max_page_count,$month, $year, $sorttyp) {

	global $db,$type;
	$this->debug=true;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$search[0]=$txtsearch;
	$search[1]=$searchtyp;

	$sql_count="SELECT count(*) as count FROM care_encounter " .
			   "inner join care_tz_billing_archive on care_tz_billing_archive.encounter_nr=care_encounter.encounter_nr " .
			   "inner join care_person on care_encounter.pid = care_person.pid " .
			   "inner join care_tz_billing_archive_elem on care_tz_billing_archive.id = care_tz_billing_archive_elem.nr ";

	if( $search[0] == '' || $search[1] == '')
	{
	    $sql_count.="WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
		$sql=$this->getSqlStatment($sql_count, $max_page_count,$start_timeframe,$end_timeframe, "1",$txtsearch, $sorttyp);
	}
	else
	{
		$txtsearch=$search[0];

	    if($search[1] =='all')
	    {
			if($search[0]!='*')
			{
				if(is_numeric($txtsearch))
				{

					$sql_count .="where care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch";
					$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,"6",$txtsearch, $sorttyp);
				}
				else if(is_string($txtsearch))
				{
					$sql_count .= "where care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch'";
					$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,"4",$txtsearch, $sorttyp);
				}
			}
			else if($search[0]=='*')
			{
	    		$sql=$this->getSqlStatment($sql_count, $max_page_count,$start_timeframe,$end_timeframe, "2",$txtsearch, $sorttyp);
			}
	    }
	    else if ($search[1] == 'month')
	    {
			if($search[0]!='*')
			{
				if(is_numeric($txtsearch))
				{
					$sql_count .="where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND ( care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch)";
					$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,"7",$txtsearch, $sorttyp);
				}
				else if(is_string($txtsearch))
				{
				$sql_count .= "where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND ( care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch')";
				$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,"5",$txtsearch, $sorttyp);
				}

			}
			else if($search[0]=='*')
			{

				$sql_count .="WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
	    		$sql=$this->getSqlStatment($sql_count, $max_page_count,$start_timeframe,$end_timeframe, "3",$txtsearch,$sorttyp);
			}
	    }

	}
	$result=$db->Execute($sql);
	$color_change=FALSE;

	while($bills=$result->FetchRow())
	{
		if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	    } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	     }

		$this->DisplayBillsInfo($bills,$BGCOLOR);
	}

	$this->DisplayNavi($sql_count,$max_page_count,$txtsearch, $search[1],$month, $year);



}
//-------------------------------------

function DisplayBillsInfo($bills,$BGCOLOR)
{

		global $db;
		$this->debug=false;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$enc_obj = new Encounter;

		echo '<tr class="tr_content">';

		echo '<td '.$BGCOLOR.' class="td_content"><div align="center" ><a href="billing_tz_archive.php?displaybill=true&bill_nr='.$bills['nr'].'&batch_nr='.$bills['pid'].'">'.$bills['nr'].'</a></div></td>';
		echo '<td '.$BGCOLOR.'class="td_content"><div align="center" >'.date("j F Y",$bills['date_change']).'</div></td>';
		echo '<td '.$BGCOLOR.'class="td_content"><div align="center" >'.number_format($bills['price']*$bills['amount'],2).'</div> </td>';
		echo '<td '.$BGCOLOR.' class="td_content"><div align="center" >'.$enc_obj->ShowPID($bills['pid']).'</div></td>';
		echo '<td '.$BGCOLOR.'class="td_content"><div align="center" >'.$bills['User_Id'].'</div> </td>';

		echo '</tr>';
}

function getSqlStatment($sql,$max_page_count,$start_timeframe,$end_timeframe,$type,$txtsearch,$sorttyp)
{
	global $db;
	$this->debug=false;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
	if ($this->debug) echo "<br>method::getSqlStatment($sql,$max_page_count,$start_timeframe,$end_timeframe,$type,$txtsearch)<br>";
	$result=$db->Execute($sql);

	while($bills=$result->FetchRow())
	{
		$bill_count=$bills['count'];
	}

	$page_anz= $this->getPageCount($bill_count, $max_page_count);

	if($_REQUEST['next'] != true)
	{
		$from = 0;
	}

	if($_REQUEST['next'] == true)
	{
		$from = ($_REQUEST['page']-1)*$max_page_count;
	}
	else if($_REQUEST['back']==true)
	{
		$from= ($_REQUEST['page']*$max_page_count) - $max_page_count;
	}

	$sql= "SELECT * FROM care_encounter inner join care_tz_billing_archive on " .
	      "care_tz_billing_archive.encounter_nr=care_encounter.encounter_nr " .
		  "inner join care_person on care_encounter.pid = care_person.pid " .
		  "inner join care_tz_billing_archive_elem on care_tz_billing_archive.nr = care_tz_billing_archive_elem.nr ";

	switch ($type) {

    case 1: // not search
		$sql.= "WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
		break;
	case 2: // search all
		$sql.= "";
		break;
	case 3: // search by selected month
		$sql.=" WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
		break;
	case 4: // search by selected month
		$sql.= "where care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch'";
		break;
	case 5: // search by selected month
		$sql.= "where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND (care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch')";
		break;
	case 6:
		$sql.="where care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch";
		break;
	case 7:
		$sql.="where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND ( care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch)";
		break;
	}

	switch($_REQUEST['sortby'])
	{
		case "nr":
			$order = " care_tz_billing_archive_elem.nr " . $sorttyp;
		break;
		case "date":
			$order = " care_tz_billing_archive_elem.date_change " . $sorttyp;
		break;
		case "price":
			$order = " care_tz_billing_archive_elem.price*care_tz_billing_archive_elem.amount" . " " . $sorttyp;
		break;
		case "User_Id":
			$order = " care_tz_billing_archive_elem.user_id " . $sorttyp;
		break;
		case "pid":
			$order = " care_person.pid " . $sorttyp;
		break;

		default: $order = " care_tz_billing_archive_elem.date_change asc";
	}

	$sql.= " order by" .$order;


	if($bill_count>$max_page_count)
	{
		$sql.=" limit $from,$max_page_count";
	}

	return $sql;


}

function getPageCount($total_num_of_records, $num_of_rows_to_display)
{
	if($total_num_of_records>$num_of_rows_to_display)
	{
			if($total_num_of_records % $num_of_rows_to_display != 0)
			{
				$page_anz =  ceil($total_num_of_records / $num_of_rows_to_display);
			}
			else
			{
				$page_anz = $total_num_of_records / $num_of_rows_to_display;
			}
	}

	return $page_anz;
}

function DisplayNavi($sql_count,$max_page_count,$txtsearch, $type, $month, $year)
{

	global $db;
	$this->debug=false;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$result=$db->Execute($sql_count);

	while($bills=$result->FetchRow())
	{
		$bill_count=$bills['count'];
	}

	$page_anz = $this->getPageCount($bill_count,$max_page_count);

	if($bill_count>$max_page_count)
	{
		$pagenr=$_REQUEST['page'];

		echo ' <td colspan="5" align="center">';
		echo '<table with="100%">';
		echo '<tr>';
		echo '<td align="right">';
		if($_REQUEST['page']>1)
		{
			$pagenr=$_REQUEST['page']-1;
			echo '<a href="billing_tz_archive.php?back=true&month='.$month.'&year='.$year.'&show=Show&print=true&page='.$pagenr.'&txtsearch='.$txtsearch.'&searchtyp='.$type.'">  <-Back-> ';
		}
		echo '</td>';
		echo '<td align="left">';

		if($_REQUEST['page']!=$page_anz)
		{
			$pagenr=$_REQUEST['page']+1;
			echo '<a href="billing_tz_archive.php?next=true&month='.$month.'&year='.$year.'&show=Show&print=true&page='.$pagenr.'&txtsearch='.$txtsearch.'&searchtyp='.$type.'">  <-Next-> ';

		}
		echo '</td>';
		echo '<td>';
		echo '</td>';
		echo "Page: " . $_REQUEST['page'] . " / " . $page_anz;
		echo '</tr>';
		echo '</td>';
		echo '</table>';
	}

}

function ShowPriceList()
{
	global $db;
	$this->debug=false;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$result=$db->Execute('SELECT * FROM care_tz_drugsandservices_description');
	echo '<table border="1" cellpadding="0" cellspacing="0" width="250"  class="table_content" align="center" >
			<tr class="tr_content">
				<td align="center" bgcolor="#CC9933"><font size="2" class="submenu_item">Select Pricelist</font></td></tr><tr>
				<td align="center" bgcolor="#FFFF88"><p>';
	while($pricelist=$result->FetchRow())
	{
		echo'<font size="2">'.$pricelist['ShowDescription'].' <input type="radio" name="unit_price" value="'.$pricelist['ID'].'"'; if($pricelist['ID']=='1') echo 'checked'; echo'></font></br>';
	}
	echo '</td></tr></table></p>';
}

}


?>