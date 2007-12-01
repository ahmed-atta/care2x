 <?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_furnitor_db_save_mod.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

else $dbtable='care_furnitor';


// if mode is save then save the data
if(isset($mode)&&($mode=='save')){

    $saveok=false;
    $error=false;
    $error_bnum=false;
    $error_name=false;
    $error_besc=false;
    $error_minmax=false;

    $furnitor=trim($furnitor);
	if ($furnitor=='') { $error_furnitor=true; $error=true;};
    $perfaqesues=trim($perfaqesues); 
	
	
    if(!$update){	
		# check if order number exists
		
/*		$sql="SELECT bestellnum FROM $dbtable WHERE bestellnum='$bestellnum'";
		if($ergebnis=$db->Execute($sql)){ 
			if($ergebnis->RecordCount()){
				$error='order_nr_exists';
				$bestellnum='';
			}else{echo $sql;}
		}else{print '<p>'.$sql.'<p>'.$LDDbNoRead;};
*/
		if($furnitor_obj->FurnitorExists($furnitor,$cat)){
			$error='furnitor_exists';
			$furnitor='';
		}
	}

	if(!$error){	
		//clean and check input data variables

		$encoder=trim($encoder); 
		if($encoder=='') 	$encoder=$ck_prod_db_user; 
		// save the uploaded picture
		// if a pic file is uploaded move it to the right dir
/*		if(is_uploaded_file($HTTP_POST_FILES['bild']['tmp_name']) && $HTTP_POST_FILES['bild']['size']){
			$picext=substr($HTTP_POST_FILES['bild']['name'],strrpos($HTTP_POST_FILES['bild']['name'],'.')+1);
			# Check if the file format is allowed
			if(stristr($picext,'gif')||stristr($picext,'jpg')||stristr($picext,'png'))
			{
			    $n=0;
			    $picfilename=$HTTP_POST_FILES['bild']['name'];
			    list($f,$x)=explode('.',$picfilename);
			    $idx=substr($picfilename,strpos($picfilename,'[')+1);
			    if($idx)
				{
				    $cf=substr($picfilename,0,strpos($picfilename,'['));
					$lx=substr($idx,0,strpos($idx,']'));
					$n=$lx;
				}			
			   while(file_exists($imgpath.$picfilename))
			   {
				   $n++;
				   if($lx) $picfilename=$cf."[$n]".".".$x;
					else $picfilename=$f."[$n]".".".$x;
			    }
				
				# Prepend the order nr to the filename
				$picfilename=$bestellnum.'_'.$picfilename;
				# Now save the image to the hard drive
			  	copy($HTTP_POST_FILES['bild']['tmp_name'],$imgpath.$picfilename);
		    }
			else
			{
			   $picext='';
			}
		}*/

			$oktosql=true;
					
			if(!($update)){
			  
				$data=array('furnitori'=>$furnitor,
							'adresa'=>$adresa,
							'telefoni'=>$telefoni,
							'fax'=>$fax,
							'kodi_postar'=>$kodipostar,
							'perfaqesues'=>$perfaqesues,
							'history'=>"Created ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n",
							'create_id'=>$HTTP_SESSION_VARS['sess_user_name'],
							'create_time'=>date('YmdHis')
							 );
							
							# Set core to main products
							$furnitor_obj->useFurnitor($cat);
							$furnitor_obj->setDataArray($data);
							$saveok=$furnitor_obj->insertDataFromInternalArray();			
									
							$oktosql=false;
			}else{
					 	$updateok=true;
					 	$tail="adresa='$adresa',
							telefon='$telefoni',
							kodi_postar='$kodipostar',
							perfaqesues='$perfaqesues',";
						
						# If the image filename extension is empty do not update picfile
						
//						if($picext!="") $tail.="picfile='$picfilename',";

						$tail.="adresa='$adresa',
							telefon='$telefoni',
							kodi_postar='$kodipostar',
							perfaqesues='$perfaqesues',
							history=".$furnitor_obj->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n").",
							create_id = '".$HTTP_SESSION_VARS['sess_user_name']."',
							create_time = '".date('YmdHis')."'";

						$sql="UPDATE $dbtable SET ";

						if($ref_bnum==$furnitor)
							$sql=$sql."furnitori='$furnitor', $tail  WHERE bestellnum='$bestellnum'";
						else {	
							$updateok=false; 
							$oktosql=false;
						}
						if($updateok) 
							$keyword=$furnitor;
						else  
							$keyword=$ref_bnum;
			}
			//echo $sql;
			if($oktosql){
				if($furnitor_obj->Transact($sql)){
					$saveok=true;
				}else{print "no save<p>".$sql."<p>$LDDbNoSave";};
 			}
	}
}
?>
