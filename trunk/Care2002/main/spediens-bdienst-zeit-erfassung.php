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
define("LANG_FILE","or.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php"); // load color preferences

if(!isset($pyear)||empty($pyear)) $pyear=date(Y);
if(!isset($pmonth)||empty($pmonth)) $pmonth=date(m);
if(!isset($pday)||empty($pday)) $pday=date(d);

$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

$dbtable="duty_performance_report";
$thisfile="spediens-bdienst-zeit-erfassung.php";
if($retpath=="spec") $breakfile="spediens.php?sid=$sid&lang=$lang";
 else $breakfile="op-doku.php?sid=$sid&lang=$lang";

/********************************* Resolve the department and op room ***********************/
require("../include/inc_resolve_opr_dept.php");

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

		if($mode=="save")
		{

					//print $sql." checked <br>";
				for($i=0;$i<$maxelement;$i++)
				{
					$tg="tag".$i;
					if($$tg)
					{
						$dt="datum".$i;
						$an="aname".$i;
						$av="avon".$i;
						$ab="abis".$i;
						$rn="rname".$i;
						$rv="rvon".$i;
						$rb="rbis".$i;
						$op="opsaal".$i;
						$dg="diagnosis".$i;
						$td="tid".$i;
						$en="enc".$i;
						if($$td)
							{

							// $dbuf=htmlspecialchars($dbuf);
								$sql="UPDATE $dbtable 
										SET a_name='".$$an."',
											  a_stime='".$$av."',
										      a_etime='".$$ab."',
    						                  r_name='".$$rn."',
										      r_stime='".$$rv."',
										      r_etime='".$$rb."',
										      op_room='".$$op."',
										      diag_therapy='".$$dg."',
											  encoding='".$$en." ~e=$encoder&a=$a_enc&r=$r_enc&d=".date("d.m.Y")."&t=".date("H.i")."',
											  tid='".$$td."'
										WHERE dept='$dept'
										AND date='$pday.$pmonth.$pyear'
										AND tid='".$$td."'";
											
								if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									//mysql_close($link);
									//header("location:$thisfile?sid=$sid&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear");
								}
								else
								{
									print "$sql <p>";
									exit;
								}//end of else
							}// end of if rows
							else
							{
							 if($$dt&&($$an||$$rn)&&$$op&&$$dg)
							  {
							  	list($id,$im,$iy)=explode(".",$$dt);
								if(strlen($id)<2) $id="0".$id;
								if(strlen($im)<2) $im="0".$im;
								$srcdt=$iy.$im.$id;
							 	$sql="INSERT INTO $dbtable 
									(
										dept,
										date,
										src_date,
										a_name,
										a_stime,
										a_etime,
										r_name,
										r_stime,
										r_etime,
										op_room,
										diag_therapy,
										encoding
									) 
									VALUES 
									( 
										'".$dept."',
										'".$$dt."',
										'".$srcdt."',
										'".$$an."',
										'".$$av."',
										'".$$ab."',
										'".$$rn."',
										'".$$rv."',
										'".$$rb."',
										'".$$op."',
										'".$$dg."',
										'e=$encoder&a=$a_enc&r=$r_enc&d=".date("d.m.Y")."&t=".date("H.i")."'
									)";

									if($ergebnis=mysql_query($sql,$link))
       								{
										//print $sql." new insert <br>";
										//mysql_close($link);
										//header("location:$thisfile?sid=$sid&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&retpath=$retpath&ipath=$ipath");
									}
									else print "<p>".$sql."<p>$LDDbNoSave"; 
								 } // end of if
							}// end of else	
					  } // end of if $$tg
				}// end of for
			header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&pday=$pday&retpath=$retpath");
		 }// end of if(mode==save)
		 else
		 {
			$sql="SELECT * FROM $dbtable WHERE  src_date='$pyear$pmonth$pday'";
			if(date(Hi)<830) // if time is early morning recover the data of yesterday
			{
				if ($pday==1)
				{
 					if ($pmonth==1)
					{
						$tm=12;
						$td=31;
						$ty=$pyear-1;
    				}
 					else
					{
	 					$tm=$pmonth-1;
						$td=31;
						while (!checkdate($tm,$td,$pyear)) $td--;
					}
				}
				else 
				{
						$td=$pday-1; $tm=$pmonth; $ty=$pyear;
				}
				$sql.=" OR ( src_date='$ty$tm$td'  AND tid>".$ty.$tm.$td."153000) ORDER BY src_date";
			}
			//print $sql."<br>file found!";
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0; 
				while( $result=mysql_fetch_array($ergebnis))
				{
					if($result) $content[]=$result;
					 $rows++;
				}
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					//print $sql."<br>file found!";
				}
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
	 	}// end of else
}
  else { print "$LDDbNoLink<br>"; } 


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

<script language="javascript">
<!--
	var newdataflag=0;
	var speichern=0;
	
function winreset(){ newdataflag=0;}

function newdata(d)
{ 
newdataflag=1; 
eval("document.reportform.tag"+d+".value=1");
}

<?php
switch($retpath)
{
	case "op": $rettarget="op-doku.php?sid=$sid"; break;
	case "spec": $rettarget="spediens.php?sid=$sid"; break;
	default: $rettarget="op-doku.php?sid=$sid"; break;
}
?>

function closeifok()
{ 
	if (newdataflag==0)
	{ window.location.href="<?php echo $breakfile ?>";} 
	else
	{
		 if(confirm("<?php echo $LDAlertNotSavedYet ?>"))	{ window.document.reportform.submit();}
	}
}

	function timecheck() {
		var jetzt=new Date()
		var stunden=jetzt.getHours()
		var minuten=jetzt.getMinutes()
		if (minuten<10) { minuten="0" + minuten }
		return stunden + ":" + minuten;
		}

function isnum(val,idx)
{
	xdoc=document.reportform;
	if (isNaN(val))
	{
		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		//if (!isNaN(xval3 + xval2)) {xval3=xval3 + xval2;}
		if (isNaN(xval2))
		 {
			xdoc.elements[idx].value=xval2;
			setTime(xdoc.elements[idx]);
			return;
			}
		}
		xdoc.elements[idx].value=xval3;

	}
	else
	{
		v3=val;
		if((v3==24)&&(v3.length==2)) v3="00";
		if (v3>24) 
		{

		
			switch(v3.length)
			{
			
				case 2: v1=v3.slice(0,1); v2=v3.slice(1,2);
						if(v2<6) v3="0"+v1+"."+v2; else v3=v3.slice(0,1); break;
				case 3: v1=val.slice(0,2); v2=val.slice(2,3);

						if(v2<6) v3=v1+"."+v2; 
							else v3=v3.slice(0,2);
						break;
				case 4: v3=val.slice(0,3); break;
			}
			
			
//			alert("Zeitangabe ist ungültig! (ausserhalb des 24H Zeitrahmens)");
	
		}
		switch(v3.length)
			{
				
				case 2: v1=v3.slice(0,1);v2=v3.slice(1,2);
						if(v2==".") v3="0"+v3;break;
		
				case 3: v1=v3.slice(0,2);v2=v3.slice(2,3);
						if(v2!=".") if(v2<6) v3=v1+"."+v2; else v3=v1; break;
				case 4: if(v3.slice(3,4)>5) v3=v3.slice(0,3); break;
			}
		if(v3.length>5) v3=v3.slice(0,v3.length-1);
		xdoc.elements[idx].value=v3;
	}
	
}
	

function isgdatum(val,idx)
{
		xdoc=document.reportform;
		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if ((!isNaN(xval2))||(xval2=="."))
			{
				if(xval2==".")
				{
				 if(val.length>1) xval3=xval3+xval2;
				}
				else 
				{
					 xval3=xval3+xval2;					
				}
			}
			else
			{
			xdoc.elements[idx].value=xval2;
			setDate(xdoc.elements[idx]);
			return;
			}
		}
		switch (xval3.length)
		{
			case 2: v1=xval3.slice(0,1);
					v2=xval3.slice(1,2);
					if(v2==".")
					{
						if (v1==0) xval3=""; else xval3="0"+xval3;
					}
					else {
					if ((v1+v2)<1) xval3=""; 
						else if ((v1+v2)>31) xval3="0"+v1+"."+v2; 
							
					}
					 break;
			case 3: v1=xval3.slice(0,2);
					v2=xval3.slice(2,3);
					if (v2!=".") xval3=v1+"."+v2; 
					break;
			case 4: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					if (v2!=".") xval3=v1+v2; else xval3=v1;
					break;
			case 5: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					v3=xval3.slice(4,5);
					if (v3==".")
					{
						if (v2==0) xval3=v1+v2; 
							else xval3=v1+"0"+v2+v3;
					}
					else if((v2+v3)<1) xval3=v1+v2;
						else if((v2+v3)>12) xval3=v1+"0"+v2+"."+v3;
					break;
			case 6: v1=xval3.slice(0,5);
					v2=xval3.slice(5,6);
					if (v3!=".")
					{
						if (v2==0) xval3=v1 
							else xval3=v1+"."+v2;
					}
					break;
		}
 	if ((xval3.length>6)&&(xval3.slice(xval3.length-1,xval3.length)=="."))xval3=xval3.slice(0,xval3.length-1);
	if (xval3.length>10) xval3=xval3.slice(0,10);
	xdoc.elements[idx].value=xval3;

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>

<script language="javascript" src="../js/setdatetime.js">
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"  >


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>"  height="35"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>
 &nbsp;<?php echo "$LDOnCallDuty ".$opabt['$dept']; ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="javascript:gethelp('op_duty.php','dutydoc','<?php echo $rows ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p>


<form name="reportform" method="post" action="<?php echo $thisfile ?>">

<table width=100% border=0 cellspacing="0" cellpadding=3>

<tr  bgcolor="#ffffdd">

<?php 

for ($i=0;$i<sizeof($LDDutyElements);$i++)
	{
		print '<td ><FONT    SIZE=-1  FACE="Arial">&nbsp;'.$LDDutyElements[$i].'</FONT></td>';

	};
?>
</tr>



<?php
$entries=sizeof($content)+2; $toggle=0;

for ($i=0;$i<$entries;$i++)
{
print '
<tr ';
if($toggle){ print 'bgcolor="#f9f9f9"';}else { print 'bgcolor="#cfcfcf"'; }
$toggle=!$toggle;
print '>
<td rowspan=2 valign=top>
	<FONT    SIZE=-1  FACE="Arial">';
if($content[$i][tid])
print $content[$i][date].'<input type="hidden" name="datum'.$i.'" value="'.$content[$i][date].'">';
 else print'
	<input type=text name="datum'.$i.'" size=9 maxlength=10 value="'.$content[$i][date].'" onKeyUp="isgdatum(this.value,this.name);newdata(\''.$i.'\'); ">';
print '</FONT>
</td>
<td >
	<FONT    SIZE=-1  FACE="Arial" color=#ff0000>
	<b>A</b>
	</FONT>
</td>
<td valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="aname'.$i.'" value="'.$content[$i]['a_name'].'" size=20 width=20 onKeyUp=newdata(\''.$i.'\') >
	</FONT>
</td>
<td valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="avon'.$i.'" value="'.$content[$i]['a_stime'].'" size=5 maxlength=5 onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
	</FONT>
</td>
<td valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="abis'.$i.'" value="'.$content[$i]['a_etime'].'" size=5 maxlength=5  onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
	</FONT>
</td>
<td rowspan=2 valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="opsaal'.$i.'" size=3 value="';
	
if($content[$i]['op_room']) print $content[$i]['op_room']; else print $saal;

print '" onKeyUp=newdata(\''.$i.'\')>
</FONT>
</td>
<td  rowspan="2">
	<FONT    SIZE=-1  FACE="Arial">
	<textarea  name="diagnosis'.$i.'" cols="30" rows="2" onKeyUp=newdata(\''.$i.'\')>'.$content[$i]['diag_therapy'].'</textarea>
	</FONT>
</td>
</tr>

<tr ';
if(!$toggle){ print 'bgcolor="#f9f9f9"';}else { print 'bgcolor="#cfcfcf"'; }

print '>
<td >
	<FONT    SIZE=-1  FACE="Arial" color=green>
	<b>R</b>
	</FONT>
</td>
<td valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="rname'.$i.'" value="'.$content[$i]['r_name'].'" size=20 width=20 onKeyUp=newdata(\''.$i.'\')>
	</FONT>
</td>
<td valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="rvon'.$i.'" value="'.$content[$i]['r_stime'].'" size=5  maxlength=5 onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
	</FONT>
</td>
<td valign=top>
	<FONT    SIZE=-1  FACE="Arial">
	<input type=text name="rbis'.$i.'" value="'.$content[$i]['r_etime'].'" size=5  maxlength=5 onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');"> 
	</FONT>
	<input type="hidden" name="tid'.$i.'" value="'.$content[$i]['tid'].'">
	<input type="hidden" name="enc'.$i.'" value="'.$content[$i]['encoding'].'">
	<input type="hidden" name="tag'.$i.'" value="';
if($content[$i][tid]) print '1';
print '">
</td>
</tr>
';
}

?>




</table>        
<p>

<table cellpadding="0" cellspacing=5 >
<tr>
<td>
<FONT    SIZE=-1  FACE="Arial">
<?php echo $LDStandbyPerson ?>:  <input type=text name="a_enc" size=30 value="<?php if(isset($a_enc)) echo $a_enc; else echo $HTTP_COOKIE_VARS['ck_login_username']; ?>">
</td>
<td>
<FONT    SIZE=-1  FACE="Arial">
&nbsp; <?php echo $LDOnCallPerson ?>:  <input type=text name="r_enc" size=30 value="<?php if(isset($r_enc)) echo $r_enc; ?>">
</td>
<tr>
<td colspan="2">&nbsp;
</td>
</tr>
<tr>
<td valign="top">
<input type="hidden" name="maxelement" value="<?php echo $entries ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="encoder" value="<?php echo $encoder ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="mode" value="save">
<input type=submit value="<?php echo $LDSave ?>">  
<input type=reset value="<?php echo $LDReset ?>" onClick=winreset()>
</td>
<td align="right">

<INPUT TYPE="BUTTON" VALUE="<?php echo $LDPrint ?>" ONCLICK="if (window.print) {window.print();} else {window.alert('<?php echo $LDAlertNoPrinter ?>');}">
&nbsp;&nbsp;<a href="javascript:closeifok()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 align=absmiddle></a>
</td>
</tr>
</table>
</form>

<p>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
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
