<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
				require("../include/inc_db_makelink.php");
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
									header("location:my-passw-change.php?sid=$sid&lang=$lang&mode=pwchg");
									exit;
								}
						}
header ("location:my-passw-change.php?sid=$sid&lang=$lang&userid=$userid&keyword=$keyword");
exit;
?>
