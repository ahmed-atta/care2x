<?php
//require_once('./roots.php');
$debug=true;
  
$_SESSION['item_array']=NULL;

if (empty($show))
  $show="drug list"; // if there are no other values given, show the default: It is the drug list for doctors
    
if (!empty($show)) { // In case something goes wrong, then make nothing!      
  
  if ($debug) echo "Show tab: ".$show."<br>";
  if ($debug) echo "DB-Filter: ".$db_drug_filter."<br>";
  if ($debug) echo "DB-Filter2: ".$filter."<br>";
  if ($debug) echo "This is external call?: ".$externalcall."<br>";
  
  
  if (empty($db_drug_filter))
    $db_drug_filter="mems_drug_list";
  
  $drug_list = $pres_obj->getDrugList($db_drug_filter, 0,0,0,0);
  if ($filter=='pediadric') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, 1,0,0,0);
  elseif ($filter=='adult') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, 0,1,0,0);
  elseif ($filter=='others') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, 0,0,1,0);
  elseif ($filter=='consumable') 
    $drug_list = $pres_obj->getDrugList($db_drug_filter, 0,0,0,1);
} else {
  $drug_list = $pres_obj->getDrugList("mems_drug_list", 0,0,0,0);
}

?>
<script language="javascript" src="<?php echo $root_path;?>js/check_prescription_form.js"></script>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <? if ($debug) echo "this file is named: ".$thisfile."<br>"; ?>
  <? if ($debug) echo "activated tab: ".$activated_tab."<br>"; ?>
  <? if ($debug) echo URL_APPEND; ?>
  <form name="prescription" method="POST" action="<?php echo $thisfile.URL_APPEND;?>&mode=new">


  <tr>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'druglist') ?>><div align="center"><input type="button" name="show" value="Drug List" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Drug List&externalcall=<?php echo $externalcall;?>')"></div></td>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'Supplies') ?>><div align="center"><input type="button" name="show" value="Supplies" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Supplies&externalcall=<?php echo $externalcall;?>')"></div></td>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'supplies-lab') ?>><div align="center"><input type="button" name="show" value="Supplies-Lab" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Supplies-Lab&externalcall=<?php echo $externalcall;?>')"></div></td>
    <td <? $pres_obj->DisplayBGColor($activated_tab, 'special-others') ?><div align="center"><input type="button" name="show" value="Special Others" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=Special Others&externalcall=<?php echo $externalcall;?>')"></div></td>
  </tr>
  <tr>
    <br>
    <td colspan="4" bgcolor="#330066">
      <table widht="100%" border="1" align="center" bordercolor="#330066" cellpadding="0" cellspacing="0">      
      <tr>
        <td colspan="4" height="10">
          <br><font color="white">Show only itmes with attrubute of: </font>
        </td>
      </tr>
      <tr>
        <td bgcolor="#2302A8">
          <font color="white">peadric items: </font>
              <input type="radio" 
                  name="peadrics_button" 
                  value="<?PHP echo ($filter=='pediadric') ? '1' : '0';?>" 
                 <? if ($filter=='pediadric') echo 'checked';?>
                  onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=pediadric&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              > <br>
        </td>
        <td bgcolor="#2302A8">
          <font color="white">adult items: </font>
              <input type="radio" 
                name="adult_button" 
                value="<?PHP echo ($filter=='adult') ? '1' : '0';?>" 
                <? if ($filter=='adult') echo 'checked';?> 
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=adult&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              > <br>
        </td>
        <td bgcolor="#2302A8">
          <font color="white">others: </font>
              <input type="radio" 
                name="others_button" 
                value="<?PHP echo ($filter=='others') ? '1' : '0';?>" 
                <? if ($filter=='others') echo 'checked';?> 
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&filter=others&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              > <br>
        </td>
        <td bgcolor="#2302A8">
          <font color="white">consumable items: </font>
              <input type="radio" 
                name="conusumable" 
                value="<?PHP echo ($filter=='consumable') ? '1' : '0';?>" 
                <? if ($filter=='consumable') echo 'checked';?> 
                onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&filter=consumable&mode=new&show=<?php echo $show;?>&externalcall=<?php echo $externalcall;?>')"
              > <br>
        </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="300" colspan="4" bgcolor="#330066"> 
    
        <table width="100%" border="0" bgcolor="green">
          <tr>
            <td width="37%" rowspan="5"><div align="center">
                <select name="itemlist[]" size="10" style="width:200px;" >
  
                  <!-- dynamically managed content -->
  		            <?php	$pres_obj->DisplayDrugs($drug_list);	?>
                  <!-- dynamically managed content -->
  
                </select>
              </div></td>
            <td height="10">&nbsp;</td>
            <td width="38%" rowspan="5"><div align="center">
                <select name="selected_item_list[]" size="10" style="width:200px;">
  
                  <!-- dynamically managed content -->
                  <?php $pres_obj->DisplaySelectedItems($item_no); ?>
                  <!-- dynamically managed content -->
  
                </select>
              </div></td>
          </tr>
          <tr>
            <td height="50"><div align="center">&nbsp;
                <input type="button" name="Del" value="add >>" onClick="javascript:item_add();">
              </div></td>
          </tr>
          <tr>
            <td width="25%" height="50"> <div align="center">
                <input type="button" name="Add" value="<< del" onClick="javascript:item_delete();">
              </div></td>
          </tr>
          <tr>
            <td height="10"> <div align="center">&nbsp; </div></td>
          </tr>
        </table>
        <?
        if (isset($externalcall)) {      
        ?>
        <div align="right"><input type="button" name="show" value="PRESCRIBE THIS" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=insert&externalcall=<?php echo $externalcall;?>')">&nbsp;&nbsp;&nbsp;</div>
        <?
        } else {
        ?>
        <div align="right"><input type="button" name="show" value="PRESCRIBE THIS" onClick="javascript:submit_form('<?php echo $thisfile.URL_APPEND;?>&mode=new&show=insert')">&nbsp;&nbsp;&nbsp;</div>
        <?
        }
        ?>
    </tr>
  </form> <!-- end of form "prescription" -->
</table>