<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_passcheck.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

/**
* CARE 2002 Integrated Hospital Information System
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

function validarea(&$zeile2)
{
    global $allowedarea;
    for($j=0;$j<sizeof($allowedarea);$j++)
    {
      for ($i=3;$i<sizeof($zeile2);$i++)
       {
         if(!$zeile2[$i]) continue;
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

include("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
    {	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.addslashes($userid).'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
	
								if(isset($checkintern)&&$checkintern)
								{
								    $dec_login = new Crypt_HCEMD5($key_login,'');
									$keyword = $dec_login->DecodeMimeSelfRand($HTTP_COOKIE_VARS["ck_login_pw".$sid]);
    							}
								if (($zeile['mahopass_password']==$keyword)&&($zeile['mahopass_id']==$userid)) 
								{	
									if (!($zeile[mahopass_lockflag]))
									{
										if ($screenall||validarea($zeile))
										{	
										
										if(empty($zeile['mahopass_name'])) $zeile['mahopass_name']=" ";
										logentry($userid,$zeile['mahopass_name'],"IP:".$REMOTE_ADDR." $lognote ",$thisfile,$fileforward);		
										
										/**
										* Init crypt to use 2nd level key and encrypt the sid.
										* Store to cookie the "$ck_2level_sid.$sid"
										* There is no need to call another include of the inc_init_crypt.php since it is already included at the start 
										* of the script that called this script.
										*/
    									$enc_2level = new Crypt_HCEMD5($key_2level, makeRand());
										$ciphersid=$enc_2level->encodeMimeSelfRand($sid);
										setcookie(ck_2level_sid.$sid,$ciphersid);
										setcookie($userck.$sid,$zeile['mahopass_name']);	
										//print $fileforward;
										header("Location:$fileforward");
										exit;
										}else {$passtag=2;};
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
    }
	 else  print "$LDDbNoLink<br>";
?>

