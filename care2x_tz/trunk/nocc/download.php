<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/download.php,v 1.2 2009/01/31 20:07:05 andi Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * File for downloading the attachments
 */
//TODO: Do we really need that MSIE-Check? Guess it is not working anymore with IE > 8
/*
if (eregi('MSIE', $_SERVER['HTTP_USER_AGENT']) || eregi('Internet Explorer', $_SERVER['HTTP_USER_AGENT']))
	session_cache_limiter('public');
*/
session_start();
require ('conf.php');

header('Content-Type: application/x-unknown-' . $mime);


$pop = imap_open('{'.$servr.'}'.$folder, $user, stripslashes($passwd));
$file = imap_fetchbody($pop, $mail, $part);
imap_close($pop);
if ($transfer == 'BASE64')
	$file = imap_base64($file);
elseif($transfer == 'QUOTED-PRINTABLE')
	$file = imap_qprint($file);

header('Content-Length: ' . strlen($file));
echo ($file);
?>