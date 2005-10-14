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
    $db_drug_filter="mems_drug_list";
  
  $drug_list = $pres_obj->getDrugList($db_drug_filter, 0);
  if ($filter=='pediadric') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_pediatric");
  elseif ($filter=='adult') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_adult");
  elseif ($filter=='others') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_other");
  elseif ($filter=='consumable') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, "is_consumable");
} else {
  $drug_list = $pres_obj->getDrugList("mems_drug_list", 0);
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
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'druglist') ?>><div align="center"><input type="button" name="show" value="Drug List" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Drug List<?php echo $EXTERNAL_CALL_PARAMETER;?>')"></div></td>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'Supplies') ?>><div align="center"><input type="button" name="show" value="Supplies" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Supplies<?php echo $EXTERNAL_CALL_PARAMETER;?>')"></div></td>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'supplies-lab') ?>><div align="center"><input type="button" name="show" value="Special Supplies" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Supplies-Lab<?php echo $EXTERNAL_CALL_PARAMETER;?>')"></div></td>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'special-others') ?><div align="center"><input type="button" name="show" value="Special drugs" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Special Others<?php echo $EXTERNAL_CALL_PARAMETER;?>')"></div></td>
  </tr>
  <tr>
    <br>
    <td colspan="4" bgcolor="#CAD3EC">
      <table width="100%" border="0" align="center" bordercolor="#330066" cellpadding="0" cellspacing="0">      
      <tr>
        <td height="10">
          <font color="black">Common items of: </font>
        </td>
        <td bgcolor="#CAD3EC" width="130">
          <font color="black">Pediatric items: </font>
              <input type="radio" 
                  name="peadrics_button" 
                  value="<?PHP echo ($filter=='pediadric') ? '1' : '0';?>" 
                 <? if ($filter=='pediadric') echo 'checked';?>
                  onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=pediadric&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              >
        </td>
        <td bgcolor="#CAD3EC" width="100">
          <font color="black">Adult items: </font>
              <input type="radio" 
                name="adult_button" 
                value="<?PHP echo ($filter=='adult') ? '1' : '0';?>" 
                <? if ($filter=='adult') echo 'checked';?> 
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=adult&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              >
        </td>
        <td bgcolor="#CAD3EC" width="80">
          <font color="black">Others: </font>
              <input type="radio" 
                name="others_button" 
                value="<?PHP echo ($filter=='others') ? '1' : '0';?>" 
                <? if ($filter=='others') echo 'checked';?> 
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=others&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              >
        </td>
        <td bgcolor="#CAD3EC">
          <font color="black">Consumable items: </font>
              <input type="radio" 
                name="conusumable" 
                value="<?PHP echo ($filter=='consumable') ? '1' : '0';?>" 
                <? if ($filter=='consumable') echo 'checked';?> 
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&filter=consumable&mode=new&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              >
        </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CAD3EC"> 
        <table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="0" cellspacing="0">
          <tr>
            <td width="37%" rowspan="5">
                <select name="itemlist[]" size="10" style="width:235px;" >
  
                  <!-- dynamically managed content -->
  		            <?php	$pres_obj->DisplayDrugs($drug_list);	?>
                  <!-- dynamically managed content -->
  
                </select>
              </td>
            <td height="5">&nbsp;</td>
            <td width="38%" rowspan="5"><div align="center">
                <select name="selected_item_list[]" size="10" style="width:235px;">
  
                  <!-- dynamically managed content -->
                  <?php $pres_obj->DisplaySelectedItems($item_no); ?>
                  <!-- dynamically managed content -->
  
                </select>
              </div></td>
          </tr>
          <tr>
            <td height=50" valign="top"><div align="center">&nbsp;
                <input type="button" name="Del" value="add >>" onClick="javascript:item_add();">
              </div></td>
          </tr>
          <tr>
            <td width="25%" height="60" valign="top"> <div align="center">
                <input type="button" name="Add" value="<< del" onClick="javascript:item_delete();">
              </div></td>
          </tr>
          <tr>
            <td height="20" align="center">       
            <?
			        if (isset($externalcall)) {      
			        ?>
			        <input type="button" name="show" value="Prescribe!" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=insert&externalcall=<?php echo $externalcall;?>&disablebuttons=<?php echo $disablebuttons; ?>')">
			        <?
			        } else {
			        ?>
			        <input type="button" name="show" value="Prescribe!" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=insert&disablebuttons=<?php echo $disablebuttons; ?>')">
			        <?
			        }
        ?></td>
          </tr>
        </table>
    </tr>
  </form> <!-- end of form "prescription" -->
</table>