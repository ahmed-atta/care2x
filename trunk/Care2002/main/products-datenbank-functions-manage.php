<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","products.php");
if(!isset($userck)) $userck="";
$local_user=$userck;
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$thisfile="products-datenbank-functions-manage.php";

if(!isset($mode)) $mode="";
if(!isset($cat)) $cat="";
if(!isset($linecount)) $linecount="";
switch($cat)
{
	case "pharma":	
							$title=$LDPharmacy;
							$breakfile="apotheke-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							$imgpath="../pharma/img/";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$breakfile="medlager-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							$imgpath="../med_depot/img/";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

if($mode=="save")
{
include("../include/inc_products_db_save_mod.php");
}

if($mode!="") include("../include/inc_products_search_mod.php");

if($linecount==1) {  $from="multiple"; }
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <script language="javascript" >
<!-- 

function pruf(d)
{
	if(d.keyword.value=="")
	{
		d.keyword.focus();
		 return false;
	}
	return true;
}

function prufform(d)
{
	if(d.bestellnum.value=="")
	{
		alert("<?php echo $LDAlertNoOrderNr ?>");
		return false;
	}
	if(d.artname.value=="")
	{
		alert("<?php echo $LDAlertNoArticleName ?>");
		return false;
	}
	if(d.besc.value=="")
	{
		alert("<?php echo $LDAlertNoDescription ?>");
		 return false;
	}
	return true;
}

function getfilepath(d)
{
	//document.inputform.picfilename.value=d.value;
	document.prevpic.src=d.value;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.select()" 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$title $LDPharmaDb $LDManage" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products_db.php','mng','<?php echo $from ?>','<?php echo $cat ?>','<?php echo $update ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
<?php if($from=="deleteok") print'
	<FONT size=3 color="#800000">'.$LDDataRemoved.'</font>
	<hr>';
?>

  <form action="<?php echo $thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><?php echo $LDSearchWordPrompt ?></font>
	  <br><p></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDSearchKey ?>:</td>
      <td><input type="text" name="keyword" size=40 maxlength=40 value="<?php echo $keyword ?>">
          </td>
    </tr>
   

    <tr >
      <td>&nbsp;
           </td>      
		   <td align="right"><input type="submit" value="<?php echo $LDSearch ?>" >
           </td>
<!--       <td align=right><p><br><input type="reset" value="Löschen" onClick="document.suchform.keyword.focus()">
                      </td> -->
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid?>">
  <input type="hidden" name="lang" value="<?php echo $lang?>">
  <input type="hidden" name="cat" value="<?php echo $cat?>">
  <input type="hidden" name="userck" value="<?php echo $userck?>">
  <input type="hidden" name="mode" value="search">
  </form>

<hr>
<?php if($linecount==1) print '
				<form ENCTYPE="multipart/form-data" action="'.$thisfile.'" method="post" name="inputform" >';

if($mode=="save")
	if($saveok)print' 
		<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">
		'.$LDDataSaved.'</font>';
	else print '		
		<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">'.$LDDataNoSaved.'<br>
		<font color="#000000">	<a href="apotheke-datenbank-functions-eingabe.php?sid='.$sid.'&lang='.$lang.'">
			<u>'.$LDClk2EnterNew.'</u></a></font></font>';


require("../include/inc_products_search_result_mod.php");

if($linecount==1)
{
/*<input type="hidden" name="picfilename" value="'.$zeile[picfile].'"> 
*/
print '
<input type="hidden" name="encoder" value="'.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'">
<input type="hidden" name="dstamp" value="'.str_replace("_",".",date(Y_m_d)).'">
<input type="hidden" name="tstamp" value="'.str_replace("_",".",date(H_i)).'">
<input type="hidden" name="lock_flag" value="">
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="cat" value="'.$cat.'">
<input type="hidden" name="userck" value="'.$userck.'">
<input type="hidden" name="keyword" value="'.$zeile[bestellnum].'">
<input type="hidden" name="update" value="1">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
';

if($mode=="search")
	{ print'
	  <input type="hidden" name="ref_bnum" value="'.$zeile[bestellnum].'">
	  <input type="hidden" name="ref_artnum" value="'.$zeile[artikelnum].'">
 	 <input type="hidden" name="ref_indusnum" value="'.$zeile[industrynum].'">
 	 <input type="hidden" name="ref_artname" value="'.$zeile[artikelname].'">
 	 ';
	}
	else
	{ print'
 	 <input type="hidden" name="ref_bnum" value="'.$ref_bnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$ref_artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$ref_indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$ref_artname.'">
	  ';
	}
	
	if($update&&(!$saveok))
	{
		print'
 		<input type="hidden" name="mode" value="save">
		<input type="hidden" name="picref" value="'.$zeile[picfile].'">
  		<input type="submit" value="'.$LDSave.'"
		</form>';
	}
	else
	{
		print'
		<input type="hidden" name="mode" value="search">
		<input type="submit" value="'.$LDUpdateData.'">
		</form>';

		print'
		<form action="products-datenbank-functions-datadelete.php" method="get" name="delform">
  		<input type="hidden" name="sid" value="'.$sid.'">
		<input type="hidden" name="lang" value="'.$lang.'">
		<input type="hidden" name="userck" value="'.$userck.'">
		<input type="hidden" name="cat" value="'.$cat.'">';
		if($zeile[bestellnum]!="") print '
  		<input type="hidden" name="keyword" value="'.$zeile[bestellnum].'">
		<input type="hidden" name="keytype" value="bestellnum">';
		else if($zeile[artikelnum]!="") print '
  				<input type="hidden" name="keyword" value="'.$zeile[artikelnum].'">
				<input type="hidden" name="keytype" value="artikelnum">';
		else if($zeile[industrynum]!="") print '
  				<input type="hidden" name="keyword" value="'.$zeile[industrynum].'">
				<input type="hidden" name="keytype" value="industrynum">';
		else if($zeile[artikelname]!="") print '
  				<input type="hidden" name="keyword" value="'.$zeile[artikelname].'">
				<input type="hidden" name="keytype" value="artikelname">';
		else if($zeile[generic]!="") print '
  				<input type="hidden" name="keyword" value="'.$zeile[generic].'">
				<input type="hidden" name="keytype" value="generic">';
		print'
  		<input type="hidden" name="mode" value="delete">
		<input type="hidden" name="sure" value="0">
		<input type="hidden" name="cat" value="'.$cat.'">
  		<input type="submit" value="'.$LDRemoveFromDb.'">
       	</form>
		';
	}
}
?>
<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 align="left"></a>
<?php if ($from=="multiple")
print '
<a href="javascript:history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width="110" height="24" border="0" alt="'.$LDBack.'" align="absmiddle "></a>
';
?>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
