<link href="../care_dhis_reports.css" rel="stylesheet" type="text/css">
<form name="export" method="POST" action="">
  <table  border="0" cellpadding="5" align="left" cellspacing="0" bgcolor="#D2E7D1" class="searchboda" style="margin-top:10px;height:35px; width:60%; margin-left:10px; overflow:hidden;">
    <tr>
      <td width="40%" height="34" align="left" valign="middle" nowrap>Export From</td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
			  //$i=date("Y");
			  echo '<select name="mnth" class="other">';
			  $i=1;
			  do
			  {
				  $mname=cal_to_jd(CAL_GREGORIAN,$i,1,date("Y"));

				   if ($mname==cal_to_jd(CAL_GREGORIAN,date("m"),1,date("Y")))
					   {
						 echo "<option value=" . $i . " selected>";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						}
					else{
						 echo "<option value=" . $i . ">";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						}
				  $i++;
				}
			  while ($i<13);
			  echo "</select>";
	  ?>
&nbsp;</td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
				  $i='2005';
				  echo '<select name="yrs"  class="other">';
				  do{
					  if ($i==date("Y")){
						 echo "<option selected>";
						 echo $i;
						 echo "</option>";
						}
					  else{
						 echo "<option>";
						 echo $i;
						 echo "</option>";
					  }
					$i+=1;
					}
				  while ($i<=(date("Y")));
				  echo "</select>";
			?>
      </td>
      <td width="7%" align="center" valign="middle" nowrap></td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
     <tr>
      <td width="40%" height="34" align="left" valign="middle" nowrap>Export To</td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
			  //$i=date("Y");
			  echo '<select name="mnthTo" class="other">';
			  $i=1;
			  do
			  {
				  $mname=cal_to_jd(CAL_GREGORIAN,$i,1,date("Y"));

				   if ($mname==cal_to_jd(CAL_GREGORIAN,date("m"),1,date("Y")))
					   {
						 echo "<option value=" . $i . " selected>";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						}
					else{
						 echo "<option value=" . $i . ">";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						}
				  $i++;
				}
			  while ($i<13);
			  echo "</select>";
	  ?>
&nbsp;</td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
				  $i='2005';
				  echo '<select name="yrsTo"  class="other">';
				  do{
					  if ($i==date("Y")){
						 echo "<option selected>";
						 echo $i;
						 echo "</option>";
						}
					  else{
						 echo "<option>";
						 echo $i;
						 echo "</option>";
					  }
					$i+=1;
					}
				  while ($i<=(date("Y")));
				  echo "</select>";
			?>
      </td>
      <td width="7%" align="center" valign="middle" nowrap><input type="submit" class="btn" name="Submit" value="Export;"></td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
  </table>
</form>
