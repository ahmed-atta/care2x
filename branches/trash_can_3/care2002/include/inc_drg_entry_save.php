<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_drg_entry_save.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

	$dbtable="nursing_op_logbook";
	for($i=0;$i<$lastindex;$i++)
	{
		$selx="$itemselector$i";
		if($$selx=="") continue;
		$qlist[]=$$selx;
		if($linebuf=="") $linebuf=$$selx."&stat=&loc=&byna=&bynr";
			else $linebuf.="~".$$selx."&stat=&loc=&byna=&bynr";
	}
	
	if(trim($linebuf)!="")
	{
		include("../include/inc_db_makelink.php");
		if($link&&$DBLink_OK) 
		{	
		 					$sql="SELECT $element,op_date FROM $dbtable WHERE op_nr='$opnr' AND patnum='$pn' AND dept='$dept' AND op_room='$oprm'";
							//print $sql;
							if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								if( $pdata=mysql_fetch_array($ergebnis)) 
								{
									mysql_data_seek($ergebnis,0);
									$pdata=mysql_fetch_array($ergebnis);
									if(trim($pdata[$element]!="")) $linebuf=trim($pdata[$element])."~".$linebuf;
									list($d,$m,$y)=explode(".",$pdata['op_date']);
								}
							}
    			$sql="UPDATE $dbtable SET $element='$linebuf' WHERE op_nr='$opnr' AND patnum='$pn' AND dept='$dept' AND op_room='$oprm'";

        		$ergebnis=mysql_query($sql,$link);
				if($ergebnis)
       			{
					$sql="SELECT code_description,rank FROM drg_quicklist_".$lang." WHERE dept='$dept' AND type='$target' ORDER BY rank";
					if($result=mysql_query($sql,$link))
       				{
						//print $sql;
						if($zeile=mysql_fetch_array($result))
						{
							for($i=0;$i<sizeof($qlist);$i++)
							{
								//print "$qlist[$i]<br>";
								$isranked=0;
								if($qlist[$i]=="") continue;
								mysql_data_seek($result,0);
								while($zeile=mysql_fetch_array($result))
								{
									if(stristr($zeile['code_description'],$qlist[$i])) // if entry in list increase rank
									{
										$sql="UPDATE drg_quicklist_".$lang." SET rank='".($zeile[rank]+1)."' WHERE dept='$dept' AND type='$target' AND code_description='".$zeile['code_description']."'";
										$ergebnis=mysql_query($sql,$link);
										$isranked=1; //set flag
										//print $sql;
										break;
									}
								}
								if(!$isranked) // if not in list, insert new entry
								{
										$sql="INSERT INTO drg_quicklist_".$lang." (dept,type,code_description,rank) VALUES ('$dept','$target','$qlist[$i]','1')";
										$ergebnis=mysql_query($sql,$link);
								}
							}
						}
						else // if list not available insert all entries
						{
							for($i=0;$i<sizeof($qlist);$i++)
							{
										$sql="INSERT INTO drg_quicklist_".$lang." (dept,type,code_description,rank) VALUES ('$dept','$target','$qlist[$i]','1')";
										$ergebnis=mysql_query($sql,$link);
							}
						}
					}
					 else {print "<p>".$sql."<p>$LDDbNoWrite";};
					 
					//********************** related codes ************************
					
					if($save_related)
					{
						// get first the main op code from intern-codes
						$sql="SELECT ops_intern_code FROM nursing_op_logbook WHERE op_nr='$opnr' AND patnum='$pn' AND dept='$dept' AND op_room='$oprm'";
					 	if($main_result=mysql_query($sql,$link))
       				 	{
							if($main_code=mysql_fetch_array($main_result))
							{
								if($main_code['ops_intern_code']!="")
								{
									$arrbuf=explode("~",$main_code['ops_intern_code']);
									parse_str($arrbuf[0],$parsedcode);
								}
							}
						}
					
						if($parsedcode['code']!="")
						{
					 		$sql="SELECT $element_related,rank FROM drg_related_codes_".$lang." WHERE code='".$parsedcode['code']."' ORDER BY rank";
					 		if($result=mysql_query($sql,$link))
       				 		{
								//print $sql;
								if($zeile=mysql_fetch_array($result))
								{
									for($i=0;$i<sizeof($qlist);$i++)
									{
										//print "$qlist[$i]<br>";
										$isranked=0;
										if($qlist[$i]=="") continue;
										mysql_data_seek($result,0);
										while($zeile=mysql_fetch_array($result))
										{
											if(stristr($zeile[$element_related],$qlist[$i])) // if entry in list increase rank
											{
												$sql="UPDATE drg_related_codes_".$lang." SET rank='".($zeile[rank]+1)."' WHERE code='".$parsedcode['code']."' AND $element_related='$zeile[$element_related]'";
												$ergebnis=mysql_query($sql,$link);
												$isranked=1; //set flag
												//print $sql;
												break;
											}
										}
										if(!$isranked) // if not in list, insert new entry
										{
											$sql="INSERT INTO drg_related_codes_".$lang." (code,$element_related,rank) VALUES ('".$parsedcode['code']."','$qlist[$i]','1')";
											$ergebnis=mysql_query($sql,$link);
										}
									}
								}
								else // if list not available insert all entries
								{
									for($i=0;$i<sizeof($qlist);$i++)
									{
											$sql="INSERT INTO drg_related_codes_".$lang." (code,$element_related,rank) VALUES ('".$parsedcode['code']."','$qlist[$i]','1')";
										$ergebnis=mysql_query($sql,$link);
									}
								}
					 		}
					 		else {print "<p>".$sql."<p>$LDDbNoRead";};
						}
					}
					 // ***************** end of save related codes *********************
					 
					if(!$noheader)
					{
						header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target");
						//print $sql;
						exit;
					}
				}
				 else {print "<p>".$sql."<p>$LDDbNoWrite";};
		}
	}
?>
