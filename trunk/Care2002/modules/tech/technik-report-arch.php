<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$thisfile=basename(__FILE__);
$breakfile='technik.php'.URL_APPEND;
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);

if(!isset($dept)) $dept='';
if(!isset($tech)) $tech='';
if(!isset($mode)) $mode='';
if(!isset($ofset)) $ofset='';

/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');



if(isset($mode)&&($mode=='search'))
{
	if(isset($dept)&&empty($dept)&&isset($tech)&&empty($tech)&&isset($sdate)&&empty($sdate)&&isset($edate)&&empty($edate))  $mode='';
	
	if(isset($edate)&&$edate)
	{
  	    $edate=formatDate2STD($edate,$date_format);
	}
	
	if(isset($sdate)&&$sdate)
	{
	     $sdate=formatDate2STD($sdate,$date_format);
	}
		
		
	if(!isset($ofset)||!$ofset) $ofset=0;
	if(!isset($nrows)||!$nrows) $nrows=20;
}

//init db parameters
$linecount=0;
$dbtable='care_tech_repair_done';

//this is the search module
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {
	if($mode=='search') {
				$sql='SELECT * FROM '.$dbtable.' WHERE ';
				if($tech) $sql.=" reporter LIKE '$tech' ";
				if($dept)
				{
					if($tech) $sql.=" AND dept LIKE '$dept' "; else $sql.=" dept LIKE '$dept' ";
				}
				$buf='';
				
				if($sdate)
				{
					if($edate) $buf=" tdate>='$sdate' AND tdate<='$edate' ";
					 else $buf=" tdate='$sdate' ";
				}
				else
				{
					if($edate) $buf=" tdate<='$edate' ";
				}
				
				if($buf)
				{
					if(($dept)||($tech)) $sql.=" AND $buf "; else $sql.=$buf;
				}
			  //echo $sql;
			}
			else $sql='SELECT * FROM '.$dbtable.' WHERE seen=0 ORDER BY tid DESC';
								
        		if($ergebnis=$db->Execute($sql))
				{
					$linecount=$ergebnis->RecordCount();
				} else {echo "<p>".$sql."$LDDbNoRead<br>"; };
} else { echo "$LDDbNoLink<br>"; } 


$abt=array("PLOP","GYN","Anästhesie","Unfall");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> Technik - Bericht</TITLE>
 <script language="javascript" >
<!-- 
function show_order(d,D,t,r,i)
{
	urlholder="technik-report-showcontent.php<?php echo URL_REDIRECT_APPEND; ?>&dept="+d+"&tdate="+D+"&ttime="+t+"&reporter="+r+"&tid="+i;
	//orderlistwin=window.open(urlholder,"orderlistwin","width=700,height=550,menubar=no,resizable=yes,scrollbars=yes");
	window.location.href=urlholder;
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>main/help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

// -->
</script> 

<script language="javascript" src="/js/setdatetime.js"></script>
<script language="javascript" src="/js/checkdate.js" type="text/javascript"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.tech.focus()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php //echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('tech.php','arch')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p>
  <form action="<?php echo $thisfile?>" method="get" name="suchform">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd background="<?php echo $root_path; ?>gui/img/common/default/tableHeaderbg3.gif">
      <td  colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><?php echo $LDSearchReport ?>:</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDTechnician ?>:</td>
      <td><input type="text" name="tech" size=25 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDDept ?>:</td>
      <td><input type="text" name="dept" size=25 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 ><?php echo "$LDDate $LDFrom" ?>:</td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="sdate" size=10 maxlength=10   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"><?php echo $LDTo ?><input type="text" name="edate" size=10 maxlength=10   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
          </td>
    </tr>

    <tr >
      <td colspan=2><input type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0'); ?>>
           </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid ?>">
  <input type="hidden" name="lang" value="<?php echo $lang ?>">
    <input type="hidden" name="mode" value="search">
    </form>
  
  
<hr width=80% align=left>
<?php if($linecount>0)
{
	echo '
			<font face=Verdana,Arial size=2>
			<p> ';
			if ($linecount>1) echo $LDReportListMany; else echo $LDReportList;
		if($mode!="")
		{
			if ($linecount>1) echo $LDLikeSearchMany; else echo $LDLikeSearch; 
		}
		else
		{ 
			if ($linecount>1) echo $LDNotReadMany; else echo $LDNotRead; 
		}
			echo "<br>$LDClk2Read<br></font><p>";

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td >
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff"  background="'.$root_path.'gui/img/common/default/tableHeaderbg3.gif">';
		for ($i=0;$i<sizeof($bcatindex);$i++)
		echo '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$bcatindex[$i].'</td>';
		echo '
				</tr>';	

		$i=$ofset+1;
		
		/* Load the common icons */
		$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
			echo'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content['dept'].'\',\''.$content['tdate'].'\',\''.$content['ttime'].'\',\''.$content['reporter'].'\',\''.$content['tid'].'\')">
				<img '.$img_uparrow.' alt="'.$LDClk2Read.'"></a></td>
				 <td><font face=Verdana,Arial size=2>'.$content['reporter'].'</td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content['dept']).'</td>
				<td><font face=Verdana,Arial size=2>'.@formatDate2Local($content['tdate'],$date_format).'</td>
				 <td><font face=Verdana,Arial size=2>'.@convertTimeToLocal($content['ttime']).'</td>
				<td><font face=Verdana,Arial size=2>';
	if($content['seen']) echo '<img '.createComIcon($root_path,'check-r.gif','0').'>'; else echo "&nbsp;";
	echo '</td>
				</tr>';
			$i++;

 		}
		echo '
			</table>
			</td></tr><tr bgcolor="'.$cfg['body_bgcolor'].'">
			<td>';
		if($ofset) echo '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="lang" value="'.$lang.'">           
								<input type="submit" value="&lt;&lt; Zurück">
								</form>';
		echo "</td><td align=right>";
		
		if(!isset($nrows)) $nrows=0;
		
		if($linecount==$nrows) 
						echo '<form name=forward action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
								<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
        						<input type="hidden" name="ofset" value="'.($ofset+$nrows).'">
              					<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="lang" value="'.$lang.'">           
                   				<input type="hidden" name="sid" value="'.$sid.'">     
								<input type="submit" value="Weiter &gt;&gt;">
								</form>';
		echo '
			</td>
			</tr>	
			</table>';                            
}
else
{
if($ofset) echo '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="lang" value="'.$lang.'">           
								<input type="submit" value="&lt;&lt; Zurück">
								</form>';
							
if($mode=='search') echo '
	<table border=0>
   <tr>
     <td><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'></td>
     <td><font face=Verdana,Arial size=2 color="#660000">'.$LDNoFound.'</font></td>
   </tr>
 </table>';
 
	
}
/*
if($invalid) echo'

	<table border=0>
   <tr>
     <td> <img src="../img/nedr.gif" width=100 height=138 border=0 align=middle>
		</td>
     <td><font face=Verdana,Arial size=2>Die Eingabe von einem einzigen Zeichen ist nicht zulässig. <br>Bitte versuchen Sie es noch mal und geben Sie etwas ausführlicheres ein. Vielen Dank.
</td>
   </tr>
 </table>';
 */
	 ?>
<p><br>
 <a> <?php echo'<a href="technik.php'.URL_APPEND.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'>';?></a>
</ul>
</FONT>
<p>
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
