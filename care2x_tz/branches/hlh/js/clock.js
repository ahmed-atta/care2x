/* author: Bong */
/* Generated by AceHTML Freeware http://freeware.acehtml.com */
/* Creation date: 09.05.01 */

function show5(){
if (!document.layers&&!document.all)
return
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
//var dn="AM"
//if (hours>12){
//dn="PM"
//hours=hours-12
//}
//if (hours==0)
//hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
//change font size here to your desire
myclock="<font face='Arial' ><b></br><p>"+hours+":"+minutes+":"
+seconds+" </b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
setTimeout("show5()",1000)
}
