<?php
/*
 * $Header$
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 */

require ('conf.php');

session_start();
$old_theme = $theme;
$ini_tmpdir = ini_get($upload_tmp_dir);
$tmpdir = (!empty($ini_tmpdir)) ? $ini_tmpdir : $tmpdir;
if (is_array($attach_array))
	while ($tmp = array_shift($attach_array))
		@unlink($tmpdir.'/'.$tmp->tmp_file);
session_destroy();
Header("Location: index.php?lang=$lang&theme=$old_theme");
?>