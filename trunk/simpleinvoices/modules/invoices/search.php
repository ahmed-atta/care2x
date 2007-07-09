<?php

	if(isset($_POST['startdate'])) {
		$startdate = $_POST['startdate'];
	}
	else {
		$startdate = date("Y-m-d",strtotime("today"));
	}
	
	if(isset($_POST['enddate']) && $_POST['enddate'] != "") {
		$enddate = $_POST['enddate'];
	}
	else {
		$enddate = date("Y-m-d",strtotime("tomorrow"));
	}


echo "Search Bills<br />";

$query1=mysql_query("SELECT name FROM si_biller ORDER BY name") or die(mysql_error());
$query2=mysql_query("SELECT concat_ws(' ',care_person.name_last,care_person.name_first) as name FROM care_person ORDER BY name_last") or die(mysql_error());


echo <<<EOD
<div style="text-align:left;">
<b>Search by biller and customer name</b><br />
<form action="index.php?module=invoices&view=search" method="post">
Biller:<select name="biller"><br />
		<option selected>select one</option>
EOD;
		while($res1=mysql_fetch_array($query1))
		{
			$value=$res1[0];
			echo"<option value='$value'>$value</option>";
		}
	echo"</select>";
echo"Customer: <select name='customer'><br />";
echo"<option selected>select one</option>";
		while($res2=mysql_fetch_array($query2))
				{
			echo"<option value='$res2[0]'>$res2[0]</option>";
		}
			echo"</select>";
echo <<<EOD
<input type="submit" value="Search">
</form>
<br />
<br />


<b>Search by date</b>
<form action="index.php?module=invoices&view=search" method="post">
<input type="text" class="date-picker" name="startdate" id="date1" value="$startdate" /><br /><br />
<input type="text" class="date-picker" name="enddate" id="date1" value="$enddate" /><br /><br />
<input type="submit" value="Search">
</form>
<br />
EOD;

$query = null;

if(isset($_POST['biller']) || isset($_POST['customer'])) {
	$query = searchBillerAndCustomerInvoice($_POST['biller'],$_POST['customer']);
}

$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

if(isset($_POST['startdate']) && isset($_POST['enddate'])) {
	$query = searchInvoiceByDate($_POST['startdate'], $_POST['enddate']);
}


if($query != null) {
	echo "<b>Result</b>";
	echo "<table border=1 cellpadding=2>";
	while($res = mysql_fetch_array($query)) {
		echo "<tr>";
		echo "<td><a href='index.php?module=invoices&view=quick_view&submit=$res[invoice]&style=$res[type]'>$res[invoice]</a></td>
		<td>$res[date]</td>
		<td>$res[biller]</td>
		<td>$res[customer]</td>
		<td>$res[type]</td>";
		echo "</tr>";
	}
	echo "</table>";
}

echo "</div>";
/*
"Enhancements to Invoice Manage pageInitially the invoice manage will display blank screen with only options to search. The search criteria could be on the following:1. from and To Date2. Customer wise3. Biller wise4. Type5. Owing greater than zero6. All"*/

?>