<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
?>
<script language="javascript" src="../../js/datetimepicker.js"></script>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">


	<tr>

	  <td  valign="top" align="middle" height="35">
		   <table width="770" border=0 align="center" cellspacing="0"  class="titlebar">
 <tr valign=top  class="titlebar" >
  <td width="423" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">BLOCK PAYMENT SUMMARY REPORT</font></td>
  <td width="238" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" /></a>
   <td width="103" bgcolor="#99ccff" ><a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a></td>
   </td>
    </tr>
 </table>
<p>&nbsp; </p>
			 
<form id="form1" name="form1" method="post" action="">
  <table width="596" border="0" align="center" bgcolor="#CCCCFF">
    <tr>
      <td width="81">BETWEEN:</td>
      <td width="144"><input type="text" id="dfrom" name="dfrom" /></td>
      <td width="98"><a href="javascript:NewCal('dfrom','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></td>
      <td width="47">AND:</td>
      <td width="144"><input type="text" id="dto" name="dto" /></td>
      <td width="56"><a href="javascript:NewCal('dto','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></td><td><input type="submit" name="show" value="SHOW" /></td>
    </tr>
  </table>
</form>
<?php
$dfrom       =   $_POST['dfrom'];
$dto         =   $_POST['dto'];
if(empty($datefrom) || empty($dto)) echo 'Please Enter Date Range';  

$dfrom_timestamp =  strtotime($dfrom);
$dto_timestamp   =  strtotime($dto);


//echo 'This is date from '. $datefrom_timestamp.'<br>';
//echo 'This is date to   '. $dto_timestamp;

$sql_temp = " CREATE TEMPORARY TABLE block_temp SELECT c.name AS company, b . * FROM care_tz_company AS c INNER JOIN care_tz_billing_archive_elem AS b ON c.id = b.insurance_id  WHERE b.description LIKE 'cons%'";

$result_temp = $db->Execute($sql_temp);




$sql = "SELECT company,date_change, SUM(price) as total_price FROM block_temp WHERE description LIKE 'consq%' and date_change>= $dfrom_timestamp AND date_change < $dto_timestamp       GROUP BY company";
       $result = $db->Execute($sql);
	   if(empty($result)){
	     echo 'No data found';
		 exit;
		 
	   }
	   

	   


 ?>
 <form id="form2" name="form2" method="post" action="">
 <table width="605" border="0" >
 <tr><td>Start Date:<?php echo $dfrom;?></td><td>End Date:<?php echo $dto;?></td></tr>
 
 <tr>
 
   <!--  <td width="174" bgcolor="#CCCCFF">DATE</td> -->
    <td width="224" bgcolor="#CCCCFF">BLOCK PAYMENT </td>
    <td width="185" bgcolor="#CCCCFF">TOTAL AMOUNT </td>
  </tr>


 <?php
 while($rows=$result->FetchRow()){
  $realdate = date('d-M-Y',$rows['date_change']);
  
 
	  
		  
		  ?>

  
  <?php echo '<tr>';?>
 <!--  <?php echo  '<td width="174">'.$realdate.'</td><br>';?>  -->
  <?php echo  '<td width="224">'.$rows['company'].'</td></br>';?>
  <?php echo  '<td width="185">'.$rows['total_price'].'</td><br>';?>
 
  <?php
  echo '<tr>';
  }
  
  $s= "CREATE TEMPORARY TABLE sum_block SELECT company,date_change, SUM(price) as total_price FROM block_temp WHERE description LIKE 'consq%' and date_change BETWEEN $dfrom_timestamp AND $dto_timestamp   GROUP BY company";
  
  $r= $db->Execute($s);
  $total= "SELECT SUM(total_price) as grand_total FROM sum_block";
  $results= $db->Execute($total);
  while($rows= $results->FetchRow()){
  $sum = $rows['grand_total'];
  }
  
    
  
   
  ?>
  
  
  
   
</table>
<table width="605" height="25" border="0" bgcolor="#CCCCFF">
  <tr>
    <td width="224"><strong>SUM</strong></td>
    <td width="185"><?php echo $sum;?></td>
  </tr>
</table>
<input type="button" name="print" value="PRINT" onclick="window.print()" />

</form>
