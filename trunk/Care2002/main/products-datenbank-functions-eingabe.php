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
$local_user=$userck;
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

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


$thisfile="products-datenbank-functions-eingabe.php";

if($mode=="save") include("../include/inc_products_db_save_mod.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <script language="javascript" >
<!-- 
function closewin()
{
	location.href='apotheke.php?sid=<?php echo $sid.'&lang='.$lang;?>';
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 <?php if($mode!="save") print ' onLoad="document.inputform.bestellnum.focus()"'; ?>  
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$title $LDPharmaDb $LDNewProduct" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products_db.php','input','<?php echo $mode ?>','<?php echo $cat ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p>
<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">
<?php 
if($saveok)
{
	if($update) print $LDUpdateOk; 
 		else print $LDDataSaved;
}
?>

<?php if($error=="order_nr_exists") : ?>
<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"> <?php echo $LDOrderNrExists ?>
<?php endif ?>

<?php if($update&&(!$updateok)&&($mode=="save"))
 print $LDDataNoSaved.'<br>	<a href="apotheke-datenbank-functions-eingabe.php?sid='.$sid.'"><u>'.$LDClk2EnterNew.'</u></a>'; 
?>
</font>
  <form ENCTYPE="multipart/form-data" action="<?php echo $thisfile?>" method="post" name="inputform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3 width=100%>
    <tr >
      <td align=right width=140 bgcolor=#ffffdd><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDOrderNr ?></td>
      <td width=320  bgcolor=#ffffdd><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$bestellnum.'<input type="hidden" name="bestellnum" value="'.$bestellnum.'">'
                                                                                                      ; else print '<input type="text" name="bestellnum" value="'.$bestellnum.'" size=20 maxlength=20>'; ?>
          </td>
		  <td rowspan=13 valign=top  >
		  <?php if(($saveok||$update)&&($picfilename!="")) 
				print '
						<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">'.$LDPreview.':<br>
	 					<img src="'.$imgpath.$picfilename.'" border=0 name="prevpic" >'; 
	 			else print '<img src="../img/pixel.gif" border=0 name="prevpic" >';
			?>
			</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDArticleName ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>'.$artname.'</b><input type="hidden" name="artname" value="'.$artname.'">'
                                                                                         ; else print '<input type="text" name="artname" value="'.$artname.'" size=40 maxlength=40></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDGeneric ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$generic.'<input type="hidden" name="generic" value="'.$generic.'">'
                                                                                         ; else print '<input type="text" name="generic" value="'.$generic.'" size=40 maxlength=60></td>'; ?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDDescription ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.nl2br($besc).'<input type="hidden" name="besc" value="'.$besc.'">'
                                                                                      ; else print '<textarea name="besc" cols=35 rows=4>'.$besc.'</textarea>';?>
          </td>               
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDPacking ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$pack.'<input type="hidden" name="pack" value="'.$pack.'">'
                                                                                      ; else print '<input type="text" name="pack" value="'.$pack.'"  size=40 maxlength=40>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDCAVE ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$caveflag.'<input type="hidden" name="caveflag" value="'.$caveflag.'">'
                                                                                          ; else print '<input type="text" name="caveflag" value="'.$caveflag.'" size=40 maxlength=80></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDCategory ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$medgroup.'<input type="hidden" name="medgroup" value="'.$medgroup.'">'
                                                                                          ; else print '<input type="text" name="medgroup" value="'.$medgroup.'" size=20 maxlength=40></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDMinOrder ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$minorder.'<input type="hidden" name="minorder" value="'.$minorder.'">'
                                                                                          ; else print '<input type="text" name="minorder" value="'.$minorder.'" size=20 maxlength=9>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDMaxOrder ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$maxorder.'<input type="hidden" name="maxorder" value="'.$maxorder.'">'
                                                                                          ; else print '<input type="text" name="maxorder" value="'.$maxorder.'" size=20 maxlength=9>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDPcsProOrder ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$proorder.'<input type="hidden" name="proorder" value="'.$proorder.'">'
                                                                                          ; else print '<input type="text" name="proorder" value="'.$proorder.'" size=20 maxlength=40>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDIndustrialNr ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$artnum.'<input type="hidden" name="artnum" value="'.$artnum.'">'
                                                                                        ; else print '<input type="text" name="artnum" value="'.$artnum.'" size=20 maxlength=20></td>'; ?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDLicenseNr ?></td>
      <td><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$indusnum.'<input type="hidden" name="indusnum" value="'.$indusnum.'">'
                                                                                          ; else print '<input type="text" name="indusnum" value="'.$indusnum.'" size=20 maxlength=20></td>'; ?>
    </tr>
	
	 <tr bgcolor=#ffffdd>
      <td align=right width=140><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDPicFile ?></td>
      <td width=320><?php if ($saveok) print '<FONT face="Verdana,Helvetica,Arial" size=2>'.$picfilename.'<input type="hidden" name="bild" value="'.$picfilename.'">'
	  																					; else print '<input type="file" name="bild" onChange="getfilepath(this)">';?>
          </td>
    </tr>

<?php if(!$saveok)
	print '
    <tr >
      
      <td><input type="reset" value="'.$LDReset.'" onClick="document.inputform.bestellnum.focus()" >
                      </td>
    <td  align=right >
	  	<input type="hidden" name="picref" value="'.$picfilename.'">
		<input type="submit" value="'.$LDSave.'">
           </td>
   </tr>
	
  
  ';
 ?>
 	<tr>	 
	<td colspan=2 >

  <input type="hidden" name="sid" value="<?php echo $sid?>">
  <input type="hidden" name="lang" value="<?php echo $lang?>">
  <input type="hidden" name="cat" value="<?php echo $cat?>">
  <input type="hidden" name="userck" value="<?php echo $userck?>">
  <input type="hidden" name="picfilename" value="<?php echo  $picfilename ?>">
  <input type="hidden" name="mode" value="<?php if($saveok) print "update"; else print "save"; ?>">
  <input type="hidden" name="encoder" value="<?php echo  str_replace(" ","+",$HTTP_COOKIES_VARS[$local_user.$sid])?>">
  <input type="hidden" name="dstamp" value="<?php echo  str_replace("_",".",date(Y_m_d))?>">
  <input type="hidden" name="tstamp" value="<?php echo  str_replace("_",".",date(H_i))?>">
  <input type="hidden" name="lockflag" value="<?php echo  $lockflag?>">
  <input type="hidden" name="update" value="<?php if($saveok) print "1"; else print $update;?>">
	<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<?php if($update)
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
  	<input type="hidden" name="sid" value="'.$sid.'">
  	<input type="hidden" name="lang" value="'.$lang.'">
  	<input type="hidden" name="cat" value="'.$cat.'">
  	<input type="hidden" name="userck" value="'.$userck.'">
	<input type="hidden" name="update" value="0">
      </form>';
	else print'   
	</form>';

?>
</ul>

<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_<?php if($saveok) print "close2"; else print "cancel"; ?>.gif" border=0 width=103 height=24 alt="<?php echo $LDBack2Menu ?>" align=left></a>
 	</td>
	 </tr>
 	</table>
</FONT>
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
