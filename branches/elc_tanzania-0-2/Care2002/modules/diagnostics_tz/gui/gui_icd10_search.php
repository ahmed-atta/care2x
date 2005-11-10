<html>
<head>
<title>Unbenanntes Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript" src="../../js/check_diagnostics_form.js"></script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066">ICD10 description
(<?php echo $HTTP_SESSION_VARS['sess_en']; ?>)</font></td>
	  	<td align="right" width="213"><a href="<?php echo $_SESSION['backpath_diag'];?>"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a><?php if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='../../main/startframe.php?ntid=false&lang=$lang';
	  	?><a href="<?php echo $closelink; ?>"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
	  	</td>
	  </tr>
  </table>
    </td>
 </tr>
  <tr>
    <td><form name="icd10" method="post" action="" onSubmit="javascript:submit_form(this,'icd10_search.php','<?php echo $sid ?>','search'); return false;">
	<table width="100%" border="0">
	  <tr>
		<td width="25%" class="adm_input"><div align="center"><input type="button" name="show" value="Quicklist" onClick="javascript:submit_form(this,'icd10_quicklist.php','<?php echo $sid ?>','')">
		</div></td>
		<td width="17%" bgcolor="#CAD3EC"><div align="center"><input type="button" name="show" value="Search" onClick="javascript:submit_form(this,'icd10_search.php','<?php echo $sid ?>','')">
		</div></td>
		<td width="20%" class="adm_input"><div align="center"><input type="button" name="show" value="History" onClick="javascript:submit_form(this,'icd10_history.php','<?php echo $sid ?>','')">
		</div></td>
		<td width="38%" class="adm_input"><div align="center"><input type="button" name="show" value="Manage Quicklist" onClick="javascript:submit_form(this,'icd10_manage.php','<?php echo $sid ?>','')">
		</div></td>
	  </tr>
	</table>
<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          <tr>
            <td width="100%" align="center">
                  <table border="0" cellpadding="0" cellspacing="0">
                  	<tr>
                  		<td colspan="2">
                  			Search for:<br>
                  			<input type="text" size="24" name="keyword" value="<?php echo $keyword; ?>">
                  			<input type="button" value="search"  onClick="javascript:submit_form(this,'icd10_search.php','<?php echo $sid ?>','search');">
                  		</td>
                  	</tr>
                  	<tr>
                  		<td>
                  			<input type="radio" value="exact" name="search_mode"<?php if(!$search_mode || $search_mode=="exact") echo "checked"; ?>> exact search
                  		</td><td align="right">
                  			<input type="radio" value="fuzzy" name="search_mode"<?php if($search_mode=="fuzzy") echo "checked"; ?>> fuzzy search
                  		</td>
                  	</tr>
                  </table>
                  <br>
              <select name="itemlist[]" size="10" style="width:435px;" onDblClick="javascript:item_add();">
  
                  <!-- dynamically managed content -->
				<?php $diagnostic_obj->Display_Search_Results($keyword,$search_mode); ?>
				                  <!-- dynamically managed content -->
  
              </select>
            </td>
          </tr>
          <tr>
            <td align="center">
            	<table border="0" cellpadding="0" cellspacing="0" align="center" width="435">
            		<tr>
            			<td width="33%"><a href="#" onClick="javascript:item_add();"><img  src="../../gui/img/control/default/en/en_add_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
									<td width="34%" align="center"><a href="#" onClick="javascript:submit_form(this,'icd10_diagnose.php','<?php echo $sid ?>','done')"><img  src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                	<td width="33%" align="right"><a href="#" onClick="javascript:item_delete();"><img  src="../../gui/img/control/default/en/en_delete_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                </tr>
               </table>
			       </td>
          </tr>
          <tr>
            <td>
<div align="center">
                <select name="selected_item_list[]" size="10" style="width:435px;" onDblClick="javascript:item_delete();">
                  <!-- dynamically managed content -->
                  <?php $diagnostic_obj->Display_Selected_Elements($item_no); ?>
                  <!-- dynamically managed content -->
  
                </select><br>                
             </div>
             </td>
          </tr>

        </table>              
	 	</form>
	</td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
document.icd10.keyword.focus();
</script>