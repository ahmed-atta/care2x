<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_tech.php");
require("../req/config-color.php");

$thisfile="technik-report-arch.php";
$breakfile="technik.php?sid=$ck_sid&lang=$lang";

if($mode=="search")
{
	if((!$dept)&&(!$tech)&&(!$sdate)&&(!$edate))  $mode="";
	if($edate)
	{
		$dbuf=explode(".",$edate);
		$dbuf=array_reverse($dbuf);
		$edate=implode("",$dbuf);
		if($sdate)
		{
		$dbuf=explode(".",$sdate);
		$dbuf=array_reverse($dbuf);
		$sdate=implode("",$dbuf);
		}
	}
		
		
	if(!$ofset) $ofset=0;
	if(!$nrows) $nrows=20;
}

//init db parameters
$linecount=0;
$dbtable="tech_repair_done";

//this is the search module
	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
			if($mode=="search")
			{
				$sql='SELECT * FROM '.$dbtable.' WHERE ';
				if($tech) $sql.=" reporter='$tech' ";
				if($dept)
				{
					if($tech) $sql.=" AND dept='$dept' "; else $sql.=" dept='$dept' ";
				}
				$buf="";
				if($sdate)
				{
					if($edate) $buf=" d_idx>=$sdate AND d_idx<=$edate ";
					 else $buf=" tdate='$sdate' ";
				}
				else
				{
					if($edate) $buf=" d_idx<=$edate ";
				}
				if($buf)
				{
					if(($dept)||($tech)) $sql.=" AND $buf "; else $sql.=$buf;
				}
				//print $sql;
			}
			else $sql='SELECT * FROM '.$dbtable.' WHERE seen=0 ORDER BY tid DESC';
								
        		if($ergebnis=mysql_query($sql,$link))
				{
					$linecount=0;
					while ($content=mysql_fetch_array($ergebnis)) $linecount++;					
					//reset result
					if ($linecount)	mysql_data_seek($ergebnis,0);
					}
					else {print "<p>".$sql."$LDDbNoRead<br>"; };
	}
  	 else { print "$LDDbNoLink<br>"; } 


$abt=array("PLOP","GYN","Anästhesie","Unfall");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> Technik - Bericht</TITLE>
<script language="javascript" src="../js/setdatetime.js">
</script>
 <script language="javascript" >
<!-- 
function show_order(d,D,t,r,i)
{
	urlholder="technik-report-showcontent.php?sid=<? print $ck_sid; ?>&dept="+d+"&tdate="+D+"&ttime="+t+"&reporter="+r+"&tid="+i;
	//orderlistwin=window.open(urlholder,"orderlistwin","width=700,height=550,menubar=no,resizable=yes,scrollbars=yes");
	window.location.href=urlholder;
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.tech.focus()"
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?=$LDTechSupport ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('tech.php','arch')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<?
if($from=="pass")
{
$curtime=date("H.i");
if ($curtime<"9.00") print "Guten Morgen ";
if (($curtime>"9.00")and($curtime<"18.00")) print "Guten Tag ";
if ($curtime>"18.00") print "Guten Abend ";
print "$ck_apo_arch_user!";
}else print "<br>";
?><p>
  <form action="<?=$thisfile?>" method="get" name="suchform">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td  colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><?=$LDSearchReport ?>:</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?=$LDTechnician ?>:</td>
      <td><input type="text" name="tech" size=25 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?=$LDDept ?>:</td>
      <td><input type="text" name="dept" size=25 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2 ><?="$LDDate $LDFrom" ?>:</td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="sdate" size=10 maxlength=10 onKeyUp="setDate(this)"><?=$LDTo ?><input type="text" name="edate" size=10 maxlength=10 onKeyUp="setDate(this)">
          </td>
    </tr>

    <tr >
      <td ><input type="submit" value="<?=$LDSearch ?>">
           </td>
      <td align=right><input type="reset" value="<?=$LDReset ?>" onClick="document.suchform.tech.focus()">
                      </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?=$ck_sid ?>">
  <input type="hidden" name="lang" value="<?=$lang ?>">
    <input type="hidden" name="mode" value="search">
    </form>
  
  
<hr width=80% align=left>
<?
if($linecount>0)
{
	print '
			<font face=Verdana,Arial size=2>
			<p> ';
			if ($linecount>1) print $LDReportListMany; else print $LDReportList;
		if($mode!="")
		{
			if ($linecount>1) print $LDLikeSearchMany; else print $LDLikeSearch; 
		}
		else
		{ 
			if ($linecount>1) print $LDNotReadMany; else print $LDNotRead; 
		}
			print "<br>$LDClk2Read<br></font><p>";

		$tog=1;
		print '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td >
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($bcatindex);$i++)
		print '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$bcatindex[$i].'</td>';
		print '
				</tr>';	

		$i=$ofset+1;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content[dept].'\',\''.$content[tdate].'\',\''.$content[ttime].'\',\''.$content[reporter].'\',\''.$content[tid].'\')"><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDClk2Read.'"></a></td>
				 <td><font face=Verdana,Arial size=2>'.$content[reporter].'</td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).'</td>
				<td><font face=Verdana,Arial size=2>'.$content[tdate].'</td>
				 <td><font face=Verdana,Arial size=2>'.$content[ttime].'</td>
				<td><font face=Verdana,Arial size=2>';
	if($content[seen]) print '<img src="../img/check-r.gif" width=21 height=15 border=0>'; else print "&nbsp;";
	print '</td>
				</tr>';
			$i++;

 		}
		print '
			</table>
			</td></tr><tr bgcolor="'.$cfg[body_bgcolor].'">
			<td>';
		if($ofset) print '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$ck_sid.'">           
								<input type="submit" value="&lt;&lt; Zurück">
								</form>';
		print "</td><td align=right>";
		if($linecount==$nrows) 
						print '<form name=forward action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
								<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
        						<input type="hidden" name="ofset" value="'.($ofset+$nrows).'">
              					<input type="hidden" name="nrows" value="'.$nrows.'">
                   				<input type="hidden" name="sid" value="'.$ck_sid.'">     
								<input type="submit" value="Weiter &gt;&gt;">
								</form>';
		print '
			</td>
			</tr>	
			</table>';                            
}
else
{
if($ofset) print '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$ck_sid.'">           
								<input type="submit" value="&lt;&lt; Zurück">
								</form>';
							
if($mode=="search") print '
	<table border=0>
   <tr>
     <td><img src="../img/catr.gif" width=88 height=80 border=0 align=middle></td>
     <td><font face=Verdana,Arial size=2 color="#660000">'.$LDNoFound.'</font></td>
   </tr>
 </table>';
 
	
}
/*
if($invalid) print'

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
  
</table>

		
	

</ul>

</FONT>
<p>
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
