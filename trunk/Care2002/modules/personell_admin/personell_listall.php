<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables=array('personell.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');


if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
	else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;

$thisfile=basename(__FILE__);

# Initialize page's control variables
if($mode!='paginate'){
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='';
	$oitem='';
}
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);

$GLOBAL_CONFIG=array();

# Get the max nr of rows from global config
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('personell_list_max_block_rows');
if(empty($GLOBAL_CONFIG['personell_list_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['personell_list_max_block_rows']);


if(empty($oitem)) $oitem='name_last';			
if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
# Set the sort parameters
$pagen->setSortItem($oitem);
$pagen->setSortDirection($odir);

$toggle=0;
		
$sql='SELECT ps.nr, ps.is_discharged, p.name_last, p.name_first, p.date_birth, p.addr_zip, p.sex, p.photo_filename';
			  
$sql2= ' FROM care_personell as ps,care_person as p WHERE (NOT ps.is_discharged)  AND ps.pid=p.pid  
	          ORDER BY p.'.$oitem.' '.$odir;

			  
if($ergebnis=$db->SelectLimit($sql.$sql2,$pagen->MaxCount(),$pagen->BlockStartIndex())){
	if ($linecount=$ergebnis->RecordCount()){ 
		if(($linecount==1)&&$numeric){
			$zeile=$ergebnis->FetchRow();
			header("location:personell_register_show.php".URL_REDIRECT_APPEND."&from=such&target=personell_listall&personell_nr=".$zeile['nr']."&sem=".(!$zeile['is_discharged']));
			exit;
		}
	}
	
	$pagen->setTotalBlockCount($linecount);
					
	
	# If more than one count all available
	if(isset($totalcount)&&$totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		# Count total available data
		$sql='SELECT COUNT(p.pid) AS count '.$sql2;
			
		if($result=$db->Execute($sql)){
			if ($result->RecordCount()) {
				$rescount=$result->FetchRow();
    			$totalcount=$rescount['count'];
    		}
		}
		$pagen->setTotalDataCount($totalcount);
	}

	
}else{echo "<p>$sql<p>$LDDbNoRead";};


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0   bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDPersonnelManagement :: $LDPersonellData :: $LDSearch" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('employee_all.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='personell_listall';
 include('./gui_bridge/default/gui_tabs_personell_reg.php') 

?>

</table>
<ul>

<FONT    SIZE=-1  FACE="Arial">

<?php

if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
	else echo str_replace('~nr~','0',$LDSearchFound); 
		  
	if ($linecount) { 

	# Load the common icons
	$img_options=createComIcon($root_path,'statbel2.gif','0');
	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa">';
	
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
			
?>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='pid') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDRegistryNr,'pid',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='sex') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDSex,'sex',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='name_last') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDLastName,'name_last',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='name_first') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDFirstName,'name_first',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='date_birth') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDBday,'date_birth',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='addr_zip') $flag=TRUE;
			else $flag=FALSE;
		 echo $pagen->SortLink($LDZipCode,'addr_zip',$odir,$flag); 
		 	
		?></b></td>
		
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>
</tr>
<?php
	while($zeile=$ergebnis->FetchRow()){
						
						echo '
							<tr bgcolor=';
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '<td><font face=arial size=2>';
                       // echo '&nbsp;'.($zeile['nr']+$GLOBAL_CONFIG['personell_nr_adder']);
                         echo '&nbsp;'.$zeile['nr'];
                       echo '</td>';

						echo '<td><a href="javascript:popPic(\''.$zeile['name_last'].', '.$bed['name_first'].' '.formatDate2Local($zeile['date_birth'],$date_format).'\',\''.$zeile['photo_filename'].'\')">';
						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}
						
                        echo '</a></td>
						';	
					   
					   echo '
								<td><font face=arial size=2>';
						echo '&nbsp;'.ucfirst($zeile['name_last']);
                       echo '</td>	
								<td><font face=arial size=2>';
						echo '&nbsp;'.ucfirst($zeile['name_first']);
                       echo '</td>	
								<td><font face=arial size=2>';
						echo '&nbsp;'.formatDate2Local($zeile['date_birth'],$date_format);
                        echo '</td>
					    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$zeile['addr_zip'].'</td>';	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href="personell_register_show.php'.URL_APPEND.'&from=such&personell_nr='.$zeile['nr'].'&target=personell_search">
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$zeile['nr'].'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$zeile['nr']."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo '
						<tr><td colspan=6><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious).'</td>
						<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext).'</td>
						</tr>
						</table>';
					
	}

?>
<p>
<!-- <a href="aufnahme_start.php<?php echo URL_APPEND; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<a href="aufnahme_list.php<?php echo URL_APPEND; ?>"><?php echo $LDAdmWantArchive ?></a>
 --></ul>
&nbsp;
</FONT>
<p>

</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
