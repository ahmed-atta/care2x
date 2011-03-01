{{* Frame template for prescription module *}}
{{* Used by module template *}}
{{* Robert Meggle 2011 *}}

{{* Create the JQuery elements to calculate each section's total amount *}}
<script>
		$(document).ready(function() { 
			
			{{foreach from=$ItemDetails key=k item=Item}}
				$("#ComboBoxPresAmount{{$Item.item_id}}").change(function() { 
					$("#Input_Amount{{$Item.item_id}}").val($("#ComboBoxPresAmount{{$Item.item_id}}").val() * $("#ComboBoxPresDays{{$Item.item_id}}").val()); 
				});
				$("#ComboBoxPresDays{{$Item.item_id}}").change(function() { 
					$("#Input_Amount{{$Item.item_id}}").val($("#ComboBoxPresAmount{{$Item.item_id}}").val() * $("#ComboBoxPresDays{{$Item.item_id}}").val()); 
				});
			{{/foreach}}
		});
</script>

	{{*Include standard headline for prescription module*}}
	{{include file='pharmacy/module_prescription_headline.tpl'}}
	
	{{foreach from=$ItemDetails key=k item=Item}}
	
	<form method="POST" name="pres_{{$Item.item_id}}">
		<table border="1">
			<tr>
				<td colspan="2">{{$Item.item_description}}</td>
			</tr>
			
			{{if $Item.sub_class eq "Tablets" OR $Item.sub_class eq "Syrups" OR $Item.sub_class eq "Suspensions"}}
					{{********************
						When we have Tabs, Syrups and Suspentions, then we have 
						* Times per day -> Select box from 1...n
						* Days -> Select Box from 1...m
						* Total dose.. will be calculagted
					********************}}
					<tr>
						<td>{{$PresAmount}}:</td>
						<td>
							 
						</td>
					</tr>
					<tr>
						<td>{{$PresFrequency}}:</td>
						<td>
							<select id="ComboBoxPresAmount{{$Item.item_id}}" >
							     {{for $i=1 to $tpd}}
								     <option value="{{$i}}">{{$i}} per Day(s)</option>
								 {{/for}}
							  </select>
						</td>
					</tr>
					<tr>
						<td>{{$PresFrequency1}}:</td>
						<td>							
							<select id="ComboBoxPresDays{{$Item.item_id}}" >
							     {{for $i=1 to $d}}
								     <option value="{{$i}}">{{$i}} Days</option>
								 {{/for}}
							</select>
							</td>
					</tr>
					<tr>
						<td>{{$PresFrequency2}}:</td>
						<td><input id="Input_Amount{{$Item.item_id}}" name="Pres_Amount{{$Item.item_id}}" type="input" disabled="disabled" size="2" maxlength="2" value="2"></td>
					</tr>
			{{elseif $Item.sub_class eq "Injections"}}
					{{*******************
						When we have Injections, we ask for "ml"
					********************}}
					<tr>
						<td>{{$PresAmount}}:</td>
						<td><input name="Pres_Amount{{$Item.item_id}}" type="text" size="2" maxlength="2"></td>
					</tr>
			{{else}}
					{{********************
						In all other cases we ask for the total amount to prescribe and show an input field
					********************}}
					<tr>
						<td>{{$PresAmount}}:</td>
						<td>kommt no</td>
					</tr>
			{{/if}}
			

			

			<tr>
				<td>{{$Notes}}:</td>
				<td><input type="text" size="50" maxlength="50"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="task" value="parameterisation"/>
					<input type="hidden" name="item_id" value="{{$Item.item_id}}"/>
					<div align="right"><input type="image" {{$pres_send_img}} alt="Absenden"/></div>
				</td>
			</tr>
			
		</table>
	</form>
	{{/foreach}}