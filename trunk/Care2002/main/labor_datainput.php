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
define("LANG_FILE","lab.php");
$local_user="ck_lab_user";
require("../include/inc_front_chain_lang.php");

if(!$patnum) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../include/inc_config_color.php");

$thisfile="labor_datainput.php";
$breakfile="labor_data_patient_such.php?sid=$sid&lang=$lang&mode=edit&versand=1&keyword=$patnum";

$fielddata="patnum,name,vorname,gebdatum";

require("../include/inc_labor_param_group.php");

						
if($parameterselect=="") $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					
$paramname=$parametergruppe[$parameterselect];

$dbsourcetable="mahopatient";
$dbtargettable="lab_test_data";

$curdate=date("d.m.Y");
$curtime=date("H.i");

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{
		if($mode=="save")
		{
		
				// check if entry is already existing
				$sql="SELECT encoding,tid FROM $dbtargettable WHERE patnum='$patnum' AND job_id='$job_id'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					$nbuf=$parameters[0];
					//print $nbuf."=".$$nbuf." | ";
					if($$nbuf) $dbuf="$nbuf=".$$nbuf." ";
					for($i=1;$i<sizeof($parameters);$i++)
					{
						$nbuf=$parameters[$i];
						if(!$$nbuf) continue;
						//print $nbuf."=".$$nbuf." | ";
						$dbuf.="&$nbuf=".$$nbuf." ";
					}
					
					if(!$test_date) 
					{
						$test_date=date("d.m.Y");
						$test_sortdate=date("Ymd");
					}
					else
					{
						$td=explode(".",$test_date);
						$td=array_reverse($td);
						$test_sortdate=implode("",$td);
					}
					
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
						{
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							$content[encoding].=" ~e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$paramname;
							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtargettable SET $paramname='$dbuf',encoding='$content[encoding]',tid='$content[tid]'
									WHERE patnum='$patnum'
									AND job_id='$job_id'";
								
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
								mysql_close($link);
								header("location:$thisfile?sid=$sid&lang=$lang&saved=1&patnum=$patnum&job_id=$job_id&parameterselect=$parameterselect");
								}
								else {print "<p>$sql$LDDbNoUpdate";}
						} // else create new entry
						else
						{
							//$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata"," <>","+()")."\r\n";
							$sql="INSERT INTO $dbtargettable 
										(
										patnum,
										lastname,
										firstname,
										bday,
										$paramname,
										job_id,
										test_date,
										test_time,
										test_sortdate,
										encoding
										)
									 	VALUES
										(
										'$patnum',
										'$lastname',
										'$firstname',
										'$bday',
										'$dbuf',
										'$job_id',
										'$test_date',
										'".date("H.m")."',
										'$test_sortdate',
										'e=$encoder&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$paramname."'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new insert <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&patnum=$patnum&job_id=$job_id&parameterselect=$parameterselect");
								}
								else {print "<p>$sql$LDDbNoSave";}
						}//end of else
					} // end of if ergebnis
		 }// end of if(mode==save)
		 else
		 {
			if($saved||$job_id&&!$newid)	$sql="SELECT patnum,lastname,firstname,bday,$paramname,test_date FROM $dbtargettable WHERE patnum='$patnum' AND job_id='$job_id'";
				else $sql="SELECT $fielddata FROM $dbsourcetable WHERE patnum='$patnum'";
				//print $sql;
        		if($ergebnis=mysql_query($sql,$link))
				{
					$zeile=mysql_fetch_array($ergebnis);
					if($saved||$job_id&&!$newid)
					{
						$lname=$zeile[lastname];
						$fname=$zeile[firstname];
						$bday=$zeile[bday];
   					}
					else
					{
						$lname=$zeile[name];
						$fname=$zeile[vorname];
						$bday=$zeile[gebdatum];
					}
					$patnum=$zeile[patnum];
				}
			$aufdatum=$curdate;
			$aufzeit=$curtime;	
			$encoder=$aufnahme_user;			
		//	while(list($x,$v)=each($zeile)) print $v." ";
		 }
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }


// print "from table ".$linecount;





 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Laborwerte Eingabe</TITLE>

<script language="javascript" name="j1">
<!--
        

        function wopenTEST() 
        {       window.open("ucons.php","Realtime4free","width=400,height=590,locationbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,copyhistory=yes,screenX=400,screenY=20,left=400,top=20" );
        }
        function wopen()
        {       window.open("ucons.php", "RealtimeQuoteCenter", "resizable=no,width=780,height=470,locationbar=no,menubar=no,status=no" );
        }
        function openMarktradar()
        {
                winNeu('ucons.php','http://diraba.teledata.de/dab/marketview.html?nick=&sessionid=lurker&nh=0&checksum=',625,480);
        }
        function openPRWin(address, width, height)
        {
                window.open("ucons.php", "Preisrechner", "width=" + width + ",height=" + height);
        }
        
function pruf(d)
{
	if(!d.job_id.value)
		{ alert("<?php echo $LDAlertJobId ?>"); return false;}
		else
		{
			if(!d.test_date.value)
			{ alert("<?php echo $LDAlertTestDate ?>"); return false;}
				else return true;
		} 
}
function chkselect(d)
{
 	if(d.parameterselect.selectedIndex==<?php echo $parameterselect ?>) return false;
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

<script language="javascript" src="../js/setdatetime.js">
</script>

<?php 
require("../include/inc_css_a_hilitebu.php");
?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php
if($newid) print ' onLoad="document.datain.test_date.value=\'h\';setDate(document.datain.test_date);" ';
 if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php if($update) print "$LDLabReport - $LDEdit"; else print "$LDNew $LDLabReport"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab.php','input','main','<?php echo $job_id ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td  bgcolor=#dde1ec><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">


<form method="post" action="<?php print $thisfile; ?>" onSubmit="return pruf(this)" name="datain">

<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php print $patnum; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php print  $lname; ?>, <?php print  $fname; ?>&nbsp;&nbsp;<?php print  $bday; ?></b>
</td>
</tr>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDJobIdNr ?>:
</td>
<td  bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php if($saved||$job_id)
print $job_id.'
<input type=hidden name=job_id value="'.$job_id.'">';
else print ' 
<input name="job_id" type="text" size="14" >';
?>
</td>
</tr>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDExamDate ?>
</td>
<td  bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php if($saved||$zeile[test_date])
print $zeile[test_date].'
<input type=hidden name=test_date value="'.$zeile[test_date].'">'; 
else print ' 
<input name="test_date" type="text" size="14" onKeyUp="setDate(this)")>';
?>
</td>
</tr><?php if($newid) 
/*
print '
<tr>
<td  bgcolor="#ffffff" ><FONT SIZE=-1  FACE="Arial">&nbsp;Untersuchungsdatum
</td>
<td bgcolor="#ffffee" >
<input name="test_date" type="text" size="14" >
</td>
</tr>';*/
?>
</table>
<table border=0 bgcolor=#ffdddd cellspacing=1 cellpadding=1>
<tr>
<td  bgcolor=#ff0000 colspan=2><FONT SIZE=2  FACE="Verdana,Arial" color="#ffffff">
<b><?php print strtr($parametergruppe[$parameterselect],"_","-"); ?></b>
</td>
</tr>
<tr>
<td  colspan=2>


<table border="0" cellpadding=0 cellspacing=1>



<?php if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
In <font color=red>rot</font> gekennzeichnet<?php if ($errornum>1) print "en"; else print "em"; ?>&nbsp;
Feld<?php if ($errornum>1) print "ern"; ?>&nbsp;
fehl<?php if ($errornum>1) print "en"; else print "t eine"; ?>&nbsp;
Information<?php if ($errornum>1) print "en"; ?>!
</center>
</td>
</tr>
<?php endif; ?>


<?php 
$paramnum=sizeof($parameters);

$pcols=ceil($paramnum/15);
//print $pcols;
//if($paramnum<=10) $count=$paramnum; else $count=10;
if($pcols>1)
{
	$pbuf=$parameters;
	while(sizeof($pbuf))
	{
		$param[]=array_splice($pbuf,0,15);
	}
	$paramnum=15;
}
else $param[]=$parameters;

print '<tr>';

if($zeile[$paramname])  parse_str($zeile[$paramname],$pdata);


for($j=0;$j<$pcols;$j++)
print '
<td class="a10_n">&nbsp;'.$LDParameter.'</td>
<td  class="a10_n">&nbsp;'.$LDValue.'</td>';
print '
	</tr>';

//$count=$paramnum;
for ($n=0;$n<$paramnum;$n++)
 {
	print '
	<tr>';
	for($j=0;$j<$pcols;$j++)
	{
			print '<td';

			 print ' bgcolor="#ffffee" class="a10_b"><nobr>&nbsp;<b>'.strtr($param[$j][$n],"_~",". ").'</b>&nbsp;</nobr>';

			print '</td>
			<td>';
			if ($param[$j][$n]){
				 print '<input name="'.$param[$j][$n].'" type="text" size="8" ';

	 			print 'value="'.trim($pdata[($param[$j][$n])]).'"';

				print '>';
			}
			print'&nbsp;
			</td>';
	}
	
	print '
	</tr>';
 }

?>
</table>
</td>
</tr>
<tr>
<td>
<input  type="image" src="../img/<?php echo "$lang/$lang" ?>_savedisc.gif" border=0> 
</td>

<td align=right><a href="<?php echo $breakfile ?>">
<?php if($saved) print '<img src="../img/'.$lang.'/'.$lang.'_close2.gif" border="0">';
else print '<img src="../img/'.$lang.'/'.$lang.'_cancel.gif" border="0">'; ?>
</a>
</td>
</tr>
</table>
<input type=hidden name=parameterselect value=<?php print $parameterselect; ?>>
<input type=hidden name=patnum value="<?php print $zeile[patnum]; ?>">
<input type=hidden name=lastname value="<?php print $zeile[name]; ?>">
<input type=hidden name=firstname value="<?php print $zeile[vorname]; ?>">
<input type=hidden name=bday value="<?php print $zeile[gebdatum]; ?>">
<input type=hidden name=sid value="<?php print $sid; ?>">
<input type=hidden name=lang value="<?php print $lang; ?>">
<input type=hidden name=update value="<?php print $update; ?>">
<input type=hidden name=newid value="<?php print $newid; ?>">
<input type=hidden name=mode value="save">
</form>

<form action=<?php print $thisfile; ?> method=post onSubmit="return chkselect(this)" name="paramselect">
<table border=0>
<tr>
<td colspan=3><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDSelectParamGroup ?></b>
</td>
</tr>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDParamGroup ?>:
</td>

<td >
<select name=parameterselect size=1>
<?php for ($i=0;$i<sizeof($parametergruppe);$i++)
      {
		print '<option value="'.$i.'"';
		if($parameterselect==$i) print ' selected';
		print '>'.$parametergruppe[$i].'</option>';
		print "\n";
	  }	
?>
</select>
</td>

<td>
<input type=hidden name=patnum value="<?php print $zeile[patnum]; ?>">
<input type=hidden name=job_id value="<?php print $job_id; ?>">
<input type=hidden name=sid value="<?php print $sid; ?>">
<input type=hidden name=lang value="<?php print $lang; ?>">
<input type=hidden name=update value="<?php print $update; ?>">
<input type=hidden name=newid value="<?php print $newid; ?>">

<FONT SIZE=-1  FACE="Arial">&nbsp;<input  type="image" src="../img/<?php echo "$lang/$lang" ?>_auswahl2.gif" border=0>
</td>
</tr>
</tr>

</table>
</form>

</ul>
</FONT>
<p>
</td>

<td colspan=2 bgcolor=#ffffee width=20% valign=top>


<table border=0 cellpadding=5 cellspacing=2>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','param')"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDParamNoSee ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','few')"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDOnlyPair ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','save')"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDHow2Save ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','correct')"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDWrongValueHow ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','note')"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDVal2Note ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','done')"><img src="../img/small_help.gif" border="0"></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDImDone ?></td>
</tr>
</table>

</td>
</tr>
</table>        
<p>

<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</BODY>
</HTML>
