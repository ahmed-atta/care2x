
<script language="javascript">
<!-- 
function check(d) {
	if((d.name.value=="")){
		alert('{{$LDAlertNoCityTownName}} \n {{$LDPlsEnterInfo}}');
		d.name.focus();
		return false;
	}else if(d.iso_country_id.value==""){
		alert('{{$LDEnterISOCountryCode}} \n {{$LDEnterQMark}}');
		d.iso_country_id.focus();
		return false;
	}else if(isNaN(d.unece_locode_type.value)){
		alert('{{$LDWrongUneceLocCode}} \n {{$LDEnterZero}}');
		d.unece_locode_type.focus();
		return false;
	}else{
		return true;
	}
}
// -->
</script>

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
	<div class="actions">	
		<table border=0>
		
		{{foreach from=$inputFields key=id item=i}}
			<tr>
				<td align=right class="adm_item">
					{{$i.fieldDescription}}
					{{if $i.notEmpty == TRUE}}<font color=#ff0000><b>*</b></font>{{/if}}
				</td>
				<td class="adm_input">
					<input type="text" name="{{$i.fieldName}}" size="50" maxlength="60" value="{{$i.fieldValue}}">
				</td>
			</tr>
		{{/foreach}}
		
			<tr>
				<td>
					<button type="submit" class="btn primary">
						<img {{$imageSave}} border="0">{{$Save}}
					</button>
				</td>
				<td>
					<a href="{{$breakfile}}" class="btn">
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
	<input type="hidden" name="mode" value="{{$mode}}">
	<input type="hidden" name="nr" value="{{$nr}}">

</form>