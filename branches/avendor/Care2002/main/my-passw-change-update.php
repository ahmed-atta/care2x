<?
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
				require("../req/db-makelink.php");
				if($link&&$DBLink_OK) 
					{	
								$m=date(m);
								$y=date(Y);
								$m=$m+3;
								if($m>12)
								{
									$m=$m-12;
									$y++;
								} 
								if($m<10) $m="0".$m;
								$xd=$y.$m.date(d);
						
								$sql="UPDATE mahopass SET	mahopass_password='$n', expire_date='$xd'  WHERE mahopass_id='$userid'";
							
								if(mysql_query($sql,$link))
								{ 
								//print "ok";
									header("location:my-passw-change.php?sid=$ck_sid&lang=$lang&mode=pwchg");
									exit;
								}
						}
header ("location:my-passw-change.php?sid=$ck_sid&lang=$lang&userid=$userid&keyword=$keyword");
exit;
?>
