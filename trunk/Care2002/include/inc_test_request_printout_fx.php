<?php
function printLabInterns($param)
{
   global $printmode, $stored_request;
   
	     if($printmode)
		 {
	       echo '
	       <font face="arial" size=2 color="#000000">';
	       if($stored_request[$param]) echo $stored_request[$param];
	       echo '</font>';
	      }
		  else
		  {
           echo '
	       <input type="text" name="entry_date" size=10 maxlength=10 value="';
	       if($stored_request[$param]) echo $stored_request[param];
		   echo '">';
	      }
}

function printCheckBox($param)
{
   	global $stored_request;
	
    if($stored_request[$param]) echo '<img '.createComIcon('../','chkbox_chk.gif','0','absmiddle').'>'; 
	  else echo '<img '.createComIcon('../','chkbox_chk.gif','0','absmiddle').'>';
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
?>
