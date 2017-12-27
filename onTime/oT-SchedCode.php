<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'oT-Homepage+Navbar.php'; 
$site = "sc";
$user = $_SESSION['session_user'];
$name = "Schedule Code List";
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
function update_content(){
		$.ajax({
				type:'get',
				url:"oT-core.php?form_type=sch_table&sch_menu=all",
				complete: function(e){
				GLOBAL_menu = 1;	
				$('#schedlist').tableSet(e.responseText,'sch');
					}		
			});
		$.ajax({
				type:'get',
				url:"oT-core.php?form_type=sch_table_limit&sch_menu=all",
				complete: function(e){
					$('#sch-dd-pagi').html(e.responseText);
				}		
			});
	}
	update_content();
	$('.schc-menu li').on('click',function(){
		var selected = $(this).index() + 1;
		var rawr = ['all','vacant','occupied'];
		$('.schc-menu li').each(function(index, element) {
            if($(this).is(':nth-child('+selected+')'))
						{
						$(this).addClass('menuselecteddark');
						$.ajax({
						type:'get',
						url:"oT-core.php?form_type=sch_table&sch_menu="+rawr[$(this).index()],
						complete: function(e){
						GLOBAL_menu = selected;
						$('#schedlist').tableSet(e.responseText,'sch');
							}		
						});
						$.ajax({
						type:'get',
						url:"oT-core.php?form_type=sch_table_limit&sch_menu="+rawr[$(this).index()],
						complete: function(e){
						$('#sch-dd-pagi').html(e.responseText);
						}		
							});
						}
					else
					{	$(this).removeClass('menuselecteddark');	}
	});});	
	
	$('#schc-search').on('keyup',function(){
		var arr_menu = ['all','vacant','occupied'];
		$.ajax({
		type:'get',
		url:"oT-core.php?form_type=sch_search&sch_menu="+arr_menu[GLOBAL_menu-1]+"&serts="+$(this).val(),
		complete: function(e){
			$('#schedlist').tableSet(e.responseText,'sch');
			}		
		});
		$('#sch-dd-pagi').val(1);
		});
	$('#sch-dd-pagi').on('change',function(){
		var arr_menu = ['all','vacant','occupied'];
		$.ajax({
		type:'get',
		url:"oT-core.php?form_type=sch_ddpagi&sch_menu="+arr_menu[GLOBAL_menu-1]+"&offset="+$(this).val(),
		complete: function(e){
			$('#schedlist').tableSet(e.responseText,'sch');
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
<h2>Lists of Schedule Codes with their corresponding information</h2>
<div class="toc-list">
<ul> 
<li>Schedule Code List</li>
<li>End of the Page</li>
</ul>
</div>
</div></div>
<div class="pod200"> </div>
<div class="schedcode con-100-l pad50">
<h1 class="teal-header bmarg30"><b>Schedule Code List</b></h1>
<div class="schedcode-content">
<div class="sch-control prmtxt_w">
<ul class="schc-menu"><li class="menuselecteddark">All</li><li>Vacant</li><li>Occupied</li></ul>
</div>
<div id="sclist-con">
<table id="schedlist">
</table>
</div>
<div class="sch-search prmtxt_w">
<i></i><input type="search" id="schc-search" placeholder="Search">
<label> Page &nbsp;&nbsp;</label>
<select id="sch-dd-pagi">
<option value="1"> 1 </option>
</select>
</div></div>
</div></div>

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
box-sizing: border-box;
	}
.schedcode-content
{
margin-top: 50px;
width: 100%;
height: 600px;
box-sizing:border-box;
background: #202020;
box-shadow: 0px 9px 30px rgba(0,0,0,0.50);
position: relative;
	}
#schedlist
{
border-collapse: collapse;
color:rgba(255,255,255,1.00);
font-family: Segoe UI;
font-size: 18px;	
	}
.sch-control ul li:hover
{
	background: #424242;
	}
.sch-control ul li:active
{
	background: #606060;
	}
.sch-search input[type="search"]
{
	padding-left: 15px;
	color:rgba(255,255,255,1.00);
	font-size:18px;
	border-bottom: 1px solid rgba(255,255,255,1.00);
	width: 40%;
	}
#sch-dd-pagi
{
	width: 50px;
	height: 100%;
	background: #202020;
	color: #80CBC4;
	font-size:18px;
	-webkit-transition: 0.2s;
	}
.sch-search label
{
	margin-left: auto;
	color: #80CBC4;
	font-size:18px;
	}
.sch-search input[type="button"]:hover{
	background: #424242;
	}
.sch-search input[type="button"]:active{
	background: #606060;
	}

.sch-search input[type="search"]:-webkit-input-placeholder
{
	color: #fff;
	}
.sch-search input[type="search"]:focus
{
	border-bottom: 2px solid rgba(255,255,255,1.00)
	}
.sch-search i
{
	height: 30px; width: 30px;
	margin-right: 10px;
	background: url(../icons/search-w.png);
	background-size: contain;	background-repeat: no-repeat;	background-position: center;
	}
.menuselecteddark
{
	background: #606060;
	}
.menuselecteddark:hover
{
	background: #606060 !important;
	}

.sch-control ul li
{
	width: 33.3%;
	padding: 10px 10px 10px 25px;
	display:inline-block;
	float:left;
	font-size: 24px;
	-webkit-transition: 0.2s;
	-webkit-user-select:none;
	cursor: pointer;
	}
.sch-control
{
	position:absolute;
	top: 0px; left: 0px;
	width: 100%;
	border-bottom: 1px solid rgba(255,255,255,0.12);
	z-index: 9999;
	}
.sch-search 
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
#schedlist
{
border-collapse: collapse;	
	}
#sch-1
{
margin-left: auto;
	}
#sclist-con
{
	position:absolute;
	width: 100%; height: 500px;
	top: 50px; left: 0px;
	overflow: auto;
	}
</style>
</html>