<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_edvzugang_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_edp.php");

require("../req/config-color.php");
require("../global_conf/$lang/accessplan-areas_".$lang.".php");

$breakfile="edv.php?sid=$ck_sid&lang=$lang";
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<HTML>
	<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
<? 
require("../req/css-a-hilitebu.php");
?>

<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
	
	</HEAD>

	<BODY bgcolor=<? print $cfg['bot_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


	<table width=100% border=0 cellspacing=0>
	<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?="$LDEDP $LDManageAccess" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('edp.php','access','<?=$mode ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
	<tr bgcolor=<? print $cfg['body_bgcolor']; ?> >
	<td colspan=2><p><br>
	<ul>


<?

$error=0;
$errorname=0;
$erroruser=0;
$errorpass=0;
$errorbereich=0;


$curdate=date("Y.m.d");
$curtime=date("H.i");

if ($mode=="save")
 {
	//remove spaces
	$username=trim($username);
	$userid=trim($userid);
	$pass=trim($pass);	

	// start checking input data
	if ($username==""){ $error=1; $errorname=1;};
	if ($userid==""){$error=1; $erroruser=1;};
	if ($pass==""){$error=1; $errorpass=1;};
	if (($bereich1=="")and($bereich2=="")and($bereich3=="")and
		($bereich4=="")and($bereich5=="")and($bereich6=="")and($bereich7==""))
		{ $error=1; $errorbereich=1;};

	if($error==0) 
	{	
		print "<table bgcolor=aqua border=1 cellpadding=10 cellspacing=1>
				<tr>
				<td colspan=3><FONT    SIZE=-1  FACE=Arial>";
				
				include("../req/db-makelink.php");
				if($link&&$DBLink_OK) 
					{	

						$sql="INSERT INTO mahopass 
						(	mahopass_name, 
							mahopass_id, 
							mahopass_password, 
							mahopass_area1, 
							mahopass_area2,
							mahopass_area3,
							mahopass_area4,
							mahopass_area5,
							mahopass_area6,
							mahopass_area7,
							mahopass_area8,
							mahopass_area9,
							mahopass_area10,
							mahopass_date,
							mahopass_time,
							mahopass_encoder ) 
						VALUES (
							'$username', 
							'$userid', 
							'$pass', 
							'$bereich1', 
							'$bereich2', 
							'$bereich3', 
							'$bereich4', 
							'$bereich5', 
							'$bereich6', 
							'$bereich7', 
							'$bereich8', 
							'$bereich9', 
							'$bereich10',
							'$curdate', 
							'$curtime',
							'$ck_edvzugang_user')";

						if(mysql_query($sql,$link)){ echo mysql_affected_rows()." $LDDataSaved <p>"; 
						print $LDAccessIndex[0].": ".$username."<br>";
						print $LDAccessIndex[1].": ".$userid."<br>";
						print $LDAccessIndex[2].": ".$pass."<br>";
						print $LDAccessIndex[4].": <br>";
						if($bereich1!="") print "$LDArea 1: ".$bereich1."<br>";
						if($bereich2!="") print "$LDArea 2: ".$bereich2."<br>";
						if($bereich3!="") print "$LDArea 3: ".$bereich3."<br>";
						if($bereich4!="") print "$LDArea 4: ".$bereich4."<br>";
						if($bereich5!="") print "$LDArea 5: ".$bereich5."<br>";
						if($bereich6!="") print "$LDArea 6: ".$bereich6."<br>";
						if($bereich7!="") print "$LDArea 7: ".$bereich7."<br>";
						if($bereich8!="") print "$LDArea 8: ".$bereich8."<br>";
						if($bereich9!="") print "$LDArea 9: ".$bereich9."<br>";
						if($bereich10!="") print "$LDArea 10: ".$bereich10."<br>";

					}
					else { print "$LDDbNoSave<br>$sql"; } 
				}
  		 		else { print "$LDDbNoLink<br>$sql"; } 

		print '
				</td>
				</tr>
				</table>
				<FONT    SIZE=-1  FACE=Arial>
				<p>
				<FORM method="get" action="edv-accessplan-edit.php">
				<input type="hidden" name="route" value="validroute">
				<input type="hidden" name="sid" value="'.$ck_sid.'">
				<input type="hidden" name="lang" value="'.$lang.'">
				<INPUT type="submit"  value="'.$LDOK.'"></font></FORM>
				<p>
				<FORM method="get" action="edv-accessplan-list.php">
				<input type="hidden" name="route" value="validroute">
				<input type="hidden" name="sid" value="'.$ck_sid.'">
				<input type="hidden" name=lang value="'.$lang.'">
				<INPUT type="submit"  value="'.$LDListActual.'"></font></FORM>
				<p>
				</FONT>';

     };

 }
 
?>


<?
if ($error==1)
{
print "<FONT  COLOR=red  SIZE=+1  FACE=Arial>$LDInputError<p>";
}

?>

<FONT    SIZE=3  FACE="Arial" color="#990000">

<? if ((($error==1)and($mode=="save"))or(($error==0)and($mode==""))) :; ?>

<?
if(($mode=="")and($remark!="fromlist")) 
{
if ($curtime<"9.00") print $LDGoodMorning;
if (($curtime>"9.00")and($curtime<"18.00")) print $LDGoodDay;
if ($curtime>"18.00") print $LDGoodEvening;
print " $ck_edvzugang_user.";
}
?>

<p>
<FORM action="edv-accessplan-list.php" >
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<INPUT type="submit" name=message value="<?=$LDListActual ?>"></font></FORM>
<p>
</FONT>

<form method="post" action="edv-accessplan-edit.php">
<table bgcolor="#dddddd" border="1" cellpadding="5" cellspacing="1">
<tr>
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
<?=$LDNewAccess ?>:
</td>
</tr>
<tr>
<td>
<input type=hidden name=route value=validroute>

<FONT    SIZE=-1  FACE="Arial">
<? if ($errorname) {print "<font color=red > <b>$LDName</b>";} 
else { print $LDName;} ?>

<input name=username type=text

<? if ($username!="") print "value=".$username ; ?>
><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<? if ($erroruser) {print "<font color=red > <b>$LDUserId</b>";} 
else { print $LDUserId;} ?>

<input type=text name=userid
<? if ($userid!="") print "value=".$userid ; ?>
><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<? if ($errorpass) {print "<font color=red > <b>$LDPassword</b>";} 
else { print $LDPassword;} ?>

<input type=text name=pass
<? if ($pass!="") print "value=".$pass ; ?>
><br>
</td>
</tr>
<tr>
<td  colspan=3><FONT    SIZE=-1  FACE="Arial">
<? if ($errorbereich) {print "<font color=red > <b>$LDAllowedArea</b> </font>";} 
else { print $LDAllowedArea;} ?>
</td>
</tr>
<tr>
<td valign=top><FONT    SIZE=-1  FACE="Arial">
<p>
<?=$LDArea ?> 1:
<select name=bereich1 size=1>
<? createselecttable($bereich1) ?>
</select>
<p>
<?=$LDArea ?> 2:
<select name=bereich2 size=1>
<? createselecttable($bereich2) ?>
</select>
<p>
<?=$LDArea ?> 3:
<select name=bereich3 size=1>
<? createselecttable($bereich3) ?>
</select>
<p>
<?=$LDArea ?> 4:
<select name=bereich4 size=1>
<? createselecttable($bereich4) ?>
</select>
<p>
<?=$LDArea ?> 5:
<select name=bereich5 size=1>
<? createselecttable($bereich5) ?>
</select>
<br>
</td>
<td valign=top><FONT    SIZE=-1  FACE="Arial">
<p>
<?=$LDArea ?> 6:
<select name=bereich6 size=1>
<? createselecttable($bereich6) ?>
</select>
<p>
<?=$LDArea ?> 7:
<select name=bereich7 size=1>
<? createselecttable($bereich7) ?>
</select>
<p>
<?=$LDArea ?> 8:
<select name=bereich8 size=1>
<? createselecttable($bereich8) ?>
</select>
<p>
<?=$LDArea ?> 9:
<select name=bereich9 size=1>
<? createselecttable($bereich9) ?>
</select>
<p>
<?=$LDArea ?> 10:
<select name=bereich10 size=1>
<? createselecttable($bereich10) ?>
</select>
<br>
</td>
<td colspan=2 valign="top"><FONT    SIZE=-1  FACE="Arial">
<?=$LDAllowedArea ?>:<p>
Cafe<br>
Labor_Eingabe<br>
Labor_Abfrage<br>
M1, M2, M3, M4, M5, M6, M7, M8, M9<br>
Alle_M_Stationen<br>
P1, P2, P3, P4, P5, P6<br>
Alle_P_Stationen<br>
PLOP_Pflege<br>
PLOP_Aerzte<br>
System_Admin<br>
Technik<br>
</td>
</tr>
<tr>
<td colspan=3><FONT    SIZE=-1  FACE="Arial">
<p>
<input type="hidden" name="itemname" value="<? print $itemname ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="submit" value="<?=$LDSave ?>"> &nbsp;
<input type="reset"  value="<?=$LDReset ?>">
</td>
</tr>
</table>
</form>

<p>
<FORM action="<? if ($ck_edv_admin_user!="") print "edv-system-admi-menu.php"; else print "edv.php"; ?>" >
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<INPUT type="submit"  value="<?=$LDCancel ?>"></font></FORM>
<p>
</FONT>

<? endif; ?>

</ul>
<p>
</td>
</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</FONT>

</BODY>
</HTML>
