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
define('LANG_FILE','products.php');
$local_user='ck_prod_arch_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

if(!isset($dept)||!$dept)
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept='plop';//default is plop dept
}
if(!isset($mode)) $mode='';
if(!isset($keyword)) $keyword='';

$thisfile='products-archive.php';
$searchfile=$thisfile;
switch($cat)
{
	case 'pharma':	
							$title="$LDPharmacy $LDOrderArchive";
							$dbtable='care_pharma_orderlist';
							$breakfile='apotheke.php?sid='.$sid.'&lang='.$lang;
							break;
	case 'medlager':
							$title="$LDMedDepot $LDOrderArchive";
							$dbtable='care_med_orderlist';
							$breakfile='medlager.php?sid='.$sid.'&lang='.$lang;
							break;
	default:  {header('Location:../language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

if($mode=='search')
{
	$keyword=trim($keyword);
	if(($keyword=='')||($keyword=='%')||($keyword=='_')||(strlen($keyword)<2)) { header("location:$thisfile?sid=$sid&lang=$lang&invalid=1&cat=$cat&userck=$userck"); exit;}
	if($lang=='de')
	{
		if(eregi($keyword,'eilig')) $keyword='urgent';
	}
	if(!$ofset) $ofset=0;
	if(!$nrows) $nrows=20;
}

$linecount=0;

//this is the search module
if((($mode=='search')||$update)&&($keyword!='')) 
{
	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK)
		{
		      /* Load date & time formatter */
              include_once('../include/inc_date_format_functions.php');
              
	
				if($such_date)
				{
				    switch(strtolower($date_format))
					{
					    case 'yyyy-mm-dd' : $separator='-'; break;
						case 'mm/dd/yyyy' : $separator='/'; break;
						case 'dd.mm.yyyy' : $separator='.';
					}
				
					$pc=substr_count($keyword,$separator);
						//echo $pc;
					if($pc)
					{
/*				  	     switch($pc)
					    {
						    case 1:$sdt='%'.implode('.%',array_reverse(explode('.',$keyword)));break;
						    case 2:$sdt='%'.implode('.%',array_reverse(explode('.',$keyword)));break;
						    default:$sdt='%$keyword';
					     }
*/		  
    	                $sdt='%'.formatDate2Std($keyword,$date_format);
					}
					elseif(strlen($keyword)>2) 
					{    
					     $sdt=$keyword;
					}
					else
					{
					     $sdt="________$keyword"; // 8 x _ to fill yyyy.mm.
					}
					
				}
				else
				{
				     $sdt='';
			    }
				
				($such_dept)? $sdp=$keyword : $sdp='';
				
				($such_prio)?  $spr=$keyword : $spr='';
				
				$sql='SELECT * FROM '.$dbtable.' WHERE order_date="'.$sdt.'" 
																OR dept="'.$sdp.'" 
																OR priority="'.$spr.'" ORDER BY order_date DESC,  order_time DESC
																LIMIT '.$ofset.', '.$nrows;
				//echo $sql;
						
        		if($ergebnis=mysql_query($sql,$link)) $linecount=mysql_num_rows($ergebnis);			//count rows=linecount		
				//reset result
				if(!$linecount) 
					{
						($such_date)? $sdt.='%' : $sdt='';
						($such_dept)? $sdp.='%' : $sdp='';
						($such_prio)?  $spr.='%' : $spr='';
						
						$sql='SELECT * FROM '.$dbtable.' WHERE order_date LIKE "'.$sdt.'" 
																OR dept LIKE "'.$sdp.'" 
																OR priority LIKE "'.$spr.'" ORDER BY order_date DESC,  order_time DESC
																LIMIT '.$ofset.', '.$nrows;
						$linecount=0;        				
        				if($ergebnis=mysql_query($sql,$link)) while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;			//count rows=linecount		
						if($linecount>0) mysql_data_seek($ergebnis,0);
					}
			//echo $sql;
	}
  	 else { echo "$LDDbNoLink<br>"; } 
}// end of if(mode==search)

//echo $sql;

$abt=array("PLOP","GYN","Anästhesie","Unfall");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <script language="javascript" >
<!-- 

function pruf(d)
{
	kw=d.keyword;
	var k=kw.value; 
	//if(k=="") return false;
	if((k=="")||(k==" ")||(!(k.indexOf('%')))||(!(k.indexOf('&'))))
	{
		kw.value="";
		kw.focus();
		return false;
	}
	return true;
}
function show_order(d,o)
{
	urlholder="products-archive-orderlist-showcontent.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"; ?>&cat=<?php echo $cat ?>&dept="+d+"&order_nr="+o;
	window.location.href=urlholder;
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<?php 
require('../include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.select()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products.php','arch','','<?php echo $cat ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000">
<?php if($from=="archivepass")
{
echo '<img '.createMascot('../','mascot1_r.gif','0','bottom','absmiddle').'>';
$curtime=date('H.i');
if ($curtime<'9.00') echo $LDGoodMorning;
if (($curtime>'9.00')and($curtime<'18.00')) echo $LDGoodDay;
if ($curtime>'18.00') echo $LDGoodEvening;
echo ' '.$HTTP_COOKIE_VARS[$local_user.$sid];
}else echo '<br>';
?>
</font>
<p>

<?php require('../include/inc_products_archive_search_form.php'); ?>

<hr width=80% align=left>
<?php if($linecount>0)
{
	echo '
			<font face=Verdana,Arial size=2>
			<p> ';
			if ($linecount>1) echo $LDListFoundMany; else echo $LDListFound; 
			 
			echo '.<br> '.$LDClk2SeeEdit.'<br></font><p>';

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td colspan=2>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($LDArchindex);$i++)
		echo '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$LDArchindex[$i].'</td>';
		echo '
				</tr>';	

		$i=$ofset+1;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
			
/*			echo'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content['dept'].'\',\''.$content['order_nr'].'\')"><img '.createComIcon('../','uparrowgrnlrg.gif','0').' alt="'.$LDClk2SeeEdit.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content['dept']).'</td>
				<td><font face=Verdana,Arial size=2>';
*/			
            echo'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="products-archive-orderlist-showcontent.php?sid='.$sid.'&lang='.$lang.'&userck='.$userck.'&cat='.$cat.'&dept='.$content['dept'].'&order_nr='.$content['order_nr'].'"><img '.createComIcon('../','uparrowgrnlrg.gif','0').' alt="'.$LDClk2SeeEdit.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content['dept']).'</td>
				<td><font face=Verdana,Arial size=2>';
				
			echo formatDate2Local($content['order_date'],$date_format).'</td>
			
				 <td><font face=Verdana,Arial size=2>'.convertTimeToLocal(str_replace('24','00',$content['order_time'])).'</td>
				<td align="center">';
				
			if($content['status']=='normal')
				echo '&nbsp;';
				else if($content['priority']=='urgent')  echo '<img '.createComIcon('../','warn.gif','0').' alt="'.$LDUrgent.'!">';

			echo '
					</td>';

			echo '
				 <td><font face=Verdana,Arial size=2>'.str_replace('24','00',formatDate2Local($content['process_datetime'],$date_format)).' '.convertTimeToLocal(formatDate2Local($content['process_datetime'],$date_format,1,1)).'</td>
				 <td><font face=Verdana,Arial size=2>'.$content['modify_id'].'</td>
				</tr>';
			$i++;

 		}
		echo '
			</table>
			</td></tr><tr bgcolor="'.$cfg['body_bgcolor'].'">
			<td>';
		if($ofset) echo '	<form name=back action="'.$thisfile.'" method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
								<input type="hidden" name="lang" value="'.$lang.'">
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="submit" value="&lt;&lt; '.$LDBack.'">
								</form>';
		echo "</td><td align=right>";
		if($linecount==$nrows) 
						echo '<form name=forward action="'.$thisfile.'" method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
								<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
        						<input type="hidden" name="ofset" value="'.($ofset+$nrows).'">
              					<input type="hidden" name="nrows" value="'.$nrows.'">
                   				<input type="hidden" name="sid" value="'.$sid.'">     
								<input type="hidden" name="lang" value="'.$lang.'">
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="submit" value="'.$LDContinue.' &gt;&gt;">
								</form>';
		echo '
			</td>
			</tr>	
			</table>';                            
}
else
{
if($ofset) echo '	<form name=back action="'.$thisfile.'" method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="hidden" name="lang" value="'.$lang.'">
								<input type="submit" value="&lt;&lt; '.$LDBack.'">
								</form>';
							
if($mode=='search') echo '
	<table border=0>
   <tr>
     <td><img '.createMascot('../','mascot1_r.gif','0','middle').'></td>
     <td><font face=Verdana,Arial size=2>'.$LDNoDataFound.'<br>'.$LDPlsEnterMore.'</td>
   </tr>
 </table>';
 
	
}
if($invalid) echo'

	<table border=0>
   <tr>
     <td> <img '.createMascot('../','mascot1_r.gif','0','middle').'>
		</td>
     <td><font face=Verdana,Arial size=2>'.$LDNoSingleChar.'<br>'.$LDPlsEnterMore.'
</td>
   </tr>
 </table>';
	 ?>
<p><br>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="middle"></a>

	

</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
