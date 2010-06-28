{{* ward_occupancy.tpl 2004-06-15 Elpidio Latorilla *}}
{{* main frame containing ward list and submenu block *}}

{{$sWarningPrompt}}

<form method = "post" action = "" name ="discharge_form" onSubmit =" return confSubmit(this)">

<table cellspacing="0" cellpadding="0" width="100%">
<tbody>
	<tr valign="top">
		<td>
			{{if $bShowPatientsList}}
				{{include file="ambulatory/outpatients_list.tpl"}}
			{{/if}}	
			<p>
			{{$showDiagnosis}}
			<p>
			{{$showLabs}}
			<p>
			{{$showPrescr}}
			<p>
			{{$showRadio}}
			<p align = "right">
			{{$LDSelectOutpatients}} | {{$LDUnSelectOutpatients}}
			
			<p align="right">
			{{$sDischargeSelected}}
			<p align="left">
			{{$pbClose}}
		</td>
		<td align="right">
			{{$sSubMenuBlock}}
		</td>
	</tr>
</tbody>
</table>

</form>
