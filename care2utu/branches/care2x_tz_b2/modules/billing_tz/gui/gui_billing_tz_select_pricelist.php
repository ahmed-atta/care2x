<STYLE TYPE="text/css">

	.table_content {
	            border: 1px solid #000000;
	}

	.tr_content {
		        border: 1px solid #000000;
	}

	.td_content {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: dotted;
	border-bottom-style: solid;
	border-left-style: dotted;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
}

	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
	}

A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
.billing_topic {font-family: arial; font-size: 12; color:black;}
</style>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<table width="100%" border="0" cellspacing="0" >
  <tr valign=top  class="titlebar" >
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo 'Select Pricelist'; ?>
      </font>
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing_create_2.php','Billing :: Create Quotation')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
    </td>
  </tr>
 </table>
<form name="form" method="get" action="billing_tz_quotation_create.php">
<table align="center"><tr><td>
	<?php $bill_obj->ShowPriceList(); ?></td><tr><td align="center">
	<input type="submit" name="ok" value="Ok"/></td></tr>
	<input type="hidden" name="namelast" value="<?php echo $_REQUEST['namelast']; ?>">
	<input type="hidden" name="patient" value="<?php echo $_REQUEST['patient']; ?>">
	<input type="hidden" name="namefirst" value="<?php echo $_REQUEST['namefirst']; ?>">
	<input type="hidden" name="countpres" value="<?php echo $_REQUEST['countpres']; ?>">
	<input type="hidden" name="countlab" value="<?php echo $_REQUEST['countlab']; ?>">
	<input type="hidden" name="encounter_nr" value="<?php echo $_REQUEST['encounter_nr']; ?>">
	<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>">
</table>
</form>