// !IMPORTANT: INCLUDE JQUERY FIRST BEFORE THIS

// Sarz' User Defined Jquery function atbp. :3

$(window).on('load', function(){ 
$('#modal').hide();
$('#modal-overlay').hide();
//$('#modal').modal("Title Here", "red", "Context Here", null, null, 'Backlush');
// title titleholder context contextholder buttonyes buttonno
// titleholder only accepts teal, red, amber and grey
// Wala pang contextholder
//$('#modal').centerize(); // always at the middle
//$('#modal').modalbuttons(false,true,true,null,null);
// showyes showno thisshow functionyes functionno
});
//---------------------Global-Variable---------------------------------------
var global_color_selected = 0,
	global_grid_selected = 0,
	GLOBAL_floor_selected = 1,
	GLOBAL_floor_selected_vs_prev = 1,
	GLOBAL_sc_selected = null,
	GLOBAL_open_sc_del = false,
	GLOBAL_open_sc_edit = false,
	GLOBAL_current_site = null,
	GLOBAL_menu = 0,
	GLOBAL_prof_set = [];
	
//-------------------------Global-Array---------------------------------------	
var arr_time_options = ['7:00am','8:00am','9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm','3:00pm','4:00pm',
'5:00pm','6:00pm','7:00pm','8:00pm','9:00pm'];
var thema = ['red','pink','purple','deep purple','indigo','blue','light blue',
				'cyan','teal','green','light green','lime','yellow','amber','orange','deep orange'];

//---------------------Before-Load-Configurations----------------------------
$(function(){
	$('.ssg-header ul li:nth-of-type(1)').toggleClass('ssg-header-on',true);
	$('.ghide2').fadeOut(0);	$('.ssgci-true-header').slideUp(0);
	$('#ssg-subj-info, #ssg-prof-info, #ssg-grid-option').hide();
	$('.room-animate').hide();
//---------------------Before-Load-UD-Function-------------------------------
function resetto(){

var x=0,z=0,concat_timein = "",concat_timeout = "";

for(x=0;x<=13;x++){concat_timein += '<option value="'+arr_time_options[x]+'">'+arr_time_options[x]+'</option>';}
for(z=1;z<=14;z++){concat_timeout += '<option value="'+arr_time_options[z]+'">'+arr_time_options[z]+'</option>';}

$('.timein').html(concat_timein);
$('.timeout').html(concat_timeout);

}
/*
$('.ssgo-color').on('click',function(){
		var x = 0;
		var divconcat = "";
		for(x=1;x<=16;x++)
		{	divconcat = divconcat + "<div class='gridclr'></div>";	}
		$('#modal').modal("Theme Selection", "grey","<div class='colorcontainer'>"+divconcat+"</div>", null, 'Change Theme', 'Cancel');
		$('#modal').centerize();
		$('#modal').modalbuttons(true,true,true,function(){
			$('.grid:nth-of-type('+global_grid_selected+')').click();
			},null);
		$('.gridclr').on('click',function(){
			var selected = $(this).index() + 1;
			$('.gridclr').each(function(index, element) {
					if($(this).is(':nth-child('+selected+')'))
					{
						$(this).addClass('colorselected');
						global_color_selected = thema[$(this).index()];	
					}
					else
					{
						$(this).removeClass('colorselected');
					}
            });
			alert(global_color_selected);
			alert(GLOBAL_sc_selected);
			alert(GLOBAL_current_site);
		});
		if(GLOBAL_current_site === "prof-setting"){
			$.ajax({
			type: 'post',
			url: 'oT-Core.php?form_type=prof_stheme&thema='+global_color_selected+'&sc='+GLOBAL_sc_selected,
			complete: function(e){
			}
				});
			}
		});
*/

//---------------------Global-Event-Listeners--------------------------------

				////-----Schedule-Grid------////
				
	$('.ssg-header ul li:nth-of-type(1)').on('click',function(){
		$(this).toggleClass('ssg-header-on',true);
		$('.ssg-header ul li:nth-of-type(2)').toggleClass('ssg-header-on',false);
		$('.ghide2').fadeOut(200);
		setTimeout(function(){$('.ghide1').fadeIn(200);},200);
		});
	$('.ssg-header ul li:nth-of-type(2)').on('click',function(){
		$(this).toggleClass('ssg-header-on',true);
		$('.ssg-header ul li:nth-of-type(1)').toggleClass('ssg-header-on',false);
		$('.ghide1').fadeOut(200);
		setTimeout(function(){$('.ghide2').fadeIn(200);},200);
		});
	$('#ssgcc-sizeheight').on('input change',function(){
		var h = $(this).val();
		$('.ssg-container').height(h);
		});
	$('#ssgcc-zoom').on('input change',function(){
		var maxzoom = 2; var minzoom = 0.3;
		var zoomval = ((maxzoom/100)*$(this).val())+minzoom;
		$('.ssg-container-zoom').css("-webkit-transform","scale("+zoomval+")");
		});
	$('.ssgcc-default').on('click',function(){
		$('#ssgcc-sizeheight').val(500);
		$('#ssgcc-zoom').val(35);
		$('.ssg-container-zoom').css("-webkit-transform","scale(1.0)");
		$('.ssg-container').height(500);
		});
//--------------------------Schedule List-------------------------------------
	$('.sc-dd').slideUp(0);
	var mod1 = 0, mod2 = 0;
	$('.sc-ddown .scli').on('click',function(){
		var letgo = $(this).index();
		if(letgo === 0)
		{$('.sc-dd:nth-of-type(1)').slideToggle(350);
		resetto();
		}
		else if(letgo === 2)
		{
		$('.sc-dd:nth-of-type(2)').slideToggle(350);
		if(mod1%2===0){ GLOBAL_open_sc_del = true; }
		else{
		GLOBAL_open_sc_del = false;			
			}
		mod1++;
		}
		else if(letgo === 4)
		{$('.sc-dd:nth-of-type(3)').slideToggle(350);
		if(mod2%2===0){		GLOBAL_open_sc_edit = true;		}
		else{		GLOBAL_open_sc_edit = false;			}
		mod2++;
		resetto();
		}
		else if(letgo === 6)
		{$('.sc-dd:nth-of-type(4)').slideToggle(350);}
		$('.editsched, .delsched').val(null);
		});

	});

//--------------------------USER-DEFINED-FUNCTIONS--------------------------
$.fn.centerize = function (){
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight(true)) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth(true)) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
};

$.fn.modalbuttons = function(showyes,showno,thisshow, funcYes, funcNo) 
	{
	thisshow = thisshow || false;
	funcYes = funcYes || null;
	funcNo = funcNo || null;
	
	if(showyes === true){$('#modal-button-yes').show();}
	else				{$('#modal-button-yes').hide();}
	if(showno === true) {$('#modal-button-no').show();}
	else				{$('#modal-button-no').hide();}
	if(thisshow === true)	{ $('#modal, #modal-overlay').fadeIn(200); }
	else					{ $('#modal').hide(); }
	$('#modal-button-yes').on('click',function(){
		$('#modal, #modal-overlay').fadeOut(200);
		if(funcYes!== null){funcYes();
		funcYes = null; funcNo = null;		
		}
		});
	$('#modal-button-no').on('click',function(){
		$('#modal, #modal-overlay').fadeOut(200);
		if(funcNo!== null){funcNo();
		funcYes = null; funcNo = null;
		}
		});	

		};

$.fn.modal = function(title,titleholder,content,contentholder,buttonyes,buttonno,override){
	title = title || null;	titleholder = titleholder || null;	content = content || null;
	contentholder = contentholder || null;	buttonyes = buttonyes || 'Confirm';	buttonno = buttonno || 'Dismiss';
	override = override || null;
	$('#modal-title').attr('class','prmtxt_w');
	$('#modal-content').attr('class','modal-content prmtxt_b');
	$('#modal-button-yes').attr('class','modal-c-teal');
	$('#modal-button-no').attr('class','modal-c-red');

	$('#modal-title h2').html(title);
	$('.modal-title').addClass(titleholder);
	$('#modal-content-inside').html(content);
	$('#modal-content').addClass(contentholder);
	$('#modal-button-yes').html(buttonyes);
	$('#modal-button-no').html(buttonno);

	var mtitle = 'modal-bg-grey';
	var mtitletext = 'prmtxt_b';
	var mbutton = 'modal-c-grey';

	if(titleholder === 'teal'){ 
	mtitle = 'modal-bg-teal';
	mtitletext = 'prmtxt_w';
	mbutton = 'modal-c-teal';
	}
	else if(titleholder === 'amber')
	{
	mtitle = 'modal-bg-amber';
	mtitletext = 'prmtxt_b';
	mbutton = 'modal-c-amber';	
	}
	else if(titleholder === 'red')
	{
	mtitle = 'modal-bg-red';
	mtitletext = 'prmtxt_w';
	mbutton = 'modal-c-red';	
	}
	else if(titleholder === 'grey')
	{
	mtitle = 'modal-bg-grey';
	mtitletext = 'prmtxt_b';
	mbutton = 'modal-c-grey';
	}
	else
	{
	mtitle = 'modal-bg-grey';
	mtitletext = 'prmtxt_b';
	mbutton = 'modal-c-grey';
	}
	$('#modal-title').addClass(mtitle);
	$('#modal-title h2').attr('class', mtitletext);
	$('#modal-button-yes, #modal-button-no').attr('class', mbutton);
	if(override !== null){override();}
	};
$.fn.onView  = function(whatclass){
		    this.css("-webkit-transition","background 0.5s");
			if($(document).scrollTop() >= ($(this).position().top - $(window).height()) + $(this).outerHeight()*0.5 && 
			   $(document).scrollTop() <= ($(this).position().top + $(window).height()) - $(this).outerHeight()*0.5)
			{ $(this).addClass(whatclass);	}
			else
			{ $(this).removeClass(whatclass); }
	};

$.fn.gridSet = function(howMany){
	var x = 1;
	$(this).html('<div class="gridhline"></div><div class="gridvline"></div>');
	for(x=1;x<=howMany;x++)
	{$(this).append("<i class='grid'></i>");}
	};

$.fn.gridProperty = function (timein,timeout,day,subject,fsubject,cys,prof,profnick,room,froom,sccode,theme,about,profinfo){
	theme = theme || 'blue';
	about = about || 'No information with this subject yet.';
	profinfo = profinfo || 'Anonymous';
	var arr_time = ['7:00am','8:00am','9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm',
						  '3:00pm','4:00pm','5:00pm','6:00pm','7:00pm','8:00pm','9:00pm'];
	var arr_day = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
	var arr_theme = ['red','pink','purple','deep purple','indigo','blue','light blue',
				'cyan','teal','green','light green','lime','yellow','amber','orange','deep orange'];
	/////////////////////////////////////////////////////////////////////////////////
	var timeinpos = arr_time.indexOf(timein.toLowerCase()),
		timeoutpos = arr_time.indexOf(timeout.toLowerCase()), 
		daypos = arr_day.indexOf(day.toLowerCase()),
		tema = arr_theme.indexOf(theme.toLowerCase()),
		gridheight_min = 50, 		gridtop_min = 50,		gridleft_min = 14.28,
		thdark = 'prmtxt_w',		thlight = 'prmtxt_b',		timelength = 0,
		thmtxt = null,				thactxt = null,			thmain = null,
		thaccent = null,		thsubtle = null;
	/////////////////////////////////////////////////////////////////////////////////
	if( timeoutpos !== -1 && timeinpos !== -1 ){
	timelength = timeoutpos - timeinpos;	
	$(this).css("top",timeinpos*gridtop_min);
	$(this).css("height",timelength*gridheight_min);
	}
	else{ alert('Wrong time parameter:\n' + timein + '\n' + timeout); }
	/////////////////////////////////////////////////////////////////////////////////
	if(daypos !== -1){
	$(this).css("left",daypos*gridleft_min +"%");
		}
	else{ alert('Wrong day parameter:\n' + day); }
	/////////////////////////////////////////////////////////////////////////////////
	if(tema !== -1)
	{
			if(tema === 0) { //red
				thmain='#F44336'; 	//500
				thaccent='#D32F2F'; //700
				thsubtle='#E57373'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt

				}
			else if(tema === 1) { //pink
				thmain='#E91E63'; 	//500
				thaccent='#C2185B'; //700
				thsubtle='#F48FB1'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 2) { //purple
				thmain='#9C27B0'; 	//500
				thaccent='#7B1FA2'; //700
				thsubtle='#CE93D8'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 3) { //deep purple
				thmain='#673AB7'; 	//500
				thaccent='#512DA8'; //700
				thsubtle='#B39DDB'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 4) { //indigo
				thmain='#3F51B5'; 	//500
				thaccent='#303F9F'; //700
				thsubtle='#9FA8DA'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 5) { //blue
				thmain='#2196F3'; 	//500
				thaccent='#1976D2'; //700
				thsubtle='#90CAF9'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 6) { //light blue
				thmain='#03A9F4'; 	//500
				thaccent='#0288D1'; //700
				thsubtle='#81D4FA'; //200
				thmtxt = thlight;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 7) { //cyan
				thmain='#00BCD4'; 	//500
				thaccent='#0097A7'; //700
				thsubtle='#80DEEA'; //200
				thmtxt = thlight;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 8) { //teal
				thmain='#009688'; 	//500
				thaccent='#00796B'; //700
				thsubtle='#80CBC4'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 9) { //green
				thmain='#4CAF50'; 	//500
				thaccent='#388E3C'; //700
				thsubtle='#A5D6A7'; //200
				thmtxt = thlight;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 10) { //light green
				thmain='#8BC34A'; 	//500
				thaccent='#689F38'; //700
				thsubtle='#C5E1A5'; //200
				thmtxt = thlight;	//main txt
				thactxt = thdark;	//accent txt
				}
			else if(tema === 11) { //lime
				thmain='#CDDC39'; 	//500
				thaccent='#AFB42B'; //700
				thsubtle='#E6EE9C'; //200
				thmtxt = thlight;	//main txt
				thactxt = thlight;	//accent txt
				}
			else if(tema === 12) { //yellow
				thmain='#FFEB3B'; 	//500
				thaccent='#FBC02D'; //700
				thsubtle='#FFF59D'; //200
				thmtxt = thlight;	//main txt
				thactxt = thlight;	//accent txt
				}
			else if(tema === 13) { //amber
				thmain='#FFC107'; 	//500
				thaccent='#FFA000'; //700
				thsubtle='#FFE082'; //200
				thmtxt = thlight;	//main txt
				thactxt = thlight;	//accent txt
				}
			else if(tema === 14) { //orange
				thmain='#FF9800'; 	//500
				thaccent='#F57C00'; //700
				thsubtle='#FFCC80'; //200
				thmtxt = thlight;	//main txt
				thactxt = thlight;	//accent txt
				}
			else if(tema === 15) { //deep orange
				thmain='#FF5722'; 	//500
				thaccent='#E64A19'; //700
				thsubtle='#FFCC80'; //200
				thmtxt = thdark;	//main txt
				thactxt = thdark;	//accent txt
				}

		$(this).css('background',thmain).addClass(thmtxt);

}
	else{ alert('Wrong theme parameter:\n' + theme);}
	/////////////////////////////////////////////////////////////////////////////////
	var toggle = 0;
	$(this).on('click',function(){
		toggle += 1;		var onf = toggle%2;
		if(onf!== 0)	{ global_grid_selected = $(this).index() - 1; GLOBAL_sc_selected = sccode; $(this).attr('name','Selected');	colorToggle(); }
		else	{	$(this).removeAttr('name');		nocolorToggle(); }
		$('.ssgci-true-header').slideToggle(500);
		});
	/////////////////////////////////////////////////////////////////////////////////		
		function nocolorToggle(){
		$('.grid[name!=Selected]').fadeIn(200);
		$('.gridhline, .gridvline').fadeOut(500);
		$('#ssg-subj-info, #ssg-prof-info, #ssg-grid-option').addClass('infoflyup').removeClass('infoflydown');
		setTimeout(function(){$('#ssg-subj-info, #ssg-prof-info, #ssg-grid-option').hide();},200);
		$('.time-v ul li, .day-h ul li').removeAttr('style').attr('class','');
			}
		function colorToggle()
		{
		$('.gridhline, .gridvline').fadeIn(200);
		$('.grid[name!=Selected]').fadeOut(200);
		$('.subjct').text(subject);		$('.subjt').text(fsubject);
		$('#ssgci-time').text(timein + " - " + timeout);
		$('#ssgci-day').text(day.toUpperCase()); $('#ssgci-room').text('['+room.toUpperCase() +'] '+ froom.toUpperCase());
		$('.ssgci-true-header').css('background',thmain).attr('class','ssgci-true-header '+thmtxt);
		$('#ssg-subj-info').css('background',thaccent).attr('class','ssg-info-con con-50-l con-100-s '+thactxt).show().addClass('infoflydown').removeClass('infoflyup');
		$('#ssg-subj-info h3').html("["+subject+"] " + fsubject);
		$('#ssg-subj-info p').html(about);
		$('.ssg-profname').html(prof);
		$('.ssgo-color').css('background',thmain);
		setTimeout(function(){$('#ssg-prof-info').show().addClass('infoflydown').removeClass('infoflyup');},200);
		setTimeout(function(){$('#ssg-grid-option').show().addClass('infoflydown').removeClass('infoflyup');},400);
		$('.gridhline').css("top",timeinpos*gridtop_min);
		$('.gridhline').css("height",timelength*gridheight_min);
		$('.gridvline').css("left",daypos*gridleft_min +"%");
		$('.gridhline').css({'border-top':thmain+' 1px solid','border-bottom':thmain+' 1px solid'});
		$('.gridvline').css({'border-left':thmain+' 1px solid','border-right':thmain+' 1px solid'});
		var s = 0;
		for(s = timeinpos+1; s < timeoutpos+1; s++){
			if(s === timeinpos+1)
			{	$('.time-left ul li:nth-child('+s+')').css('background',thaccent).addClass(thactxt); 
				$('.time-right ul li:nth-child('+s+')').css('background',thsubtle).addClass('prmtxt_b'); 
				}
			else if(s === timeoutpos)
			{	$('.time-right ul li:nth-child('+s+')').css('background',thaccent).addClass(thactxt);
				$('.time-left ul li:nth-child('+s+')').css('background',thsubtle).addClass('prmtxt_b');}
			else
			{ $('.time-v ul li:nth-child('+s+')').css('background',thsubtle).addClass('prmtxt_b'); }
			}
			var dayposi = daypos + 2; $('.day-h ul li:nth-child('+dayposi+')').css('background',thaccent).addClass(thactxt);
		}
$(this).html('<span class="ghide1"><h2><b>'+subject+'</b></h2><p>'+cys+'</p></span><span class="ghide2" hidden="true"><h2><b>'+profnick+'</b></h2><p>'+room+'</p></span>');
	};
$.fn.roomPlotting = function(roomname,thisfloor,status,spclass,override){
	override = override || null;
	spclass = spclass || null;
	var currentIndex = $(this).index() + 1,
		room = roomname.split(','),
		flour = thisfloor.split(','),
		roomstatuscolor;
	$(this).removeAttr('style');
	if(GLOBAL_floor_selected == flour[0])
	{
	$('.room' + flour[1] + 'side .room:nth-of-type('+currentIndex+') .room-name').html(''+room[0]+'<b>'+room[1]+'</b>');
	$('.room' + flour[1] + 'side .room:nth-of-type('+currentIndex+') .room-status').html(status);
	$('.room' + flour[1] + 'side .room:nth-of-type('+currentIndex+')').addClass(spclass);
	statuseses(status);
	$('.room' + flour[1] + 'side .room:nth-of-type('+currentIndex+')').css('background',roomstatuscolor);
	}
	else
	{
	$('.room' + flour[1] + 'side .room:nth-of-type('+currentIndex+') .room-name').html('<b>Walang<br>Pasok</b>');
		}

	function statuseses(thistatus){
		var statuses = ['n/a','occupied','vacant','upnext','event','special'];
		var st = thistatus.toLowerCase();

		if(st === statuses[0])
		{ roomstatuscolor = '#F44336';}
		else if(st === statuses[1])
		{ roomstatuscolor = '#43A047';}
		else if(st === statuses[2])
		{roomstatuscolor = '#039BE5';}
		else if(st === statuses[3])
		{ roomstatuscolor = '#009688';}
		else if(st === statuses[4])
		{ roomstatuscolor = '#EF6C00';}
		else if(st === statuses[5])
		{ roomstatuscolor = '#9C27B0';}
		else
		{ $(this).removeAttr('style');}
		}
	};

$.fn.tableSet = function(up_table_setting,setdaw){
			setdaw = setdaw || "norm";
			var p_set = [], set = [],x = 0, y = 0,
			tabledata, tabling
			;
			$(this).html("");
			p_set = up_table_setting.split('`');
			for(x=0; x<p_set.length-1; x++)
			{
			GLOBAL_prof_set[x] = p_set[x];
			set = p_set[x].split('|');
			for(y = 0;y < set.length; y++)
			{
			if(setdaw === "norm"&&set[y]!==null)
					{tabledata += "<td>"+set[y]+"</td>";}
			else if(setdaw ==="proftable"&&set[y]!==null)
					{
				tabledata = "<td>"+set[0]+"</td><td><b>"+set[1]+"</b><br> " +set[2]+ "</td><td>"+set[3]+"<br>"+set[4]+"-"+set[5]+ "</td><td>"+set[6]+"</td><td>"+set[7]+"</td><td>"+set[8]+"</td><td>"+set[9]+"</td>";
					}
			else if(setdaw === "bbf"&& GLOBAL_menu === 1)
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td><td>"+
			set[3]+"</td><td>"+
			set[4]+"</td><td>"+
			set[5]+"</td><td>"+
			set[6]+"</td><td>"+
			set[7]+"</td><td>"+
			set[8]+"</td><td>"+
			set[9]+"</td><td>"+
			set[10]+"</td><td>"+
			set[11]+"</td>";	
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 2)
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td><td>"+
			set[3]+"</td><td>"+
			set[4]+"</td>";
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 3)
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td><td>"+
			set[3]+"</td><td>"+
			set[4]+"</td><td>"+
			set[5]+"</td><td>"+
			set[6]+"</td>";
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 4)
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td><td>"+
			set[3]+"</td><td>"+
			set[4]+"</td><td>"+
			set[5]+"</td><td>"+
			set[6]+"</td><td>"+
			set[7]+"</td>";
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 5)
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td><td>"+
			set[3]+"</td><td>"+
			set[4]+"</td><td>"+
			set[5]+"</td><td>"+
			set[6]+"</td><td>"+
			set[7]+"</td><td>"+
			set[8]+"</td>";
				}
			else if(setdaw === "sch"&&(GLOBAL_menu === 1||GLOBAL_menu === 2))
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td>";
				}
			else if(setdaw === "sch"&&GLOBAL_menu === 3)
			{
			tabledata = "<td>"+
			set[0]+"</td><td>"+
			set[1]+"</td><td>"+
			set[2]+"</td><td>"+
			set[3]+"</td><td>"+
			set[4]+"</td><td>"+
			set[5]+"</td><td>"+
			set[6]+"</td><td>"+
			set[7]+"</td>";
				}
			else{break;}
			}
			tabling += "<tr><td>"+(x+1)+"</td>" + tabledata + "</tr>";
		}		
			if(setdaw === "proftable")
			{
			$(this).append('<tr><th>ID</th><th>SCode</th><th>Description</th><th>Course</th><th>Room</th><th>Day</th><th>Time-in</th><th>Time-out</th></tr>' + tabling);}
			else if(setdaw === "bbf"&& GLOBAL_menu === 1)
			{
			$(this).append('<tr><th>ID</th><th>Room Code</th><th>Room Name</th><th>Room Floor</th><th>Room Side</th><th>Room Status</th><th>Professor</th><th>SCode</th><th>Description</th><th>CYS</th><th>Day</th><th>Time in</th><th>Time Out</th></tr>' + tabling);
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 2)
			{
			$(this).append('<tr><th>ID</th><th>Room Code</th><th>Room Name</th><th>Room Floor</th><th>Room Side</th><th>Room Status</th></tr>' + tabling);
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 3)
			{
			$(this).append('<tr><th>ID</th><th>Room Code</th><th>Room Name</th><th>SCode</th><th>Description</th><th>Day</th><th>Time in</th><th>Time Out</th></tr>' + tabling);
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 4)
			{
			$(this).append('<tr><th>ID</th><th>Room Code</th><th>Room Name</th><th>SCode</th><th>Description</th><th>CYS</th><th>Day</th><th>Time in</th><th>Time Out</th></tr>' + tabling);
				}
			else if(setdaw === "bbf"&& GLOBAL_menu === 5)
			{
			$(this).append('<tr><th>ID</th><th>Room Code</th><th>Room Name</th><th>Professor</th><th>SCode</th><th>Description</th><th>CYS</th><th>Day</th><th>Time in</th><th>Time Out</th></tr>' + tabling);
				}
			else if(setdaw === "sch"&&(GLOBAL_menu === 1||GLOBAL_menu === 2))
			{
			$(this).append('<tr><th>ID</th><th>Schedule<br>Code</th><th>Description</th><th>CYS</th></tr>' + tabling);
				}
			else if(setdaw === "sch"&&GLOBAL_menu === 3)
			{
			$(this).append('<tr><th>ID</th><th>Schedule<br>Code</th><th>Description</th><th>CYS</th><th>Professor</th><th>Room Code</th><th>Day</th><th>Time in</th><th>Time Out</th></tr>' + tabling);
				}


			$('.sched-table tr').on('click',function(){
			if(GLOBAL_open_sc_del === true)
			{
			$('.delsched').val($(this).index());
				}
			else if(GLOBAL_open_sc_edit === true)
			{
			var e_r = $('.sched-table tr:nth-of-type('+($(this).index() + 1)+') td:nth-child(5)').text(),
				e_d = $('.sched-table tr:nth-of-type('+($(this).index() + 1)+') td:nth-child(6)').text(),
				e_ti = $('.sched-table tr:nth-of-type('+($(this).index() + 1)+') td:nth-child(7)').text(),
				e_to = $('.sched-table tr:nth-of-type('+($(this).index() + 1)+') td:nth-child(8)').text();
				
			$('.editsched').val($(this).index());
			$('#prof-edit-room').val(e_r);
			$('#prof-edit-subj-day').val(e_d);
			$('#prof-edit-subj-timein').val(e_ti);
			$('#prof-edit-subj-timeout').val(e_to);
				}
			else
			{
			$('.editsched, .delsched').val(null);
				}
			});
			return GLOBAL_prof_set;		

};
