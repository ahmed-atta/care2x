<ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<?php echo $LDSetCurrency ?> </FONT><FONT    SIZE=3 color=#800000 FACE="Arial"><p>
<?php
if(($mode=="save")&&$new_main_currency) echo '<img '.createMascot('../','mascot1_r.gif','0','absmiddle').'> '.$LDNewCurrencySet.'<p>';
echo $LDPlsSelectCurrency;
?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<form action="<?php echo $thisfile ?>" name="c_form" method="post" onSubmit="return chkForm(this)">
<table border=0 cellspacing=1 cellpadding=5>  
<?php 

while($currency=mysql_fetch_array($ergebnis))
{
  echo '<tr>
    <td bgcolor="#e9e9e9"><input type="radio" name="new_main_item" value="'.$currency['item_no'].'"';
  if($currency['status']=="main")
  {
    echo " checked";
	$old_main_item=$currency['item_no'];
  }
  echo '></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.$currency['short_name'].'</b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.$currency['long_name'].'</b> </FONT></td>
	<td bgcolor="#f9f9f9"><FONT   FACE="verdana,arial" size=2>'.$currency['info'].'<br></td>  
	<td bgcolor="#e9e9e9"><FONT   FACE="verdana,arial" size=2';
	if($currency['status']=="main") echo ' color="red"';
	$ld_buffer="LD".$currency['status'];
	echo '>'.$$ld_buffer.'<br>
	</td>';
	if(SET_EDIT==1) echo '<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2>
	<a href="'.$editfile.$currency['item_no'].'"><button onClick="javascript:window.location.href=\''.$editfile.$currency['item_no'].'\'">'.$LDEditInfo.'</button></a> </FONT>
	</td>';
	echo '
	</tr>';
}
?>
</table>
<p>
<a href="<?php echo $back2file ?>"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>></a>
<input type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>></a>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="old_main_item" value="<?php echo $old_main_item; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>
<p><br><p>
<hr>
<a href="<?php echo $bottomlink; ?>">
 <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> <?php echo $bottomlink_txt; ?></a>
 </ul>
