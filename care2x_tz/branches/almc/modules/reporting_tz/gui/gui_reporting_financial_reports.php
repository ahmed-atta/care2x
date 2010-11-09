
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
	urlholder="../../main/help-router.php?sid=<?php echo sid;?>&lang=$lang&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
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

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid;?>&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

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
    					&nbsp;&nbsp;<font color="#330066"><?php echo $LDFinReports; ?></font></td>
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
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="cash_billing_summary.php"><?php echo $LDCashCollReport; ?></a></td>
                  <td><?php echo $LDCashCollectionReport; ?></td>
                </tr>

		<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="billing_revenue_summary.php"><?php echo $LDRevenueReport; ?></a></td>
                  <td><?php echo $LDRevenueReportTxt; ?></td>
                </tr>

		 <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="cash_financial_report.php"><?php echo $LDCashRevenueReport; ?></a></td>
                  <td><?php echo $LDCashRevenueReportTxt; ?></td>
                </tr>

                                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="credit_financial_report.php"><?php echo $LDCreditRevenueReport; ?></a></td>
                  <td><?php echo $LDCreditRevenueReportTxt; ?></td>
                </tr>

		                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="insurance_company_financial.php"><?php echo 'Company Financial Overview'; ?></a></td>
                  <td><?php echo 'Daily Financial Record listened of a specific Company'; ?></td>
                </tr>

				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="companies_financial_summary.php"><?php echo 'Companies Financial Summary'; ?></a></td>
                  <td><?php echo 'Monthly Summary of Insurance companies'; ?></td>
                </tr>


 				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_dental.php"><?php echo $LDDentalReport; ?></a></td>
                  <td><?php echo $LDMonthlyDentalReport; ?></td>
                </tr>
				
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_pharmacy.php"><?php echo $LDPharmacyReport; ?></a></td>
                  <td><?php echo $LDGenerallyPharmacyReport; ?></td>
                </tr>
                
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_xray.php"><?php echo $LDRadRevReport; ?></a></td>
                  <td><?php echo $LDRadRevenueReport; ?></td>
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
                  <td class="submenu_item"><a href="billing_cash_summary.php"><?php echo 'Cash Receipts Summary'; ?></a></td>
                  <td><?php echo 'Cash Receipts Financial Summary'; ?></td>
                </tr>
			<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="billing_insurance_summary.php"><?php echo 'Insurance Receipts Summary'; ?></a></td>
                  <td><?php echo 'Credit Receipts Financial Summary'; ?></td>
                </tr>
               
                <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="general_surgeries_report.php"><?php echo 'General Surgeries Report'; ?></a></td>
                  <td><?php echo 'General Surgeries Report'; ?></td>
                </tr>

				 <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="obgyne_surgeries_report.php"><?php echo 'Ob/Gyne Surgeries Report'; ?></a></td>
                  <td><?php echo 'OB / Gyne Surgeries Report'; ?></td>
                </tr>

				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="ortho_surgeries_report.php"><?php echo 'Orthopedics Surgeries Report'; ?></a></td>
                  <td><?php echo 'Procedures and Operations Report'; ?></td>
                </tr>
				
				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_tracking.php"><?php echo $LDAuditReport; ?></a></td>
                  <td><?php echo $LDMonthlyAuditReport; ?></td>
                </tr>
				
				<tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="reporting_weberp.php"><?php echo $LDWebERPReport; ?></a></td>
                  <td><?php echo $LDMonthlyWebERPReport; ?></td>
                </tr>
                <!--
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
                </tr>
                 <tr>
                  <td align=center><img src="../../gui/img/common/default/eyeglass.gif" border=0 width="17" height="17"></td>
                  <td class="submenu_item"><a href="javascript:getARV('modules/arv/arv_reporting_cstatistics.php')">HIV C-Statistics</a></td>
                  <td>C-Statistics Overview</td>
                </tr>
                 -->
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
