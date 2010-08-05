{literal}
<script language="javascript">
<!-- 
function check(d) {
	if((d.name.value=="")){
		alert("<?php echo "$LDAlertNoCityTownName \\n $LDPlsEnterInfo"; ?>");
		d.name.focus();
		return false;
	}else if(d.iso_country_id.value==""){
		alert("<?php echo $LDEnterISOCountryCode.'\n'.$LDEnterQMark; ?>");
		d.iso_country_id.focus();
		return false;
	}else if(isNaN(d.unece_locode_type.value)){
		alert("<?php echo $LDWrongUneceLocCode.'\n'.$LDEnterZero; ?>");
		d.unece_locode_type.focus();
		return false;
	}else{
		return true;
	}
}
// -->
</script>
{/literal}

{{if $ErrorMessage ne ''}}
<table border=0>
	<tr>
		<td valign="bottom">
			<font class="warnprompt"><strong>{{$ErrorMessage}}</strong></font>
		</td>
	</tr>
</table>
{{/if}}


<form action="{{$formAction}}" method="post" name="citytown" onSubmit="return check(this)">
	<!--  form message -->
	<font face="Verdana, Arial" size=-1>{{$message}}</font>
	<div class="buttons">	
	<table border=0>
	
	{{foreach from=$inputFields key=id item=i}}
		<tr>
			<td align=right class="adm_item">
				{{$i.fieldDescription}}
				{{if $i.notEmpty == TRUE}}<font color=#ff0000><b>*</b></font>{{/if}}
			</td>
			<td class="adm_input">
				<input type="text" name="{{$i.fieldName}}" size=50 maxlength=60 value="{{$i.fieldValue}}">
			</td>
		</tr>
	{{/foreach}}
	
		<tr>
			<td>
				<button type="submit" class="positive">
					<img {{$imageSave}} border="0">{{$Save}}
				</button>
			</td>
			<td>
				<a href="{{$breakfile}}" class="negative">
					<img {{$imageCancel}} border="0">{{$Cancel}}
				</a>
			</td>
		</tr>
	</table>
	</div>
		
	<!--  hidden fields -->	
	<input type="hidden" name="sid" value="{{$sid}}"> 
	<input type="hidden" name="mode" value="save"> 
	<input type="hidden" name="lang" value="{{$lang}}"> 
	<input type="hidden" name="retpath" value="{{$retpath}}">

</form>