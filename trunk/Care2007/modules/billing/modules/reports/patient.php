<?php
//include("./include/include_main.php"); 
//include("./config/config.php");


if($_POST["submit"])
{

	$from_date=$_POST['from_date'];
	$to_date=$_POST['to_date'];
	$to_date=$to_date.' 23:59:59';
	//echo"$to_date";
	$option=$_POST['options'];
/*	$db=mysql_connect("192.168.0.9","admin","admin");
	if(!$db)
	{
		 die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("care2x",$db);   */

	 
	if($option=='inpatient')
	{
		$sql="Select date_format(care_encounter.encounter_date,get_format(date,'ISO')) as date,care_person.pid as no, concat_ws(' ',care_person.name_last,care_person.name_first) as Patient_name,care_ward.ward_id as ward_name,care_encounter.current_room_nr from care_person,care_ward,care_encounter,care_room where care_person.pid=care_encounter.pid and care_encounter.current_ward_nr=care_ward.nr and care_encounter.is_discharged!=1 and care_encounter.current_room_nr=care_room.room_nr and care_ward.nr=care_room.ward_nr and care_encounter.encounter_date>='$from_date' and care_encounter.encounter_date<='$to_date' order by care_encounter.encounter_date";
		$result = mysql_query($sql); 
				

	}
	else
	{
		
		$sql="Select date_format(care_encounter.encounter_date,get_format(date,'ISO')) as date,care_person.pid as no, concat_ws(' ',care_person.name_last,care_person.name_first) as Patient_name,care_department.id from care_person,care_encounter,care_department where care_person.pid=care_encounter.pid and care_encounter.is_discharged!=1 and care_department.nr=care_encounter.current_dept_nr and care_encounter.encounter_date>='$from_date' and care_encounter.encounter_date<='$to_date' order by care_encounter.encounter_date";
		$result = mysql_query($sql); 
				
	}
	?>
	<html>
	<body>
	<form name="patient" id="patient" method="post" action="">
	 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <div align="center">
      <center>
	  <?php
		 if($option=='inpatient')
		{
			
			echo "<h1>LIST OF INPATIENTS </H1>";
			
			
		}
		else
		{
			
			echo "<h1>LIST OF OUTPATIENTS</H1>";
			
		}
		?>
		
		
      <table cellSpacing="1" cellPadding="3" width="650" bgColor="#999999" border="0" height="138">
	 <?php
		  if($option=="inpatient")

	{
		
		echo "<tr bgColor=\"#eeeeee\">";
	echo "<th align=\"center\" height=\"7\" width=\"133\" bgcolor=\"#CCCCCC\">S.NO</th>";
	echo "<th align=\"center\" height=\"7\" width=\"7023\" bgcolor=\"#CCCCCC\">Date</th>";
	echo "<th height=\"7\" width=\"826\" align=\"center\" bgcolor=\"#CCCCCC\">Patient No</th>";
	echo "<th height=\"7\" width=\"5023\" align=\"center\" bgcolor=\"#CCCCCC\">Patient Name</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Ward Name</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Room No</th>";	
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

	}
	else
	{
         
	echo "<tr bgColor=\"#eeeeee\">";
	echo "<th align=\"center\" height=\"7\" width=\"133\" bgcolor=\"#CCCCCC\">S.NO</th>";
	echo "<th align=\"center\" height=\"7\" width=\"7023\" bgcolor=\"#CCCCCC\">Date</th>";
	echo "<th height=\"7\" width=\"826\" align=\"center\" bgcolor=\"#CCCCCC\">Patient No</th>";
	echo "<th height=\"7\" width=\"5023\" align=\"center\" bgcolor=\"#CCCCCC\">Patient Name</th>";
	echo "<th height=\"7\" width=\"1023\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">Department Name Name</th>";
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
		echo "</tr>";
		
	}

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

