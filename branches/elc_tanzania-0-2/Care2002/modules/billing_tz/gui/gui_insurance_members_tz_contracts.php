<html>
<head>
<title>Insurance Companys - Member Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<script language="javascript">
function show_contract_popup(company,pid)
{
	urlholder="show_contract.php?company=" + company + "&pid=" + pid;
	//alert(urlholder);
	helpwin=window.open(urlholder,"helpwin","width=620,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
<script language="javascript" src="../../js/check_insurance_form.js"></script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066">Insurance Companys - Member Management</font></td>
	  	<td align="right" ><a href="<?php echo $_SESSION['backpath_diag'];?>"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a><?php if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='insurance_tz.php?ntid=false&lang=$lang';
	  	?>
	  		<a href="javascript:gethelp('insurance_members.php','Insurance Management :: Member Management')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
	  		<a href="<?php echo $closelink; ?>"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
	  	</td>
	  </tr>
  </table>
    </td>
 </tr>
  <tr>
    <td><form name="insurance" method="post">
    <input type="hidden" name="mode" value="update">
    <input type="hidden" name="insurance" value="<?php echo $company_id; ?>">
	<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          <tr>
            <td width="100%" align="center">
						<?php
						$insurance_tz->ShowInsuranceHeadline($company_id);
						$insurance_tz->ShowMemberForms($contract_array);
						?>
            </td>
          </tr>
          <tr>
            <td align="center">
            	<table border="0" cellpadding="0" cellspacing="0" align="center" width="435">
            		<tr>
									<td align="center"><input type="image" src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></td>
                </tr>
               </table>
			       </td>
          </tr>

        </table>
	 	</form>
	</td>
  </tr>
</table>
</body>
</html>
