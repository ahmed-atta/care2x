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

$error=1;
//$newdata=0;
$curdate=date('Y-m-d');
$curtime=date('H:i:s');

$dbtable='care_phone';

if($from=='list') include('../include/inc_db_makelink.php');

if($link&&$DBLink_OK) 					
{
    if ($mode=='save')
     {
	    // start checking input data
	    if (($name!="")or($vorname!=""))
		{
						$sql='UPDATE '.$dbtable.' SET
							title="'.$anrede.'",
							name="'.$name.'",
							vorname="'.$vorname.'",
							beruf="'.$beruf.'",
							bereich1="'.$bereich1.'",
							bereich2="'.$bereich2.'",
							inphone1="'.$inphone1.'",
							inphone2="'.$inphone2.'",
							inphone3="'.$inphone3.'",
							exphone1="'.$exphone1.'",
							exphone2="'.$exphone2.'",
							funk1="'.$funk1.'",
							funk2="'.$funk2.'",
							roomnr="'.$zimmerno.'",
							date="'.$curdate.'",
							time="'.$curtime.'",
							modify_id="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"  
						WHERE item_nr="'.$itemname.'"';
				
 						if(mysql_query($sql,$link))
						{ 
							header("Location: telesuch_phonelist.php?sid=$sid&lang=$lang&batchnum=$batchnum&linecount=$linecount&pagecount=$pagecount&displaysize=$displaysize&update=1&itemname=$itemname&edit=$edit"); 
							exit;
						}
			 			else {echo "<p>".$sql."<p>$LDDbNoSave";};
    	 }
 	}
	else
	{
						$sql='SELECT * FROM '.$dbtable.' WHERE item_nr="'.$itemname.'"';
		
 						if($ergebnis=mysql_query($sql,$link))	$zeile=mysql_fetch_array($ergebnis);					
			 			    else {echo "<p>".$sql."<p>$LDDbNoRead";};
	}
}
 else echo "$LDDbNoLink<br>";  
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<STYLE TYPE="text/css">
	.va12_b {font-family:verdana,arial;font-size:12;text-decoration: none; color: #0000cc;}
</style>
</HEAD>

	<BODY >
	<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDPhoneDir ?></b></font>

	<table width=100% border=1>
	<tr>
	<td bgcolor=navy>
	<FONT  COLOR=white  SIZE=+1  FACE=Arial><STRONG>&nbsp;<?php echo $LDUpdate ?></STRONG></FONT>
	</td>
	</tr>
	<tr bgcolor="#DDE1EC">
	<td ><p><br>
	<ul>
<?php if (($error==1)and($newvalues!="")) echo "<FONT  COLOR=maroon  SIZE=+1  FACE=Arial>$LDNoData<p>";
?>
<form method="post" action="telesuch_eintrag_update.php">
<table bgcolor="#f9f9f9" border="1" cellpadding="5" cellspacing="1">
<tr>
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
<b><?php  echo str_replace("~nr~",$zeile[item],$LDDirData); ?> </b>
</td>
<td >
&nbsp;
</td>
</tr>
<tr>
<td class="va12_b">

<?php echo $LDEditFields[1] ?>&nbsp;
<input name=anrede type=text size="5" value="<?php echo $zeile[title] ?>"><br>
</td>
<td class="va12_b">

<?php echo $LDEditFields[2] ?>&nbsp;
<input name=name type=text size="15" value="<?php echo $zeile[name] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[3] ?>&nbsp;

<input type=text name=vorname size="15" value="<?php echo $zeile[vorname] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="10" value="<?php echo $zeile[beruf] ?>"><br>
</td>
</tr>
<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[5] ?><br>

<input type=text name=bereich1 size="10" value="<?php echo $zeile[bereich1] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[6] ?><br>
<input type=text name=bereich2 size="10" value="<?php echo $zeile[bereich2] ?>"><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[7] ?><br>

<input type=text name=inphone1 size="20" value="<?php echo $zeile[inphone1] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[8] ?><br>
<input type=text name=inphone2 size="20" value="<?php echo $zeile[inphone2] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[9] ?><br>
<input type=text name=inphone3 size="20" value="<?php echo $zeile[inphone3] ?>"><br>
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[10] ?><br>

<input type=text name=exphone1 size="20" value="<?php echo $zeile[exphone1] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value="<?php echo $zeile[exphone2] ?>"><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[12] ?><br>

<input type=text name=funk1 size="20" value="<?php echo $zeile[funk1] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value="<?php echo $zeile[funk2] ?>"><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" value="<?php echo $zeile[roomnr] ?>"><br>
</td>
</tr>
<tr>
<td colspan=3>
<p>
<input type="hidden" name="mode" value="save">
<input type="hidden" name="from" value="list">
<input type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="linecount" value="<?php echo $linecount ?>">
<input type="hidden" name="pagecount" value="<?php echo $pagecount ?>">
<input type="hidden" name="batchnum" value="<?php echo $batchnum ?>">
<input type="hidden" name="displaysize" value="<?php echo $displaysize ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="submit"  value="<?php echo $LDUpdate ?>"> &nbsp;
<input type="reset"  value="<?php echo $LDReset ?>">
</td>
<td >
&nbsp;
</td>
</tr>
</table>
</form>

<FONT    SIZE=-1  FACE="Arial">
<p>
<FORM action="telesuch_phonelist.php" method="post">
<input type="hidden" name="linecount" value="<?php echo $linecount ?>">
<input type="hidden" name="pagecount" value="<?php echo $pagecount ?>">
<input type="hidden" name="batchnum" value="<?php echo $batchnum ?>">
<input type="hidden" name="displaysize" value="<?php echo $displaysize ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></font></FORM>
<p>
</FONT>
</ul>
<p>
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
