<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!$patnum) {header('Location:../language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
require_once($root_path.'include/inc_config_color.php');

$thisfile='labor_datainput.php';
$breakfile="labor_data_patient_such.php?sid=$sid&lang=$lang&mode=edit&versand=1&keyword=$patnum";

$fielddata='patnum,name,vorname,gebdatum';

require($root_path.'include/inc_labor_param_group.php');

						
if($parameterselect=="") $parameterselect=0;

$parameters=$paralistarray[$parameterselect];					
$paramname=$parametergruppe[$parameterselect];

$dbsourcetable='care_admission_patient';
$dbtargettable='care_lab_test_data';

$curdate=date('Y-m-d');
$curtime=date('H:i:s');

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    

		if($mode=='save')
		{
		
				// check if entry is already existing
				$sql="SELECT encoding,tid FROM $dbtargettable WHERE patnum='$patnum' AND job_id='$job_id'";
				if($ergebnis=$db->Execute($sql))
       			{
					//echo $sql." checked <br>";
					$nbuf=$parameters[0];
					//echo $nbuf."=".$$nbuf." | ";
					if($$nbuf) $dbuf="$nbuf=".$$nbuf." ";
					for($i=1;$i<sizeof($parameters);$i++)
					{
						$nbuf=$parameters[$i];
						if(!$$nbuf) continue;
						//echo $nbuf."=".$$nbuf." | ";
						$dbuf.="&$nbuf=".$$nbuf." ";
					}
					
					if(!$test_date) 
					{
						$test_date=date('Y-m-d');
					}
/*					else
					{
						$td=explode('.',$test_date);
						$td=array_reverse($td);
						$test_sortdate=implode("",$td);
					}					
*/					
					
					$rows=0;
					
					/* get the user data */
					$current_user=$HTTP_COOKIE_VARS[$local_user.$sid];
					
					if($rows=$ergebnis->RecordCount())
						{

							$content=$ergebnis->FetchRow();
							
							$content[encoding].=' ~e='.$encoder.'&d='.date('Y-m-d').'&t='.date('H:i:s').'&a='.$paramname;
							
							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtargettable SET $paramname='$dbuf', encoding='".$content['encoding']."', modify_id='$current_user', tid='".$content['tid']."'
									WHERE patnum='$patnum'
									AND job_id='$job_id'";
								
							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new update <br>";
								
								header("location:$thisfile?sid=$sid&lang=$lang&saved=1&patnum=$patnum&job_id=$job_id&parameterselect=$parameterselect");
								}
								else {echo "<p>$sql$LDDbNoUpdate";}
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
										encoding,
										modify_id,
										create_id,
										create_time
										)
									 	VALUES
										(
										'$patnum',
										'$lastname',
										'$firstname',
										'$bday',
										'$dbuf',
										'$job_id',
										'".formatDate2STD($test_date,$date_format)."',
										'".date('H:i:s')."',
										'".date('Ymd')."',
										'e=$encoder&d=".date('Y-m-d')."&t=".date('H:i:s')."&a=".$paramname."',
										'$current_user',
										'$current_user',
										NULL
										)";

							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new insert <br>";
									
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&patnum=$patnum&job_id=$job_id&parameterselect=$parameterselect");
								}
								else {echo "<p>$sql$LDDbNoSave";}
						}//end of else
					} // end of if ergebnis
		 }// end of if(mode==save)
		 
		 /*  If mode is not "save" then get the basic personal data */
		 else 
		 {
			if($saved||$job_id&&!$newid)
			{
				$sql="SELECT patnum,lastname,firstname,bday,$paramname,test_date FROM $dbtargettable WHERE patnum='$patnum' AND job_id='$job_id'";
			}
			 else
			 {
			    $sql="SELECT $fielddata FROM $dbsourcetable WHERE patnum='$patnum'";
			 }
				//echo $sql;
        		if($ergebnis=$db->Execute($sql))
				{
					$zeile=$ergebnis->FetchRow();
					if($saved||$job_id&&!$newid)
					{
						$lname=$zeile['lastname'];
						$fname=$zeile['firstname'];
						$bday=$zeile['bday'];
   					}
					else
					{
						$lname=$zeile['name'];
						$fname=$zeile['vorname'];
						$bday=$zeile['gebdatum'];
					}
					$patnum=$zeile['patnum'];
				}
			$aufdatum=$curdate;
			$aufzeit=$curtime;	
			$encoder=$aufnahme_user;			
		//	while(list($x,$v)=each($zeile)) echo $v." ";
		 }
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }


// echo "from table ".$linecount;





 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

// -->
</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript">
</script>

<script language="javascript" src="../js/setdatetime.js">
</script>

<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php

/*if($newid) echo ' onLoad="document.datain.test_date.focus();" ';*/
 if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 ?>>

<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php if($update) echo "$LDLabReport - $LDEdit"; else echo "$LDNew $LDLabReport"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab.php','input','main','<?php echo $job_id ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td  bgcolor=#dde1ec><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">


<form method="post" action="<?php echo $thisfile; ?>" onSubmit="return pruf(this)" name="datain">

<!--  Display of the patient's basic personal data -->
<table border=0>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $patnum; ?>&nbsp;
</td>
</tr>

<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo "$LDLastName, $LDName, $LDBday" ?>:
</td>
<td bgcolor=#ffffee><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo  $lname; ?>, <?php echo  $fname; ?>&nbsp;&nbsp;<?php echo formatDate2Local($bday,$date_format); ?></b>
</td>
</tr>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDJobIdNr ?>:
</td>
<td  bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php if($saved||$job_id)
echo $job_id.'
<input type=hidden name=job_id value="'.$job_id.'">';
else echo ' 
<input name="job_id" type="text" size="14" >';
?>
</td>
</tr>
<tr>
<td bgcolor=#ffffff><FONT SIZE=-1  FACE="Arial"><?php echo $LDExamDate ?>
</td>
<td  bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php 
if($saved || $zeile['test_date'])
{
   echo formatDate2Local($zeile['test_date'],$date_format).' <input type=hidden name=test_date value="'.$zeile['test_date'].'">';
} 
else 
{
   echo '<input name="test_date" type="text" size="14" value="'.formatDate2Local(date('Y-m-d'),$date_format).'" onBlur="IsValidDate(this,\''.$date_format.'\')")>';
}
?>
</td>
</tr><?php if($newid) 
/*
echo '
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
<b><?php echo strtr($parametergruppe[$parameterselect],"_","-"); ?></b>
</td>
</tr>
<tr>
<td  colspan=2>


<table border="0" cellpadding=0 cellspacing=1>



<?php if($error) : ?>
<tr bgcolor=#ffffee>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
In <font color=red>rot</font> gekennzeichnet<?php if ($errornum>1) echo "en"; else echo "em"; ?>&nbsp;
Feld<?php if ($errornum>1) echo "ern"; ?>&nbsp;
fehl<?php if ($errornum>1) echo "en"; else echo "t eine"; ?>&nbsp;
Information<?php if ($errornum>1) echo "en"; ?>!
</center>
</td>
</tr>
<?php endif; ?>


<?php 
$paramnum=sizeof($parameters);

$pcols=ceil($paramnum/15);
//echo $pcols;
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

echo '<tr>';

if($zeile[$paramname])  parse_str($zeile[$paramname],$pdata);


for($j=0;$j<$pcols;$j++)
echo '
<td class="a10_n">&nbsp;'.$LDParameter.'</td>
<td  class="a10_n">&nbsp;'.$LDValue.'</td>';
echo '
	</tr>';

//$count=$paramnum;
for ($n=0;$n<$paramnum;$n++)
 {
	echo '
	<tr>';
	for($j=0;$j<$pcols;$j++)
	{
			echo '<td';

			 echo ' bgcolor="#ffffee" class="a10_b"><nobr>&nbsp;<b>'.strtr($param[$j][$n],"_~",". ").'</b>&nbsp;</nobr>';

			echo '</td>
			<td>';
			if ($param[$j][$n]){
				 echo '<input name="'.$param[$j][$n].'" type="text" size="8" ';

	 			echo 'value="'.trim($pdata[($param[$j][$n])]).'"';

				echo '>';
			}
			echo'&nbsp;
			</td>';
	}
	
	echo '
	</tr>';
 }

?>
</table>
</td>
</tr>
<tr>
<td>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>> 
</td>

<td align=right><a href="<?php echo $breakfile ?>">
<?php if($saved) echo '<img '.createLDImgSrc($root_path,'close2.gif','0').'>';
else echo '<img  '.createLDImgSrc($root_path,'cancel.gif','0').'>'; ?>
</a>
</td>
</tr>
</table>
<input type=hidden name="parameterselect" value=<?php echo $parameterselect; ?>>
<input type=hidden name="patnum" value="<?php echo $zeile['patnum']; ?>">
<input type=hidden name="lastname" value="<?php echo $zeile['name']; ?>">
<input type=hidden name="firstname" value="<?php echo $zeile['vorname']; ?>">
<input type=hidden name="bday" value="<?php echo $zeile['gebdatum']; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="update" value="<?php echo $update; ?>">
<input type=hidden name="newid" value="<?php echo $newid; ?>">
<input type=hidden name="mode" value="save">
</form>

<form action=<?php echo $thisfile; ?> method=post onSubmit="return chkselect(this)" name="paramselect">
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
		echo '<option value="'.$i.'"';
		if($parameterselect==$i) echo ' selected';
		echo '>'.$parametergruppe[$i].'</option>';
		echo "\n";
	  }	
?>
</select>
</td>

<td>
<input type=hidden name="patnum" value="<?php echo $zeile[patnum]; ?>">
<input type=hidden name="job_id" value="<?php echo $job_id; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="update" value="<?php echo $update; ?>">
<input type=hidden name="newid" value="<?php echo $newid; ?>">

<FONT SIZE=-1  FACE="Arial">&nbsp;<input  type="image" <?php echo createLDImgSrc($root_path,'auswahl2.gif','0') ?>>
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
<td valign=top><a href="Javascript:gethelp('lab.php','input','param')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDParamNoSee ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','few')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDOnlyPair ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','save')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDHow2Save ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','correct')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDWrongValueHow ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','note')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDVal2Note ?></td>
</tr>
<tr>
<td valign=top><a href="Javascript:gethelp('lab.php','input','done')"><img <?php echo createComIcon($root_path,'small_help.gif','0') ?>></a></td>
<td><FONT SIZE=1  FACE="Arial"><?php echo $LDImDone ?></td>
</tr>
</table>

</td>
</tr>
</table>        
<p>

<hr>
<?php
if(file_exists($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');
?>

</BODY>
</HTML>
