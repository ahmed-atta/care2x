<?php
$LDDiagnosticTest='Diagnostic Test Order';
$LDHospitalName='Central Hospital';
$LDCentralLab='Central Laboratory';
$LDLabel='Label';
$LDRoomNr='Room-Nr.';
$LDSamplingTime='Sampling Time';
$LDDay='Day';
$LDMinutes='Minutes';
$LDHours='Hours';
$LDBatchNr='Batch Nr.';
$LDCaseNr='Case number';
$LDHouse='House';
$LDHematology='Hematology';
$LDCoagulation='Coagulation';
$LDUrine='Urine';
$LDSerum='Serum';
$LDGlucose='Glucose';
$LD9Hour='9.00';
$LD15Hour='15.00';
$LDSober='sober';
$LDBloodSugar='BLS';
$LDBLoodSugar1='BLS1';
$LDBloodPlasma='BLP';
$LDDoctorSignature='Doctor\'s signature';
$LDLifeRisk='Risk to life';
$LDRarity='Rarity';
$LDSpecTest='special Tests';
$LDClinicalInfo='clinical info';

$LDShortMonth[0]='';
$LDShortMonth[1]='Jan';
$LDShortMonth[2]='Feb';
$LDShortMonth[3]='Mar';
$LDShortMonth[4]='Apr';
$LDShortMonth[5]='May';
$LDShortMonth[6]='Jun';
$LDShortMonth[7]='Jul';
$LDShortMonth[8]='Aug';
$LDShortMonth[9]='Sep';
$LDShortMonth[10]='Oct';
$LDShortMonth[11]='Nov';
$LDShortMonth[12]='Dec';
								   
$LDShortDay[0]='So';
$LDShortDay[1]='Mo';
$LDShortDay[2]='Tu';
$LDShortDay[3]='We';
$LDShortDay[4]='Th';
$LDShortDay[5]='Fr';
$LDShortDay[6]='Sa';
$LDShortDay[7]='So';
				
$LDBatchNumber='Batch nr.';
$LDMaterial='Material:';
$LDEmergencyProgram='The violet shaded fields belong to emergency program';
$LDPhoneOrder=' = must be confirmed by phone';
/* 2002-09-03 EL */							  
$LDSearchPatient='Search patient';
$LDPlsSelectPatientFirst='Please search for the patient first.';
/* 2002-09-11 EL */
$LDPendingTestRequest='Pending Test Request';
/* 2002-10-14 EL */
$LDDone='It\'s done! Move the form to the archive';


//gjergji
//used to calculate the max_rows per column
$SQLStatementNum = "SELECT id,name,status FROM care_test_param WHERE status NOT IN ('deleted','hidden') ORDER BY name"; 
$rowNum = $db->Execute($SQLStatementNum);
$numRows = $rowNum->numRows();
$max_row = round($numRows / 7);


//gjergji : thanx to Robert Mengle for the idea...a for the code also :)
$SQLStatement = "SELECT id , name FROM care_test_param WHERE group_id = -1 AND status NOT IN ('deleted','hidden') ORDER BY sort_nr";
$top_rs = $db->Execute($SQLStatement);

if(!empty($top_rs) && isset($top_rs)) {
	$column=0;
	$row=-1;
	while ($categories = $top_rs->FetchRow()) {
		$row++;
		if($row>=$max_row) {
			$column++;
			$row=0;
		}
		$LD_Elements[$column][$row]['type'] = 'top';
		$LD_Elements[$column][$row]['value'] = strtoupper($categories['name']);
		$LD_Elements[$column][$row]['id'] = $categories['id'];
		$SQLStatementParam = "SELECT id,name,status FROM care_test_param WHERE group_id = '".$categories['id']."' AND status NOT IN ('deleted','hidden') ORDER BY name"; 
		$row_rs = $db->Execute($SQLStatementParam);
		if(!empty($row_rs) && isset($row_rs)) {
			while ($parameters = $row_rs->FetchRow()) {
				$row++;
				if($row>=$max_row) {
					$column++;
					$row=0;
				}
			$LD_Elements[$column][$row]['type'] = 'normal';
			$LD_Elements[$column][$row]['value'] = $parameters['name'];
			$LD_Elements[$column][$row]['id'] = $parameters['id'];
			}
		}
	}
}
?>