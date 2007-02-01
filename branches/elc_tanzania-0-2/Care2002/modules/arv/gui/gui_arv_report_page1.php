<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Report</title>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
//-->
</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
-->
</style>
</head>
<body>
<form method="get" action="" name="select_form">
	Month
	<select name="month" size="1"/>
		<option value="1">Jan</option>
		<option <?php if ($_GET['month']==2) echo "selected=\"selected\"";?> value="2">Feb</option>
		<option <?php if ($_GET['month']==3) echo "selected=\"selected\"";?> value="3">March</option>
		<option <?php if ($_GET['month']==4) echo "selected=\"selected\"";?> value="4">April</option>
		<option <?php if ($_GET['month']==5) echo "selected=\"selected\"";?> value="5">May</option>
		<option <?php if ($_GET['month']==6) echo "selected=\"selected\"";?> value="6">Jun</option>
		<option <?php if ($_GET['month']==7) echo "selected=\"selected\"";?> value="7">Jul</option>
		<option <?php if ($_GET['month']==8) echo "selected=\"selected\"";?> value="8">Aug</option>
		<option <?php if ($_GET['month']==9) echo "selected=\"selected\"";?> value="9">Sept</option>
		<option <?php if ($_GET['month']==10) echo "selected=\"selected\"";?> value="10">Oct</option>
		<option <?php if ($_GET['month']==11) echo "selected=\"selected\"";?> value="11">Nov</option>
		<option <?php if ($_GET['month']==12) echo "selected=\"selected\"";?> value="12">Dez</option>
	</select>
	Year
	<select name="year" size="1"/>
		<option <?php if ($_GET['year']==$curr_year) echo "selected=\"selected\"";?> value="<?php echo $curr_year?>"> <?php echo $curr_year;?></option>
		<option <?php if ($_GET['year']==$curr_year-1) echo "selected=\"selected\"";?> value="<?php echo $curr_year-1;?>"> <?php echo $curr_year-1;?></option>
		<option <?php if ($_GET['year']==$curr_year-2) echo "selected=\"selected\"";?> value="<?php echo $curr_year-2;?>"> <?php echo $curr_year-2;?></option>
	</select>
	<input type="submit" name="submit" value="show" />
</form>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Serial NO</td>
    <td>Patient ID</td>
    <td>SEX</td>
    <td>AGE</td>
    <td>Date of inclusion</td>
    <td>CD4 Baseline</td>
    <td>DATE START ARV</td>
    <td>Date (CD4    Baseline)</td>
    <td>CD4 2</td>
    <td>Date (CD4 2)</td>
    <td>CD4 3</td>
    <td>Date (CD4 3)</td>
    <td>CD4 4</td>
    <td>Date (CD4 4)</td>
    <td>CD4 5</td>
    <td>Date (CD4 5)</td>
    <td>REGIMEN()</td>
    <td>alternate regimen</td>
    <td>new TB CASE</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>