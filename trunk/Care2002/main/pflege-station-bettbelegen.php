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
require("../include/inc_config_color.php");

$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
// init sql dbase 

$dbtable="mahopatient";

$fieldname=array($LDPatListElements[4],$LDLastName,$LDName,$LDBirthDate);
			
$fielddata="patnum, 
		name, 
		vorname, 
		gebdatum";

if(($pnum=="")&&($name=="")&&($vname=="")&&($gdatum=="")) $mode="";

if(is_numeric($pnum)) $pnum=(int)$pnum;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?php echo $LDAssignOcc ?></TITLE>


<script language="javascript">
<!-- 
var urlholder;

function initwindow(){
	 	if (window.focus) window.focus();
		window.resizeTo(700,450);
		}

function enlargewin(){
	//window.moveTo(0,0);
	 window.resizeTo(700,600);
	}

function belegen(anum)
	{
		if((anum=="lock")&&(!confirm("<?php echo $LDConfirmLock ?>")))  return;

             <?php
            print '
	          urlholder="pflege-station.php?mode=newdata&sid='.$sid.'&lang='.$lang.'&station='.$s.'&rm='.$rm.'&bd='.$bd.'&pyear='.$py.'&pmonth='.$pm.'&pday='.$pd.'&patnum="+anum;
	               ';
             ?>
	          window.opener.location.replace(urlholder);
	          window.close();
	}
	
function pruf(d)
	{
		if ((d.pnum.value=="")&&(d.name.value=="")&&(d.vname.value=="")&&(d.gdatum.value=="")) return false;
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
<?php if($d)
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>';
}
?>
</HEAD>

<BODY bgcolor=white  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 link="#800080" vlink="#800080" onLoad="if (window.focus) window.focus();document.psearch.pnum.select();">
<table width=100% border=0 cellpadding="5" cellspacing=0 >
<tr>
<td bgcolor="<?php print "#".$tb; ?>" >
<FONT  COLOR="<?php print "#".$tt; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php print "$LDAssignOcc $s"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_station.php','assign','','<?php echo $s ?>','<?php echo $LDAssignOcc ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close();" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td colspan=2>
<font face=verdana,arial ><?php echo $LDPatListElements[0] ?>: <b><?php print $rm; ?></b> &nbsp;<?php echo $LDPatListElements[1] ?>: <b><?php print $bd; ?></b>&nbsp;
<a href="javascript:belegen('lock')" title="<?php echo $LDClk2LockBed ?>"><img src="../img/delete2.gif" border=0 width=20 height=20 alt="<?php echo $LDClk2LockBed ?>" align="absmiddle"><?php echo $LDLockThisBed ?></a>
<p>
 <ul>
 
 <form action="pflege-station-bettbelegen.php" method="post" name="psearch" onSubmit="return pruf(this)">
 <table border=0 cellspacing=0 cellpadding=1>
   <tr>
     <td bgcolor=#0>
	 
	 <table border=0 bgcolor=#ffffcc cellspacing=0>
 		 <tr>
	    <td align=right><font face=verdana,arial size=2><?php echo $LDPatListElements[4] ?>:</td>
	    <td><input type="text" name="pnum" size=20 maxlength=20 value=<?php echo $pnum; ?>>
   	     </td>		  
			 <td>&nbsp;
	       </td>
		  </tr>
		  <tr>
		    <td align=right><font face=verdana,arial size=2><?php echo $LDLastName ?>:</td>
 		   <td><input type="text" name="name" size=40 maxlength=40 value=<?php echo $name; ?>>
  	      </td>		  
			 <td>&nbsp;
	       </td>
 	 </tr>
	  <tr>
 	   <td align=right><font face=verdana,arial size=2><?php echo $LDName ?>:</td>
	    <td><input type="text" name="vname" size=40 maxlength=40 value=<?php echo $vname; ?>>
	        </td>		  
			 <td>&nbsp;
	       </td>
	  </tr>
	  <tr>
	    <td align=right><font face=verdana,arial size=2><?php echo $LDBirthDate ?>:</td>
 	   <td><input type="text" name="gdatum" size=20 maxlength=20 value=<?php echo $gdatum; ?>>
 	       </td>
		   <td><input type="reset" value="<?php echo $LDReset ?>">
	       </td>
	  </tr>
	</table>
</td>
   </tr>
 </table>
  
 <input type="hidden" name="sid" value="<?php print $sid; ?>">
 <input type="hidden" name="lang" value="<?php print $lang; ?>">
 <input type="hidden" name="tb" value="<?php print $tb; ?>">
 <input type="hidden" name="tt" value="<?php print $tt; ?>">
 <input type="hidden" name="bb" value="<?php print $bb; ?>">
 <input type="hidden" name="s" value="<?php print $s; ?>">
 <input type="hidden" name="rm" value="<?php print $rm; ?>">
 <input type="hidden" name="bd" value="<?php print $bd; ?>">
 <input type="hidden" name="py" value="<?php print $py; ?>">
 <input type="hidden" name="pm" value="<?php print $pm; ?>">
 <input type="hidden" name="pd" value="<?php print $pd; ?>">
 <input type="hidden" name="d" value="<?php print $d; ?>">                                                      
 <input type="hidden" name="mode" value="search">
  <p>
<input type="image" src="../img/<?php echo "$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 alt="<?php echo $LDSearchPatient ?>" align="absmiddle">
</FONT>
 </form>
 <a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0></a>
</ul>

<?php
if($mode=="search")
{
	$pnum=trim($pnum);
	if(is_numeric($pnum)) $pnum=(int)$pnum;
	$name=trim($name);
	$vname=trim($vname);
	$gdatum=trim($gdatum);
	$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE name LIKE "'.$name.'%" AND vorname LIKE "'.$vname.'%" AND patnum LIKE "'.$pnum.'%" AND gebdatum LIKE "'.$gdatum.'%" AND discharge_date=""';
	//$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE name LIKE "'.$name.'%" AND vorname LIKE "'.$vname.'%" AND patnum LIKE "'.$pnum.'%" AND gebdatum LIKE "'.$gdatum.'%"';
//	if(($name==NULL)||($name==""))	$sql=str_replace('name LIKE "'.$name.'%" AND','',$sql);
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK)
		{
        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				print "<hr><ul>".str_replace("~nr~",$linecount,$LDSearchFound).$LDPlsClk."<br>\r\n";
				if ($linecount>0) 
				{ 
					mysql_data_seek($ergebnis,0);
					print "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=orange>\r\n";
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						print"<td><font face=arial size=2><b>".$fieldname[$i]."</b></td>\r\n";
		
					}
					print "</tr>\r\n";
					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#cecece>"; $toggle=0;} else {print "#ffffaa>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis);$i++) 
						{
							print"<td><font face=arial size=2>";
							if($zeile[$i]=="")print "&nbsp;"; else print $zeile[$i];
							print "</td>\r\n";

						}	
						print "<td><a href=\"javascript:belegen('".$zeile['patnum']."')\"><button onClick=\"javascript:belegen('".$zeile['patnum']."')\"><img src=\"../img/post_discussion.gif\" width=20 height=20 border=0 alt=\"$LDAssign2Bed\"></button></a></td>\r\n";
						print "</tr>\r\n";
					}
					print "</table></ul>";
					print "
								<script language='javascript'>window.resizeTo(700,600);</script>
							";
								
				}
			}
			 else {print "<p>$sql$LDDbNoRead";exit;}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }

}
?>

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
