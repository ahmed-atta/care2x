<?
if($srcpath!="reader") if(!$sid||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}

$newspath="../news_service/news/";
$readerpath="editor-4plus1-read.php?target=physiotherapy&file=";

require("../req/config-color.php");
require("../req/db_dbp.php");
$today=date("Ymd");
$link=mysql_connect($dbhost,$dbusername,$dbpassword);
 if ($link)
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$dbtable="news_article";

		for($i=1;$i<5;$i++)
		{
		 	$sql="SELECT head_file,main_file FROM $dbtable 
					WHERE category='physiotherapy' 
						AND art_num='$i' 
						AND publish_date='$today' 
							ORDER BY tstamp DESC";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$art[$i]=mysql_fetch_array($ergebnis);
				}
				else // if no file found get the last entry
				{
					$sql="SELECT head_file,main_file FROM $dbtable 
							WHERE category='physiotherapy' 
								AND art_num='$i'  
								AND publish_date<'$today' 
									ORDER BY tstamp DESC";

							if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$art[$i]=mysql_fetch_array($ergebnis);
								}
								else $art[$i]=array("head_file"=>"head_dummy".$i.".htm");
								$ergebnis=NULL;
							}
							
				}
			}
		}
		
		 	$sql="SELECT title,main_file,author,encode_date FROM $dbtable 
					WHERE category='physiotherapy' 
						AND main_file<>'".$art[1][main_file]."' 
						AND main_file<>'".$art[2][main_file]."' 
						AND main_file<>'".$art[3][main_file]."' 
						AND main_file<>'".$art[4][main_file]."' 
							ORDER BY tstamp DESC";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $artikel=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					//print $sql;
				}
			}
		
		
		
	}else print "$db_table_noselect $sql<br>";
	mysql_close($link);
  } else { print "$db_noconnect $sql<br>"; }

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Physiotherapy</TITLE>

<script language="javascript">
<!-- 
var urlholder;
function gotostat(station){
	urlholder="pflege-station.php?station=" + station + "&sid=<? print $ck_sid.'"' ?>;
	stationwin=window.open(urlholder,station,"width=800,menubar=no,resizable=yes,scrollbars=yes");
	}

function closewin()
{
	location.href='startframe.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}
// -->
</script>

<?
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 if($idxreload=="j") print " onLoad=window.parent.STARTPAGE.location.replace('indexframe.php?uid=".$r."');";?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp;Physiotherapie</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<table border=0 cellpadding=10>
  <tr>
    <td valign="top">
	<? if(file_exists($newspath.$art[1][head_file])) : ?>
		<? include($newspath.$art[1][head_file]) ?><br>
		<a href="<?=$readerpath.$art[1][main_file] ?>"><font size=1 color="#ff0000" face="arial">mehr dazu...</font></a>
	<? endif ?>
	</td>
    <td valign="top">
	<? if(file_exists($newspath.$art[1][head_file])) : ?>
		<? include($newspath.$art[2][head_file]) ?><br>
		<a href="<?=$readerpath.$art[2][main_file] ?>"><font size=1 color="#ff0000" face="arial">mehr dazu...</font></a>
	<? endif ?>
	</td>
  </tr>
  <tr>
    <td valign="top">
		<? if(file_exists($newspath.$art[1][head_file])) : ?>
		<? include($newspath.$art[3][head_file]) ?><br>
		<a href="<?=$readerpath.$art[3][main_file] ?>"><font size=1 color="#ff0000" face="arial">mehr dazu...</font></a>
	<? endif ?>
	</td>
    <td valign="top">
		<? if(file_exists($newspath.$art[1][head_file])) : ?>
		<? include($newspath.$art[4][head_file]) ?><br>
		<a href="<?=$readerpath.$art[4][main_file] ?>"><font size=1 color="#ff0000" face="arial">mehr dazu...</font>
	<? endif ?>
	</td>
  </tr></a>
  <tr>
    <td colspan=2 valign="top">
	
	<FONT    SIZE=4  FACE="Arial">
Andere Artikel über Physiotherapie
<? if($rows) : ?>
	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#0>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2 color="#0000cc"><b>Artikel</b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2 color="#0000cc"><b>Verfasst von:</b></font></td>
      <td><font face="Verdana,arial" size=2 color="#0000cc"><b>am:</b></font></td>
    </tr>
<? while($artikel=mysql_fetch_array($ergebnis))
{
print '<tr bgcolor="#ffffff"><td><a href="#"><a href="'.$readerpath.$artikel[main_file].'"><font face=verdana,arial size=2> '.$artikel[title].'</a></td>
		<td><font face=verdana,arial size=2><a href="'.$readerpath.$artikel[main_file].'"><img src="../img/info.gif" border=0 alt="Click zum Lesen."></a></td>		
		<td><font face=verdana,arial size=2> '.$artikel[author].'</td>
		<td><font face=verdana,arial size=2><nobr> '.$artikel[encode_date].'</td></tr>';
print "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
	
	</td>
  </tr>
</table>




 
<? endif ?>
<p>
<a href="#" onClick=closewin()><img src="../img/close.gif" border=0  alt="Dieses Fenster schliessen." align="middle"></a>

<p>


</FONT>

</td>
</tr>

<tr valign=top>
<td bgcolor="<? print $cfg['bot_bgcolor']; ?>" colspan=2> 
<a href="editor-pass.php?target=physiotherapy"><img src="../img/news.gif" width=16 height=14 border=0></a>
<?php
require("copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
