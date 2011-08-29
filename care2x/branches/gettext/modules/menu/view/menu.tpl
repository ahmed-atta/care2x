<script type="text/javascript">
<!--
$('document').ready(function(){
	  $("body").bind("click", function (e) {
		    $('a.menu').parent("li").removeClass("open");
		  });

		  $("a.menu").click(function (e) {
		    var $li = $(this).parent("li").toggleClass('open');
		    return false;
		  });
});
//-->
</script>

<div class="topbar-wrapper" style="z-index: 5;">
	<div class="topbar">
		<div class="fill">
			<div class="container">
				<h3>
					<a href="{{$care_gui}}">Care2X</a>
				</h3>
					{{foreach from=$menu key=k item=v}} 
						{{if not $v.children}}
							<ul>
								<li><a href="{{$care_gui}}{{$v.url}}">{{$v.name}}</a></li> 
							</ul>
						{{else}}
							<ul class="nav secondary-nav">
								<li class="menu">
								<a class="menu" href="{{$v.url}}">{{$v.name}}</a>
								<ul class="menu-dropdown">
									{{foreach from=$v.children key=sk item=sv}}
										<li><a href="{{$care_gui}}{{$sv.url}}">{{$sv.name}}</a></li> 
									{{/foreach}}
								</ul>
								</li> 
							</ul>
						{{/if}} 
					{{/foreach}}
			</div>
		</div>
		<!-- /fill -->
	</div>
	<!-- /topbar -->
</div>
<!-- topbar-wrapper -->

<div class="clearfix" style="height:30px"></div>