<table width="<?php echo $controls_table_width ?>"  cellpadding=0 cellspacing=0>
<tr><td>
<input type="image" <?php echo createLDImgSrc('../','abschic.gif') ?> alt="<?php echo $LDSend ?>">
</td>
<td align=right>
<?php
if ($mode=="edit")
{
?>
<a href="javascript:printOut()"><img <?php echo createLDImgSrc('../','printout.gif','0') ?>></a>
<?php
}
?>
<a href="javascript:sendLater()"><img <?php echo createLDImgSrc('../','sendlater.gif','0') ?> alt="<?php echo $LDSendLater ?>"></a>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
</td>
</tr>
</table>

