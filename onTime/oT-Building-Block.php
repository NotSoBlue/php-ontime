<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'oT-Homepage+Navbar.php'; 
$site = "building-block";
$user = $_SESSION['session_user'];
$name = "Building Block";
if(!isset($_SESSION['session_user'])&&!isset($_SESSION['session_type']))
{
$type = "none";
	}
else
{
$type = $_SESSION['session_type'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $name;?> - onTime</title>
</head>
<link href='../css/typography.css' rel='stylesheet' type='text/css'>
<link href='../css/navbar.css' rel='stylesheet' type='text/css'>
<link href='../css/assorted.css' rel='stylesheet' type='text/css'>
<link href='../css/responsive.css' rel='stylesheet' type='text/css'>
<script src='../js/jquery-2.1.4.min.js'> </script>
<script src='../js/asynctime.js'> </script>
<script src='../js/navbar.js'> </script>
<script src='../js/responsive.js'> </script>
<script>
//bbflc-menu
function update_bb_content(){
	$.ajax({
		type:'get',
		url:"oT-core.php?form_type=bbf_table&bbf_menu=all",
		complete: function(e){
			GLOBAL_menu = 1;
			$('#filtable').tableSet(e.responseText,'bbf');
			}		
		});
		}
$(function(){
	update_bb_content();
	$('.bbflc-menu li').on('click',function(){
		var selected = $(this).index() + 1;
		var rawr = ['all','room','subject','course','prof'];
		$('.bbflc-menu li').each(function(index, element) {
            if($(this).is(':nth-child('+selected+')'))
						{
						$(this).addClass('menuselecteddark');
						$.ajax({
						type:'get',
						url:"oT-core.php?form_type=bbf_table&bbf_menu="+rawr[$(this).index()],
						complete: function(e){
						GLOBAL_menu = selected;
						$('#filtable').tableSet(e.responseText,'bbf');
					}		
						});
						}
					else
					{	$(this).removeClass('menuselecteddark');	}
	});});	
	$('.bb-floor li').on('click',function(){
		var selected = $(this).index() + 1,
			floorname = ['Floor 1','Floor 2','Floor 3','Floor 4','Floor 5','Admin BLDG','Special Rooms'];
		$('.bb-floor li').each(function(index, element) {
            if($(this).is(':nth-child('+selected+')'))
					{	$(this).addClass('menuselecteddark');
						GLOBAL_floor_selected = selected;
						$('.room-animate i').removeAttr('class');
						if(GLOBAL_floor_selected>GLOBAL_floor_selected_vs_prev)
						{						
						$('.room-animate').show();	$('.room-animate i').addClass('floor-up').text(floorname[$(this).index()]);
						setTimeout(function(){roomSet();},500);
						setTimeout(function(){$('.room-animate').hide();},1000);
							}
						else if(GLOBAL_floor_selected<GLOBAL_floor_selected_vs_prev)
						{
						$('.room-animate').show(); 	$('.room-animate i').addClass('floor-down').text(floorname[$(this).index()]);
						setTimeout(function(){roomSet();},500);
						setTimeout(function(){$('.room-animate').hide();},1000);
							}
						else
						{
						$('.room-animate').hide();
							}
						GLOBAL_floor_selected_vs_prev = GLOBAL_floor_selected;
					}
					else
					{	$(this).removeClass('menuselecteddark');	}
	});});
	$('#bbflc-search').on('keyup',function(){
		var arr_menu = ['all','room','subject','course','prof'];
		$.ajax({
		type:'get',
		url:"oT-core.php?form_type=bbf_search&bbf_menu="+arr_menu[GLOBAL_menu-1]+"&serts="+$(this).val(),
		complete: function(e){
			$('#filtable').tableSet(e.responseText,'bbf');

			}		
		});
		});

	function roomSet(){
		$.ajax({
			type: 'get',
			url:"oT-core.php?form_type=populate_room",
			complete: function(e){
				//alert(e.responseText);
				}
			});
		$('.room:nth-child(6)').roomPlotting('III-30<br>,Im left','1,left','N/A');
		$('.room:nth-child(6)').roomPlotting('III-30<br>,Im not','3,left','Occupied');
		$('.room:nth-of-type(2)').roomPlotting('III-30<br>,Hey','5,right','Vacant');
		}
	roomSet();
	$('.toc-list ul li:nth-child(1)').on('click',function(){ $('.bb-filter-container').get(0).scrollIntoView();});
	});
</script>
<body>
<!-- Nav bar starto --> 
<?php echo navbar($site,$name); ?> 
<!-- Lotus Starto -->
<?php echo lotus(); ?> 
<!-- Lotus Endo --> 
<!-- Nav bar Endo --> 
<!-- Content Starto -->

<div class="main-con">
<div class="secon">

<div class="table-of-contents"> 
<div class="toc-title teal-header"> 
<h2>You can see room statuses based on subject schedule,<wbr> events and more  in this section</h2>
<div class="toc-list">
<ul> 
<li>Filter Lists</li>
<li>Floor Setting</li>
<li>Room Information Panel</li>
<li>End of the Page</li>
</ul>
</div>
</div>
</div>

<div class="bb-filter-container">
<h1 class="teal-header"><b>Filter List</b></h1>
<div class="bb-f-list-con">
<div class="bbfl-control prmtxt_w">
<ul class="bbflc-menu"> <li class="menuselecteddark">All</li><li>Room</li><li>+Subject</li><li>+Course</li><li>+Professor</li></ul>
</div>
<div class="filter-table-con prmtxt-w">
<table id="filtable">
</table>
</div>
<div class="bbfl-search prmtxt_w">
<i></i><input type="search" id="bbflc-search" placeholder="Search">
</div>

</div>

</div>

<div class="bb-container">

<h1 class="teal-header"><b>Floor Setting</b></h1>

<div class="bb-floor-con prmtxt_w">
<ul class="bb-floor"> <li class="menuselecteddark">1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>AB</li><li>SP</li></ul>
</div>

<div class="room-container">

<div class="room-container-zoom prmtxt_w">


<table class="room-container-grid">
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
</table>
<table class="hagdan-en">
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
</table>
<table class="hagdan-ex">
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
</table>
<div class="roomleftside">
<div class="room sroom">
<span class="room-name"><b>Hagdan</b></span>
<br>
- <span class="room-status">OK</span> -
</div>

<div class="room">
<span class="room-name">III-24<br><b>LECRM I</b></span>
<br>
- <span class="room-status">N/A</span> -
</div>

<div class="room">
<span class="room-name">III-26<br><b>LECRM II</b></span>
<br>
- <span class="room-status">Occupied</span> -
</div>

<div class="room">

<span class="room-name">III-28<br><b>PASOA I</b></span>
<br>
- <span class="room-status">Vacant</span> -
</div>

<div class="room">
<span class="room-name">III-30<br><b>PASOA II</b></span>
<br>
- <span class="room-status">Up Next</span> -
</div>

<div class="room">
<span class="room-name">III-32<br><b>PASOA III</b></span>
<br>
- <span class="room-status">Event</span> -
</div>

<div class="room">
<span class="room-name">III-33<br><b>HR Dept.</b></span>
<br>
- <span class="room-status">Off</span> -
</div>

<div class="room sroom">
<span class="room-name"><b>CR</b></span>
<br>
- <span class="room-status">Ok</span> -
</div>

</div>

<!-- ---------------- -->

<div class="roomrightside">

<div class="room sroom">
<span class="room-name"><b>Elevator</b></span>
<br>
- <span class="room-status">OK</span> -
</div>

<div class="room">
<span class="room-name">III-23<br><b>CL4</b></span>
<br>
- <span class="room-status">N/A</span> -
</div>

<div class="room">
<span class="room-name">III-25<br><b>CL3</b></span>
<br>
- <span class="room-status">Occupied</span> -
</div>

<div class="room">
<span class="room-name">III-27<br><b>CL2</b></span>
<br>
- <span class="room-status">Vacant</span> -
</div>

<div class="room">
<span class="room-name">III-29<br><b>CL1</b></span>
<br>
- <span class="room-status">Up Next</span> -
</div>

<div class="room">
<span class="room-name">III-31<br><b>MIS</b></span>
<br>
- <span class="room-status">Special</span> -
</div>

<div class="room sroom">
<span class="room-name"><b>Bodega</b></span>
<br>
- <span class="room-status">Off</span> -
</div>

<div class="room sproom">
<span class="room-name"><b>CR</b></span>
<br>
- <span class="room-status">Ok</span> -
</div>
</div>
<div class="room-animate">
<i>Yow</i>
</div>

</div></div>
</div>

</div></div>

<?php echo footer(); ?>
<!-- Content Endo -->
<!-- Side bar Starto --> 
<?php echo sidebar($site,$type); ?> 
<!-- Side bar Endo -->
<!-- Modal Starto -->
<?php echo modal(); ?>
<!-- Modal Endo -->
</body>
<style>
*{
margin: 0px;
padding: 0px;
box-sizing: border-box;
	}

.bb-filter-container
{
width: 100%;
padding: 50px;
overflow: hidden;
	}
.bb-f-list-con
{
	position:relative;
	width:100%;
	height: 500px;
	background:#212121;
	box-shadow: 0px 6px 30px rgba(0,0,0,0.50);
	margin-top: 50px;
	overflow:hidden;
	}
.bbfl-control ul li:hover
{
	background: #424242;
	}
.bbfl-control ul li:active
{
	background: #606060;
	}
.bbfl-search input[type="search"]
{
	padding-left: 15px;
	color:rgba(255,255,255,1.00);
	font-size:18px;
	border-bottom: 1px solid rgba(255,255,255,1.00);
	width: 40%;
	}
.bbfl-search input[type="button"]
{
	width: 150px;
	height: 100%;
	color: #80CBC4;
	font-size:18px;
	-webkit-transition: 0.2s;
	}
.bbfl-search input[type="button"]:hover{
	background: #424242;
	}
.bbfl-search input[type="button"]:active{
	background: #606060;
	}

#bbfl-asc
{
	margin-left:auto;
	}
.bbfl-search input[type="search"]:-webkit-input-placeholder
{
	color: #fff;
	}
.bbfl-search input[type="search"]:focus
{
	border-bottom: 2px solid rgba(255,255,255,1.00)
	}
.bbfl-search i
{
	height: 30px; width: 30px;
	margin-right: 10px;
	background: url(../icons/search-w.png);
	background-size: contain;	background-repeat: no-repeat;	background-position: center;
	}
.bbfl-search i::before
{
	}
.menuselecteddark
{
	background: #606060;
	}
.menuselecteddark:hover
{
	background: #606060 !important;
	}
.bb-container
{
	padding: 50px;
	width:100%;
	position: relative;
	}
@media all and (min-width: 1280px)
{
.bbfl-control ul li
{
	width: 20%;
	padding: 10px 10px 10px 25px;
	display:inline-block;
	float:left;
	font-size: 24px;
	-webkit-transition: 0.2s;
	-webkit-user-select:none;
	cursor: pointer;
	}
.bbfl-control
{
	position:absolute;
	top: 0px; left: 0px;
	width: 100%;
	border-bottom: 1px solid rgba(255,255,255,0.12);
	}
.bbfl-search 
{
	position:absolute;
	bottom: 0px; left:0px;
	padding-left: 25px;
	width: 100%;
	display:flex;
	align-items:center;
	height: 50px;
	overflow:hidden;
	border-top: 1px solid rgba(255,255,255,0.12);
	}
}
@media all and (max-width: 1279px)
{
.bbfl-control ul li
{
	width: 100%;
	padding: 10px 10px 10px 25px;
	display: block;
	float:left;
	font-size: 24px;
	-webkit-transition: 0.2s;
	-webkit-user-select:none;
	cursor: pointer;
	}
.bbfl-control
{
	position:relative;
	top: 0px; left: 0px;
	width: 30%; height: 100%;
	border-right: 1px solid rgba(255,255,255,0.12);
	}
.bbfl-search 
{
	position:absolute;
	bottom: 0px; left:30%;
	padding-left: 25px;
	width: 70%;
	display:flex;
	align-items:center;
	height: 50px;
	overflow:hidden;
	border-top: 1px solid rgba(255,255,255,0.12);
	}
}
.bb-floor-con
{
	width: 100%;
	height: 50px;
	overflow:hidden;
	background: #212121;
	border-bottom:1px solid rgba(255,255,255,0.12);
	}
.bb-floor-con ul li
{
	width: 50px;
	height: 50px;
	display:inline-block;
	float:left;
	padding-top: 10px;
	font-size: 24px;
	text-align:center;
	-webkit-transition: 0.2s;
	-webkit-user-select:none;
	cursor: pointer;
	}
.room_animate
{
	position:absolute;
	top: 0px; left: 0px;
	z-index: 999999;
	height: 100%;
	width: 100%;
	overflow:hidden;
	}
.room-animate i
{
position:absolute;
top: 0px; left: 0px;
background: #009688;
font-family: Segoe UI;
font-size: 72px;
display:flex;
justify-content:center;
align-items:center;
height: 100%;
width: 100%;

	}
.floor-up
{
	-webkit-animation: goUp 1s cubic-bezier(0.4, 0, 0.2, 1);
	}
.floor-down
{
	-webkit-animation: goDown 1s cubic-bezier(0.4, 0, 0.2, 1);
	}
@-webkit-keyframes goUp
{
0%{	-webkit-transform: translateY(100%); }
30%{	-webkit-transform: translateY(0%); }
60%{	-webkit-transform: translateY(0%); }
100%{	-webkit-transform: translateY(-100%); }
	}
@-webkit-keyframes goDown
{
0%{	-webkit-transform: translateY(-100%); }
30%{	-webkit-transform: translateY(0%); }
60%{	-webkit-transform: translateY(0%); }
100%{	-webkit-transform: translateY(100%); }	}
</style>
</html>
