{* Smarty 2.6.0 Template - NURSING.TPL 19.12.2003 Thomas Wiedmann *}
{* Definition :  "pb.."  alias for a GUI pushbutton-element *}
{*            :  "gif.." alias for a GIF element *}
{*            :  "tbl.." alias for a <TABLE> .. </TABLE> element *}
{config_load file=test.conf section="setup"}

{include file="common/header.tpl" title=""}

{$sHTMLtag}

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 >


<table width=100% border=0 cellspacing=0 height=100%>

{include file="common/header_topblock.tpl"}
 
 <tr>
 <td bgcolor={$body_bgcolor} valign=top colspan=2><p><br>
 <ul><!-- <img src="../img/nurse.jpg" align="right"> -->
 <FONT SIZE=-1  FACE="Arial">
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
  <TBODY>
  <TR>
   <TD>
   <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 border=0>
   <TBODY>
    <TR bgColor="#eeeeee">
     <td align=center>
      <img {$gifTeamWksp} >
     </td>
     <TD vAlign=top width="150">
      <FONT face="Verdana,Helvetica,Arial" size="2" color="{$body_txtcolor}">
       <B><nobr>{$LDNursingStations}&nbsp;<img {$gifDwnArrowGrn} alt=""></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>{$LDNursingStationsTxt}
      </FONT>
     </TD>
    </TR>
    <TR bgColor="#dddddd" >
     <TD colSpan=3>
      {$tblWardInfo}
			  </TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img {$gifEye_s} alt="{$LDQuickView}" width=16 height=16 >
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><nobr><a href="{$LINKQuickView}">{$LDQuickView}</a></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       {$LDQuickViewTxt}
      </FONT>
     </TD>
    </tr>
    <TR bgColor=#dddddd height=1 >
     <TD colSpan=3 height=1><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img {$gifFindnew} alt="{$LDSearchPatient}" >
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><nobr><a href="{$LINKSearch}">{$LDSearchPatient}</a></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       {$LDSearchPatientTxt}
      </FONT>
     </TD>
    </tr>
    <TR bgColor=#dddddd height=1>
      <TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center><img {$gifStorage} alt="{$LDArchive}">
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><nobr><a href="{$LINKArchiv}">{$LDArchive}</a></nobr></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       {$LDArchiveTxt}
      </FONT>
     </TD>
    </tr>
    <TR bgColor=#dddddd height=1>
     <TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img {$gifTimeplan} alt="{$LDStationMan}">
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2><B> 
   				<a href="{$LINKStationMan}"><nobr>{$LDStationMan}</nobr></a></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <nobr>{$LDStationManTxt}</nobr>
      </FONT>
     </TD>
    </TR>              
    <TR bgColor=#dddddd height=1>
     <TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5 ></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center><img {$gifForums} alt="{$LDNursesList}" width=15 height=14>
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B><a href="{$LINKNursesList}">{$LDNursesList}</a></B>
      </FONT>
     </TD>
     <TD>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       {$LDNursesListTxt}
      </FONT>
     </TD>
    </TR>
    <TR bgColor=#dddddd height=1>
	<TD colSpan=3><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
    </TR>
    <TR bgColor=#eeeeee>
     <td align=center>
      <img {$gifBubble} alt="{$LDNews}" width=15 height=14>
     </td>
     <TD vAlign=top width=150>
      <FONT face="Verdana,Helvetica,Arial" size=2>
       <B>
        <a href="{$LINKNews}">{$LDNews}</a>
       </B>
      </FONT>
     </TD>
     <TD><FONT face="Verdana,Helvetica,Arial" size=2>{$LDNewsTxt}</FONT>
     </TD>
    </TR>
		 </TBODY>
	 </TABLE>
		</TD>
  </TR>
	</TBODY>
	</TABLE>
<p>
<a href="{$breakfile}"><img {$pbClose2} alt="{$LDCloseBack2Main}" align="middle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

{include file="common/footer.tpl"}
