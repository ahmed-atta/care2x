<?php 
/**
*  A help function to either create input elements for lab's intern entries or
*  to show the entries in case of status != pending
*  Used in pathology
*/
function printLabInterns($param)
{
   global $stored_request, $date_format;

		   if($stored_request['status']=="pending")
		   {
	           echo '
	                   <input type="text" name="'.$param.'" size=10 maxlength=10 value="';
			   
			   if($stored_request[$param]) echo $stored_request[$param];
			   
			   echo '">&nbsp;';
		    }
			else 
			{
			   echo '<font face="verdana" size=2 color="#000000">'.$stored_request[$param].'</font>';
			}

}

function printCheckBox($param)
{
   	global $stored_request;
	
    if($stored_request[$param]==1) echo '<img '.createComIcon('../','chkbox_chk.gif','0','absmiddle').'>'; 
	  else echo '<img '.createComIcon('../','chkbox_blk.gif','0','absmiddle').'>';
}

function printRadioButton($param,$value)
{
   	global $stored_request;
	
	$noblank=1;
	
    if($value ) 
	{
	   if($stored_request[$param]) echo '<img '.createComIcon('../','radio_chk.gif','0','absmiddle').'>'; 
	   else $noblank=0;
	}
	  elseif(!$stored_request[$param]) echo '<img '.createComIcon('../','radio_chk.gif','0','absmiddle').'>'; 
	    else $noblank=0;
	 
	if(!$noblank) echo '<img '.createComIcon('../','radio_blk.gif','0','absmiddle').'>'; 

}

/* The following routine creates the list of pending requests */

if(!isset($tracker)||!$tracker) $tracker=1;

if($tracker>1)
{
   mysql_data_seek($requests,$tracker-2);
   $test_request=mysql_fetch_array($requests);
   mysql_data_seek($requests,0);

?>
<a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['patnum']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".($tracker-1); ?>"><img <?php echo createComIcon('../','uparrowgrnlrg.gif','0','left') ?> alt="<?php echo $LDPrevRequest ?>"></a>
<?php
}
if($tracker<$batchrows)
{
   mysql_data_seek($requests,$tracker);
   $test_request=mysql_fetch_array($requests);
?>
<a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['patnum']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".($tracker+1); ?>"><img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0','right') ?>  alt="<?php echo $LDNextRequest ?>"></a>
<?php
}

$tracker=1;
echo "<br><br>";

$send_date="";

/* Display the list of pending requests */
mysql_data_seek($requests,0);
while($test_request=mysql_fetch_array($requests))
{
  //echo $tracker."<br>";
  list($buf_date,$x)=explode(" ",$test_request['send_date']);
  if($buf_date!=$send_date)
  {
     echo "<FONT size=2 color=\"#990000\"><b>".formatDate2Local($buf_date,$date_format)."</b></font><br>";
	 $send_date=$buf_date;
  } 
  if($batch_nr!=$test_request['batch_nr'])
  {
        echo "<img src=\"../gui/img/common/default/pixel.gif\" border=0 width=4 height=7> <a href=\"".$thisfile."?sid=".$sid."&lang=".$lang."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['patnum']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".$tracker."\">".$test_request['batch_nr']." ".$test_request['room_nr']."</a><br>";
   }
   else
   {
        echo "<img ".createComIcon('../','redpfeil.gif','0')."> <FONT size=1 color=\"red\">".$test_request['batch_nr']." ".$test_request['room_nr']."</font><br>";
        $track_item=$tracker;
   }
   
   /* Check for the barcode png image, if nonexistent create it in the cache */
   if(!file_exists("../cache/barcodes/pn_".$test_request['patnum'].".png"))
   {
	  echo "<img src='../classes/barcode/image.php?code=".$test_request['patnum']."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
	}
   
  $tracker++;
}
/* Reset tracker to the actual request being shown */
$tracker=$track_item; 
?>
