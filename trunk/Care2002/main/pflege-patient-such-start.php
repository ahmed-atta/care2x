<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");

require("../req/config-color.php"); // load color preferences

$breakfile="pflege.php?sid=$ck_sid&lang=$lang";

if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$t_date=$pday.".".$pmonth.".".$pyear;


if($mode=="such")
{
	$srcword=trim($srcword);
	//prepare the seach word detect several types
	if(is_numeric($srcword)) $srcword=(int) $srcword;
	if(substr_count($srcword,","))  // detect comma
	{
		$buf=str_replace(",","",$srcword);//print $buf;
		$wx=explode(" ",trim($buf));
		$sln=$wx[0];$sfn=$wx[1];$sg=$wx[2];
		switch(sizeof($wx))
		{
			case 2: $sw="ln=$sln&fn=$sfn";break;
			case 3: $sw="ln=$sln&fn=$sfn&g=$sg"; break;
			default: $sw=$srcword;$sln=$sw;$sfn=$sw;$sg=$sw;
		}
	}
	else
	{
		$wx=explode(" ",$srcword); // explode to array
		$sln=$wx[1];$sfn=$wx[0];$sg=$wx[2];
		switch(sizeof($wx))
		{
			case 2: $sw="ln=$sln&fn=$sfn";break;
			case 3: $sw="ln=$sln&fn=$sfn&g=$sg"; break;
			default: $sw=$srcword; $sln=$sw;$sfn=$sw;$sg=$sw;
		}
	}
	//print $sw;
	//print $srcword;
	
	$dbtable="nursing_station_patients";
	include("../req/db-makelink.php");
		if($link&&$DBLink_OK)
		{
					if(!$arch)	$sql="SELECT station, t_date, info FROM $dbtable
									WHERE t_date='".date("d.m.Y")."' 
												AND bed_patient LIKE '%$sw%' 
												AND info<>'template' ORDER BY s_date DESC";
						else 	$sql="SELECT station, t_date, info FROM $dbtable
									WHERE bed_patient LIKE '%$sw%' 
												AND info<>'template' ORDER BY s_date DESC";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							while( $result=mysql_fetch_array($ergebnis)) $rows++;
							if($rows>1)
							{
								mysql_data_seek($ergebnis,0);
								//print $srcword;
							}
							elseif($rows==1)
							{
								mysql_data_seek($ergebnis,0);
								$result=mysql_fetch_array($ergebnis);
							  	$dbuf=explode(".",$result[t_date]);
  								$buf="pflege-station.php?sid=$ck_sid&lang=$lang&sln=$sln&sfn=$sfn&sg=$sg&station=".$result[station]."&pday=".$dbuf[0]."&pmonth=".$dbuf[1]."&pyear=".$dbuf[2];

								header("location:".$buf);
								exit;
							}
						}
						else print "$sql<br>$LDDbNoRead"; 
		}
  		 else { print "$LDDbNoLink<br>"; } 

}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script  language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

// -->
</script>


 <? if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>
	
	<STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}

?>



</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();document.suchlogbuch.srcword.select();"
<? 
 print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
  ?>>
 
 

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?="$LDNursing - $LDSearchPatient" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('nursing_how2search.php','<?=$mode ?>','<?=$rows ?>','search')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=3  bgcolor="<? print $cfg['body_bgcolor']; ?>"><p><br>

<ul>
<FONT    SIZE=-1  FACE="Arial">
<? if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><? print "$LDSearchKeyword <font color=#0000ff>\"$srcword\"</font> ".str_replace("~rows~",$rows,$LDWasFound) ?> <br>
<?=$LDPlsClk ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp;</b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; <?=$LDDate ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?=$LDStation ?>&nbsp;</b></td>
  </tr>
 <? 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $dbuf=explode(".",$result[t_date]);
	$buf="pflege-station.php?sid=$ck_sid&sln=".$sln."&sfn=".$sfn."&sg=".$sg."&station=".$result[station]."&pday=".$dbuf[0]."&pmonth=".$dbuf[1]."&pyear=".$dbuf[2];
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">';
	if($result[t_date]<>date("d.m.Y")) print '<img src="../img/bul_arrowBluSm.gif" width=12 height=12 border=0>';
		else print '<img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0>';
	print'
	</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[t_date].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[station].'</a>&nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=9 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<hr>
<? endif ?>

	<?=$LDSearchPrompt ?>
	
<form action="pflege-patient-such-start.php" method="get" name="suchlogbuch" >
<table border=0 cellspacing=0 cellpadding=1 bgcolor="#999999">
  <tr>
    <td>
		<table border=0 cellspacing=0 cellpadding=5 bgcolor="#eeeeee">
    <tr>
      <td>	<font color=maroon size=2><b><?=$LDSrcKeyword ?>:</b></font><br>
          		<input type="text" name="srcword" size=40 maxlength=100 value="<? if ($srcword!=NULL) print $srcword; ?>">
				<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
    			<input type="hidden" name="mode" value="such"><br>
				<font size=2><input type="checkbox" name="arch" value="1" <? if($arch) print "checked"; ?>> <?=$LDSearchArchive ?></font><br>
    			 
    
           	</td>
	   </tr>
    <tr>
      <td align=right>	
				<input type="submit" value="<?=$LDSearch ?>" align="right">
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
<b><?=$LDMoreFunctions ?>:</b><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="pflege-station-archiv.php?sid=<?print "$ck_sid&lang=$lang";?>&user=<? print str_replace(" ","+",$user);?>"><?=$LDArchive ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:gethelp('nursing_how2search.php','search','<?=$target ?>')"><?=$LDHow2Search ?></a><br>

<p>
<a href="pflege.php?sid=<? print $ck_sid; ?>"><img border=0 src="../img/<?="$lang/$lang" ?>_cancel.gif"  alt="<?=$LDCancel ?>"></a>
</ul>
<p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</FONT>


</BODY>
</HTML>
