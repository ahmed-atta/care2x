<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}

function validarea(&$zeile2)
{
	global $allowedarea;
	$abuf=explode(",",$allowedarea);
	for($j=0;$j<sizeof($abuf);$j++)
	{
 	 	for ($i=0;$i<sizeof($zeile2);$i++)
  	 	{
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

	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$ck_login_userid.'"';
						//print $ck_login_userid."<p>";
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
									if (!($zeile[mahopass_lockflag]))
									{
										if (validarea($zeile))
										{				
										setcookie($internck,$zeile[mahopass_name]);	
										logentry($zeile[mahopass_name],"*","IP: $REMOTE_ADDR $a_info Direct Login Access OK'd",$thisfile,$fileforward);
										$fileforward=strtr($fileforward,"~%","&?");
										//print $fileforward;
										header("Location: ".$fileforward."&internok=1");
										exit;
										}
									}
							}
				}
				 else 
				{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; $passtag=5;}
										
$retfilepath=strtr($retfilepath,"~%","&?");		//print $retfilepath;	
header("location: ".$retfilepath."?sid=$ck_sid&lang=$lang&nointern=1");

?>
