<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

    /* include('includes/condb.php');
    error_reporting(0);
    connect_db(); */   
    if($patnum==""){
    	$patient_no=$patientno;
    }else{
        $patient_no=$patnum;
    }
$breakfile='search.php'.URL_APPEND;
?>
<html>

<head>
<Script language=Javascript>
<!--
function subbill()
{
	document.patientfrm.action="patient_bill_links.php";
	document.patientfrm.submit();
}
function subpayment()
{
	document.patientfrm.action="patient_payment_links.php";
	document.patientfrm.submit();
}
function subLT()
{
	document.patientfrm.action="select_services.php?service=LT";
	document.patientfrm.submit();
}
function subHS()
{
	document.patientfrm.action="select_services.php?service=HS";
	document.patientfrm.submit();
}
function show()
{
	document.patientfrm.action="patient_payment.php";
	document.patientfrm.submit();
}
function finalbill()
{
	document.patientfrm.action="final_bill.php";
	document.patientfrm.submit();
}


//-->
</script>

<title>Patient Name</title>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>eComBill</strong></font></td>
      </tr>
    </table>

<form name="patientfrm" method="POST" action="">
  <input type="hidden" name="patientno" value="<?php echo $patient_no; ?>">
 
  <?php //echo "<blockquote><blockquote>&nbsp;&nbsp;&nbsp;&nbsp;<b>Patient Number : ".$patient_no."</b></blockquote></blockquote>"; ?>
  <?php echo "<blockquote><blockquote>&nbsp;&nbsp;&nbsp;&nbsp;<b>Patient Number : ".$full_en."</b></blockquote></blockquote>"; ?>
  <div align="center">
    <center>
    <table border="1" width="585" height="11" bordercolor="#000000" style="border-style: solid">
      <tr>
        <td width="348" height="155" valign="top" bordercolor="#FFFFFF">
          <a href="javascript:subHS()">Select Hospital Services</a>

          <p><a href="javascript:subLT()">Select Laboratory Tests</a></p>



<p><a href=javascript:subbill()>View Bill</a>
<p><a href=javascript:subpayment()>View Payment</a>
<p><a href=javascript:show()>Make a New Payment</a>

<?php

$chkfinalquery="SELECT * from care_billing_final WHERE final_encounter_nr='$patient_no'";
/*$chkfinalresult=mysql_query($chkfinalquery);
$chkexists=mysql_num_rows($chkfinalresult);    
*/
$chkfinalresult=$db->Execute($chkfinalquery);
if(is_object($chkfinalresult)) $chkexists=$chkfinalresult->RecordCount();    
//if($chkexists<1)
if(!$chkexists)
{
	echo "<p><a href=javascript:finalbill()>Generate the Final Bill</a>";
}

?>

        <td width="287" height="155" valign="top" bordercolor="#FFFFFF">
        </td>
      </tr>
      <tr><td colspan="2" height="1" width="641" bordercolor="#FFFFFF">

      <?php
           
    	if($chkexists>0)
    	{ 
     		echo "<br><br><h4>This patient has cleared all the bills.</h4>";
     	}
     	
      ?>
        </td></tr>

<!--       <tr>
        <td height="105" width="479" bordercolor="#FFFFFF">
        </td>
      </tr>
 -->
      <tr><td height="47" width="414" bordercolor="#FFFFFF">
        </td></tr>

    </table>
    </center>
  &nbsp;</p>
 		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>      </center>
 </div>
  <p>&nbsp;</p>

<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="full_en" value="<?php echo $full_en ?>">

</form>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
 </FONT>
</body>
</html>

