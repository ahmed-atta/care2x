<!-- <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 -->
 <?php
 
 if($cat=="pharma") $dbtable="pharma_products_main";
	else $dbtable="med_products_main";

include("../req/db-makelink.php");


// if mode is save then save the data
if($mode=="save")
{

$saveok=false;
$error=false;
$error_bnum=false;
$error_name=false;
$error_besc=false;

//remove hd tag from picfilename
if(($picfilename!="")&&strcmp($picfilename,$picref))
{
if(strpos($picfilename,"\\")) $picfilename=str_replace("\\\\","/",$picfilename); // convert \ to /
$picfilename=substr_replace($picfilename,'',0,strpos($picfilename,"/",3)); // removes the first directory
}
	//clean and check input data variables
	$encoder=trim($encoder); if($encoder=="") $encoder=$ck_apo_db_user;
	$bestellnum=trim($bestellnum);if ($bestellnum=="") { $error_bnum=true; $error=true;};
	$artname=trim($artname); if ($artname=="") { $error_name=true; $error=true; };
	$besc=trim($besc);if ($besc=="") { $error_besc=true; $error=true; };
	

	if(!$error) 
	{	

		if($link&&$DBLink_OK) 
					{			
					$oktosql=true;
					 if(!($update))
					  {
						$sql="INSERT INTO ".$dbtable." 
						(	bestellnum,
							artikelnum,
							industrynum,
							artikelname,
							generic,
							description,
							picfile,
							packing,
							minorder,
							maxorder,
							proorder,
							encoder,
							enc_date,
							enc_time,
							lock_flag,
							medgroup,
							cave ) 
						VALUES (
							'$bestellnum',
							'$artnum',
							'$indusnum',
							'$artname', 
							'$generic', 
							'$besc',
							'$picfilename',
							'$pack', 
							'$minorder', 
							'$maxorder', 
							'$proorder', 
							'$encoder', 
							'$dstamp', 
							'$tstamp', 
							'$lockflag', 
							'$medgroup', 
							'$caveflag')";
					
					 }
					  else
					 {
					 	$updateok=true;
					 	$tail='generic="'.$generic.'",
							description="'.$besc.'",
							packing="'.$pack.'",
							minorder="'.$minorder.'",
							maxorder="'.$maxorder.'",
							proorder="'.$proorder.'",
							picfile="'.$picfilename.'",
							encoder="'.$encoder.'",
							enc_date="'.$dstamp.'",
							enc_time="'.$tstamp.'",
							lock_flag="'.$lockflag.'",
							medgroup="'.$medgroup.'",
							cave="'.$caveflag.'"';
					 
						$sql='UPDATE '.$dbtable.' SET ';
						
						if($ref_bnum==$bestellnum)
							$sql=$sql.'artikelnum="'.$artnum.'", industrynum="'.$indusnum.'", artikelname="'.$artname.'", '.$tail.' WHERE bestellnum="'.$bestellnum.'"';
							else if ($ref_artnum==$artnum)
								$sql=$sql.'bestellnum="'.$bestellnum.'", industrynum="'.$indusnum.'", artikelname="'.$artname.'", '.$tail.' WHERE artikelnum="'.$artnum.'"';
								else if($ref_indusnum==$indusnum)
									$sql=$sql.'bestellnum="'.$bestellnum.'", artikelnum="'.$artnum.'", artikelname="'.$artname.'", '.$tail.' WHERE industrynum="'.$indusnum.'"';
									else if($ref_artname==$artname)
									$sql=$sql.'bestellnum="'.$bestellnum.'", artikelnum="'.$artnum.'", industrynum="'.$indusnum.'", '.$tail.' WHERE artikelname="'.$artname.'"';
									else 
									{	$updateok=false; $oktosql=false;}
							//print "q comp ".$sql;
							if($updateok) $keyword=$bestellnum;else  $keyword=$ref_bnum;
					}	
					if($oktosql)
					{
						if(mysql_query($sql,$link))
						{ 
							$saveok=true;
							//print "q ok ".$sql;
						}
			 			else {print "<p>".$sql."<p>Das Speichern der Daten is gescheitert.";};
 					}

				}
				 else 
				{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }
//		print "</td></tr></table>";
     };
}
?>
