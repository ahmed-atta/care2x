 <?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_db_save_mod.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

if(isset($cat)&&($cat=="pharma")) $dbtable="pharma_products_main";
	else $dbtable="med_products_main";

include("../include/inc_db_makelink.php");

// if mode is save then save the data
if(isset($mode)&&($mode=="save"))
{
    $saveok=false;
    $error=false;
    $error_bnum=false;
    $error_name=false;
    $error_besc=false;

    $bestellnum=trim($bestellnum);if ($bestellnum=="") { $error_bnum=true; $error=true;};
    $artname=trim($artname); if ($artname=="") { $error_name=true; $error=true; };
    $besc=trim($besc);if ($besc=="") { $error_besc=true; $error=true; };

    if(!$update)
	{	
					  	// check if order number exists
						$sql="SELECT bestellnum FROM $dbtable WHERE bestellnum='$bestellnum'";
						if($ergebnis=mysql_query($sql,$link))
						{ 
							$rows=0;
							if( $result=mysql_fetch_array($ergebnis)) $rows++;
							if($rows)
							{
								$error="order_nr_exists";
								$bestellnum="";
							}
						}
			 			else {print "<p>".$sql."<p>".$LDDbNoSave;};
	}

if(!$error) 
	{	
		//clean and check input data variables
		$encoder=trim($encoder); 
		if($encoder=="") 	$encoder=$ck_prod_db_user; 
		// save the uploaded picture
		// if a pic file is uploaded move it to the right dir
		if($HTTP_POST_FILES['bild']['tmp_name']&&$HTTP_POST_FILES['bild']['size'])
		{
			$picext=substr($HTTP_POST_FILES['bild']['name'],strrpos($HTTP_POST_FILES['bild']['name'],".")+1);
			/**
			* Check if the file format is allowed
			*/
			if(stristr($picext,"gif")||stristr($picext,"jpg")||stristr($picext,"png"))
			{
			    $n=0;
			    $picfilename=$HTTP_POST_FILES['bild']['name'];
			    list($f,$x)=explode(".",$picfilename);
			    $idx=substr($picfilename,strpos($picfilename,"[")+1);
			    if($idx)
				{
				    $cf=substr($picfilename,0,strpos($picfilename,"["));
					$lx=substr($idx,0,strpos($idx,"]"));
					$n=$lx;
				}			
			   while(file_exists($imgpath.$picfilename))
			   {
				   $n++;
				   if($lx) $picfilename=$cf."[$n]".".".$x;
					else $picfilename=$f."[$n]".".".$x;
			    }
			  copy($HTTP_POST_FILES['bild']['tmp_name'],$imgpath.$picfilename);
		    }
			else
			{
			   $picext="";
			}
		}

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
							proorder="'.$proorder.'",';
						/**
						* If the image filename extension is empty do not update picfile
						*/
						if($picext!="") $tail.='picfile="'.$picfilename.'",';
						
						$tail.='encoder="'.$encoder.'",
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
							if($updateok) $keyword=$bestellnum;else  $keyword=$ref_bnum;
					}	
					if($oktosql)
					{
						if(mysql_query($sql,$link))
						{ 
							$saveok=true;
						}
			 			else {print "<p>".$sql."<p>$LDDbNoSave";};
 					}
				}
				 else 
				{ print "$sql<p>$LDDbNoLink<br>"; }
     };
}
?>
