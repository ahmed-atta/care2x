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

function createElement($item,$err, $f_size=7, $mx=5)
{
    global $mode, $err_data, $medoc, $lang, $isTimeElement;
	
	if($mode=='saveok')
    {
       $ret_str= '<font color="#800000">'.$medoc[$item].' &nbsp;</font>';
    } 
    else
    {
        $ret_str= '<input name="'.$item.'" type="text" size="'.$f_size.'"   maxlength='.$mx.' value="';
       if($err_data)
       {
          $ret_str.=$err;
       }
       else
       {
          $ret_str.=$medoc[$item];
       }	  
          
	   if($mode=='') $ret_str.='" onClick="hidecat()"';
	     else $ret_str.='"';
		 
	 }
	   
	   if($isTimeElement)  $ret_str.= ' onKeyUp="setTime(this,\''.$lang.'\')">';
	     else $ret_str.='>';
	   
	   return $ret_str;
}

define('LANG_FILE','or.php');
$local_user='ck_opdoku_user';
require_once('../include/inc_front_chain_lang.php');

if ((substr($matchcode,0,1)=='%')||(substr($matchcode,0,1)=='&')) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require_once('../include/inc_config_color.php'); // load color preferences


$breakfile='op-doku.php?sid='.$sid.'&lang='.$lang;
$thisfile='op-doku-start.php';

if(!isset($dept)||empty($dept))
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept='plop'; // default department is plop

$linecount=0;
// check date for completeness

if($mode=='save')
{
	$err_data=0;
	if(!$op_date) {$err_op_date=1; $err_data=1;}
	if(!$operator) {$err_operator=1;$err_data=1;}
	if(!$diagnosis) {$err_diagnosis=1;$err_data=1;}
	if(!$localize) {$err_localize=1;$err_data=1;}
	if(!$therapy) {$err_therapy=1;$err_data=1;}
	if(!$special) {$err_special=1;$err_data=1;}
	if(!(($class_s)||($class_m)||($class_l))) {$err_klas=1;$err_data=1;}
	if(!$op_start) {$err_op_start=1;$err_data=1;}
	if(!$op_end) {$err_op_end=1;$err_data=1;}
	if(!$scrub_nurse) {$err_scrub_nurse=1;$err_data=1;}
	if(!$op_room) {$err_op_room=1;$err_data=1;}
	
	if($err_data) $mode='?';
	
}
	
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{
    /* Load date formatter */
    include_once('../include/inc_date_format_functions.php');
    
	
	   /* If the patient number is available = $patnum , get the data from the admission table */
	   if(isset($patnum) && (trim($patnum)!=''))
	   {
		    $dbtable='care_admission_patient';
							
			$sql='SELECT patnum, name, vorname, gebdatum, sex, status, kasse FROM '.$dbtable.' WHERE  patnum="'.$patnum.'"';
																			
			if($ergebnis=mysql_query($sql,$link)) 
			{			
				if($rows=mysql_num_rows($ergebnis))
			    {
					$admission=mysql_fetch_array($ergebnis);
			    }
			}
			else
			{ 
			   echo "$sql<br>$LDDbNoRead";
			   $mode='?';
			} 	
		}
		
		switch($mode)
		{
			case "match":
			
							$dbtable='care_admission_patient';
							
							$str_query='SELECT patnum, name, vorname, sex, gebdatum, status, kasse FROM '.$dbtable;
							
							if(is_numeric($matchcode))
							{
								$matchcode=(int)$matchcode;
								$sql=$str_query.' WHERE  patnum='.$matchcode;
							}
							else 
							{
								$sql=$str_query.' WHERE  name="'.addslashes($matchcode).'"';
							}
							
							if($ergebnis=mysql_query($sql,$link)) 
							{			
								if(!$rows=mysql_num_rows($ergebnis))
								{ 
								    // if not found find similar
								    $sql=$str_query.' WHERE  name LIKE "'.trim($matchcode).'%" OR vorname LIKE "'.trim($matchcode).'%"';
									
									if($ergebnis=mysql_query($sql,$link)) 
									{			
						  				$rows=mysql_num_rows($ergebnis);
									}
								}
							}else echo "$sql<br>$LDDbNoRead"; 
							//echo $sql;
							if($rows==1) 	$admission=mysql_fetch_array($ergebnis);
							break;
											
			case 'update':
			
							$dbtable='care_op_med_doc';
							
							$sql='SELECT * FROM '.$dbtable.' WHERE  doc_nr="'.$doc_nr.'"';
																			
							if($ergebnis=mysql_query($sql,$link)) 
							{			
								if($rows=mysql_num_rows($ergebnis))
								{
									$medoc=mysql_fetch_array($ergebnis);
								}
							}else echo "$sql<br>$LDDbNoRead"; 
							//echo $sql;
							break;
							
			case 'save':
			
					$dbtable='care_op_med_doc';
					
					/* Prepare the time data */
					
					$op_start=strtr($op_start,'.;,',':::');
					$s_count=substr_count($op_start,':');
					switch($s_count)
					{
					   case 0: $op_start.=':00:00'; break;
					   case 1: $op_start.=':00';break;
					   case '': $op_start.=':00:00';
					}
					
					$op_end=strtr($op_end,'.;,',':::');
					$s_count=substr_count($op_end,':');
					switch($s_count)
					{
					   case 0: $op_end.=':00:00';break;
					   case 1: $op_end.=':00';break;
					   case '': $op_end.=':00:00';
					}
					
					if($update)
					{
					  
						$sql="UPDATE $dbtable SET
									op_date=\"".formatDate2STD($op_date,$date_format)."\",
									operator=\"$operator\",
									name=\"".$admission['name']."\",
									vorname=\"".$admission['vorname']."\",
									gebdatum=\"".$admission['gebdatum']."\",
									status=\"".$admission['status']."\",
									kasse=\"".$admission['kasse']."\",
									sex=\"".$admission['sex']."\",
									diagnosis=\"$diagnosis\",
									localize=\"$localize\",
									therapy=\"$therapy\",
									special=\"$special\",
									class_s=\"$class_s\",
									class_m=\"$class_m\",
									class_l=\"$class_l\",
									op_start=\"$op_start\",
									op_end=\"$op_end\",
									scrub_nurse=\"$scrub_nurse\",
									op_room=\"$op_room\",
									modify_id=\"".$HTTP_COOKIE_VARS[$local_user.$sid]."\"
									WHERE doc_nr=\"$doc_nr\"";
									
						if($ergebnis=mysql_query($sql,$link))
						{
							  	mysql_close($link);
								header("location:op-doku-start.php?sid=$sid&lang=$lang&mode=saveok&patnum=$patnum&doc_nr=$doc_nr");
								exit;
						}else echo "$sql<br>$LDDbNoUpdate"; 
					}
					else
					{

								$sql="INSERT INTO $dbtable
								(	dept,
									op_date,
									operator,
									patnum,
									name,
									vorname,
									gebdatum,
									sex,
									status,
									kasse,
									diagnosis,
									localize,
									therapy,
									special,
									class_s,
									class_m,
									class_l,
									op_start,
									op_end,
									scrub_nurse,
									op_room,
									create_id,
									create_time
									 ) 
								VALUES (
									'$dept',
									'".formatDate2STD($op_date,$date_format)."',
									'$operator', 
									'$patnum',
									'".$admission['name']."',
									'".$admission['vorname']."',
									'".$admission['gebdatum']."',
									'".$admission['sex']."',
									'".$admission['status']."',
									'".$admission['kasse']."',
									'".htmlspecialchars($diagnosis)."', 
									'".htmlspecialchars($localize)."', 
									'".htmlspecialchars($therapy)."', 
									'".htmlspecialchars($special)."', 
									'$class_s', 
									'$class_m', 
									'$class_l', 
									'$op_start',
									'$op_end',
									'$scrub_nurse',
									'$op_room',
									'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
									NULL
								)";
								//echo $sql;
								if($ergebnis=mysql_query($sql,$link)) 
								{			
								
		                                $doc_nr=mysql_insert_id($link);
							  			mysql_close($link);
										header("location:op-doku-start.php?sid=$sid&lang=$lang&mode=saveok&patnum=$patnum&doc_nr=$doc_nr");
										exit;
										
  							    }else echo "$sql<br>$LDDbNoSave"; 

					} // end of if(update) else
							//$sdate=date(YmdHis); // time stamp
					break;
					
			case 'saveok':
			
					$dbtable='care_op_med_doc';
					
					$sql="SELECT * FROM $dbtable WHERE  doc_nr='$doc_nr'";
					
					if($ergebnis=mysql_query($sql,$link)) 
					{			

						if($rows=mysql_num_rows($ergebnis))
						{
							$medoc=mysql_fetch_array($ergebnis);
						}
					}else echo "$sql<br>$LDDbNoRead"; 
					break;
					
			default:
			
					if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) $mode="dummy";
					
		} // end of switch
	}
	else { echo "$LDDbNoLink<br>"; }

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDOrDocument ?></TITLE>


<script  language="javascript">
<!-- 
var iscat=true;
var cat=new Image();
var pix=new Image();

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
	document.match.matchcode.select();
}

function loadcat()
{
  cat.src="../imgcreator/catcom.php?lang=<?php echo $lang ?>&person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+");?>";
  pix.src="../gui/img/common/default/pixel.gif";
}

function showcat()
{

	if(document.images) document.catcom.src=cat.src;
	iscat=true;
	document.match.matchcode.select();
}

function hilite(idx,mode) 
	{
	if(mode==1) idx.filters.alpha.opacity=100
	else idx.filters.alpha.opacity=70;
	}	
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

function setDay(d)
{
	var h="<?php echo date("d.m.Y"); ?>";
	switch(d.value)
	{
		case "h": d.value=h; break;
		case "H": d.value=h; break;
		case "g": d.value=g; break;
		case "G": d.value=g; break;
		default: d.value="";
	}
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>
//-->
</script>

<script language="javascript" src="../js/checkdate.js"></script>
<script language="javascript" src="../js/setdatetime.js"></script>


<style type="text/css" name=cat>

div.cats{
	position: relative;
	right: 10;
	top: 80;
}
</style>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if(window.focus) window.focus();document.match.matchcode.focus();loadcat();">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument - ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('opdoc.php','create','<?php if(!$mode) echo 'dummy'; else echo $mode ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<tr>
<td colspan=2  bgcolor=<?php echo $cfg['body_bgcolor']; ?>><p>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="")
{ if($err_data) echo '<img '.createLDImgSrc('../','inc-data.gif','0','right').' name="catcom"  alt="'.$LDHideCat.'">';
	else echo'<img src="../gui/img/common/default/pixel.gif" align=right name="catcom" border=0 alt="'.$LDHideCat.'">';
 }else echo '<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name="catcom" border=0 alt="'.$LDHideCat.'">';
?></a>

</div>

<ul>
<?php if($rows>1) : ?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo "$LDPatientsFound<br>$LDPlsClk1" ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp;</b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; <?php echo $LDname ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDName ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDBday ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDPatientNr ?>&nbsp; &nbsp;</b></td>
  </tr>
 <?php 
 $toggle=0;
 while($medoc=mysql_fetch_array($ergebnis))
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="op-doku-start.php?sid='.$sid.'&lang='.$lang.'&mode=select&patnum='.$medoc[patnum].'"><img '.createComIcon('../','r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="op-doku-start.php?sid='.$sid.'&lang='.$lang.'&mode=select&patnum='.$medoc[patnum].'">'.$medoc['name'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['vorname'].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($medoc['gebdatum'],$date_format).'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['patnum'].'&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=5 height=1><img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  name="match" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?php echo $LDMatchCode ?>: <input name="matchcode" type="text" size="14" onClick=hidecat()>&nbsp;<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearch ?>">
</form>
<?php else :?>


<FONT  SIZE=-1  FACE="Arial">
<form method="post"  name="match" onSubmit="return lookmatch(this)">
<table border="0">

    <?php 
	   if(!$rows && !$err_data) 
       {
    ?>

          <tr>
            <td ></td>
            <td valign="top"><img <?php echo createComIcon('../','angle_down_l.gif','0','absmiddle') ?>> <font color="#000099" SIZE=3  FACE="verdana,Arial"><b><?php echo $LDPlsSelectPatientFirst ?></b></font> <img <?php echo createMascot('../','mascot1_l.gif','0','absmiddle') ?>></td>
          </tr>

    <?php
      }
     ?>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDMatchCode ?>:<p>
</td>
<td> <input name="matchcode" type="text" size="30" onClick=hidecat()>&nbsp;<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearch ?>"><p>
</td>
</tr>
</form>
<?php 
if($rows || $err_data) 
{
?>
<form method="post" action="op-doku-start.php" name="opdoc">
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_op_date) echo 'color=#cc0000'; ?>><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">

<?php 

if($mode=='saveok')
{
   echo '<b>'.formatDate2Local($medoc['op_date'],$date_format).'</b>'; 
 }
 else
 {
    echo '<input name="op_date" type="text" size="12" maxlength=10 value="';
	if($err_data)
    {
       echo $op_date;
	}
     else
	 {	  
	     echo  formatDate2Local(date('Y-m-d'),$date_format);
     }
	
	echo '"  onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> ['; 
    $dfbuffer="LD_".strtr($date_format,".-/","phs");
    echo $$dfbuffer.']';  
}
  

?> 

<font size=2 face="arial" <?php if($err_operator) echo 'color=#cc0000'; ?>>&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php 
if($mode=='saveok') echo '<font color="#800000">'.$medoc['operator']; 
	else
	{
	 echo '
	<input name="operator" type="text" size="25" value="';
	if($err_data)
    {
	  echo $operator; 
	 }
	 else
	    {
		     echo $HTTP_COOKIE_VARS[$local_user.$sid];
	    }
	echo '">';
	}
 ?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td>
<p>
<FONT SIZE=-1  FACE="Arial" <?php if($err_patnum) echo 'color=#cc0000'; ?>><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">

<?php 

   echo '<b>'.$admission['patnum'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_name) echo 'color=#cc0000'; ?>><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">

<?php 

   echo '<b>'.$admission['name'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_vorname) echo 'color=#cc0000'; ?>><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">
<?php 

   echo '<b>'.$admission['vorname'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_gebdatum) echo 'color=#cc0000'; ?>><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial" color="#000099">
<?php

      echo formatDate2Local($admission['gebdatum'],$date_format);

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial"  color="#000099">

<font color="#000099">
<?php 


switch($admission['status'])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
?>

</font>
<br>
<FONT SIZE=-1  FACE="Arial" color="#000099">
<?php 

if ($admission['kasse']=="kasse")
{
   echo $LDInsurance;
}
 elseif($admission['kasse']=="privat")
 {
	 echo $LDPrivate;
  }
   elseif($admission['kasse']=="x")
   {
	  echo $LDSelfPay;
    }

?>     

</td>
</tr>

<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"  <?php if($err_diagnosis) echo 'color=#cc0000'; ?>><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php

 echo createElement('diagnosis',$diagnosis,60,100); 
 
?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_localize) echo 'color=#cc0000'; ?>><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">

<?php

 echo createElement('localize',$localize,60,100); 
 
?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_therapy) echo 'color=#cc0000'; ?>><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">

<?php

 echo createElement('therapy',$therapy,60,100); 
 
?>
</td>
</tr >
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_special) echo 'color=#cc0000'; ?>><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">

<?php

echo createElement('special',$special,60,100); 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"  <?php if($err_klas) echo 'color=#cc0000'; ?>><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial"><font color="#800000">
<?php if($mode=='saveok')
{

    if($medoc[class_s]) echo "$medoc[class_s] $LDMinor  &nbsp; ";
   	if($medoc[class_m]) echo "$medoc[class_m] $LDMiddle &nbsp; ";
   	if($medoc[class_l]) echo "$medoc[class_l] $LDMajor";
	echo " $LDOperation";
}
else
{
?>
 <input name="class_s" type="text" size="2" value="<?php if($err_data) echo $class_s; else echo $medoc['class_s']; echo '"'; if(mode=='') echo 'onClick="hidecat()"'; ?>><?php echo $LDMinor ?>&nbsp;
<input name="class_m" type="text" size="2" value="<?php if($err_data) echo $class_m; else echo $medoc['class_m']; echo '"'; if(mode=='') echo 'onClick="hidecat()"'; ?>><?php echo $LDMiddle ?>&nbsp;
<input name="class_l" type="text" size="2" value="<?php if($err_data) echo $class_l; else echo $medoc['class_l']; echo '"'; if(mode=='') echo 'onClick="hidecat()"'; ?>><?php echo "$LDMajor $LDOperation" ?>
<?php
}
?>
</td>
</tr>

<?php
}
?>

</table>

<?php 
if($rows || $err_data) 
{
?>

<p>
 <FONT SIZE=-1  FACE="Arial" <?php if($err_op_start) echo 'color="#cc0000"'; ?>>
<?php 

/* Set the global $isTimeElement to 1 to cause the function to insert the setTime Code in the form input code */
$isTimeElement=1;

echo $LDOpStart.':';

echo createElement('op_start',$op_start);

 if($err_op_end) echo '<font color="#cc0000">';else echo '<font color="#0">'; ?> &nbsp; <?php echo $LDOpEnd.':';
 
echo createElement('op_end',$op_end);

/* Reset the global $isTimeElement to 1 to disable the setTime code insertion*/
$isTimeElement=0;

if($err_scrub_nurse) echo '<font color="#cc0000">';else echo '<font color="#0">'; ?> &nbsp; <?php echo $LDScrubNurse.':';

echo createElement('scrub_nurse',$scrub_nurse);	

if($err_op_room) echo '<font color="#cc0000">';else echo '<font color="#0">'; ?>  &nbsp; <?php echo $LDOpRoom.':';

echo createElement('op_room',$op_room);

?>
<p>

<?php if($mode=='saveok') : ?>

 <input  type="image" <?php echo createLDImgSrc('../','update_data.gif','0','absmiddle') ?> onClick="hidecat()" alt="<?php echo $LDSave ?>">
<input type="button" value="<?php echo $LDStartNewDocu ?>" onclick="window.location.replace('op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy')">

<?php else : ?>

<input  type="image" <?php echo createLDImgSrc('../','savedisc.gif','0') ?> onClick="hidecat()" alt="<?php echo $LDSave ?>">
<a href="javascript:document.opdoc.reset()"><img <?php echo createLDImgSrc('../','reset.gif','0') ?> alt="<?php echo $LDResetAll ?>" onClick=hidecat()></a>

<?php endif ?>

<input type="hidden" name="mode" value="<?php if($mode=='saveok') echo 'update'; else echo 'save' ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="update" value="<?php if ($mode=='update') echo '1' ?>">
<input type="hidden" name="patnum" value="<?php if($mode=='match' && $rows==1) echo $admission['patnum']; else echo $patnum ?>">
<input type="hidden" name="doc_nr" value="<?php echo $doc_nr ?>">

</form>

<?php
}
?>


<?php endif ?>


<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<hr>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="op-doku-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="op-doku-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDResearchArchive ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="javascript:showcat()"><?php echo $LDShowCat ?></a><br>

<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>
</ul><p>
<hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>


</BODY>
</HTML>
