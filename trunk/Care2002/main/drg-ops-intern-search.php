<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$opnr||!$pn) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
?>
<? if($saveok) : ?>
 <script language="javascript" >
 window.opener.location.href='drg-ops-intern.php?sid=<?="$ck_sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>
	<? exit; ?>
<? endif ?>
<?
require("../language/".$lang."/lang_".$lang."_drg.php");
require("../req/config-color.php");

$toggle=0;

$thisfile="drg-ops-intern-search.php";

if($mode=="save")
{
	$target="ops-intern";
	$element="ops_intern_code";
	$itemselector="sel";
	include("../req/drg-entry-save.php");
}
else
{
	$fielddata="code,description,sub_level,notes,remarks";

	$keyword=trim($keyword);

	if(($keyword)and($keyword!=" "))
  	{
		$dbtable="ops_intern_".$lang;

		/***************** the ff: is to establish connection DO NOT EDIT ..................
  							the variable $DBLink_OK will be tested in the script to determine
							wether the link is established or not
			***************************************************************************** */

		include("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
		{	

		if(strlen($keyword)<3)
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE (code LIKE "%'.$keyword.'%" OR description LIKE "'.$keyword.'%")  LIMIT 0,100';
			else
				$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE (code LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")  LIMIT 0,100';
			if($ergebnis=mysql_query($sql,$link))
       		{
				$linecount=0;
				if ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				else
				{
					$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE synonyms LIKE "%'.$keyword.'%"  LIMIT 0,100';
        		
					if($ergebnis=mysql_query($sql,$link))
       				{
						if ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
					}
				}
				
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead"; exit;};
		}else {print "<p>".$sql."<p>$LDDbNoLink"; exit;};
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?=$LDOps301 ?></TITLE>
  <script language="javascript" src="../js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function subsearch(k)
{
	//window.location.href='drg-icd10-search.php?sid=<?="sid=$ck_sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&display=$display" ?>&keyword='+k;
	document.searchdata.keyword.value=k;
	document.searchdata.submit();
}
function checkselect(d)
{
	var ret=false;
	var x=d.lastindex.value;
	for(i=0;i<x;i++)
	if(eval("d.sel"+i+".checked"))
	{
		ret=true;
		break;
	}
	return ret;
}
// -->
</script>
 
  <? 
require("../req/css-a-hilitebu.php");
?>
 
</HEAD>

<BODY   onLoad="if(window.focus) window.focus();
<? if(!$showonly) : ?>
document.searchdata.keyword.select();document.searchdata.keyword.focus();
<? endif ?>
" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<ul>
<FORM action="<?=$thisfile ?>" method="post" name="searchdata" onSubmit="return pruf(this)">
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="right"></a>
<? if(!$showonly) : ?>
<FONT    SIZE=3  FACE="verdana,Arial" color="#660000"><b><?=$LDOperation ?></b>&nbsp;
</font>
<font size=3>
<INPUT type="text" name="keyword" size="50" maxlength="60" onfocus=this.select() value="<? print $keyword ?>"></font> 
<INPUT type="submit" name="versand" value="<?=$LDSearch ?>">
<? else : ?>
<input type="hidden" name="keyword" value="">
<? endif ?>
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="pn" value="<? print $pn; ?>">
<input type="hidden" name="opnr" value="<? print $opnr; ?>">
<input type="hidden" name="ln" value="<? print $ln; ?>">
<input type="hidden" name="fn" value="<? print $fn; ?>">
<input type="hidden" name="bd" value="<? print $bd; ?>">
<input type="hidden" name="dept" value="<? print $dept; ?>">
<input type="hidden" name="oprm" value="<? print $oprm; ?>">
<input type="hidden" name="display" value="<? print $display; ?>">
</FORM>
<p>

<form name="ops301" onSubmit="return checkselect(this)">

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<tr bgcolor="#660000">
<td width="20">
<? if(!$showonly) : ?>
<img src="../img/delete2.gif" border=0 width=20 height=20 alt="<?=$LDReset ?>" onClick="javascript:document.ops301.reset()">
<? endif ?>
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?=$LDOpsIntern ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?=$LDDescription ?></b>
</td>
		
</tr>

<?
function cleandata(&$buf)
{
	return strtr($buf,",.()*+-","_______");
}

function drawAdditional($tag,&$codebuf,&$databuf,$bkcolor,&$alttag)
{
	global $LDClose;
	
							//print '&nbsp;<a href="javascript:ssm(\''.$tag.'_'.cleandata($codebuf).'\'); clearTimeout(timer)"><img src="../img/l_arrowGrnSm.gif" border=0 width=12 height=12 alt="'.$alttag.'" align="absmiddle"></a>';
							print '<DIV id='.$tag.'_'.cleandata($codebuf).'
									style=" VISIBILITY: hidden; POSITION: absolute;">
									<TABLE cellSpacing=1 cellPadding=0 bgColor="#000000" border=0>
  									<TR>
   									 <TD>
      									<TABLE cellSpacing=1 cellPadding=7 width="100%" bgColor="#'.$bkcolor.'" border=0><TBODY>
        								<TR>
										<TD bgColor="#'.$bkcolor.'">
										<a href="javascript:hsm()"><img src="../img/delete2.gif" border=0 width=20 height=20 alt="'.$LDClose.'" align="right"></a>
										<font face=arial size=2><b><font color="#003300">'.$alttag.':</font></b><br>'.$databuf.'
										</TD></TR></TABLE></TD></TR></TBODY></TABLE></div>';
}

function drawdata(&$data)
{
	global $toggle,$LDInclusive,$LDExclusive,$LDNotes,$LDRemarks,$LDExtraCodes,$LDAddCodes;
 	global $idx,$keyword,$showonly;
	
						print "
						<tr bgcolor=";
						if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
						print '
						<td>';
						if(!$showonly)
							{
								$valbuf="code=$data[code]";
								if(!stristr($data[code],".")) $valbuf.="&des=$data[description]";
									else $valbuf.="&des=$parentdata[description] <b>$data[description]</b>";
						 		print '<input type="checkbox" name="sel'.$idx.'" value="'.$valbuf.'">';
								 $idx++;
							}
						print '
							</td>
							<td><font face=arial size=2><nobr>';
						//print " *$parentcode +$grandcode";
						 print "$data[code]&nbsp;";		
						print "&nbsp;</nobr></td>";
						switch($data[sub_level])
							{
								case 0:print '
													<td colspan=7>';
											break;
								case 1:print '
													<td colspan=7>';
											break;
								case 2: print '
													<td colspan=2>&nbsp;</td>
													<td valign="top">';
											print '&nbsp;';
											print '
													</td><td colspan=4>';
											break;
								case 3: print '
													<td colspan=3>&nbsp;</td>
													<td valign="top">';
											if($advdata[sub_level]<$data[sub_level]) print '<img src="../img/l2-blue.gif" border=0 width="20" height="21">'; else print '<img src="../img/t2-blue.gif" border=0 width="20" height="21">';
											print '</td>
													<td colspan=3>';
											break;
								case 4: print '
													<td colspan=4>&nbsp;</td>
													<td valign="top">';
											if($advdata[sub_level]<$data[sub_level]) print '<img src="../img/l2-blue.gif" border=0 width="20" height="21">'; else print '<img src="../img/t2-blue.gif" border=0 width="20" height="21">';
											print '</td>
													<td colspan=2>&nbsp;';
											break;
								case 5: print '
													<td colspan=5>&nbsp;</td>
													<td valign="top">';
											if($advdata[sub_level]<$data[sub_level]) print '<img src="../img/l2-blue.gif" border=0 width="20" height="21">'; else print '<img src="../img/t2-blue.gif" border=0 width="20" height="21">';
											print '</td>
													<td>&nbsp;';
											break;
							}
						//print '<font face=arial size=2>'.trim($data[description]);
						print '<font face=arial size=2>';
						print "$data[description]&nbsp;";		
						
						if($data[inclusive])
						{
							print '&nbsp;<a href="javascript:ssm(\'i_'.cleandata($data[code]).'\');"><img src="../img/l_arrowGrnSm.gif" border=0 width=12 height=12 alt="'.$LDInclusive.'" align="absmiddle"></a>';
							drawAdditional("i",$data[code],$data[inclusive],"00ffcc",$LDInclusive);
						}
						//if($data[inclusive]) print '<br><font size=2 color="#00aa00">'.$data[inclusive].'</font>';
						if($data[exclusive])
						{
							print '&nbsp;<a href="javascript:ssm(\'e_'.cleandata($data[code]).'\');"><img src="../img/warn.gif" border=0 width=16 height=16 alt="'.$LDExclusive.'" align="absmiddle"></a>';
							drawAdditional("e",$data[code],$data[exclusive],"ffccee",$LDExclusive);
						}
						if($data[notes]) 
						{
							print '&nbsp;<a href="javascript:ssm(\'n_'.cleandata($data[code]).'\');"><img src="../img/button_info.gif" border=0 width=15 height=15 alt="'.$LDNotes.'" align="absmiddle"></a>';
							drawAdditional("n",$data[code],$data[notes],"ffcc99",$LDNotes);
						}
						if($data[remarks]) 
						{
							print '&nbsp;<a href="javascript:ssm(\'r_'.cleandata($data[code]).'\');"><img src="../img/bubble2.gif" border=0 width=15 height=14 alt="'.$LDRemarks.'" align="absmiddle"></a>';
							drawAdditional("r",$data[code],$data[remarks],"cceeff",$LDRemarks);
						}
						//if($data[extra_codes]) print '&nbsp;<img src="../img/plus2.gif" border=0 width=16 height=16 alt="'.$LDExtraCodes.'" align="absmiddle">';
						//if($data[extra_codes]) print '&nbsp;<img src="../img/closed.gif" border=0 width=20 height=20 alt="'.$LDExtraCodes.'" align="absmiddle">';
						//if($data[extra_subclass]) print '&nbsp;<img src="../img/button_reset.gif" border=0 width=15 height=15 alt="'.$LDAddCodes.'" align="absmiddle">';
						print '</td>';
					print "</tr>";
}

			if ($linecount>0) 
				{ 
					$idx=0;
					mysql_data_seek($ergebnis,0);
					while($zeile=mysql_fetch_array($ergebnis))
					{
							drawdata($zeile);
							//$idx++;
					}
				}
?>

</table>
<? if(!$showonly&&($linecount>0)) : ?>
<input type="hidden" name="lastindex" value="<?=$idx ?>">
<input type="submit" value="<?=$LDApplySelection ?>">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="pn" value="<? print $pn; ?>">
<input type="hidden" name="opnr" value="<? print $opnr; ?>">
<input type="hidden" name="ln" value="<? print $ln; ?>">
<input type="hidden" name="fn" value="<? print $fn; ?>">
<input type="hidden" name="bd" value="<? print $bd; ?>">
<input type="hidden" name="dept" value="<? print $dept; ?>">
<input type="hidden" name="oprm" value="<? print $oprm; ?>">
<input type="hidden" name="display" value="<? print $display; ?>">
<input type="hidden" name="mode" value="save">

</form>
<? else : ?>
<p>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a>
<? endif ?>
<? if(($linecount>15)&&!$showonly) : ?>

						<p>
						<FORM action="<?=$thisfile ?>" method="post" onSubmit="return pruf(this)" name="form2">
						<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0 align="right"></a>
						<font face="Arial,Verdana"  color="#000000" size=-1>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value="<?=$keyword ?>"> 
						<INPUT type="submit" name="versand" value="<?=$LDSearch ?>">
						<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="pn" value="<? print $pn; ?>">
<input type="hidden" name="opnr" value="<? print $opnr; ?>">
<input type="hidden" name="ln" value="<? print $ln; ?>">
<input type="hidden" name="fn" value="<? print $fn; ?>">
<input type="hidden" name="bd" value="<? print $bd; ?>">
<input type="hidden" name="dept" value="<? print $dept; ?>">
<input type="hidden" name="oprm" value="<? print $oprm; ?>">
<input type="hidden" name="display" value="<? print $display; ?>">
</font></FORM>			
						<p>
<? endif ?>
</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
