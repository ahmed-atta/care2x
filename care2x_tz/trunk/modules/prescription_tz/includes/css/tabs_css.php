<?php 
echo '<STYLE TYPE="text/css">';
echo '
/* root element for tabs  */
ul.tabs { 
	list-style:none; 
	margin:0 !important; 
	padding:0;	
	border-bottom:1px solid #666;	
	height:30px;
}

/* single tab */
ul.tabs li { 
	float:left;	 
	text-indent:0;
	padding:0;
	margin:0 !important;
	list-style-image:none !important; 
}

/* link inside the tab. uses a background image */
ul.tabs a { 
	background: url('.$root_path.$top_dir.'/includes/img/tabs/blue.png) no-repeat -420px 0;
	font-size:11px;
	display:block;
	height: 30px;  
	line-height:30px;
	width: 134px;
	text-align:center;	
	text-decoration:none;
	color:#333;
	padding:0px;
	margin:0px;	
	position:relative;
	top:1px;
}

ul.tabs a:active {
	outline:none;		
}

/* when mouse enters the tab move the background image */
ul.tabs a:hover {
	background-position: -420px -31px;	
	color:#fff;	
}

/* active tab uses a class name "current". its highlight is also done by moving the background image. */
ul.tabs a.current, ul.tabs a.current:hover, ul.tabs li.current a {
	background-position: -420px -62px;		
	cursor:default !important; 
	color:#000 !important;
}

/* Different widths for tabs: use a class name: w1, w2, w3 or w2 */


/* width 1 */
ul.tabs a.s 			{ background-position: -553px 0; width:81px; }
ul.tabs a.s:hover 	{ background-position: -553px -31px; }
ul.tabs a.s.current  { background-position: -553px -62px; }

/* width 2 */
ul.tabs a.l 			{ background-position: -248px -0px; width:174px; }
ul.tabs a.l:hover 	{ background-position: -248px -31px; }
ul.tabs a.l.current  { background-position: -248px -62px; }


/* width 3 */
ul.tabs a.xl 			{ background-position: 0 -0px; width:248px; }
ul.tabs a.xl:hover 	{ background-position: 0 -31px; }
ul.tabs a.xl.current { background-position: 0 -62px; }


/* initially all panes are hidden */ 
.panes .pane {
	display:none;		
}
';
echo '</style>';
?>