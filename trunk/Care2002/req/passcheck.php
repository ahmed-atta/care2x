<?

function validarea(&$zeile2)
{
global $allowedarea;
for($j=0;$j<sizeof($allowedarea);$j++)
{
  for ($i=3;$i<sizeof($zeile2);$i++)
   {
   	if(!$zeile2[$i]) continue;
    //print "$zeile2[$i] - $allowedarea[$j]<br>";
     if($zeile2[$i]==$allowedarea[$j]) return 1; 
	}
}
  return 0;
}


function logentry(&$userid,$key,$report,&$remark1,&$remark2)
{
			$logpath="logs/access/".date(Y)."/";
			if (file_exists($logpath))
			{
				$logpath=$logpath.date("Y_m_d").".log";
				$file=fopen($logpath,"a");
				if ($file)
				{	if ($userid=="") $userid="blank"; 
					$line=date("d.m.Y").'/'.date("H.i").' '.$report.'  Username='.$key.'  Userid='.$userid.'  Fileaccess='.$remark1.'  Fileforward='.$remark2;
					fputs($file,$line);fputs($file,"\r\n");
					fclose($file);
				}
			}
}


				include("../req/db-makelink.php");
				if($link&&$DBLink_OK) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$userid.'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
	
								if(!$checkintern)
								{
									if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$userid)) $checkintern=1;
								}
								
								if($checkintern)
								{	
									if (!($zeile[mahopass_lockflag]))
									{
										if ($screenall||validarea($zeile))
										{	
										logentry($userid,$zeile[mahopass_name],"IP:".$REMOTE_ADDR." $lognote ",$thisfile,$fileforward);			
										setcookie($userck,$zeile[mahopass_name]);	
										//print $fileforward;
										header("Location:$fileforward");
										exit;
										}else {$passtag=2;};
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
				}
				 else 
				{ print "$LDDbNoLink<br>"; }
?>

