<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','doctors.php');
$local_user='ck_doctors_dienstplan_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences

$thisfile="doctors-dienstplan-planen.php";

$abtname=get_meta_tags("../global_conf/$lang/doctors_abt_list.pid");

/************** resolve dept only *********************************/
require('../include/inc_resolve_dept_dept.php');

if ($pmonth=="") $pmonth=date('n');
if ($pyear=="") $pyear=date('Y');

$dbtable='care_doctors_dutyplan';

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
		if($mode=='save')
		{
				// check if entry is already existing
				$sql="SELECT tid,encoding FROM $dbtable 
						WHERE dept='$dept'
							AND year='$pyear'
							AND month='$pmonth'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//echo $sql." checked <br>";
					//$bbuf="";
					//$tbuf="";
					if($a0!="") $adbuf=$ha0."&s=".$a0; else $adbuf="?";
					if($r0!="") $rdbuf=$hr0."&s=".$r0; else $rdbuf="?";
					for($i=1;$i<$maxelement;$i++)
					{
						$tdx="ha".$i;$ddx="hr".$i;$ax="a".$i;$rx="r".$i;
						if($$ax!="") $adbuf=$adbuf." ~".$$tdx."&s=".$$ax;
						 else $adbuf=$adbuf." ~?";
						if($$rx!="") $rdbuf=$rdbuf." ~".$$ddx."&s=".$$rx;
						 else $rdbuf=$rdbuf." ~?";
					}
					//$dbuf=strtr($dbuf," ","+");
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
						{
							// $dbuf=htmlspecialchars($dbuf);
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							$content[encoding].=" ~e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element;
							
							$sql="UPDATE $dbtable SET 
										a_dutyplan='$adbuf',
										r_dutyplan='$rdbuf',
										tid='$content[tid]',
										encoding='$content[encoding]'	
										WHERE dept='$dept'
											AND year='$pyear'
											AND month='$pmonth'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//echo $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pyear=$pyear&pmonth=$pmonth&retpath=$retpath");
								}
								else echo "<p>".$sql."<p>$LDDbNoSave"; 
						} // else create new entry
						else
						{
							//$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata"," <>","+()")."\r\n";
							$sql="INSERT INTO $dbtable 
										(
										dept,
										year,
										month,
										a_dutyplan,
										r_dutyplan,
										encoding
										)
									 	VALUES
										(
										'$dept',
										'$pyear',
										'$pmonth',
										'$adbuf',
										'$rdbuf',
										'e=".$doctors_dienstplan_user."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element."'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//echo $sql." new insert <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pyear=$pyear&pmonth=$pmonth&retpath=$retpath");
								}
								else echo "<p>".$sql."<p>$LDDbNoSave"; 
						}//end of else
					} // end of if ergebnis
		 }// end of if(mode==save)
		 else
		 {
		 	$sql="SELECT a_dutyplan,r_dutyplan FROM $dbtable 
							WHERE dept='$dept'
								AND year='$pyear'
								AND month='$pmonth'";
			
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					//echo $sql."<br>";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
	 	}
}
  else { echo "$LDDbNoLink<br>"; } 

  
  /*
function getmaxdays($mon,$yr)
{
	if ($mon==2){ if (checkdate($mon,29,$yr)) return 29; else return 28;}
	else
	{
		if(checkdate($mon,31,$yr)) return 31; else return 30;
	}
}
*/

$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

$firstday=date("w",mktime(0,0,0,$pmonth,1,$pyear));

function makefwdpath($path,$dpt,$mo,$yr,$saved)
{
	if ($path==1)
	{	
		$fwdpath='doctors-dienstplan.php?';
		if($saved!="1") 
		{  
			if ($mo==1) {$mo=12; $yr--;}
				else $mo--;
		}
		return $fwdpath.'dept='.$dpt.'&pmonth='.$mo.'&pyear='.$yr;
	}
	else return "doctors-dienstplan-checkpoint.php";
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
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
	urlholder="doctors-dienstplan-poppersonselect.php?elemid="+elem + "&dept=<?php echo $dept ?>&month="+tmonth+"&year="+tyear+ "&mode=" + mode + "&retpath=<?php echo $retpath ?>&user=<?php echo $ck_doctors_dienstplan_user."&lang=$lang&sid=$sid"; ?>";
	
	popselectwin=window.open(urlholder,"pop","width=" + ww + ",height=" + wh + ",menubar=no,resizable=yes,scrollbars=yes,dependent=yes");
	window.popselectwin.moveTo((w/2)+80,(h/2)-(wh/2));
}

function killchild()
{
 if (window.popselectwin) if(!window.popselectwin.closed) window.popselectwin.close();
}

function cal_update()
{
	var filename="doctors-dienstplan-planen.php?<?php echo "sid=$sid&lang=$lang" ?>&retpath=<?php echo $retpath ?>&dept=<?php echo $dept; ?>&pmonth="+document.dienstplan.month.value+"&pyear="+document.dienstplan.jahr.value;
	window.location.replace(filename);
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onUnload="killchild()">

<form name="dienstplan" action="doctors-dienstplan-planen.php" method="post">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="dept" value="<?php echo $dept; ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth; ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear; ?>">
<input type="hidden" name="planid" value="<?php echo $ck_plan; ?>">
<input type="hidden" name="maxelement" value="<?php echo $maxdays; ?>">
<input type="hidden" name="encoder" value="<?php echo $ck_doctors_dienstplan_user; ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDMakeDutyPlan ?> <font color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $abtname[$dept]; ?></font></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();killchild();"><img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>></a><a href="javascript:gethelp('docs_dutyplan_edit.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0','absmiddle') ?>></a><a href="doctors-dienst-schnellsicht.php?sid=<?php echo $sid ?>" onClick=killchild()><img <?php echo createLDImgSrc('../','close2.gif','0','absmiddle') ?>></a></td></tr>

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
<tr><td colspan="2"></td><td><div class=a3><font face=arial size=2 color=white><b><?php echo $LDDoc1 ?></b></div>
</td><td></td><td><div class=a3><font face=arial size=2 color=white><b><?php echo $LDDoc2 ?></b></div></td>
<td></td></tr>
<?php
$aduty=explode("~",$result[a_dutyplan]);
$rduty=explode("~",$result[r_dutyplan]);

for ($i=1,$n=0,$wd=$firstday;$i<=$maxdays;$i++,$n++,$wd++)
{
	switch ($wd){
		case 6: $backcolor="bgcolor=#ffffcc";break;
		case 0: $backcolor="bgcolor=#ffff00";break;
		default: $backcolor="bgcolor=white";
		}
	
	parse_str(trim($aduty[$n]),$aelems);
	parse_str(trim($rduty[$n]),$relems);
	echo '
	<tr >
	<td  height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>'.$i.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if (!$wd) echo '<font color=red>';
	echo $LDShortDay[$wd].'</div>
	</td>
	<td height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>';
	if ($aelems[s]=="") echo '<img '.createComIcon('../','warn.gif','0').'>'; else echo '<img '.createComIcon('../','mans-gr.gif','0').'>';
	echo '&nbsp;
	<input type="hidden" name="ha'.$n.'" value="l='.$aelems[l].'&f='.$aelems[f].'&b='.$aelems[b].'">
	<input type="text" name="a'.$n.'" size="15" onFocus=this.select() value="'.$aelems[s].'"> </div>
	</td>
	<td height=5 width=60 '.$backcolor.'>&nbsp;<a href="javascript:popselect(\''.$n.'\',\'a\')">
	<button onclick="javascript:popselect(\''.$n.'\',\'a\')"><img '.createComIcon('../','patdata.gif','0').' alt="'.$LDClk2Plan.'"></button></a>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if ($relems[s]=="") echo '<img '.createComIcon('../','warn.gif','0').'>'; else echo '<img '.createComIcon('../','mans-red.gif','0').'>';
	echo '&nbsp;
	<input type="hidden" name="hr'.$n.'" value="l='.$relems[l].'&f='.$relems[f].'&b='.$relems[b].'">
	<input type="text" size="15" name="r'.$n.'" onFocus=this.select() value="'.$relems[s].'"></div>
	</td>
	<td height=5 width=60 '.$backcolor.'>&nbsp;<a href="javascript:popselect(\''.$n.'\',\'r\')">
	<button onclick="javascript:popselect(\''.$n.'\',\'r\')"><img '.createComIcon('../','patdata.gif','0').' alt="'.$LDClk2Plan.'"></button></a>
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="doctors-dienstplan.php?<?php echo "sid=$sid&lang=$lang&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; ?>" onUnload=killchild()><img <?php if($saved) echo createLDImgSrc('../','close2.gif','0'); else echo createLDImgSrc('../','cancel.gif','0'); ?>></a>

</td>
</tr>
</table>

<p>
<input type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="doctors-dienstplan.php?<?php echo "sid=$sid&lang=$lang&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; ?>" onUnload=killchild()><img <?php if($saved) echo createLDImgSrc('../','close2.gif','0'); else echo createLDImgSrc('../','cancel.gif','0'); ?>></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;

</form>

</FONT>

</BODY>
</HTML>
