<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
$breakfile='startframe.php'.URL_APPEND;
$thisfile=basename(__FILE__);

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

$HTTP_SESSION_VARS['sess_file_break']=$top_dir.$thisfile;
$HTTP_SESSION_VARS['sess_file_return']=$top_dir.$thisfile;
$HTTP_SESSION_VARS['sess_file_editor']='headline-edit-select-art.php';
$HTTP_SESSION_VARS['sess_file_reader']='headline-read.php';
$HTTP_SESSION_VARS['sess_title']=$LDEditTitle.'::'.$LDSubmitNews;
//$HTTP_SESSION_VARS['sess_user_origin']='main_start';
$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.$thisfile;
$HTTP_SESSION_VARS['sess_dept_nr']=0; // reset the department number used in the session
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
var urlholder;

  function bdienstwin(){
	winspecs="width=800,height=600,menubar=no,resizable=yes,scrollbars=yes";
	urlholder="spediens-bdienst-zeit-erfassung.php<?php echo URL_APPEND; ?>";
	stationwin=window.open(urlholder,"bdienst",winspecs);
	}
function closewin()
{
	location.href='startframe.php<?php echo URL_APPEND; ?>';
}
// -->
</script>

<?php 
require_once($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?> >


<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDSpexFunctions ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right><?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="javascript:gethelp('submenu1.php','<?php echo $LDSpexFunctions ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colSpan=3><p><br>
<ul>


      <TABLE cellSpacing=0 cellPadding=0  bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  bgColor=#999999 
            border=0>
              <TBODY>

              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'dollarsign.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="<?php echo $root_path ?>modules/ecombill/ecombill_pass.php<?php echo URL_APPEND; ?>"><?php echo $LDBilling ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDBillingTxt ?></FONT></TD>
				 </tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>

              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'man-gr.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="<?php echo $root_path ?>modules/personell_admin/personell_admin_pass.php<?php echo URL_APPEND; ?>&retpath=spec&target=personell_reg"><?php echo $LDPersonellMngmnt ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPersonellMngmntTxt ?></FONT></TD>
				 </tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>

              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'lockfolder.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="<?php echo $root_path ?>modules/insurance_co/insurance_co_manage_pass.php<?php echo URL_APPEND; ?>"><?php echo $LDInsuranceCoMngr ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDInsuranceCoMngrTxt ?></FONT></TD>
				 </tr>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  			  			  			  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'home2.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="<?php echo $root_path ?>modules/address/address_manage_pass.php<?php echo URL_APPEND; ?>"><?php echo $LDAddressMngr ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDAddressMngrTxt ?></FONT></TD>
				 </tr>
				 
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'camera_s.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="<?php echo $root_path ?>modules/fotolab/fotolab_pass.php<?php echo URL_APPEND."&ck_config=$ck_config";?>"><?php echo $LDPhotoLab ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDPhotoLabTxt ?> </FONT></TD></TR>

<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'video.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="http://www.care2x.info/care-cam/login.php?ret_link=%2Fcare-cam%2Fswitchboard.php%3Fs_switchboard_name%3D1&type=notLogged">CARE-CAM</a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2>Sven Köchel's advance camera monitoring system</FONT></TD></TR>				  
 -->				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'video.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="../modules/video_monitor/video_monitoring.php<?php echo URL_APPEND;?>"><?php echo $LDWebCam ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDWebCamTxt ?></FONT></TD></TR>				  
				  
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>				  			  			  			  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'timeplan.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="<?php echo $root_path ?>main/spediens-ado.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=spec"><?php echo $LDDutyPlanOrg ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDutyPlanOrgTxt ?></FONT></TD>
              </td>
			  </tr> -->
			  
			  <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
			<TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'post_discussion.gif','0') ?> border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				  <a href="<?php echo $root_path ?>main/spediens-bdienst-zeit-erfassung.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=spec"><?php echo $LDStandbyDuty ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDStandbyDutyTxt ?></FONT></TD>
              </td>
			  </tr>
			  
			  <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>              
<!-- 			<TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'thum_upr.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><nobr><?php echo $LDHandStat ?></nobr></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDHandStatTxt ?></FONT></TD></TR>
              </td><TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
 -->              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'calmonth.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="<?php echo $root_path ?>modules/calendar/calendar.php<?php echo URL_APPEND; ?>"><?php echo $LDCalendar ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDCalendarTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bubble.gif','0') ?> border=0 width=15 height=14></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				  <a href="<?php echo $root_path ?>modules/news/editor-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&dept_nr=1&title=<?php echo $LDEditTitle ?>"><?php echo $LDNews ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDNewsTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
<!--               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'mail.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
			 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDMemo ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMemoTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'task_tree.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				    <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><nobr><?php echo $LDBlackBoard ?></nobr></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDBlackBoardTxt ?></FONT></TD></TR>
            <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
 --> 
  <!--               <TR bgColor=#eeeeee><td align=center><img src="../img/new_group.gif" border=0 width=20 height=20></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="../forum/index.php?lang=en"><?php echo $LDForum ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDForumTxt ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
 -->
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'calendar.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><a href="<?php echo $root_path ?>modules/tools/calculator.php<?php echo URL_APPEND; ?>"><?php echo $LDCalc ?></a>
				   </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDCalcTxt ?></FONT></TD></TR>
				 <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  <?php if(($cfg['bname']=="msie")&&($cfg['bversion']>4))
					{ 
				?>
							<TR bgColor="#eeeeee"> <TD><img <?php echo createComIcon($root_path,'uhr.gif','0') ?>></td>
                			<TD vAlign=top ><FONT 
                  			face="Verdana,Helvetica,Arial" size=2><B>
				<?php			
    					echo '		<a href="'.$root_path.'modules/tools/clock.php?sid='.$sid.'&lang='.$lang.'">'.$LDClock.'</a></td>
								<TD><FONT face="Verdana,Helvetica,Arial" size=2>'.$LDDigitalClock.'</FONT>';	
				?>
				</TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>				
				<?php
				   }
				?> 


              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="config_options.php<?php echo URL_APPEND; ?>"><?php echo $LDUserConfigOpt ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDUserConfigOptTxt ?></FONT></TD></TR>
<!-- 	              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
			  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<a href="colorchg.php?uid=<?php echo $r; ?>&sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDColorOpt ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDColorOptTxt ?></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
				  <?php if($cfg['dhtml'])
					{ echo '<TR bgColor=#eeeeee>
   								 <td align=center><img '.createComIcon($root_path,'settings_tree.gif','0').'></td>
								<TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
    							<a href="excolorchg.php?&sid='.$sid.'&lang='.$lang.'"><nobr>'.$LDColorOptExt.'</nobr></a></B></FONT></TD>
                				<TD><FONT face="Verdana,Helvetica,Arial" 
                  				size=2>'.$LDColorOptExtTxt.'</FONT></TD></TR>';
 					}
				?>
      
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'mem_tree.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="<?php echo $root_path; ?>modules/myintranet/myintranet.php<?php echo URL_APPEND; ?>"><?php echo $LDMyIntranet ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDMyIntranetTxt ?></FONT></TD></TR>
-->               
			<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'padlock.gif','0') ?>></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="<?php echo $root_path; ?>modules/myintranet/my-passw-change.php<?php echo URL_APPEND; ?>"><?php echo $LDAccessPw ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDAccessPwTxt ?></FONT></TD></TR>

<!--				<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
				  
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'templates.gif','0') ?> align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="http://www.bnf.org/bnf/index.html">BNF 45</a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2>British National Formulary</FONT></TD></TR> 

				<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'redlist.gif','0') ?> align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="pharmaindex.php<?php  echo URL_APPEND;  ?>"><?php  echo $LDPharmaIndex;  ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php  echo $LDPharmaIndexTxt;  ?></FONT></TD></TR> 

               <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'templates.gif','0') ?> align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="<?php echo $root_path.'index.php'.URL_APPEND;
				 				 if(($cfg['mask']==1)||($cfg['mask']=='')) echo '&mask=2'; else echo '&mask=1';?>" target="_top">
				<?php if(($cfg['mask']==1)||($cfg['mask']=='')) echo $LDDisplay2; else echo $LDDisplay1;?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php if(($cfg['mask']==1)||($cfg['mask']=='')) echo $LDDisplay2Txt; else echo $LDDisplay1Txt; ?></FONT></TD></TR> -->
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'top_help.gif','0') ?> align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="http://care2x.de/otrs/customer.pl">
				<?php  echo $LDTicketedSupport; ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php  echo $LDTicketedSupportTxt;  ?></FONT></TD></TR> 
				  
              <TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'discussions.gif','0') ?> align="absmiddle"></td>
                <TD vAlign=top ><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				 <a href="http://www.arzt-seite.info/newsgroup/gotodoc.medizin.care2002.dev/thread_frameset.php3?name=gotodoc.medizin.care2002.dev">
				<?php  echo $LDNewsgroup; ?></a> 
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php  echo $LDNewsgroupTxt;  ?></FONT></TD></TR> 
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="middle"></a>

<p>
</ul>

</td>
</tr>

<tr valign=top >
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colSpan=3> 
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
