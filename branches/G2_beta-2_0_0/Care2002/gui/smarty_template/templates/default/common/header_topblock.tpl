 {{* Toolbar - Topblock  *}}
<table border="0" width="100%" cellspacing="0" cellpadding="0">
 <tr valign=top>
  <td bgcolor="{{$top_bgcolor}}" >
   <FONT  COLOR="{{$top_txtcolor}}"  SIZE=+2  FACE="Arial">
    <STRONG> &nbsp; {{$LDNursing}}{{$sToolbarTitle}}
     {{if $Subtitle}}
      - {{$Subtitle}}
     {{/if}}
    </STRONG>
   </FONT>
  </td>
  <td bgcolor="{{$top_bgcolor}}" align=right>{{if $pbAux2}}<a
   href="{{$pbAux2}}"><img {{$gifAux2}} alt="" {{$dhtml}} ></a>{{/if}}{{if $pbAux1}}<a
   href="{{$pbAux1}}"><img {{$gifAux1}} alt="" {{$dhtml}} ></a>{{/if}}<a
   href="{{$pbBack}}"><img {{$gifBack2}} alt="" {{$dhtml}} ></a><a
   href="{{$pbHelp}}"><img {{$gifHilfeR}} alt="" {{$dhtml}}></a><a 
   href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
  </td>
 </tr>
 </table>
