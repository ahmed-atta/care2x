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
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php'); // load color preferences

$breakfile="pflege.php?sid=".$sid."&lang=".$lang;

if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$s_date=$pyear."-".$pmonth."-".$pday;

/* Load the date formatter */
require_once('../include/inc_date_format_functions.php');



if($mode=='such')
{
	$srcword=trim($srcword);
	//prepare the seach word detect several types
	if(is_numeric($srcword)) $srcword=(int) $srcword;
	if(substr_count($srcword,","))  // detect comma
	{
		$buf=str_replace(",","",$srcword);//echo $buf;
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
	//echo $sw;
	//echo $srcword;
	
	$dbtable='care_nursing_station_patients';
	include('../include/inc_db_makelink.php');
		if($link&&$DBLink_OK)
		{
					if(!$arch)	$sql="SELECT station, s_date, info FROM $dbtable
									WHERE s_date='".date('Y-m-d')."' 
												AND bed_patient LIKE '%$sw%' 
												AND info<>'template' ORDER BY s_date DESC";
						else 	$sql="SELECT station, s_date, info FROM $dbtable
									WHERE bed_patient LIKE '%$sw%' 
												AND info<>'template' ORDER BY s_date DESC";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							while( $result=mysql_fetch_array($ergebnis)) $rows++;
							if($rows>1)
							{
								mysql_data_seek($ergebnis,0);
								//echo $srcword;
							}
							elseif($rows==1)
							{
								mysql_data_seek($ergebnis,0);
								$result=mysql_fetch_array($ergebnis);
							  	$dbuf=explode(".",$result[t_date]);
  								$buf="pflege-station.php?sid=$sid&lang=$lang&sln=$sln&sfn=$sfn&sg=$sg&station=".$result[station]."&pday=".$dbuf[0]."&pmonth=".$dbuf[1]."&pyear=".$dbuf[2];

								header("location:".$buf);
								exit;
							}
						}
						else echo "$sql<br>$LDDbNoRead"; 
		}
  		 else { echo "$LDDbNoLink<br>"; } 

}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script  language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

// -->
</script>


 <?php if($cfg['dhtml'])
{ echo' 
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
<?php 
 echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
  ?>>
 
 

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing - $LDSearchPatient" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_how2search.php','<?php echo $mode ?>','<?php echo $rows ?>','search')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=3  bgcolor="<?php echo $cfg['body_bgcolor']; ?>"><p><br>

<ul>
<FONT    SIZE=-1  FACE="Arial">
<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo "$LDSearchKeyword <font color=#0000ff>\"$srcword\"</font> ".str_replace("~rows~",$rows,$LDWasFound) ?> <br>
<?php echo $LDPlsClk ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp;</b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; <?php echo $LDDate ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDStation ?>&nbsp;</b></td>
  </tr>
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $dbuf=explode('-',$result['s_date']);
	$buf="pflege-station.php?sid=$sid&lang=$lang&sln=".$sln."&sfn=".$sfn."&sg=".$sg."&station=".$result[station]."&pday=".$dbuf[2]."&pmonth=".$dbuf[1]."&pyear=".$dbuf[0];
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">';
	if($result['s_date'] <> (date('Y-m-d'))) echo '<img '.createComIcon('../','bul_arrowblusm.gif','0').'>';
		else echo '<img '.createComIcon('../','r_arrowgrnsm.gif','0').'>';
	echo'
	</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($result['s_date'],$date_format).'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['station'].'</a>&nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=9 height=1><img '.createComIcon('../','pixel.gif','0','absmiddle').'></td>
  </tr>';
  }
 ?>
</table>
<p>
<hr>
<?php endif ?>

	<?php echo $LDSearchPrompt ?>
	
<form action="pflege-patient-such-start.php" method="get" name="suchlogbuch" >
<table border=0 cellspacing=0 cellpadding=1 bgcolor="#999999">
  <tr>
    <td>
		<table border=0 cellspacing=0 cellpadding=5 bgcolor="#eeeeee">
    <tr>
      <td>	<font color=maroon size=2><b><?php echo $LDSrcKeyword ?>:</b></font><br>
          		<input type="text" name="srcword" size=40 maxlength=100 value="<?php if ($srcword!=NULL) echo $srcword; ?>">
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="pflege-station-archiv.php?sid=<?php echo "$sid&lang=$lang";?>&user=<?php echo str_replace(" ","+",$user);?>"><?php echo $LDArchive ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="javascript:gethelp('nursing_how2search.php','<?php echo $mode ?>','<?php echo $rows ?>','search')"><?php echo $LDHow2Search ?></a><br>

<p>
<a href="pflege.php?sid=<?php echo "$sid&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>"></a>
</ul>
<p>
<hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>


</BODY>
</HTML>
