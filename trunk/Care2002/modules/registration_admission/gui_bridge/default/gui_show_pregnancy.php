<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDetails; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDelivery.' '.$LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDelivery.' '.$LDTime; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDelivery.' '.$LDClass; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDOutcome; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDNrOfFetus; ?></td>
  </tr>
<?php
while($row=$result->FetchRow()){
?>


  <tr bgcolor="#fefefe">
    <td><a href="#"><img <?php echo createComIcon($root_path,'info3.gif','0'); ?>></a></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['delivery_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><b><?php echo $row['delivery_time']; ?></b></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['delivery_class']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['outcome']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['number_of_fetuses']; ?></td>
  </tr>

<?php
}
?>
</table>
