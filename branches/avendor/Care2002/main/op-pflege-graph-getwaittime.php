<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user||!$winid||!$patnum) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
require("../req/config-color.php"); // load color preferences

$thisfile="op-pflege-graph-getwaittime.php";

switch($winid)
{

	case "wait_time": $title=$LDWaitTime;
							$element="wait_time";
							$startid=$LDStart;
							$endid=$LDEnd;
							$maxelement=5;
							break;
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

$dbtable="nursing_op_logbook";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

		if($mode=="save")
		{
					
				// check if entry is already existing
				$sql="SELECT tid,$element FROM $dbtable 
						WHERE patnum='$patnum' 
						AND dept='$dept' 
						AND op_room='$saal' 
						AND op_nr='$op_nr'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					for($i=0;$i<$maxelement;$i++)
					{
						$sx="tstart".$i;
						$ex="tend".$i;
						$rx="reason".$i;
						if($$sx){$ib=(float)$$sx;	if($ib<10) $$sx="0".$ib; } else continue;
						if($$ex){$ib=(float)$$ex;	if($ib<10) $$ex="0".$ib; }
						{ if($dbuf) $dbuf=$dbuf." ~s=".$$sx."&e=".$$ex."&r=".$$rx."&t=".$opts[($$rx)];
								else $dbuf="s=".$$sx."&e=".$$ex."&r=".$$rx."&t=".$opts[($$rx)];
						}
					}
					
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{

							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtable SET $element='$dbuf',tid='$content[tid]'
										WHERE patnum='$patnum'
											AND dept='$dept'
											AND op_room='$saal'
											AND op_nr='$op_nr'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&saved=1&patnum=$patnum&winid=$winid&dept=$dept&saal=$saal&op_nr=$op_nr&year=$pyear&pmonth=$pmonth&pday=$pday");
								}
								else
								{
									print $LDPatNoExist;
									exit;
								}//end of else
						}// end of if rows
				}
				else { print "$LDDbNoRead<br>"; } 
		 }// end of if(mode==save)
		 else
		 {
		 	$sql="SELECT $element FROM $dbtable 
						WHERE patnum='$patnum' 
						AND dept='$dept' 
						AND op_room='$saal' 
						AND op_nr='$op_nr'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					//print $sql."<br>file found!";
				}
			}
				else { print "$LDDbNoRead<br>"; } 
	 	}
}
  else { print "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?=$title ?></TITLE>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	 return true
	}
 function parentrefresh(){
	//window.opener.location.href="pflege-station-patientdaten-kurve.php?sid=<?=$ck_sid ?>&station=<?=$station ?>&pn=<?=$pn."&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
	}
	
function isnum(val,idx)
{
	xdoc=document.infoform;
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
	
function isvalnum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if (!isNaN(xval2)) 
			{
				xval3=xval3 + xval2;
				if (xval3.length>8) 
				{ 
				alert("Die Aufnahmenummer hat maximal 8 Ziffern!"); 
				xdoc.elements[idx].value=xval3.slice(0,8);
				return; }
			}
		}
		xdoc.elements[idx].value=xval3;
}

function isgdatum(val,idx)
{
	xdoc=document.oppflegepatinfo;

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

function updatebar()
{
	window.opener.parent.OPLOGIMGBAR.location.replace('<? print "oplogtimebar.php?sid=$ck_sid&winid=$winid&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
}
//$imgsrc="../imgcreator/log-timebar.php?sid=$ck_sid&winid=$winid&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

//-->
</script>

<script language="javascript" src="../js/setdatetime.js">
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v12 { font-family:verdana,arial;font-size:13; }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080" 
onLoad="<? if($saved) print "updatebar();"; ?>if (window.focus) window.focus(); window.focus();" >

<a href="javascript:gethelp('oplog.php','time','<?=$winid ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 alt="<?=$LDHelp ?>" align="right"></a>

<font face=verdana,arial size=5 color=maroon>
<b>
<? 
	//print "$title $patnum $dept $saal $op_nr $pday $pmonth $pyear $winid";
	print $title;
?>
</b>
</font>
<p>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?=$thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >


<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
    <td  align=center bgcolor="#cfcfcf" class="v13"><font color="#ff0000">&nbsp;</td>
  </tr>
  <tr>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"><?=$startid ?>:</td>
   			 <td  align=center class="v12"><?=$endid ?>:</td>
   			 <td  align=center class="v12"><?=$LDReason ?>:</td>
		  </tr>
			<? 
			$optsize=sizeof($opts);
			$b=explode("~",trim($result[$element]));
			sort($b,SORT_REGULAR);
			if(!$b[0]) array_splice($b,0,1);
			if(sizeof($b)<10) $counter=10;
				else $counter=sizeof($b)+1;
			for($i=0;$i<$counter;$i++)
			{
				parse_str(trim($b[$i]),$bb);
				print '
 						 <tr>
   						 <td class="v12">'.$LDFrom.': <input type="text" name="tstart'.$i.'" size=6 maxlength=5 value="'.$bb[s].'"  onKeyUp="isnum(this.value,this.name)">&nbsp;&nbsp;
        				</td>
   						 <td class="v12">'.$LDTo.': <input type="text" name="tend'.$i.'" size=6 maxlength=5 value="'.$bb[e].'"  onKeyUp="isnum(this.value,this.name)"></td>
   						 <td class="v12">&nbsp;
						 <select name="reason'.$i.'">';
				for($j=0;$j<$optsize;$j++)
				{
					print '
       						<option value="'.$j.'" ';
							if(trim($bb[r])==$j) print 'selected';
					print '> '.$opts[$j].'</option>';
				}
       			print '
					</select>
  						</tr>
 						 ';
				}
 			?>
		</table>
	
	</td>
  </tr>
</table>
</td>
  </tr>
</table>


<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="winid" value="<?=$winid ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pday" value="<?=$pday ?>">
<input type="hidden" name="patnum" value="<?=$patnum ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="saal" value="<?=$saal ?>">
<input type="hidden" name="op_nr" value="<?=$op_nr ?>">
<input type="hidden" name="mode" value="save">

</form>
<p>
<div align=right> 
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDClose ?>">
</a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img src="../img/<?="$lang/$lang" ?>_reset.gif" border="0" alt="<?=$LDReset ?>"></a>
&nbsp;&nbsp;
<? if($saved)  : ?>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" alt="<?=$LDClose ?>"></a>
<? else : ?>
<a href="javascript:document.infoform.submit();"><img src="../img/<?="$lang/$lang" ?>_savedisc.gif" border="0" alt="<?=$LDSave ?>"></a>
<? endif ?>
</div>
</BODY>

</HTML>
