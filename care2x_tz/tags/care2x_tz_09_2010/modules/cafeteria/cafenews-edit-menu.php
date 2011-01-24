<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/inc_front_chain_lang.php');
$breakfile='cafenews.php'.URL_APPEND;
$returnfile='cafenews-edit-menu-select-week.php'.URL_APPEND;

require_once($root_path.'include/care_api_classes/class_core.php');
$core=& new Core();

//$db->debug=true;

 $daytag=date("w");
 $day=date("d");
 $month=date("m");
 $year=date("Y");
 //echo $daytag.$day.$month.$year."<p>";

 if(($daytag!=1)||($week!=1))
 {
	$JDday=GregorianToJD($month,$day,$year);
	if($daytag=="0") $JDday-=6;
	else $JDday=$JDday-($daytag-1);

	switch ($week)
	{
		case 2: $JDday+=7; break;
		case 3: $JDday+=14; break;
	}

	$datebuf=JDToGregorian($JDday);//echo $datebuf;
	$arraybuf=explode("/",$datebuf);
	$month=$arraybuf[0];
	$day=$arraybuf[1];
	$year=$arraybuf[2];
	$daytag=date("w",mktime(0,0,0,$month,$day,$year));
 }
 
if(!$mday) 
{
	if($week==1)
	{
	$mday=date(d);
	$mmonth=date(m);
	$myear=date(Y);
	}
	else
	{
	$mday=$day;
	$mmonth=$month;
	$myear=$year;
	}
}


$dbtable="care_cafe_menu";
/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');

if($dblink_ok)
{

  include_once($root_path.'include/inc_date_format_functions.php');
  

	 switch($mode)
	 {
	 	case 'save':
				if($update)
				{
					$sql="UPDATE $dbtable SET menu='$menuplan',
					modify_id='".$_COOKIE[$local_user.$sid]."',
					modify_time='".date('YmdHis')."'  WHERE  item='".$item."'";
				}
				else
				{
		 			$sql="INSERT INTO $dbtable 
						(	
						    lang,
						    cdate,
							menu,
							create_id,
							create_time
							) VALUES 
						(	
						    '$lang',
						    '".formatDate2STD($myear."-".$mmonth."-".$mday,"yyyy-mm-dd")."',
							'$menuplan',
							'".$_COOKIE[$local_user.$sid]."',
							'".date('YmdHis')."'
							)";
				}					
				//echo $sql;
				if($ergebnis=$db->Execute($sql))
       				{
					if(!$update){
						if($db_type=='mysql'){
							$item=$db->Insert_ID();
						}else{
							$item=$core->postgre_Insert_ID($dbtable,'item',$db->Insert_ID());
						}
					}
					    //echo $item;
						header("location: cafenews-edit-menu.php?sid=$sid&lang=$lang&mode=saveok&item=$item&week=$week&mday=$mday&mmonth=$mmonth&myear=$myear"); exit;
					}
					else echo "<p>".$sql."<p>$LDDbNoSave";
				break;
				
		default:
		 	if($item)
			{
			    $sql="SELECT item, menu FROM $dbtable WHERE item='".$item."'" ;
			}
		 	else
			{
                $sql="SELECT item, menu FROM $dbtable WHERE cdate='".formatDate2STD($myear."-".$mmonth."-".$mday,"yyyy-mm-dd")."'" ;
 
	            if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT))
                {
	                $sql.="' AND lang='".$lang."'";
                 }
	         }		

			//echo $sql;
			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
					$content=$ergebnis->FetchRow();
				}
			}
				else echo "<p>".$sql."<p>".$LDDbNoRead; 
		} //end of switch

  } else echo "$LDDbNoLink<br> $sql<br>";


function aligndate(&$ad,&$am,&$ay)
{
	if(!checkdate($am,$ad,$ay))
	{
		if($am==12)
		{
			$am=1;
			$ad=1;
			$ay++;
		}
		else
		{
			$am=$am+1;
    		$ad=1;
		}
	}
}
?>
<?php html_rtl($lang); ?>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 21.12.2001 -->
<head>
<?php echo setCharSet(); ?>
<title></title>
<style type="text/css" name="s2">
.v18{ font-family:verdana,arial; color:#d6d6d6; font-size:18}
.v18_b{ font-family:verdana,arial; color:#000066; font-size:18}
</style>

<?php require($root_path.'include/inc_css_a_hilitebu.php'); ?>

</head>

<body onLoad="document.menuform.menuplan.focus()">

<FONT  SIZE=8 COLOR="#cc6600">
<img <?php echo createComIcon($root_path,'basket.gif','0') ?>><b><?php echo $LDCafeMenu ?></b></FONT>
<form action="cafenews-edit-menu.php" method="post" name="menuform"><hr>
<table border=0 bgcolor="#000000" cellspacing=0 cellpadding=0>
  <tr>
    <td>

<table border=0 cellspacing=1 cellpadding=5>
  <tr>
    <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=4 COLOR="#0000cc">
<?php switch($week)
	{
		case 1: echo $LDThisWeek; break;
		case 2: echo $LDNextWeek; break;
		case 3: echo $LD3rdWeek; break;
	}
?>
</font>
</td>
  </tr>
  <tr bgcolor="#ccffff">
  
<?php for ($i=0,$acttag=$day,$dyidx=$daytag-1;$i<7;$i++,$acttag++,$dyidx++)
	{
	$spot=0;
	aligndate($acttag,$month,$year);

	if ((int)$mday==(int)$acttag) 	$spot=1;
	
	echo '
    <td class="v18_b" ';
	if ($spot)  echo ' bgcolor="yellow">';
		else echo ' bgcolor="#ccffff">';
	echo '<a href="';
	if($spot) echo '#"'; else echo 'cafenews-edit-menu.php'.URL_APPEND.'&week='.$week.'&myear='.$year.'&mmonth='.$month.'&mday='.$acttag.'" ';
	echo ' title="'.formatDate2Local($year.'-'.$month.'-'.$acttag,$date_format).'">';
	if($spot) echo '<font color="#0000cc">';else echo '<font color="#d6d6d6">';
	echo '<b>'.$dayname[$dyidx].'</b>';
	if ($spot) echo '</a>';
	echo '</td>
	';
	}
?>

  </tr>
</table>
</td>
  </tr>
</table>

<?php
if($mode=="saveok") {
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><FONT  SIZE=4  FACE="verdana,Arial" color="#990000"><?php echo $LDMenuSaved ?></font>
<?php
}
?>

<p>
<table border=0 cellspacing=0>
  <tr bgcolor="#ccffff" >
    <td colspan=3><b><?php echo $LDMenu ?>:</b><br><font size=1><?php echo $LDPlsEnter ?>.<br>
	<textarea name="menuplan" cols=35 rows=10 wrap="physical"><?php echo $content['menu'] ?></textarea>
 </td>
  </tr>

 <tr>
    <td ><p><br>
	<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
    <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
  </td>
    <td align=right ><p><br>&nbsp;&nbsp;
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
  </td>
  </tr>
 </table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="week" value="<?php echo $week ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="item" value="<?php echo $content['item'] ?>">
<input type="hidden" name="myear" value="<?php echo $myear ?>">
<input type="hidden" name="mmonth" value="<?php echo $mmonth ?>">
<input type="hidden" name="mday" value="<?php echo $mday ?>">
<input type="hidden" name="update" value="<?php echo $rows ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form></body>
</html>
