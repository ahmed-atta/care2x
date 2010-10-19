
<form name="former" method="get">
  <table  border="0" cellpadding="5" align="left" cellspacing="0" bgcolor="#D2E7D1" class="searchboda" style="margin:10px 0 0 20px;height:35px; width:90%; overflow:hidden;">
    <tr>
      <td width="40%" height="34" align="center" valign="middle" nowrap>&nbsp;
      <input type="hidden" name="fw" value="<?php print $_GET['fw'];?>">
      <input type="hidden" name="ntid" value="<?php print $_GET['ntid'];?>">
      <input type="hidden" name="lang" value="<?php print $_GET['lang'];?>">
      <input type="hidden" name="mode" value="<?php print $_GET['mode'];?>">

      </td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
			  echo '<select name="mnth" class="other">';
			  $i=date("m");
			  do {
				  $mname=cal_to_jd(CAL_GREGORIAN,$i,1,date("Y"));

				   if (intval($i)<10) $i='0'.intval($i);

				   if (($mname==cal_to_jd(CAL_GREGORIAN,date("m"),1,date("Y"))) || (intval($_GET['mnth'])==$i))
					   {
						 echo "<option value=" . $i . " selected>";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						 $smonth = $i;
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
	  ?></td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
				  $i='2010';
				  echo '<select name="yrs"  class="other">';
				  do{
					  if ($i==date("Y")){
						 echo "<option selected>".$i."</option>";
						 $syear = $i;
						}
					  else{
						 echo "<option>".$i."</option>";
					  }
					$i+=1;
					}
				  while ($i<=(date("Y")));
				  echo "</select>";
			?>
      </td>
      <td width="3%" align="center" valign="middle" nowrap>

  	<input type="text" name="date" class="other" value="<?php $sdate =($_GET['date']!='')?$_GET['date']:date('d'); print $sdate;?>" id="date" size="10" maxlength="2" style="text-align:center; width:70px !important; font-weight:bold;"/>


      </td>
      <td width="7%" align="center" valign="middle" nowrap>
      <input type="submit" class="btn" name="Submit" value="View &raquo;">
      </td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
  </table>
</form>
