<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='or.php';
$lang_tables[]='departments.php';
define('LANG_FILE','doctors.php');
$local_user='ck_op_dienstplan_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

if(!isset($dept_nr)||!$dept_nr){
	header('Location:nursing-or-select-dept.php'.URL_REDIRECT_APPEND.'&retpath='.$retpath);
	exit;
}

$thisfile=basename(__FILE__);
$breakfile="nursing-or-dienstplan.php".URL_APPEND."&dept_nr=$dept_nr&pmonth=$pmonth&pyear=$pyear&retpath=$retpath";
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);

require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$pers_obj->useDutyplanTable();

/************** resolve dept only *********************************/
require($root_path.'include/inc_resolve_dept_dept.php');

if ($pmonth=='') $pmonth=date('n');
if ($pyear=='') $pyear=date('Y');

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
	{	
		if($mode=='save')
		{
					//echo "helo";
					$arr_1_txt=array();
					$arr_2_txt=array();
					$arr_1_pnr=array();
					$arr_2_pnr=array();

					for($i=0;$i<$maxelement;$i++)
					{
						$tdx="ha".$i;
						$ddx="hr".$i;
						$ax="a".$i;
						$rx="r".$i;
						
						if(!empty($$ax)) $arr_1_txt[$ax]=$$ax;
						if(!empty($$rx)) $arr_2_txt[$rx]=$$rx;
						if(!empty($$tdx)) $arr_1_pnr[$tdx]=$$tdx;
						if(!empty($$ddx)) $arr_2_pnr[$ddx]=$$ddx;
						
					}
					
					$ref_buffer=array();
					// Serialize the data
					$ref_buffer['duty_1_txt']=serialize($arr_1_txt);
					$ref_buffer['duty_2_txt']=serialize($arr_2_txt);
					$ref_buffer['duty_1_pnr']=serialize($arr_1_pnr);
					$ref_buffer['duty_2_pnr']=serialize($arr_2_pnr);
					
					$ref_buffer['dept_nr']=$dept_nr;
					$ref_buffer['role_nr']=14; // 14 = oncall nurse (role person)
					$ref_buffer['year']=$pyear;
					$ref_buffer['month']=$pmonth;
					$ref_buffer['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
					
					if($dpoc_nr=$pers_obj->NOCDutyplanExists($dept_nr,$pyear,$pmonth)){
						//echo $dpoc_nr;
						$ref_buffer['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
						// Point to the internal data array
						$pers_obj->setDataArray($ref_buffer);
															
						if($pers_obj->updateDataFromInternalArray($dpoc_nr)){
							# Remove the cache plan
							if(date('Yn')=="$pyear$pmonth"){
								$pers_obj->deleteDBCache('NOCS_'.date('Y-m-d'));
							}
							header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept_nr=$dept_nr&pyear=$pyear&pmonth=$pmonth&retpath=$retpath");
						}else echo "<p>".$pers_obj->sql."<p>$LDDbNoSave"; 
					} // else create new entry
					else
					{
						$ref_buffer['history']="Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n";
						$ref_buffer['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
						$ref_buffer['create_time']='NULL';
						// Point to the internal data array
						$pers_obj->setDataArray($ref_buffer);
						if($pers_obj->insertDataFromInternalArray()){
								//echo $sql." new insert <br>";
								# Remove the cache plan
								if(date('Yn')=="$pyear$pmonth"){
									$pers_obj->deleteDBCache('NOCS_'.date('Y-m-d'));
								}
									
								header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept_nr=$dept_nr&pyear=$pyear&pmonth=$pmonth&retpath=$retpath");
						}else{
							echo "<p>".$pers_obj->sql."<p>$LDDbNoSave"; 
						}
					}//end of else
		 }// end of if(mode==save)
		 else
		 {
		 	$dutyplan=&$pers_obj->getNOCDutyplan($dept_nr,$pyear,$pmonth);
	 	}
}
  else { echo "$LDDbNoLink<br>"; } 


$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

$firstday=date("w",mktime(0,0,0,$pmonth,1,$pyear));

function makefwdpath($path,$dpt,$mo,$yr,$saved)
{
	if ($path==1)
	{	
		$fwdpath='nursing-or-dienstplan.php?';
		if($saved!="1") 
		{  
			if ($mo==1) {$mo=12; $yr--;}
				else $mo--;
		}
		return $fwdpath.'dept='.$dpt.'&pmonth='.$mo.'&pyear='.$yr;
	}
	else return "nursing-or-dienstplan-checkpoint.php";
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}

div.a3 {font-family: arial; font-size: 14; margin-left: 3; margin-right:3; }

.infolayer {
	position:static;
	visibility: hide;
	left: 10;
	top: 10;

}

</style>

<script language="javascript">

  var urlholder;
  var infowinflag=0;

function popselect(elem,mode)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=300;
	wh=500;
	var tmonth=document.dienstplan.month.value;
	var tyear=document.dienstplan.jahr.value;
	urlholder="nursing-or-dienstplan-poppersonselect.php?elemid="+elem + "&dept_nr=<?php echo $dept_nr ?>&month="+tmonth+"&year="+tyear+ "&mode=" + mode + "&retpath=<?php echo $retpath ?>&user=<?php echo $ck_op_dienstplan_user."&lang=$lang&sid=$sid"; ?>";
	
	popselectwin=window.open(urlholder,"pop","width=" + ww + ",height=" + wh + ",menubar=no,resizable=yes,scrollbars=yes,dependent=yes");
	window.popselectwin.moveTo((w/2)+80,(h/2)-(wh/2));
}

function killchild()
{
 if (window.popselectwin) if(!window.popselectwin.closed) window.popselectwin.close();
}

function cal_update()
{
	var filename="nursing-or-dienstplan-planen.php?<?php echo "sid=$sid&lang=$lang" ?>&retpath=<?php echo $retpath ?>&dept_nr=<?php echo $dept_nr; ?>&pmonth="+document.dienstplan.month.value+"&pyear="+document.dienstplan.jahr.value;
	window.location.replace(filename);
}
</script>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onUnload="killchild()">

<form name="dienstplan" action="nursing-or-dienstplan-planen.php" method="post">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="dept" value="<?php echo $dept_obj->ID(); ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth; ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear; ?>">
<input type="hidden" name="planid" value="<?php echo $ck_plan; ?>">
<input type="hidden" name="maxelement" value="<?php echo $maxdays; ?>">
<input type="hidden" name="encoder" value="<?php echo $ck_op_dienstplan_user; ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDMakeDutyPlan ?> :: <font color="<?php echo $cfg['top_txtcolor']; ?>">
<?php 
$LDvar=$dept_obj->LDvar();
if(isset($$LDvar)&&$$LDvar) echo $$LDvar;
else echo $dept_obj->FormalName();
?>
</font></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();killchild();"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?>></a><a href="javascript:gethelp('op_duty.php','plan','<?php echo $rows ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>></a><a href="<?php echo $breakfile ?>" onClick=killchild()><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?>></a></td></tr>

<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" valign=top colspan=2><p><br>
<ul>
<font size=5>

<?php echo $LDMonth ?>: <select name="month" size="1" onChange="cal_update()">
<?php
for ($i=1;$i<13;$i++)
	{
	 echo '<option  value="'.$i.'" ';
	 if (($pmonth)==$i) echo 'selected';
	 echo '>'.$monat[$i].'</option>';
  	 echo "\n";
	}
?>
</select>

&nbsp;<?php echo $LDYear ?>: <select name="jahr" size="1" onChange="cal_update()">
<?php
for ($i=2000;$i<2016;$i++)
	{
	 echo '<option  value="'.$i.'" ';
	 if ($pyear==$i) echo 'selected';
	 echo '>'.$i.'</option>';
  	 echo "\n";
	}

?>
</select>
</font>

<FONT    SIZE=-1  FACE="Arial">

<table>
<tr><td>


<table border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="#6f6f6f">

<table border=0 cellpadding=0 cellspacing=1>
<tr><td colspan="2"></td><td><div class=a3><font face=arial size=2 color=white><b><?php echo $LDStandbyPerson ?></b></div>
</td><td></td><td><div class=a3><font face=arial size=2 color=white><b><?php echo $LDOnCall ?></b></div></td>
<td></td></tr>
<?php
for ($i=1,$n=0,$wd=$firstday;$i<=$maxdays;$i++,$n++,$wd++)
{
	switch ($wd){
		case 6: $backcolor="bgcolor=#ffffcc";break;
		case 0: $backcolor="bgcolor=#ffff00";break;
		default: $backcolor="bgcolor=white";
		}
	
	$aelems=unserialize($dutyplan['duty_1_txt']);
	$relems=unserialize($dutyplan['duty_2_txt']);
	$a_pnr=unserialize($dutyplan['duty_1_pnr']);
	$r_pnr=unserialize($dutyplan['duty_2_pnr']);

	echo '
	<tr >
	<td  height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>'.$i.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if (!$wd) echo '<font color=red>';
	echo $LDShortDay[$wd].'</div>
	</td>
	<td height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>';
	if ($aelems['a'.$n]=="") echo '<img '.createComIcon($root_path,'warn.gif','0').'>'; else echo '<img '.createComIcon($root_path,'mans-gr.gif','0').'>';
	echo '&nbsp;
	<input type="hidden" name="ha'.$n.'" value="'.$a_pnr['ha'.$n].'">
	<input type="text" name="a'.$n.'" size="15" onFocus=this.select() value="'.$aelems['a'.$n].'"> </div>
	</td>
	<td height=5 width=60 '.$backcolor.'>&nbsp;<a href="javascript:popselect(\''.$n.'\',\'a\')">
	<button onclick="javascript:popselect(\''.$n.'\',\'a\')"><img '.createComIcon($root_path,'patdata.gif','0').' alt="'.$LDClk2Plan.'"></button></a>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if ($relems['r'.$n]=="") echo '<img '.createComIcon($root_path,'warn.gif','0').'>'; else echo '<img '.createComIcon($root_path,'mans-red.gif','0').'>';
	echo '&nbsp;
	<input type="hidden" name="hr'.$n.'" value="'.$r_pnr['hr'.$n].'">
	<input type="text" size="15" name="r'.$n.'" onFocus=this.select() value="'.$relems['r'.$n].'"></div>
	</td>
	<td height=5 width=60 '.$backcolor.'>&nbsp;<a href="javascript:popselect(\''.$n.'\',\'r\')">
	<button onclick="javascript:popselect(\''.$n.'\',\'r\')"><img '.createComIcon($root_path,'patdata.gif','0').' alt="'.$LDClk2Plan.'"></button></a>
	</td>
	</tr>';
	if($wd==6) $wd=-1;
	}
?>

</table>

</td>
</tr>
</table>
	
</td>
<td valign="top" align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>><p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $breakfile; ?>" onUnload=killchild()><img <?php if($saved) echo createLDImgSrc($root_path,'close2.gif','0'); else echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>

</td>
</tr>
</table>

<p>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile; ?>" onUnload=killchild()><img <?php if($saved) echo createLDImgSrc($root_path,'close2.gif','0'); else echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;

</form>

</FONT>

</BODY>
</HTML>
