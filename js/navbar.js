// JavaScript Document
$(function(){
	$('.sboverlay, #lotus-c, #lotus-master-overlay').hide();
	$('#lotus-x, #lotus-account, #lotus-time, #lotus-activity, #lotus-request, .lotus-img-x').fadeOut(0);
	$('#sb_sched_sub').slideUp(0);
	var winwidth = $(window).width();
	disp(winwidth);	
	//pag nagclick daw sa nav-bar ng buttons daw
	$('#nav_lotus').on('click',	
	function(){
		$('#lotus-x, .lotus-img-x').delay(250).fadeIn(250);
		$('#lotus-account').delay(400).fadeIn(250);
		$('#lotus-time, #lotus-activity').delay(500).fadeIn(250);
		$('#lotus-request').delay(600).fadeIn(250);
		$('#lotus-c').show();
		$('#lotus-c').removeClass('lotus-x-animate');
		});
	$('#lotus-x').on('click',
	function(){
		$('#lotus-c').addClass('lotus-x-animate');
		setTimeout(function(){$('#lotus-c').hide();},490);
		$('#lotus-x, #lotus-account, #lotus-time, #lotus-activity, #lotus-request, .lotus-img-x, #lotus-master-overlay').fadeOut(250);
		});
	$('#lotus-time').on('click', function(){
		$('#lotus-master-overlay').fadeIn(250);
		});
	$('#lotus-account').on('click', function(){
		$('#lotus-master-overlay').fadeIn(250);
		});
	$('#lotus-request').on('click', function(){
		$('#lotus-master-overlay').fadeIn(250);
		});
	$('#lotus-activity').on('click', function(){
		$('#lotus-master-overlay').fadeIn(250);
		});
	$('.x-search-prop').on('click', function(){
	$('.nav_search_holder').addClass('nav_search_holder-x');
		setTimeout(function(){$('#nav_nanaman').show();},200);
		});
	$('#nav_search').on('click', function(){
		$('.nav_search_holder').removeClass('nav_search_holder-x');
		$('#nav_nanaman').hide();
		});
	$('#lotus-back').on('click', function(){
		$('#lotus-master-overlay').fadeOut(200);
		});

	//pang transition ng nav bar daw
	$(window).on('scroll',
	function() {
		var navsplash = $('.nav_splash').outerHeight();
		var navmain = $('.nav_main').outerHeight();
		var vScroll = $(document).scrollTop();
		if (vScroll >= (navsplash-navmain))
		{
			$('.nav_main').addClass('navdark');
			$('#nav_time').hide();$('#nav_title').show();
			$('.nav_icon_prop').addClass('icon_active_w');
			$('.nav_icon_prop').removeClass('icon_active_b');
			$('#nav_search_icon').addClass('nav_search_w');
			$('#nav_search_icon').removeClass('nav_search_b');
			$('#nav_collapse_icon').addClass('nav_collapse_w');
			$('#nav_collapse_icon').removeClass('nav_collapse_b');
			$('#nav_lotus_icon').addClass('nav_lotus_w');
			$('#nav_lotus_icon').removeClass('nav_lotus_b');
			$('#nav_sbar').addClass('nav_search_bar_w');
			$('#nav_sbar').removeClass('nav_search_bar');
			$('.x-search-prop').addClass('x-search-w');
			$('.x-search-prop').removeClass('x-search-b');
			
			}
		else
		{
			$('.nav_main').removeClass('navdark');
			$('#nav_time').show();$('#nav_title').hide();
			$('.nav_icon_prop').removeClass('icon_active_w');
			$('.nav_icon_prop').addClass('icon_active_b');
			$('#nav_search_icon').removeClass('nav_search_w');
			$('#nav_search_icon').addClass('nav_search_b');
			$('#nav_collapse_icon').removeClass('nav_collapse_w');
			$('#nav_collapse_icon').addClass('nav_collapse_b');
			$('#nav_lotus_icon').removeClass('nav_lotus_w');
			$('#nav_lotus_icon').addClass('nav_lotus_b');
			$('#nav_sbar').addClass('nav_search_bar');
			$('#nav_sbar').removeClass('nav_search_bar_w');
			$('.x-search-prop').addClass('x-search-b');
			$('.x-search-prop').removeClass('x-search-w');
			}		
		});
	//side bar daw
	$('#nav_collapse').on('click',
	function(){
		$('#sboverlay').fadeIn(300);
		$('#sbholder').removeClass('slide2hide');
		$('#sbholder').addClass('slide2show');
		});
	//overlay daw	
	$('#sboverlay').on('click',
	function(){
		$('#sboverlay').fadeOut(200);
		$('#sbholder').addClass('slide2hide');
		$('#sbholder').removeClass('slide2show');
		});	

	//click daw nung schedule para mag slide down daw
	$('#sb_sched').on('click',
	function(){
		$('#sb_sched_sub').slideToggle(300);
		});
		});
	//responsive daw
	function disp(ww)
	{
		if(ww < 1280)
		{
			$('.splashcontainer').removeClass('inl');
			$('.splashcontainer').addClass('hundredcontainer');
			$('.splashcontainer').removeClass('fiftycontainer');
			
			}
		else
		{
			$('.splashcontainer').addClass('inl');
			$('.splashcontainer').addClass('fiftycontainer');
			$('.splashcontainer').removeClass('hundredcontainer');	
			}

	return;
	}
	$(window).resize(function(){
	var winwidth = $(window).width();
	$('#modal').centerize();
	disp(winwidth);
	});
