<?php
$LDHeadlines='Headlines';
$LDCafeNews='Cafeteria News';
$LDManagement='Management';
$LDHealthTips='Health Tips';
$LDEducation='Education';
$LDStudies='Studies';
$LDExhibitions='Exhibitions';
$LDHeadline='Headline';
$LDAdmission='Admission';
/* 2003-08-20 DH */
$LDAllDoctors='List of all doctors';
$LDAnesthesiology='Anesthesiology';
$LDCafeteria='Cafeteria News';
$LDGeneralSurgery='General Surgery';
$LDEmergencySurgery='Emergency Surgery';
$LDPlasticSurgery='Plastic Surgery';
$LDEarNoseThroath='Ear-Nose-Throath';
$LDOpthalmology='Opthalmology';
$LDPathology='Pathology';
$LDObGynecology='Ob-Gynecology';
$LDPhysicalTherapy='Physical Therapy';
$LDInternalMedicine='Internal Medicine';
$LDIntermediateCareUnit='Intermediate Care Unit';
$LDIntensiveCareUnit='Intensive Care Unit';
$LDEmergencyAmbulatory='Emergency Ambulatory';
$LDInternalMedicineAmbulatory='Internal Medicine Ambulatory';
$LDSonography='Sonography';
$LDNuclearDiagnostics='Nuclear Diagnostics';
$LDPediatric='Pediatric clinic';
$LDOncology='Oncology';
$LDNeonatal='Neonatal';
$LDCentralLaboratory='Central Laboratory';
$LDSerologicalLaboratory='Serological Laboratory';
$LDChemicalLaboratory='Chemical Laboratory';
$LDBacteriologicalLaboratory='Bacteriological Laboratory';
$LDTechnicalMaintenance='Technical Maintenance';
$LDITDepartment='IT Department';
$LDGeneralAmbulatory='General Ambulatory';
$LDBloodBank='Blood Bank';
$LDNursing='Nursing';
/* 2003-04-27 EL */
$LDMedical='Medical';
$LDSupport='Non-medical';
$LDNews='News';
$LDDepartment='Department';
$LDPressRelations='Presse';
/* 2003-05-19 EL */
$LDSelectDept='Select department';
/*2003-06-15 EL*/
$LDPlsSelectDept='Please select a department';
$LD_AllMedicalDept='____All medical departments_____';
$LDClinic='Clinic';
#2003-10-23 EL
$LDPlsNameFormal='Please enter the formal name';
$LDPlsDeptID='Please enter the department\'s ID';
$LDPlsSelectType='Please select the type';
#2006-09-13 d.r. from merotech
$LDARVClinic='ARV Clinic';
$LDDentalClinic='Dental Clinic';
$LDGeneralOutpatientClinic='General Outpatient Clinic';

#
# 2010-05-20 from Dennis Mollel (cybertech)
# +255-786-196-933 @ dennis.mollel@yahoo.com
#

$LDNOPATIENT = 'You have no Patient';

	# ROOM Header
$LDroomSeparatorTop=
	'<table width="99%" style="margin:0 0 10px 0;" align="center" border="0" cellspacing="3" cellpadding="0">
	  <tr>
	    <td style="padding:10px; background:green; border:1px solid black; font:bold 14px Tahoma, Arial, sans-serif; text-align:center; color:#FFFFFF;">
	    	' .
	    	'Room Name: ' .
	    		'<big><font color=yellow>~room~</font><big>' .  # DO NOT EDIT ~room~
	    	'
	    </td>
	  </tr>
	  <tr>
    	<td>';

	# no patients in a list
$LDRoomNoPatient =
	'<tr>
	    <td style="padding:10px; background:red; border:1px solid black; font:bold 14px Tahoma, Arial, sans-serif; text-align:center; color:#FFFFFF;">
	    	'.$LDNOPATIENT.'
	    </td>
	  </tr>';

	# close table
$LDroomSeparatorBottom =
		'</td>
	  </tr>
	</table>';
?>
