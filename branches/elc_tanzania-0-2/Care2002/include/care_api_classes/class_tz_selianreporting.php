<?php
/**
* Care2x API package
* @package care_api
*/

/**
* selian reporting methods.
* Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @author Robert Meggle (www.MEROTECH.de: meggle@merotech.de)
* @version beta 0.0.1
* @copyright 2006 Robert Meggle, based on the development of Elpidio Latorilla
* @package care_api
*/

/**
* Include the class_report if it�s not done so far...
*/
require_once($root_path.'include/care_api_classes/class_report.php');

/**
* Class and its members..
*/
class selianreport extends report {

  /**
  * constructor
  */
  function class_selianreport() {
    global $db;
    $this->debug=FALSE;
    $this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
	}

	function GetPIDOfLaspedContract($days='') {
	  global $db;
    $rep_obj = new report();
    $tmp_reporting_table_1 = $rep_obj -> SetReportingLink('care_tz_insurance','PID','care_person','pid');
    $tmp_reporting_table_2 = $rep_obj -> TMP_GroupBy($tmp_reporting_table_1,'care_tz_insurance_PID');
    $rep_obj -> DisconnectReportingTable($tmp_reporting_table_1);

    $now = time();
    $seconds = $days * 24 * 60;
    $asked_time = $now-$seconds;

    $this->setTable($tmp_reporting_table_2);
    $this->sql="SELECT selian_pid, date_reg, name_first, name_2, name_3, name_middle, name_last, name_maiden, name_others FROM $this->coretable WHERE end_date < $asked_time";
    $mysql_ptr = $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------------------------------------------------

	function Display_OPD_Diagnostic($start,$end) {
	global $db;
	global $PRINTOUT;
	global $LDNoDiagnosticsResults;
	$rep_obj = new selianreport();
	$debug=FALSE;
	($debug)?$db->debug=TRUE:$db->debug=FALSE;
	$sql_timeframe = "  ( timestamp>=".$start." AND timestamp<=".$end.") ";

	$tmp_tbl_OPD_diagnostic = $rep_obj -> SetReportingLink('care_person','pid', 'care_tz_diagnosis','PID');

	// get the Diagnostic-Codes, Diagnostic-full-name and total out of this table:
	$sql = "SELECT ICD_10_code, ICD_10_description, UNIX_TIMESTAMP(date_birth) as date_birth
				FROM $tmp_tbl_OPD_diagnostic WHERE $sql_timeframe
				group by ICD_10_code";

	if ($rs_ptr = $db->Execute($sql))
		$res_array = $rs_ptr->GetArray();

	if (!$res_array) echo "<font color=\"red\">".$LDNoDiagnosticsResults."</font><br><br>";

	$SHOW_COLORS = $printout ? TRUE : FALSE;
	$bg_col_marker=TRUE;

	while (list ($i,$v)=each($res_array)) {
		if ($SHOW_COLORS) {
			if ($bg_col_marker) {
				echo "<tr bgcolor=#ffffaa>";
				$bg_col_marker = FALSE;
			} else {
				echo "<tr bgcolor=#ffffdd>";
				$bg_col_marker = TRUE;
			}
		}
		$icd_10_code = $v['ICD_10_code'];
		$icd_10_description = $v['ICD_10_description'];
		echo "<td>$icd_10_code</td>";
		echo "<td>$icd_10_description</td>";

		/**
		 * Amount by age
		 */


		$sql = "SELECT count(date_birth) as total From $tmp_tbl_OPD_diagnostic WHERE
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total = $row['total'];



		$sql = "SELECT count(date_birth) as total_under_age From $tmp_tbl_OPD_diagnostic WHERE
					UNIX_TIMESTAMP(date_birth) <= (now() - DATE_SUB(UNIX_TIMESTAMP(date_birth), INTERVAL 5 year))
			    AND
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total_under_age =  $row['total_under_age'];

		$total_over_age = $total - $total_under_age;

		echo "<td>$total_under_age</td>";
		echo "<td>$total_over_age</td>";


		/**
		 * Amount by sex
		 */

		$sql = "SELECT count(date_birth) as total_female From $tmp_tbl_OPD_diagnostic WHERE
					sex='f'
			    AND
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total_female =  $row['total_female'];

		$sql = "SELECT count(date_birth) as total_male From $tmp_tbl_OPD_diagnostic WHERE
					sex='m'
			    AND
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total_male =  $row['total_male'];

		echo '<td width="69">'.$total_male.'</td>';
		echo '<td width="69">'.$total_female.'</td>';
		echo '<td>'.$total.'</td>';
		echo '</tr>';
		}
		$rep_obj->DisconnectReportingTable($tmp_tbl_OPD_diagnostic);
		return 1;
	}


	//------------------------------------------------------------------------------------------------------------------------

	function Display_OPD_Summary($start,$end) {
		global $db;

		$WITH_TIMEFRAME=FALSE;

		if (func_num_args()) {

			$start=func_get_arg(0);
			$end=func_get_arg(1);
			$WITH_TIMEFRAME=TRUE;
		}


		$rep_obj = new selianreport();

		$tmp_tbl_OPD_summary = $rep_obj -> SetReportingLink('care_person','pid', 'care_tz_diagnosis','PID');
		//$tmp_tbl_allpatients = $rep_obj -> SetReportingTable('care_person');

		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		$arr_ret['return']['underage'];
		$arr_ret['return']['adult'];
		$arr_ret['return']['male'];
		$arr_ret['return']['female'];
		$arr_ret['return']['total'];

		$arr_ret['NewRegistration']['underage'];
		$arr_ret['NewRegistration']['adult'];
		$arr_ret['NewRegistration']['male'];
		$arr_ret['NewRegistration']['female'];
		$arr_ret['NewRegistration']['total'];

		$arr_ret['Total']['underage'];
		$arr_ret['Total']['adult'];
		$arr_ret['Total']['male'];
		$arr_ret['Total']['female'];
		$arr_ret['Total']['total'];

		$arr_ret['Total_Pedriatics']['underage'];

		$arr_ret['revisit']['underage'];
		$arr_ret['revisit']['adult'];
		$arr_ret['revisit']['male'];
		$arr_ret['revisit']['female'];
		$arr_ret['revisit']['total'];

		/****************************************************************************************************
		 *  Revisit�s under 5
		 */

		$sql = "SELECT count(*) AS return_underage FROM $tmp_tbl_OPD_summary
					   WHERE type='new' AND UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year))) ";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['underage'] =  $row['return_underage'];

		/**
		 * Total revisits
		 */
		$sql = "SELECT count(*) AS total FROM $tmp_tbl_OPD_summary
					   WHERE type='new'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['total'] =  $row['total'];

		/**
		 * Revist�s over 5
		 */
		$arr_ret['return']['adult'] = $arr_ret['return']['total'] - $arr_ret['return']['underage'];

		/**
		 * Total male revisits
		 */
		$sql = "SELECT count(*) AS male FROM $tmp_tbl_OPD_summary
					   WHERE type='new' and sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['male'] =  $row['male'];

		/**
		 * Total female revisits
		 */
		$sql = "SELECT count(*) AS female FROM $tmp_tbl_OPD_summary
					   WHERE type='new' and sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['female'] =  $row['female'];


		/****************************************************************************************************
		 *  New Registration�s under 5
		 */

		$sql = "SELECT count(*) AS return_underage FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient' AND UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['underage'] =  $row['return_underage'];

		/**
		 * Total New Registration
		 */
		$sql = "SELECT count(*) AS Total FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient' ";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['total'] =  $row['Total'];

		/**
		 * New Registration�s over 5
		 */
		$arr_ret['NewRegistration']['adult'] = $arr_ret['NewRegistration']['total'] - $arr_ret['NewRegistration']['underage'];

		/**
		 * Total male New Registration
		 */
		$sql = "SELECT count(*) AS male FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient' and sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['male'] =  $row['male'];

		/**
		 * Total female New Registration
		 */
		$sql = "SELECT count(*) AS female FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient'  and sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['female'] =  $row['female'];

		/****************************************************************************************************
		 *  Total Registration�s under 5
		 */

		$sql = "SELECT count(*) AS Total_underage FROM $tmp_tbl_OPD_summary
					   WHERE UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))";
		if ($WITH_TIMEFRAME) $sql.=" AND (timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['underage'] =  $row['Total_underage'];

		/**
		 * Total New Registration
		 */
		$sql = "SELECT count(*) AS Total FROM $tmp_tbl_OPD_summary ";
		if ($WITH_TIMEFRAME) $sql.=" WHERE ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['total'] =  $row['Total'];

		/**
		 * New Registration�s over 5
		 */
		$arr_ret['Total']['adult'] = $arr_ret['Total']['total'] - $arr_ret['Total']['underage'];

		/**
		 * Total male New Registration
		 */
		$sql = "SELECT count(*) AS Total_male FROM $tmp_tbl_OPD_summary
					   WHERE sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['male'] =  $row['Total_male'];

		/**
		 * Total female New Registration
		 */
		$sql = "SELECT count(*) AS Total_female FROM $tmp_tbl_OPD_summary
					   WHERE sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['female'] =  $row['Total_female'];

		/**
		 * **************************************************************************************************
		 * Total Pedriatics
		 */
		$sql = "SELECT count(*) AS Total_underage FROM $tmp_tbl_OPD_summary
					   WHERE UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total_Pedriatics']['underage'] =  $row['Total_underage'];

		/****************************************************************************************************
		 *  Views for the same reasons:
		 */

		$sql = "SELECT count(*) AS return_underage FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit' AND UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))
		       ";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['underage'] = (empty($row['return_underage'])) ? 0 : $row['return_underage'];
		//$arr_ret['revisit']['underage'] =  $row['return_underage'];

		/**
		 * Total revisits
		 */
		$sql = "SELECT count(*) AS total FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$sql .= " GROUP BY ICD_10_code";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['total'] =  (empty($row['total']))? 0 : $row['total'];

		/**
		 * Revist�s over 5
		 */
		$arr_ret['revisit']['adult'] = $arr_ret['revisit']['total'] - $arr_ret['revisit']['underage'];

		/**
		 * Total male revisits
		 */
		$sql = "SELECT count(*) AS male FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit' and sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$sql .= " GROUP BY ICD_10_code";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['male'] =  (empty($row['male'])) ? 0 : $row['male'];

		/**
		 * Total female revisits
		 */
		$sql = "SELECT count(*) AS female FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit' and sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$sql .= " GROUP BY ICD_10_code";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['female'] =  (empty($row['female'])) ? 0 : $row['female'];

	$rep_obj->DisconnectReportingTable($tmp_tbl_OPD_summary);

	return $arr_ret;

	}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Laboratory-Section
	 */
	//------------------------------------------------------------------------------------------------------------------------

	function GetAllLaboratorySections() {

	}

	//------------------------------------------------------------------------------------------------------------------------
	function Display_Billing_Summary() {

	}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Billing-Section
	 */
	//--
    function DisplayBillingTableHead(){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecordOPD,$LDDate,$LDInvoice,$LDFileTSH,$LDMatTSH,$LDLabTSH,
    	       $LDXRayTSH,$LDDawaTSH,$LDProcSurgTSH,$LDDressTSH,$LDMengTSH,$LDJumlaTSH;

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"11\" align=\"center\">".$LDDailyFinancialRecordOPD."</td>\n";
		else
			$table_head .= "<td colspan=\"11\" align=\"center\">".$LDDailyFinancialRecordOPD."</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDInvoice."/td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFileTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMatTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLabTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDXRayTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDawaTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurgTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDressTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMengTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDJumlaTSH."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."Date</td>\n";
			$table_head .= "<td>".$LDInvoice."Invoice</td>\n" ;
			$table_head .= "<td>".$LDFileTSH."File(TSH)</td>\n" ;
			$table_head .= "<td>".$LDMatTSH."Mat(TSH)</td>\n" ;
			$table_head .= "<td>".$LDLabTSH."Lab(TSH)</td>\n" ;
			$table_head .= "<td>".$LDXRayTSH."X-Ray(TSH)</td>\n" ;
			$table_head .= "<td>".$LDDawaTSH."Dawa(TSH)</td>\n" ;
			$table_head .= "<td>".$LDProcSurgTSH."Proc/Surg(TSH)</td>\n" ;
			$table_head .= "<td>".$LDDressTSH."Dress(TSH)</td>\n" ;
			$table_head .= "<td>".$LDMengTSH."Meng(TSH)</td>\n" ;
			$table_head .= "<td>".$LDJumlaTSH."Jumla(TSH)</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }

	function _get_requested_day($start_time_frame, $day) {
		/**
		 * Private function: getting the exact date, beginning with start_time_frame (UNIX timestamp)
		 * adding the value given in the variable "day"
		 * Return value is an UNIX-Timestamp
		 */
		 $sec_to_add = $day * 24 * 60 * 60;
		 return $requested_day = $start_time_frame + $sec_to_add;
	}

	function _get_amount_of($start_timeframe,$day,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=FALSE;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDInvoice,$LDfile,$LDmat,$LDlab,$LDxray,$LDdawa,$LDsurg,$LDdress,$LDmeng,$LDjumla;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {
			case "invoice":
				if ($debug) echo $LDInvoice."<br>";
				$sql="SELECT count(nr) as RetVal FROM care_tz_billing_archive where $curr_day_start <=first_date AND $curr_day_end>=first_date";
				break;
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			case "mat": //Consultation
				if ($debug) echo $LDmat."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number<>'R01' AND item_number<>'R02' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";

				break;
			case "lab":
				if ($debug) echo $LDlab."<br>";
				// start und ende timeframe fehlt noch!
				$sql="SELECT SUM(price) as RetVal FROM care_tz_billing_archive_elem WHERE prescriptions_nr=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			case "xray":
				if ($debug) echo "xray<br>";
				$sql_filter="WHERE purchasing_class='xray' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			case "dawa":
				if ($debug) echo "dawa<br>";
				$sql_filter="WHERE purchasing_class='supplies' OR purchasing_class='supplies_laboratory' OR purchasing_class='special_others_list' OR purchasing_class='drug_list' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			case "surg":
				if ($debug) echo "surg<br>";
				$sql_filter="WHERE ( purchasing_class='bigop' OR purchasing_class='smallop') and (item_number<>'P31' AND item_number<>'P32') AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			case "dress":
				if ($debug) echo "dress<br>";
				$sql_filter="WHERE purchasing_class='smallop' AND $curr_day_start <=date_change AND $curr_day_end>=date_change and (item_number='P31' OR item_number='P32')";
				break;
			case "meng"://returns
			// returns: all patients, what got the service item R02
				if ($debug) echo "meng<br>";

   				$sql_filter="WHERE purchasing_class='service' AND item_number='R02' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			case "jumla":
				if ($debug) echo $LDjumla."<br>";
				$sql_filter="WHERE $curr_day_start <=date_change AND $curr_day_end>=date_change"; // count of all
				break;
			default:
				return FALSE;

		}
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];
		if ($filter=="jumla") {
			$sql_lab="SELECT SUM(price) as RetVal FROM care_tz_billing_archive_elem WHERE prescriptions_nr=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
			$db_obj_jumla = $db->Execute($sql_lab);
			$row_jumla=$db_obj_jumla->FetchRow();
			if ($jumla_lab=$row_jumla['RetVal'])
				$return_value +=$jumla_lab;

		}


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}

	function _Create_financial_tmp_master_table($start_timeframe,$end_timeframe) {
		global $db;
		$db->debug=FALSE;
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.is_labtest,
				  care_tz_billing_archive_elem.is_medicine,
				  care_tz_billing_archive_elem.is_comment,
				  care_tz_billing_archive_elem.is_paid,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				INNER JOIN care_encounter_prescription on care_encounter_prescription.bill_number=care_tz_billing_archive_elem.nr
				                                          and care_encounter_prescription.nr=care_tz_billing_archive_elem.prescriptions_nr
				INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_encounter_prescription.article_item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."')";
		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}

	function DisplayBillingTestSummary($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_financial_tmp_master_table($start_timeframe, $end_timeframe);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j F Y",$this->_get_requested_day($start_timeframe, $day-1, FALSE)).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"invoice", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"mat", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"xray", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"dawa", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"dress", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"meng", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"jumla", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"invoice", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"mat", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"xray", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dawa", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"surg", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dress", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"meng", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"jumla", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		echo $table;
	}
  	function DisplayBillingResultRows($start_timeframe, $end_timeframe){

  	}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Insurance Section
	 */
	//--
    function DisplayCompanyTableHead(){
		// Table definition will be organized by the variable $table_head from here:

		global $LDCompanyReportInsurance,$LDNameofemployee,$LDSelianfilenumber,$LDDateofcontract,$LDValidto,$LDPrice;
		// headline:
		$table_head = "<tr>\n";
		$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"11\" align=\"center\">".$LDCompanyReportInsurance."Company Report (Insurance)</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDNameofemployee."</td>\n";
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDSelianfilenumber."</td>\n" ;
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDDateofcontract."</td>\n" ;
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDValidto."</td>\n" ;
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDPrice."</td>\n" ;
		$table_head.="</tr>\n";
		echo $table_head;

    }

	function DisplayCompanyTestSummary($start_timeframe, $end_timeframe){}
	function DisplayCompanyResultRows($start_timeframe, $end_timeframe){}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Pharmacy Section
	 */
	//--

	function DisplayPharmacyTableHead(){
		global $PRINTOUT;
		global $LDPharmacyReportwithoutstockinfo,$LDDrugName,$LDAmountofDrugsused,$LDCostofdrugsused,$LDUnitPrice;

		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"11\" align=\"center\">".$LDPharmacyReportwithoutstockinfo."</td>\n";
		else
			$table_head .= "<td colspan=\"11\" align=\"center\">".$LDPharmacyReportwithoutstockinfo."</td>\n";
		$table_head.="</tr>\n";

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugName."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmountofDrugsused."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDCostofdrugsused."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDDrugName."</td>\n";
			$table_head .= "<td>".$LDAmountofDrugsused."d</td>\n" ;
			$table_head .= "<td>".$LDCostofdrugsused."</td>\n" ;
			$table_head .= "<td>".$LDUnitPrice."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}


	function _GetSumOfAmoutDrugs($item_number) {
		global $db;
		$sql="SELECT SUM(amount) as RetVal FROM tmp_billing_master WHERE item_number='".$item_number."'";
		$res_ptr=$db->Execute($sql);
		$res_row=$res_ptr->FetchRow();
		return $res_row['RetVal'];
	}

	function _GetTotalSumOfCostsDrugs() {
		global $db;
		$sql="SELECT SUM(amount*price) as RetVal FROM tmp_billing_master";
		$res_ptr=$db->Execute($sql);
		$res_row=$res_ptr->FetchRow();
		$return_value=$res_row['RetVal'];
		return (!empty($return_value))?$res_row['RetVal']:"&nbsp;";
	}

	function _GetSumOfCostsDrugs($item_number) {
		global $db;
		$sql="SELECT SUM(amount*price) as RetVal FROM tmp_billing_master WHERE item_number='".$item_number."'";
		$res_ptr=$db->Execute($sql);
		$res_row=$res_ptr->FetchRow();
		return $res_row['RetVal'];
	}


	function DisplayPharmacyResultRows($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforPharmacyReports,$LDstarttime,$LDendtime,$LDNothinginList,$LDNA,$LDtotal;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		$end_timeframe += (24*60*60-1);
		if (!$PRINTOUT) {
			$bg_color_1="#ffffaa";
			$bg_color_2="#ffffbb";
		} else {
			$bg_color_1="";
			$bg_color_2="";
		}
		$bg_color_swich=FALSE;

		$this->_Create_financial_tmp_master_table($start_timeframe,$end_timeframe);
		echo "Looking for Pharmacy Reports by time range: starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s",$end_timeframe)."<br><br><br>";
		$sql="SELECT item_number, description, price FROM tmp_billing_master WHERE purchasing_class='drug_list' GROUP BY item_number, price";
		$rs_ptr=$db->Execute($sql);
		$table="";
		if ($res_array = $rs_ptr->GetArray()) {

			while (list($u,$v)=each($res_array)) {

				if ($bg_color_swich) {
					$bg_color=$bg_color_1;
					$bg_color_swich=FALSE;
				} else {
					$bg_color=$bg_color_2;
					$bg_color_swich=TRUE;
				} // end of if ($bg_color_swich)

				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$v['description'];
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".$this->_GetSumOfAmoutDrugs($v['item_number']);
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".number_format($this->_GetSumOfCostsDrugs($v['item_number']), 0, '.', ',');
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".$v['price'];
				$table.="</td>\n";

				$table.="</tr>\n";
			} // end of while (list($u,$v)=each($res_array))
		} else {
				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$LDNothinginList;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.="N/A";
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="</tr>\n";
		} // End of if ($res_array = $rs_ptr->GetArray())
		$table .= "<tr bgcolor=$bg_color>\n";

		$table.="<td align=\"right\">\n";
		$table.="<b>".$LDtotal." &sum;</b>";
		$table.="</td>\n";

		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="<td align=\"right\">\n";
		$table.="  <b>".number_format($this->_GetTotalSumOfCostsDrugs(),0,'.',',')."</b>";
		$table.="</td>\n";

		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="</tr>\n";


		echo $table;
	}

  function SetReportingLink_OPDAdmission($tbl1,$tbl1_key,$tbl1_key1, $tbl2,$tbl2_key,$tbl2_key1) {
    global $db;
    if ($this->debug) echo "class_report::SetReportingLink($tbl1,$tbl1_key, $tbl2,$tbl2_key)<br>";
	// enlarge the max_tmp_table_size to the maximum what we can use:
	$this->Transact("SET @@max_heap_table_size=4294967296");
    if ( ! (empty($tbl1) || empty($tbl1_key) || empty($tbl1_key1) || empty($tbl2) || empty($tbl2_key) || empty($tbl2_key1)) ) {

      // For a given existing table from the database, we need more specific informations in the alias field

      // check it for table 1:
      $result_fields_tbl1 = $this->_SetColumnNamesAsString($tbl1,$this->GetFieldnames($tbl1));
      // check it for table 2:
      $result_fields_tbl2 = $this->_SetColumnNamesAsString($tbl2,$this->GetFieldnames($tbl2));

      // There are no TEXT nor BLOBS in TEMPORARY tables allowed: Clean it:
      $result_fields = $this->_ColumnNames($tbl1,$result_fields_tbl1,$tbl2,$result_fields_tbl2);

      $this->setTable($this->tmp_tbl_name.=time());
      $this->sql="CREATE TEMPORARY TABLE $this->coretable TYPE=HEAP SELECT $result_fields FROM $tbl1 INNER JOIN $tbl2 ON $tbl1.$tbl1_key=$tbl2.$tbl2_key and date_format( $tbl1.$tbl1_key1, '%d.%m.%y' )=date_format( $tbl2.$tbl2_key1, '%d.%m.%y' ) ";
      return ($this->Transact($this->sql)) ? $this->coretable : FALSE;
    } else {
      return FALSE;
    }
  }


}

?>