<?php

?>
<script language="javascript">
<!--
function metti_valore (valore)
{
 mywin=parent.window.opener;
 mywin.document.primo.osti.value+=valore;
 window.close();
}
//-->
</script>

<table border=0 cellpadding=2 cellspacing=1> 
						<tr bgcolor="#66ee66" background="../../gui/img/common/default/tableHeaderbg.gif">
						<td><font face=arial size=2 color="#336633"><b>OSTI CORONARICI</b></td>
						<td><font face=arial size=2 color="#336633">&nbsp;POSSIBILITA'</td></tr>
							<tr bgcolor=#ffffff><td><font face=arial size=2>&nbsp;Visualizzabili entrambi in sede regolare</td>
						         <td><font face=arial size=2><a href="javascript:metti_valore('Visualizzabili entrambi in sede regolare')">	
							<img src="../../gui/img/control/default/it/it_ok_small.gif" border=0 width="105" height="16" alt=""></a>&nbsp;</td></tr>

							<tr bgcolor=#efefef><td><font face=arial size=2>&nbsp;Sinistro in sede, destro mal visualizzabile</td>
						         <td><font face=arial size=2><a href="javascript:metti_valore('Sinistro in sede, destro mal visualizzabile')">	
							<img src="../../gui/img/control/default/it/it_ok_small.gif" border=0 width="105" height="16" alt=""></a>&nbsp;</td></tr>
							<tr bgcolor=#ffffff><td><font face=arial size=2>&nbsp;Sinistro in sede, destro ad ore 12 con imbocco a 90 gradi</td>
						         <td><font face=arial size=2><a href="javascript:metti_valore('Sinistro in sede, destro ad ore 12 con imbocco a 90°')">	
							<img src="../../gui/img/control/default/it/it_ok_small.gif" border=0 width="105" height="16" alt=""></a>&nbsp;</td></tr>
							<tr bgcolor=#efefef><td><font face=arial size=2>&nbsp;Mal visualizzabili</td>
						         <td><font face=arial size=2><a href="javascript:metti_valore('Mal visualizzabili')">	
							<img src="../../gui/img/control/default/it/it_ok_small.gif" border=0 width="105" height="16" alt=""></a>&nbsp;</td></tr>
							
						</table>