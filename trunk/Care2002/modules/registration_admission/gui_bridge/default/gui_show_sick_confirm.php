<form>
<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ff9966" width=450>
  <tr>
    <td>
		<table border=0 cellspacing=1 cellpadding=0 width=100%>
  		<tr >
    	<td bgcolor="#ff9966">
			<table border=0 cellspacing=1 width=100% cellpadding=0>
    			<tr bgcolor="#ffffcc">
      		 		<td><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;AOK</td>
      		 		<td><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;BKK</td>
      		 		<td><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;KKH</td>
      		 		<td><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;TKK</td>
      		 		<td><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;HKH</td>
      		 		<td><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;BGG</td>
    			</tr>
    			<tr bgcolor="#ffffcc">
      		 		<td colspan=6><FONT    SIZE=2  FACE="Arial">&nbsp;
			 		<?php if($encounter['insurance_nr']) echo $encounter['insurance_nr']; ?>
			 		</td>
    			</tr>
    			<tr bgcolor="#ffffcc">
      		 		<td colspan=6><FONT    SIZE=2  FACE="Arial">&nbsp;
			 		<?php echo $encounter['insurers_name']; ?>
			 		</td>
    			</tr>
    			<tr bgcolor="#ffffcc">
      				<td colspan=6><FONT    SIZE=2  FACE="Arial">&nbsp;<br>&nbsp;
					<?php echo $title; ?><br>&nbsp;
					<?php echo $name_last; ?>, <?php echo $name_first; ?><br>&nbsp;
					<?php  echo formatDate2Local($date_birth,$date_format) ?>
					<p>
					</td>
    			</tr>
  			</table>
  		
		</td>
    	<td bgcolor="#ffffcc" valign="top"><FONT    SIZE=3  FACE="Arial" color="#ff9966">
		<center>
		<?php echo $LDSickReport; ?></font><br><FONT    SIZE=2  FACE="Arial">
		<img src="../../gui/img/common/default/care_logo.gif" border=0 width=115 height=61 align="right">
		Care Hospital<br>
		Virtualstr. 89-3 A<br>
		D-7833 Cyberia
		</font>
		</font>
		</center>
		<p>
		<FONT    SIZE=1  FACE="Arial" color="#ff9966">
		A copy of this confirmation of inability to work with the diagnoses and the estimated number of days of inability will be transmitted immediately to the 
		insurer given on the left.
		</font>
		</td>
  		</tr>
		
  		<tr bgcolor="#ffffcc">
	    <td colspan=1><FONT    SIZE=2  FACE="Arial" color="#ff9966">&nbsp;

		<?php echo $LDSickUntil; ?>:<br>&nbsp;
		<br>&nbsp;
  		<?php echo $LDStartingFrom; ?>:
		<br>&nbsp;
		<br>&nbsp;
		<?php echo $LDConfirmedOn; ?>:
		<br>&nbsp;
  		<br>&nbsp;
		</td>
    	<td bgcolor="#ffffcc" valign="bottom" align="right"><FONT    SIZE=2  FACE="Arial">
		<?php echo nl2br($dept_sigstamp); ?>
		</td>
		</tr>
		
    	<tr bgcolor="#ffffcc">
      	<td colspan=2 valign="top"><FONT    SIZE=1  FACE="Arial" color="#ff9966">&nbsp;
		<?php echo $LDInsurersCopy; ?>
		</font>
		<br>&nbsp;
		<FONT    SIZE=2  FACE="Arial" color="#ff9966"><?php echo $LDDiagnosis2; ?>:<br>&nbsp;
		<textarea name="sick_reason" cols=40 rows=5 wrap="physical"></textarea>
  
		&nbsp;
		</td>
    	</tr>
		</table>	
	</td>
  </tr>
</table>
</form>
<p>

<form method="post" name="newform"><img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>> Create a form for <select name="deptnr">
	<option value=""></option>
	<?php
		while(list($x,$v)=each($dept_med)){
			echo '<option value="'.$v['nr'].'">'.$v['name_formal'].'</option>
			';
		}
	?></select>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<input type="hidden" name="mode" value="new">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<!-- <input type="submit" <?php echo createLDImgSrc($root_path,'ok.gif','0','absmiddle'); ?> >            
 -->
<input type="submit"  value="go"> 
</form>
