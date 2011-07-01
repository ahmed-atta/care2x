<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

define('FILE_DISCRIM','.dcm'); # define here the file discrimator string 

$thisfile=basename(__FILE__);

$returnfile=$HTTP_SESSION_VARS['sess_file_return'];

//$db->debug=1;

# Load paths und dirs
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
# Create image object
require_once($root_path.'include/care_api_classes/class_image.php');
$img=new Image();


if(!isset($mode)){
	$mode='new';
} elseif(($mode=='create'||$mode=='update')&&$maxpic) {
		
		# makedir lock flags
		$persd=true;
		$imgd=true;
		$notyetsaved=true;
		# Internal counter used for prepending the filename. Do not use zero!
		$icount=1;
		# Begin storage of files
		for ($i=0;$i<$maxpic;$i++)
		{
		   $picfile='f'.$i;
		   # Check the image, use 'dcm' as discriminator
		   if($img->isValidUploadedImage($HTTP_POST_FILES[$picfile],'dcm'))
		   {
				//$data['mime_type']=$picext;
				# Hard code image type to "dicom"
				$data=array('pid'=>$pid,
									'encounter_nr'=>$HTTP_POST_VARS['encounter_nr'],
									'doc_ref_ids'=>$HTTP_POST_VARS['doc_ref_ids'],
									'img_type'=>'dicom',
									'notes'=>$HTTP_POST_VARS['notes'],
									'upload_date'=>date('Y-m-d'),
									'history'=>"Upload ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n",
									'create_id'=>$HTTP_SESSION_VARS['sess_user_name'],
									'create_time'=>date('YmdHis'));
				
				# Save data into the database
				if($notyetsaved){
					if($oid=$img->saveImgDiagnosticData($data)){
						# Get the primar key of the saved record
						$picnr = $img->LastInsertPK('nr',$oid);
						//echo $img->getLastQuery();
						# Lock save this save routine
						$notyetsaved=false;
					}else{
			   			echo $img->getLastQuery();
					}
				}
				if(!$notyetsaved&&$picnr){
			   		//$picfilename[$i]=$picnr.'.'.$picext;
					
					# Compose the prepend number
					# This will be prepended to filename eg. => 1003_angio.dcm
					# to simplify sorting of the filenames according to order of upload
					$prep=1000+$icount;
					
					$picfilename=$prep.'_'.$HTTP_POST_FILES[$picfile]['name'];
					
		      		//echo $HTTP_POST_FILES[$picfile]['name'].' <img '.createComIcon($root_path,'fwd.gif','0','absmiddle').'> ';
					# Echo for debugging
					//echo $picfilename.'<br>';
					
					# Compose the PID nr subdir					
					if($persd){
						$persondir=$root_path.$dicom_img_localpath.$pid;
					
			      		if(!is_dir($persondir)){
							# if $d directory not exist create it with CHMOD 777
							mkdir($persondir,0777); 
							# Copy the trap files to this new directory
							copy($root_path.$dicom_img_localpath.'donotremove/index.htm',$persondir.'/index.htm');
							//echo $root_path.$dicom_img_localpath.'donotremove/index.htm'.$persondir.'/index.htm'.'<br>';
							copy($root_path.$dicom_img_localpath.'donotremove/index.php',$persondir.'/index.php');
							//echo $root_path.$dicom_img_localpath.'donotremove/index.php'.$persondir.'/index.php'.'<br>';
							# Lock make dir
							$persd=false;
						}
					}
					# Compose the img nr  subdir					
					if($imgd){
						$imgdir=$persondir."/$picnr";
				      	if(!is_dir($imgdir)){
							# if $d directory not exist create it with CHMOD 777
							mkdir($imgdir,0777); 
							# Copy the trap files to this new directory
							copy($root_path.$dicom_img_localpath.'donotremove/donotremove/index.htm',$imgdir.'/index.htm');
							//echo $root_path.$dicom_img_localpath.'donotremove/donotremove/index.htm'.$imgdir.'/index.htm'.'<br>';
							copy($root_path.$dicom_img_localpath.'donotremove/donotremove/index.php',$imgdir.'/index.php');
							//echo $root_path.$dicom_img_localpath.'donotremove/donotremove/index.php'.$imgdir.'/index.php'.'<br>';
							# Lock make dir
						}
					}				
					
					$imgd=false;
					# Store to the newly created directory
					$dir_path=$imgdir.'/';										

					# Save the uploaded image
					if($img->saveUploadedImage($HTTP_POST_FILES[$picfile],$dir_path,$picfilename)){
						# Increse internal count
						$icount++;
					}
			   }else{
			   		echo $img->getLastQuery();
				}
			} # end of if()
	} # End of for() loop
	# Now check if data integrity is ok
	# Check if data is stored in the database but image not correctly uploaded
	if(!$notyetsaved&&$picnr&&($icount==1)){
		$img->useImgDiagnostic();
		# delete the record entry from the database
		# Note: __delete is a private method and is used only in this exception case.
		$img->__delete($picnr);
	}else{
		# Upload is successful, update datase with actual nr of files successfully uploaded
		$img->setImgMaxNr($picnr,$icount-1);
		# Redirect to fresh mode
		header("location:$thisfile".URL_REDIRECT_APPEND."&pid=$pid&saved=1&mode=show&nr=$picnr&maxpic=$maxpic");
		exit;
	}
}

$lang_tables[]='radio.php';
$lang_tables[]='prompt.php';
require('./include/init_show.php');

$page_title=$LDUploadDicom;

if($mode=='show'&&$nr) {
	$imgpath=$root_path.$dicom_img_localpath.$pid."/$nr";
	$files=&$img->FilesListArray($imgpath,FILE_DISCRIM);
	$rows=$img->LastRecordCount();
}

# Default nr of files
if(!isset($maxpic)||!$maxpic||!is_numeric($maxpic)||$maxpic<0) $maxpic=4;

# Prepare some parameters based on selected dicom viewer module
$pop_only=false;

switch($HTTP_SESSION_VARS['sess_dicom_viewer']){
	case 'raimjava':
			$pop_only=true;
			break;
	default:
				# Default viewer
}

# Set break file
require('include/inc_breakfile.php');

if($mode=='show') $glob_obj->getConfig('medocs_%');
/* Load GUI page */
require('./gui_bridge/default/gui_show_upload.php');
?>
