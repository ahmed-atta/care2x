<script language="javascript">
<!-- 
function deleteCurrency(n,s)
{
	if(s=="main")
	{
		alert("<?php echo $LDNoMainDelete ?>");
	}
	else if (confirm("<?php echo $LDDeleteCurrency ?>"))
		{
			window.location.replace('<?php echo $thisfile.'?sid='.$sid.'&lang='.$lang ?>&mode=delete&item_no=' + n );
		}

}
 -->
</script>


<ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<?php echo $LDSetCurrency ?> </FONT><FONT    SIZE=3 color=#800000 FACE="Arial"><p>
<?php
if(($mode=='save')&&$new_main_currency) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'> '.$LDNewCurrencySet.'<p>';
echo $LDPlsSelectCurrency;
?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<form action="<?php echo $thisfile ?>" name="c_form" method="post" onSubmit="return chkForm(this)">
<table border=0 cellspacing=1 cellpadding=5>  
<?php 

while($currency=$ergebnis->FetchRow())
{
  echo '<tr>
    <td bgcolor="#e9e9e9"><input type="radio" name="new_main_item" value="'.$currency['item_no'].'"';
  if($currency['status']=='main')
  {
    echo ' checked';
	$old_main_item=$currency['item_no'];
  }
  echo '></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.$currency['short_name'].'</b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.$currency['long_name'].'</b> </FONT></td>
	<td bgcolor="#f9f9f9"><FONT   FACE="verdana,arial" size=2>'.$currency['info'].'<br></td>  
	<td bgcolor="#e9e9e9"><FONT   FACE="verdana,arial" size=2';
	if($currency['status']=='main') {
	    echo ' color="red"';
	    $ld_buffer='LD'.$currency['status'];
	    echo '>'.$$ld_buffer.'<br>';
	}
	echo '
	</td>';
	if(defined('SET_EDIT') && SET_EDIT==1) echo '<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2>
	<a href="'.$editfile.$currency['item_no'].'"><button onClick="javascript:window.location.href=\''.$editfile.$currency['item_no'].'\'">'.$LDEditInfo.'</button></a> </FONT>
	</td>';
	//echo '<td><a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&mode=delete&item_no='.$currency['item_no'].'"><img '.createComIcon($root_path,'delete2.gif','0').' alt="'.$LDDelete.'"></a></td>';
	echo '<td bgcolor="#e9e9e9"><a href="javascript:deleteCurrency('.$currency['item_no'].',\''.$currency['status'].'\')"><img '.createComIcon($root_path,'delete2.gif','0').' alt="'.$LDDelete.'"></a></td>';

	echo '
	</tr>';
}
?>
</table>
<p>
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="old_main_item" value="<?php echo $old_main_item; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>
<p><br><p>
<hr>
<a href="<?php echo $bottomlink; ?>">
 <img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0') ?>> <?php echo $bottomlink_txt; ?></a>
 </ul>
