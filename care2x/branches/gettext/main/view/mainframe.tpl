{{* Smarty Template - mainframe.tpl 2004-06-11 Elpidio Latorilla *}}
{{* This is the main template that frames the main work page *}}
{{$smarty.const.MODULE}}
{{include file="{{$smarty.const.CARE_BASE}}main/view/header.tpl"}}

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
{{if not $bHideTitleBar}}
	<tr>
		<td  valign="top" align="middle" height="35">
			{{include file="{{$smarty.const.CARE_BASE}}main/view/header_topblock.tpl"}}
		</td>
	</tr>
{{/if}}

	<tr>
		<td  valign=top>
		
			{{* Note the ff: conditional block must always go together *}}
			{{if $sMainBlockIncludeFile ne ""}}
				{{include file=$sMainBlockIncludeFile}}
			{{/if}}
			{{if $sMainFrameBlockData ne ""}}
				{{$sMainFrameBlockData}}
			{{/if}}
			{{* end of conditional block *}}

		</td>
	</tr>
	


	</tbody>
 </table>

</body>
</html>