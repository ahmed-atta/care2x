{{* Frame template for prescription module *}}
{{* Used by module template *}}
{{* Robert Meggle 2011 *}}


	{{* Include standard headline for prescription module *}}
	{{include file='pharmacy/module_prescription_headline.tpl'}}
		
	<div>
		{{foreach from=$ItemDetails key=k item=Item}}
		<form method="post" name="pres_{{$Item.item_id}}">
			<div class="pres_element">
				<div class="pres_headline">{{$Item.item_description}}</div>
				<div class="pres_element_rows">
		        	<div class="pres_element_desc">{{$PresAmount}}:</div><div class="pres_element_val">{{$SingleDoseValue}}</div>
					<div class="pres_element_desc">{{$PresFrequency}}:</div>
							<div class="pres_element_val">
								12
							</div>
					<div class="pres_element_desc">{{$PresFrequency1}}:</div>
							<div class="pres_element_val">
								12
							</div>
					<div class="pres_element_desc">{{$PresFrequency2}}:</div>
							<div class="pres_element_val">
								12
							</div>
				<div class="pres_notes">{{$Notes}}: </div>
					<div class="pres_element_send">
					  <input type="hidden" name="task" value="parameterisation"/>
					  <input type="image" {{$pres_send_img}} alt="Absenden"/>
					</div>
				</div>	
			</div>
		</form>
		{{/foreach}}
	</div>