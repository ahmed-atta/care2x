{{* Smarty 2.6.0 Template - NURSING-SCHNELLANSICHT.TPL 27.12.2003 Thomas Wiedmann *}}
{{* Definition :  "pb.."  alias for a GUI pushbutton-element *}}
{{*            :  "gif.." alias for a GIF element like "src=xxx.gif" *}}
{{*            :  "tbl.." alias for a <TABLE> .. </TABLE> element *}}
{{config_load file=test.conf section="setup"}}

{{include file="common/header.tpl" title=""}}

<script language="javascript">
<!-- 

var urlholder;

 function gotostat(station){
    winw=screen.width ;
    winw=(winw / 2) - 400;
    winh=screen.height ;
    winh=(winh / 2) - 300;
    winspecs="width=800,height=600,screenX=" + winw + ",screenY=" + winh + ",menubar=no,resizable=yes,scrollbars=yes";

     urlholder="nursing-station.php?route=validroute&user={$aufnahme_user}&station=" + station;
     stationwin=window.open(urlholder,station,winspecs);
 }

 function statbel(e,ward_nr,st){

  {{if $dhtml}}
     w=window.parent.screen.width; 
     h=window.parent.screen.height;
  {{else}}
     w=800;
     h=600;
  {{/if}}

  winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);
    
  if (e==1) urlholder="nursing-station-pass.php?rt=pflege&sid={{$SID_Parameter}}&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  else urlholder="nursing-station.php?rt=pflege&sid={{$SID_Parameter}}&edit=0&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  //stationwin=window.open(urlholder,station,winspecs);   
  window.location.href=urlholder;

 }

// -->
</script>

<table width='100%' border='0' cellspacing='0' height=100%>

<tr>
  <td height="10" valign="top">
    {{include file="common/header_topblock.tpl"}}
  </td>
</tr>

 <tr>
  <td bgcolor={{$body_bgcolor}} valign=top colspan=2>
  {{$tblCalendar}}
  <FONT    SIZE=4  FACE="Arial" color=red>
   <img {{$gifVarrow}} alt="">
   <b> {{if $is_today}} {{$LDTodays}} {{else}} {{$LDOld}} {{/if}} {{$LDOccupancy}} </b>
  </FONT> &nbsp;&nbsp;
  <font size="2" face="arial">
  </font>
 
  ({{$formatDate2Local}})
  <table  cellpadding="0" cellspacing=0 border="0"  width="100%">
   <tr bgcolor="aqua" align=center><td><font face="verdana,arial" size="2" ><b>&nbsp;{{$LDStation}}&nbsp;</b></td>
    <td><img  {{$gifImg_mangr}} alt="{{$LDNrUnocc}}"> <font face="verdana,arial" size="2" ><b>{{$LDFreeBed}}</b></td>
    <td><font face="verdana,arial" size="2"  color="{{$PIE_CHART_USED_COLOR}}">&nbsp;<b>{{$LDOccupied}}</b></td>
    <td><font face="verdana,arial" size="2" >&nbsp;<b>{{$LDOccupancy}} (%)</b></td>
    <td><font face="verdana,arial" size="2" >&nbsp;<b>{{$LDBedNr}}</b></td>
    <td><font face="verdana,arial" size="2" > <b>&nbsp;{{$LDOptions}}&nbsp;</b></td>
       
   </tr>

    {{$WardRows}}

 </table>
 {{if $is_today}}
 <br>
 {{else}}
    <p>
    <img {{$gifMascot1_r}} alt="">
    <font face="Verdana, Arial" size=3 color="#880000">
    <b>{{$LDNoOcc}}</b><p>
    <font size=2 color="#0">
     <a href="{{$LINKArchiv}}">{{$LDClk2Archive}}
      <img {{$gifBul_arrowgrnlrg}} alt="">
     </a>
    </font></font>
    </p>
    <br>&nbsp;
 {{/if}}
 
 {{if $from == "arch"}}
  <a href="{{$LINKArchiv}}">
   <img {{$pbBack2}} alt="" width=110 height=24>
  </a>
 {{else}}
  <a href="{{$breakfile}}">
   <img {{$pbClose2}} alt="">
  </a>
 {{/if}}
 
 </FONT>
 </td>
 </tr>

  <tr valign=top >
 <td bgcolor={{$bot_bgcolor}} height=70 colspan=2>

 {{include file="common/copyright.tpl"}}

 </td>
 </tr>
 </table>

{{include file="common/footer.tpl"}}
