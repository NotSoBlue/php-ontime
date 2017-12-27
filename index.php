<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'onTime/oT-Homepage-Navbar.php'; 
$site = "home";
$user = $_SESSION['session_user'];
$type = $_SESSION['session_type'];
if(!isset($_SESSION['session_user'])&&!isset($_SESSION['session_type']))
{
$name = "Guest";
$type = "none";
	}
else
{
$name = $_SESSION['session_nickname'];
$type = $_SESSION['session_type'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>UCC onTime</title>
</head>
<link href='css/typography.css' rel='stylesheet' type='text/css'>
<link href='css/navbar.css' rel='stylesheet' type='text/css'>
<link href='css/assorted.css' rel='stylesheet' type='text/css'>
<link href='css/responsive.css' rel='stylesheet' type='text/css'>
<script src='js/jquery-2.1.4.min.js'> </script>
<script src='js/asynctime.js'> </script>
<script src='js/navbar.js'> </script>
<script src='js/responsive.js'> </script>
<script>
$(function(){
	$('body').css('background-color','#F9F9F9');
	$(window).on('scroll', function(){
		var wwidth = $(window).width();
		var wheight = $(window).height();
		var nbarheight = $('.nav_main').outerHeight();
		if($(document).scrollTop() >= ($('.quickjump').position().top - wheight) + $('.quickjump').outerHeight()*0.5){
		if(wwidth >= 1280)
		{
		$('.qjc2 i:nth-child(1)').addClass('flyin');
		setTimeout(function(){$('.qjc1 i:nth-child(2), .qjc2 i:nth-child(2)').addClass('flyin');},100);
		setTimeout(function(){$('.qjc1 i:nth-child(1), .qjc2 i:nth-child(3)').addClass('flyin');},200);
			}
		else
		{
		$('.qjc1').addClass('flyin'); setTimeout(function(){$('.qjc2').addClass('flyin');},200);
			}
		}
		else{$('.qjc1 i, .qjc2 i, .qj-content').removeClass('flyin');
		}
/*		if(wwidth >= 1280)
		{
		$('.table-of-contents').onView('light-bdrop');
		$('.quickjump').onView('light-bdrop');
		$('.ra-mini').onView('light-bdrop');
		$('.req-mini').onView('light-bdrop');
		$('.rav').onView('light-bdrop');
		$('body').css('background-color','#DFDFDF');
		}
		else
		{
		$('body').css('background-color','#F9F9F9');
			}*/
		if($(document).scrollTop() >= ($('.rav').position().top - wheight) + $('.rav').outerHeight()*0.5)
		{		$('.nav_main').addClass('nav-very-dark').removeClass('navdark');	}
		else
		{		$('.nav_main').addClass('nav-very-dark').removeClass('nav-very-dark');	}
		
		});	
	});
</script>
<body>
<!-- Nav bar starto --> 
<?php echo navbar($site,$name,$name); ?> 
<!-- Lotus Starto -->
<?php echo lotus(); ?> 
<!-- Lotus Endo --> 
<!-- Nav bar Endo --> 
<!-- Content Starto -->
<!--<div class="main-con">
<div class="secon">
<div class="table-of-contents"> 
<div class="toc-title teal-header"> 
<h2> University of Calooocan City</h2>
<h1> <b>onTime</b> (Schedule Organizer)</h1>
<div class="toc-list">
<ul> 
<li>Quick Jump</li>
<li>Recent Activities</li>
<li>Requests and Approvals</li>
<li>Room Availability</li>
<li>End of the Page</li>
</ul>
</div>
</div>
</div>
<div class="quickjump teal-header"> 
<div class="qj-title"> <center><h1><b>Quick Jump</b></h1></center></div>
<center>
<div id="qj-id"> </div>
<div class="qj-content qjc1">
<i>
<div> <div class="w_bblock"> </div> </div>
<p>Building<br>Block</p>
</i>
<i>
<div> <div class="w_scgrid"> </div> </div>
<p>Schedule<br>Grid</p>
</i>
</div>
<div class="qj-content qjc2">
<i>
<div><div class="w_RA"> </div></div>
<p>Recent<br>Activities</p>
</i>
<i>
<div><div class="w_request"> </div></div>
<p>Requests &amp;<br>Approvals</p>
</i>
<i>
<div><div class="w_accset"> </div></div>
<p>Account<br>Manager</p>
</i>
</div>
</center>
</div>

<div class="ra-mini"> 
<div class="ram-title">
<h1 class="teal-header"><b>Recent Activities</b></h1>

<div class="divider"> </div>
<p class="scndtext_b">For more details, go to main page of Recent Activities</p>
</div>
<div class="ram-content">
</div>
</div>

<div class="req-mini"> 
<div class="req-title">
<h1 class="teal-header"><b>Requests and Approvals</b></h1>
<div class="divider"> </div>
<p class="scndtext_b">For complete updates, go to main page of Requests and Approvals</p>
</div>
<div class="req-content">
</div>
</div>
<div class="rav">
<div class="rav-title">
<h1 class="teal-header"><b>Room Availability</b></h1>
<div class="divider"> </div>
<p class="scndtext_b">For full functionality, go to Building Block</p>
<div class="rav-content">
<div class="rav-c-btable"> </div>
<div class="rav-c-bvisual"> </div>
</div>
</div>
</div>
</div>
</div>
-->
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
body
{
background-color: #DFDFDF;
	}
.quickjump
{
width: 100%;
padding: 150px 0px 150px 0px;
height: auto;
	}
#qj-id
{
	height: 50px;
	width: 100%;
}
.qj-title
{
width: 100%;
	}
.qj-content i
{
display: inline-block;
margin: 0px 20px 0px 20px;
-webkit-transition: 0.5s;
	}
.qj-content i > div
{
background: #009587;
border-radius: 50%;
height: 200px;
width: 200px;
margin-bottom: 10px;
display: flex;
align-items:center;
justify-content:center;
box-sizing: content-box;
-webkit-transition: 0.2s;
cursor: pointer;
	}
.qj-content i > div:hover
{
background: #26A599;
-webkit-transform: translateY(-20px);
	}
.qj-content i > div > div
{
	height: 50px;
	width: 50px;
	background-position: center !important;
	background-size: contain !important;
	background-repeat: no-repeat !important;
	}
.qj-content i p
{
text-align: center;
	}
.flyin
{
-webkit-animation: up 0.5s cubic-bezier(0.4, 0, 0.2, 1);
opacity: 1 !important;
	}
.ra-mini, .req-mini, .rav
{
height: auto;
width: 100%;
padding: 50px 50px 50px 50px;
box-sizing:border-box;
	}
.ram-title p{ font-size: 18px;}

.ram-content, .req-content{
margin-top: 30px;
border: #00685C 3px solid;
height: 450px;
width: 100%;
box-shadow: -3px 6px 30px rgba(0,0,0,0.50);
	}
.rav-content
{
margin-top: 30px;
width: 100%;
height: auto;
background: #424242;
border-top: #606060 2px solid;
border-bottom: #202020 2px solid;
box-shadow: -3px 6px 30px rgba(0,0,0,0.50);
padding: 20px;
box-sizing:border-box;
overflow: hidden;
	}
.rav-c-btable, .rav-c-bvisual
{
background: #DFDFDF;
box-shadow: -1px 3px 10px rgba(0,0,0,0.50);
	}
.rav-c-btable{
	
	}
.rav-c-bvisual{
	
	}
.light-bdrop
{
	background: #F9F9F9 !important;
	}

@-webkit-keyframes up
{
0%{ -webkit-transform: translateY(100px); opacity: 0;}
100%{ -webkit-transform: translateY(0px); opacity: 1;}
}
</style>
</html>	