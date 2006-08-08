<!-- outermost table for the form -->
<table border=0 cellpadding=1 cellspacing=0 bgcolor="#606060">
  <tr>
    <td>
	
	<!-- table for the form simulating the border -->
	<table border=0 cellspacing=0 cellpadding=0 bgcolor="white">
   <tr>
     <td>
	 
	 <!-- Here begins the table for the form  -->
	 
		<table   cellpadding=0 cellspacing=0 border=0 width=750>
			<tr  valign="top">
<!--
      			<td bgcolor="<?php echo $bgc1 ?>" width="230">
	  				<div class="lmargin">
	  				<font size=3 color="#990000" face="arial">
	   					<p>
	    
 					</div>
				</td>
-->
<!-- Middle block of first row -->
      			<td bgcolor="<?php echo $bgc1 ?>">
		 			<table border=1 cellpadding=0 bgcolor="" align="center">
     					<tr>
       				
   
<?php

/* Patient label */

 if($read_form)
{
echo '				
					<td width="25%">
					<font color="purple">Selian File Nr.:
						<font color="#ffffee" class="vi_data"><b>'.$h_selian_file_number.'
					</td>
					<td width="25%">
					<font color="purple">Batch File Nr.:
						<font color="#ffffee" class="vi_data"><b>'.$h_batch_nr.'				
					</td>
					<td width="25%">	
							<font color="purple">Surname/Ukoo:
					 	<font color="#ffffee" class="vi_data"><b>
						'.$h_name_last.'</b>
					</td>	
										
					<td width="25%">
					<font color="purple">First Name:
					<font color="#ffffee" class="vi_data"><b>
						'.$h_name_first.' </b>
					</font>
					</td>		
					

';					
    //echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
}

?>
</td>
     </tr>
   </table>
</td>


         <td  bgcolor="<?php echo $bgc1 ?>"  align="right">
<!--  Block for the casenumber codes -->  
 
 </table>

    </td>

	</tr>
<!--  The  row for batch number -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td align="center"  colspan=3>
	<font size=1 color="purple" face="verdana,arial" >
		<font size=1 color="purple" face="verdana,arial"> date of birth: </font><?php echo $h_birthdate;?>&nbsp;
		<font size=1 color="purple" face="verdana,arial"> sex: </font><img src="<?php echo $root_path;?>/gui/img/common/default/<?php echo $h_sex_img;?>"&nbsp;
		<font size=1 color="purple" face="verdana,arial"> System PID: </font><?php echo $h_pid;?>&nbsp;
    </td>

	</tr>
	<tr>
		<td>&nbsp;
			
		</td>
	</tr>	
	
	</table>
	
<!--  The test parameters begin  -->
<table border=0 cellpadding=0 cellspacing=0 width=750 bgcolor="<?php echo $bgc1 ?>">
 <?php
# Start buffering output
ob_start();
for($i=0;$i<=$max_row;$i++)
{
	echo '<tr class="lab">';
	for($j=0;$j<=$column;$j++)
	{	
			if($LD_Elements[$j][$i]['type']=='top')
			{
				echo '<td bgcolor="#ee6666" colspan="2"><font color="white">&nbsp;<b>'.$LD_Elements[$j][$i]['value'].'</b></font></td>';
			}
			else
			{
				
				if($LD_Elements[$j][$i]['value'])
				{
					echo '<td width="20">';
					if($stored_param['_task'.$LD_Elements[$j][$i]['id'].'_'])
					{
						echo '<img src="f.gif" border=0 width=18 height=6 id="_'.$LD_Elements[$j][$i]['id'].'_">';
					}
					else
					{
						echo '<img src="b.gif" border=0 width=18 height=6 id="_'.$LD_Elements[$j][$i]['id'].'_">';
					}
					echo '</td><td width='.(intval(745/$column)-18).'>'.$LD_Elements[$j][$i]['value'].'</td>';
				}
				else
				{
					echo '<td colspan=2>&nbsp;</td>';
				}
			}
		
	}
	
	echo '</tr><tr>';
	if($i<$max_row)
	{
  	for($k=0;$k<=$column;$k++)
  	{
  		echo '<td width=2></td><td bgcolor="#ffcccc" width='.(intval(745/$column)-18).' ><img src="p.gif"  width=1 height=1></td>';
  	}
  	echo '</tr>';
	}
}

//$sTemp=ob_get_contents();
ob_end_flush();

?>
  <tr>
    <td colspan=9>&nbsp;<font size=2 face="verdana,arial" color="black"><?php if($stored_request['doctor_sign']) echo stripslashes($stored_request['doctor_sign']); ?></td>
    <td colspan=11&nbsp;><font size=2 face="verdana,arial" color="black"><?php if($stored_request['notes']) echo stripslashes($stored_request['notes']); ?></td>
  </tr>
  <tr>
   <!-- <td colspan=20><font size=2 face="verdana,arial" color="purple">&nbsp;<?php echo $LDEmergencyProgram.' &nbsp;&nbsp;&nbsp;<img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle',TRUE).'> '.$LDPhoneOrder ?></td>-->
  </tr>

</table><!-- End of the main table holding the form -->
 
 	 </td>
   </tr>
 </table><!-- End of table simulating the border -->
 
	</td>
  </tr>
</table><!--  End of the outermost table bordering the form -->
