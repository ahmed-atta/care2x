<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_prod_db_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_products.php");
require("../req/config-color.php");

switch($cat)
{
	case "pharma":	
							$title=$LDPharmacy;
							$breakfile="apotheke-datenbank-functions.php?sid=$ck_sid&lang=$lang";
							$imgpath="../pharma/img/";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$breakfile="medlager-datenbank-functions.php?sid=$ck_sid&lang=$lang";
							$imgpath="../med_depot/img/";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}


$thisfile="products-datenbank-functions-eingabe.php";

if($mode=="save") include("../req/products-db-save-mod.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <script language="javascript" >
<!-- 
function closewin()
{
	location.href='apotheke.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}

function getfilepath(d)
{
	//document.inputform.picfilename.value=d.value;
	document.prevpic.src=d.value;
}

function pruf(d)
{
	if(d.bestellnum.value=="")
	{
		alert("<?=$LDAlertNoOrderNr ?>");
		return false;
	}
	if(d.artname.value=="")
	{
		alert("<?=$LDAlertNoArticleName ?>");
		return false;
	}
	if(d.besc.value=="")
	{
		alert("<?=$LDAlertNoDescription ?>");
		 return false;
	}
	return true;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 <? if($mode!="save") print ' onLoad="document.inputform.bestellnum.focus()"'; ?>  
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?="$title $LDPharmaDb $LDNewProduct" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('products_db.php','input','<?=$mode ?>','<?=$cat ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">
<? 
if($saveok)
{
	if($update) print $LDUpdateOk; 
 		else print $LDDataSaved;
}
?>

<? if($error=="order_nr_exists") : ?>
<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"> <?=$LDOrderNrExists ?>
<? endif ?>

<?
if($update&&(!$updateok)&&($mode=="save"))
 print $LDDataNoSaved.'<br>	<a href="apotheke-datenbank-functions-eingabe.php?sid='.$ck_sid.'"><u>'.$LDClk2EnterNew.'</u></a>'; 
?>
</font>
  <form ENCTYPE="multipart/form-data" action="<?=$thisfile?>" method="post" name="inputform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3 width=100%>
    <tr >
      <td align=right width=140 bgcolor=#ffffdd><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDOrderNr ?></td>
      <td width=320  bgcolor=#ffffdd><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$bestellnum.'<input type="hidden" name="bestellnum" value="'.$bestellnum.'">'
                                                                                                      ; else print '<input type="text" name="bestellnum" value="'.$bestellnum.'" size=20 maxlength=20>'; ?>
          </td>
		  <td rowspan=13 valign=top  >
		  <? if(($saveok||$update)&&($picfilename!="")) 
				print '
						<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">'.$LDPreview.':<br>
	 					<img src="'.$imgpath.$picfilename.'" border=0 name="prevpic" >'; 
	 			else print '<img src="../img/pixel.gif" border=0 name="prevpic" >';
			?>
			</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDArticleName ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>'.$artname.'</b><input type="hidden" name="artname" value="'.$artname.'">'
                                                                                         ; else print '<input type="text" name="artname" value="'.$artname.'" size=40 maxlength=40></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDGeneric ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$generic.'<input type="hidden" name="generic" value="'.$generic.'">'
                                                                                         ; else print '<input type="text" name="generic" value="'.$generic.'" size=40 maxlength=60></td>'; ?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDDescription ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.nl2br($besc).'<input type="hidden" name="besc" value="'.$besc.'">'
                                                                                      ; else print '<textarea name="besc" cols=35 rows=4>'.$besc.'</textarea>';?>
          </td>               
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDPacking ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$pack.'<input type="hidden" name="pack" value="'.$pack.'">'
                                                                                      ; else print '<input type="text" name="pack" value="'.$pack.'"  size=40 maxlength=40>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDCAVE ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$caveflag.'<input type="hidden" name="caveflag" value="'.$caveflag.'">'
                                                                                          ; else print '<input type="text" name="caveflag" value="'.$caveflag.'" size=40 maxlength=80></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDCategory ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$medgroup.'<input type="hidden" name="medgroup" value="'.$medgroup.'">'
                                                                                          ; else print '<input type="text" name="medgroup" value="'.$medgroup.'" size=20 maxlength=40></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDMinOrder ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$minorder.'<input type="hidden" name="minorder" value="'.$minorder.'">'
                                                                                          ; else print '<input type="text" name="minorder" value="'.$minorder.'" size=20 maxlength=9>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDMaxOrder ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$maxorder.'<input type="hidden" name="maxorder" value="'.$maxorder.'">'
                                                                                          ; else print '<input type="text" name="maxorder" value="'.$maxorder.'" size=20 maxlength=9>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDPcsProOrder ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$proorder.'<input type="hidden" name="proorder" value="'.$proorder.'">'
                                                                                          ; else print '<input type="text" name="proorder" value="'.$proorder.'" size=20 maxlength=40>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDIndustrialNr ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$artnum.'<input type="hidden" name="artnum" value="'.$artnum.'">'
                                                                                        ; else print '<input type="text" name="artnum" value="'.$artnum.'" size=20 maxlength=20></td>'; ?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDLicenseNr ?></td>
      <td><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$indusnum.'<input type="hidden" name="indusnum" value="'.$indusnum.'">'
                                                                                          ; else print '<input type="text" name="indusnum" value="'.$indusnum.'" size=20 maxlength=20></td>'; ?>
    </tr>
	
	 <tr bgcolor=#ffffdd>
      <td align=right width=140><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?=$LDPicFile ?></td>
      <td width=320><? if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$picfilename.'<input type="hidden" name="bild" value="'.$picfilename.'">'
	  																					; else print '<input type="file" name="bild" onChange="getfilepath(this)">';?>
          </td>
    </tr>

<? if(!$saveok)
	print '
    <tr >
      <td >
	  	<input type="hidden" name="picref" value="'.$picfilename.'">
		<input type="submit" value="'.$LDSave.'">
           </td>
      <td align=right ><input type="reset" value="'.$LDReset.'" onClick="document.inputform.bestellnum.focus()" >
                      </td>
    </tr>
	
  
  ';
 ?>
 	<tr>	 
	<td colspan=2 >

  <input type="hidden" name="sid" value="<?=$ck_sid?>">
  <input type="hidden" name="lang" value="<?=$lang?>">
  <input type="hidden" name="cat" value="<?=$cat?>">
  <input type="hidden" name="picfilename" value="<?= $picfilename ?>">
  <input type="hidden" name="mode" value="<? if($saveok) print "0"; else print "save"; ?>">
  <input type="hidden" name="encoder" value="<?= str_replace(" ","+",$ck_products_db_user)?>">
  <input type="hidden" name="dstamp" value="<?= str_replace("_",".",date(Y_m_d))?>">
  <input type="hidden" name="tstamp" value="<?= str_replace("_",".",date(H_i))?>">
  <input type="hidden" name="lockflag" value="<?= $lockflag?>">
  <input type="hidden" name="update" value="<? if($saveok) print "1"; else print $update;?>">
	<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<?
if($update)
{
	if($mode!="save")
	{ print'
	  <input type="hidden" name="ref_bnum" value="'.$bestellnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$artname.'">
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
}

if($saveok)
	print '
  	<input type="submit" value="'.$LDUpdateData.'">
	</form>
	<form name="updateform" action="'.$thisfile.'">
 	<input type="submit" value="'.$LDNewProduct.'">    
  	<input type="hidden" name="sid" value="'.$ck_sid.'">
  	<input type="hidden" name="lang" value="'.$lang.'">
  	<input type="hidden" name="cat" value="'.$cat.'">
	<input type="hidden" name="update" value="0">
      </form>';
	else print'   
	</form>';

?>
</ul>

<a href="<?="$breakfile?sid=$ck_sid&lang=$lang" ?>"><img src="../img/<?="$lang/$lang" ?>_<? if($saveok) print "close2"; else print "cancel"; ?>.gif" border=0 width=103 height=24 alt="<?=$LDBack2Menu ?>" align=right></a>
 	</td>
	 </tr>
 	</table>
</FONT>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.htm");

 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
