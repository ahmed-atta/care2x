<?php

/*
these functions are integral to most password checkpoint modules
*/

function validarea($area,$zeile2,$range)
{
$abuf=explode(",",$area);
for($j=0;$j<sizeof($abuf);$j++)
{
   for ($i=0;$i<$range;$i++)
   {
 //  print $zeile2[$i];
      if($zeile2[$i]==$abuf[$j]) return 1; 
	}
}
  return 0;
}

function logentry($userid,$key,$report,$remark1,$remark2)
{
			$logpath="logs/access/".date(Y)."/";
			if (file_exists($logpath))
			{
				$logpath=$logpath.date("Y_m_d").".log";
				$file=fopen($logpath,"a");
				if ($file)
				{	if ($userid=="") $userid="blank"; 
					$line=date("d.m.Y").'  '.date("H.i").'  '.$report.'  Username='.$userid.'  Password='.$key.'  Fileaccess='.$remark1.'  Fileforward='.$remark2;
					fputs($file,$line);fputs($file,"\r\n");
					fclose($file);
				}
			}
}
?>
