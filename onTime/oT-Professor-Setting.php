<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'oT-Homepage+Navbar.php'; 
$site = "prof-setting";
$user = $_SESSION['session_user'];
$name = "Professor Schedule Setting";
if(!isset($_SESSION['session_user'])||$_SESSION['session_type']!="Professor")
{
header("Location: ../index.php");
	}
else
{
$type = $_SESSION['session_type'];
$status = $_SESSION['session_studtus'];
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
GLOBAL_current_site = "<?php echo $site; ?>";
function update_prof_set_content(){
	$.ajax({
		type:'get',
		url:"oT-core.php?form_type=populate_prof_sched_table",
		complete:function(e){
		var up_sched_table_setting = e.responseText.toString();
		var hoy = $('#prof-subj-list').tableSet(up_sched_table_setting,'proftable');
		GLOBAL_row_length = hoy.length;
		$('.heregoesthegrid').gridSet(hoy.length);
			for (x=1;x <= hoy.length;x++)
			{
			var set = [];
			set = hoy[x-1].split('|');
			//timein,timeout,day,subject,fsubject,cys,prof,profnick,room,theme,about,profinfo
			$('.grid:nth-of-type('+x+')').gridProperty(set[8],set[9],set[7],set[1],set[2],set[3]+"<br>"+set[4]+"-"+set[5],
			set[11],set[12],set[6],set[13],set[0],set[10]);
			}
		}
		});		
	}

$(function(){
update_prof_set_content();

$('.timein').on('change',function(){
var getVal = arr_time_options.indexOf($(this).val());
var concat_timeout = "",y=0;
for(y = getVal + 1; y<=14; y++)
{concat_timeout += '<option value="'+arr_time_options[y]+'">'+arr_time_options[y]+'</option>';}
$('.timeout').html(concat_timeout);
	});

	$('#prof-add-sc').on('keyup',function(){
		$.ajax({
			type: 'get',
      url: "oT-core.php?form_type=fetch_by_sched_code&send_sc="+$(this).val(),
			complete: function(e){
				$('#prof-add-subj-result').html(e.responseText);
				}	});	
				});
	$('#prof-add-subj').on('submit',function(e){
		e.preventDefault();
			$.ajax({
			type: 'post',
            url: "oT-core.php?form_type=prof_add_subj",
            data: $('#prof-add-subj').serialize(),
			complete: function(e){
			res = e.responseText;
			resbak = res.split('#');
			if(resbak[1] == "ok")
			{
			$('#modal').modal("Adding Schedule Successful", "teal", resbak[0], null, null, 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true,null,function(){update_prof_set_content();});
			}
			else if(resbak[1] == "pt")
			{
			$('#modal').modal("Conflict with Other Schedule", "amber", resbak[0], null, 'Request', 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(true,true,true);
				}
			else
			{
			$('#modal').modal("Adding Schedule Failed", "red", resbak[0], null, null, 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);
				}
				}
		});	
	});
	$('#prof-del-subj').on('submit',function(e){
		e.preventDefault();
		var d = $('#profdsbj').val();
		if(d == null||d == "")
		{
		$('#modal').modal("Deletion of Schedule Failed", "red", "Blank Input on Schedule ID", null, null, 'Dismiss');
		$('#modal').centerize();
		$('#modal').modalbuttons(false,true,true);
			}
		else if(d < 1 || d > GLOBAL_row_length)
		{
		$('#modal').modal("Deletion of Schedule Failed", "red", "Schedule ID doesn't exist!", null, null, 'Dismiss');
		$('#modal').centerize();
		$('#modal').modalbuttons(false,true,true);
			}
		else
		{
		var	dd = parseInt(d) + 1;
		$.ajax({
			type: 'get',
			url: 'oT-Core.php?form_type=prof_del_sub&profdelsc='+$('.sched-table tr:nth-child('+dd+') td:nth-child(2)').text(),
			complete: function(e)
			{			
			$('#modal').modal("Schedule Deleted", "teal", "Schedule Code ["+e.responseText + "] Deleted", null, null, 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);	
				}
			});
			update_prof_set_content();
			}
		
		});
	$('#prof-edit-subj').on('submit',function(e){
		e.preventDefault();
		var d = $('#profesbj').val();
		if(d == null||d == "")
		{
		$('#modal').modal("Update of Schedule Failed", "red", "Blank Input on Schedule ID", null, null, 'Dismiss');
		$('#modal').centerize();
		$('#modal').modalbuttons(false,true,true);
			}
		else if(d < 1 || d > GLOBAL_row_length)
		{
		$('#modal').modal("Update of Schedule Failed", "red", "Schedule ID doesn't exist!", null, null, 'Dismiss');
		$('#modal').centerize();
		$('#modal').modalbuttons(false,true,true);
			}
		else
		{
		var	dd = parseInt(d) + 1;
		$.ajax({
			type: 'post',
			url: 'oT-Core.php?form_type=prof_edit_subj&profesc='+$('.sched-table tr:nth-child('+dd+') td:nth-child(2)').text(),
            data: $('#prof-edit-subj').serialize(),
			complete: function(e){
			res = e.responseText;
			resbak = res.split('#');
			if(resbak[1] == "ok")
			{
			$('#modal').modal("Update of Schedule Successful", "teal", resbak[0], null, null, 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true,null,function(){update_prof_set_content();});
			}
			else if(resbak[1] == "pt")
			{
			$('#modal').modal("Conflict with Other Schedule", "amber", resbak[0], null, 'Request', 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(true,true,true);
				}
			else
			{
			$('#modal').modal("Update Schedule Failed", "red", resbak[0], null, null, 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);
				}
				}

			});

		}
		});

$('.ssgo-color').on('click',function(){
		$('#modal-button-yes').hide();
		var x = 0;
		var divconcat = "";
		for(x=1;x<=16;x++)
		{	divconcat = divconcat + "<div class='gridclr'></div>";	}
		$('#modal').modal("Theme Selection", "grey","<div class='colorcontainer'>"+divconcat+"</div>", null, 'Change Theme', 'Cancel');
		$('#modal').centerize();
		$('.gridclr').on('click',function(){

		$('#modal-button-yes').show();
		var selected = $(this).index() + 1;
		$('.gridclr:nth-child(1)').addClass('colorselected');
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
		});});
		
		$('#modal').modalbuttons(false,true,true,function(){
		$('.grid:nth-of-type('+global_grid_selected+')').click();
		if(GLOBAL_current_site === "prof-setting"){
		$.ajax({
		type: 'post',
		url: 'oT-Core.php?form_type=prof_stheme&thema='+global_color_selected+'&sc='+GLOBAL_sc_selected,
		complete: function(e){update_prof_set_content();
		}});}},null);	


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
<h2>This section was organized for professor's schedule.</h2>
<div class="toc-list">
<ul> 
<li>Professor Schedule List</li>
<li>Professor Schedule Grid</li>
<li>Schedule Grid Information Panel</li>
<li>End of the Page</li>
</ul>
</div>
</div>
</div>
<!-- ------ --->
<div class="sublist con-100-l pad50">
<h1 class="teal-header bmarg30"><b>Your Subject List</b></h1>
<div class="sublist-content">
<div class="sc-list con-70-l con-100-s inl">
<div class="header"><h2 class="prmtxt_w">Schedule Setting</h2></div>
<div class="list-con">
<table id="prof-subj-list" class="sched-table prmtxt_b">
</table>
</div>
</div>

<div class="sc-control con-30-l con-100-s inl">
<div class="header "><h2 class="prmtxt_w">Control</h2></div>
<ul class="prmtxt_w sc-ddown"> 
<li class="scli">Add</li>
<div class="sc-add sc-dd">
<form id="prof-add-subj" class="scc prmtxt_w">
<label>Schedule Code: </label><input type="number" id="prof-add-sc" name="prof-add-schedcode">
<span id="prof-add-subj-result"></span>
<br>
<div class="divider-w"></div>
<label>Room Code: </label><input type="text" id="prof-add-room" name="prof-add-room">
<label>Day:</label>
<select id="prof-add-subj-day" name="prof-add-subj-day">
<option value="Sunday"> Sunday </option>
<option value="Monday"> Monday </option>
<option value="Tuesday"> Tuesday </option>
<option value="Wednesday"> Wednesday </option>
<option value="Thursday"> Thursday </option>
<option value="Friday"> Friday </option>
<option value="Saturday"> Saturday </option>
</select>
<label>Time In:</label>
<select id="prof-add-subj-timein" class="timein" name="prof-add-subj-timein">
</select>
<label>Time Out:</label>
<select id="prof-add-subj-timeout" class="timeout" name="prof-add-subj-timeout">
</select>

<input type="submit" value="Add Schedule"> 
</form>
</div>
<li class="scli">Remove</li>
<div class="sc-del sc-dd">
<form id="prof-del-subj" class="scc  prmtxt_w">
<label>Schedule ID:</label><input type="number" id="profdsbj" name="prof-del-subj" class="delsched">
<input type="submit" value="Remove Subject">
</form>
</div>

<li class="scli">Update Schedule</li>
<div class="sc-edit sc-dd">
<form id="prof-edit-subj" class="scc prmtxt_w">
<label>Schedule ID:</label><input type="text" id="profesbj" name="prof-edit-subj" class="editsched">
<label>Room Code: </label><input type="text" id="prof-edit-room" name="prof-edit-room">
<label>Day:</label>
<select id="prof-edit-subj-day" name="prof-edit-subj-day">
<option value="Sunday"> Sunday </option>
<option value="Monday"> Monday </option>
<option value="Tuesday"> Tuesday </option>
<option value="Wednesday"> Wednesday </option>
<option value="Thursday"> Thursday </option>
<option value="Friday"> Friday </option>
<option value="Saturday"> Saturday </option>
</select>
<label>Time In:</label>
<select id="prof-edit-subj-timein" class="timein" name="prof-edit-subj-timein">
</select>
<label>Time Out:</label>
<select id="prof-edit-subj-timeout" class="timeout" name="prof-edit-subj-timeout">
</select>
<input type="submit" value="Update Subject"> 
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
<style>
.sc-dd .divider-w
{
	margin: 5px 0px 5px 0px;
	}
.sc-dd select
{
	}
</style>
</html>