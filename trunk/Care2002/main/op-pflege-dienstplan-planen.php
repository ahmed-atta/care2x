<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$$ck_sid_buffer)||!$ck_op_dienstplan_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
*/
define("LANG_FILE","or.php");
$local_user="ck_op_dienstplan_user";
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php"); // load color preferences

$thisfile="op-pflege-dienstplan-planen.php";

$vardate="&pmonth=$pmonth&pyear=$pyear";


if($retpath=="calendar_opt") 
	{
	$fixdate= "&cday=$cday&cmonth=$cmonth&cyear=$cyear";
	$updatetarget="$thisfile?sid=$sid&lang=$lang&retpath=$retpath&dept=$dept$fixdate";
	$savedtarget="$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept$vardate$fixdate&retpath=$retpath";
	if($saved) $rettarget="op-pflege-dienstplan.php?sid=$sid&lang=$lang&dept=$dept$vardate$fixdate&retpath=calendar_main";
		else $rettarget="calendar.php?sid=$sid&lang=$lang&dept=$dept";
	}
	else 
	{
		$updatetarget="$thisfile?sid=$sid&lang=$lang&retpath=$retpath&dept=$dept";
		$savedtarget="$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept$vardate&retpath=$retpath";
		if($saved) 	$rettarget="op-pflege-dienstplan.php?sid=$sid&lang=$lang&dept=$dept$vardate&retpath=$retpath";
			else $rettarget="op-doku.php?sid=$sid&lang=$lang";
	}
	
$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");
/********************************* Resolve the department and op room ***********************/
$saal="exclude";
require("../include/inc_resolve_opr_dept.php");

if ($pmonth=="") $pmonth=date('n');
if ($pyear=="") $pyear=date(Y);


if(strlen($pmonth)<2) $tm="0".$pmonth; else $tm=$pmonth;
if(($pyear.$tm)<(date("Ym")))
 {
 	if($retpath=="calendar_opt") header("location:calendar.php?sid=$sid&lang=$lang&dept=$dept$vardate&retpath=$retpath");
	 else header("location:op-pflege-dienstplan.php?sid=$sid&lang=$lang&dept=$dept$vardate&retpath=$retpath");
}

$dbtable="nursing_dutyplan";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
{	
		if($mode=="save")
		{
				// check if entry is already existing
				$sql="SELECT tid,encoding FROM $dbtable 
						WHERE dept='$dept'
							AND year='$pyear'
							AND month='$pmonth'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
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
									//print $sql." new update <br>";
									mysql_close($link);
									header("location:$savedtarget");
								}
								else print "<p>".$sql."<p>$LDDbNoRead"; 
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
										'e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element."'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new insert <br>";
									mysql_close($link);
									header("location:$savedtarget");
								}
								else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
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
					//print $sql."<br>";
				}
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
	 	}
}
  else { print "$LDDbNoLink<br>"; } 

  
  
function getmaxdays($mon,$yr)
{
	if ($mon==2){ if (checkdate($mon,29,$yr)) return 29; else return 28;}
	else
	{
		if(checkdate($mon,31,$yr)) return 31; else return 30;
	}
}

$maxdays=getmaxdays($pmonth,$pyear);


function weekday($daynum,$mon,$yr){
		$jd=gregoriantojd($mon,$daynum,$yr);
		switch(JDDayOfWeek($jd,0))
			{
				case 0: return "So";
				case 1: return "Mo";
				case 2: return "Di";
				case 3: return "Mi";
				case 4: return "Do";
				case 5: return "Fr";
				case 6: return "Sa";
			}
	}

function makefwdpath($path,$dpt,$mo,$yr,$saved)
{
	if ($path==1)
	{	
		$fwdpath='op-pflege-dienstplan.php?';
		if($saved!="1") 
		{  
			if ($mo==1) {$mo=12; $yr--;}
				else $mo--;
		}
		return $fwdpath.'dept='.$dpt.'&pmonth='.$mo.'&pyear='.$yr;
	}
	else return "op-pflege-dienstplan-checkpoint.php";
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

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
	eval("document.images.icon"+mode+elem+".src='../img/warn.gif';");
	w=window.screen.width;
	h=window.screen.height;
	ww=300;
	wh=500;
	var tmonth=document.dienstplan.month.value;
	var tyear=document.dienstplan.jahr.value;
	urlholder="op-pflege-dienstplan-poppersonselect.php?sid=<?php echo "$sid&lang=$lang" ?>&elemid="+elem + "&dept=<?php echo $dept ?>&month="+tmonth+"&year="+tyear+"&mode="+mode+"&retpath=<?php echo $retpath ?>";
	
	popselectwin=window.open(urlholder,"pop","width=" + ww + ",height=" + wh + ",menubar=no,resizable=yes,scrollbars=yes,dependent=yes");
	//window.popselectwin.moveTo((w/2)+80,(h/2)-(wh/2));
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

function killchild()
{
 if (window.popselectwin) if(!window.popselectwin.closed) window.popselectwin.close();
 if (window.helpwin) if(!window.helpwin.closed) window.helpwin.close();
}

function cal_update()
{
	var filename="<?php echo $updatetarget ?>&pmonth="+document.dienstplan.month.value+"&pyear="+document.dienstplan.jahr.value;
	window.location.replace(filename);
}

</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onUnload=killchild()>

<form name="dienstplan" action="op-pflege-dienstplan-planen.php" method="post">
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?php echo "$LDCreate $LDDutyPlan" ?> <font color="<?php print $cfg['top_txtcolor']; ?>"><?php echo $opabt[$dept]; ?></font></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align=right><a 
href="javascript:history.back();killchild();"><img 
src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle"></a><a 
href="javascript:gethelp('op_duty.php','plan','<?php echo $rows ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle"></a><a href="<?php echo $rettarget ?>" onClick=killchild()><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle"></a></td>
</tr>
<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p><br>
<ul>
<font size=4 face="verdana,arial">

<?php echo $LDMonth ?>: <select name="month" size="1" onChange="cal_update()">
<?php
for ($i=1;$i<13;$i++)
	{
	 print '<option  value="'.$i.'" ';
	 if (($pmonth)==$i) print 'selected';
	 print '>'.$monat[$i].'</option>';
  	 print "\n";
	}
?>
</select>

&nbsp;<?php echo $LDYear ?>: <select name="jahr" size="1" onChange="cal_update()">
<?php
for ($i=2000;$i<2016;$i++)
	{
	 print '<option  value="'.$i.'" ';
	 if ($pyear==$i) print 'selected';
	 print '>'.$i.'</option>';
  	 print "\n";
	}

?>
</font>

<FONT    SIZE=-1  FACE="Arial">

<table>
<tr><td>


<table border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="#6f6f6f">

<table border=0 cellpadding=0 cellspacing=1>
<tr><td></td><td></td>
<td>
<div class=a3><font face=arial size=2 color=white><b><?php echo $LDStandbyPerson ?></b></div>
</td><td></td>
<td><div class=a3><font face=arial size=2 color=white><b><?php echo $LDOnCallPerson ?></b></div></td><td>
</td></tr>
<?php
$d=0;

$aduty=explode("~",$result[a_dutyplan]);
$rduty=explode("~",$result[r_dutyplan]);

for ($i=1,$n=0;$i<=$maxdays;$i++,$n++){
	$wd=weekday($i,$pmonth,$pyear);
	switch ($wd){
		case "Sa": $backcolor="bgcolor=#ffffcc";break;
		case "So": $backcolor="bgcolor=#ffff00";break;
		default: $backcolor="bgcolor=white";
		}
	
	parse_str(trim($aduty[$n]),$aelems);
	parse_str(trim($rduty[$n]),$relems);
	print '
	<tr >
	<td  height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>'.$i.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if ($wd=="So") print '<font color=red>';
	print $wd.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>
	&nbsp;<a href="javascript:popselect(\''.$n.'\',\'a\')"><button onclick="javascript:popselect(\''.$n.'\',\'a\')"><img src="../img/patdata.gif" width=20 height=20 border=0></button></a>
	';
	print '
	<input type="hidden" name="ha'.$n.'" value="l='.$aelems[l].'&f='.$aelems[f].'&b='.$aelems[b].'">
	<input type="text" name="a'.$n.'" size="20" onFocus=this.select() value="'.$aelems[s].'"> </div>
	</td>
	<td height=5 '.$backcolor.'>&nbsp;';
		if ($aelems[s]=="") print '<img src="../img/pixel.gif" border=0 width=16 height=16'; else print '<img src="../img/mans-gr.gif"  border=0 width=12 height=15';
	print ' id="icona'.$n.'">&nbsp;
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>
	&nbsp;<a href="javascript:popselect(\''.$n.'\',\'r\')"><button onclick="javascript:popselect(\''.$n.'\',\'r\')"><img src="../img/patdata.gif" width=20 height=20 border=0></button></a>';
	print '&nbsp;
	<input type="hidden" name="hr'.$n.'" value="l='.$relems[l].'&f='.$relems[f].'&b='.$relems[b].'">
	<input type="text" size="20" name="r'.$n.'" onFocus=this.select() value="'.$relems[s].'"></div>
	</td>
	<td height=5 '.$backcolor.'>&nbsp;';
	if ($relems[s]=="") print '<img src="../img/pixel.gif" border=0 width=16 height=16'; else print '<img src="../img/mans-red.gif " border=0 width=12 height=15';
	print ' id="iconr'.$n.'">&nbsp;
	</td>
	</tr>';
	if ($d==6) $d=0; else $d++;
	}
?>

</table>

</td>
</tr>
</table>
	
</td>
<td valign="top" align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../img/<?php echo "$lang/$lang" ?>_savedisc.gif" border=0><p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $rettarget ?>"><img src="../img/<?php ($saved) ? print "$lang/$lang"."_close2.gif" : print "$lang/$lang"."_cancel.gif"; ?>" border="0"></a>

</td>
</tr>
</table>

<p>
<input type="image" src="../img/<?php echo "$lang/$lang" ?>_savedisc.gif" border=0>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $rettarget ?>"><img src="../img/<?php ($saved) ? print "$lang/$lang"."_close2.gif" : print "$lang/$lang"."_cancel.gif"; ?>" border="0"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;
<input type="hidden" name="mode" value="save">
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<input type="hidden" name="dept" value="<?php print $dept; ?>">
<input type="hidden" name="pmonth" value="<?php print $pmonth; ?>">
<input type="hidden" name="pyear" value="<?php print $pyear; ?>">
<input type="hidden" name="planid" value="<?php print $ck_plan; ?>">
<input type="hidden" name="maxelement" value="<?php print $maxdays; ?>">
<input type="hidden" name="encoder" value="<?php print $ck_op_dienstplan_user; ?>">
<input type="hidden" name="retpath" value="<?php print $retpath; ?>">
<?php if($retpath=="calendar_opt") : ?>
	<input type="hidden" name="cday" value="<?php print $cday; ?>">
	<input type="hidden" name="cmonth" value="<?php print $cmonth; ?>">
	<input type="hidden" name="cyear" value="<?php print $cyear; ?>">
<?php endif ?>
</form>

</FONT>

</BODY>
</HTML>
