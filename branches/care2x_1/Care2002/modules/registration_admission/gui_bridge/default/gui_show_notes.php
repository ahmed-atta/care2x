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

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}
function popNotesDetails(n,t) {
	urlholder="./show_notes_details.php<?php echo URL_REDIRECT_APPEND; ?>&nr="+n+"&title="+t+"&ln=<?php echo $name_last ?>&fn=<?php echo $name_first ?>&bd=<?php echo $date_birth ?>";
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>



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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo $page_title ?></STRONG> 
(<?php 
if($parent_admit) echo ($HTTP_SESSION_VARS['sess_full_en']);
	else echo ($HTTP_SESSION_VARS['sess_full_pid']);
?>)</font>
</td>

<?php
# Patch 2003-11-20 
if($parent_admit) $retbuf='&encounter_nr='.$HTTP_SESSION_VARS['sess_full_en'];
	else $retbuf='&pid='.$HTTP_SESSION_VARS['sess_pid'];
?>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="<?php echo $returnfile.URL_APPEND.$retbuf.'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>" ><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0'); ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';?>><a 
href="javascript:gethelp('notes_router.php','<?php echo $notestype; ?>','<?php echo strtr($subtitle,' ','+'); ?>','<?php echo $mode; ?>','<?php echo $rows; ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
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
<?php
# If encounter is already discharged, show warning
if($parent_admit&&$is_discharged){
?>

  <tr>
    <td bgcolor="red">&nbsp;<FONT    SIZE=2  FACE="verdana,Arial" color="#ffffff"><img <?php echo createComIcon($root_path,'warn.gif','0','absmiddle'); ?>> 
	<b>
		<?php 
		if($current_encounter) echo $LDEncounterClosed;
			else echo $LDPatientIsDischarged; 
	?>
	</b></font></td>
    <td>&nbsp;</td>
  </tr>

<?php
}
?>

<tr bgcolor="#ffffff">
<td  valign="top">

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

<td valign="top" rowspan=8 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?>>
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
<?php
# If person is dead show a black cross
if($death_date&&$death_date!='0000-00-00') echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>';
?>
</td>
</tr>

<?php
if (!$GLOBAL_CONFIG['person_name_2_hide']&&$name_2)
{
createTR($LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide']&&$name_3)
{
createTR( $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide']&&$name_middle)
{
createTR($LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide']&&$name_maiden)
{
createTR($LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide']&&$name_others)
{
createTR($LDNameOthers,$name_others);
}
?>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b><?php       echo @formatDate2Local($date_birth,$date_format);  ?></b>
<?php
# If person is dead show a black cross
if($death_date&&$death_date!='0000-00-00'){
	echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>&nbsp;<font color="#000000">'.formatDate2Local($death_date,$date_format).'</font>';
}
?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($sex=="m") echo  $LDMale; elseif($sex=="f") echo $LDFemale ?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDBloodGroup ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial">
<?php
if($blood_group){
	$buf='LD'.$blood_group;
	echo $$buf;
} 
?>
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
    <?php 
	if(!$parent_admit){
	?>
	<td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDEncounterNr; ?></td>
  <?php
  }
  ?>
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
    <td align="center">
	<?php
	# Link to pdf generator
	$topdf= '<a href="'.$root_path.'modules/pdfmaker/emr_generic/report.php'.URL_APPEND.'&enc='.$row['encounter_nr'].'&recnr='.$row['nr'].'&type_nr='.$this_type['nr'].'&LD_var='.$this_type['LD_var'].'" target=_blank><img '.createComIcon($root_path,'pdf_icon.gif','0').'></a>';
	
	 if (strlen($row['notes']) > $GLOBAL_CONFIG['notes_preview_maxlen']){
	 	 echo '<a href="javascript:popNotesDetails(\''.$row['nr'].'\',\''.strtr($subtitle,"' ","´+").'\',\''.$this_type['LD_var'].'\')"><img '.createComIcon($root_path,'info3.gif','0').'></a>';
		echo $topdf;
	}elseif(!empty($row['notes'])){
		echo $topdf;
	}
	 ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
    <?php 
	if(!$parent_admit){
	?>
	<td><FONT SIZE=-1  FACE="Arial">
	<a href="aufnahme_daten_zeigen.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $row['encounter_nr']; ?>&origin=patreg_reg"><?php echo $row['encounter_nr'];	?></a>
	</td>
  <?php
  }
  ?>
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

<script language="JavaScript">
<!-- Script Begin
function chkform(d) {
	if(d.date.value==""){
		alert("<?php echo $LDPlsEnterDate; ?>");
		d.date.focus();
		return false;
	}else if(d.notes.value==""){
		alert("<?php echo $LDPlsEnterReport; ?>");
		d.notes.focus();
		return false;
	}else if(d.personell_name.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.personell_name.focus();
		return false;
	}else{
		return true;
	}
}
//  Script End -->
</script>

<form method="post" name="notes_form" onSubmit="return chkform(this)">
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td><input type="text" name="date" size=10 maxlength=10 onFocus="this.select()"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
	 	 <a href="javascript:show_calendar('notes_form.date','<?php echo $date_format ?>')">
 		<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 		<font size=1>[ <?php   
 		$dfbuffer="LD_".strtr($date_format,".-/","phs");
  		echo $$dfbuffer;
 		?> ] </font>
	 </td>
   </tr>
        
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDApplication.' '.$LDNotes; ?></td>
     <td><textarea name="notes" cols=40 rows=8 wrap="virtual"></textarea>
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
     <td><input type="text" name="personell_name" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>" readonly></td>
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

<img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php 
if($parent_admit) $buf='&encounter_nr='.$HTTP_SESSION_VARS['sess_full_en'];
	else $buf='&pid='.$HTTP_SESSION_VARS['sess_full_pid'];
echo $returnfile.URL_APPEND.$buf.'&target='.$target.'&mode=show&type_nr='.$type_nr; 
?>"> 
<?php echo $LDBackToOptions;  ?>
</a>
<?php
# Type nr 3 = discharge summary/notes
# Type nr 99 = auxilliary notes
if($parent_admit&&(!$is_discharged||$type_nr==3||$type_nr==99)) {
?>
&nbsp;&nbsp;
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new&type_nr='.$type_nr; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a><br>
<?php
}
?>
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
<img <?php echo createComIcon($root_path,'angle_left_s.gif',0); ?>>
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
				  
               <TR bgColor=#eeeeee> <td align=center>
			   <img <?php 
						   	# Type nr 3 = discharge summary/notes
							# Type nr 99 = auxilliary notes
			   				if($parent_admit&&(!$is_discharged||$v['nr']==3||$v['nr']==99)) echo createComIcon($root_path,'comments.gif','0');
			   					else  echo createComIcon($root_path,'docu_unrd.gif','0');
						?>>
			   </td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2>
				 <a href="show_notes.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=<?php echo $target ?>&type_nr=<?php echo $v['nr'] ?>">
				 <?php 
				 	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var']; else echo $v['name'] 
				 ?>
				 </a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
<?php
}
if($parent_admit){
?>
               <TR bgColor=#eeeeee> <td align=center>
			   <img <?php echo createComIcon($root_path,'icon_acro.gif','0');?>>
			   </td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2>
				  <a href="<?php echo $root_path."modules/pdfmaker/emr_generic/report_all.php".URL_APPEND."&enc=".$HTTP_SESSION_VARS['sess_en']; ?>" target=_blank>
				 <?php 
				 	 echo $LDPrintPDFDocAllReport; 
				 ?>
				 </a>
				   </FONT></TD>
                </TR>
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
<a href="
<?php echo $returnfile.URL_APPEND.$buf.'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
