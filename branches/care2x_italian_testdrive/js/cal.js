/* author: Lorilla Bong */
/* Generated by AceHTML Freeware http://freeware.acehtml.com */
/* Creation date: 20.05.01 */
var urlholder;

function update()
{

	var mbuf=document.direct.month.selectedIndex+1;
	var jbuf=document.direct.jahr.value;
	if(!isNaN(jbuf))
	{
	jbuf=parseInt(jbuf);
	var urltarget="op-pflege-calendar.php?sid=<?print $ck_sid; ?>&pmonth="+mbuf+"&pyear="+jbuf;
	window.location.replace(urltarget);
	}
	else document.direct.jahr.select();
}

function cxjahr(offs)
{
	
	var buf=document.direct.jahr.value;
	if(offs<1) buf--; else buf++;
	if(!isNaN(buf)) 
	{
	buf=parseInt(buf);
	document.direct.jahr.value=buf;
	}
	else document.direct.jahr.select();
}
