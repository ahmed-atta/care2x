<table border=0 cellpadding=1 cellspacing=1 width=100%>
<?php

while($row=$result->FetchRow()){
	while(list($x,$v)=each($row)){
		list($x,$v)=each($row);
		if($x=='modify_id') break;
?>


  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><b><?php echo $x; ?></b></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $v; ?></td>
  </tr>

<?php
	}
}
?>
</table>
