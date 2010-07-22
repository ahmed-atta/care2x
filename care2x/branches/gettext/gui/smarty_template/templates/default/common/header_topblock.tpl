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
	  	<div class="buttons" style="float:right">
		{{if $pbAux2}}<a href="{{$pbAux2}}" class="regular"><img {{$gifAux2}} alt=""></a>{{/if}}
		{{if $pbAux1}}<a href="{{$pbAux1}}" class="regular"><img {{$gifAux1}} alt=""></a>{{/if}}
		{{if $pbBack}}<a href="{{$pbBack}}" class="regular"><img {{$gifBack2}} alt="">{{$LDBack}}</a>{{/if}}
		{{if $pbHelp}}<a href="{{$pbHelp}}" class="regular"><img {{$gifHilfeR}} alt="">{{$LDHelp}}</a>{{/if}}
		{{if $breakfile}}<a href="{{$breakfile}}" {{$sCloseTarget}} class="negative"><img {{$gifClose2}} alt="{{$LDCloseAlt}}">{{$LDClose}}</a>{{/if}}
		 </div>
	  </td>
	 </tr>
	 </table>