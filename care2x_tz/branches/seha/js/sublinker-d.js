/* author: Lorilla Bong */
/* Generated by AceHTML Freeware http://freeware.acehtml.com */
/* Creation date: 24.06.01 */



// horizontal distance from the textlink to the submenu (pixels)
var xdistance=10;

// vertical distance from the textlink to the submenu (pixels)
var ydistance=10;

function ssm(){
	if (brwsVer>=4) {
		if(menuId=='') 
		{
			if (curSubMenu!='') hsm();
			return;
		}
		if (curSubMenu!='') hsm();
		if (document.all) {
			eval('document.all.'+menuId).style.visibility='visible';
			eval('document.all.'+menuId).style.posTop=y+ydistance;
			eval('document.all.'+menuId).style.posLeft=x+xdistance;
		} else{
			eval('document.'+menuId).visibility='show';
			eval('document.'+menuId).posTop=y+ydistance;
			eval('document.'+menuId).posLeft=x+xdistance;
		}
			curSubMenu=menuId;
	}
}
function hsm(){
	if (brwsVer>=4) {
	if (curSubMenu=='') return;
		if (document.all) {
			eval('document.all.'+curSubMenu).style.visibility='hidden';
		} else {
			eval('document.'+curSubMenu).visibility='hide';
		}
		curSubMenu='';
	}
}
var brwsVer=parseInt(navigator.appVersion);var timer;var curSubMenu=''; var menuId='';var t; var x,y;

/*
function handlerMM(e){
	x = (document.layers) ? e.pageX : document.body.scrollLeft+event.clientX
	y = (document.layers) ? e.pageY : document.body.scrollTop+event.clientY
}

if (document.layers){
	document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove=handlerMM;
*/

