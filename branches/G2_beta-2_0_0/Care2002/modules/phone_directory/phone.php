<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'/include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','phone.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(isset($HTTP_SESSION_VARS['sess_personell_nr'])&&$HTTP_SESSION_VARS['sess_user_origin']=='personell_admin'){
	$breakfile=$root_path.'modules/personell_admin/personell_admin_pass.php'.URL_APPEND.'&fwd_nr='.$HTTP_SESSION_VARS['sess_personell_nr'].'&target=personell_search';
}elseif(file_exists($root_path.$HTTP_SESSION_VARS['sess_path_referer'])){
	$breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'].URL_APPEND;
}else{
	$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
}

//$db->debug=1;

# Change the user origin
$HTTP_SESSION_VARS['sess_user_origin']='phonedir';

$dbtable='care_phone';

$toggle=0;
$linecount=0;


$fielddata='name, vorname, inphone1, inphone2, inphone3, funk1, funk2, exphone1, exphone2';

$keyword=trim($keyword);

if(($keyword)&&($keyword!=' ')) {

			$sql="SELECT $fielddata FROM $dbtable WHERE name $sql_LIKE '$keyword%' OR vorname $sql_LIKE '$keyword%' ORDER BY name";

			if($ergebnis=$db->Execute($sql)) {
				$linecount=$ergebnis->RecordCount();
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
// -->
</script>
 
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY  onLoad="document.searchdata.keyword.select();document.searchdata.keyword.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<img <?php echo createComIcon($root_path,'phone.gif','0','absmiddle') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDPhoneDir $LDSearch" ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'such-b.gif','0') ?>><a href="phone_list.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'phonedir-gray.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="phone_edit_pass.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'newdata-gray.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<FORM action="phone.php" method="post" name="searchdata" onSubmit="return pruf(this)">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B><?php echo $LDKeywordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" onfocus=this.select() value="<?php echo $keyword ?>"></font> 
<!-- <INPUT type="submit" name="versand" value="<?php echo $LDSEARCH ?>"> -->
<INPUT type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0') ?>>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
</FORM>

<p>
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if ($linecount>0) { 

    echo "<hr width=80% align=left><p>".str_replace("~nr~",$linecount,$LDPhoneFound)."<p>";
    mysql_data_seek($ergebnis,0);
    echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#0000aa>";
	
    for($i=0;$i<sizeof($fieldname);$i++) {
	    echo"<td><font face=arial size=2 color=#ffffff><b>".$fieldname[$i]."</b></td>";
		
	 }
					echo "</tr>";
					while($zeile=$ergebnis->FetchRow())
					{
						echo "<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
	
						for($i=0;$i<$ergebnis->FieldCount();$i++) 
						{
							echo"<td><font face=arial size=2>";
							if($zeile[$i]=="")echo "&nbsp;"; else echo $zeile[$i];
							echo "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
					if($linecount>15)
					{
						echo '
						<p><font color=red><B>New Search:</font>
						<FORM action="phone.php" method="post" onSubmit="return pruf(this)" name="form2">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						'.$LDKeywordPrompt.'</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value="'.$keyword.'"> 
						<INPUT type="submit" name="versand" value="'.$LDSEARCH.'"></font>
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
						</FORM>
						<p>
						<FORM action="startframe.php" >
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
      
						<INPUT type="submit"  value="'.$LDCancel.'"></FORM>
						<p>';
					}
				}


?>
<p>
<hr width=80% align=left><p>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="phone_list.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDShowDir ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="phone_edit_pass.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDNewEntry ?></a><br>
<img <?php echo createComIcon($root_path,'frage.gif','0') ?>> <a href="javascript:gethelp('phone_how2start.php','search','search')"><?php echo $LDHow2SearchPhone ?></a><br>
<img <?php echo createComIcon($root_path,'frage.gif','0') ?>> <a href="javascript:gethelp('phone_how2start.php','search','dir')"><?php echo $LDHow2OpenDir ?></a><br>
<img <?php echo createComIcon($root_path,'frage.gif','0') ?>> <a href="javascript:gethelp('phone_how2start.php','search','newphone')"><?php echo $LDHowEnter ?></a><br>
</ul>
&nbsp;
</FONT>
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
require($root_path.'include/inc_load_copyrite.php');
 ?>

</FONT>


</BODY>
</HTML>
