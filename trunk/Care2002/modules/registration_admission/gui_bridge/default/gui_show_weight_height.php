
<script  language="javascript">
<!-- 
function popImmNotes(nr) {
	urlholder="./immunization_notes.php<?php echo URL_REDIRECT_APPEND; ?>&nr="+nr;
	IMMWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=300,resizable=yes,scrollbars=yes");
}
-->
</script>
<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDType; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
<!--     <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
 -->    <td  <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDValue; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDUnit; ?></td>
    <td  <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDEncounterNr; ?></td>
    <td width=25% <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDNotes; ?></td>
  </tr>
<?php
$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;
?>


  <tr bgcolor="<?php echo $bgc; ?>">
    <td valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo $row['type_name']; ?></td>
    <td valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['msr_date'],$date_format); ?></td>
<!--     <td valign="top"><FONT SIZE=-1  FACE="Arial" color="#006600"><b><?php echo $row['msr_time']; ?></b></td>
 -->    <td valign="top"><FONT SIZE=-1  FACE="Arial" color="#006600"><b><?php echo $row['value']; ?></b></td>
    <td valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo $row['unit_id']; ?></td>
    <td valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo $HTTP_SESSION_VARS['sess_full_en']; ?></td>
    <td valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo nl2br($row['notes']); ?></td>
  </tr>


<?php
}
?>
</table>
<?php
if($parent_admit) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new'; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
