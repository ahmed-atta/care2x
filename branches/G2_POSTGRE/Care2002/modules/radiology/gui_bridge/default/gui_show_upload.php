<?php
$returnfile=$HTTP_SESSION_VARS['sess_file_return'];

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
function chkform(d) {
	var r=false;
	for(i=0; i<<?php echo $maxpic ?>;i++){
		eval("if(d.f"+i+".value!=''){ r=true;}");
	}
	if(r) return true;
		else return false;
}

function popDicom(nr){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
dicomwin<?php echo $sid ?>=window.open("dicom_launch.php<?php echo URL_REDIRECT_APPEND ?>&pop_only=1&saved=1&img_nr="+nr,"dicomwin<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php if($cfg['dhtml']) echo '
	window.dicomwin'.$sid.'.moveTo(0,0);'; ?>
	
}

function popDicomSingle(fn){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
dicomwin<?php echo $sid ?>=window.open("dicom_launch_single.php<?php echo URL_REDIRECT_APPEND ?>&pop_only=1&saved=1&pid=<?php echo $pid ?>&img_nr=<?php echo $nr ?>&fn="+fn,"dicomwin<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php if($cfg['dhtml']) echo '
	window.dicomwin'.$sid.'.moveTo(0,0);'; ?>
	
}

// -->

</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dicom.js"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>




</HEAD>


<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $page_title ?></STRONG> 
</FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right"><a href="javascript:popSelectDicomViewer('<?php echo $sid ?>','<?php echo $lang ?>')" ><img <?php echo createLDImgSrc($root_path,'select_viewer.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';?>></a>
<a href="<?php echo $returnfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>" ><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0'); ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';?>><a 
href="javascript:gethelp('dicom_upload.php','<?php echo $rows ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<form method="post" name="entryform"  ENCTYPE="multipart/form-data"  action="<?php echo $thisfile; ?>" onSubmit="return chkform(this)">


<?php
/* Create the tabs */

require('./gui_bridge/default/gui_tabs_upload.php');

?>
<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<FONT    SIZE=-1  FACE="Arial">

<table border=0 cellspacing=1 cellpadding=0 width=50%>
<tr bgcolor="#ffffff">
<td colspan=3 valign="top">

<table border=0 width=100% cellspacing=1 cellpadding=3>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 
echo $LDPID;
?>
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
 echo $pid;
?>
</td>

<td valign="top" rowspan=6 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?>>
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
</td>

</tr>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($sex=="m") echo  $LDMale; elseif($sex=="f") echo $LDFemale ?>
</td>
</tr>

<?php
# Show input elements for additional info
if($mode=='new'){
?>
<tr>
<td colspan=3><img <?php  echo createComIcon($root_path,'warn.gif','0') ?>> &nbsp;<FONT SIZE=-1  FACE="Arial"><?php  echo $LDEnterRelatedInfo ?>: 
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><nobr><?php  echo $LDRelatedEncNr ?>:</nobr>
</td>
<td bgcolor="#ffffee"  colspan=2><input type="text" name="encounter_nr" size=11 maxlength=11>
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><nobr><?php  echo $LDRelatedDocsIds ?>:</nobr><br><FONT SIZE=1  FACE="Arial"><?php  echo $LDSeparateComma ?></font><br>
</td>
<td bgcolor="#ffffee" colspan=2><input type="text" name="doc_ref_ids" size=40 maxlength=40>
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><nobr><?php  echo $LDNotes ?>:</nobr><br>
</td>
<td bgcolor="#ffffee" colspan=2>
<textarea name="notes" cols=40 rows=3></textarea>
</td>
</tr>
<?php
}
?>
</table>


<?php
if($mode=='show'){
	if($rows){
		$bgimg='tableHeaderbg3.gif';
		$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
		$img_arrow=createComIcon($root_path,'bul_arrowblusm.gif','0','absmiddle'); // Load the torse icon image
		if(!$pop_only) $img_torso=createComIcon($root_path,'torso.gif','0'); // Load the torse icon image
		$img_torsowin=createComIcon($root_path,'torso_win.gif','0'); // Load the torse icon image
		$img_pix=createComIcon($root_path,'pixel.gif','0'); // Load the torse icon image
?>

<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td  colspan=4><FONT SIZE=3  FACE="Arial" color="#000066"><nobr><?php echo $LDImageGroupNr; ?> <b><?php echo $nr ?></b>&nbsp;
<?php 
		if(!$pop_only){
?>
	<a href="<?php echo "dicom_launch.php".URL_APPEND."&saved=1&img_nr=$nr" ?>" title="<?php echo "$LDViewImage ($LDViewInFrame)" ?>"><img <?php echo $img_torso ?>></a> &nbsp;
<?php 
		}
?>
	<a href="javascript:popDicom('<?php echo $nr ?>')" title="<?php echo "$LDViewInWindow ($LDFullScreen)" ?>"><img <?php echo $img_torsowin ?>></a></nobr></td>
  </tr>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><nobr><?php echo $LDImgNumber; ?></nobr></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><nobr><?php echo $LDNewFileName; ?></nobr></td>
<?php 
		if(!$pop_only){
?>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><nobr><?php echo "$LDViewImage ($LDSingleImage)" ?></nobr></td>
<?php 
		}
?>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><nobr><?php echo "$LDViewInWindow ($LDSingleImage)" ?></nobr></td>
  </tr>
<?php

		$i=1;

		while(list($x,$v)=each($files)){

			echo'
		 		<tr>
    			<td class="v12" align=center><FONT SIZE=-1  FACE="Arial">&nbsp;'.$i.'&nbsp;</td>
    			<td class="v12"><FONT SIZE=-1  FACE="Arial">&nbsp;'.$v.'&nbsp;</td>';
			if(!$pop_only) echo '
    			<td class="v12" align=center><a href="dicom_launch_single.php'.URL_APPEND.'&pid='.$pid.'&img_nr='.$nr.'&fn='.$v.'" title="'.$LDViewInFrame.'"><img '.$img_torso.'></a></td>';
			echo '
    			<td class="v12" align=center><a href="javascript:popDicomSingle(\''.$v.'\')" title="'.$LDFullScreen.'"><img '.$img_torsowin.'></a></td>
  			</tr>
  			';
  			$i++;
		}
?>
</table>

<?php	
	}else{
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot2_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b>
	<?php 
		echo $LDNoImageSaved;
	?></b></font></td>
  </tr>
</table>
<?php
	}
}elseif($mode=='details'){


# Create a new form
}else {
?>

<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="8000000">

<table border=0>
  <tr>
    <td><FONT SIZE=-1  FACE="Arial" color="#cc0000"><?php echo $LDImgNumber; ?></td>
    <td></td>
    <td></td>
  </tr>

 <?php

for($i=0;$i<$maxpic;$i++){
	echo  '<tr><td align=center>'.($i+1).'
				</td><td><input type="file" name="f'.$i.'" size=40></td>
			    <td></td>
			  </tr>';
}
?>
   
    
</table>

<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="maxpic" value="<?php echo $maxpic; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<!-- <input type="hidden" name="modify_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_id" value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>">
<input type="hidden" name="create_time" value="null">
 -->
 <input type="hidden" name="mode" value="create">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="edit" value="<?php echo $edit; ?>">

<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>


<!-- <input type="hidden" name="is_discharged" value="<?php echo $is_discharged; ?>">
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $HTTP_SESSION_VARS['sess_user_name']."\n"; ?>">
 -->
<?php
} 


?>
</td>
<!-- Load the options table  -->
<td rowspan=2  valign="top">
&nbsp;
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

</form>

<form>
&nbsp;<?php echo $LDUploadNew; ?>&nbsp;
<input type="text" name="maxpic" size=3 maxlength=2 value="<?php echo $maxpic; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="pid" value="<?php echo $pid; ?>"> <?php echo $LDNewImageFiles; ?>.
<input type="submit" value="Go">

</form>


</FONT>
<p>
</td>
</tr>
</table>        
<p>&nbsp;
<!-- 
<a href="<?php echo $breakfile?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
 -->
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
 ?>
</FONT>
<?php
StdFooter();
?>
