<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$$ck_sid_buffer)||!$ck_op_pflegelogbuch_user||!$winid||!$patnum) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
*/
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences

$dbtable='care_nursing_op_logbook';
$thisfile="op-pflege-graph-getinfo.php";

switch($winid)
{
	case "entry_out": $title="$LDTimes - $LDOpInFull/$LDOpOutFull";
							$element="entry_out";
							$startid=$LDOpIn;
							$endid=$LDOpOut;
							$maxelement=10;
							break;
	case "cut_close": $title="$LDTimes - $LDOpCut/$LDOpClose";
							$element="cut_close";
							$startid=$LDOpCut;
							$endid=$LDOpClose;
							$maxelement=10;
							break;
	/*
	case "wait_time": $title="Wartezeiten";
							$element="wait_time";
							$maxelement=5;
							break;
	*/
	case "bandage_time": $title="$LDTimes - $LDPlasterCast";
							$element="bandage_time";
							$startid=$LDStart;
							$endid=$LDEnd;
							$maxelement=10;
							break;
	case "repos_time": $title="$LDTimes - $LDReposition";
							$element="repos_time";
							$startid=$LDStart;
							$endid=$LDEnd;
							$maxelement=10;
							break;
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
	// get orig data

		if($mode=='save')
		{
					
				// check if entry is already existing
				$sql="SELECT tid,$element FROM $dbtable 
						WHERE patnum='$patnum' 
						AND dept='$dept' 
						AND op_room='$saal' 
						AND op_nr='$op_nr'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					
					if($rows==1)
					 {
						//echo $sql." checked <br>";
						for($i=0;$i<$maxelement;$i++)
						{
							$sx="tstart".$i;$ex="tend".$i;
							if($$sx){$ib=(float)$$sx;	if($ib<10) $$sx="0".$ib; } else continue;
								
							if($$ex){$ib=(float)$$ex;	if($ib<10) $$ex="0".$ib; }
							{ if($dbuf) $dbuf=$dbuf." ~s=".$$sx."&e=".$$ex;
									else $dbuf="s=".$$sx."&e=".$$ex;
							}
						}
					
							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtable SET $element='$dbuf',tid='$content[tid]'
									WHERE patnum='$patnum'
											AND dept='$dept'
											AND op_room='$saal'
											AND op_nr='$op_nr'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//echo $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&patnum=$patnum&winid=$winid&dept=$dept&saal=$saal&op_nr=$op_nr&year=$pyear&pmonth=$pmonth&pday=$pday");
								}
								else
								{
									echo $LDPatNoExist;
									exit;
								}//end of else
						}// end of if rows
				}
				else { echo "$LDDbNoRead<br>"; } 
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
					//echo $sql."<br>file found!";
				}
			}
				else { echo "$LDDbNoRead<br>"; } 
	 	}
}
  else { echo "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $title ?></TITLE>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

function pruf(d)
{
	 return true
}
 function parentrefresh(){
	//window.opener.location.href="pflege-station-patientdaten-kurve.php?sid=<?php echo $sid ?>&station=<?php echo $station ?>&pn=<?php echo $pn."&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
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
			
			
//			alert("Zeitangabe ist ung�ltig! (ausserhalb des 24H Zeitrahmens)");
	
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

function updatebar(x)
{
	if(x=="main")
	window.opener.parent.LOGINPUT.location.replace('<?php echo "oploginput.php?sid=$sid&lang=$lang&mode=edit&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
	else
	window.opener.parent.OPLOGIMGBAR.location.replace('<?php echo "oplogtimebar.php?sid=$sid&lang=$lang&winid=$winid&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
}
//$imgsrc="../imgcreator/log-timebar.php?sid=$sid&winid=$winid&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";
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

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v12 { font-family:verdana,arial;font-size:13; }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080"  topmargin=2 marginheight=2 
onLoad="<?php if($saved) 
				{
					if(($winid=="entry_out")||($winid=="cut_close")) $buf="main";
					echo "updatebar('$buf');"; 
				}
			?>if (window.focus) window.focus(); window.focus();" >

<a href="javascript:gethelp('oplog.php','time','<?php echo $winid ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> alt="<?php echo $LDHelp ?>" align="right"></a>

<font face=verdana,arial size=5 color=maroon>
<b>
<?php 
	//echo "$title $patnum $dept $saal $op_nr $pday $pmonth $pyear $winid";
	echo $title;
?>
</b>
</font>
<p>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
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
   			 <td  align=center class="v12"><?php echo $startid ?>:</td>
   			 <td  align=center class="v12"><?php echo $endid ?>:</td>
		  </tr>
			<?php 
			$b=explode("~",trim($result[$element]));
			sort($b,SORT_REGULAR);
			if(!$b[0]) array_splice($b,0,1);
			if(sizeof($b)<10) $counter=10;
				else $counter=sizeof($b)+1;
			for($i=0;$i<$counter;$i++)
			{
				parse_str(trim($b[$i]),$bb);
				echo '
 						 <tr>
   						 <td class="v12">'.strtolower($LDFrom).': <input type="text" name="tstart'.$i.'" size=6 maxlength=5 value="'.$bb[s].'"  onKeyUp="isnum(this.value,this.name)">&nbsp;&nbsp;
        				</td>
   						 <td class="v12">'.strtolower($LDTo).': <input type="text" name="tend'.$i.'" size=6 maxlength=5 value="'.$bb[e].'"  onKeyUp="isnum(this.value,this.name)"></td>
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






<?php 	
	$cbuf="sd=$yr$mo$dy&rd=$dy.$mo.$yr";
	$arr=explode("_",$result[$element]);
		while(list($x,$v)=each($arr))
		{
			if(stristr($v,$cbuf))
			{
				$sbuf=$v;
				break;
			}
		}
?>



<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="saal" value="<?php echo $saal ?>">
<input type="hidden" name="op_nr" value="<?php echo $op_nr ?>">
<input type="hidden" name="mode" value="save">

</form>
<p>
<div align=right> 
<a href="javascript:window.close()"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>" border="0" alt="<?php echo $LDClose ?>">
</a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img <?php echo createLDImgSrc('../','reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:document.infoform.submit();"><img <?php echo createLDImgSrc('../','savedisc.gif','0') ?> alt="<?php echo $LDSave ?>"></a>
<?php endif ?>
</div>
</BODY>

</HTML>
