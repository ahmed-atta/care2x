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
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
$thisfile='aufnahme_list.php';

$dbtable='care_admission_patient';

if($dept=='') $dept='plop';

/* Load the date formatter */
require_once('../include/inc_date_format_functions.php');


$linecount=0;
if(($mode=='search')||($mode=='select'))
{
	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case 'search':
							$sql="SELECT * FROM $dbtable WHERE ";
							$s2="";
							if($name) $s2.=" name=\"$name\"";
							if($date_start)
								{
								    $date_start=formatDate2STD($date_start,$date_format);
  								}
							if($date_end)
								{
								    $date_end=formatDate2STD($date_end,$date_format);
							   }
							if(($date_start)&&($date_end))
								{
									if($s2) $s2.=" AND sdate>=\"$date_start\" AND sdate<=\"$date_end\""; else $s2.=" sdate>=\"$date_start\" AND sdate<=\"$date_end\"";
								}
								elseif($date_start)
								{
									if($s2) $s2.=" AND sdate=\"$date_start\""; else $s2.=" sdate=\"$date_start\"";
								}
								elseif($date_end)
								{
									if($s2) $s2.=" AND sdate=\"$date_end\""; else $s2.=" sdate=\"$date_end\"";
								}
								
							if($encoder)
								if($s2) $s2.=" AND encoder=\"$encoder\""; else $s2.=" encoder=\"$encoder\"";
							if($patnum)
								if($s2) $s2.=" AND patnum=\"$patnum\""; else $s2.=" patnum=\"$patnum\"";
							if($title)
								if($s2) $s2.=" AND title=\"$title\""; else $s2.=" title=\"$title\"";
							if($vorname)
								if($s2) $s2.=" AND vorname=\"$vorname\""; else $s2.=" vorname=\"$vorname\"";
							if($gebdatum)
							  {
							    $gebdatum=formatDate2STD($gebdatum,$date_format);
								
								if($s2) $s2.=" AND gebdatum=\"$gebdatum\""; else $s2.=" gebdatum=\"$gebdatum\"";
							  }
							if($address)
								if($s2) $s2.=" AND address LIKE \"%$address%\""; else $s2.=" address LIKE \"%$address%\"";
							if($sex)
								if($s2) $s2.=" AND sex=\"$sex\""; else $s2.=" sex=\"$sex\"";
							if($status)
								if($s2) $s2.=" AND status=\"$status\""; else $s2.=" status=\"$status\"";
							if($kasse)
								if($s2) $s2.=" AND kasse=\"$kasse\""; else $s2.=" kasse=\"$kasse\"";
							if($kassename)
								if($s2) $s2.=" AND kassename=\"$kassename\""; else $s2.=" kassename=\"$kassename\"";
							if($diagnose)
								if($s2) $s2.=" AND diagnose LIKE \"%$diagnose%\""; else $s2.=" diagnose LIKE \"%$diagnose%\"";
							if($referrer)
								if($s2) $s2.=" AND referrer LIKE \"%$referrer%\""; else $s2.=" referrer LIKE \"%$referrer%\"";
							if($therapie)
								if($s2) $s2.=" AND therapie LIKE \"%$therapie%\""; else $s2.=" therapie LIKE \"%$therapie%\"";
							if($besonder)
								if($s2) $s2.=" AND besonder LIKE \"%$besonder%\""; else $s2.=" besonder LIKE \"%$besonder%\"";
								
							$sql=$sql.$s2." AND patnum<>'' ORDER BY	name";
							//echo $sql;
							if($s2!="")
								if($ergebnis=mysql_query($sql,$link)) 
								{			
						  			$rows=0;
									while($result=mysql_fetch_array($ergebnis)) $rows++;	
									if($rows)
									{
										mysql_data_seek($ergebnis,0);
									}
								}else echo "$LDDbNoRead<p> $sql <p>";
							if($rows==1)
							 {
								$result=mysql_fetch_array($ergebnis);
								$mode="select";
							}
							break;
			case 'select':
							$sql='SELECT * FROM '.$dbtable.' WHERE  item="'.$i.'" 
																			AND pdate="'.$dt.'"
																			AND patnum="'.$n.'" 
																			AND	name="'.$ln.'"
																			AND	vorname="'.$fn.'"
																			AND	gebdatum="'.$bd.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
								}
							}else echo "$LDDbNoRead<p> $sql <p>";
							//echo $sql;
							break;
		} // end of switch
  }   	
   else { echo "$LDDbNoLink<br>"; }
}
      


?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>

// -->
</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>

<script language="javascript" src="../js/setdatetime.js"></script>

<?php 
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>
<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
 bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; }
 if(($mode!="select")&&(!$rows)) echo ' onLoad="document.archivform.patnum.select()" '; ?>>



<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDAdmArchive ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2arch.php','<?php echo $mode ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo "aufnahme_pass.php?sid=$sid&target=archiv&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>
<ul>

<table  border=0 cellpadding=0 cellspacing=0 width="90%">
<tr>
<td colspan=3><a href="<?php if($HTTP_COOKIE_VARS[$local_user.$sid]) echo "aufnahme_start.php?sid=$sid&mode=?&lang=$lang"; 
else echo "aufnahme_pass.php?sid=".$sid."&lang=".$lang; ?>"><img <?php echo createLDImgSrc('../','ein-gray.gif','0') ?> 
alt="<?php echo $LDAdmit ?>" <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) 
onMouseOut=hilite(this,0)>';?></a><a href="<?php if($HTTP_COOKIE_VARS[$local_user.$sid]) 
echo "aufnahme_daten_such.php?sid=$sid&mode=?&lang=$lang"; else echo "aufnahme_such_pass.php?sid=".$sid."&lang=".$lang; ?>" ><img <?php echo createLDImgSrc('../','such-gray.gif','0') ?> 
alt="<?php echo $LDSearch ?>" <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) 
onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img <?php echo createLDImgSrc('../','arch-blu.gif','0') ?> 
alt="<?php echo $LDArchive ?>"></td>
</tr>

<tr>
<td bgcolor=#333399 colspan=3>
<FONT  COLOR="white"  SIZE=1  FACE="Arial"><STRONG> &nbsp;</STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC">
<td bgcolor=#333399>&nbsp;</td>
<td ><br>


<ul>
<?php if($mode=='search') echo '<FONT  SIZE=2 FACE="verdana,Arial">'.$LDSearchKeyword.': '.$s2; ?>
<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
  <?php
for($j=0;$j<sizeof($LDElements);$j++)
		echo '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDElements[$j].'</b></td>';
	?>
  </tr>
 <?php 
 /* Load common icons*/
 $img_arrow=createComIcon('../','r_arrowgrnsm.gif','0');
 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $buf='aufnahme_list.php?sid='.$sid.'&lang='.$lang.'&mode=select&i='.$result[item].'&dt='.$result[pdate].'&n='.$result[patnum].'&ln='.strtr($result[name]," ","+").'&fn='.strtr($result[vorname]," ","+").'&bd='.$result[gebdatum];
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.$img_arrow.'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[name].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[vorname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($result[gebdatum],$date_format).'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patnum].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($result[pdate],$date_format).'</a></td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  action="aufnahme_list.php">
<FONT  SIZE=-1  FACE="Arial">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?php echo $LDNewArchive ?>" >
                             </form>
<?php else :?>

<form method="post" action="<?php if($mode=="select") echo "aufnahme_start.php"; else echo $thisfile; ?>" name="archivform">

<table border="0" cellspacing=0>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>: <?php if ($mode!="select") echo $LDFrom; ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>

    <FONT SIZE=-1  FACE="Arial" color="#800000">
    <?php echo formatDate2Local($result['pdate'],$date_format) ?> 

<?php else : ?>

<!--     <input name="date_start" type="text" value="" size="14"  onKeyUp=setDate(this)>  -->
    <input name="date_start" type="text" value="" size="14"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
   [
   <?php   
 
      $dfbuffer="LD_".strtr($date_format,".-/","phs");
      echo $$dfbuffer;
   ?> 
   ]

<?php endif ?>
</td>
<?php if ($mode!="select") : ?>
<td align=right><FONT SIZE=-1  FACE="Arial"><?php echo $LDTo ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<!-- <input name="date_end" type="text" value="" size="14"  onKeyUp=setDate(this)>
 -->
 <input name="date_end" type="text" value="" size="14" onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
   [
   <?php   
 
      $dfbuffer="LD_".strtr($date_format,".-/","phs");
      echo $$dfbuffer;
   ?> 
   ]
</td>
<?php endif ?>
</tr>
<tr>
<td ><FONT  SIZE=2  FACE="Arial"> <?php echo $LDAdmitBy ?>:
</td>
<td><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[encoder] ?> <?php else : ?>
<input  name="encoder" type="text" value="" size="14" ><?php endif ?>
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[patnum] ?> <?php else : ?>
<input name="patnum" type="text" size="14" value="" ><?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td ><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[title] ?> <?php else : ?>
<select name="title"  size="1" >
<option value="" ></option>
<option value="Frau" >Frau</option>
<option value="Herr" >Herr</option>
<option value="Frau Dr." >Frau Dr.</option>
<option value="Herr Dr.">Herr Dr.</option>
<option value="Frau Prof.">Frau Prof.</option>
<option value="Herr Prof.">Herr Prof.</option>
</select>
<?php endif ?>
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>:
</td>
<td colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo strtr($result[sex],"fm","WM") ?> <?php else : ?>
<FONT SIZE=-1  FACE="Arial"><input name="sex" type="radio" value="m"  <?php if($sex=="m") echo "checked"; ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f"  <?php if($sex=="f") echo "checked"; ?>><?php echo $LDFemale ?>
<?php endif ?>
</td>

</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[name] ?> <?php else : ?>
<input name="name" type="text" size="14" value="" > <?php endif ?>
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"> &nbsp;<?php echo $LDAddress ?>:
</td>
<td rowspan=4><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo nl2br($result[address]) ?> <?php else : ?>
<textarea rows="5"  cols="26" name="address" ></textarea><?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td colspan=2><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[vorname] ?> <?php else : ?>
<input name="vorname" type="text" size="14" value="<?php echo $vorname; ?>" ><?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  colspan=2><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
    
	<FONT color="#800000">
    <?php echo formatDate2Local($result[gebdatum],$date_format) ?>

<?php else : ?>
    
	<input name="gebdatum" type="text" size="14" value="" onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
   [
   <?php   
 
      $dfbuffer="LD_".strtr($date_format,".-/","phs");
      echo $$dfbuffer;
   ?> 
   ]

<?php endif ?>
</td>
</tr>
<tr>
<td>
</td>
<td  colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[status] ?> <?php else : ?>
<input name="status" type="radio"  value="amb" ><FONT SIZE=-1  FACE="Arial"><?php echo $LDAmbulant ?>  
<input name="status" type="radio" value="stat"  ><?php echo $LDStationary ?>
<?php endif ?>
</td>
</tr>
<tr>
<td>
</td>
<td colspan=2><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[kasse] ?> <?php else : ?>
<FONT SIZE=-1  FACE="Arial">
<input name="kasse" type="radio" value="x" ><?php echo $LDSelfPay ?>
  &nbsp;<input name="kasse" type="radio" value="privat" ><?php echo $LDPrivate ?>
  &nbsp;
<input name="kasse" type="radio" value="kasse" ><?php echo $LDInsurance ?>:<?php endif ?>
</td>
<td><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[kassename] ?> <?php else : ?>
<input name="kassename" type="text" size="28" value="" ><?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[diagnose] ?> <?php else : ?>
<input name="diagnose" type="text" size="60" value="" > <?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDRecBy ?>:
</td>
<td colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[referrer] ?> <?php else : ?>
<input name="referrer" type="text" size="60" value="" ><?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[therapie] ?> <?php else : ?>
<input name="therapie" type="text" size="60" value="" ><?php endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td colspan=3><?php if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?php echo $result[besonder] ?> <?php else : ?>
<input name="besonder" type="text" size="60" value="" ><?php endif ?>
</td>
</tr>

</table>
<p>
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<?php if($mode=="select") : ?>
<input type="hidden" name="itemname" value="<?php echo $result[item] ?>">
<input type="hidden" name="mode" value="?">
<input type="hidden" name="update" value="1">
<input  type="submit"   value="<?php echo $LDUpdateData ?>"> &nbsp;&nbsp;
</form>
<form action="<?php echo $thisfile ?>" method="post">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type="submit" value="<?php echo $LDNewArchive ?>">
<input type="hidden" name="mode" value="?">
</form>
<?php else : ?>
<input type="hidden" name="mode" value="search">
<!-- <input  type="submit" value="<?php echo $LDSearch ?>"> 
 -->
<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif') ?>>
</form>
<?php endif ?>


<?php endif ?>
</ul>

<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<form 
<?php 
if($mode=="select") echo 'action="'.$thisfile.'">'; 
	else
	{
		if($from=="entry") echo 'action="aufnahme_start.php">';
		else
		{ 
			if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) echo 'action="startframe.php">';
				else echo 'action="aufnahme_pass.php">
						<input type="hidden" name="target" value="'.$LDArchive.'"> 
						';
		}
	}
?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<!-- <input type="submit" value="<?php echo $LDCancel ?>">  -->
<input type="image" <?php echo createLDImgSrc('../','cancel.gif') ?>>
</form>
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

    
</BODY>
</HTML>
