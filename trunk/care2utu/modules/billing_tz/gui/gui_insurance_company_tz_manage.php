<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
	<TITLE> <?php echo $LDBillingInsurance; ?></TITLE>
	<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
	<meta name="Author" content="Timo Hasselwander, Robert Meggle">
	<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=6ac874bb63e983fd6ec8b9fdc544cab5&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

<script language="javascript">

<!--
function closewin()
{
	location.href='startframe.php?sid=6ac874bb63e983fd6ec8b9fdc544cab5&lang=$lang';
}
// -->
</script>

<script language="javascript">
<!--
function saveData()
{
    document.forms["inputform"].submit();
}
function reset()
{
    document.forms["inputform"].submit();
}
-->
</script>

<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="titlebar" >
            <td bgcolor="#99ccff" >
                &nbsp;&nbsp;<font color="#330066"><?php echo $LDManageInsurances; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('insurance_companies_overview.php','Administrative Companies :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="insurance_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>

 </table>		</td>
	</tr>

	</td></tr>
	</form>
	<tr>
		<td bgcolor=#ffffff valign=top>

		<table cellpadding=20>
		<tr valign=top>

		<!-- left side (list of insurances) -->
		<td>
		<form method="GET" name="inputform" action="<?php echo $root_path?>modules/billing_tz/insurance_company_tz_manage.php" method="POST">
			<table cellpadding=5 ><font color=#000000>
			<?php if ($status)
					{
						$colorText = "#ff0000";
						$text = "Deleted Insurances";
					}
					else{
						$colorText = "#ffff66";
						$text = "Active Insurances";
					}
			?>

			<th bgcolor=<?php echo $colorText.'>'.$text.'</th>'?>
			<?php

			/* The following routine creates the list of insurances on the left side:  */

			require($root_path.'include/inc_insurance_lister.php');

			?>

			</table>

		</td>
		<!-- right side (form) -->
		<td valign="top">
		<table>

		<?php
		if ($insuranceExists || $noInsuranceName)
		{
			$color = '#FF0000';
		}
		else $color = '#000000';

		echo '<tr><td><font color='.$color.'>'.$LDInsurance.':</td>';?>
		<td><input type="text" name="name" size="30" maxlength="60" value="<?php echo $name?>"></td></tr>

		<tr></tr>
		<?php
			if ($insuranceParentSame)
			{
				$color = '#FF0000';
			}
			else $color = '#000000';
		echo '<tr><td><font color='.$color.'>'.$LDParent_Insurer?>
		</td><td>
		<?php

			echo '<SELECT name="id_insurer">';
			echo '<OPTION value="-1" >--select insurance--</OPTION>';

			foreach($name_insurer_array_all as $row)
			{
				$mark = '';

				if($id_insurer == $row[insurance_ID])
					$check = 'selected';
				else
					$check = '';

				if ($row[deleted] == 1)
					$markOn = ' (del)';

				echo '<OPTION value="'.$row[insurance_ID].'" '.$check.'>'.$row[name].$markOn.'</OPTION></i>';

			}

			echo '</SELECT>'; ?>

		</td></tr>

		<tr>
		<?php
			if ($wrong_max_pay)
			{
				$color = '#FF0000';
			}
			else $color = '#000000';


		echo '<td><font color='.$color.'>'.$LDInsurance_Limit?></td><td><input type="text" name="max_pay" size="10" maxlength="10" value="<?php echo $max_pay?>"><?php echo $LDPerPerson?></td>
		</tr>
		<tr><td><?php echo $LDContactPerson.':'?></td><td><input type="text" name="contact_person" size="30" maxlength="60" value="<?php echo $contact_person?>"></td></tr>
		<tr><td><?php echo $LDPOBOX.':'?></td><td><input type="text" name="po_box" size="30" maxlength="50" value="<?php echo $po_box?>"></td></tr>
		<tr><td><?php echo $LDCity?></td><td><input type="text" name="city" size="30" maxlength="60" value="<?php echo $city?>"></td></tr>
		<tr><td><?php echo $LDPhone.':'?></td><td><input type="text" name="phone" size="30" maxlength="60" value="<?php echo $phone?>"></td></tr>
		<tr><td><?php echo $LDEmail.':'?></td><td><input type="text" name="email" size="30" maxlength="60" value="<?php echo $email?>"></td></tr>

		<?php	if ($insuranceExists )
				{
					$errorMess = 'Insurance name already exists.';

				}else if ($noInsuranceName)
						{
							$errorMess = 'Please insert insurance name.';

						}else if ($insuranceParentSame)
								{
									$errorMess = 'Parent insurer and insurer can not be the same.';
								}
								else if ($wrong_max_pay)
								{
									$errorMess = 'Please insert valid amount';
								}
		?>
		<tr><td>&nbsp;</td></tr>
		<tr><td colspan=2><font color=#FF0000><?php echo $errorMess?>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>

		<tr><td>
		<?php if (!$status)
			{
				echo '<input height="21" border="0" width="76" type="image" name="clear" value="clear" onClick="reset()" alt="clear" src="../../gui/img/control/blue_aqua/en/en_reset.gif"/>';
			}
			else
				echo '<br><br>';
			?>
			</td><td>
  			<input height="21" border="0"  width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="insurance_tz.php?ntid=false&lang=$lang"><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
		</td></tr>
		<tr><td>&nbsp;</td></tr>


		<th bgcolor=#ffff66 colspan=2 ><?php echo $LDRelationshipsInsurances?></th>
		<tr bgcolor=#ffffaa><td colspan=2>

		<!-- start of block "insurance tree" -->

<div class="dtree">

	<p><a href="javascript: d.openAll();">open all</a> | <a href="javascript: d.closeAll();">close all</a></p>

	<script type="text/javascript">
		<!--

		d = new dTree('d');
		d.config.inOrder = false;
		d.config.useSelection = false;
		d.add(0,-1,'Overview parent insurers');
		<?php

			require_once($root_path.'include/care_api_classes/class_tz_insurance.php');


			global $db;
			$coreObj = new Insurance_tz;
			$name_array = $name_insurer_array_all;


			foreach($name_array as $rowOuter)
			{
				//innerer Einschub:

				$sql="SELECT *  FROM care_tz_insurances_admin where insurance_ID = ".$rowOuter['insurance_ID'].';';

				$resultInner = $db->Execute($sql);

				$rowInner=$resultInner->FetchRow();


				$link =$root_path."modules/billing_tz/insurance_company_tz_manage.php".URL_APPEND."&insurance_ID" .
				"=".$rowInner['insurance_ID']."&name=".$rowInner['name']."&id_insurer=".$rowInner['insurer']."&max_pay=".$rowInner['max_pay']."&status=".$status."&contact_person" .
				"=".$rowInner['contact_person']."&po_box=".$rowInner['po_box']."&city=".$rowInner['city']."&phone=".$rowInner['phone']."&email=".$rowInner['email'];

				if ($status == '')
				{
					$status = 0;
				}

				if ($status!=$rowInner['deleted'])
					$link.="&treeLink='toggle from tree'";

				if ($rowInner['deleted'])
				{
					$name = $rowOuter['name']." (del)";
				}
				else
				{
					$name = $rowOuter['name'];
				}



				$parentNode = $rowOuter['id_insurer'];
				if ($parentNode == -1)
				{
					$parentNode = 0;
				}



				echo 'd.add('.$rowOuter['insurance_ID'].','.$parentNode.', "'.$name.'", "'.$link.'");';


			}
		?>



		document.write(d);

		//-->
	</script>

</div>



		<!-- end of block "insurance tree" -->
		</td></tr>
		<tr><td>&nbsp;</td></tr>


		<?php //DELETE (active insurances)
		if (!$status){
			echo '<tr bgcolor=#FFFFFF> <td colspan=2><input type="submit" name="deletebutton" value="delete insurance" onClick="return confirm(\'Are You sure?\')"/>';
			echo '<SELECT name="delete">';
			echo '<OPTION value="-1" selected>--select insurance--</OPTION>';

			foreach($name_insurer_array_act as $row)
			{
				echo '<OPTION value="'.$row[insurance_ID].'" '.$check.'>'.$row[name].'</OPTION>';
			}

			echo '</SELECT>';
		}

		else //REACTIVATE (deleted insurances)
		{
			echo '<tr bgcolor=#FFFFFF> <td colspan=2><input type="submit" name="reactivatebutton" value="reactivate"/>';
			echo '<SELECT name="reactivate">';
			echo '<OPTION value="-1" selected>--select insurance--</OPTION>';

			foreach($name_insurer_array_del as $row)
			{
				echo '<OPTION value="'.$row[insurance_ID].'" '.$check.'>'.$row[name].'</OPTION>';
			}

			echo '</SELECT>';
		}

		?></td><td bgcolor=#FFFFFF><input type="submit" name="toggle" value="toggle insurances"/></td>
		</tr>

		</table>
		<input type="hidden" name="insurance_ID" value=<?php echo $insurance_ID?>>
		<input type="hidden" name="status" value="<?php echo $status?>">

		<input type="hidden" name="name_old" value='<?php echo $name?>'>
		<input type="hidden" name="max_pay_old" value=<?php echo $max_pay?>>
		<input type="hidden" name="id_insurer_old" value=<?php echo $id_insurer?>>

		<input type="hidden" name="contact_person_old" value='<?php echo $contact_person?>'>
		<input type="hidden" name="po_box_old" value='<?php echo $po_box?>'>
		<input type="hidden" name="city_old" value='<?php echo $city?>'>
		<input type="hidden" name="phone_old" value='<?php echo $phone?>'>
		<input type="hidden" name="email_old" value='<?php echo $email?>'>
		</td>

		</tr>

		</table>
			<?php if (!$status)
			{
				echo '<input height="21" border="0" align="absmiddle" width="76" type="image" name="clear" value="clear" onClick="reset()" alt="clear" src="../../gui/img/control/blue_aqua/en/en_reset.gif"/><br><br>';
			}
			else
				echo '<br><br>';
			?>

  			<input height="21" border="0" align="absmiddle" width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>

			</p>
			<a href="insurance_tz.php?ntid=false&lang=$lang"><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>

		</form>
		</blockquote>
		</td>

	</tr>

		<tr valign=top >
		<td bgcolor=#cccccc>
							<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
<td align="center">
  <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>

   <tr>
   	<td>
	    <div class="copyright">
<script language="JavaScript">
<!-- Script Begin
function openCreditsWindow() {

	urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
	creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
//  Script End -->
</script>


 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
 <a href=mailto:info@care2x.org>Contact</???a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

</div>
	    <font size=1 face="verdana,arial">
	    Page generation time: 0.10928583145142
	    </font>
    </td>
   <tr>
  </table>
</td>
</tr>
</table>
					</td>

	</tr>

	</tbody>
 </table>


</BODY>
</HTML>