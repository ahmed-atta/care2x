{{if $ErrorMessage ne ''}}
<table border=0>
	<tr>
		<td valign="bottom"><font class="warnprompt"><strong>{{$ErrorMessage}}</strong></font>
		</td>
	</tr>
</table>
{{/if}}

<div class="actions">	
	<table border=0 cellpadding=4>
		{{foreach from=$inputFields key=id item=i}}
			<tr>
				<td align=right class="adm_item">{{$i.fieldDescription}}</td>
				<td class="adm_input">{{$i.fieldValue}}</td>
			</tr>
		{{/foreach}}

		<tr>
			<td>
				<a href="{{$updateLink}}">
					<img {{$imageUpdate}} border="0">{{$Update}}
				</a>
			</td>
			<td align=right>
				<a href="{{$listLink}}">
					<img {{$imageListAll}} border="0">{{$ListAll}}
				</a> 
				<a href="{{$breakfile}}" class="btn">
					<img {{$imageCancel}} border="0">{{$Cancel}}
				</a>
			</td>
		</tr>
	</table>
	
	<form action="{{$formAction}}" method="post">	
			<input type="hidden" name="sid" value="{{$sid}}"> 
			<input type="hidden" name="lang" value="{{$lang}}"> 
			<input type="hidden" name="retpath" value="{{$retpath}}">
			<input type="submit" value="{{$NeedEmptyFormPls}}">
	
	</form>
</div>	