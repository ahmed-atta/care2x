<?php

require('./gui_bridge/default/gui_std_tags.php');

echo StdHeader();
 
?>
 <TITLE><?php echo $LDPatientRegister ?></TITLE>

<?php
 
require($root_path.'include/helpers/include_header_css_js.php');
?>
</HEAD>

<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
>

<table width=100% border=0 cellspacing="0"  cellpadding=0 >
<tr>
<td >
<FONT    SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG> <font size=+2>(<?php echo ($pid) ?>)</font></FONT>
</td>

<td  align="right">
<a href="javascript:gethelp('person_details.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  </a><a 
href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   </a>
</td>
</tr>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">
<ul>

<?php

	require_once($root_path.'modules/registration_admission/model/class_gui_person_show.php');
	$person = & new GuiPersonShow;
	$person->setPID($pid);
	$person->display();

?>
</ul>

</FONT>
<p>
</td>
</tr>
</table>

<p>
<ul>

<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"></a>
</ul>
</FONT>
<?php
StdFooter();
?>