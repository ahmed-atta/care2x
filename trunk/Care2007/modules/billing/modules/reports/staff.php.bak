<?php
//require('/config/config.php');
if($_POST["submit"])
{

	$from_date=$_POST['from_date'];
	$to_date=$_POST['to_date'];
	$to_date=$to_date.' 23:59:59';
	//echo"$to_date";
	$option=$_POST['options'];
	/*$db=mysql_connect("192.168.0.9","admin","admin");
	if(!$db)
	{
		 die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("care2x",$db); */
	if($option=='invoice')
	{
		/*$sql="SELECT date_format(care_billing_bill_item.bill_item_date,get_format(date,'ISO')) as Date,care_billing_bill_item.bill_item_bill_no as Bill_No,concat_ws(' ',care_person.name_last,care_person.name_first) as Patient_name,care_billing_bill_item.bill_item_amount as Amount,care_billing_bill_item.create_id as Staff_name FROM care_billing_bill_item,care_encounter,care_person where care_billing_bill_item .bill_item_date>='$from_date' and care_billing_bill_item.bill_item_date<='$to_date' and care_billing_bill_item.bill_item_encounter_nr=care_encounter.encounter_nr and care_encounter.pid=care_person.pid order by care_billing_bill_item.create_id,care_billing_bill_item.bill_item_date,care_billing_bill_item.bill_item_bill_no";*/
		$sql="SELECT date_format(si_invoices.date,get_format(date,'ISO')) as Date,si_invoice_items.invoice_id as Bill_No,concat_ws(' ',care_person.name_last,care_person.name_first) as Patient_name,si_invoice_items.total as Amount,si_invoice_items.create_id as Staff_name FROM si_invoices,si_invoice_items,care_person where si_invoices.date>='$from_date' and si_invoices.date<='$to_date' and care_person.pid=si_invoices.customer_id and si_invoices.id=si_invoice_items.invoice_id order by si_invoice_items.create_id,si_invoices.date";
		$result = mysql_query($sql); 
		
		
		/*$rec_sub=mysql_fetch_array(mysql_query("SELECT create_id as Staff_Name,sum(total) as sub_amount from si_invoice_items where bill_item_date >= '$from_date' and bill_item_date <= '$to_date' group by create_id"));*/

		$rec_total=mysql_fetch_array(mysql_query("SELECT sum(si_invoice_items.total) as total from si_invoice_items,si_invoices where si_invoices.date >= '$from_date' and si_invoices.date <='$to_date' and si_invoice_items.invoice_id=si_invoices.id"));

	}
	else
	{
		
		$sql="SELECT date_format(si_account_payments.ac_date,get_format(date,'ISO')) as Date,si_account_payments.id as Bill_No,concat_ws(' ',care_person.name_last,care_person.name_first) as Patient_name,si_account_payments.ac_amount  as Amount,si_account_payments.create_id as Staff_name FROM si_account_payments,care_person,si_invoices where si_account_payments.ac_date >= '$from_date' and si_account_payments.ac_date <= '$to_date' and care_person.pid=si_invoices.customer_id  and si_invoices.id = si_account_payments.ac_inv_id order by si_account_payments.create_id,si_account_payments.ac_date";
		$result = mysql_query($sql); 
		

		/*$rec_sub=mysql_fetch_array(mysql_query("SELECT create_id as Staff_Name,sum(ac_amount) as sub_amount from si_account_payments where ac_date >= '$from_date' and ac_date <= '$to_date' group by create_id"));*/

		$rec_total=mysql_fetch_array(mysql_query("SELECT sum(ac_amount) as total from si_account_payments where ac_date >= '$from_date' and ac_date <= '$to_date'"));
	}
	?>
	<html>
	<body>
	<form name="staff" id="staff" method="post" action="" rel="external">
	 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <div align="center">
      <center>
	  <?php
		 if($option=='invoice')
		{
			
			echo "<h1>STAFF WISE BILLING REPORT</H1>";
			
			
		}
		else
		{
			
			echo "<h1>STAFF WISE COLLECTION REPORT</H1>";
			
		}
		?>
		
		
      <table cellSpacing="1" cellPadding="3" width="450" bgColor="#999999" border="0" height="138">
	 <?php
		echo "<tr bgColor=\"#eeeeee\">";
	echo "<th align=\"center\" height=\"7\" width=\"133\" bgcolor=\"#CCCCCC\">S.NO</th>";
	echo "<th align=\"center\" height=\"7\" width=\"7023\" bgcolor=\"#CCCCCC\">Date</th>";
	echo "<th height=\"7\" width=\"826\" align=\"center\" bgcolor=\"#CCCCCC\">Bill No</th>";
	echo "<th height=\"7\" width=\"5023\" align=\"center\" bgcolor=\"#CCCCCC\">Patient Name</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Amount</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Staff Name</th>";
		echo "</tr>";
		$i=0;
		$m=0;
		$chk=$myrow[4];
		while($myrow=mysql_fetch_array($result))
	{
		$i=$i+1;
			
		if($chk!=$myrow[4])
		{
			if($option=='invoice')
			{
			$sub=mysql_fetch_array(mysql_query("SELECT sum(si_invoice_items.total) as total from si_invoice_items,si_invoices where si_invoices.date >= '$from_date' and si_invoices.date <='$to_date' and si_invoice_items.invoice_id=si_invoices.id and si_invoice_items.create_id='$chk'"));
			}
			else
			{
				$sub=mysql_fetch_array(mysql_query("SELECT sum(ac_amount) FROM si_account_payments,si_invoices where si_account_payments.ac_date>='$from_date'and si_account_payments.ac_date<='$to_date'and si_invoices.id=si_account_payments.ac_inv_id and si_account_payments.create_id='$chk'"));
			}
		echo"<tr bgcolor=\"#eeeeee\">";
		echo "<td align=\"right\"  colspan=\"4\"><b>sub total for&nbsp;&nbsp;".$chk."</b>";
		echo "</td>";
		echo "<td align=\"right\" height=\"7\" colspan=\"1\">".$sub[0];
		echo "</td>";
		echo "<td align=\"left\" height=\"7\" colspan=\"1\">";
		echo "</td>";
		echo "</tr>";
		$chk=$myrow[4];
		}

		
		echo"<tr bgColor=\"#eeeeee\">";
		
		echo "<td align=\"center\" height=\"7\" width=\"133\">".$i;
		echo"</td>";
		echo "<td height=\"7\" width=\"7023\" align=\"center\">".$myrow[0];
		echo "</td>";
		echo "<td height=\"7\" width=\"826\" align=\"center\">".$myrow[1];
		echo "</td>";
		echo "<td height=\"7\" width=\"5023\" align=\"center\">".$myrow[2];
		echo "</td>";
		echo "<td height=\"7\" width=\"1023\" align=\"right\">".$myrow[3];
		echo "</td>";
		echo "<td height=\"7\" width=\"1023\" align=\"center\">".$myrow[4];
		echo "</td>";
		echo "</tr>";
	}
		if($option=='invoice')
			{
			$sub=mysql_fetch_array(mysql_query("SELECT sum(si_invoice_items.total) as total from si_invoice_items,si_invoices where si_invoices.date >= '$from_date' and si_invoices.date <='$to_date' and si_invoice_items.invoice_id=si_invoices.id and si_invoice_items.create_id='$chk'"));
			}
			else
			{
				$sub=mysql_fetch_array(mysql_query("SELECT sum(ac_amount) FROM si_account_payments,si_invoices where si_account_payments.ac_date>='2007-02-03'and si_account_payments.ac_date<='2007-06-07'and si_invoices.id=si_account_payments.ac_inv_id and si_account_payments.create_id='$chk'"));
			}
		echo"<tr bgcolor=\"#eeeeee\">";
		echo "<td align=\"right\"  colspan=\"4\"><b>sub total for &nbsp;&nbsp;".$chk."</b>";
		echo "</td>";
		echo "<td align=\"right\" height=\"7\" colspan=\"1\">".$sub[0];
		echo "</td>";
		echo "<td align=\"left\" height=\"7\" colspan=\"1\">";
		echo "</td>";
		echo "</tr>";

		echo"<tr bgcolor=\"#eeeeee\">";
		echo "<td align=\"right\"  colspan=\"4\"><b>Grand Total</b>";
		echo "</td>";
		echo "<td align=\"left\" height=\"7\" colspan=\"2\">".$rec_total[0];
		echo "</td>";
		echo "</tr>";

		
	 ?>
	 </table>
	 </center>
	 </div>
	 </form>

<?php
}
?>
</body>
</html>

