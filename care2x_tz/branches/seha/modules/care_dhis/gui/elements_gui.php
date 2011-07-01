<link href="../care_dhis_reports.css" rel="stylesheet" type="text/css">
<form name="export" method="POST" action="./care_dhis_icd10.php">
  <table  border="0" cellpadding="5" align="left" cellspacing="0" bgcolor="#D2E7D1" class="searchboda" style="margin-top:10px;height:35px; width:60%; margin-left:10px; overflow:hidden;">
  
  

  
    <tr>
      <td height="34" align="left" valign="middle" nowrap>&nbsp;</td>
      <td align="left" valign="left" nowrap>Choose One Element</td>
      <td align="center" valign="middle" nowrap></td>
      <td align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
    <tr>
      <td width="40%" height="34" align="left" valign="top" nowrap>Dhis Data Element</td>
    <?php

    include "./care_dhis_connect.php";
	
	$query = "select dataelementid, name from dataelement order by name";
	
	$dataElement = mysql_query($query) or die("Error in query: $query." . mysql_error($connection));	
	?>
      <td align="center" valign="middle" nowrap><select name="dhis_element" size="10">
      <? while($data = mysql_fetch_array($dataElement)){ ?>
      											<option value="<?php print $data['dataelementid']."|".$data['name']; ?>"><?php print $data['name']; ?></option>
                                                <?php
													}
													?>
                                                </select></td>
	
      <td width="7%" align="center" valign="middle" nowrap></td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
     <tr>
      <td width="40%" height="34" align="left" valign="middle" nowrap>&nbsp;</td>
      <td align="left" valign="middle" nowrap><input type="checkbox" name="under5" value="yes" />Check this box if the element concerned under 5 years</td>
      <td width="7%" align="center" valign="middle" nowrap><input type="submit" class="btn" name="Submit" value="Next"></td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
  </table>
</form>
