<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_drg_entry_save.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

	$dbtable='care_nursing_op_logbook';
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
		if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
		if($dblink_ok){
		 					$sql="SELECT ".$element.",op_date FROM ".$dbtable." WHERE op_nr='".$opnr."' AND encounter_nr='".$pn."' AND dept_nr='".$dept_nr."' AND op_room='".$oprm."'";
							//print $sql;
							if($ergebnis=$db->Execute($sql))
       						{
								if( $ergebnis->RecordCount()) 
								{
									$pdata=$ergebnis->FetchRow();
									if(trim($pdata[$element]!="")) $linebuf=trim($pdata[$element])."~".$linebuf;
									list($d,$m,$y)=explode(".",$pdata['op_date']);
								}
							}
    			$sql="UPDATE ".$dbtable." SET ".$element."='$linebuf' WHERE op_nr='".$opnr."' AND encounter_nr='".$pn."' AND dept_nr='".$dept_nr."' AND op_room='".$oprm."'";

        		$ergebnis=$db->Execute($sql);
				if($ergebnis)
       			{
					$sql="SELECT code_description,rank FROM care_drg_quicklist WHERE dept_nr='".$dept_nr."' AND type='".$target."' AND lang='".$lang."' ORDER BY rank";
					if($result=$db->Execute($sql))
       				{
						//print $sql;
						if($result->RecordCount())
						{
							for($i=0;$i<sizeof($qlist);$i++)
							{
								//print "$qlist[$i]<br>";
								$isranked=0;
								if($qlist[$i]=="") continue;
								while($zeile=$result->FetchRow())
								{
									if(stristr($zeile['code_description'],$qlist[$i])) // if entry in list increase rank
									{
										$sql="UPDATE care_drg_quicklist SET rank='".($zeile[rank]+1)."' WHERE dept_nr='$dept_nr' AND lang='".$lang."' AND type='$target' AND code_description='".$zeile['code_description']."'";
										$ergebnis=$db->Execute($sql);
										$isranked=1; //set flag
										//print $sql;
										break;
									}
								}
								if(!$isranked) // if not in list, insert new entry
								{
										$sql="INSERT INTO care_drg_quicklist (lang,dept_nr,type,code_description,rank) VALUES ('".$lang."','".$dept_nr."','".$target."','".$qlist[$i]."','1')";
										$ergebnis=$db->Execute($sql);
								}
							}
						}
						else // if list not available insert all entries
						{
							for($i=0;$i<sizeof($qlist);$i++)
							{
										$sql="INSERT INTO care_drg_quicklist (lang,dept_nr,type,code_description,rank) VALUES ('".$lang."','".$dept_nr."','".$target."','".$qlist[$i]."','1')";
										$ergebnis=$db->Execute($sql);
							}
						}
					}
					 else {print "<p>".$sql."<p>$LDDbNoWrite";};
					 
					//********************** related codes ************************
					
					if($save_related)
					{
						// get first the main op code from intern-codes
						$sql="SELECT ops_intern_code FROM nursing_op_logbook WHERE op_nr='$opnr' AND encounter_nr='$pn' AND dept_nr='$dept_nr' AND op_room='$oprm'";
					 	if($main_result=$db->Execute($sql))
       				 	{
							if($main_code=$main_result->FetchRow())
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
					 		$sql="SELECT ".$element_related.",rank FROM care_drg_related_codes WHERE code='".$parsedcode['code']."' AND lang='".$lang."'  ORDER BY rank";
					 		if($result=$db->Execute($sql))
       				 		{
								//print $sql;
								if($result->RecordCount())
								{
									for($i=0;$i<sizeof($qlist);$i++)
									{
										//print "$qlist[$i]<br>";
										$isranked=0;
										if($qlist[$i]=="") continue;
										while($zeile=mysql_fetch_array($result))
										{
											if(stristr($zeile[$element_related],$qlist[$i])) // if entry in list increase rank
											{
												$sql="UPDATE care_drg_related_codes SET rank='".($zeile[rank]+1)."' WHERE code='".$parsedcode['code']."' AND $element_related='".$zeile[$element_related]."' AND lang='".$lang."'";
												$ergebnis=$db->Execute($sql);
												$isranked=1; //set flag
												//print $sql;
												break;
											}
										}
										if(!$isranked) // if not in list, insert new entry
										{
											$sql="INSERT INTO care_drg_related_codes (lang,code,".$element_related.",rank) VALUES ('".$lang."','".$parsedcode['code']."','".$qlist[$i]."','1')";
											$ergebnis=$db->Execute($sql);
										}
									}
								}
								else // if list not available insert all entries
								{
									for($i=0;$i<sizeof($qlist);$i++)
									{
											$sql="INSERT INTO care_drg_related_codes (lang,code,$element_related,rank) VALUES ('".$lang."','".$parsedcode['code']."','".$qlist[$i]."','1')";
										$ergebnis=$db->Execute($sql);
									}
								}
					 		}
					 		else {print "<p>".$sql."<p>$LDDbNoRead";};
						}
					}
					 // ***************** end of save related codes *********************
					 
					if(!$noheader)
					{
						header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target");
						//print $sql;
						exit;
					}
				}
				 else {print "<p>".$sql."<p>$LDDbNoWrite";};
		}
	}
?>
