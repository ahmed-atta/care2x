<link href="../care_dhis_reports.css" rel="stylesheet" type="text/css">
<form name="export" method="POST" action="./care_dhis_element_push.php">
  <table  border="0" cellpadding="5" align="left" cellspacing="0" bgcolor="#D2E7D1" class="searchboda" style="margin-top:10px;height:35px; width:60%; margin-left:10px; overflow:hidden;">
  
  

  
    <tr>
      <td height="34" align="left" valign="middle" nowrap>&nbsp;</td>
      <td align="left" valign="left" nowrap>Choose One Element</td>
      <td align="center" valign="middle" nowrap></td>
      <td align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
    <tr>
      <td width="40%" height="34" align="left" valign="top" nowrap>ICD10 Data Element</td>
    <?php
	
	//if ($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$searchString = $_GET['search'];

	
	 global $db;

	  $sql="SELECT description, diagnosis_code FROM care_icd10_en where description like '%".$searchString."%'";
      $rs_ptr = $db->Execute($sql);

      
	?>
      <td align="center" valign="middle" nowrap><select name="dhis_element[]" multiple="multiple" size="10" style="width:450px;">
      <? while ($row = $rs_ptr->FetchRow()){ ?>
      											<option value="<?php print $row[1]; ?>"><?php print $row[0]; ?></option>
                                                <?php
													}
													?>
                                                </select></td>
	
      <td width="7%" align="center" valign="middle" nowrap></td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
      //<?php 
	  //}
	  ?>
    </tr>
     <tr>
      <td width="40%" height="34" align="left" valign="middle" nowrap>&nbsp;</td>
      <td align="center" valign="middle" nowrap>&nbsp;</td>
      <td width="7%" align="center" valign="middle" nowrap><input type="submit" class="btn" name="Submit" value="Next"></td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
  </table>
</form>
