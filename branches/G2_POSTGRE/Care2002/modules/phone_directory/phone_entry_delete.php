<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/*
CARE 2X Integrated Information System beta 1.0.09 - 2003-11-25 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','phone.php');
$local_user='phonedir_user';
require_once($root_path.'include/inc_front_chain_lang.php');
//$db->debug=true;
//$dbtable='care_phone';
$forwardfile='phone_list.php';
$breakfile='phone_list.php';
$thisfile=basename(__FILE__);

# Load the Comm class and create comm (phone) object
require_once($root_path.'include/care_api_classes/class_comm.php');
$phone = & new Comm;

/* Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');

if ($finalcommand=='delete'){
    if ($phone->deleteData($itemname)){
	    # check if the pagecount is reduced
        $buffer=($pagecount-1)*$displaysize;
        if (($buffer+1)==$linecount){
		        $pagecount--;
			    if($batchnum>1)  $batchnum--;
		}
        $linecount--;
        header("Location: phone_list.php".URL_REDIRECT_APPEND."&route=validroute&remark=itemdelete&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit");
        exit;
    }else{
        echo $phone->getLastQuery()."<br>$LDDbNoDelete";
    }
}else{

    $fielddata='item_nr, title, name, vorname, beruf, bereich1, bereich2,  inphone1, inphone2, inphone3, exphone1, exphone2, funk1, funk2,  roomnr';

    if(!$zeile=$phone->getData($itemname,$fielddata)){
        $zeile=array();
        echo $phone->getLastQuery()."<br>$LDDbNoRead<br>";
    }
}
?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY  bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<FONT    SIZE=-1  FACE="Arial">

<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDPhoneDir ?></b></font>

<table width=100% border=1>
<tr>
<td bgcolor="navy" >
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDDeleteEntry ?></STRONG></FONT>
</td>
</tr>
<tr>
<td bgcolor="#DDE1EC">
<p><br>
<center>
<table  border=1 cellpadding="20" >
<tr nowrap>
<td bgcolor="#ffffaa">
<p><FONT SIZE=2  FACE=Arial>
<?php echo $LDReallyDelete ?><p>

<table border="0" cellpadding="2" cellspacing="1">
<tr bgcolor="#0000cc" nowrap>
<?php
	for($i=0;$i<(sizeof($LDEditFields));$i++) 
 	{	
		if($zeile[$i]!="") 	
		echo "<td nowrap><FONT color=\"#fffff\" SIZE=2  FACE=Arial><b>".$LDEditFields[$i]."</b></td>\n";
   	}
?>
</tr>
<tr bgcolor="#f9f9f9" nowrap>
<?php

$colstop=sizeof($LDEditFields);

	for($i=0;$i<$colstop;$i++) 
 	{	
		if($zeile[$i]!="") 	
		{
		    echo "<td nowrap><FONT color=\"#000000\" SIZE=2  FACE=Arial><nobr>";
		
		    if($i == ($colstop-3)) echo formatDate2Local($zeile[$i],$date_format);
			 elseif($i==($colstop-2)) echo  convertTimeToLocal($zeile[$i]);
			   else echo $zeile[$i];
						   
		    echo "</td>\n";
	    }
   	}
?>
</tr>
</table>
<br>

<FORM action="<?php echo $thisfile ?>" method="post">
<INPUT type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name=finalcommand value="delete">
<input type="hidden" name=route value="validroute">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name=batchnum value="<?php echo $batchnum ?>">
<input type="hidden" name=displaysize value="<?php echo $displaysize ?>">
<input type="hidden" name=linecount value="<?php echo $linecount ?>">
<input type="hidden" name=pagecount value="<?php echo $pagecount ?>">
<input type="hidden" name=edit value="<?php echo $edit ?>">
<INPUT type="submit" name="versand" value="<?php echo $LDYesDelete ?>"></font></FORM>

<FORM  method=post action="<?php echo $breakfile ?>" >
<input type="hidden" name=route value="validroute">
<input type="hidden" name=batchnum value="<?php echo $batchnum ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name=displaysize value="<?php echo $displaysize ?>">
<input type="hidden" name=linecount value="<?php echo $linecount ?>">
<input type="hidden" name=pagecount value="<?php echo $pagecount ?>">
<input type="hidden" name=edit value="<?php echo $edit ?>">
<INPUT type="submit"  value="<?php echo $LDNoCancel ?>"></font></FORM>

</center>
</td>
</tr>
</table>        
<p><br>
</td>
</tr>
</table>        
<p>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDHowManage ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDHowEnter ?></a><br>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>