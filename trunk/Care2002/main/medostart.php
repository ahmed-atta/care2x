<?
$thisfile="medostart.php";
if ((substr($searchkey,0,1)=="%")||(substr($searchkey,0,1)=="&")) {header("Location: $thisfile?sid=$ck_sid&lang=$lang"); exit;}; 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$medocs_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_aufnahme.php");
require("../req/config-color.php"); // load color preferences

setcookie(username,"");
$breakfile="medopass.php?sid=$ck_sid&lang=$lang";

function restart()
{
	header("location:medostart.php?sid=$ck_sid&lang=$ck_lang");
	exit;
}

if($mode)
{

  if(($mode=="save")&&($dept==""))
	if($patient_no)
	{
		 if($ck_thispc_dept) $dept=$ck_thispc_dept;
 			elseif($ck_thispc_station) $dept=$ck_thispc_station;
				elseif($ck_thispc_room) $dept=$ck_thispc_room;
				 	else 
					{
						$mode="search";
						if($patient_no) $searchkey=$patient_no;
						$fetchdept=1;
					}
	}
	else
	{
		$mode="search";
		if($lastname) $searchkey=$lastname;
			elseif($firstname) $searchkey=$firstname;
				else restart();
	}

	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "search":
							$dbtable="mahopatient";
							
							if(is_numeric($searchkey))
							{
								$searchkey=(int)$searchkey;
								if($searchkey<20000000) $searchkey=$searchkey+20000000;
								$sql="SELECT * FROM $dbtable WHERE patnum=$searchkey";
								//$isnumeric=1;
							}
							else
							{
								$sql='SELECT * FROM '.$dbtable.' WHERE  name="'.$searchkey.'"';
							}
							
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
								}
								else
								{ // if not found find similar
								$sql='SELECT * FROM '.$dbtable.' WHERE  name LIKE "'.trim($searchkey).'%" 
																				OR vorname LIKE "'.trim($searchkey).'%"';
									if($ergebnis=mysql_query($sql,$link)) 
									{			
						  				$rows=0;
										while($result=mysql_fetch_array($ergebnis)) $rows++;	
										if($rows)
										{
											mysql_data_seek($ergebnis,0);
										}
									}
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							if($rows==1) 	
							{
								$result=mysql_fetch_array($ergebnis);
								$newpatfound=1;
								if($fetchdept)
								{
									$result[insurance_xtra]=$insurance_xtra;
									$result[sex]=$sex;
									$result[diagnosis_1]=$diagnosis_1;
									$result[therapy_1]=$therapy_1;
									$result[keynumber]=$keynumber;
									$result[informed]=$informed;
								}
							}
							break;
			case "update":
							$dbtable="medocs";
							$sql="SELECT * FROM $dbtable WHERE  dept='$dept'
																		AND doc_no='$doc_no' 
																		AND enc_date='$enc_date' 
																		AND lastname='$lastname' 
																		AND firstname='$firstname' 
																		AND birthdate='$birthdate'
																		AND keynumber='$keynumber'";
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							if($rows==1) 	
							{
								$result=mysql_fetch_array($ergebnis);
								$newpatfound=1;
							}
							break;
			case "select":
							$dbtable="mahopatient";
							$sql='SELECT * FROM '.$dbtable.' WHERE  patnum="'.$n.'" 
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
									$newpatfound=1;
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							break;
			case "save":
					$dbtable="medocs";
					// get the last doc number
				if($update)
				{
						$sql="UPDATE $dbtable SET lastname='$lastname',
																firstname='$firstname',
																birthdate='$birthdate',
																sex='$sex',
																address='$address',
																insurance='$insurance',
																insurance_xtra='$insurance_xtra',
																informed='$informed',
																diagnosis_1='$diagnosis_1',
																therapy_1='$therapy_1',
																diagnosis_2='$diagnosis_2',
																therapy_2='$therapy_2',
																diagnosis_3='$diagnosis_3',
																therapy_3='$therapy_3', 
																edit_date='".date("d.m.Y")."',
																edit_time='".date("H.i")."', 
																editor='$medocs_user' 
															 WHERE dept='$dept'
															 	AND doc_no='$doc_no' 
																AND patient_no='$patient_no'
																AND enc_date='$enc_date'
																AND enc_time='$enc_time' 
																AND keynumber='$keynumber'";
						if($ergebnis=mysql_query($sql,$link)) 
						{			
						  	mysql_close($link);
							header("location:medostart.php?sid=$ck_sid&lang=$lang&mode=saveok&dept=$dept&docn=$doc_no");
							exit;
						}else print "$LDDbNoSave<p> $sql <p>";
				}
				else
				{
					$sql="SELECT doc_no FROM $dbtable WHERE  dept='lastdocnumber'";
					if($ergebnis=mysql_query($sql,$link)) 
					{			
					  	$rows=0;
						while($result=mysql_fetch_array($ergebnis)) $rows++;	
						if($rows)
						{
							mysql_data_seek($ergebnis,0);
							$result=mysql_fetch_array($ergebnis);
							$dn=$result[doc_no]+1;
							$ts=date(YmdHis);
							$sql="INSERT INTO $dbtable
							(	dept,
								doc_no,
								enc_date,
								patient_no,
								lastname,
								firstname,
								birthdate,
								sex,
								address,
								insurance,
								insurance_xtra,
								informed,
								diagnosis_1,
								therapy_1,
								diagnosis_2,
								therapy_2,
								diagnosis_3,
								therapy_3,
								keynumber,
								enc_time,
								encoder
								 ) 
							VALUES (
								'$dept',
								'$dn',
								'$enc_date', 
								'$patient_no',
								'$lastname',
								'$firstname',
								'$birthdate', 
								'$sex', 
								'$address', 
								'$insurance', 
								'$insurance_xtra', 
								'$informed', 
								'$diagnosis_1', 
								'$therapy_1', 
								'$diagnosis_2', 
								'$therapy_2', 
								'$diagnosis_3',
								'$diagnosis_3',
								'$keynumber',
								'".date("H.i")."',
								'$medocs_user'
							)";
							//print $sql;
							if($ergebnis=mysql_query($sql,$link)) 
							{			
								// update last doc number
								$sql="UPDATE $dbtable SET doc_no='$dn' WHERE dept='lastdocnumber'";
								if($ergebnis=mysql_query($sql,$link)) 
								{			
						  			mysql_close($link);
									header("location:medostart.php?sid=$ck_sid&lang=$lang&mode=saveok&dept=$dept&docn=$dn");
									exit;
								}else print "$$LDDbNoSave<p> $sql <p>";
							}else print "$$LDDbNoRead<p> $sql <p>";
						}
					}else print "$LDDbNoRead<p> $sql <p>";
							//$sdate=date(YmdHis); // time stamp
				}
					break;
			case "saveok":
					$dbtable="medocs";
					$sql="SELECT * FROM $dbtable WHERE  dept='$dept' AND doc_no='$docn'";
					if($ergebnis=mysql_query($sql,$link)) 
						{			
						  	$rows=0;
							while($result=mysql_fetch_array($ergebnis)) $rows++;	
							if($rows)
							{
								mysql_data_seek($ergebnis,0);
								$result=mysql_fetch_array($ergebnis);
							}
						}else print "$LDDbNoRead<p> $sql <p>";
					//print $sql; print $mode;
					break;
		} // end of switch
	}
  	 else { print "$LDDbNoLink<br>"; } 
} // end of if($mode

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
 
 <script language="JavaScript">
<!-- Script Begin
var iscat=<? if($mode) print 'false'; else print 'true'; ?>;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?person=<?print strtr($medocs_user," ","+");?>";
  pix=new Image();
  pix.src="../img/pixel.gif";
}

function showcat()
{
	if(iscat)
	{
		hidecat();
		return;
	}
	else
	{
	if(document.images) document.catcom.src=cat.src;
	iscat=true;
	}
}

function hilite(idx,mode) {

if(mode==1) idx.filters.alpha.opacity=100
else idx.filters.alpha.opacity=70;

}
function setDay(d)
{
	var h="<? print date("d.m.Y"); ?>";
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
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//  Script End -->
</script>
<style type="text/css" name=cat>

div.cats{
	position: absolute;
	right: 10;
	top: 80;
}
</style>
<? 
require("../req/css-a-hilitebu.php");
?> 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" onLoad="if(window.focus) window.focus();loadcat();
<? if(!$fetchdept) print 'document.medocsform.searchkey.select()'; ?>">


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=5  FACE="Arial">
<STRONG>&nbsp;<?=$LDMEDOCS ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('medocs_how2new.php','<?=$mode ?>','<?=$rows ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p><br>

<div class="cats"><a href="javascript:hidecat();document.medocsform.searchkey.select()" >
<?
if($mode!="") print'
<img src="../img/pixel.gif" align=right name=catcom border=0 alt="Die Katze verstecken">';
else print '
<img src="../imgcreator/catcom.php?person='.strtr($medocs_user," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?></a>
</div>

<ul>

<? if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><? print str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
     <?
  	for($j=0;$j<sizeof($LDElements);$j++)
		print '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDElements[$j].'</b></td>';
	?>
 </tr>
 <? 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result[dept]=="lastdocnumber") continue;
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf="medostart.php?sid=$ck_sid&lang=$lang&mode=select&n=".$result[patnum]."&ln=".strtr($result[name]," ","+")."&fn=".strtr($result[vorname]," ","+")."&bd=".$result[gebdatum ];
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[name].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[vorname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[gebdatum].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[patnum].'</a>&nbsp;&nbsp;</td>
     <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[pdate].'</a>&nbsp;&nbsp;</td>
 </tr>
  <tr bgcolor=#0000ff>
  <td colspan=6 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<? endif ?>

<? if(!$fetchdept) : ?>
	<form action="<? print $thisfile; ?>" method="post" name="medocsform">
	<FONT    SIZE=2  FACE="Arial"><?=$LDNewDocu ?>:<br>
	<input type="text" name="searchkey" size=25 maxlength=40>
	<input type="submit" value="<?=$LDSearch ?>">
	<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
	<input type="hidden" name="lang" value="<? print $lang; ?>">
	<input type="hidden" name="mode" value="search">
	</form>
<? endif ?>

<? if(($rows==1)||($mode=="?")||($mode=="")) :?>

<FORM METHOD="post" ACTION="medostart.php">
<TABLE  <? if($mode=="saveok") print "bgcolor=#fcfcfc"; else print "bgcolor=#000000"; ?> CELLPADDING=1 CELLSPACING=0>
<TR><TD > 
<TABLE  CELLPADDING=2 CELLSPACING=0 border=0>
	<? if($fetchdept)
 		print '
    	<tr>
		<td><img src="../img/catr.gif" width=88 height=80 border=0>
		</td>
     	 <td colspan=3>
		 <FONT    SIZE=2  FACE="Arial" color="#80000">
		 	<b>Bitte geben sie Ihre Abteilung oder Arbeitsplatz ein. </b><br>
	  			(z.B. PLOP oder Innere2 oder M4A, usw.)<br>
				<input type="text" name="dept" size=15 maxlength=20>
				<input type="submit" value="OK jetzt abspeichern">
		</td>
    	</tr>
		<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>';
	?>  
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDLastName ?>:</TD>
	<TD> 
	<? 
	 if($mode=="saveok") print '
	 	<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result[lastname]).'</b>'; 
	 elseif($newpatfound) print '
	 	<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result[name].$result[lastname]).'</b>
  		<INPUT NAME="lastname" TYPE="hidden" VALUE="'.$result[name].$result[lastname].'">';
	 else print '
	 	<INPUT NAME="lastname" TYPE="text" VALUE="'.$result[name].$result[lastname].'" SIZE="30">';
	 ?><BR>
				</TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDCaseNr ?>:</TD>
	<TD>
	<? if($mode!="")
	{ print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result[patient_no].$result[patnum];
		 print '<input type="hidden" name="patient_no" value="'.$result[patnum].'">';
	}   
	 else print '<INPUT NAME="patient_no" TYPE="text" VALUE="'.$result[patnum].'" SIZE="30">';
	 ?>
	 <BR></TD>
	</TR>

<TR VALIGN="baseline" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDFirstName ?>:</TD>
	<TD colspan=3> 
	<? 
		if($mode=="saveok") print '
			<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result[firstname]); 
		elseif($newpatfound) print '
			<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result[vorname].$result[firstname]).'
			<INPUT NAME="firstname" TYPE="hidden" VALUE="'.$result[vorname].$result[firstname].'">';
		else print '
			<INPUT NAME="firstname" TYPE="text" VALUE="'.$result[vorname].$result[firstname].'" SIZE="30">';
	?><BR>
				</TD>
	</TR>
	
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDBday ?></TD>
	<TD> <? 
				if($mode=="saveok") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result[birthdate]); 
				elseif($newpatfound) print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result[gebdatum].$result[birthdate].'
													<INPUT NAME="birthdate" TYPE="hidden" VALUE="'.$result[gebdatum].$result[birthdate].'">';
				 else print '<INPUT NAME="birthdate" TYPE="text" VALUE="'.$result[gebdatum].$result[birthdate].'" SIZE="30">';
			?>
				<BR>
				</TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDInsurance ?>:</TD>
	<TD> <? 
				if($mode=="saveok") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.ucfirst($result[insurance]); 
				elseif($newpatfound) print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result[kassename].$result[insurance].'
													<INPUT NAME="insurance" TYPE="hidden" VALUE="'.$result[kassename].$result[insurance].'">';
				 else print '<INPUT NAME="insurance" TYPE="text" VALUE="'.$result[kassename].$result[insurance].'" SIZE="30">';
			?>
				<BR>
				</TD>
<TR VALIGN="top" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDAddress ?>:</TD>
	<TD> <? 
				if($mode=="saveok") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[address]); 
				elseif($newpatfound) print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[address]).'
													<INPUT NAME="address" TYPE="hidden" VALUE="'.$result[address].'">';
				 else print '<TEXTAREA NAME="address" Content-Type="text/html"	COLS="28" ROWS="3">'.$result[address].'</TEXTAREA>';
			?>
				<BR>
				</TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDExtraInfo ?>:</TD>
	<TD ><? if($mode=="saveok") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[insurance_xtra]); else print '<TEXTAREA NAME="insurance_xtra" Content-Type="text/html"
	COLS="28" ROWS="3">'.$result[insurance_xtra].'</TEXTAREA>';?></TD></TR>
<TR>
<TR VALIGN="baseline" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDSex ?></TD>
	<TD colspan=3>
	<? if($mode=="saveok")
	{  print '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result[sex]=="m") print $LDMale; else print $LDFemale;
	}
	elseif($newpatfound)
	{  print '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result[sex]=="m") print $LDMale; else print $LDFemale;
		print '<INPUT NAME="sex" TYPE="hidden" VALUE="'.$result[sex].'">';
	}
	else
	{ print '<FONT    SIZE=2  FACE="Arial">
	<INPUT NAME="sex" TYPE="radio" VALUE="m" ';
	if ($result[sex]=="m") print "checked";
	print '> '.$LDMale.'&nbsp;
	<INPUT NAME="sex" TYPE="radio" VALUE="f" ';
	 if ($result[sex]=="f") print "checked";
	print '> '.$LDFemale.'<BR>
	</TD></TR>';
	}
	?>

<TR VALIGN="top" bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDMedAdvice ?>:</TD>
	<TD colspan=3>
	<? if($mode=="saveok")
	{  print '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result[informed]) print $LDYes; else print $LDNo;
	}
	else
	{ print '
	<FONT    SIZE=2  FACE="Arial"><INPUT NAME="informed" TYPE="radio" VALUE="1" ';
	if($result[informed]) print "checked" ;
	print '> '.$LDYes.'
	<INPUT NAME="informed" TYPE="radio" VALUE="0" ';
	if(!$result[informed]) print "checked"; 
	print '>'.$LDNo.'<BR>
	</TD></TR>';
	}
	?>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR VALIGN="top"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDDiagnosis ?>:</TD>
	<TD colspan=3><FONT    SIZE=2  FACE="Arial"><? if($mode=="saveok") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[diagnosis_1]); else print '<TEXTAREA NAME="diagnosis_1" Content-Type="text/html"
	COLS="75" ROWS="10">'.$result[diagnosis_1].'</TEXTAREA>';?><br>
	<img src="../img/arrow.gif" border=0 width=15 height=15 align=absmiddle><a href="#?mode=<?=$mode ?>"><? if ($mode!="saveok") print $LDEnterDiagnosisNote; else print $LDSeeDiagnosisNote; ?></a></TD></TR>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR  bgcolor=#dfdfdf>
	<TD valign=top><FONT    SIZE=2  FACE="Arial"><?=$LDTherapy ?>:</TD>
	<TD colspan=3><FONT    SIZE=2  FACE="Arial"><? if($mode=="saveok") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[therapy_1]); else print '<TEXTAREA NAME="therapy_1" Content-Type="text/html"
	COLS="75" ROWS="10">'.$result[therapy_1].'</TEXTAREA>';?><br>
	<img src="../img/arrow.gif" border=0 width=15 height=15 align=absmiddle><a href="#?mode=<?=$mode ?>"><? if ($mode!="saveok") print $LDEnterTherapyNote; else print $LDSeeTherapyNote; ?></a></TD></TR>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDEditOn ?>:</TD>
	<TD colspan=3><FONT    SIZE=2  FACE="Arial" color="#80000">
	<? if(($mode=="saveok")||($mode=="update")) print $result[enc_date].'&nbsp;&nbsp;<font color="#0">'.$LDAt.': <font color="#800000">'.$result[enc_time]; 
	else 
	{
	print '<INPUT NAME="enc_date" TYPE="text" VALUE="'.strftime("%d.%m.%Y").'" SIZE="20"  onKeyUp=setDay(this)> (tt.mm.jjjj)';
	}
	?>
	<BR></TD>
	</TR>
<TR VALIGN="baseline"  bgcolor=#dfdfdf>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDEditBy ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<? if(($mode=="saveok")||($mode=="update")) print $result[encoder]; 
	else
	 print '<INPUT NAME="encoder" TYPE="text" VALUE="'.$medocs_user.'" SIZE="30">';

	?>
	<BR></TD>
	<TD><FONT    SIZE=2  FACE="Arial"><?=$LDKeyNr ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<? if(($mode=="saveok")||($mode=="update")) print $result[keynumber]; 
	else print '<INPUT NAME="keynumber" TYPE="text" VALUE="'.$result[keynumber].'" SIZE="30">';?><BR></TD>
	</TR>
<? if ($mode=="saveok") : ?>
</TABLE>
</TD></TR>
</TABLE><p>
<input type="submit" value="<?=$LDUpdateData ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept" value="<?=$result[dept] ?>">
<input type="hidden" name="doc_no" value="<?=$result[doc_no] ?>">
<input type="hidden" name="enc_date" value="<?=$result[enc_date] ?>">
<input type="hidden" name="lastname" value="<?=$result[lastname] ?>">
<input type="hidden" name="firstname" value="<?=$result[firstname] ?>">
<input type="hidden" name="birthdate" value="<?=$result[birthdate] ?>">
<input type="hidden" name="keynumber" value="<?=$result[keynumber] ?>">
<? else : ?>
<tr bgcolor="#000000">
		<td colspan=4></td>
    	</tr>
<TR  bgcolor=#dfdfdf>
	<TD ALIGN="right"><INPUT TYPE="submit" VALUE="<?=$LDSave ?>"></TD>
	<TD ALIGN="center" colspan=3><INPUT TYPE="reset" VALUE="<?=$LDReset ?>"></TD>
	</TR>
</TABLE>
</TD></TR>
</TABLE>
<input type="hidden" name="mode" value="save">
	<? if($mode=="update") 
		print '
		<input type="hidden" name="update" value="1">
		<input type="hidden" name="dept" value="'.$result[dept].'">
		<input type="hidden" name="doc_no" value="'.$result[doc_no].'">
		<input type="hidden" name="patient_no" value="'.$result[patient_no].'">
  		<input type="hidden" name="enc_time" value="'.$result[enc_time].'">
		<input type="hidden" name="enc_date" value="'.$result[enc_date].'">
  		<input type="hidden" name="keynumber" value="'.$result[keynumber].'">
  		'; 
  ?>
<? endif ?>

<? endif ?>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
</FORM>

<p>
<a href="<?
				if($ck_login_logged) print 'startframe.php?sid='.$ck_sid.'&lang='.$lang;
				else print 'medopass.php?sid='.$ck_sid.'&target=entry&lang='.$lang;
			?>"><img border=0 src="../img/<?="$lang/$lang" ?>_cancel.gif" alt="<?=$LDCancel ?>"></a>
<p>
<FONT    SIZE=2  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15"> <a href="medocs-search.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=?"><?=$LDDocSearch ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="medocs-archiv.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=?"><?=$LDArchive ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:showcat()"><?=$LDCatPls ?></a><br>


</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>

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
