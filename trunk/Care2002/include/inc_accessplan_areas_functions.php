<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_accessplan_areas_functions.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(file_exists($root_path.'global_conf/'.$lang.'/accessplan-areas_'.$lang.'.php')) require($root_path.'global_conf/'.$lang.'/accessplan-areas_'.$lang.'.php');
	else require($root_path.'global_conf/en/accessplan-areas_en.php');

/**
* Do not edit the following lines of code. 
*/
function createselecttable($itemselect)
{
	global $areaopt;

	while(list($k,$v)=each($areaopt))
	{
		print '<option value="'.$k.'" ';
		if ($itemselect==$k) print "selected";
		print '>'.$v.'</option>';
	}
	reset($areaopt);
}

function printAccessAreas()
{
	global $areaopt;

	$batch=0;
	while(list($k,$v)=each($areaopt))
	{
		print $v.', ';
		$batch++;
		if($batch>3)
		{
		    print "<br>";
			$batch=0;
	    }
	}
	reset($areaopt);
}
?>
