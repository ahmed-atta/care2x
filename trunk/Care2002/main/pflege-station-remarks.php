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
require("../include/inc_config_color.php"); // load color preferences

if ($station=="") { $station="p3a";  }
if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$t_date=$pday.".".$pmonth.".".$pyear;

	$dbtable="nursing_station_patients";
			
	require("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
		{
							$sql="SELECT bed_patient FROM $dbtable WHERE  t_date=\"$t_date\"
																		AND	station=\"$station\"";
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=0;
								while( $result=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
					 				mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									$occup="1";
					 			}
							}
				 			else {print "$sql<p>$LDDbNoRead"; exit;}
							
			if($mode=="save")
			{
				//print $result[bed_patient]."<br>";
				$remarks=strtr($remarks,"_","-");
				$buf1="r=$r&b=$b&n=$n&t=$t&ln=$ln&fn=$fn&g=$g&s=$s&k=$k";
				//print $buf1."<br>";
				$buf1=strtr($buf1,"+"," ");
				$buf3=explode("_",$result[bed_patient]);
				for($i=0;$i<sizeof($buf3);$i++)
				{
					$buf3[$i]=strtr($buf3[$i],"+"," ");
					if(substr_count($buf3[$i],$buf1))
					{
						$buf3[$i]=$buf1."&rem=".strtr($remarks," ","+");
						break;
					}
				}
				$result[bed_patient]=implode("_",$buf3);
				$sql="UPDATE $dbtable SET bed_patient='".addslashes($result[bed_patient])."'
										 WHERE  t_date='$t_date'
										 	AND	station='$station'";
				$ergebnis=mysql_query($sql,$link);
				if($ergebnis)
       				{
							$sql="SELECT bed_patient FROM $dbtable WHERE  t_date=\"$t_date\"
																		AND	station=\"$station\"";
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=0;
								while( $result=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
					 				mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									$occup="1";
					 			}
							}
				 			else {print "$sql<p>$LDDbNoRead"; exit;}
							
					}
				 	else {print "$sql<p>$LDDbNoUpdate"; exit;}
			} // end of if (mode = save)
		}
  		 else { print "$LDDbNoLink<br>"; } 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> <?php echo "$LDNotes $station" ?> </TITLE>

<script language="javascript">
<!-- 
var n=false;
function checkForm()
{
	if(n) return true;
	return false;
}
function setChg()
{
	n=true;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php
require("../include/inc_css_a_hilitebu.php");
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus();<?php if(($mode=="save")&&($occup)) print "window.opener.location.reload();window.focus();"; ?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=4  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php print "$LDNotes ".strtoupper($station)." ($t_date)"; ?> </STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','remarks','','<?php echo $station ?>','<?php echo $LDNotes ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  
<?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul><font face="Verdana, Arial" color=#800000>
<?php if($occup)
{

//print $result[bed_patient];
$buf=explode("_",trim($result[bed_patient]));
	
		for($k=0;$k<sizeof($buf);$k++)
		{
			parse_str(trim($buf[$k]),$helper);
			//foreach($helper as $v) print $v;
			if  ((trim($helper[n])==$pn)&&(trim($helper[fn])==$patient)){  break;} 
			$helper="";
		}
print "<font color=0> ".$LDPatListElements[0].":  $helper[r] $helper[b] - </font>".ucfirst($helper[ln]).", ".ucfirst($helper[fn])." $helper[g]"; 
}
?>
<form method=post name=remform action="pflege-station-remarks.php" onSubmit="return checkForm()">
<textarea name="remarks" cols=60 rows=17 wrap="physical" onKeyup="setChg()"><?php  print str_replace("\\","",$helper[rem]);?></textarea>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="r" value="<?php echo $helper[r] ?>">
<input type="hidden" name="b" value="<?php echo $helper[b] ?>">
<input type="hidden" name="n" value="<?php echo $helper[n] ?>">
<input type="hidden" name="t" value="<?php echo strtr($helper[t]," ","+") ?>">
<input type="hidden" name="ln" value="<?php echo strtr($helper[ln]," ","+") ?>">
<input type="hidden" name="fn" value="<?php echo strtr($helper[fn]," ","+") ?>">
<input type="hidden" name="g" value="<?php echo $helper[g] ?>">
<input type="hidden" name="s" value="<?php echo $helper[s] ?>">
<input type="hidden" name="k" value="<?php echo $helper[k] ?>"><br>
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="patient" value="<?php echo $patient ?>">
<input type="submit" value="<?php echo $LDSave ?>">

</form>

</font>
<p>
<a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0"></a>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</BODY>
</HTML>
