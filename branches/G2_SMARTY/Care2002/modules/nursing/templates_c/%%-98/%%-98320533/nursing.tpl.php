<?php /* Smarty version 2.6.0, created on 2003-12-24 17:34:04
         compiled from nursing.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'nursing.tpl', 5, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "test.conf",'section' => 'setup'), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('title' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php echo $this->_tpl_vars['sHTMLtag']; ?>


<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 >


<table width=100% border=0 cellspacing=0 height=100%>

 <tr valign=top height=10>
  <td bgcolor="<?php echo $this->_tpl_vars['top_bgcolor']; ?>
" height="10">
   <FONT  COLOR="<?php echo $this->_tpl_vars['top_txtcolor']; ?>
"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $this->_tpl_vars['LDNursing']; ?>
</STRONG>
   </FONT>
  </td>
  <td bgcolor="<?php echo $this->_tpl_vars['top_bgcolor']; ?>
" height="10" align=right>
   <a href="javascript:window.history.back()">
   <img <?php echo $this->_tpl_vars['gifBack2']; ?>
 <?php echo $this->_tpl_vars['dhtml']; ?>
 ></a>
   <a href="javascript:gethelp('nursing.php','<?php echo $this->_tpl_vars['LDNursing']; ?>
')"> 
   <img <?php echo $this->_tpl_vars['gifHilfeR']; ?>
 alt="" <?php echo $this->_tpl_vars['dhtml']; ?>
></a>
   <a href="<?php echo $this->_tpl_vars['breakfile']; ?>
"><img <?php echo $this->_tpl_vars['gifClose2']; ?>
 alt="<?php echo $this->_tpl_vars['LDCloseAlt']; ?>
" <?php echo $this->_tpl_vars['dhtml']; ?>
></a>
  </td>
 </tr>
 <tr>
 <td bgcolor=<?php echo $this->_tpl_vars['body_bgcolor']; ?>
 valign=top colspan=2><p><br>
 <ul><!-- <img src="../img/nurse.jpg" align="right"> -->
 <FONT SIZE=-1  FACE="Arial">
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
  <TBODY>
  <TR>
   <TD>
   <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 border=0>
   <TBODY>
    <TR bgColor="#eeeeee">
     <td align=center>
      <img <?php echo $this->_tpl_vars['gifTeamWksp']; ?>
 >
     </td>
     <TD vAlign=top width="150">
      <FONT face="Verdana,Helvetica,Arial" size="2" color="<?php echo $this->_tpl_vars['body_txtcolor']; ?>
">
       <B><nobr><?php echo $this->_tpl_vars['LDNursingStations']; ?>
&nbsp;<img <?php echo $this->_tpl_vars['gifDwnArrowGrn']; ?>
 alt=""></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2><?php echo $this->_tpl_vars['LDNursingStationsTxt']; ?>

      </FONT>
     </TD>
    </TR>
    <TR bgColor="#dddddd" >
     <TD colSpan=3>
      <?php echo $this->_tpl_vars['tblWardInfo']; ?>

			  </TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img <?php echo $this->_tpl_vars['gifEye_s']; ?>
 alt="<?php echo $this->_tpl_vars['LDQuickView']; ?>
" width=16 height=16 >
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><nobr><a href="<?php echo $this->_tpl_vars['LINKQuickView']; ?>
"><?php echo $this->_tpl_vars['LDQuickView']; ?>
</a></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <?php echo $this->_tpl_vars['LDQuickViewTxt']; ?>

      </FONT>
     </TD>
    </tr>
    <TR bgColor=#dddddd height=1 >
     <TD colSpan=3 height=1><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img <?php echo $this->_tpl_vars['gifFindnew']; ?>
 alt="<?php echo $this->_tpl_vars['LDSearchPatient']; ?>
" >
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><nobr><a href="<?php echo $this->_tpl_vars['LINKSearch']; ?>
"><?php echo $this->_tpl_vars['LDSearchPatient']; ?>
</a></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <?php echo $this->_tpl_vars['LDSearchPatientTxt']; ?>

      </FONT>
     </TD>
    </tr>
    <TR bgColor=#dddddd height=1>
      <TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center><img <?php echo $this->_tpl_vars['gifStorage']; ?>
 alt="<?php echo $this->_tpl_vars['LDArchive']; ?>
">
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><nobr><a href="<?php echo $this->_tpl_vars['LINKArchiv']; ?>
"><?php echo $this->_tpl_vars['LDArchive']; ?>
</a></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <?php echo $this->_tpl_vars['LDArchiveTxt']; ?>

      </FONT>
     </TD>
    </tr>
    <TR bgColor=#dddddd height=1>
     <TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img <?php echo $this->_tpl_vars['gifTimeplan']; ?>
 alt="<?php echo $this->_tpl_vars['LDStationMan']; ?>
">
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="<?php echo $this->_tpl_vars['LINKStationMan']; ?>
"><nobr><?php echo $this->_tpl_vars['LDStationMan']; ?>
</nobr></a></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <nobr><?php echo $this->_tpl_vars['LDStationManTxt']; ?>
</nobr>
      </FONT>
     </TD>
    </TR>              
    <TR bgColor=#dddddd height=1>
     <TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5 ></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center><img <?php echo $this->_tpl_vars['gifForums']; ?>
 alt="<?php echo $this->_tpl_vars['LDNursesList']; ?>
" width=15 height=14>
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><a href="<?php echo $this->_tpl_vars['LINKNursesList']; ?>
"><?php echo $this->_tpl_vars['LDNursesList']; ?>
</a></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <?php echo $this->_tpl_vars['LDNursesListTxt']; ?>

      </FONT>
     </TD>
    </TR>
    <TR bgColor=#dddddd height=1>
	<TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img <?php echo $this->_tpl_vars['gifBubble']; ?>
 alt="<?php echo $this->_tpl_vars['LDNews']; ?>
" width=15 height=14>
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B>
        <a href="<?php echo $this->_tpl_vars['LINKNews']; ?>
"><?php echo $this->_tpl_vars['LDNews']; ?>
</a>
       </B>
      </FONT>
     </TD>
     <TD><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $this->_tpl_vars['LDNewsTxt']; ?>
</FONT>
     </TD>
    </TR>
		 </TBODY>
	 </TABLE>
		</TD>
  </TR>
	</TBODY>
	</TABLE>
<p>
<a href="<?php echo $this->_tpl_vars['breakfile']; ?>
"><img <?php echo $this->_tpl_vars['pbClose2']; ?>
 alt="<?php echo $this->_tpl_vars['LDCloseBack2Main']; ?>
" align="middle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor=<?php echo $this->_tpl_vars['bot_bgcolor']; ?>
 height=70 colspan=2>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>