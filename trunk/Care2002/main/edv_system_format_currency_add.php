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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

$breakfile="edv-system-admi-menu.php?sid=$sid&lang=$lang&target=currency_admin";
$thisfile="edv_system_format_currency_add.php";
if($from=="set") $back2file="edv_system_format_currency_set.php?sid=$sid&lang=$lang&from=add";
 else $back2file=$breakfile;

$dbtable="care_currency";

if(($mode=='save')&&$short_name&&$long_name&&$info)
{
  include('../include/inc_db_makelink.php');
  if ($link&&$DBLink_OK)
  {
    if($item_no)
	{
	   $sql="UPDATE ".$dbtable." SET short_name='".$short_name."',
	                                               long_name='".$long_name."',
												   info='".$info."'
												   WHERE item_no=".$item_no;
	   if($ergebnis=mysql_query($sql,$link))
       {
		 if(mysql_affected_rows($link))
		 {
	  	    $sql="UPDATE ".$dbtable." SET 
												   modify_id='".$HTTP_COOKIE_VARS['ck_cafenews_user'.$sid]."',
												   create_time=NULL
												   WHERE item_no=".$item_no;
		   mysql_query($sql,$link);
		   $new_currency_ok=1;
		   $saved_msg=$LDCurrencyUpdated;
		 }
		   else
		   {
		     $new_currency_ok=0;
		   }
		}
		else echo "<p>".$sql."<p>$LDDbNoRead"; 
	}
	else
	{
		 	$sql="INSERT INTO $dbtable 
			                          (short_name,
									  long_name,
									  info,
									  create_id,
									  create_time,
									  modify_time)
			              VALUES (
						              '".$short_name."',
									  '".$long_name."',
									  '".$info."',
									  '".$HTTP_COOKIE_VARS['ck_cafenews_user'.$sid]."',
									  NULL,
									  NULL)";
			if($ergebnis=mysql_query($sql,$link))
       		{
				if(mysql_affected_rows($link))
				{
				   $new_currency_ok=1;
				   $saved_msg=$LDAddedNewCurrency;
				   $item_no=mysql_insert_id($link);
				}
				else $new_currency_ok=0;
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
	  }

   } else { echo "$LDDbNoLink<br> $sql<br>"; }
}

if(($mode=="edit")&&$item_no)
{
  include('../include/inc_db_makelink.php');
  if ($link&&$DBLink_OK)
  {
    $sql="SELECT short_name,long_name,info FROM care_currency WHERE item_no=".$item_no;
	if($ergebnis=mysql_query($sql,$link))
	{
	  if(mysql_num_rows($ergebnis))
	  {
	     $c_result=mysql_fetch_array($ergebnis);
		 $short_name=$c_result['short_name'];
		 $long_name=$c_result['long_name'];
		 $info=$c_result['info'];
      }
	  else $item_no="";
	}
	else
	{
	   $item_no="";
	   echo "<p>".$sql."<p>$LDDbNoRead";
	} 
  }
  else { echo "$LDDbNoLink<br> $sql<br>"; }
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?> 
<?php if(!$item_no) : ?> onLoad="document.c_form.short_name.focus()" <?php endif ?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDSystemAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br>

<ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<?php if($item_no) echo $LDUpdateCurrencyInfo; else echo $LDAddCurrency ?> </FONT><FONT    SIZE=3 color=#800000 FACE="Arial"><p>
<?php
if(($mode=='save')&&$new_currency_ok) echo '<img '.createMascot('../','mascot1_r.gif','0','absmiddle').'> '.$saved_msg.'<p>';
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
<a href="<?php echo $back2file ?>"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>></a>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc('../',$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&from=".$from ?>"><img <?php echo createLDImgSrc('../','newcurrency.gif','0') ?>></a>
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
<a href="edv_system_format_currency_set.php?<?php echo "sid=".$sid."&lang=".$lang; ?>">
<img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> <?php echo $LDClk2SetCurrency; ?></a>

</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
?>

</FONT>
</BODY>
</HTML>
