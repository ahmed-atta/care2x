
<style type="text/css">
<!--
.boda {
	border: 1px none #CCCCCC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	text-decoration: none;
}
-->
</style>

<table width="188" border="0" cellpadding="3" cellspacing="0" class="boda">
  <tr> 
    <td width="120" align="right" valign="middle" nowrap>Select Year:</td>
    <td width="41" align="left" valign="middle" nowrap>
	
<select name="CYears" >
	<?php 
		$i=date("Y");
		$j = $i+3;
		$i = $i-3;
		
		do {
			echo '<option value = '.$i.'>'.$i.'</option>';
			$i++;
		}while ($i<=$j)
	 ?>
		
</select>
	 
	  </td>
    <td width="57" align="left" valign="middle" nowrap><input type="Submit"  name="Submit"value="  Show  "></td>
  </tr>
</table>

