<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','ambulatory.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
/* Create department object and load all medical depts */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj= new Department;
$medical_depts=&$dept_obj->getAllMedical();

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<script language="javascript">
<!-- Script Begin
function goDept(t) {
	d=document.dept_select;
	if(d.dept_nr.value!=""){
		d.subtarget.value=d.dept_nr.value;
		d.action=t;
		d.submit();
	}
}
//  Script End -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDDepartments ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('submenu1.php','<?php echo $LDDoctors ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<TABLE cellSpacing=0 cellPadding=0 width=700  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700  bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=2><b><?php echo $LDEmergency ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND ?>&target=generic&subtarget=14&user_origin=amb"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD><!-- // 14= emergency ambulator department  -->
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/news/newscolumns.php<?php echo URL_APPEND ?>&dept_nr=14&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
				  
				  
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>				
		<p>

<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=2><b><?php echo $LDGeneralSurgery ?></b></FONT></TD></TR>

              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND.'&target=generic&subtarget=15&user_origin=amb'; // 15 = general ambulatory department ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>	
				  
			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/news/newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=15&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>

				  	  
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>

<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=2><b><?php echo $LDSonography ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND.'&target=generic&subtarget=17&user_origin=amb'; // 17 = Sonography department ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

				  			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/news/newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=17&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>

				  
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>				
		<p>
		
<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
  				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=2><b><?php echo $LDInternalMed ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND.'&target=generic&subtarget=16&user_origin=amb'; // 16 = internal med ambulatory dept ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/news/newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=16&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
				  

		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>

<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
  				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><FONT face="Verdana,Helvetica,Arial"  color="#990000"
                  size=2><b><?php echo $LDNuclearMed ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php<?php echo URL_APPEND.'&target=generic&subtarget=18&user_origin=amb'; // 18 = nuclear diagnostics dept  ?>"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path ?>modules/news/newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=18&user_origin=amb"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
				  

		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
		
<TABLE cellSpacing=0 cellPadding=0 width=700 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=700 bgColor=#999999 
            border=0>
              <TBODY>
			  
  			<form name="dept_select" method="post" action=""> 
			
              <TR bgColor=#dddddd>
                <TD colSpan=3 bgColor=#dddddd >
				<select name="dept_nr" size="1">  
				<option value=""></option>
				<?php
				while(list($x,$v)=each($medical_depts)){
				echo'
				<option value="'.$v['nr'].'">';
				$buffer=$v['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
					else echo $v['name_formal'];
				echo '</option>';
			}
				  ?>
				</select>  
				<img src="<?php echo $root_path ?>gui/img/common/default/l-arrowgrnlrg.gif" border=0 width=16 height=16>
				<FONT face="Verdana,Helvetica,Arial" size=2><b><?php echo $LDSelectDept ?></b></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'waiting.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="javascript:goDept('<?php echo $root_path ?>modules/laboratory/labor_test_request_pass.php')"><?php echo $LDPendingRequest ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPendingRequestTxt ?></FONT></TD></TR>

			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'bubble2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="javascript:goDept('<?php echo $root_path ?>modules/news/newscolumns.php')"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
			<input type="hidden" name="sid" value="<?php echo $sid ?>">
   			<input type="hidden" name="lang" value="<?php echo $lang ?>">
   			<input type="hidden" name="target" value="generic">
   			<input type="hidden" name="user_origin" value="amb">
   			<input type="hidden" name="subtarget" value="">
			</form>

		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		
		<p>
		
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDCloseAlt ?>" align="middle"></a>
<p>
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
</td></tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
