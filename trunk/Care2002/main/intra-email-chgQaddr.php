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
define("LANG_FILE","intramail.php");
$local_user="ck_intra_email_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php"); // load color preferences

$thisfile="intra-email-chgQaddr.php";

//init db parameters
$dbtable="mail_private_users";

$linecount=0;

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
				$sql='SELECT addr_book, lastcheck FROM '.$dbtable.' WHERE  email="'.addslashes($eadd).'"';
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($content=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=mysql_fetch_array($ergebnis);
						
					} //end of if rows

				}else { print "$LDDbNoRead<br>$sql"; } 
	
		if($mode=="saveQadd")
		{
			$buf="";
			for($i=0;$i<5;$i++)
			{
				
				$abuf="qadres$i";//print "$abuf<br>".$$abuf."<br>";
				if($$abuf=="") continue;
				if($buf=="") $buf=$$abuf;
				else $buf.="; ".$$abuf; //print "$buf<br>".$$abuf."<br>";
			}
				$sql='UPDATE '.$dbtable.' SET addr_quick="'.$buf.'", lastcheck="'.$content[lastcheck].'" WHERE  email="'.addslashes($eadd).'"';
				if($ergebnis=mysql_query($sql,$link))
				{
					$saveok=1;
				}
				 else { print "$LDDbNoUpdate<br>$sql"; } 
		}
		
				$sql='SELECT addr_quick FROM '.$dbtable.' WHERE  email="'.addslashes($eadd).'"';
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($result=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$result=mysql_fetch_array($ergebnis);
						
					} //end of if rows
				}else { print "$LDDbNoRead<br>$sql"; } 
	}
  		else { print "$LDDbNoLink<br>$sql"; } 


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?php echo "$LDIntraEmail $LDQuickAddr"; ?></TITLE>

 <script language="javascript" >
<!-- 
var chgTag=false;
<?php if($saveok) print "var saveTag=true;"; 
else print "var saveTag=false;"; 
?>

function chkform(d)
{
 	if(!chgTag) return false;
	return true;		
}

function selectAll(s,m)
{
	if(s.checked) v="true"; else v="false";
	d=document.addrlist;
	for(i=0;i<m;i++) eval("d.del"+i+".checked="+v);
}

function enterQadd()
{
	d=document.qaselect;
	s=d.quick.length;
	if((s==5)||(d.adrs.selectedIndex==-1)) 
	{	d.adrs.selectedIndex=-1; return;}
	idx=d.adrs.selectedIndex;
	var opt= new Option(d.adrs.options[idx].text,d.adrs.options[idx].text);
	d.quick.options[d.quick.length]=opt;
	eval("d.qadres"+s+".value='"+d.adrs.options[idx].text+"'");
	d.adrs.selectedIndex=-1;
	chgTag=true;
}
function delQadd()
{
	d=document.qaselect;
	if(d.quick.selectedIndex==-1) return false;
	idx=d.quick.selectedIndex;
	d.quick.options[idx]=null;
	eval("d.qadres"+idx+".value=''");
	chgTag=true;
}

function closeit()
{
if(saveTag) window.opener.location.reload();
window.close();
}
// -->
</script> 

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus()" 
<?php 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
 
<?php if($mode=="saveQadd") : ?>
<script language=javascript>

</script>
<?php endif?>

<?php //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>"  height="30">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo "$LDIntraEmail $LDQuickAddr"; ?></STRONG></FONT></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top >

<FONT face="Verdana,Helvetica,Arial" size=2>

<FONT face="Verdana,Helvetica,Arial" size=2 color=#800000><b><?php echo $eadd; ?></b>
<p><br>

<form name=qaselect onSubmit="return chkform(this)">
<table border=0>
  <tr>
  <td align=center valign=top><FONT face="Verdana,Helvetica,Arial" size=2 color=#800000>
  		<b><?php echo $LDAddrBook ?></b></td><td></td>
  <td align=center valign=top><FONT face="Verdana,Helvetica,Arial" size=2 color=#800000>
  		<b><?php echo $LDQuickAddr ?>:<br><font size=1>< <?php echo $LDMaximum; ?> 5 ></b></td><td></td>
    </tr>
	<tr><td><select name="adrs" size=5>
<?php
$a_info=explode("_",$content[addr_book]);
	for ($i=0;$i<sizeof($a_info);$i++)
	{
		parse_str($a_info[$i],$c);
		print' <option value="'.trim($c[e]).'">'.trim($c[e]).'</option>';
	}
?>
        </select>
        
        </td>
    <td><input type="button" value="<?php echo $LDInsertAddr; ?> >>" onClick="enterQadd()">
        </td>
    <td>
<?php
print '
	<select name="quick" size=5>';
	$c=explode("; ",trim($result[addr_quick]));
	$maxrow=sizeof($c);
	if(($maxrow==1)&&(trim($c[0])=="")) $maxrow=0;
	for ($i=0;$i<$maxrow;$i++)
	{
		print' 
				<option value="'.trim($c[$i]).'">'.trim($c[$i]).'</option>';
	}
	print '	
		</select>';
	for ($i=0;$i<5;$i++)
	{
		print' 
				<input type="hidden" name="qadres'.$i.'" value="'.trim($c[$i]).'">';
	}
?>

          
        </td>
    <td><input type="button" value="<?php echo $LDDelete ?> >>" onClick="delQadd()">
        </td>
  </tr>
   <tr>
  <td ></td>
  <td></td>
  <td ><input type="hidden" name="mode" value="saveQadd">
  			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
     		<input type="hidden" name="lang" value="<?php echo $lang; ?>">
     		<input type="hidden" name="eadd" value="<?php echo $eadd; ?>">
       <p>
		&nbsp;<input type="submit" value="<?php echo $LDSave; ?>"></td>
	<td></td>
    </tr>

</table>

</form>


  &nbsp; &nbsp;
   <font size=1><a href="javascript:closeit()">
   <img src="../img/l_arrowGrnSm.gif" width=12 height=12 border=0 align=middle> <?php echo $LDClose; ?>
</a></font>
  
  
</FONT>
<p>
</td>
</tr>

</table>        

</FONT>


</BODY>
</HTML>
