<?php
//include("./include/include_main.php"); 
//include("./config/config.php");


if($_POST["submit"])
{

	$from_date=$_POST['from_date'];
	$to_date=$_POST['to_date'];
	$to_date=$to_date.' 23:59:59';
	//echo"$to_date";
	
	/*$db=mysql_connect("192.168.0.9","admin","admin");
	if(!$db)
	{
		 die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("care2x",$db); */

	 
	
		$sql="Select date_format(care_encounter.encounter_date,get_format(date,'ISO')) as date,care_person.pid as no, concat_ws(' ',care_person.name_last,care_person.name_first) as Patient_name,care_encounter.insurance_nr,care_insurance_firm.name from care_encounter,care_person,care_insurance_firm where care_encounter.pid=care_person.pid and care_encounter.insurance_firm_id=care_insurance_firm.firm_id and care_encounter.is_discharged!=1 and care_encounter.insurance_class_nr=1 and care_encounter.encounter_date>='$from_date' and care_encounter.encounter_date<='$to_date' order by care_encounter.encounter_date";
		
		$result = mysql_query($sql); 		
		
			
	?>
	<html>
	<body>
	<form name="consult" id="consult" method="post" action="">
	 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <div align="center">
      <center>
	  <?php
				
			echo "<h1>Insurance payment patients</H1>";
							
		?>
		
		
      <table cellSpacing="1" cellPadding="3" width="450" bgColor="#999999" border="0" height="138">
	 <?php
		echo "<tr bgColor=\"#eeeeee\">";
	echo "<th align=\"center\" height=\"7\" width=\"133\" bgcolor=\"#CCCCCC\">S.NO</th>";
	echo "<th align=\"center\" height=\"7\" width=\"7023\" bgcolor=\"#CCCCCC\">Date</th>";
	echo "<th height=\"7\" width=\"826\" align=\"center\" bgcolor=\"#CCCCCC\">Patient No</th>";
	echo "<th height=\"7\" width=\"5023\" align=\"center\" bgcolor=\"#CCCCCC\">Patient Name</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Insurance no</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Insurance company</th>";
	echo "</tr>";
		$i=0;
		
		while($myrow=mysql_fetch_array($result))
	{
		$i=$i+1;
		

		
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

