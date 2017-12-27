<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'oT-Homepage+Navbar.php'; 
$site = "addprof";
$user = $_SESSION['session_user'];
$name = "Add Professor";
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
$(function(){
	var hodor = "<tr><th>ID</th><th>Professor's Name</th><th>Evaluator's Limit</th></tr>";
	function updatecontent(){
		$.ajax({
			type: 'get',
			url:"oT-Core.php?form_type=addprof_table&apsearch=",
			complete: function(e){
				$('#addprofulate').html(hodor+e.responseText);
				}
			});
		}
	updatecontent();
	$('#addprof').on('submit',function(ew){
		ew.preventDefault();
		$.ajax({
			type: 'post',
			url:"oT-Core.php?form_type=addprof",
			data: $('#addprof').serialize(),
			complete: function(e){
			var isOk = e.responseText.split('#');
			$('#modal').modal("Adding Successful", "teal", isOk[0], null, null, 'Close');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);
			updatecontent();
			}	
			});
		});
	$('#addprof-search').on('keyup',function(){
	$.ajax({
			type: 'get',
			url:"oT-Core.php?form_type=addprof_table&apsearch="+$(this).val(),
			complete: function(e){
			$('#addprofulate').html(hodor+e.responseText);
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
<h2>Administrators can add new professor in this section</h2>
<div class="toc-list">
<ul> 
<li>Add New Professor</li>
<li>Referral Manager</li>
<li>End of the Page</li>
</ul>
</div>
</div></div>
<div class="pod200"> </div>
<div class="prof-adder con-100-l pad50">
<h1 class="teal-header bmarg30"><b>Add New Professor</b></h1>

<div class="addprof-content">

<div class="addprof-control inl">
<div class="addprof-c-header">
<h2 class="prmtxt_w">Professor Information</h2>
</div>
<br>
<form id="addprof">
<label>Last Name:</label><input type="text" name="addprof-lname" placeholder="Last Name" required>
<br><br>
<label>First Name:</label><input type="text" name="addprof-fname" placeholder="First Name" required>
<br><br>
<label>Evaulator's Limit:</label><input type="number" name="addprof-eval" value="500" placeholder="Evaluator&apos;s Limit" required>
<input type="submit" value="Add Professor">
</form>
</div>
<div class="addprof-table inl">
<table id="addprofulate">
<tr>
<th>ID</th>
<th>Professor's Name</th>
<th>Evaluator's Limit</th>
</tr>
</table>
</div>
<div class="addprof-table-sartz inl">
<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i><input type="search" id="addprof-search" placeholder="Search">
</div>
</div>
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
	box-sizing:border-box;	
	}
.addprof-content
{
margin-top: 50px;
width: 100%;
height: 500px;
background: #EEEEEE;
box-shadow: 0px 9px 30px rgba(0,0,0,0.50);
position: relative;
}
.addprof-control
{
width: 30%;
height: 100%;
background: #BDBDBD;
float:left;
	}
.addprof-c-header
{
width: 100%;
height: 70px;
padding: 10px 25px 0px 25px;
background: #202020;
	}
#addprof
{
padding: 10px 25px 25px 25px;
	}
#addprof input[type="text"], #addprof input[type="number"]
{
border-bottom: #00796B 2px solid;
width: 100%; padding-left: 2%;
font-size: 24px;
	}
#addprof input[type="submit"]
{
margin-top: 25px;
height: 70px; width: 100%;
font-size: 24px;
background:#00796B;
color: #fff;
-webkit-transition: 0.2s;
	}
#addprof input[type="submit"]:hover
{
background:#009688;
box-shadow: 0px 3px 10px rgba(0,0,0,0.50);
	}
.addprof-table
{
width: 70%; height: 430px;
float:left;
overflow:auto;
	}
.addprof-content
{
overflow: hidden;
	}
.addprof-table-sartz
{
border-top: 1px solid rgba(0,0,0,0.12);
width: 70%; height:70px;
padding: 15px 25px 10px 25px;
background: #E0E0E0;
	}
.addprof-table-sartz input[type="search"]
{
	padding-left: 15px;
	font-size:18px;
	border-bottom: 1px solid rgba(0,0,0,0.83);
	width: 50%;
	}
.addprof-table-sartz i
{
	height: 30px !important; width: 30px !important;
	margin-right: 10px;
	background: url(../icons/search-b.png);
	background-size: contain;	background-repeat: no-repeat;	background-position: center;
	}

.addprof-table table
{
	position: relative;
	border-collapse: collapse;
	width: 100%;
	font-size: 18px;
	font-family: "Segoe UI";
	}
.addprof-table table tr td,.addprof-table table tr th
{
	padding: 10px 10px 10px 25px;
	border-bottom:rgba(255,255,255,0.12) 1px solid;
	}
.addprof-table table tr:first-child
{
	text-align: left;
	background: #424242;
	color:rgba(255,255,255,1.00);
	width: 100%; height:70px;
	}
</style>
</html>