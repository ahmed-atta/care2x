<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($PHP_SELF, 'inc_passcheck_mask.php')) die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$bShowThisPage = FALSE;

#
# Create a smarty object if it is not yet available, without initializing the gui
#
if(!isset($smarty) || !is_object($smarty)){
	$bShowThisPage = TRUE;
	require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
	$smarty = new smarty_care('common',FALSE);
}

#
# If authentication error, show prompt
#
if (isset($pass)&&($pass=='check')&&($passtag)){

	switch($passtag){
		case 1:$errbuf="$errbuf $LDWrongEntry";
		$err_msg="<div class=\"warnprompt\">$LDWrongEntry</div><br>$LDPlsTryAgain";
		break;
		case 2:$errbuf="$errbuf $LDNoAuth";
		$err_msg="<div class=\"warnprompt\">$LDNoAuth</div><br>$LDPlsContactEDP";
		break;
		default:$errbuf="$errbuf $LDAuthLocked";
		$err_msg="<div class=\"warnprompt\">$LDAuthLocked</div><br>$LDPlsContactEDP";
	}
	#
	# Log auth attempt
	#
	$logs->writeline(date('Y-m-d').'/'.date('H:i'),$REMOTE_ADDR,$errbuf,$userid,'',$keyword,$thisfile,$fileforward,'0');

	$smarty->assign('bShowErrorPrompt',TRUE);

	$smarty->assign('sErrorMsg',$err_msg);
}

#
# Prepare the auth entry form elements
#
$smarty->assign('sPassFormParams','action="'.$thisfile.'" method="post" name="passwindow" onSubmit="return pruf(this);"');
$smarty->assign('LDPwNeeded',$LDPwNeeded);
$smarty->assign('LDUserPrompt',$LDUserPrompt);
$smarty->assign('LDPwPrompt',$LDPwPrompt);

#
# Prepare the hidden inputs
#
$sHiddenTemp = '<input type=hidden name=direction value="'.$direction.'">
<input type=hidden name="pass" value="check">
<input type="hidden" name="nointern" value="1">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="mode" value="'.$mode.'">
<input type="hidden" name="target" value="'.$target.'">
<input type="hidden" name="subtarget" value="'.$subtarget.'">
<input type="hidden" name="user_origin" value="'.$user_origin.'">
<input type="hidden" name="title" value="'.$title.'">
<input type="hidden" name="fwd_nr" value="'.$fwd_nr.'">';

if($not_trans_id) {
	$sHiddenTemp = $sHiddenTemp.'<input type="hidden" name="sid" value="'.$sid.'">';
}

if(!isset($minimal) || !$minimal) {

	$sHiddenTemp = $sHiddenTemp.'
	<input type="hidden" name="dept" value="'.$dept.'">
	<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
	<input type="hidden" name="retpath" value="'.$retpath.'">
	<input type="hidden" name="edit" value="'.$edit.'">
	<input type="hidden" name="pmonth" value="'.$pmonth.'">
	<input type="hidden" name="pyear" value="'.$pyear.'">
	<input type="hidden" name="pday" value="'.$pday.'">
	<input type="hidden" name="station" value="'.$station.'">
	<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
	<input type="hidden" name="ipath" value="'.$ipath.'">';
}

if(isset($c_flag)&&$c_flag) {
	$sHiddenTemp = $sHiddenTemp.'
	<input type="hidden" name="cmonth" value="'.$cmonth.'">
	<input type="hidden" name="cyear" value="'.$cyear.'">
	<input type="hidden" name="cday" value="'.$cday.'">';
}

$smarty->assign('sPassHiddenInputs',$sHiddenTemp);

$smarty->assign('sPassSubmitButton','<button type="submit" class="btn primary"><img '.createComIcon(CARE_GUI  ,'accept.png','0').'>'.$LDLogin.'</button>');
$smarty->assign('sCancelButton','<a href="'.$breakfile.'" class="btn"><img '.createComIcon(CARE_GUI  ,'cross.png','0').'>'.$LDCancel.'</a>');

#
# Display this page if necessary
#
if($bShowThisPage) $smarty->display(CARE_BASE . 'main/view/passcheck_entry_mask.tpl');