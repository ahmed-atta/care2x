<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_intra_email_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_intramail.php");


if((!$maxrow)&&(!$folder)) { header("location:intra-email.php?sid=$ck_sid&lang=$lang&mode=listmail"); exit;}
if($create) $del0="t=$t&r=$r&f=$f&s=$s&d=$d&z=$z";
	else
	{
		for($i=0;$i<$maxrow;$i++) 
		{
		$delbuf="del$i"; 
		if($$delbuf){ $delok=1;	break;}
		}
	if(!$delok) { header("location:intra-email.php?sid=$ck_sid&lang=$lang&mode=listmail"); exit;}
	}

require("../req/config-color.php"); // load color preferences
//print $del0;
$thisfile="intra-email-delete.php";
//foreach($arg as $v) print "$v<br>"; //init db parameters
$dbtable="mail_private_users";

$linecount=0;
$modetypes=array("sendmail","listmail");


require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
							$sql='SELECT '.$folder.', lastcheck FROM '.$dbtable.' WHERE  email="'.$ck_intra_email_user.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
			/*						for($i=0;$i<$maxrow;$i++)
									{
								$delbuf="del$i";
										$delbuf2=trim(strtr($$delbuf,"+"," "));
										$result[$folder]=trim($result[$folder]);
										//print $$delbuf."<br> vor replace";
										if(!$$delbuf) continue;
										$result[inbox]=str_replace("_".$delbuf2,"",$result[$folder]);
										//print "$result[inbox] after _ replace<br>";
										$result[$folder]=str_replace($delbuf2."\r\n_","",$result[$folder]);
										$result[$folder]=str_replace($delbuf2,"",$result[$folder]);
										
										//print "$result[inbox]<br> after replace";
									}*/
										$inb=explode("_",trim($result[$folder]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										for($n=0;$n<$maxrow;$n++)
										{
											$delbuf="del$n";
											if(!$$delbuf) continue;
											$delbuf2=trim(strtr($$delbuf,"+"," "));
											//print "$delbuf2<br>$inb[$i]<br>"; 
											if(!strcmp($delbuf2,trim($inb[$i])))
											{
												$trash=array_splice($inb,$i,1);
												$i--;
												break;
											}
										}
									}
									$result[$folder]=implode("_",$inb);
									$sql="UPDATE $dbtable SET $folder=\"$result[$folder]\", lastcheck=\"$result[lastcheck]\"  
																		WHERE email=\"$ck_intra_email_user\"";	
									if(mysql_query($sql,$link))
									{
										// update the recyle folder 
										if($folder!="trash")
										{
											$sql='SELECT trash, lastcheck FROM '.$dbtable.' WHERE  email="'.$ck_intra_email_user.'"';
											if($ergebnis=mysql_query($sql,$link)) 
											{			
						  						$rows=0;$delbuf=NULL;$result=NULL;
												while($result=mysql_fetch_array($ergebnis)) $rows++;	
												if($rows)
												{
													mysql_data_seek($ergebnis,0);
													$result=mysql_fetch_array($ergebnis);
													//print "$maxrow ";
													for($n=0;$n<$maxrow;$n++)
													{
														$delbuf="del$n";
														if(!$$delbuf) continue;
														$delbuf2=trim(strtr($$delbuf,"+"," "));
														//print $delbuf2."<br>";
														if($result[trash]=="") $result[trash]=$delbuf2."\r\n";
														else $result[trash].="_".$delbuf2."\r\n";
													}
													$sql="UPDATE $dbtable SET trash=\"$result[trash]\", lastcheck=\"$result[lastcheck]\"  
																		WHERE email=\"$ck_intra_email_user\"";	
													if(!mysql_query($sql,$link)) { print "$LDDbNoUpdate<br>$sql"; } 
												}
											//print $sql;
											} else { print "$LDDbNoRead<br>$sql"; } 
										}
										mysql_close($link);
										header("location:intra-email.php?sid=$ck_sid&lang=$lang&mode=listmail&l2h=$l2h&folder=$folder");
									}else { print "$LDDbNoUpdate<br>$sql"; } 
								}
				}else { print "$LDDbNoRead<br>$sql"; } 
	}
  		else { print "$LDDbNoLink<br>$sql"; } 
?>
