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
$local_user='ck_doctors_dienstplan_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php'); // load color preferences

$filename="../global_conf/$lang/doctors_abt_list.pid";
if (file_exists($filename))
{
	$abtname=get_meta_tags($filename);
}	

$thisfile='doctors-dienst-personalliste.php';

/************** resolve dept only *********************************/
require('../include/inc_resolve_dept_dept.php');


switch($ipath)
{
	case 'menu': $rettarget="aerzte.php?sid=".$sid."&lang=".$lang; break;
	case 'qview': $rettarget="doctors-dienst-schnellsicht.php?sid=$sid&lang=$lang&hilitedept=$dept"; break;
	case 'plan': $rettarget="doctors-dienstplan-planen.php?sid=$sid&lang=$lang&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; break;
	default: $rettarget="javascript:window.history.back()";
}

$dbtable='care_doctors_dept_personell_quicklist';

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
	/* Load date formatter */
    include_once('../include/inc_date_format_functions.php');
    
	
	// get orig data

	if($mode=='save')
	{
	
	   /* Prepare the data */
		for($i=0;$i<$maxelement;$i++)
		{
			$lx='lastname'.$i;
			$fx='firstname'.$i;
			$bx='bday'.$i;
			$df='dfunk'.$i;
			$dp='dphone'.$i;
			$of='ofunk'.$i;
			$op='ophone'.$i;
			
			$$bx=formatDate2STD($$bx,$date_format);
			
			if($$lx)
			{
				if($dbuf) $dbuf=$dbuf." ~l=".$$lx."&f=".$$fx."&b=".$$bx."&df=".$$df."&dp=".$$dp."&of=".$$of."&op=".$$op;
					else $dbuf="l=".$$lx."&f=".$$fx."&b=".$$bx."&df=".$$df."&dp=".$$dp."&of=".$$of."&op=".$$op;
			}else continue;
		}
         
		/* If data is not empty save it */ 
		if(trim($dbuf)!='')
		{							
		    // check if entry is already existing
		    $sql="SELECT list FROM $dbtable 
						WHERE  dept='$dept'";
						
		    if($ergebnis=mysql_query($sql,$link))
       	    {
			//echo $sql." checked <br>";
			
					$rows=mysql_num_rows($ergebnis);
					if($rows==1)
						{

							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtable SET list='$dbuf'
										WHERE dept='$dept'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//echo $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath&ipath=$ipath");
								}
								else
								{
									echo "$sql <p>$LDDbNoSave";
									exit;
								}//end of else
						}// end of if rows
						else
						{
							$sql="INSERT INTO $dbtable 
									(
										dept,
										year,
										month,
										list,
										create_id,
										create_time
									) 
									VALUES 
									( 
										'$dept',
										'".date('Y')."',
										'".date('m')."',
										'$dbuf',
										'".$HTTP_COOKIE_VARS[$local_user]."',
										NULL
									)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//echo $sql." new insert <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath&ipath=$ipath");
								}
								else echo "<p>".$sql."<p>$LDDbNoSave"; 
						}// end of else	
				}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
		}
	}// end of if(mode==save)
	else
	{
		$sql="SELECT list FROM $dbtable
						WHERE dept='$dept'";

		if($ergebnis=mysql_query($sql,$link))
       	{
			if($rows=mysql_num_rows($ergebnis))
			{
				$result=mysql_fetch_array($ergebnis);
					//echo $sql."<br>file found!";
			}
		}
		else echo "<p>".$sql."<p>$LDDbNoRead"; 
	}
}
  else { echo "$LDDbNoLink<br>"; } 


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}

div.a3 {font-family: arial; font-size: 14; margin-left: 3; margin-right:3; }
.v12 {font-family: verdana; font-size: 12; }
.v12_n {font-family: verdana; font-size: 12; color:#0000cc }

.infolayer {
	position:absolute;
	visibility: hide;
	left: 100;
	top: 10;

}

</style>

<script language="javascript">
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>

</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>

<script language="javascript" src="../js/setdatetime.js"></script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"  >

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG><?php echo $LDDocsList ?> <font color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo strtoupper($abtname[$dept]); ?></font></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>></a><a href="javascript:gethelp('docs_personallist_edit.php')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0','absmiddle') ?>></a><a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc('../','close2.gif','0','absmiddle') ?>></a></td></tr>
<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p>
<ul>

<p><br>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" >
<font face=verdana,arial size=2 >


<table border=0  bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
  <tr>
    <td>
<table border=0  cellspacing=1>
  <tr>
    <td  align=center bgcolor="#cfcfcf" class="v13" colspan=3>&nbsp;</td>
    <td  align=center bgcolor="#cfcfcf" class="v13" colspan=2><font color="#006600">&nbsp;<?php echo $LDDoc1 ?></td>
    <td  align=center bgcolor="#cfcfcf" class="v13" colspan=2><font color="#ff0000">&nbsp;<?php echo $LDDoc2 ?></td>
  </tr>

			<tr bgcolor="#cfcfcf">
<?php for ($i=0;$i<sizeof($LDPerElements);$i++) echo '
   			 <td  align=center class="v12_n">'.$LDPerElements[$i].'</td>';
?>

		  </tr>
<?php 
$pbuf=explode("~",trim($result['list']));
$maxelement=sizeof($pbuf)+2;
if($maxelement<10) $maxelement=10;

			
for($i=0;$i<$maxelement;$i++)
{
parse_str(trim($pbuf[$i]),$bb);
				
echo '
<tr bgcolor="#efefef">
<td class="v12"><input type="text" name="lastname'.$i.'" size=12 maxlength=15 value="'.$bb[l].'">
</td>
<td class="v12"><input type="text" name="firstname'.$i.'" size=12 maxlength=15 value="'.$bb[f].'"></td>
<td class="v12"><input type="text" name="bday'.$i.'" size=9 maxlength=10 ';

if($bb['b']!='') echo 'value="'.formatDate2Local($bb['b'],$date_format).'"';

echo ' onBlur="IsValidDate(this,\''.$date_format.'\')"   onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"></td>
<td class="v12"><input type="text" name="dfunk'.$i.'" size=6 maxlength=6 value="'.$bb[df].'"></td>
<td class="v12"><input type="text" name="dphone'.$i.'" size=15 maxlength=15 value="'.$bb[dp].'"></td>
<td class="v12"><input type="text" name="ofunk'.$i.'" size=6 maxlength=6 value="'.$bb[of].'"></td>
<td class="v12"><input type="text" name="ophone'.$i.'" size=15 maxlength=15 value="'.$bb[op].'"></td>
</tr>';
}
?>

	

</table>
</td>
  </tr>
</table>
<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="maxelement" value="<?php echo $maxelement ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?> alt="<?php echo $LDSave ?>">
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWindow ?>"></a>

</form>
<hr>
<form action=<?php echo $thisfile ?> name="deptform">
<?php echo $LDChgDept ?>
<select name="dept" >
<?php
while(list($x,$v)=each($abtname))
	{
		echo '
		<option value="'.$x.'" ';
		if($dept==$x) echo 'selected';
		echo '>'.$v.'</option>';
	}?>
</select>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="submit" value="<?php echo $LDChange ?>">
</form>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;




</FONT>

</BODY>
</HTML>
