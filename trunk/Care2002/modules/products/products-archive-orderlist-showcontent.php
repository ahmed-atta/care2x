<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_arch_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

/*if(!isset($dept)||!$dept)
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept='plop';//default is plop dept
}
*/
$thisfile='products-archive-orderlist-showcontent.php';
$searchfile='products-archive.php';
$returnfile="products-archive.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck";

switch($cat)
{
	case 'pharma':
							$title=$LDPharmacy;
							$dbtable='care_pharma_orderlist';
							$breakfile=$root_path.'modules/pharmacy/apotheke.php?sid='.$sid.'&lang='.$lang;
							break;
	case 'medlager':
							$title=$LDMedDepot;
							$dbtable='care_med_orderlist';
							$breakfile=$root_path.'modules/med_depot/medlager.php?sid='.$sid.'&lang='.$lang;
							break;
	default:  {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

// the value of dept comes from the calling page

// define the content array
$rows=0;
$count=0;
//echo $sql;

/* Load the common icon images */
$img_info=createComIcon($root_path,'info3.gif','0');

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
	if((k=="")||(k==" ")||(!(k.indexOf('%')))||(!(k.indexOf('_'))))
	{
		kw.value="";
		kw.focus();
		return false;
	}
	return true;
}

function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&cat=<?php echo $cat ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}

// -->
</script> 

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.focus()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products.php','archshow','','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>

<p>
<?php 
require($root_path.'include/inc_products_archive_search_form.php'); 

$rows=0;

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
     /* Load the date formatter */
     include_once($root_path.'include/inc_date_format_functions.php');
     

				$sql='SELECT * FROM '.$dbtable.' 
							 WHERE order_nr="'.$order_nr.'"';
        		if($ergebnis=$db->Execute($sql))
				{

					$rows=$ergebnis->RecordCount();
						
				}else { echo "$LDDbNoRead<br>"; } 
				
			
			//echo $sql;
}
else 
{ echo "$LDDbNoLink<br>"; } 
	
	
if($rows>0){

	# Create the department object
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	if($depts=&$dept_obj->getAllActiveObject()){
		while($buf=$depts->FetchRow()){
			$dept[$buf['nr']]=$buf;
		}
	}


//++++++++++++++++++++++++ show general info about the list +++++++++++++++++++++++++++
$tog=1;
$content=$ergebnis->FetchRow();
echo '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDArchValindex);$i++)
	echo '
		<td><font face=Verdana,Arial size=2 color="#0000ff">'.$LDArchValindex[$i].'</td>';
	echo '</tr>
			<tr bgcolor=#f6f6f6>
				<td><font face=Verdana,Arial size=2>';
				
				$buffer=$dept[$content['dept_nr']]['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) 	echo $$buffer;
					else echo $dept[$content['dept_nr']]['name_formal'];
					
			echo '</td>
				 <td><font face=Verdana,Arial size=2>'.formatDate2Local($content['order_date'],$date_format).'</td>
				<td ><font face=Verdana,Arial size=2>'.convertTimeToLocal($content['order_time']).'</td>
				<td><font face=Verdana,Arial size=2>'.$content['modify_id'].'</td>
				<td><font face=Verdana,Arial size=2>'.substr($content['validator'],0,strpos($content['validator'],'@')).'</td>
				<td><font face=Verdana,Arial size=2>'.formatDate2Local($content['sent_datetime'],$date_format).'</td>
				<td><font face=Verdana,Arial size=2>'.convertTimeToLocal(formatDate2Local($content['sent_datetime'],$date_format,0,1)).'</td>
				<td><font face=Verdana,Arial size=2>'.$content['priority'].'</td>
				</tr></table></td></tr></table>';

//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
$tog=1;
$artikeln=explode(' ',$content['articles']);
echo '<form name=actlist>
		<font face="Verdana, Arial" size=2 color="#800000">';
if (sizeof($artikeln)==1) echo $LDOrderedArticle; else echo  $LDOrderedArticleMany;

$LDFinindex[]='';
echo '</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDFinindex);$i++)
	echo '
		<td><font face=Verdana,Arial size=2 color="#000080">'.$LDFinindex[$i].'</td>';
	echo '</tr>';	

$i=1;
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	parse_str($artikeln[$n],$r);
	if($tog)
	{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
	echo'
				<td><font face=Arial size=2 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=2>'.$r['artikelname'].'</td>
				 <td><font face=Verdana,Arial size=2>'.$r['pcs'].'</td>
				<td ><font face=Verdana,Arial size=2><nobr>X '.$r['proorder'].'</nobr></td>
				<td><font face=Verdana,Arial size=2>'.$r['bestellnum'].'</td>';
				echo '<td><a href="javascript:popinfo(\''.$r['bestellnum'].'\')" ><img '.$img_info.' alt="'.$LDOpenInfo.$r['artikelname'].'"></a></td>
			</tr>';
	$i++;
 	}
	echo '</table>
			</form>
			';
}
 ?>
<a href="<?php echo $returnfile; ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
</table>
	

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
