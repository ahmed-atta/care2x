<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

$lang_tables[]='search.php';
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='nursing.php'.URL_APPEND;

/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG;
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');

if($mode=='such'||$mode=='paginate')
{
	$tb_person='care_person';
	$tb_encounter='care_encounter';
	$tb_location='care_encounter_location';
	$tb_ward='care_ward';

	# Initialize page's control variables
	if($mode=='paginate'){
		$searchkey=$HTTP_SESSION_VARS['sess_searchkey'];
	}else{
		# Reset paginator variables
		$pgx=0;
		$totalcount=0;
		$HTTP_SESSION_VARS['sess_searchkey']=$searchkey;
		$oitem='';
		$odir='';
	}
	
	# convert * and ? to % and &
	$searchkey=strtr($searchkey,'*?','%_');

	#Load and create paginator object
	include_once($root_path.'include/care_api_classes/class_paginator.php');
	$pagen=new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);
	
	$GLOBAL_CONFIG=array();
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

	# Get the max nr of rows from global config
	$glob_obj->getConfig('pagin_patient_search_max_block_rows');
	if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
		else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);
	
	# Work around
	//$searchkey=$searchkey;
	$srcword=trim($searchkey);
	//prepare the seach word detect several types
	if(is_numeric($srcword)){
		$usenum=true;
		
		if($srcword>$GLOBAL_CONFIG['patient_inpatient_nr_adder']){
			$cond.="e.encounter_nr LIKE '%".(int)substr($srcword,2)."'"; // set the offset here
		}else{
			$cond.="e.encounter_nr LIKE '%".(int)$srcword."'";
		}
	}else{
		$usenum=false;
		$buf=strtr($srcword,","," ");//echo $buf;
		$wx=explode(' ',$buf); // explode to array
		$cond='';
		for($i=0;$i<sizeof($wx);$i++){
			if(!empty($cond)){
				$cond.=' OR ';
			}
			$cond.="p.name_last LIKE '".$wx[$i]."%' OR p.name_first LIKE '".$wx[$i]."%' OR p.date_birth LIKE '".$wx[$i]."%'";
		}
		$cond="($cond)";
		
	}
	
	$cond.=" AND l.encounter_nr=e.encounter_nr";
	
	if(!$arch) $cond.=' AND NOT e.is_discharged';
	
	if($usenum) $cond.=' GROUP BY r.location_nr';
		else $cond.=' AND p.pid=e.pid GROUP BY r.location_nr';
	
	if(!isset($db)||!$db)include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok){			
		$sqlselect="SELECT p.name_last, p.name_first,p.date_birth,
					e.encounter_nr, e.encounter_class_nr,e.in_ward,
					w.name AS ward_name,w.roomprefix,
					l.location_nr AS  ward_nr,l.date_from AS ward_date,
					r.location_nr AS room_nr ";
					
		if($usenum){
			$sqlfrom=" FROM $tb_encounter as e LEFT JOIN $tb_person AS p ON p.pid=e.pid";
		}else{
			$sqlfrom=" FROM $tb_person as p LEFT JOIN $tb_encounter AS e ON p.pid=e.pid";
		}
		$sqlfrom.=" LEFT JOIN $tb_location AS l ON l.encounter_nr=e.encounter_nr AND l.type_nr=2
					LEFT JOIN $tb_location AS r ON r.encounter_nr=l.encounter_nr AND r.type_nr=4 AND r.group_nr=l.location_nr 
					LEFT JOIN $tb_ward AS w ON w.nr=l.location_nr
					WHERE $cond";
		
		if(!empty($oitem)){

			#Filter the sort item
			switch($oitem){
				case 'ward_nr':
				{
					$itembuf='location_nr';
					$prep='l';
					break;
				}
				case 'ward_date':
				{
					$itembuf='date_from';
					$prep='l';
					break;
				}
				case 'room_nr':
				{
					$itembuf='location_nr';
					$prep='r';
					break;
				}
				case 'encounter_nr':
				{
					$itembuf='encounter_nr';
					$prep='e';
					break;
				}
				default:
					$itembuf=$oitem;
					$prep='p';
			}
			 $sql=$sqlselect.$sqlfrom." ORDER BY $prep.$itembuf $odir";
		}else{
			$sql=$sqlselect.$sqlfrom;
		}
		//echo $sql."<p>mode==such";

		if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pagen->BlockStartIndex())){
			$rows=$ergebnis->RecordCount();
/*			if($rows==1){
				$result=$ergebnis->FetchRow();
				header("location:nursing-station.php?sid=$sid&lang=$lang&ward_nr=".$result['ward_nr']."&station=".$result['ward_name']);
				exit;
			}
*/
					$pagen->setTotalBlockCount($rows);
					
					# If more than one count all available
					if(isset($totalcount)&&$totalcount){
						$pagen->setTotalDataCount($totalcount);
					}else{
						# Count total available data
						$sql='SELECT e.encounter_nr '.$sqlfrom;
						//echo  $sql;
						$totalcount=0;
						if($result=$db->Execute($sql)){
							$totalcount=$result->RecordCount();
						}
						$pagen->setTotalDataCount($totalcount);
					}
					# Set the sort parameters
					$pagen->setSortItem($oitem);
					$pagen->setSortDirection($odir);

		}else{echo "$sql<br>$LDDbNoRead";} 
	}else { echo "$LDDbNoLink<br>"; } 
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
var urlholder;

  function gotoWard(ward_nr,st,y,m,d){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width; h=window.parent.screen.height;';
	}
	else echo 'w=800;
					h=600;';
?>
	winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);
	
	urlholder="nursing-station-pass.php?rt=pflege&sid=<?php echo "$sid&lang=$lang"; ?>&pday="+d+"&pmonth="+m+"&pyear="+y+"&edit=1&retpath=search_patient&ward_nr="+ward_nr+"&station="+st;
	window.location.href=urlholder;
}

// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();document.suchlogbuch.searchkey.select();"
<?php 
 echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
  ?>>
 
 

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing - $LDSearchPatient" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_how2search.php','<?php echo $mode ?>','<?php echo $rows ?>','search')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=3  bgcolor="<?php echo $cfg['body_bgcolor']; ?>"><p><br>

<ul>
<FONT    SIZE=-1  FACE="Arial">
<?php if($rows){ ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo "$LDSearchKeyword <font color=#0000ff>\"$searchkey\"</font> ".str_replace("~rows~",$totalcount,$LDWasFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.'; ?> <br>
<?php echo $LDPlsClk ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr>

<?php
$bgimg='tableHeaderbg3.gif';
//$bgimg='tableHeader_gr.gif';
$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

$append="&usenum=$usenum&arch=$arch";

if($usenum){



?>
     <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDAdm_Nr,'encounter_nr',$oitem,$odir,$append); 
			 ?></b></td>
<?php
}
?>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append); 
			 ?></b></td>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append); 
			 ?></b></td>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDBirthDate,'date_birth',$oitem,$odir,$append); 
			 ?></b></td>

<?php
if(!$usenum){
?>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDAdm_Nr,'encounter_nr',$oitem,$odir,$append); 
			 ?></b></td>
<?php
}
?>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDStation,'ward_nr',$oitem,$odir,$append); 
			 ?></b></td>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDRoom,'room_nr',$oitem,$odir,$append); 
			 ?></b></td>
			 <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDDate,'ward_date',$oitem,$odir,$append); 
			 ?></b></td>

     <td bgcolor=#000066><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; <?php echo $LDStatus ?></b></td>
 </tr>
 <?php 
 $toggle=0;
 while($result=$ergebnis->FetchRow())
 {
/*	if($result['encounter_class_nr']==2) $full_enr=$result['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder'];
		else  $full_enr=$result['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder'];
*/		
	$full_enr=$result['encounter_nr'];
 	echo'
  <tr ';
  	if($toggle){ 
  		echo "bgcolor=#efefef";
		$toggle=0;
	}else{
		echo "bgcolor=#ffffff"; 
		$toggle=1;
	}
	
	if($result['in_ward']) $result['ward_date']=date('Y-m-d');
	
	list($pyear,$pmonth,$pday)=explode('-',$result['ward_date']);
  
	//$buf="nursing-station.php".URL_APPEND."&station=".$result['ward_name']."&ward_nr=".$result['ward_nr'];
	//$buf="nursing-station.php".URL_APPEND."&ward_nr=".$result['ward_nr']."&pyear=$pyear&pmonth=$pmonth&pday=$pday";
	$buf="javascript:gotoWard('".$result['ward_nr']."','".addslashes($result['ward_name'])."','$pyear','$pmonth','$pday')";
  
  echo '>';
/*  echo '
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">';
	if($result['s_date'] <> (date('Y-m-d'))) echo '<img '.createComIcon($root_path,'bul_arrowblusm.gif','0').'>';
		else echo '<img '.createComIcon($root_path,'r_arrowgrnsm.gif','0').'>';
	echo'
	</a></td>';
*/	if($usenum){
	echo '
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$full_enr.'</a>&nbsp;</td>';
	}
	echo '
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_last'].'</a>&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_first'].'</a>&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp;'.formatDate2Local($result['date_birth'],$date_format).'</td>';
	if(!$usenum){
	echo '
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$full_enr.'&nbsp;</td>';
	}
	
	echo '
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['ward_name'].'</a>&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;';
	if($result['room_nr']) echo $result['roomprefix'].' '.$result['room_nr'];
	echo '&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; '.formatDate2Local($result['ward_date'],$date_format).'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; ';
	if($result['in_ward']) echo $LDInWard;
	echo '</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img '.createComIcon($root_path,'pixel.gif','0','absmiddle').'></td>
  </tr>';
  }
	
	echo '
		<tr><td colspan=7><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
		<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
		</tr>';
 ?>
</table>
<p>
<hr>
<?php 
}else{
	if($mode=='such') echo str_replace('~nr~','0',$LDSearchFound); 
}
?>

	<?php echo $LDSearchPrompt ?>
	
<form action="nursing-patient-such-start.php" method="get" name="suchlogbuch" >
<table border=0 cellspacing=0 cellpadding=1 bgcolor="#999999">
  <tr>
    <td>
		<table border=0 cellspacing=0 cellpadding=5 bgcolor="#eeeeee">
    <tr>
      <td>	<font color=maroon size=2><b><?php echo $LDSrcKeyword ?>:</b></font><br>
          		<input type="text" name="searchkey" size=40 maxlength=100 value="<?php if ($srcword!='') echo $srcword; ?>">
				<input type="hidden" name="sid" value="<?php echo $sid; ?>">
  				<input type="hidden" name="lang" value="<?php echo $lang; ?>">
  			<input type="hidden" name="mode" value="such"><br>
				<font size=2><input type="checkbox" name="arch" value="1" <?php if($arch) echo "checked"; ?>> <?php echo $LDSearchArchive ?></font><br>
    			 
    
           	</td>
	   </tr>
    <tr>
      <td align=right>	
				<input type="submit" value="<?php echo $LDSearch ?>" align="right">
              	</td>
	   </tr>
  </table>

	</td>
  </tr>
</table>
  	</form>

</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<b><?php echo $LDMoreFunctions ?>:</b><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="nursing-station-archiv.php?sid=<?php echo "$sid&lang=$lang";?>&user=<?php echo str_replace(" ","+",$user);?>"><?php echo $LDArchive ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="javascript:gethelp('nursing_how2search.php','<?php echo $mode ?>','<?php echo $rows ?>','search')"><?php echo $LDHow2Search ?></a><br>

<p>
<a href="nursing.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>"></a>
</ul>
<p>
<hr>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>


</BODY>
</HTML>
