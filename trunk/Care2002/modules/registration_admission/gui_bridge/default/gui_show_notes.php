<?php
if(isset($HTTP_SESSION_VARS['sess_file_return'])&&!empty($HTTP_SESSION_VARS['sess_file_return']))
	$returnfile=$HTTP_SESSION_VARS['sess_file_return'];
	else $returnfile=$top_dir.'show_appointment.php';

require('./gui_bridge/default/gui_std_tags.php');

//$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

function createTR($ld_text, $input_val, $colspan = 1)
{
    global $toggle, $root_path;
?>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?> bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $input_val; ?>
</td>
</tr>

<?php
$toggle=!$toggle;
}

echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $title ?></TITLE>

<script  language="javascript">
<!-- 

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>



<?php 
if($parent_admit) include($root_path.'include/inc_js_barcode_wristband_popwin.php');
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $page_title ?></STRONG> 
<font size=+2>(
<?php 
if($parent_admit) echo ($HTTP_SESSION_VARS['sess_full_en']);
	else echo ($HTTP_SESSION_VARS['sess_full_pid']);
?>)</font></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="<?php echo $returnfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>" ><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0'); ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';?>><a 
href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo $breakfile."?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
/* Create the tabs */
if($parent_admit) {
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_patadmit.php');

}else{
	$tab_bot_line='#66ee66';
	require('./gui_bridge/default/gui_tabs_patreg.php');
}
?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<FONT    SIZE=-1  FACE="Arial">

<table border=0 cellspacing=1 cellpadding=0 width=100%>

<tr bgcolor="#ffffff">
<td colspan=3 valign="top">

<table border=0 width=100% cellspacing=1>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 
if($parent_admit) echo $LDAdmitNr;
	else echo $LDRegistrationNr;
?>
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
if($parent_admit) echo ($HTTP_SESSION_VARS['sess_full_en']) ;
	else echo ($HTTP_SESSION_VARS['sess_full_pid']) 
?>
</td>

<td valign="top" rowspan=8 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?> width=137>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php echo $title ?>
</td>

</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php  echo $LDLastName ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#990000"><b><?php echo $name_last; ?></b>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#990000"><b><?php echo $name_first; ?></b>
</td>
</tr>

<?php

if (!$GLOBAL_CONFIG['person_name_2_hide'])
{
createTR($LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide'])
{
createTR( $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide'])
{
createTR($LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide'])
{
createTR($LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide'])
{
createTR($LDNameOthers,$name_others);
}
?>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b><?php       echo @formatDate2Local($date_birth,$date_format);  ?></b>
</td>

</tr>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($sex=="m") echo  $LDMale; elseif($sex=="f") echo $LDFemale ?>
</td>
</tr>
</table>

<?php
if($mode=='show'){
	if($rows){
		if($parent_admit) $bgimg='tableHeaderbg3.gif';
			else $bgimg='tableHeader_gr.gif';
		$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
?>
<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $subtitle; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDetails; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDBy; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDEncounterNr; ?></td>
  </tr>
<?php
$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#efefef';
		else $bgc='#f0f0f0';
	$toggle=!$toggle;
?>


  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#000033">
	<?php 
		if(!empty($row['notes'])) echo hilite(substr($row['notes'],0,$GLOBAL_CONFIG['notes_preview_maxlen']));
		if (strlen($row['notes']) > $GLOBAL_CONFIG['notes_preview_maxlen']) echo ' [...]';
		echo '<br>'; 
		if(!empty($row['short_notes'])) echo '[ '.hilite($row['short_notes']).' ]';
	?>
	</td>
    <td align="center"><?php if (strlen($row['notes']) > $GLOBAL_CONFIG['notes_preview_maxlen']) echo '<a href="#"><img '.createComIcon($root_path,'info3.gif','0').'></a>'; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial">
	<?php 
		switch($row['encounter_class_nr'])
		{
			case 1:  echo ($row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']);
						break;
			case 2:  echo ($row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);
						break;
		}
	?></td>
  </tr>

<?php
}
?>
</table>

<?php	
	}else{
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b>
	<?php 
		echo $norecordyet;
	?></b></font></td>
  </tr>
</table>
<?php
	}
}else {
?>
<form method="post" >
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td><input type="text" name="date" size=10 maxlength=10  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDApplication.' '.$LDNotes; ?></td>
     <td><textarea name="notes" cols=40 rows=8 wrap="physical"></textarea>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDShortNotes; ?></td>
     <td><input type="text" name="short_notes" size=50 maxlength=25></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDSendCopyTo; ?></td>
     <td><input type="text" name="send_to_name" size=50 maxlength=60></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDBy; ?></td>
     <td><input type="text" name="personell_name" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>"></td>
   </tr>
 </table>
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<input type="hidden" name="modify_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_time" value="null">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="personell_nr">
<input type="hidden" name="send_to_pid">
<input type="hidden" name="type_nr" value="<?php echo $type_nr; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $HTTP_SESSION_VARS['sess_user_name']."\n"; ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
<?php
} 
?>
<?php
if($parent_admit) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new&type_nr='.$type_nr; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a><br>
<?php
}
?>
<img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $returnfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>"> 
<?php echo $LDBackToOptions;  ?>
</a>

</td>
<!-- Load the options table  -->
<td rowspan=2  valign="top">


<?php

function Spacer()
{
/*?>
<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
<?php
*/}
?>
<img <?php echo createComIcon($root_path,'angle_left.gif',0); ?>>
<br>
<FONT face="Verdana,Helvetica,Arial" size=2 color="#cc0000">
<?php echo "$LDNotes $LDAndSym $LDReports $LDTypes" ?>
</font>

<TABLE cellSpacing=0 cellPadding=0 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=2 bgColor=#999999 
            border=0>
              <TBODY>
<?php
while(list($x,$v)=each($types)){
?>				  
				  
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'post_discussion.gif','0') ?>></td>
                <TD vAlign=top ><nobr><FONT 
                  face="Verdana,Helvetica,Arial" size=2>
				 <a href="show_notes.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>&type_nr=<?php echo $v['nr'] ?>">
				 <?php 
				 	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var']; else echo $v['name'] 
				 ?>
				 </a>
				   </FONT></nobr></TD>
                </TR>
			   
           <?php Spacer(); ?>
<?php
}
?>
			</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>


</td>
</tr>

</table>
<p>

<?php 
if($parent_admit) {
	include('./include/bottom_controls_admission_options.inc.php');
}else{
	include('./include/bottom_controls_registration_options.inc.php');
}
?>

<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<p>
<a href="
<?php if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo 'startframe.php'.URL_APPEND;
	else echo $breakfile.URL_APPEND;
	echo ;
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
