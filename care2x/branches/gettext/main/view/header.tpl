<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
{{$HTMLtag}}
<HEAD>
 <TITLE>{{$sWindowTitle}} - {{$Name}}</TITLE>
 {{include file="{{$smarty.const.CARE_BASE}}main/view/metaheaders.tpl"}}

 {{foreach from=$JavaScript item=currentJS}}
 	{{$currentJS}}
 {{/foreach}}

</HEAD>
<BODY  {{$bgcolor}} {{$sLinkColors}} {{$sOnLoadJs}}>
{{$main_menu}}
