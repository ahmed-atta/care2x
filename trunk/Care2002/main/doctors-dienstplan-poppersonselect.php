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
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
        /* Load date formatter */
        include_once('../include/inc_date_format_functions.php');
        

        // get orig data

	  		$dbtable='care_doctors_dept_personell_quicklist';
		 	$sql="SELECT list FROM $dbtable 
					WHERE dept='$dept'
					ORDER BY year DESC";
			//echo $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0); //reset the variable
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

$wkday=date("w",mktime(0,0,0,$month,$elemid+1,$year));
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $LDInfo4Duty ?></TITLE>

<script language="javascript">

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



<?php

function weekday($daynum,$mon,$yr){
		$jd=gregoriantojd($mon,$daynum,$yr);
		switch(JDDayOfWeek($jd,0))
			{
				case 0: return "<font color=red>Sonntag</font>";
				case 1: return "Montag";
				case 2: return "Dienstag";
				case 3: return "Mittwoch";
				case 4: return "Donnerstag";
				case 5: return "Freitag";
				case 6: return "Samstag";
			}
	}

?>

</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  LINK="navy" VLINK="navy" onLoad="if (window.focus) window.focus()" >

<font face=verdana,arial size=4 color=maroon>
<b>
<?php echo $LDDutyPlan ?><br>
<?php if ($mode=="a") echo '<font color="#006666">'.$LDDoc1.'</font>'; else echo $LDDoc2;
echo ' '.$LDOn.'<br>';

 echo '<font color=navy>';
/* if($month<10) echo '0'.$month; else echo $month;
*/
 echo formatDate2Local($year.'-'.$month.'-'.($elemid+1),$date_format);

 echo '</font> '.$LDFullDay[$wkday]; 
?>
</b>
</font>
<p>

<?php
if($datafound)
{
    echo '<ul>
	    <font face="verdana,arial" size=2>';

    //echo $pdata['list'];
    $pbuf=explode("~",$pdata['list']);
    for ($i=0;$i<sizeof($pbuf);$i++)
    {
	    parse_str(trim($pbuf[$i]),$persons);
	    echo '
	    <a href="#" onClick="addelem(\''.$mode.$elemid.'\',\'h'.$mode.$elemid.'\',\''.ucfirst($persons[l]).'\',\''.ucfirst($persons[f]).'\',\''.ucfirst($persons[b]).'\')">
	    <img ';
	    if ($mode=="a") echo createComIcon('../','mans-gr.gif','0') ; else echo  createComIcon('../','mans-red.gif','0');
	    echo '> '.ucfirst($persons[l]).', '.ucfirst($persons[f]).'</a>
	    <br>';
    }
    echo '
	</font></ul>';
}
else
{
    echo '<form><font face="verdana,arial" size=2>
    <img '.createMascot('../','mascot1_r.gif','0','left').'  > '.$LDNoPersonList.'
    <p>
    <input type="button" value="'.$LDCreatePersonList.'" onClick="window.opener.location.href=\'doctors-dienst-personalliste.php?sid='.$sid.'&lang='.$lang.'&dept='.$dept.'&pmonth='.$month.'&pyear='.$year.'&retpath='.$retpath.'&ipath=plan\';window.opener.focus();window.close();">
    </form>';
}
?>
<p><br>
<a href="javascript:closethis()"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWindow ?>"></a>

</BODY>

</HTML>
