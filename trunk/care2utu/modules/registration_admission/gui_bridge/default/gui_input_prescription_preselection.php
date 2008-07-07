<?php
//require_once('./roots.php');
$debug=false;

$_SESSION['item_array']=NULL;

if (empty($show))
  $show="drug list"; // if there are no other values given, show the default: It is the drug list for doctors

if (!empty($show)) { // In case something goes wrong, then do nothing!

  if ($debug) echo "Show tab: ".$show."<br>";
  if ($debug) echo "DB-Filter: ".$db_drug_filter."<br>";
  if ($debug) echo "DB-Filter2: ".$filter."<br>";
  if ($debug) echo "This is external call?: ".$externalcall."<br>";



  if (empty($db_drug_filter))
    $db_drug_filter="drug_list";

  $drug_list = $pres_obj->getDrugList($db_drug_filter, 0);

  if ($filter=='pediadric')
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_pediatric");
  elseif ($filter=='adult')
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_adult");
  elseif ($filter=='others')
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_other");
  elseif ($filter=='consumable')
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_consumable");
}
else {
  $drug_list = $pres_obj->getDrugList("drug_list", 0);
}
?>

<script language="javascript" src="<?php echo $root_path;?>js/check_prescription_form.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <? if ($debug) echo "this file is named: ".$thisfile."<br>"; ?>
  <? if ($debug) echo "activated tab: ".$activated_tab."<br>"; ?>
  <? if ($debug) echo URL_APPEND; ?>
  <form name="prescription" method="POST" action="<?php echo $thisfile.URL_APPEND;?>&mode=new">
  <tr>
    <?php
      if (isset($externalcall))
        $EXTERNAL_CALL_PARAMETER="&externalcall=".$externalcall;
    ?>
    <td colspan="4">
    	<table border="0" width="100%" cellpadding="0" cellspacing="0">
    		<tr>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'druglist') ?>><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Drug List&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_drugs.gif" alt="Drug List"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'Supplies') ?>><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Supplies&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_supplies.gif" alt="Supplies"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'supplies-lab') ?>><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Supplies-Lab&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_specialsupplies.gif" alt="Special Supplies"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'special-others') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Special Others&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_specialdrugs.gif" alt="Special Drugs"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'xray') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=xray&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_xray.gif" alt="X-Ray"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'service') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=service&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_service.gif" alt="Service/Registration"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'dental') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=dental&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_dental.gif" alt="Dental Services"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'smallop') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=smallop&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_smallop.gif" alt="Minor OP"></a></div></td>
			    <td <? $pres_obj->DisplayBGColor($activated_tab, 'bigop') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=bigop&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/prescription_bigop.gif" alt="Major OP"></a></div></td>
				<td <? $pres_obj->DisplayBGColor($activated_tab, 'eye-service') ?><div align="center"><a href="#" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=eye-service&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')"><img border="0" src="../../gui/img/common/default/eye.gif" alt="Eye Clinic"></a></div></td>
    		</tr>
    	</table>
    </td>
  </tr>
  <tr>
    <br>
    <td colspan="4" bgcolor="#CAD3EC">
    <?php
    if($activated_tab=='druglist' || $activated_tab == 'Supplies' || $activated_tab == 'supplies-lab' || $activated_tab == 'special-others')
    {
    	?>
      <table width="100%" border="0" align="center" bordercolor="#330066" cellpadding="0" cellspacing="0">
      <tr>
        <td height="10">
          <font color="black"><?php echo $LDCommonItemOf; ?> </font>
        </td>
        <td bgcolor="#CAD3EC" width="130">

              <input type="radio"
                  name="peadrics_button"
                  value="<?PHP echo ($filter=='pediadric') ? '1' : '0';?>"
                 <? if ($filter=='pediadric') echo 'checked';?>
                  onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=pediadric&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              ><font color="black"><?php echo $LDPediatricItems; ?></font>
        </td>
        <td bgcolor="#CAD3EC" width="100">

              <input type="radio"
                name="adult_button"
                value="<?PHP echo ($filter=='adult') ? '1' : '0';?>"
                <? if ($filter=='adult') echo 'checked';?>
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=adult&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              ><font color="black"><?php echo $LDAdultItems; ?></font>
        </td>
        <td bgcolor="#CAD3EC" width="80">

              <input type="radio"
                name="others_button"
                value="<?PHP echo ($filter=='others') ? '1' : '0';?>"
                <? if ($filter=='others') echo 'checked';?>
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=others&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              ><font color="black"><?php echo $LDOthers; ?></font>
        </td>
        <td bgcolor="#CAD3EC">

              <input type="radio"
                name="conusumable"
                value="<?PHP echo ($filter=='consumable') ? '1' : '0';?>"
                <? if ($filter=='consumable') echo 'checked';?>
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&filter=consumable&mode=new&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              >
              <font color="black"><?php echo $LDARVDrugs; ?></font></td>
      </tr>
      </table>
      <?php
    }
      ?>
    <?php
    if($activated_tab=='eye-service' || $activated_tab=='eye-surgery' || $activated_tab=='eye-glasses')
    {
    	?>
      <table  border="0" align="center" bordercolor="#330066" cellpadding="0" cellspacing="0">
      <tr>
        <td height="10">
          <font color="black"><?php echo $LDCommonItemOf; ?> </font>
        </td>

		<td ><div align="center"><input type="radio" name='service' onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=eye-service&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')">Service</div></td>
	     <td ><div align="center"><input type="radio" name='surgery' onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=eye-glasses&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')">Glasses</div></td>
    	 <td><div align="center"><input type="radio" name='glasses' onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=eye-surgery&disablebuttons=<?php echo $disablebuttons;?><?php echo $EXTERNAL_CALL_PARAMETER;?>&backpath=<?php echo urlencode($backpath); ?>')">Surgery</div></td>
<!--        <td bgcolor="#CAD3EC" width="130">


              <input type="radio"
                  name="peadrics_button"
                  value="<?PHP echo ($filter=='pediadric') ? '1' : '0';?>"
                 <? if ($filter=='pediadric') echo 'checked';?>
                  onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=pediadric&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              ><font color="black"><?php echo 'Glasses'; ?></font>
        </td>
        <td bgcolor="#CAD3EC" width="100">

              <input type="radio"
                name="adult_button"
                value="<?PHP echo ($filter=='adult') ? '1' : '0';?>"
                <? if ($filter=='adult') echo 'checked';?>
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=adult&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              ><font color="black"><?php echo 'Surgery'; ?></font>
        </td>
        <td bgcolor="#CAD3EC" width="80">

              <input type="radio"
                name="others_button"
                value="<?PHP echo ($filter=='others') ? '1' : '0';?>"
                <? if ($filter=='others') echo 'checked';?>
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=others&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons;?>&backpath=<?php echo urlencode($backpath); ?>')"
              ><font color="black"><?php echo 'Service'; ?></font>
        </td>-->
              </tr>
      </table>
      <?php
    }
      ?>













    </td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CAD3EC">
        <table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="0" cellspacing="0">
          <tr>
            <td width="37%" rowspan="5">
                <select name="itemlist[]" size="22" style="width:315px;" onDblClick="javascript:item_add();">

                  <!-- dynamically managed content -->
  		            <?php	$pres_obj->DisplayDrugs($drug_list);?>

                  <!-- dynamically managed content -->

                </select>
              </td>
            <td height="5">&nbsp;</td>
            <td width="38%" rowspan="5"><div align="center">
                <select name="selected_item_list[]" size="22" style="width:315px;" onDblClick="javascript:item_delete();">

                  <!-- dynamically managed content -->
                  <?php $pres_obj->DisplaySelectedItems($item_no); ?>
                  <!-- dynamically managed content -->

                </select>
              </div></td>
          </tr>
          <tr>
            <td height=50" valign="top"><div align="center">&nbsp;
                <input type="button" name="Del" value="<?php echo $LDadd; ?> >>" onClick="javascript:item_add();">
              </div></td>
          </tr>
          <tr>
            <td width="25%" height="60" valign="top"> <div align="center">
                <input type="button" name="Add" value="<< <?php echo $LDdel; ?>" onClick="javascript:item_delete();">
              </div></td>
          </tr>
          <tr>
            <td height="20" align="center">
            <?
			        if (isset($externalcall)) {
			        ?>
			        <input type="button" name="show" value="<?php echo $LDPrescribe; ?>" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=insert&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons; ?>&backpath=<?php echo urlencode($backpath); ?>')">
			        <?
			        } else {
			        ?>
			        <input type="button" name="show" value="<?php echo $LDPrescribe; ?>" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=insert&disablebuttons=<?php echo $disablebuttons; ?>&backpath=<?php echo urlencode($backpath); ?>')">
			        <?
			        }
        ?></td>
          </tr>
        </table>
    </tr>
  </form> <!-- end of form "prescription" -->
</table>