<?php if(($sid==NULL)||($sid!=$$ck_sid_buffer)) { header("location:invalid-access-warning.php"); exit;}
require_once('../include/inc_config_color.php');


//create unique id
$r=uniqid("");

$dept=array("Allgemeine Chirurgie","Unfall Chirurgie","Plastische Chirurgie","HNO","Augenklinik","Pathologie",
					"Gynäkologie",
					"Physio-therapie",
					"Innere Medizin",
					"Onkologie",
					"Technik",
					"Intermediate Care Unit",
					"Intensive Care Unit",
					"Labor");
$times=array("8.30 - 21.00", //Mo
					"8.30 - 21.00", //Di
					"8.30 - 21.00", //Mi
					"8.30 - 21.00", //Do
					"8.30 - 21.00", //Fr
					"8.30 - 21.00", //Sa
					"8.30 - 21.00"); //So
$visits=array("12.30 - 15.00 , 19.00 - 21.00", //Mo
					"12.30 - 15.00 , 19.00 - 21.00", //Di
					"12.30 - 15.00 , 19.00 - 21.00", //Mi
					"12.30 - 15.00 , 19.00 - 21.00", //Do
					"12.30 - 15.00 , 19.00 - 21.00", //Fr
					"12.30 - 15.00 , 19.00 - 21.00", //Sa
					"12.30 - 15.00 , 19.00 - 21.00"); //So

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> Pflege</TITLE>

<script language="javascript">
<!-- 
var urlholder;
function gotostat(station){
	urlholder="pflege-station.php?station=" + station + "&sid=<?php echo $$ck_sid_buffer.'"' ?>;
	stationwin=window.open(urlholder,station,"width=800,menubar=no,resizable=yes,scrollbars=yes");
	}

function closewin()
{
	location.href='startframe.php?sid=<?php echo $$ck_sid_buffer.'&uid='.$r;?>';
}
// -->
</script>

<?php
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 if($idxreload=="j") echo " onLoad=window.parent.STARTPAGE.location.replace('indexframe.php?uid=".$r."');";?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp; &nbsp; Ausbildung</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/fenszu.gif" border=0  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#999999>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2><b>Ausbildung</b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2><b>Kurzinfo</b></font></td>
      <td><font face="Verdana,arial" size=2><b>Termin(e)</b></font></td>
    </tr>
<?php for ($i=0;$i<sizeof($dept);$i++){
echo '<tr bgcolor=#ffffff><td><font face=verdana,arial size=2> '.$dept[$i].'</td>
		<td><font face=verdana,arial size=2><a href="#"><img '.createComIcon('../','info.gif','0').' alt="Click für mehr Info über die Ausbildung."></a></td>		
		<td><font face=verdana,arial size=2> Info über die Veranstaltung</td>
		<td><font face=verdana,arial size=2><nobr> 12.06.2001 Montag - 14.00 Uhr</td></tr>';
echo "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
 


<p>
<a href="#" onClick=closewin()><img src="../img/close.gif" border=0  alt="Dieses Fenster schliessen." align="middle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top>
<td bgcolor="<?php echo $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
