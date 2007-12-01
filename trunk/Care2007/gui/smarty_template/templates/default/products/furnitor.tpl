{{* form.tpl  Form template for products module (pharmacy & meddepot) 2004-07-04 Elpidio Latorilla *}}

<font class="prompt">{{$sSaveFeedBack}}</font>
<font class="warnprompt">{{$sMascotImg}} {{$LDOrderNrExists}} <br> {{$sNoSave}}</font>

{{$sFormStart}}

	{{* NOTE:::  The following table  block must be inside the $sFormStart and $sFormEnd tags !!! *}}

	<table border=0 cellspacing=1 cellpadding=3>
	<tbody class="submenu">
		<tr>
		<td align=right width=140 class="prompt">{{$LDFurnitori}}</td>
		<td>{{$sFurnitori}}</td>
		<tr>
		<td align=right width=140>{{$LDAdresa}}</td>
		<td>{{$sAdresa}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDTelefoni}}</td>
		<td>{{$sTelefoni}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDFax}}</td>
		<td>{{$sFax}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDKodiPostar}}</td>
		<td>{{$sKodiPostar}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDPerfaqesues}}</td>
		<td>{{$sPerfaqesues}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDReset}}</td>
		<td align=right>{{$LDSave}} {{$sUpdateButton}}</td>
		</tr>
	</tbody>
	</table>

	{{* Do not move $sHiddenInputs outside the form block*}}
	{{$sHiddenInputs}}
	
	{{$sNewFurnitor}}

{{$sFormEnd}}

{{$sBreakButton}}
