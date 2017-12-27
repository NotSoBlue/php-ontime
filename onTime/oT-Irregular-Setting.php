<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'oT-Homepage+Navbar.php'; 
$site = "irregular-setting";
$user = $_SESSION['session_user'];
$name = "Irregular Setting";
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
<link href="../css/assortedv2.css" rel="stylesheet" type="text/css">
<script src='../js/jquery-2.1.4.min.js'> </script>
<script src='../js/asynctime.js'> </script>
<script src='../js/navbar.js'> </script>
<script src='../js/responsive.js'> </script>
<script> 
$(function(){
	$('.heregoesthegrid').gridSet(5);
	$('.grid:nth-of-type(1)').gridProperty('10:00am','1:00pm','tuesday','RES001','Introduction to Research','BSCS-3B','Emilia T. Caisip','Caisip','adminblg2','cyan');
	$('.grid:nth-of-type(2)').gridProperty('7:00am','12:00pm','friday','CS321','Dynamic Web Programming','BSCS-3B','Jesus Dela Cruz','Jess','CL2','teal');
	$('.grid:nth-of-type(3)').gridProperty('4:00pm','7:00pm','wednesday','ENTREP','Entreprenuership','BSCS-3B','Ma&apos;am Zayde','Zayde','IV-30','indigo');
	$('.grid:nth-of-type(4)').gridProperty('11:00am','1:00pm','wednesday','PE001','Physical Fitness and Exorcism','BSCS-1B','Ma&apos;am Lapis','Pencil','Court','red');
	$('.grid:nth-of-type(5)').gridProperty('10:00am','3:00pm','thursday','CS221','Computer Programming II','BSCS-2B','Jesus Laxamana','Laxa','CL3','lime');
	$('#irreg-add-sc').on('keyup',function(){
		$.ajax({
			type: 'get',
            url: "oT-core.php?form_type=fetch_by_sched_code&send_sc="+$(this).val(),
			complete: function(e){
				$('#irreg-add-subj-result').html(e.responseText);
				}			
	});
		});
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
<h2>Schedule Setting for Irregular Students. Irregulars can manage their own schedule here</h2>
<div class="toc-list">
<ul> 
<li>Your Subject Lists</li>
<li>Your Subject Schedule Grid</li>
<li>Schedule Grid Information Panel</li>
<li>End of the Page</li>
</ul>
</div>
</div>
</div>

<div class="sublist con-100-l pad50">
<h1 class="teal-header bmarg30"><b>Your Subject List</b></h1>
<div class="sublist-content">
<div class="sc-list con-70-l con-100-s inl">
<div class="header"><h2 class="prmtxt_w">Schedule Setting</h2></div>
<div class="list-con">
</div>
</div>

<div class="sc-control con-30-l con-100-s inl">
<div class="header "><h2 class="prmtxt_w">Control</h2></div>
<ul class="prmtxt_w sc-ddown"> 
<li class="scli">Add</li>
<div class="sc-add sc-dd">
<form id="irreg-add-subj" class="scc  prmtxt_w">
<label>Schedule Code:</label><input type="number" id="irreg-add-sc" name="irreg-add-schedcode">
<span id="irreg-add-subj-result">
</span>
<input type="submit" value="Add Subject"> 
</form>
</div>
<li class="scli">Remove</li>
<div class="sc-del sc-dd">
<form id="irreg-del-subj" class="scc  prmtxt_w">
<label>Subject ID:</label><input type="text" name="irreg-del-subj">
<input type="submit" value="Remove Subject"> 
</form>
</div>
<li class="scli">Sort</li>
<div class="sc-del sc-dd scc ">
<input type="button" value="By Subject Code">
<input type="button" value="By Description">
<input type="button" value="By Professor Name">
<input type="button" value="By Time &amp; Day">
</form>
</div>
<li>Help</li>
</ul>
</div>
</div>
</div>

<div class="ssg con-100-l pad50">
<h1 class="teal-header bmarg30"><b>Your Subject Schedule Grid</b></h1>

<div class="ssg-header">
<div class="ssg-contitle">Schedule Grid v1</div>
<ul class="prmtxt_w"> 
<li><label>Subject + Course</label></li>
<li><label>Professor + Room</label></li>
</ul>
</div>
<div class="ssg-container">
<div class="ssg-container-zoom">
<div class="day-upper day-h">
<ul class="prmtxt_w"> <li>Time In</li> <li>Sunday</li> <li>Monday</li> <li>Tuesday</li> <li>Wednesday</li> <li>Thursday</li> <li>Friday</li> <li>Saturday</li> <li>Time Out</li> </ul>
</div>
<table class="sg-grid">
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
</table>
<div class="time-left time-v">
<ul class="prmtxt_w"> 
<li>7:00am</li>
<li>8:00am</li>
<li>9:00am</li>
<li>10:00am</li>
<li>11:00am</li>
<li><b>12:00pm</b></li>
<li>1:00pm</li>
<li>2:00pm</li>
<li>3:00pm</li>
<li>4:00pm</li>
<li>5:00pm</li>
<li>6:00pm</li>
<li>7:00pm</li>
<li>8:00pm</li>
</ul>
</div>
<div class="time-right time-v">
<ul class="prmtxt_w"> 
<li>8:00am</li>
<li>9:00am</li>
<li>10:00am</li>
<li>11:00am</li>
<li><b>12:00pm</b></li>
<li>1:00pm</li>
<li>2:00pm</li>
<li>3:00pm</li>
<li>4:00pm</li>
<li>5:00pm</li>
<li>6:00pm</li>
<li>7:00pm</li>
<li>8:00pm</li>
<li>9:00am</li>
</ul>
</div>
<div class="day-lower day-h">
<ul class="prmtxt_w"> <li>Time In</li> <li>Sunday</li> <li>Monday</li> <li>Tuesday</li> <li>Wednesday</li> <li>Thursday</li> <li>Friday</li> <li>Saturday</li> <li>Time Out</li> </ul>
</div>
<div class="heregoesthegrid">
<div class="gridhline"></div>
<div class="gridvline"></div>
</div>
</div>
</div>

<div class="ssg-controls prmtxt_w">
<div class="ssgcc"><label><b>Controls</b></label></div>
<div class="ssgcc"><label><b>Zoom:</b></label></div>
<div class="ssgcc_input"><input type="range" id="ssgcc-zoom" min="1" max="100" value="35"></div>
<div class="ssgcc-default ssgcc"><label><b>Default</b></label></div>
<div class="ssgcc"><label><b>Height:</b></label></div>
<div class="ssgcc_input"><input type="range" id="ssgcc-sizeheight" min="300" max="800" value="500"></div><div class="ssgcc"><label><b>Help</b></label></div>
</div>
<div class="ssg-schedinfo"> 

<div class="ssgci-header">

<div class="ssgci-true-header">
<h1 class="subjct inl">Subject Code goes here</h1>
<h3 class="timet fright inl normalfont"><b>
<span id="ssgci-time">Time goes here</span><br>
<span id="ssgci-day">Day goes here</span><br>
<span id="ssgci-room">Room goes here</span>
</b></h3><br>
<h3 class="subjt normalfont">Full subject name goes here</h3>
</div>
<div class="ssgci-fake-header prmtxt_w"> 
<h1><b>Information Panel</b></h1>
<h3>To get started, click a grid</h3>
</div>
</div>
<div class="ssg-info">

<div id="ssg-subj-info" class="ssg-info-con con-50-l con-100-s">

<h3></h3>
<div class="divider-w"></div><br>
<p></p>


</div>

<div id="ssg-prof-info" class="ssg-info-con con-50-l con-100-s">

<h3 class="prmtxt_b">About Professor</h3>
<div class="divider"></div>
<br>
<img class="inl">
<div class="inl padleft25">
<h3>
<span class="ssg-profname"> </span><br>
</h3>
<span class="scndtext_b"> 
<p><b>Address:</b> <span class="ssg-prof-addr">Not specified</span></p>
<p><b>Contact Number:</b> <span class="ssg-prof-cnum"> Not specified</span></p>
<p><b>Email Address:</b> <span class="ssg-prof-email"> Not specified</span></p>
</span>
</div>
<br><br>
<h3 class="prmtxt_b"> Additional Information and Biography</h3>
<div class="divider"></div>
<br>
<p class="prof-bio"> Here goes the talambuhay of this prof</p>
</div>


<div id="ssg-grid-option" class="con-100-fixed prmtxt_w">

<div class="ssgo-menu"><h3>Edit Subject Details</h3></div>
<div class="ssgo-menu"><h3>Edit Professor Details</h3></div>
<div class="ssgo-menu"><h3>Find Room</h3></div>
<div class="ssgo-menu"><h3 class="inlc">Theme:</h3><i class="ssgo-color inlc margleft25"> </i></div>
</div>

</div>
</div>
</div>

</div>
</div>
<?php echo footer(); ?>
<!-- Content Endo -->
<!-- Side bar Starto --> 
<?php echo sidebar($site,$type); ?>
<!-- Side bar Endo -->
<!-- Modal Starto -->
<?php echo modal(); ?>
<!-- Modal Endo -->

</body>
</html>