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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');

/**
* The following require loads the access areas that can be assigned for
* user permissions.
*/
require('../include/inc_accessplan_areas_functions.php');

$breakfile='edv.php?sid='.$sid.'&lang='.$lang;

$edit=0;
$error=0;


if($mode!= '') 
{
    if($mode!='edit' && $mode!='update' && $mode!='data_saved')
	{
             /* Trim white spaces off */
         $username=trim($username);
         $userid=trim($userid);
         $pass=trim($pass);

         if($username=='') { $errorname=1; $error=1; }
         if($userid=='') { $erroruser=1; $error=1; }
         if($pass=='') { $errorpass=1; $error=1; }		   
    }

	include_once('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
	{	
	
      if(($mode=='save' && !$error ) || ($mode=='update' && !$erroruser)) 
	  {
 
 
       /* Prepare the permission codes */
		  
		  
	     $p_areas='';
		  
	     while(list($x,$v)=each($HTTP_POST_VARS))
	     {
            if(!ereg('_a_',$x)) continue;
			   
	        if($HTTP_POST_VARS[$x] != '') $p_areas.=$v.' ';
	     }
		  
	     /* If permission area is available, save it */
	      if($p_areas != '')
	      {   
		       
	           if($mode=='save')
	           {
                   $sql='INSERT INTO care_users 
			            (
						   name,
						   login_id,
						   password,
						   permission,
						   s_date,
						   s_time,
						   status,
						   modify_id,
						   create_id,
						   create_time
						 )
						 VALUES
						 (
						   "'.addslashes($username).'",
						   "'.addslashes($userid).'",
						   "'.addslashes($pass).'",
						   "'.$p_areas.'",
						   "'.date('Y-m-d').'",
						   "'.date('H:i:s').'",
						   "normal",
						   "'.$HTTP_COOKIE_VARS[$local_user.$sid].'",
						   "'.$HTTP_COOKIE_VARS[$local_user.$sid].'",
						   NULL
						 )';
				
		      }
		      else
		      {
				   
		           $sql='UPDATE care_users SET permission="'.$p_areas.'", modify_id="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"
														   WHERE login_id="'.$userid.'"';
		       }
			   
			   /* Do the query */
				if(mysql_query($sql,$link))
				{
				      header('Location:edv_user_access_edit.php?sid='.$sid.'&lang='.$lang.'&userid='.strtr($userid,' ','+').'&mode=data_saved');
				      exit;
				}
				else
				{
			           if($mode!='save') $edit=1;
				       $mode='error_double';
				   //echo "$sql $LDDbNoSave";
				}
			}
			else
			{
			  if($mode!='save') $edit=1;
			  $mode='error_noareas';
			} // end if ($p_areas!="")
	    }// end of if($mode=="save"

	if($mode=='edit' || $mode=='data_saved' || $edit)	
		{
		    $sql='SELECT name, login_id, permission FROM care_users WHERE login_id="'.$userid.'"';
		    //$sql='SELECT * FROM care_users WHERE name="'.$username.'"';
			if($ergebnis=mysql_query($sql,$link))
			{
			   if(mysql_num_rows($ergebnis))
			   {
			      $user=mysql_fetch_array($ergebnis);
			      $edit=1;
				}
			   
			}
	    }
	}// end of if($link
    else
	{
	    echo "$LDDbNoLink";
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<HTML>
	<HEAD>
<?php echo setCharSet(); ?>
	
<?php 
require('../include/inc_css_a_hilitebu.php');
?>

<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
	
	</HEAD>

	<BODY bgcolor=<?php echo $cfg['bot_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


	<table width=100% border=0 cellspacing=0>
	<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$LDEDP $LDManageAccess" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('edp.php','access','<?php echo $mode ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
	<tr bgcolor=<?php echo $cfg['body_bgcolor']; ?> >
	<td colspan=2><p><br>
	<ul>

<?php
 //if ($mode=='data_saved' || $error ||  $mode=='error_noareas' || $mode=='data_nosave' )

 if (($mode!='' || $error ) && $mode!='edit' )
{
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  COLOR=red  SIZE=+1  FACE=Arial>
	<?php
	          if ($error) echo  $LDInputError; 
			     elseif ($mode=='data_saved') echo $LDUserInfoSaved;
				   elseif($mode=='error_save') echo $LDUserInfoNoSave;
				     elseif($mode=='error_noareas') echo $LDNoAreas;
				       elseif($mode=='error_double') echo $LDUserDouble;
	 ?></td>
  </tr>
</table>
<?php
}
?>

<FONT    SIZE=3  FACE="Arial" color="#990000">

<?php// if ((($error==1)and($mode=='save'))or(($error==0)and($mode==''))) :; ?>

<?php if(($mode=="")and($remark!='fromlist')) 
{
$gtime=date('H.i');
if ($gtime<'9.00') echo $LDGoodMorning;
if (($gtime>'9.00')and($gtime<'18.00')) echo $LDGoodDay;
if ($gtime>'18.00') echo $LDGoodEvening;
echo ' '.$HTTP_COOKIE_VARS[$local_user.$sid];
}
?>

<p>
<FORM action="edv_user_access_list.php" name="all">

<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="submit" name=message value="<?php echo $LDListActual ?>"></font>

</FORM>

<p>
</FONT>

<form method="post" action="edv_user_access_edit.php" name="user">

<input type="image"  <?php echo createLDImgSrc('../','savedisc.gif','0','absmiddle') ?>>

<?php 
if($mode=='data_saved' || $edit)
{
 echo '<input type="button" value="'.$LDEnterNewUser.'" onClick="javascript:window.location.href=\'edv_user_access_edit.php?sid='.$sid.'&lang='.$lang.'&remark=fromlist\'">';
}
?>


<table border=0 bgcolor="#000000" cellpadding=0 cellspacing=0>
  <tr>
    <td>
	
	<table border="0" cellpadding="5" cellspacing="1">
	
<tr bgcolor="#dddddd">
<td colspan="3"><FONT    SIZE=-1  FACE="Arial">
<?php echo $LDNewAccess ?>:
</td>
</tr>

<tr bgcolor="#dddddd">
<td>
<input type=hidden name=route value=validroute>

<FONT    SIZE=-1  FACE="Arial">
<?php if ($errorname) {echo "<font color=red > <b>$LDName</b>";} 
else { echo $LDName;} ?>

<?php

 if($edit) 
 {
    echo '<input type="hidden" name="username" value="'.$user['name'].'">'.'<b>'.$user['name'].'</b>';
 }
  else
  {
 ?>   

<input name="username" type="text"

<?php if ($username!="") echo "value=".$username ; ?>>
<?php
}
?>

<br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php if ($erroruser) {echo "<font color=red > <b>$LDUserId</b>";} 
else { echo $LDUserId;} ?>

<?php

 if($edit) echo '<input type="hidden" name="userid" value="'.$user['login_id'].'">'.'<b>'.$user['login_id'].'</b>';
  else
  {
 ?> 
<input type=text name="userid"
<?php if ($userid!="") echo "value=".$userid ; ?>>
<?php
}
?>

<br>
</td>
<td><FONT    SIZE=-1  FACE="Arial">
<?php if ($errorpass) {echo "<font color=red > <b>$LDPassword</b>";} 
else { echo $LDPassword;} ?>

<?php

 if($edit) echo '<input type="hidden" name="pass" value="*">****';
 else 
  {
 ?>
<input type="password" name="pass" <?php if ($pass!="") echo "value=".$pass ; ?>>

<?php
}
?>

<br>
</td>
</tr>

<tr bgcolor="#dddddd">
<td  colspan=3><FONT    SIZE=-1  FACE="Arial">
<?php if ($errorbereich) {echo "<font color=red > <b>$LDAllowedArea</b> </font>";} 
else { echo $LDAllowedArea;} ?>
</td>
</tr>


<tr bgcolor="#dddddd">
<td  colspan=3>

<table border=0 cellspacing=0 width=100%>



<!--  The list of the permissible areas are displayed here  -->

<?php

/* Loop through the elements of the access area tags */
while (list($x,$v)=each($area_opt))
{
   echo '<tr  bgcolor="white">';
   
   
   if (eregi('title',$x))  // If title print it out
   {
      echo '
     <td  valign=top bgcolor="#81eff5" colspan=5><FONT    SIZE=2  FACE="Arial">'.$v.'</td>';
	}
	else
	{  
	   // get the colum index
	   $cindex=substr($x,3,1);
	   
	   // extract the actual index name
	   
	   //$x_name=substr($x,strpos($x,'x')+1);
	   
	   
	   switch($cindex)
	   {
	      case 0: echo '
		                      <td  valign=top colspan=5><img  '.createComIcon('../','redpfeil.gif','0','absmiddle').'><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">	';
							     else echo '><FONT    SIZE=2  FACE="Arial" >';
							  echo $v.'</td>';
			          break;
	      case 1: echo '
		                      <td><img src="p.gif" width=15></td><td  valign=top colspan=4><img '.createComIcon('../','tl2-blue.gif','0','absmiddle').'><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '><FONT    SIZE=2  FACE="Arial" >';
							  echo $v.'</td>';
			          break;
	      case 2: echo '
		                      <td><img src="p.gif" width=15><td><img src="p.gif" width=15><td  valign=top colspan=3><img '.createComIcon('../','tl2-blue.gif','0','absmiddle').'><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '><FONT    SIZE=2  FACE="Arial" >';
							  echo $v.'</td>';
			          break;
	      case 3: echo '
		                       <td><img src="p.gif" width=15><td><img src="p.gif" width=15><td><img src="p.gif" width=15><td  valign=top colspan=2><img '.createComIcon('../','tl2-blue.gif','0','absmiddle').'><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '><FONT    SIZE=2  FACE="Arial" >';
							  echo $v.'</td>';
			          break;
	      case 4: echo '
		                       <td><img src="p.gif" width=15><td><img src="p.gif" width=15><td><img src="p.gif" width=15><td><img src="p.gif" width=15><td  valign=top colspan=1><img '.createComIcon('../','tl2-blue.gif','0','absmiddle').'><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '><FONT    SIZE=2  FACE="Arial" >';
							  echo $v.'</td>';
			          break;
	   }
	 }
	 
  echo '
  </tr>';
}	   
	   
	   


?>

</table>


</td>
</tr>




<tr bgcolor="#dddddd">
<td colspan=3><FONT    SIZE=-1  FACE="Arial">
<p>
<input type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="<?php if($edit || $mode=='data_saved' || $mode=='edit') echo 'update'; else echo 'save'; ?>">
<input type="image"  <?php echo createLDImgSrc('../','savedisc.gif','0','absmiddle') ?>>
<input type="reset"  value="<?php echo $LDReset ?>">
</td>
</tr>
</table>
	
	</td>
  </tr>
</table>



</form>

<p>
<FORM action="<?php if ($ck_edv_admin_user!="") echo "edv-system-admi-menu.php"; else echo "edv.php"; ?>" >
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></font></FORM>
<p>
</FONT>

<?php //endif; ?>

</ul>
<p>
</td>
</tr>
</table>        
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</FONT>

</BODY>
</HTML>
