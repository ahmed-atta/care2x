<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","nursing.php");
$local_user="ck_pflege_user";
require("../include/inc_front_chain_lang.php");

if($edit&&!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../include/inc_config_color.php"); // load color preferences

$thisfile="pflege-station-patientdaten-kurve.php";
$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";
if(!$kmonat) $kmonat=date("n");
//if(($kmonat<10)&&(strlen($kmonat)<2)) $kmonat="0".$kmonat;
if(!$tag) $tag=date("j");
//if(($tag<10)&&(strlen($tag)<2)) $tag="0".$tag;
if(!$jahr) $jahr=date("Y");

if($dayback)
{ 
	if($tag>$dayback)
	{
		$tag-=$dayback;
	}
	else
	{
		for($i=0;$i<$dayback;$i++)
		{
			if($tag>1) $tag--; 
			elseif($kmonat==1)
				{
				$jahr--;
				$kmonat=12;
				$tag=31;
				}
				else
				{
				$kmonat--;
				//$tag=31;
				//while(!checkdate($kmonat,$tag,$jahr)) $tag--;
				$tag=date("t",mktime(0,0,0,$kmonat,1,$jahr));
				}
		//if($tagname) $tagname--; else $tagname=6; 
		}
	}
} else if($dayfwd)
	{
		//if($tagname==7) $tagname=1; else $tagname++;			
	    $tag++;
		if(!checkdate($kmonat,$tag,$jahr))
			{
				$tag=1;
				if($kmonat==12) 
				{
					$kmonat=1; 
					$jahr++;
				}
				else $kmonat++;
			}
 		}
//print $tagname." day ";
$tagname=date("w",mktime(0,0,0,$kmonat,$tag,$jahr));
$tagnamebuf=$tagname;

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
	{	
	// get orig data
	$dbtable="mahopatient";
	$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
	if($ergebnis=mysql_query($sql,$link))
       	{
			$rows=0;
			if( $result=mysql_fetch_array($ergebnis)) $rows++;
			if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					//if($edit&&$result[discharge_date]) $edit=0;
		
					$sql="SELECT * FROM nursing_station_patients_curve WHERE patnum='$pn' ";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							if( $content=mysql_fetch_array($ergebnis)) $rows++;
							if($rows)
							{
								mysql_data_seek($ergebnis,0);
								$content=mysql_fetch_array($ergebnis);
							}
						}
						else {print "<p>$sql$LDDbNoRead"; exit;}
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }

function hilite($str)
{
	$sbuf=str_replace('**','</span>',$str);
	return str_replace('*','<span style="background:yellow">',$sbuf);
}

function getdata(&$info,$d,$m,$y)
{
	$sbuf="";$ok=0;
		$cbuf="sd=$y$m$d&rd=$d.$m.$y";
		$arr=explode("_",$info);
		while(list($x,$v)=each($arr))
		{
			if(stristr($v,$cbuf))
			{
				$sbuf=$v;
				$ok=1;
				break;
			}
		}
		
	if($ok)
	{
		parse_str($sbuf,$abuf);
		 return hilite(nl2br($abuf[e]));
	}
	else return "";
}

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

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?php echo $LDFeverCurve ?></TITLE>

<style type="text/css" name="2">
	A:link  {text-decoration: none; }
	A:hover { color: red }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}

.pblock{ font-family: verdana,arial; }

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

.a12{ font-family: verdana,arial; font-size:12;}
.a10{ font-family: arial; font-size:10;}
</style>

<script language="javascript">
<!-- 
  var urlholder="";
  var infowinflag=0;
  var sw=window.screen.width/2;
  var sh=window.screen.height/2;
  var w600=600;
  var h400=400;
  var h600=600;
function popgetinfowin(winID,patientID,jahrID,monatID,tagID,tagS,tagN)
	{
	urlholder="pflege-popgetinfo.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID+ "&dystart="+ tagS + "&dyname="+ tagN;
	infowin=window.open(urlholder,"kurvendaten","width="+w600+",height="+h400+",menubar=no,resizable=yes,scrollbars=yes");
   	window.infowin.moveTo(sw-(w600/2),sh-(h400/2));
   	infowinflag=1;
	}
function popgetdailyinfo(winID,patientID,jahrID,monatID,tagID,tagIDX,jahrS,monatS,tagS,tagN)
	{
	urlholder="pflege-getdailyinfo.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID + "&dyidx="+ tagIDX+"&yrstart="+jahrS+"&monstart="+monatS+"&dystart="+ tagS + "&dyname="+ tagN ;
	dailywin=window.open(urlholder,"dailydaten","width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
   	infowinflag=1;
	}
function popgetdailybpt(winID,patientID,jahrID,monatID,tagID,tagIDX,jahrS,monatS,tagS,tagN)
	{
	urlholder="pflege-getdailybp_t.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID + "&dyidx="+ tagIDX +"&yrstart="+jahrS+"&monstart="+monatS+"&dystart="+ tagS + "&dyname="+ tagN ;
	dailybpt=window.open(urlholder,"dailybpt","width="+w600+",height="+h600+",menubar=no,resizable=yes,scrollbars=yes");
   	window.dailybpt.moveTo(sw-(w600/2),sh-(h600/2));
   	infowinflag=1;
	}
function popgetmedx(winID,patientID,tagID)
	{
	w=700;
	urlholder="pflege-getmedx.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "<?php print "&yr=$jahr&mo=$kmonat&dystart=$tag&dyname=$tagname&dy="; ?>" + tagID ;
	dailymedx=window.open(urlholder,"medx","width="+w+",height="+h600+",menubar=no,resizable=yes,scrollbars=yes");
   	window.dailymedx.moveTo(sw-(w/2),sh-(h600/2));
   	infowinflag=1;
	}
function popgetdailymedx(winID,patientID,jahrID,monatID,tagID,tagIDX,jahrS,monatS,tagS,tagN)
	{
	urlholder="pflege-getdailymedx.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID + "&dyidx="+ tagIDX+"&yrstart="+jahrS+"&monstart="+monatS+"&dystart="+ tagS + "&dyname="+ tagN ;
	dailymedx=window.open(urlholder,"dailymedx","width="+w600+",height="+h600+",menubar=no,resizable=yes,scrollbars=yes");
   	window.dailymedx.moveTo(sw-(w600/2),sh-(h600/2));
   	infowinflag=1;
	}
	
function setStartDate(winID,patientID,jahrID,monatID,tagID,station,tagN)
	{
	if(event.button==2)
		{
		//alert("right click");
		if(winID=="dayback") dayID="<?php echo $LDStartDate ?>";
		if(winID=="dayfwd") dayID="<?php echo $LDEndDate ?>";
		if(confirm("<?php echo $LDConfirmSetDate ?>"))
			{
			urlholder="pflege-station-patientdaten-setstartdate.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid="+winID+"&pn=" + patientID + "&jahr=" + jahrID + "&kmonat=" + monatID + "&tag="+ tagID + "&station="+station+"&tagname="+ tagN ;
			setdatewin=window.open(urlholder,"setdatewin","width=400,height=250,menubar=no,resizable=yes,scrollbars=yes");
   			infowinflag=1;
			}
		}
		else 
		{
		// alert("left click");	
		urlholder="pflege-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&"+winID+"=1&pn=" + patientID + "&jahr=" + jahrID + "&kmonat=" + monatID + "&tag="+ tagID + "&station="+station+"&tagname="+ tagN ;
 		window.location.replace(urlholder);
   		}
	}

function closeifok()
{
	ok=0;
	if (infowinflag){
		if (window.infowin)
		{ if (window.infowin.closed) ok=1;
			else
			{
	 			window.infowin.focus()
				window.infowin.alert("Ein Eingabefenster ist noch nicht abgeschlossen")	
			}
		}
		else ok=1;
	}	
	else ok=1;
	if(ok)
	{
		window.opener.focus();
		window.close();
	}
}	
	
function returnifok(){
	if (infowinflag){
		if(window.infowin.closed)  history.go(-2)
	window.infowin.focus()
	window.infowin.alert("Ein Eingabefenster ist noch nicht abgeschlossen")	
	}
	else history.back()
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<?php
require("../include/inc_css_a_hilitebu.php");
?>



<BODY bgcolor=#cde1ec <?php if(!$nofocus) print 'onLoad="if (window.focus) window.focus()"'; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>

<script language="">
<!-- Script Begin
var dblclk=0;
//  Script End -->
</script>
</HEAD>

<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2 FACE="Arial"><STRONG> <?php print "$LDFeverCurve $station ($jahr"; if($kmonat==12) if($tag>25) print " - ".($jahr +1);?>)</STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><!-- <a href="javascript:window.history.back()"><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('nursing_feverchart.php','main','','<?php echo $station ?>','Fever chart')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td colspan=2 bgcolor="#9f9f9f">


<form name="berichtform">
<?php
//****************************** Allergy ********************************

print '
		<table   cellpadding="0" cellspacing=1 border="0" >
		<tr  >
		<td bgcolor="aqua" class=pblock><font size="2" ><div class=pcont><b>'.$result[patnum].'</b></div></td>
		<td bgcolor="white" ><font face="verdana,arial" size="2" 
		color=red >'.$LDAllergy.':';
		if($edit) print '
		<a href="javascript:popgetinfowin(\'allergy\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')"><img src="../img/clip2.gif" width="12" height="10"  width="12" height="10"   border=0 alt="'.str_replace("~tagword~",$LDAllergy,$LDClk2Enter).'" ></a>
		';
		print '
		</td>';
//****************************** DAy scale ********************************

print '
		<td colspan="7"> 
		<table cellpadding="0"  cellspacing="0" border="1" width="100%"><tr>';

$actmonat=$kmonat;
$actjahr=$jahr;

for ($i=$tag,$acttag=$tag,$d=0,$tgbuf=$tagname;$i<($tag+7);$i++,$d++,$tgbuf++,$acttag++)
	{
	print '<td';

	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date

	switch($tgbuf) 
		{
			case 0: print' bgcolor="orange"';break;
			case 6: print' bgcolor="#ffffcc"';break;
			case 7: print' bgcolor="orange"'; $tgbuf=0;break;
			default: print' bgcolor="white"';
		}

	if(!$d) print' align=left width="98">';else if($d>5) print' align=right width="98">';else print' align=center width="98">';
	if(!$d) print '<a href="#">
		<img src="../img/l_arrowGrnSm.gif" width=12 height=12 border=0 alt="'.$LDBackDay.'" onMouseDown="setStartDate(\'dayback\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$station.'\',\''.$tagname.'\');return false;"></a>';
	print '
	<font face="verdana,arial" size="2" color="#000000" >'.$acttag."/".$actmonat.' . '.$tage[$tgbuf];
	if ($d==6) print ' <a href="#">
		<img src="../img/r_arrowGrnSm.gif" width=12 height=12 border=0 alt="'.$LDFwdDay.'" onMouseDown="setStartDate(\'dayfwd\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$station.'\',\''.$tagname.'\')"></a>';
	
	print '</td>';
	//$tgbuf++;
	print "\n";
	}

//$tagname-=7;
$actmonat=$kmonat;
$actjahr=$jahr;

//****************************** daily kost diet ********************************
print '</tr><tr>';
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{

	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	print '
	<td bgcolor=white align=center class="a12" width="98">';
	if($edit) print '
	<a href="javascript:popgetdailyinfo(\'diet\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.$LDClk2PlanDiet.'">';
	print '
	<font face="verdana,arial" size="2" color="#0" >';
	
	if($r=getdata(&$content[diet],$i,$kmonat,$jahr))  print $r;
	 	else  print $LDDiet;
}
//**************** Patient personal data ************************************
	if($edit) print '</a>';
print '</td>
		</tr></table> 
		
		</td>
		</tr>
		<tr   valign="top">
		<td bgcolor="#ffffcc" class=pblock width="130"><font size=2>
		<div class=pcont><b>'.ucfirst($result[name]).', '.ucfirst($result[vorname]).'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font> <p>
		<font size=1>'.nl2br($result[address]).'<p>
		'.strtoupper($station).'&nbsp;'.$result[kasse].'  '.$result[kassename].'</div></td>';

//**************** allergy data ************************************
print'
		<td bgcolor=white ><font face="verdana,arial" size="2" color=red ><img src="../img/scale.gif" border=0 width=28 height=135 align="right">'.hilite(nl2br($content[allergy])).'<br></td>';

//**************** curve graph ************************************
print '
		<td bgcolor=white colspan="7">';
		if($edit) 
		
$actmonat=$kmonat;
$actjahr=$jahr;

if($edit)
{
	print '
		<MAP NAME="FrontPageMap">';
	for($i=$tag,$acttag=$tag,$d=0,$x0=0,$x1=99;$i<($tag+7);$i++,$d++,$x0+=100,$x1+=100,$acttag++)
	{
		aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	 print'
		<AREA SHAPE="RECT" COORDS="'.$x0.',0,'.$x1.',133" HREF="javascript:popgetdailybpt(\'bp_temp\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDBpTemp,$LDClk2EnterDaily).'" >';
	}
	print '
		</MAP>';
}
print '
		<img';
if($edit) print ' ismap usemap="#FrontPageMap"';
print ' src="../imgcreator/datacurve.php?sid='.$sid.'&lang='.$lang.'&pn='.$pn.'&max=15&yr='.$jahr.'&mo='.$kmonat.'&dy='.$tag.'" height=135 width=700 border=0 >
		</td>
		</tr>
		<tr   valign="top" >
		<td bgcolor=white colspan="2" height="150">&nbsp 
		<font size=1 face="verdana,arial">
		&nbsp;'.$LDDiagnosisTherapy;
if($edit) print '
		 <a href="javascript:popgetinfowin(\'diag_ther\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')">
		<img src="../img/clip2.gif" width="12" height="10" border=0 alt="'.str_replace("~tagword~",$LDDiagnosisTherapy,$LDClk2Enter).'" ></a>';
		print '
		<br>'.hilite(nl2br($content[diag_ther])).'</td>';
		
//********************************** diagnose therapie daily report ****************************
$actmonat=$kmonat;
$actjahr=$jahr;

for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	print '
		<td bgcolor=white  height="150" width="98"><font face="verdana,arial" size="1" color="#000000">';
	if($edit) print '
		<a href="javascript:popgetdailyinfo(\'diag_ther_dailyreport\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')">';

	if($r=getdata(&$content[diag_ther_dailyreport],$acttag,$actmonat,$actjahr)) 
	 print $r;
	else 
	  if($edit) print '<img src="../img/pixel.gif" width="97" height="148"  border=0 alt="'.str_replace("~tagword~",$LDDiagnosisTherapy,$LDClk2EnterDaily).'" >';
	if($edit) print "</a>";
	print "
	</td>";
	}
	
//************************* extra Diagnoses specials **********************************
print '
		</tr>
		<tr   valign="top">
		<td bgcolor=white colspan="2" height="50">
<font size=1 face="verdana,arial">'.$LDSpecialsExtra;
if($edit) print '
<a href="javascript:popgetinfowin(\'xdiag_specials\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')"><img src="../img/clip2.gif" width="12" height="10"  border=0 alt="'.str_replace("~tagword~",$LDSpecialsExtra,$LDClk2Enter).'" ></a>';
print '
	<br>'.hilite(nl2br($content[xdiag_specials])).'</td>';

	//***************************  KG ATG etc .  daily report ***************************
$actmonat=$kmonat;
$actjahr=$jahr;
	
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	print '
		<td bgcolor=white  height="50"><font face="verdana,arial" size="1" color="#000000">';
	if($edit) print '
		<a href="javascript:popgetdailyinfo(\'kg_atg_etc\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDPtAtgEtc,$LDClk2EnterDaily).'">';
	print $LDPtAtgEtc.':';
	if($edit) print '</a>';
	print '<br>';
		$sbuf="";

		if($r=getdata(&$content[kg_atg_etc],$acttag,$actmonat,$actjahr))  print $r;

	print "
		</td>";
	}

print '
		</tr>';

print '
		<tr   valign="top">';

// ************** anticoag  ************************
print '
		<td bgcolor=';
		if($content[anticoag]) print 'aqua'; else print "#ffffff";
print '  colspan="2">
		<font size=1 face="verdana,arial">'.$LDAntiCoag;
if($edit) print '
		<a href="javascript:popgetinfowin(\'anticoag\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')"><img src="../img/clip2.gif" width="12" height="10"  border=0 alt="'.str_replace("~tagword~",$LDAntiCoag,$LDClk2Enter).'" ></a>';
print hilite(nl2br($content[anticoag])).'</td>';
		
// ************** anticoag dailydose ************************
$actmonat=$kmonat;
$actjahr=$jahr;
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	$r=getdata(&$content[anticoag_dailydose],$acttag,$actmonat,$actjahr);
	print '
	<td ';
	if($r) print "bgcolor=aqua"; else print "bgcolor=white";
	print '><font face="verdana,arial" size="1" color="#000000">';
	if($edit) print '
	<a href="javascript:popgetdailyinfo(\'anticoag_dailydose\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDAntiCoag,$LDClk2EnterDaily).'" >';

	if($r) 
	 print $r;
	else 
	  if($edit) print '<img src="../img/pixel.gif" width="95" height="12"  align="absmiddle"  border=0 alt="'.str_replace("~tagword~",$LDAntiCoag,$LDClk2EnterDaily).'" >';
	if($edit) print '</a>';
	print '
	</td>';
	
	}

print '
		</tr>
		<tr   valign="top">';
// ************** Angaben ************************
print '
		<td bgcolor=white valign="top" width="130" class="a10">
		'.$LDExtraNotes.':';
if($edit) print ' <a href="javascript:popgetinfowin(\'lot_mat_etc\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')"><img src="../img/clip2.gif" width="12" height="10"  border=0  alt="'.str_replace("~tagword~",$LDExtraNotes,$LDClk2Enter).'" ></a>';
print '<br>'.hilite(nl2br($content[lot_mat_etc])).'
		</td>';
		
// ************** medication ************************
if($content[medication]) $mdx=explode("~",$content[medication]);
	else $mdx[0]=0;


// check if element number exists else set to 10
if(strchr($mdx[0],"|")||(!$mdx[0])) $maxmedx=10;
 else
 {
 	$maxmedx=(int) trim($mdx[0]);
	array_splice($mdx,0,1);
}


print '
		<td bgcolor="#ffffff" ><font size=1 face="verdana,arial" ><nobr>';
	if($edit) print '<a href="javascript:popgetmedx(\'medication\',\''.$pn.'\',\''.$tag.'\')" title="'.str_replace("~tagword~",$LDMedication,$LDClk2Enter).'">';
print $LDMedication;
	if($edit) print '</a>';
print '&nbsp;<font color="#ff3366">'.$LDIvPort.'>';
print '
<table border=0 border="0" cellpadding="0"  cellspacing="0" width="100%">
  <tr>
    <td bgcolor="#cfcfcf">
	<table border="0" cellpadding="0"  cellspacing="1" width="100%">';
$toggle=0;
for ($i=0;$i<$maxmedx;$i++){
		$m=explode("|",$mdx[$i]);
		if ($toggle) $bgc="#efefef"; else $bgc="#ffffff";
		print '<tr><td ';
		if($m[1]) 
		{
			switch($m[3])
			{
				case "n": print ' bgcolor="'.$bgc.'"'; $cat[$i]="n"; break;
				case "a": print ' bgcolor="#00ff00"'; $cat[$i]="a";break;
				case "w": print ' bgcolor="#ffff00"'; $cat[$i]="w";break;
				case "c": print ' bgcolor="#00ccff"'; $cat[$i]="c";break;
				case "i": print ' bgcolor="#ff6699"'; $cat[$i]="i";break;
				default:print ' bgcolor="'.$bgc.'"';
			}
		}
		else print  'bgcolor='.$bgc;
		print ' class="a10">';
		if($m[1]) print $m[1]; else print '&nbsp;';
		print '
			</td></tr>';
		print "\n";
		$toggle=!$toggle;
		}
print '</table>
</td>
  </tr>
</table>';

	
print	'</td>';

// ************** iv zugang dailydose ************************
$actmonat=$kmonat;
$actjahr=$jahr;
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	$r=getdata(&$content[iv_needle],$acttag,$actmonat,$actjahr);
	print '
	<td valign="bottom" ';
	if($r) print "bgcolor=#ff99cc"; else print "bgcolor=white";
	print '><font face="verdana,arial" size="1" color="#000000">';
	

	if($edit) print '
	<a href="javascript:popgetdailyinfo(\'iv_needle\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDIvPort,$LDClk2EnterDaily).'">';

	if($r)  print $r;
		else
		 if($edit) print '<img src="../img/pixel.gif" width="95" height="12"  align="absmiddle"  border=0 alt="'.str_replace("~tagword~",$LDIvPort,$LDClk2EnterDaily).'">';
	if($edit) print '</a>';
	
// ************** medication dailydose ************************
	$dosebuf=getdata(&$content[medication_dailydose],$acttag,$actmonat,$actjahr);
	$dosis=explode("|",$dosebuf);
	
	print '
	<table border=0 border="0" cellpadding="0"  cellspacing="0" width="100%">
  <tr>
    <td bgcolor="#cfcfcf">
	<table border="0" cellpadding="0"  cellspacing="1" width="100%">';
	for ($j=0;$j<$maxmedx;$j++){
		if ($toggle) $bgc="#efefef"; else $bgc="#ffffff";
		print '<tr><td ';
		switch($cat[$j])
			{
				case "n": print ' bgcolor="'.$bgc.'"';break;
				case "a": print ' bgcolor="#00ff00"';break;
				case "w": print ' bgcolor="#ffff00"'; break;
				case "c": print ' bgcolor="#00ccff"'; break;
				case "i": print ' bgcolor="#ff6699"'; break;
				default:print ' bgcolor="'.$bgc.'"';
			}
	print ' class="a10">&nbsp;';
	if($edit) print '<a href="javascript:popgetdailymedx(\'medication\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDMedication,$LDClk2PlanDaily).'">';
	
	if($dosis[$j]) print $dosis[$j]; else print'<img src="../img/pixel.gif" width="90" height="12"  align="absmiddle"  border=0>';
	if($edit) print '</a>';
	print '</td></tr>';
		$toggle=!$toggle;	
		print "\n";
		}
		print '</table>
		</td>
  </tr>
</table>';

	print '</td>';
	}

print 
'</tr>
	</table>
';

?>
</form>

<p>

<ul>
<a href="<?php echo "$breakfile" ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0"></a>
</FONT>
</ul>
</td>


</tr>
</table>        
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</BODY>
</HTML>
