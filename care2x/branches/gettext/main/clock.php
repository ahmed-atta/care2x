<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('../include/helpers/inc_environment_global.php');
/**
 * CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
 * GNU General Public License
 * Copyright 2002 Elpidio Latorilla
 * elpidio@latorilla.com
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define ( 'LANG_FILE', 'specials.php' );
define ( 'NO_2LEVEL_CHK', 1 );
require_once (CARE_BASE  . 'include/helpers/inc_front_chain_lang.php');
$breakfile = "plugin.php?sid=" . $sid . "&lang=" . $lang;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<script language="JavaScript" src="../js/clock.js">
</script>

<?php
require (CARE_BASE  . 'include/helpers/include_header_css_js.php');
?><script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php
	echo $lang?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>


</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onLoad=show5()>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
	<tr valign=top>
		<td  height="10">
			<FONT  SIZE=+3 FACE="Arial">
				<STRONG> &nbsp;<?php echo $LDClock?></STRONG>
			</FONT>
		</td>
		<td  height="10" align=right>
			<div class="actions">
				<?php echo '<a href="javascript:window.history.back()" class="button icon arrowleft">Back</a>'; ?>
				<a href="javascript:gethelp('')">
					<img <?php echo createLDImgSrc ( CARE_BASE , 'hilfe-r.gif', '0' )?> 
				</a>
				<a href="<?php echo $breakfile; ?>" />
					<img <?php echo createLDImgSrc ( CARE_BASE , 'close2.gif', '0' )?> alt="<?php echo $LDClose?>"/>
				</a>
			</div>
		</td>
	</tr>
	<tr>
		<td  valign=top colspan=2>
			<CENTER>
				<font face="verdana,arial" size=3>  
					<?php echo "$LDPresent $LDTime"?> 
				</FONT> 
				<span id="liveclock" style="position: relative; left: 0; top: 0; font-size: 146"> </span>
			</CENTER>
		</td>
	</tr>
	<tr>
		<td  height=70 colspan=2>
		</td>
	</tr>
</table>
&nbsp;
</BODY>
</HTML>