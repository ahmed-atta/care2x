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
//define('NO_CHAIN',1);
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
/*
	include('includes/condb.php');
	error_reporting(0);
	connect_db();*/
$breakfile='billingmenu.php'.URL_APPEND;
?>
<html>
<head>
<Script language=JavaScript>

function check()
{
	var LTN,TC,LP;
	LTN=document.lab.LabTestName.value;
	TC=document.lab.TestCode.value;
	LP=document.lab.LabPrice.value;
	DC=document.lab.Discount.value;
	if(LTN=="")
	{
		alert("Enter Name of laboratory Test");
	}
	else if(TC=="")
	{
		alert("Enter Test Code/no.");
	}
	else if(LP=="")
	{
		alert("Enter Price per Unit");
	}
	else if(DC=="")
	{
		alert("Enter Discount allowed on this item");
	}
	else if(isNaN(LP))
	{
		alert("Enter Numeric Value for Price");

	}
	else if(isNaN(DC))
	{
		alert("Enter Numeric Value for Discount");

	}
	else
	{
		document.lab.action="post_service_entry.php?type=LT";
		document.lab.submit();
	}

}

</Script>
<title>Laboratory Tests</title>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>eComBill-
          Create Laboratory Test Item</strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </p>
  <form name="lab" method="POST" action="">
        <div align="center">
      <center>
    <TABLE cellSpacing=1 cellPadding=3 width=523 bgColor=#999999
            border=0 height="138">
              <TBODY>
              <TR bgColor=#eeeeee><td align=center colspan="2" height="73" width="511"><font color="#ff0000" size="5" 6?>
                  Laboratory Test Item</font>
                  <p><font color="#800000" size="4">Please enter the following:</font></td>

                <TR bgColor=#eeeeee><td align=left height="7" width="247">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Name of Laboratory Test</td>
                <TD height="7" width="254">

<input type="text" name="LabTestName" size="20"></TD></TR>

              <TR bgColor=#dddddd height=1>
                <TD colSpan=2 height="5" width="511"><IMG height=1 src="pics/hor_bar.bmp"
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=left height="8" valign="middle" width="247">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Test code/no.</td>
                <TD height="8" width="254">

<input type="text" name="TestCode" size="20"></TD></TR>

                <TR bgColor=#dddddd height=1>
                <TD colSpan=2 height="5" width="511"><IMG height=1 src="pics/hor_bar.bmp"
                  width=5></TD></TR>

              <TR bgColor=#eeeeee><td align=left height="8" valign="middle" width="247">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Price per unit</td>
                <TD height="8" width="254">

<input type="text" name="LabPrice" size="20"></TD></TR>

<TR bgColor=#dddddd height=1>
                <TD colSpan=2 height="5" width="511"><IMG height=1 src="pics/hor_bar.bmp"
                  width=5></TD></TR>

              <TR bgColor=#eeeeee><td align=left height="8" valign="middle" width="247">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Discount(in %)</td>
                <TD height="8" width="254">

<input type="text" name="Discount" size="20"></TD></TR>


		</TBODY>
		</TABLE>
		&nbsp;<p>
		<a href="javascript:check();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>      </center>
      </center>
    </div>
          <p>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!-- <input type="button" value="Save" name="save" onClick=javascript:check()> --></p>

<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">

  </form>
</blockquote>


<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

