<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='actions.php';
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$searchkey=trim($searchkey);
$searchkey=strtr($searchkey,"*?","%_");
$toggle=0;
$append=URL_APPEND."&target=$target&noresize=1&user_origin=$user_origin";

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDKeywordPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

$breakfile=$root_path."main/spediens.php$append";
$thisfile=basename(__FILE__);

if(($mode=='search')&&!empty($searchkey)){

	include_once($root_path.'include/inc_date_format_functions.php');
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	$encounter=&$enc_obj->searchEncounterBasicInfo($searchkey,'LASTNAME','ASC');
	$linecount=$enc_obj->record_count;
	if($linecount==1){
		$zeile=$encounter->FetchRow();
		header('location:fotolab-dir-select.php'.URL_REDIRECT_APPEND.'&patnum='.$zeile['encounter_nr'].'&lastname='.strtr($zeile['name_last'],' ','+').'&firstname='.strtr($zeile['name_first'],' ','+').'&bday='.$zeile['date_birth'].'&maxpic='.$aux1);
		exit;
	}

}else{ 
  $mode='';
}

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
<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDFotoLab ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
echo $breakfile; ?>" target='_parent'><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>

<FONT    SIZE=3  FACE="Arial" color="#990000"><?php echo $LDTestRequestFor.$LDTestType[$target] ?></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr bgcolor="<?php echo $entry_block_bgcolor ?>" >
<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchmask_bgcolor="#f3f3f3";
            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>


<p>
<a href="<?php	echo $breakfile; ?>" target='_parent'><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>
</ul>
<?php
if($mode=='search'){
	if(!$linecount) $linecount=0;
	echo str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
		  
	if ($linecount) { 

	/* Load the common icons */
	$img_options=createComIcon($root_path,'l-arrowgrnlrg.gif','0');
	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDPatientNr; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b>&nbsp;</td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDLastName; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDFirstName; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDBday; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDSelect; ?></b></td>

<?php
/*				for($i=0;$i<sizeof($fieldname);$i++) {
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}*/					
					echo"</tr>";

					while($zeile=$encounter->FetchRow())
					{
						echo '
							<tr bgcolor=';
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '<td><font face=arial size=2>&nbsp;'.$zeile['encounter_nr'];
                        echo '</td>
						';	
						echo '<td>';
						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}
						
                        echo '</td>
						';	
						
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href="fotolab-dir-select.php'.URL_APPEND.'&patnum='.$zeile['encounter_nr'].'&lastname='.strtr($zeile['name_last'],' ','+').'&firstname='.strtr($zeile['name_first'],' ','+').'&bday='.$zeile['date_birth'].'&maxpic='.$aux1.'">
							<img '.$img_options.' alt="'.$LDSelect.'"></a>&nbsp;';
							
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
					    /* Set the appending nr for the searchform */
					    $searchform_count=2;
					?>
		<ul>
		<p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     	<tr>
      	 <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
			</td>
     	</tr>
   		</table>
		<p>
		<a href="<?php	echo $breakfile; ?>" target='_parent'><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
		</ul>
					<?php
					}
	}
}
?>
&nbsp;
</FONT>
<p>
</td>
</tr>
</table>  

<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
