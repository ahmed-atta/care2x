<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
$opabt=get_meta_tags('../global_conf/'.$lang.'/op_tag_dept.pid');

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{
        /* Load date formatter */
        include_once('../include/inc_date_format_functions.php');
        
		
	// get orig data

	  		$dbtable='care_nursing_dept_personell_quicklist';
			
		 	$sql="SELECT list FROM $dbtable 
					WHERE dept='$dept'
					ORDER BY year DESC";
					
			//echo $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				if($rows=mysql_num_rows($ergebnis))
				{
					$datafound=1;
					$pdata=mysql_fetch_array($ergebnis);
					//echo $sql."<br>";
					//echo $rows;
				}
				//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
}
  else { echo "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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
<?php echo "$opabt[$dept] "; 
if ($mode=="a") echo ' <font color="#006666">'.$LDTabElements[1].'</font>'; else echo $LDTabElements[3];
echo " $LDOn <br>";

$iday=$elemid+1;
 echo '<font color=navy>';
 echo formatDate2Local($year.'-'.$month.'-'.$iday,$date_format);
?>
</b>
</font>
<p>

<?php if($datafound)
{
echo '<ul>
	<font face="verdana,arial" size=2>';

//echo $pdata['list'];
$pbuf=explode("~",$pdata['list']);
for ($i=0;$i<sizeof($pbuf);$i++)
{
	parse_str(trim($pbuf[$i]),$persons);
	echo '
	<a href="#" onClick=addelem(\''.$mode.$elemid.'\',\'h'.$mode.$elemid.'\',\''.ucfirst($persons[l]).'\',\''.ucfirst($persons[f]).'\',\''.ucfirst($persons[b]).'\')>
	<img ';
	if ($mode=="a") echo createComIcon('../','mans-gr.gif','0'); else echo createComIcon('../','mans-red.gif','0');
	echo '> '.ucfirst($persons[l]).', '.ucfirst($persons[f]).'</a>
	<br>';
}
echo '
	</font></ul>';
}
else
{
echo '<form><font face="verdana,arial" size=2>
<img '.createMascot('../','mascot1_r.gif','0','left').'  '.$LDNoPersonList.'
<p>
<input type="button" value="'.$LDCreatePersonList.'" onClick="window.opener.location.href=\'op-pflege-dienst-personalliste.php?sid='.$sid.'&lang='.$lang.'&dept='.$dept.'&pmonth='.$month.'&pyear='.$year.'&retpath='.$retpath.'&ipath=plan\';window.opener.focus();window.close();">
</form>

';
}

?>
<p><br>
<a href="javascript:closethis()"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>

</BODY>

</HTML>
