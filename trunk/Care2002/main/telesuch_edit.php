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
define('LANG_FILE','phone.php');
$local_user='phonedir_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');

$newdata=1;
$dbtable='care_phone';
$curdate=date('Y-m-d');
$curtime=date('H:i:s');

include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
   if ($mode=='save')
    {
	   // start checking input data
	   if (($name!='') || ($vorname!='')) 
	   {	
				$sql="INSERT INTO ".$dbtable." 
						(	
							title,
							name,
							vorname,
							beruf,
							bereich1,
							bereich2,
							inphone1,
							inphone2,
							inphone3,
							exphone1,
							exphone2,
							funk1,
							funk2,
							roomnr,
							date,
							time,
							create_id,
							create_time
							 ) 
						VALUES (
							'$anrede',
							'$name', 
							'$vorname', 
							'$beruf', 
							'$bereich1', 
							'$bereich2', 
							'$inphone1', 
							'$inphone2', 
							'$inphone3', 
							'$exphone1', 
							'$exphone2', 
							'$funk1', 
							'$funk2', 
							'$zimmerno',
							'$curdate', 
							'$curtime',
							'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
							NULL
							)";
				
 						if(mysql_query($sql,$link))
						{ 
							header("location:telesuch_phonelist.php?sid=$sid&lang=$lang&newdata=1&edit=1");
							exit;
						}
			 			else {echo "<p>".$sql."<p>$LDDbNoSave.";};
    	 }
		 else
		 {
		    $error=1;
		 }
 	}
}
else echo "$LDDbNoLink<br>"; 
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<HTML>
	<HEAD>
<?php echo setCharSet(); ?>
 	<TITLE></TITLE>
	 
<?php 
require('../include/inc_css_a_hilitebu.php');
?>

	</HEAD>

	<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

	<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>" SIZE=6  FACE="verdana"> <b><?php echo "$LDPhoneDir $LDNewData" ?></b></font>

	<table width=100% border=0 cellspacing=0 cellpadding=0>
	<tr>
	<td colspan=3><nobr>
	<a href="telesuch_phonelist.php?sid=<?php echo "$sid&lang=$lang&edit=$edit"; ?>"><img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img <?php echo createLDImgSrc('../','newdata-b.gif','0') ?>></nobr></td>
	</tr>
	<tr>
	<td bgcolor=#333399 colspan=3 >
	<FONT  SIZE=2  FACE=verdana,Arial color="#ffffff">&nbsp;<b>
   <?php
   	   if(($newvalues=="")&&($remark!="fromlist")) 
		{
		$nowtime=date(G);
		if(($nowtime>=0)&&($nowtime<10)) echo $LDGoodMorning;
		elseif(($nowtime > 9)&&($curtime<18)) echo $LDGoodDay;
		elseif($nowtime > 18) echo $LDGoodEvening;
		echo " ".$HTTP_COOKIE_VARS[$local_user.$sid];
		}
	?>&nbsp;&nbsp;</b>
	</FONT>
	</td>
	</tr>
	
	<tr bgcolor="#DDE1EC">
	
	<td bgcolor=#333399>&nbsp;</td>

	<td ><p><br>
	<ul>


<FONT    SIZE=-1  FACE="Arial"><p>
<FORM action="telesuch_phonelist.php" method="post" name="newentry">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="newdata" value="<?php echo $newdata ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<INPUT type="submit"  value="<?php echo $LDShowActualDir ?>"></font></FORM>
<p>
</FONT>
<?php if (($error)&&($mode=='save'))
{
echo "<img ".createMascot('../','mascot1_r.gif','0','absmiddle')."><FONT  COLOR=maroon  SIZE=+2  FACE=Arial> <b>$LDNewPhoneEntry</b><p>";
}
?>
<form method="get" action="telesuch_edit.php" enctype="">
<table bgcolor="#cceeff" border="1" cellpadding="5" cellspacing="1">
<tr>
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDNewPhoneEntry ?>:
</td>
<td >
&nbsp;
</td>
</tr>
<tr>
<td>
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[1] ?>&nbsp;
<input name=anrede type=text size="5" value=""><br>
</td>
<td>
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[2] ?>&nbsp;
<input name=name type=text size="15" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[3] ?>&nbsp;
<input type=text name=vorname size="15" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="10" value=""><br>
</td>
</tr>
<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[5] ?>
<br>

<input type=text name=bereich1 size="10" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[6] ?>
<br>
<input type=text name=bereich2 size="10" value=""><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[7] ?>
<br>

<input type=text name=inphone1 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[8] ?>
<br>
<input type=text name=inphone2 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[9] ?>
<br>
<input type=text name=inphone3 size="20" value=""><br>
</td>
</tr>

<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[10] ?><br>

<input type=text name=exphone1 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value=""><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[12] ?><br>

<input type=text name=funk1 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value=""><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" value=""><br>
</td>
</tr>

<tr>
<td colspan=3><FONT    SIZE=-1  FACE="Arial">
<p>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="newvalues" value="1">
<input type="submit" value="<?php echo $LDSave ?>">
<input type="reset" name="erase" value="<?php echo $LDReset ?>">
&nbsp;
</td>
<td >
&nbsp;
</td>
</tr>
</table>
</form>
<FONT    SIZE=-1  FACE="Arial">
<p>
<FORM action="telesuch.php" name="breaker">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></font></FORM>
<p>
</FONT>
</ul>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>
</BODY>
</HTML>
