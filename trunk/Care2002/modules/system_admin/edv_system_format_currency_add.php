<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_core.php');
$core=& new Core();

$breakfile='edv-system-admi-welcome.php'.URL_APPEND.'&target=currency_admin';
$thisfile='edv_system_format_currency_add.php';
if($from=='set') $returnfile='edv_system_format_currency_set.php'.URL_APPEND.'&from=add';
 else $returnfile=$breakfile;

$dbtable='care_currency';
//$db->debug=1;

if(($mode=='save')&&$short_name&&$long_name&&$info){

    if($item_no){
	   $sql="UPDATE $dbtable SET short_name='$short_name',
	                                               long_name='$long_name',
							info='$info',
							modify_id='".$HTTP_SESSION_VARS['sess_user_name']."',
							modify_time='".date('YmdHis')."'
							WHERE item_no='$item_no'";
	   if($ergebnis=$core->Transact($sql))
       {
		 if($db->Affected_Rows())
		 {
	  	   /* $sql="UPDATE ".$dbtable." SET
									  modify_id='".$HTTP_COOKIE_VARS['ck_cafenews_user'.$sid]."',
									 modify_time='".date('YmdHis')."'
									 WHERE item_no=".$item_no;
		   $db->Execute($sql);*/
		   $new_currency_ok=1;
		   $saved_msg=$LDCurrencyUpdated;
		 }
		   else
		   {
		     $new_currency_ok=0;
		   }
		}
		else echo "<p> $sql <p>$LDDbNoSave";
	}
	else
	{
		$info_exist=0;
		
	   // Check first if the info already exists
	   
	   $sql="SELECT item_no FROM $dbtable WHERE short_name='$short_name' AND long_name $sql_LIKE '$long_name'";
	   
	   if($ergebnis=$db->Execute($sql))
       {
		  if(!$ergebnis->RecordCount())
		  {   
	
		 	$sql="INSERT INTO $dbtable 
			                          (short_name,
						long_name,
						info,
						create_id,
						create_time)
			              VALUES (
						              '$short_name',
									  '$long_name',
									  '$info',
									  '".$HTTP_SESSION_VARS['sess_user_name']."',
									  '".date('YmdHis')."')";
			if($ergebnis=$core->Transact($sql))
       		{
				if($db->Affected_Rows())
				{
					$new_currency_ok=1;
				 	$saved_msg=$LDAddedNewCurrency;

					if($db_type=='mysql'){
						$item_no=$db->Insert_ID();
					}else{
						$item_no=$core->postgre_Insert_ID($dbtable,'item_no',$db->Insert_ID());
					}
					// $item_no=$db->Insert_ID();
				}
				else $new_currency_ok=0;
			}
			  else echo "<p>".$sql."<p>$LDDbNoSave";
		  }
		  else
		  {
		      $info_exist=1;
		  }
		}
		 else echo "<p>".$sql."<p>$LDDbNoRead"; 
	  }

}

if(($mode=='edit')&&$item_no)
{

    $sql="SELECT short_name,long_name,info FROM care_currency WHERE item_no='$item_no'";
	if($ergebnis=$db->Execute($sql))
	{
	  if($ergebnis->RecordCount())
	  {
	     $c_result=$ergebnis->FetchRow();
		 $short_name=$c_result['short_name'];
		 $long_name=$c_result['long_name'];
		 $info=$c_result['info'];
      }else{
	  	$item_no='';
	  }
	}else{
	   $item_no='';
	   echo "<p>$sql<p>$LDDbNoRead";
	}

}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php 
echo setCharSet(); 
?>
<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?> 

 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['body_bgcolor'];?> 
<?php if(!$item_no) : ?> onLoad="document.c_form.short_name.focus()" <?php endif ?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDCurrencyAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>

<?php 
if($info_exist)
{
?>
<font color="#990000" size=4 face="verdana,arial">
<?php
	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>'.$LDCurrencyExisting;
?>
</font>
<?php
}
?>

<br>


<ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<?php if($item_no) echo $LDUpdateCurrencyInfo; else echo $LDAddCurrency ?> </FONT><FONT    SIZE=3 color=#800000 FACE="Arial"><p>
<?php
if(($mode=='save')&&$new_currency_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'> '.$saved_msg.'<p>';
if($item_no) echo $LDPlsEnterUpdate; else echo $LDPlsAddCurrency;
?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<form action="<?php echo $thisfile ?>" method="post" name="c_form">
<table border=0 cellspacing=1 cellpadding=5>  
<tr>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDCurrencyShortName ?></b> </FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="short_name" size=10 maxlength=40 value="<?php echo $short_name ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDCurrencyLongName ?></b> </FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="long_name" size=40 maxlength=10 value="<?php echo $long_name ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDCurrencyInfo ?></b> </FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="info" size=40 maxlength=60 value="<?php echo $info ?>">
      </td>  
	</tr>
</table>
<p>
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="item_no" value="<?php echo $item_no; ?>">
<input type="hidden" name="from" value="<?php echo $from; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>
<p><br><p>
<hr>
<a href="edv_system_format_currency_set.php?<?php echo 'sid='.$sid.'&lang='.$lang; ?>">
<img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0') ?>> <?php echo $LDClk2SetCurrency; ?></a>

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
</BODY>
</HTML>
