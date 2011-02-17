{{* Frame template for prescription module *}}
{{* Used by module template *}}
{{* Robert Meggle 2011 *}}


<div class="modul">
	
	{{* Include standard headline for prescription module *}}
	{{include file='pharmacy/module_prescription_headline.tpl'}}
	
     <form id="form_prescribe_elements" method="post">
     <script language="javascript">

        $(document).ready(function() {

			// if someone make a double click on an element in the list box
			{{foreach from=$tabs item=tabname}}
            $("#ListBox_{{$tabname}}").dblclick(function() {
                	$("#ListBox_{{$tabname}} > option:selected").appendTo("#ListBoxPrescriptionArrangements");
            });	
            {{/foreach}}
        	
        	// If someone use the buttin "add" 
            $("#btnAdd").click(function() {
            	{{foreach from=$tabs item=tabname}}
                	$("#ListBox_{{$tabname}} > option:selected").appendTo("#ListBoxPrescriptionArrangements");
                {{/foreach}}
            });

            $("#btnRemove").click(function() {
                //Todo: When an article has to be removed, it must be found out in what list box it belongs...
                $("#ListBox2 > option:selected").appendTo("#ListBox1");
            });

        });             

        <!-- This JavaScript snippet activates those tabs -->
        
        $(function() {
        	// setup ul.tabs to work as tabs for each div directly under div.panes
        	$("ul.tabs").tabs("div.panes > div");
        });
        
    </script>
	    <div>
			<!-- the tabs -->
			<ul class="tabs">
			{{foreach from=$tabs item=tabname}}
				<li><a href="#">{{$tabname}}</a></li>
			{{/foreach}}
			</ul>
			
			<div class="panes">
				{{foreach from=$tabs item=tabname}}
				<div>
					<select name="ListBox_{{$tabname}}" id="ListBox_{{$tabname}}" size="20" style="width:100%;" multiple="multiple">
					{{*
					{{foreach from=$items key=k item=v}}
						<option value="{{$k}}">{{$v}}</option>
					{{/foreach}}
					*}}
					{{foreach from=$items key=k item=v}}
						{{if $k eq $tabname}}
							{{foreach from=$v key=k_sub item=v_sub}}
								<option value="{{$k_sub}}">{{$v_sub}}</option>
							{{/foreach}}
						{{/if}}
					{{/foreach}}
					</select>
				</div>
				{{/foreach}}
			</div>
			</div>
			<!--  end of Tabs -->
			<div>
		        <input id="btnAdd" type="button" value="Add" />
		        <input id="btnRemove" type="button" value="Remove" />
		        <input type="hidden" name="model" value="create" />
		        <input type="hidden" name="task" value="parameterisation" />
		        <input type="submit" value=" Prescribe It ">

			</div>
					<div>
						<select name="ListBoxPrescriptionArrangements[]" id="ListBoxPrescriptionArrangements" size="20" style="width:100%;" multiple="multiple"/>
					</div>
	    	</div>
    </form>
 </div>