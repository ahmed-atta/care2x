<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','or.php');
if($HTTP_SESSION_VARS['sess_user_origin']=='personell_admin'){
	$local_user='aufnahme_user';
	if(!isset($saved)||!$saved){
		$mode='search';
		$searchkey=$nr;
	}
	$breakfile=$root_path.'modules/personell_admin/personell_register_show.php'.URL_APPEND.'&target=personell_reg&personell_nr='.$nr;
}else{
	$local_user='ck_op_dienstplan_user';
	$breakfile='javascript:history.back()';
}

require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php'); // load color preferences

$filename="../global_conf/$lang/op_tag_dept.pid";
$opabt=get_meta_tags($filename);
$thisfile="op-pflege-dienst-personalliste.php";
switch($ipath)
{
	case "menu": $rettarget="op-doku.php?sid=".$sid."&lang=".$lang; break;
	case "qview": $rettarget="op-pflege-dienst-schnellsicht.php?sid=$sid&lang=$lang&hilitedept=$dept"; break;
	case "plan": $rettarget="op-pflege-dienstplan-planen.php?sid=$sid&lang=$lang&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; break;
	default: $rettarget="javascript:window.history.back()";
}
/********************************* Resolve the or department  only ***********************/
$saal="exclude";
require($root_path.'include/inc_resolve_opr_dept.php');

$dbtable="care_nursing_dept_personell_quicklist";

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
	{	
	// get orig data

		if($mode=='save')
		{
					
				// check if entry is already existing
				$sql="SELECT list FROM $dbtable 
						WHERE  dept='$dept'";
						
				if($ergebnis=$db->Execute($sql))
       			{
					//echo $sql." checked <br>";
					for($i=0;$i<$maxelement;$i++)
					{
						$lx="lastname".$i;
						$fx="firstname".$i;
						$bx="bday".$i;
						$df="dfunk".$i;
						$dp="dphone".$i;
						$of="ofunk".$i;
						$op="ophone".$i;
						if($$lx)
						{
							 if($dbuf) $dbuf=$dbuf." ~l=".$$lx."&f=".$$fx."&b=".$$bx."&df=".$$df."&dp=".$$dp."&of=".$$of."&op=".$$op;
								else $dbuf="l=".$$lx."&f=".$$fx."&b=".$$bx."&df=".$$df."&dp=".$$dp."&of=".$$of."&op=".$$op;
						}else continue;
					}
					
					$rows=0;
					if( $content=$ergebnis->FetchRow()) $rows++;
					if($rows==1)
						{

							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtable SET list='$dbuf'
										WHERE dept='$dept'";
											
							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new update <br>";
									
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath&ipath=$ipath");
								}
								else
								{
									echo "<p>".$sql."<p>$LDDbNoSave"; 
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
										src_date
									) 
									VALUES 
									( 
										'$dept',
										'".date(Y)."',
										'".date(m)."',
										'$dbuf',
										'".date(Ymd)."'
									)";

							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new insert <br>";
									
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath&ipath=$ipath");
								}
								else echo "<p>".$sql."<p>$LDDbNoSave"; 
						}// end of else	
				}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
		 }// end of if(mode==save)
		 else
		 {
		 	$sql="SELECT list FROM $dbtable
						WHERE dept='$dept'";

			if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $result=$ergebnis->FetchRow()) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=$ergebnis->FetchRow();
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
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"  >


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG>
&nbsp;<?php echo "$LDCreatePersonList - $opabt[$dept]"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img
 <?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?>></a><a 
 href="javascript:gethelp('op_duty.php','personlist','<?php echo $rows ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>></a><a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?>></a></td>
</tr>
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
    <td  align=center bgcolor="#cfcfcf" class="v13" colspan=3><font color="#ff0000">&nbsp;</td>
    <td  align=center bgcolor="#cfcfcf" class="v13" colspan=2><font color="#006600">&nbsp;<b><?php echo $LDStandbyPerson ?></b></td>
    <td  align=center bgcolor="#cfcfcf" class="v13" colspan=2><font color="#ff0000">&nbsp;<b><?php echo $LDOnCallPerson ?></b></td>
  </tr>

			<tr bgcolor="#cfcfcf">
   			 <td  align=center class="v12_n"><?php echo $LDLastName ?></td>
   			 <td  align=center class="v12_n"><?php echo $LDName ?></td>
   			 <td  align=center class="v12_n"><?php echo $LDBday ?></td>
   			 <td  align=center class="v12_n"><?php echo $LDBeeper ?></td>
   			 <td  align=center class="v12_n"><?php echo $LDPhone ?></td>
   			 <td  align=center class="v12_n"><?php echo $LDBeeper ?></td>
   			 <td  align=center class="v12_n"><?php echo $LDPhone ?></td>
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
<td class="v12"><input type="text" name="bday'.$i.'" size=9 maxlength=10 value="'.$bb[b].'"></td>
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
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<input type="hidden" name="maxelement" value="<?php echo $maxelement ?>">
<input type="hidden" name="mode" value="save">
<a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSave ?>" border=0 width=99 height=24>
</form>
<hr>
<form action=<?php echo $thisfile ?> name="deptform">
<?php echo $LDChangeDept ?>: 
<select name="dept"  onChange="document.deptform.submit()">
<?php
while(list($x,$v)=each($opabt))
{
	echo '
		<option value="'.$x.'" ';
		if($dept==$x) echo 'selected';
		echo '>'.$v.'</option>';
}
?>
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
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
