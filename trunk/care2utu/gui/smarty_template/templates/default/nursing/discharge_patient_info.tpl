{{* discharge_patient_form.tpl : Discharge form 2004-06-12 Elpidio Latorilla *}}
{{* Note: never rename the input when redimensioning or repositioning it *}}

<ul>

<div class="prompt">{{$sPrompt}}</div>

<form action="{{$thisfile}}" name="discform" method="post" onSubmit="return pruf(this)">

	<table border=0 cellspacing="1">
		<tr>
			<td colspan=2 class="adm_input">
				{{$sBarcodeLabel}} {{$img_source}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDLocation}}:</td>
			<td class="adm_input">{{$sLocation}}</td>
		</tr>
			<td class="adm_item">{{$LDDate}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$x_date}}
				{{else}}
					{{$sDateInput}} {{$sDateMiniCalendar}}
				{{/if}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDClockTime}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$x_time}}
				{{else}}
					{{$sTimeInput}}
				{{/if}}
			</td>
		</tr>


		<tr>
			<td class="adm_item">{{$LDNurse}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$encoder}}
				{{else}}
					<input type="text" name="encoder" size=25 maxlength=30 value="{{$encoder}}">
				{{/if}}
			</td>
		</tr>

		<table cellpadding=6>
		{{$tab_care_encounter_prescription}}
		{{$tab_diagnosis}}
		{{$tab_fingings_chemlab}}
		{{$tab_laboratory_param}}

		</table>
		<table>
			{{$tab_care_encounter_location}}
		</table>

	</table>

	{{$sHiddenInputs}}

</form>

{{$pbCancel}}

</ul>
