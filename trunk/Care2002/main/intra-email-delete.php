<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
$local_user='ck_intra_email_user';
require_once('../include/inc_front_chain_lang.php');


if(!isset($maxrow)||(isset($maxrow)&&empty($maxrow))||!isset($folder)||(isset($folder)&&empty($folder))) { header("location:intra-email.php?sid=$sid&lang=$lang&mode=listmail"); exit;}
if(isset($create)&&$create) $del0="t=$t&r=$r&f=$f&s=$s&d=$d&z=$z";
	else
	{
		for($i=0;$i<$maxrow;$i++) 
		{
		$delbuf="del$i"; 
		if(isset($$delbuf)&&$$delbuf){ $delok=1;	break;}
		}
	if(!isset($delok)||!$delok) { header("location:intra-email.php?sid=$sid&lang=$lang&mode=listmail"); exit;}
	}

require_once('../include/inc_config_color.php'); // load color preferences
//echo $del0;
$thisfile="intra-email-delete.php";
//foreach($arg as $v) echo "$v<br>"; //init db parameters
$dbtable='care_mail_private_users';

$linecount=0;
$modetypes=array("sendmail","listmail");

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
							$sql='SELECT '.$folder.', lastcheck FROM '.$dbtable.' WHERE  email="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									$inb=explode("_",trim($result[$folder]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										for($n=0;$n<$maxrow;$n++)
										{
											$delbuf="del$n";
											if(!isset($$delbuf)||!$$delbuf) continue;
											$delbuf2=trim(strtr($$delbuf,"+"," "));
											//echo "$delbuf2<br>$inb[$i]<br>"; 
											if(eregi($delbuf2,trim($inb[$i])))
											{
												$trash=array_splice($inb,$i,1);
												$i--;
												break;
											}
										}
									}
									$result[$folder]=implode("_",$inb);
									$sql="UPDATE $dbtable SET $folder=\"".$result[$folder]."\", lastcheck=\"".$result['lastcheck']."\"  
																		WHERE email=\"".$HTTP_COOKIE_VARS[$local_user.$sid]."\"";	
									if(mysql_query($sql,$link))
									{
										// update the recyle folder 
										if($folder!="trash")
										{
											$sql='SELECT trash, lastcheck FROM '.$dbtable.' WHERE  email="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"';
											if($ergebnis=mysql_query($sql,$link)) 
											{			
						  						$rows=0;$delbuf=NULL;$result=NULL;
												while($result=mysql_fetch_array($ergebnis)) $rows++;	
												if($rows)
												{
													mysql_data_seek($ergebnis,0);
													$result=mysql_fetch_array($ergebnis);
													//echo "$maxrow ";
													for($n=0;$n<$maxrow;$n++)
													{
														$delbuf="del$n";
														if(!isset($$delbuf)||!$$delbuf) continue;
														$delbuf2=trim(strtr($$delbuf,"+"," "));
														//echo $delbuf2."<br>";
														if($result['trash']=="") $result['trash']=$delbuf2."\r\n";
														else $result['trash'].="_".$delbuf2."\r\n";
													}
													$sql="UPDATE $dbtable SET trash=\"".$result['trash']."\", lastcheck=\"".$result['lastcheck']."\"  
																		WHERE email=\"".$HTTP_COOKIE_VARS[$local_user.$sid]."\"";	
													if(!mysql_query($sql,$link)) { echo "$LDDbNoUpdate<br>$sql"; } 
												}
											//echo $sql;
											} else { echo "$LDDbNoRead<br>$sql"; } 
										}
										mysql_close($link);
										header("location:intra-email.php?sid=$sid&lang=$lang&mode=listmail&l2h=$l2h&folder=$folder");
									}else { echo "$LDDbNoUpdate<br>$sql"; } 
								}
				}else { echo "$LDDbNoRead<br>$sql"; } 
	}
  		else { echo "$LDDbNoLink<br>$sql"; } 
?>
