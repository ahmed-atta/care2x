<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ARV Overview</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
.mainTable {
	border: 2px ridge black;
	margin-top: 15px;
	width:764px;
	margin-left:auto;
	margin-right:auto;
}

tr {
	height:23px;
}

td {
	padding-left:3px;
	padding-right:3px;
}

.blue {
	color: #330066;
	font-weight: bold;
}

.tablebackground {
	background-color:#F0F5FF;
}


-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
	function printOut(urlholder) {
		testprintout=window.open(urlholder,"printout","width=600px,height=800px,menubar=no,resizable=yes,scrollbars=yes");
	}
//-->
</script>
</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">Patient ARV Data Overview</font>
       </td>

  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('outpatient_overview.php','Outpatient :: Overview')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $o_arv_case->displayARVData();?>
<?php echo $o_arv_case->displayARVData2()?>
<?php
echo $o_arv_case->displayAllARVvisits();
?>

<p>&nbsp;</p>
</body>
</html>
