<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Create products object
require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;

switch($cat)
{
	case "pharma":	
							$title=$LDPharmacy;
							$breakfile=$root_path."modules/pharmacy/apotheke-datenbank-functions.php".URL_APPEND."&userck=$userck";
							$imgpath=$root_path."pharma/img/";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$breakfile=$root_path."modules/med_depot/medlager-datenbank-functions.php".URL_APPEND."&userck=$userck";
							$imgpath=$root_path."med_depot/img/";
							break;
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}


$thisfile='products-datenbank-functions-eingabe.php';

if($mode=='save') include($root_path.'include/inc_products_db_save_mod.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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
	
// -->
</script> 
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_js_products.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 <?php if($mode!='save'&&$mode!='update') echo ' onLoad="document.inputform.bestellnum.focus()"'; ?>  
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial">
<STRONG> &nbsp; <?php echo "$title::$LDPharmaDb::$LDNewProduct" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products_db.php','input','<?php echo $mode ?>','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p>
<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">
<?php 
if($saveok)
{
	if($update) echo $LDUpdateOk; 
 		else echo $LDDataSaved;
}
?>

<?php if($error=="order_nr_exists") : ?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>> <?php echo $LDOrderNrExists ?>
<?php endif ?>

<?php if($update&&(!$updateok)&&($mode=='save'))
 echo $LDDataNoSaved.'<br>	<a href="products-datenbank-functions-eingabe.php'.URL_APPEND.'&cat='.$cat.'"><u>'.$LDClk2EnterNew.'</u></a>'; 
?>
</font>
  <form ENCTYPE="multipart/form-data" action="<?php echo $thisfile?>" method="post" name="inputform" onSubmit="return prufform(this)">
  <table border=0 cellspacing=2 cellpadding=3 >
    <tr >
      <td align=right width=140 bgcolor=#ffffdd><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDOrderNr ?></td>
       <td width=320  bgcolor=#ffffdd><?php if ($saveok||$update) echo '<FONT face="Verdana,Helvetica,Arial" size=3><b>'.$bestellnum.'</b><input type="hidden" name="bestellnum" value="'.$bestellnum.'">'
                                                                                                      ; else echo '<input type="text" name="bestellnum" value="'.$bestellnum.'" size=20 maxlength=20>'; ?>
          </td>
		  <td rowspan=13 valign=top  >
		  <?php if(($saveok||$update)&&($picfilename!="")) 
				echo '
						<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">'.$LDPreview.':<br>
	 					<img src="'.$imgpath.$picfilename.'" border=0 name="prevpic" >'; 
	 			else echo '<img src="../../gui/img/common/default/pixel.gif" border=0 name="prevpic" >';
			?>
			</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDArticleName ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>'.$artname.'</b><input type="hidden" name="artname" value="'.$artname.'">'
                                                                                         ; else echo '<input type="text" name="artname" value="'.$artname.'" size=40 maxlength=40></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDGeneric ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$generic.'<input type="hidden" name="generic" value="'.$generic.'">'
                                                                                         ; else echo '<input type="text" name="generic" value="'.$generic.'" size=40 maxlength=60></td>'; ?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDDescription ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.nl2br($besc).'<input type="hidden" name="besc" value="'.$besc.'">'
                                                                                      ; else echo '<textarea name="besc" cols=35 rows=4>'.$besc.'</textarea>';?>
          </td>               
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDPacking ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$pack.'<input type="hidden" name="pack" value="'.$pack.'">'
                                                                                      ; else echo '<input type="text" name="pack" value="'.$pack.'"  size=40 maxlength=40>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDCAVE ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$caveflag.'<input type="hidden" name="caveflag" value="'.$caveflag.'">'
                                                                                          ; else echo '<input type="text" name="caveflag" value="'.$caveflag.'" size=40 maxlength=80></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDCategory ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$medgroup.'<input type="hidden" name="medgroup" value="'.$medgroup.'">'
                                                                                          ; else echo '<input type="text" name="medgroup" value="'.$medgroup.'" size=20 maxlength=40></td>';?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDMinOrder ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$minorder.'<input type="hidden" name="minorder" value="'.$minorder.'">'
                                                                                          ; else echo '<input type="text" name="minorder" value="'.$minorder.'" size=20 maxlength=9>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDMaxOrder ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$maxorder.'<input type="hidden" name="maxorder" value="'.$maxorder.'">'
                                                                                          ; else echo '<input type="text" name="maxorder" value="'.$maxorder.'" size=20 maxlength=9>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDPcsProOrder ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$proorder.'<input type="hidden" name="proorder" value="'.$proorder.'">'
                                                                                          ; else echo '<input type="text" name="proorder" value="'.$proorder.'" size=20 maxlength=40>';?></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDIndustrialNr ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$artnum.'<input type="hidden" name="artnum" value="'.$artnum.'">'
                                                                                        ; else echo '<input type="text" name="artnum" value="'.$artnum.'" size=20 maxlength=20></td>'; ?>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDLicenseNr ?></td>
      <td><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$indusnum.'<input type="hidden" name="indusnum" value="'.$indusnum.'">'
                                                                                          ; else echo '<input type="text" name="indusnum" value="'.$indusnum.'" size=20 maxlength=20></td>'; ?>
    </tr>
	
	 <tr bgcolor=#ffffdd>
      <td align=right width=140><FONT face="Verdana,Helvetica,Arial" size=2 color=#000080><?php echo $LDPicFile ?></td>
      <td width=320><?php if ($saveok) echo '<FONT face="Verdana,Helvetica,Arial" size=2>'.$picfilename.'<input type="hidden" name="bild" value="'.$picfilename.'">'
	  																					; else echo '<input type="file" name="bild" onChange="getfilepath(this)">';?>
          </td>
    </tr>

<?php if(!$saveok)
	echo '
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
  <input type="hidden" name="mode" value="<?php if($saveok) echo "update"; else echo "save"; ?>">
  <input type="hidden" name="encoder" value="<?php echo  str_replace(" ","+",$HTTP_COOKIES_VARS[$local_user.$sid])?>">
  <input type="hidden" name="dstamp" value="<?php echo  str_replace("_",".",date(Y_m_d))?>">
  <input type="hidden" name="tstamp" value="<?php echo  str_replace("_",".",date(H_i))?>">
  <input type="hidden" name="lockflag" value="<?php echo  $lockflag?>">
  <input type="hidden" name="update" value="<?php if($saveok) echo "1"; else echo $update;?>">
	<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<?php if($update)
{
	if($mode!="save")
	{ echo'
	  <input type="hidden" name="ref_bnum" value="'.$bestellnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$artname.'">
 	 ';
	}
	else
	{ echo'
 	 <input type="hidden" name="ref_bnum" value="'.$ref_bnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$ref_artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$ref_indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$ref_artname.'">
	  ';
	}
}

if($saveok)
	echo '
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
	else echo'   
	</form>';

?>
</ul>

<a href="<?php echo $breakfile ?>"><img <?php if($saveok) echo createLDImgSrc($root_path,'close2.gif','0','left') ; else echo createLDImgSrc($root_path,'cancel.gif','0','left') ; ?> alt="<?php echo $LDBack2Menu ?>"></a>
 	</td>
	 </tr>
 	</table>
</FONT>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
