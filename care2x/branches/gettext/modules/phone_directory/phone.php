<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org,
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define('MODULE','phone_directory');
define('LANG_FILE_MODULAR','phone_directory.php');
define('NO_2LEVEL_CHK',1);

require_once(CARE_BASE.'include/helpers/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require(CARE_BASE.'include/helpers/inc_2level_reset.php');

require_once(CARE_BASE.'include/helpers/smarty_care.class.php');
$smarty = new smarty_care('common');

if(isset($_SESSION['sess_staff_nr'])&&$_SESSION['sess_user_origin']=='staff_admin'){
	$breakfile=CARE_BASE.'modules/staff_admin/staff_admin_pass.php'.URL_APPEND.'&fwd_nr='.$_SESSION['sess_staff_nr'].'&target=staff_search';
}elseif(file_exists(CARE_BASE.$_SESSION['sess_path_referer'])){
	$breakfile=CARE_BASE.$_SESSION['sess_path_referer'].URL_APPEND;
}else{
	$breakfile=CARE_GUI.'modules/news/start_page.php?'.URL_APPEND;
}

//$db->debug=1;
$smarty->assign('sToolbarTitle','');
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);
# Added for the common header top block
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/submenu1.html");
$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('title','');

# Change the user origin
$_SESSION['sess_user_origin']='phonedir';

$dbtable='care_phone';

$toggle=0;
$linecount=0;

$fielddata='name, vorname, inphone1, inphone2, inphone3, funk1, funk2, exphone1, exphone2';

$keyword=trim($keyword);

if(($keyword)&&($keyword!=' ')) {

	$sql="SELECT $fielddata FROM $dbtable WHERE name $sql_LIKE '$keyword%' OR vorname $sql_LIKE '$keyword%' ORDER BY name";

	if($ergebnis=$db->Execute($sql)) {
		$linecount=$ergebnis->RecordCount();
	} else {
		echo "<p>".$sql."<p>$LDDbNoRead";
	}
}

?>

<script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
// -->
</script>


<?php
require(CARE_BASE.'include/helpers/include_header_css_js.php');
?>


<BODY onLoad="document.searchdata.keyword.select();document.searchdata.keyword.focus();" >
	<img

	<?php echo createComIcon(CARE_BASE,'phone.gif','0','absmiddle') ?>>
	<FONT COLOR="<?php echo $cfg[top_txtcolor] ?>" SIZE=6> <b><?php echo "$LDPhoneDir $LDSearch" ?>
	</b> </font>
	<table width=100% border=0 cellpadding="0" cellspacing="0">
		<tr>
			<td colspan=3>
    <ul class="tabs">
	    <li class="active"><a href="#">Search</a></li>
	    <li><a href="phone_list.php<?php echo URL_APPEND; ?>">Directory</a></li>
	    <li><a href="phone_edit_pass.php<?php echo URL_APPEND; ?>">New Data</a></li>
    </ul>
			
		</td>
		</tr>
		<tr>
			<td class="passborder" colspan=3>&nbsp;</td>
		</tr>
		<tr>
			<td class="passborder">&nbsp;</td>
			<td>

				<p>
					<br>
				
				<ul>

					<FORM action="phone.php" method="post" name="searchdata" onSubmit="return pruf(this)">

						<B><?php echo $LDKeywordPrompt ?> </B></font>
						<p>
							<font size=3><INPUT type="text" name="keyword" size="14"
								maxlength="40" onfocus=this.select()
								value="<?php echo $keyword ?>"> </font>
							<button type="submit" class="button icon search"/>Search</button>
							<a href="<?php echo $breakfile; ?>" class="button icon remove danger">Cancel</a>
							<input type="hidden" name="sid" value="<?php echo $sid; ?>"> 
							<input type="hidden" name="lang" value="<?php echo $lang; ?>">
					
					</FORM>

					<p>
						
					<p>



					<?php
					if ($linecount>0) {

						echo "<hr width=80% align=left><p>".str_replace("~nr~",$linecount,$LDPhoneFound)."<p>";
						mysql_data_seek($ergebnis,0);
						echo '<table border=0 cellpadding=3 cellspacing=1>
	<tr class="wardlisttitlerow">';

						for($i=0;$i<sizeof($fieldname);$i++) {
							echo"<td>".$fieldname[$i]."</td>";

						}
						echo "</tr>";
						while($zeile=$ergebnis->FetchRow())
						{
							echo "<tr class=";
							if($toggle) {
								echo "wardlistrow2>"; $toggle=0;
							} else {echo "wardlistrow1>"; $toggle=1;
							};

							for($i=0;$i<$ergebnis->FieldCount();$i++)
							{
								echo"<td>";
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
					
					
					<hr width=80% align=left>
					<p>
						<img   <?php echo createComIcon(CARE_BASE,'varrow.gif','0') ?>> <a
							href="phone_list.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDShowDir ?>
						</a><br> <img
							
						<?php echo createComIcon(CARE_BASE,'varrow.gif','0') ?>> <a
							href="phone_edit_pass.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDNewEntry ?>
						</a><br> <img
							
						<?php echo createComIcon(CARE_BASE,'frage.gif','0') ?>> <a
							href="javascript:gethelp('phone_how2start.php','search','search')"><?php echo $LDHow2SearchPhone ?>
						</a><br> <img
							
						<?php echo createComIcon(CARE_BASE,'frage.gif','0') ?>> <a
							href="javascript:gethelp('phone_how2start.php','search','dir')"><?php echo $LDHow2OpenDir ?>
						</a><br> <img
							
						<?php echo createComIcon(CARE_BASE,'frage.gif','0') ?>> <a
							href="javascript:gethelp('phone_how2start.php','search','newphone')"><?php echo $LDHowEnter ?>
						</a><br>
				
				</ul> &nbsp;
				<p>
			
			</td>
			<td class="passborder">&nbsp;</td>
		</tr>
		<tr>
			<td class="passborder" colspan=3>&nbsp;</td>
		</tr>

	</table>
	
	
	
	        
<?php 

  /**
 * show Template
 */

 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');