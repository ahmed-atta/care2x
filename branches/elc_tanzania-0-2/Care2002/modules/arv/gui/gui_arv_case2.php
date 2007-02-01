<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="../../js/setdatetime.js"></script><script language="javascript" src="../../js/checkdate.js"></script><script language="javascript" src="../../js/dtpick_care2x.js"></script><html>
<script language="JavaScript" type="text/JavaScript">
<!--
//-->
</script>
<!-- Erweiterung - Anfang -->
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
.mainTable {
	border: 2px ridge black;
	margin-top: 15px;
}


textarea, input{
	font-family: verdana, arial, tahoma;
    font-size: 14px;
    margin-left:10px
}

.error {
	color: red;
}

.leftTable {
	background-color:#99ccff;
	color: #330066;
	font-weight: bold;
}

.blue {
	color: #330066;
	font-weight: bold;
}

td > table {
	margin:10px;
	font-size: 9px;
	width: 100%;
	border-spacing:0px;
}

/*body {
    color: black; background-color: white;
    font-size: 100.01%;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    margin: 0; 
    min-width: 41em; 
}
.titlebar {
	width: 100%;
	font-size: 22px;
	font-weight: bold;
	color: #546D8F;
	height: 20px;
	border-bottom: 2px dotted blue;
}
.requiredNote {
	font-family: Arial;
	font-size: 11px;
	color: red;
}

.label {
	font-weight: bold;
}

.text {
	font-weight: normal;
}
.errorLabel {
	font-family: Verdana,Arial,Helvetica,sans-serif;
	font-size: 12px;
	color: red;
}
.mainTable {
	border: 2px ridge silver;
	margin-bottom: 0.7em;
}

td > table {
	font-size: 1em;  
}
.title {
	font-size: 1.5em;
	font-weight: bold;
	color: #666666;
	margin-bottom: 0.3em;
}

.title2 {
	font-weight: bold;
	color: #666666;
	font-size: 1.2em;
}

table {
	border: 2px ridge silver;
	font-size: 0.7em;  
	margin-bottom: 0.7em;
}*/
</style>
<title>ARV Registration</title>
</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >

    &nbsp;&nbsp;<font color="#330066">Patient ARV Registration</font>
       </td>

  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp()"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="../../modules/arv/arv_menu?sid=339c7d1919918c462884dbf9882f28c4&ntid=false&lang=en" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<table>
<span class="title">NATIONAL CARE AND TREATMENT PROGRAM</span>
<table width="764" style="border: 2px ridge silver;" >
  <tr>
    <td width="98" bgcolor="#F0F5FF" class="label">Facility Name: </td>
    <td width="205" bgcolor="#F0F5FF" class="text">Selian Lutheran Hospital</td>
    <td width="40" bgcolor="#F0F5FF" class="label">Code:</td>
    <td width="98" bgcolor="#F0F5FF" class="text">3164</td>
    <td width="51" bgcolor="#F0F5FF" class="label">District:</td>
    <td width="208" bgcolor="#F0F5FF" class="text">ARUSHA</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#F0F5FF" class="fett">&nbsp;</td>
  </tr>
</table>
<br>
<span class="title2">PATIENT REGISTRATION</span>
<table width=\"764\" class="mainTable">
	<form  action="arv_case.php" method="post" name="mainForm" id="mainForm">
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">date:</div></td>
			<td valign="top" align="left">28/11/2006</td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Firstname:</div></td>
			<td valign="top" align="left">Hans</td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Lastname:</div></td>
			<td valign="top" align="left">Hase</td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Date of birth:</div></td>
			<td valign="top" align="left">15/11/2006</td>
		</tr>
		<tr bgcolor="#F0F5FF"><td width="50%" valign="top" align="right"><div class="label">Sex:</div></td>
			<td valign="top" align="left">m</td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Telephone/ Simu ya Mgonjwa:</div></td>
			<td valign="top" align="left"></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label"><font color="red"><b>*</b></font>Patient_ID:</div></td>
			<td valign="top" align="left"><input name="arv_pid" type="text" value="989790" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">District/ Wilaya/ Tarafi/ Kata:</div></td>
			<td valign="top" align="left"><input name="district" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Village/ Kitongoji:</div></td>
			<td valign="top" align="left"><input name="village" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Street/ Mtaa:</div></td>
			<td valign="top" align="left"><input name="street" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Mjumbe/Balozi :</div></td>
			<td valign="top" align="left"><input name="balozi" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Chairman of the village/ Mwenyekiti wa Mtaa/ Kitongolji:</div></td>
			<td valign="top" align="left"><input name="chairman_of_village" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Head of family/ Mkuu wa kaya :</div></td>
			<td valign="top" align="left"><input name="head_of_family" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Name of the secretary/ Jina la msaidizi wa karibu:</div></td>
			<td valign="top" align="left"><input name="name_of_secretary" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Phone/ Simu :</div></td>
			<td valign="top" align="left"><input name="secretary_phone" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Postal adress/ anuani:</div></td>
			<td valign="top" align="left"><input name="secretary_adress" type="text" value="" /></td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Date of first pos HIV-test :</div></td>
			<td valign="top" align="left"><input onfocus="this.select()" onblur="IsValidDate(this,'dd/MM/yyyy')" onkeyup="setDate(this,'dd/MM/yyyy','en')" name="datetime_first_hivtest" type="text" value="00/00/0000" />&nbsp;<a href="javascript:show_calendar('mainForm.datetime_first_hivtest','dd/MM/yyyy')"><img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a></td>
		</tr><tr bgcolor="#F0F5FF">
			<td width="50%" valign="top" align="right"><div class="label">Start date ARV's:</div></td>
			<td valign="top" align="left"><input name="datetime_start_arv" type="text" value="00/00/0000" />&nbsp;<a href="javascript:show_calendar('mainForm.datetime_start_arv','dd/MM/yyyy')"><img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a></td></tr><tr bgcolor="#F0F5FF"><td width="50%" valign="top" align="right"><div class="label"></div></td><td valign="top" align="left"><input name="submit" value="OK" type="submit" /></td></tr><tr bgcolor="#F0F5FF"><td width="50%" valign="top" align="right"><div class="label"></div></td><td valign="top" align="left"><input name="back" value="Zurücksetzen" type="reset" /></td>
		</tr>
		<tr>
			<td></td>
			<td align="left" valign="top"><div class="requiredNote">* required fields</div></td>
		</tr>
	</form>
</table>
</body>
</html>




