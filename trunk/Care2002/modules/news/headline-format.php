 <?php
 /*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("headline-format.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

require_once($root_path.'include/inc_news_display_config.php');
?>
<tr>
<td>

	 <img <?php echo createComIcon($root_path,'headline4.png','0') ?>><br>
</td>
</tr>
<tr>
<?php
 /**
 * Routine to display the headlines
 */
for($j=1;$j<=$news_num_stop;$j++)
 {
		$picalign=($j==2)? 'right' : 'left';
 ?>

    <td>
<?php
include($root_path.'include/inc_news_preview.php');
?>
<hr>
</td>
  </tr>

<?php
}
?>
