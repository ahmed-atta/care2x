 <?php

require_once($root_path.'include/inc_news_display_config.php');

 /**
 * Routine to display the headlines
 */
for($j=1;$j<=$news_num_stop;$j++)
 {
		$picalign=($j==2)? 'right' : 'left';
 ?>

<tr>
    <td>
<?php
include($root_path.'include/inc_news_preview.php');
?>
</td>
  </tr>
<tr>
<td>
<hr>
</td>
</tr>
<?php
}
?>
