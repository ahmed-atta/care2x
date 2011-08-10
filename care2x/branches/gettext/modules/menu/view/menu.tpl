<!-- thanks to http://www.jankoatwarpspeed.com/post/2009/01/19/Create-Vimeo-like-top-navigation.aspx -->
<style>
body {
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: 12px;
	margin: 0px 20px;
}
/* menu */
#menu {
	margin: 0px;
	padding: 0px;
	list-style: none;
	color: #fff;
	line-height: 45px;
	display: inline-block;
	float: left;
	z-index: 1000;
}

#menu a {
	color: #fff;
	text-decoration: none;
}

#menu>li {
	background: #172322 none repeat scroll 0 0;
	cursor: pointer;
	float: left;
	position: relative;
	padding: 0px 10px;
}

#menu>li a:hover {
	color: #B0D730;
}

#menu .logo {
	background: transparent none repeat scroll 0% 0%;
	padding: 0px;
	background-color: Transparent;
}
/* sub-menus*/
#menu ul {
	padding: 0px;
	margin: 0px;
	display: block;
	display: inline;
}

#menu li ul {
	position: absolute;
	left: -10px;
	top: 0px;
	margin-top: 45px;
	width: 150px;
	line-height: 16px;
	background-color: #172322;
	color: #0395CC; /* for IE */
	display: none;
}

#menu li:hover ul {
	display: block;
}

#menu li ul li {
	display: block;
	margin: 5px 20px;
	padding: 5px 0px;
	border-top: dotted 1px #606060;
	list-style-type: none;
}

#menu li ul li:first-child {
	border-top: none;
}

#menu li ul li a {
	display: block;
	color: #0395CC;
}

#menu li ul li a:hover {
	color: #7FCDFE;
}
/* main submenu */
#menu #main {
	left: 0px;
	top: -20px;
	padding-top: 20px;
	background-color: #7cb7e3;
	color: #fff;
	z-index: 999;
}
/* search */
.searchContainer div {
	background-color: #fff;
	display: inline;
	padding: 5px;
}

.searchContainer input[type="text"] {
	border: none;
}

.searchContainer img {
	vertical-align: middle;
}
/* corners*/
#menu .corner_inset_left {
	position: absolute;
	top: 0px;
	left: -12px;
}

#menu .corner_inset_right {
	position: absolute;
	top: 0px;
	left: 150px;
}

#menu .last {
	background: transparent none repeat scroll 0% 0%;
	margin: 0px;
	padding: 0px;
	border: none;
	position: relative;
	border: none;
	height: 0px;
}

#menu .corner_left {
	position: absolute;
	left: 0px;
	top: 0px;
}

#menu .corner_right {
	position: absolute;
	left: 132px;
	top: 0px;
}

#menu .middle {
	position: absolute;
	left: 18px;
	height: 20px;
	width: 115px;
	top: 0px;
}
</style>
<div style="margin-left: 10px;">
	<ul id="menu">
		<li class="logo"><img style="float: left;" alt="" src="{{$care_gui}}modules/menu/view/menu_left.png" />
			<ul id="main">
				<li>Welcome to <b>Care2X</b></li>
				<li class="last">
					<img class="corner_left" alt="" src="{{$care_gui}}modules/menu/view/corner_blue_left.png" /> 
					<img class="middle" alt="" src="{{$care_gui}}modules/menu/view/dot_blue.png" /> 
					<img class="corner_right" alt="" src="{{$care_gui}}modules/menu/view/corner_blue_right.png" />
				</li>
			</ul>
		</li> 
		{{foreach from=$menuFields key=menu_id item=menuname}}
			<li><a href="{{$care_gui}}{{$menuname.url}}">{{$menuname.name}}</a>
				<ul id="{{$i.name}}">
				{{foreach from=$submenuFields key=id item=submenuname}}
					{{if $menuname.nr eq $submenuname.s_main_nr}}
						<img class="corner_inset_left" alt="" src="{{$care_gui}}modules/menu/view/corner_inset_left.png" />
						<li><a href="{{$care_gui}}{{$submenuname.s_url}}">{{$submenuname.s_name}}</a></li>
						<img class="corner_inset_right" alt="" src="{{$care_gui}}modules/menu/view/corner_inset_right.png" />
					{{/if}}
					
				{{/foreach}}
				</ul>
			</li> 
		{{/foreach}}
{{*
		{{foreach from=$menuFields key=id item=i}}
			<li><a href="{{$care_gui}}{{$i.url}}">{{$i.name}}</a></li> 
		{{/foreach}}
*}}
		
	</ul>
	<img style="float: left;" alt="" src="{{$care_gui}}modules/menu/view/menu_right.png" />
</div>
<div style="float: none; clear: both;"></div>

