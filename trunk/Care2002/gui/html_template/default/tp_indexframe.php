<HTML>
<HEAD>
<?php echo $charset; ?>
<TITLE><?php echo $wintitle; ?></TITLE>
<?php
//set the css style for a links
require($root_path.'include/inc_css_a_sublinker_d.php');
?>

<script language="javascript">
function changeLanguage(lang)
{
    <?php if(($cfg[mask]==1)||($cfg[mask]==""))  echo "window.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1&_chg_lang_=1\");";
	 else echo "window.opener.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 ?>
	return false;
}
function checkIfChanged(lang)
{
	if(lang=="<?php echo $lang; ?>") return false;
		else changeLanguage(lang);
}
</script>
</HEAD>

<BODY onLoad="if (window.focus) window.focus();
<?php if($boot) echo 'window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$sid.'&lang='.$lang.'&egal='.$egal.'&cookie='.$cookie.'\');';
?>
"
<?php
echo 'bgcolor='.$cfg['idx_bgcolor'];
 if(!$cfg['dhtml']) echo ' link='.$cfg['idx_txtcolor'].' vlink='.$cfg['idx_txtcolor'].' alink='.$cfg['idx_alink']; ?> 
 >
<center><img <?php echo createComIcon('../','care_logo.gif','0') ?>></center>
<TABLE CELLPADDING=2 CELLSPACING=0 border=0 >
<FONT  FACE="Arial"  SIZE="-1">

<?php

if($result){
	while($menu=$result->FetchRow()){
		if (eregi('LDLogin',$menu['LD_var'])){
			if ($HTTP_COOKIE_VARS['ck_login_logged'.$sid]=='true'){
				$menu['url']='main/logout_confirm.php';
				$menu['LD_var']='LDLogout';
			}	
		}
		echo '<TR><TD bgcolor='.$cfg['idx_bgcolor'].' ALIGN="left">'; echo "\n";
		echo '<A HREF="'.$root_path.$menu['url'].URL_APPEND.'"';
		echo ' TARGET="CONTENTS" REL="child">';
		echo "\n";
		echo '<nobr><img '.createComIcon('../','blue_bullet.gif','0','middle').'><font FACE="verdana,Arial" SIZE=-1 ><b>';
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) echo $$menu['LD_var'];
			else echo $menu['name'];
		echo '</b></nobr></FONT></A>';
		echo "\n";
		echo '</TD></TR>';		
	}
}

if(!$GLOBALCONFIG['language_single']){
?>
<tr>
<td>
<FONT  FACE="Arial"  SIZE="-1">
<form action="#" onSubmit="return checkIfChanged(this.lang.value)">
<hr>
<?php echo $LDLanguage ?><br>
<select name="lang">
	<option value="pt-br" <?php if($lang=='pt-br') echo 'selected'; ?>> <?php echo $LDBrazilian ?></option>
	<option value="cs-iso" <?php if($lang=='cs-iso') echo 'selected'; ?>> <?php echo $LDCzech ?></option>
	<option value="nl" <?php if($lang=='nl') echo 'selected'; ?>> <?php echo $LDDutch ?></option>
	<option value="en" <?php if($lang=='en') echo 'selected'; ?>> <?php echo $LDEnglish ?></option>
	<option value="fr" <?php if($lang=='fr') echo 'selected'; ?>> <?php echo $LDFrench ?></option>
	<option value="de" <?php if($lang=='de') echo 'selected'; ?>> <?php echo $LDGerman ?></option>
 	<option value="it" <?php if($lang=='it') echo 'selected'; ?>> <?php echo $LDItalian ?></option>
	<option value="id" <?php if($lang=='id') echo 'selected'; ?>> <?php echo $LDIndonesian ?></option>
	<option value="no" <?php if($lang=='no') echo 'selected'; ?>> <?php echo $LDNorwegian ?></option>
	<option value="pl" <?php if($lang=='pl') echo 'selected'; ?>> <?php echo $LDPolish ?></option>
	<option value="pt" <?php if($lang=='pt') echo 'selected'; ?>> <?php echo $LDPortuguese ?></option>
	<option value="es" <?php if($lang=='es') echo 'selected'; ?>> <?php echo $LDSpanish ?></option>
</select><br>
<input type="submit" value="<?php echo $LDChange ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mask" value="<?php echo $mask ?>">
<input type="hidden" name="egal" value="1">
<input type="hidden" name="chg_lang" value="1">
<hr>
</td>
</tr>
<?php
}
?>

<tr >
<td>
<font FACE="Arial" SIZE=1 color="#6f6f6f"><nobr><b>Log Info</b></nobr><br>
<?php echo  $login_name ?><br>
<?php echo $login_dept ?><br></FONT>
</td>
</tr>
</form>
</FONT>
</TABLE>

</BODY>
</HTML>
