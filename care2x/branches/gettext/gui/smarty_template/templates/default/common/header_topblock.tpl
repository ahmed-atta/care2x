 {{* Toolbar - Topblock  *}}

	<table cellspacing="0"  class="titlebar" border=0>
	 <tr valign=top  class="titlebar" >
	  <td bgcolor="{{$top_bgcolor}}" >
	    &nbsp;{{$sTitleImage}}&nbsp;<font color="{{$top_txtcolor}}">{{$sToolbarTitle}}</font>
	     {{if $Subtitle}}
	      - {{$Subtitle}}
	     {{/if}}
	  </td>
	  <td bgcolor="{{$top_bgcolor}}" align=right>
	  	<div  style="float:right">
			{{if $pbAux2}}
				<a href="{{$pbAux2}}" class="regular"><img {{$gifAux2}} alt=""></a>
			{{/if}}
			{{if $pbAux1}}
				<button class="btn info">
					<a href="{{$pbAux1}}"><img {{$gifAux1}} alt=""></a>
				</button>
			{{/if}}
			{{if $pbBack}}
				<a href="{{$pbBack}}" class="btn"><img {{$gifBack2}} alt="">{{$LDBack}}</a>
			{{/if}}
			{{if $pbHelp}}
				<a href="{{$pbHelp}}" class="btn primary help"><img {{$gifHilfeR}} alt="">{{$LDHelp}}</a>
			{{/if}}
			{{if $breakfile}}
				<a href="{{$breakfile}}" {{$sCloseTarget}} class="btn danger">
					<img {{$gifClose2}} alt="{{$LDCloseAlt}}">{{$LDClose}}
				</a>
			{{/if}}
		</div>
	  </td>
	 </tr>
	 </table>