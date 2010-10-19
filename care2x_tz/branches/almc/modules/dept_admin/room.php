<?php
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');
	require($root_path.'include/inc_environment_global.php');
	/**
	* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
	* GNU General Public License
	* Copyright 2002,2003,2004,2005 Elpidio Latorilla
	* elpidio@care2x.org,
	*
	* See the file "copy_notice.txt" for the licence notice
	*/

	define('LANG_FILE','doctor_rooms.php');
	$local_user='ck_edv_user';
	require_once($root_path.'include/inc_front_chain_lang.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');

	include_once($root_path.'include/care_api_classes/class_multi.php');
	$cd_obj = new multi;
	$obj    = new multi;

	$vct = $cd_obj->__genNumbers();

	$breakfile=(($_GET['fw']!='')?'room_'.$_GET['fw'].'.php':'room_list.php');


	if ($_GET['oneway'] || ($_GET['mode']=='remove')){
		$_POST['name'] = $_GET['name'];
		$_POST['dpt']  = $_GET['dpt'];
	}

	$_POST['mode'] = $_GET['mode'];

	if ($_POST['name'])
		$feed = $obj->SaveRoom($_POST);

	?>

	<link href="../dental/dental_reports.css" rel="stylesheet" type="text/css">

	<style type="text/css" name="formstyle">
	<!--
	a,a:visited,a:active{text-decoration:none; color:darkblue;}
	a:hover{text-decoration:none; color:red;}
	td.pblock{ font-family: verdana,arial; font-size: 12}
	div.box { border: solid; border-width: thin; width: 100% }
	div.pcont{ margin-left: 3; }

	#roller{text-decoration:none;}
	#roller:hover{background-color:#DEFDD9 !important;}

	.botline {border-bottom:3px solid #66FF66;}
	.cell{font:normal 11px Tahoma, Arial; padding:4px;}
	.cell2{font:bold 11px Tahoma, Arial; padding:8px; white-space:nowrap;}
	-->
	</style>

	</HEAD>
	<script language="JavaScript" type="text/javascript" src="./item_mover.js"></script>

	<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

	<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" style="font-size:11px !important;">
	<tr valign=top><td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" valign="middle" height="10">
	<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>
	&nbsp;&nbsp;&nbsp;<?php echo $LDDoctorRooms; ?></STRONG></FONT></td>
	<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align='right' style='padding-top:5px;'>
	<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dental.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
	</tr>

	<tr align="left" valign=bottom>
	    <td height="10" colspan="2" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" class="botline">
	      &nbsp; </td>
	</tr>

	<tr  valign=top>
	    <td colspan="5"> <?php

	      	if ($vct[8]==2){
	      		if ($feed==1){ ?>
		      		<div style="width:85%; margin: 20px 0px 0px 20px; float:left; padding:20px; background:green; color:#fff; border:1px solid black; font:bold 14px Tahoma; text-transform: capitalize;">
		      			Action Completed successfully
		      		</div><?php
	      		} else if ($feed==-1){ ?>
		      		<div style="width:85%; margin: 20px 0px 0px 20px; float:left; padding:20px; background:red; color:#fff; border:1px solid black; font:bold 14px Tahoma; text-transform: capitalize;">
		      			Room "<?php print $_POST['name']; ?>"  not saved
		      		</div><?php
	      		} ?>
	      		<br clear="all">
		      <!--    here is the forms are start   -->
		      	<div style="width:100%">
					<?PHP include($breakfile);?>
				</div>
		      <!--    here is the form ends   --><?php
		    }else {?>
	      		<div style="width:85%; margin: 20px 0px 0px 20px; float:left; padding:20px; background:red; float:left; color:#fff; border:1px solid black; font:bold 14px Tahoma; text-transform: capitalize;">
	      			Please Enable <big><big> view List By Room</big></big><br />
	      			Its under System Admin &raquo; General settings
	      			<input type="button" value="Go &rsaquo;" style="width:70px;" onclick="javascript:window.location.href='../system_admin/edv_patient_numbers.php<?php print URL_APPEND; ?>'"
	      		</div><?php
	      	} ?>
		    </td>
		  </tr>
		<tr>

		<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2><?php
		require($root_path.'include/inc_load_copyrite.php');
		?></td>
	</tr>
	</table>
	</table>
	</body>
	</html>
