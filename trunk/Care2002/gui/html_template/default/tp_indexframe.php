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
    <?php if(($cfg[mask]==1)||($cfg[mask]==""))  echo "window.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 else echo "window.opener.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 ?>
	return false;
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

<form action="#" onSubmit="return changeLanguage(this.lang.value)">
<hr>
<?php echo $LDLanguage ?><br>
<select name="lang";>
	<?php if($lang!='pt-br') : ?>
	<option value="pt-br"> Brazilian</option>
    <?php endif ?>
	<?php if($lang!='cs-iso') : ?>
	<option value="cs-iso"> Czech</option>
	<?php endif ?>
	<?php if($lang!='en') : ?>
	<option value="en"> English</option>
	<?php endif ?>
	<?php if($lang!='fr') : ?>
	<option value="fr"> French</option>
	<?php endif ?>
	<?php if($lang!='de') : ?>
	<option value="de"> German</option>
	<?php endif ?>
	<?php if($lang!='it') : ?>
 	<option value="it"> Italian</option>
    <?php endif ?>
	<?php if($lang!='id') : ?>
	<option value="id"> Indonesian</option>
    <?php endif ?>
	<?php if($lang!='no') : ?>
	<option value="no"> Norwegian</option>
    <?php endif ?>
	<?php if($lang!='pl') : ?>
	<option value="pl"> Polish</option>
    <?php endif ?>
	<?php if($lang!='pt') : ?>
	<option value="pt"> Portuguese</option>
    <?php endif ?>
	<?php if($lang!='es') : ?>
	<option value="es"> Spanish</option>
    <?php endif ?>

</select><br>
<input type="submit" value="<?php echo $LDChange ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mask" value="<?php echo $mask ?>">
<input type="hidden" name="egal" value="1">
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
