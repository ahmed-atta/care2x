
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid."&lang=".$lang;?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->

</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<script language="JavaScript">
<!--

function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang;?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
function getARV(path) {
	urlholder="<?php echo $root_path ?>"+path+"<?php echo URL_REDIRECT_APPEND; ?>";
	patientwin=window.open(urlholder,"arv","menubar=no,resizable=yes,scrollbars=yes");
	patientwin.resizeTo(screen.availWidth,screen.availHeight);
	patientwin.focus();
}

// -->
</script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT --->

<table width=100% border=0 cellspacing=0 height=100%>
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 				<tr valign=top  class="titlebar" >
  					<td width="202" bgcolor="#99ccff" >
    					&nbsp;&nbsp;<font color="#330066"><?php echo $LDRemortingMenu; ?></font></td>
						  <td width="408" align=right bgcolor="#99ccff">
						   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
						   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
						   <a href="<?php echo $root_path;?>modules/news/start_page.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
						  </td>
  					 </tr>
 </table>

<!-- END HEAD OF HTML CONTENT -->

<br><br><br>
<TABLE cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<TBODY>
	<TR>
		<TD><table cellpadding=3 cellspacing=1>
              <tbody class="submenu">
                <tr>
                  <td width="17" align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td width="172" class="submenu_item"><a href="OPD_diagnostic.php"><?php echo $LDOPDDiagnostic; ?></a> </td>
                  <td width="437"><?php echo $LDAllDiagnosticsbyICD10; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="OPD_summary.php"><?php echo $LDOPDSummary; ?></a>
                  </td>
                  <td><?php echo $LDAllvisits; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="OPD_summary_withoutdiagnosis.php"><?php echo $LDOPDSummary; ?></a>
                  </td>
                  <td><?php echo $LDAllvisitsWithoutDiagnosis; ?> </td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="OPD_infections.php"><?php echo $LDOPDInfectionsSummary; ?></a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="mtuha_icd10.php"><?php echo 'Mtuha-ICD10-Summary'; ?></a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="OPD_Admissions.php"><?php echo 'OPD Admission Summary'; ?>
                    </a></td>
                  <td><?php echo $LDOPDAdmissionReport; ?></td>
                </tr>
				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="OPD_Department_Admissions.php"><?php echo 'OPDAdmissionDepartmentSummary'; ?>
                    </a></td>
                  <td><?php echo '  OPD Admissions Department Summary Report'; ?></td>
                </tr>



               <!-- <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="OPD_total_summary.php"><?php echo $LDClinicSummary; ?></a> </td>
                  <td><?php echo $LDAllvisitsClinic; ?></td>
                </tr> -->

                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="laboratory.php"><?php echo $LDLaboratorySummary; ?></a></td>
                  <td><?php echo $LDMonthlyLabReport; ?></td>
                </tr>

                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_pharmacy.php"><?php echo $LDPharmacyReport; ?></a></td>
                  <td><?php echo $LDGenerallyPharmacyReport; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_dental.php"><?php echo $LDDentalReport; ?></a></td>
                  <td><?php echo $LDMonthlyDentalReport; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_xray.php"><?php echo $LDRadiologyReport; ?></a></td>
                  <td><?php echo $LDMonthlyRadiologyReport; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="art_billing_summary.php"><?php echo 'ARV Financial Report'; ?></a></td>
                  <td><?php echo 'Monthly ARV Patients Financial Report'; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="tb_billing_summary.php"><?php echo 'TB Financial Report'; ?></a></td>
                  <td><?php echo 'Monthly TB Patients Financial Report'; ?></td>
                </tr>

                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="javascript:getARV('modules/arv/arv_reporting_quarterly.php')">HIV Care Reporting</a></td>
                  <td>Quarterly Facility Based Reporting</td>
                </tr>

                 <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="javascript:getARV('modules/arv/arv_reporting_overview.php')">HIV Overview</a></td>
                  <td>Patient Data Overview</td>
                </tr>

                 <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="javascript:getARV('modules/arv/arv_reporting_cstatistics.php')">HIV C-Statistics</a></td>
                  <td>C-Statistics Overview</td>
                </tr>
                
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="billing_summary.php"><?php echo $LDFinancialReport; ?></a></td>
                  <td><?php echo $LDDailyFinancialRecord; ?></td>
                </tr>

                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="tracking_summary.php"><?php echo $LDTrackingReport; ?></a></td>
                  <td><?php echo $LDMonthlyTrackingReport; ?></td>
                </tr>

                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="cash_billing_summary.php"><?php echo 'CashReport'; ?></a></td>
                  <td><?php echo 'Daily Cash Collection Report'; ?></td>
                </tr>

                <!--<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="company_billing_summary.php"><?php echo 'CompanyFinancialReport'; ?></a></td>
                  <td><?php echo 'Daily Financial Record listened of a specific Companies'; ?></td>
                </tr>-->

				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="billing_cash_summary.php"><?php echo 'Cash Receipt-General Financial Summary'; ?></a></td>
                  <td><?php echo 'Cash Receipt-General Financial Summary'; ?></td>
                </tr>
			<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="billing_insurance_summary.php"><?php echo 'Insurance Receipt-General Financial Summary'; ?></a></td>
                  <td><?php echo 'Insurance Receipt-General Financial Summary'; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="prepaid_financial_summary.php"><?php echo 'Prepaid Financial Summary'; ?></a></td>
                  <td><?php echo 'Prepaid Financial Summary'; ?></td>
                </tr>

                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="dental_prepaid_financial_summary.php"><?php echo 'Dental Insurance Financial Summary'; ?></a></td>
                  <td><?php echo 'Dental Insurance Financial Summary'; ?></td>
                </tr>
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_weberp.php">webERP Transaction</a></td>
                  <td>Monthly failed Transaction</td>
                </tr>                
              </tbody>
            </table></TD>
	</TR>
	</TBODY>
</TABLE>
<br><br><br>






<!-- START BOTTIOM OF HTML CONTENT --->

<table width="100%" border="1" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
	<td align="center">
  		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   		<tr>
   			<td>
	    		<div class="copyright">
					<script language="JavaScript">
					<!-- Script Begin
					function openCreditsWindow() {

						urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
						creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

					}
					//  Script End -->
					</script>


					 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
					 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
					 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
					 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

				</div>
    		</td>
   		<tr>
  		</table>
	</td>
	</tr>
</table>
<!-- START BOTTIOM OF HTML CONTENT --->

</BODY>
</HTML>