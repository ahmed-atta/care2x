<?php
if(!$death_date||$death_date=='0000-00-00'){
?>
 <b>
	<a href="<?php echo $thisfile.URL_APPEND.'&target='.$target.'&mode=new'; ?>"><img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>> <font color="#990000" SIZE=3  FACE="verdana,Arial"><?php echo $LDScheduleNewAppointment; ?></font></a>
</b>
<?php
}
?>
