<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$$ck_sid_buffer)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
*/
define("LANG_FILE","or.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
{
	// get orig data

	  		$dbtable="nursing_dept_personell_quicklist";
		 	$sql="SELECT list FROM $dbtable 
					WHERE dept='$dept'
					ORDER BY year DESC";
			//print $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					$pdata=mysql_fetch_array($ergebnis);
					//print $sql."<br>";
					//print $rows;
				}
				//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
}
  else { print "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?php echo "$opabt[$dept]" ?></TITLE>

<script language="javascript">

markflag=0;

function closethis()
{
	window.opener.focus();
	window.close();
}


function addelem(elem,hid,last,first,b)
{
	
	eval("window.opener.document.forms[0].elements[elem].value=last+','+first;");
	eval("window.opener.document.forms[0].elements[hid].value='l='+last+'&f='+first+'&b='+b;");

}
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  background=img/winbg2.gif TEXT="#000000" LINK="navy" VLINK="navy" onLoad="if (window.focus) window.focus()" >

<font face=verdana,arial size=4 color=maroon>
<b>
<?php print "$opabt[$dept] "; 
if ($mode=="a") print ' <font color="#006666">'.$LDTabElements[1].'</font>'; else print $LDTabElements[3];
print " $LDOn <br>";

$iday=$elemid+1;
 print '<font color=navy>';
 if(strlen($iday)<2) print "0$iday."; else print "$iday.";
 if($month<10) print '0'.$month; else print $month;
 print '.'.$year.'</font> '.$tage[date("w",mktime(0,0,0,$month,$iday,$year))]; 
?>
</b>
</font>
<p>

<?php if($datafound)
{
print '<ul>
	<font face="verdana,arial" size=2>';

//print $pdata['list'];
$pbuf=explode("~",$pdata['list']);
for ($i=0;$i<sizeof($pbuf);$i++)
{
	parse_str(trim($pbuf[$i]),$persons);
	print '
	<a href="#" onClick=addelem(\''.$mode.$elemid.'\',\'h'.$mode.$elemid.'\',\''.ucfirst($persons[l]).'\',\''.ucfirst($persons[f]).'\',\''.ucfirst($persons[b]).'\')>
	<img src="../img/mans-';
	if ($mode=="a") print 'gr.gif'; else print 'red.gif';
	print '" border="0"> '.ucfirst($persons[l]).', '.ucfirst($persons[f]).'</a>
	<br>';
}
print '
	</font></ul>';
}
else
{
print '<form><font face="verdana,arial" size=2>
<img src="../img/catr.gif" border=0 width=88 height=80 align=left> '.$LDNoPersonList.'
<p>
<input type="button" value="'.$LDCreatePersonList.'" onClick="window.opener.location.href=\'op-pflege-dienst-personalliste.php?sid='.$sid.'&lang='.$lang.'&dept='.$dept.'&pmonth='.$month.'&pyear='.$year.'&retpath='.$retpath.'&ipath=plan\';window.opener.focus();window.close();">
</form>

';
}

?>
<p><br>
<a href="javascript:closethis()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" alt="<?php echo $LDClose ?>"></a>

</BODY>

</HTML>
