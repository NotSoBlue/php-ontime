<?php 
session_start(); 
#
# Homepage and Navigation bar user-defined function by sarz xD
# 
function filler() {
$fill	=
"<ul class='prmtxt_b'>
<li > oh no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li id='boo'></li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > freaking no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
<li > holy no</li>
</ul>";

return $fill;
	}
function navbar($whatsite ="",$whatname ="Please put some name",$nickname = "Guest")
{
if($whatsite == "home")
{
$time =
"
<div id='nav_time'>
	<div class='nav_time_space inl'>
		<h2 class='inl'><span id='current_time'> Set Time </span></h2>
	</div>
		<h2 class='inl'>| <b><span id='get_day'> </span></b> <span id='get_date'>Set Date</span></h2>
</div>
";
}
else
{
$time = "";
}
$nav_main =
"
<nav class='nav_main align_center_flex prmtxt_w'>
		<button id='nav_collapse' class='nav_button inl'> <div id='nav_collapse_icon' class='nav_collapse_b icon_active_b nav_icon_prop'> </div></button>
<div id='nav_nanaman'>
$time
<div id='nav_title' hidden='true'>
	<h2 class='inl'><b>onTime </b>- $whatname</h2>
</div>
</div>
		<button id='nav_search' class='nav_button inl'> <div id='nav_search_icon' class='nav_search_b icon_active_b nav_icon_prop'> </div></button>
        <div class='nav_search_holder nav_search_holder-x'><input type='text' id='nav_sbar' class='nav_search_bar nsbactivated' placeholder='Search'>
		<button class='x-search-prop x-search-b'> </button>
		</div>
	<button id='nav_lotus' class='nav_button inl'> <div id='nav_lotus_icon' class='nav_lotus_b icon_active_b nav_icon_prop'> </div></button>
</nav>
";
if($whatsite == "home")
{
if(!isset($_SESSION['session_user']))
{	$nav_splash =
"
<div class='nav_splash prmtxt_w'>
	<div class='navpod'> </div>
	    <div id='navcontainerleft' class='fiftycontainer inl left splashcontainer'>
		    <h1 class='splashgreet'> <span id='splashgreet'>Good Day</span>!</h1>
		    <div id='notlogin'><center> 
		    <h1 class='prmtxt_w'><a href='onTime/oT-Log-in-Register.php' class='prmtxt_w'><b>Log-in </a>| 
			<a href='onTime/oT-Log-in-Register.php#lr-action-scroll' class='prmtxt_w'>Register</b></a></h1></center>
		    </div>
	<div class='splashtitleholder align_center_flex'>
		<div class='nav_splash_logo inl'></div>
			<h1 class='splashead inl'><b>UCC</b><br>onTime</h1>
		</div>
   		</div>
    		<div id='navcontainerright' class='fiftycontainer inl xtext_w splashcontainer'> <br><br>
    		<h2><center><b>To see more content, log-in an account</b></center></h2>
    	</div>
   	<div class='littlepod'> </div>
</div>
";}
else
{
$nav_splash =
"
<div class='nav_splash prmtxt_w'>
	<div class='navpod'> </div>
	    <div id='navcontainerleft' class='fiftycontainer inl left splashcontainer'>
		    <h1 class='splashgreet'> <span id='splashgreet'>Good Day</span><br><b>$nickname!</b></h1>
			<div class='splashnotifholder'> 
<!--			<div class='splnotifimg splnotif-req inl'></div><p class='inl spl-req-label'><b><span id='up-spl-req'>0</span></b> Requests | Approvals</p>
<br>		<div class='splnotifimg splnotif-act inl'></div><p class='inl spl-act-label'><b><span id='up-spl-act'>0</span></b> Recent Activities</p> -->
			<div class='pod200'></div>
			</div>
	<div class='splashtitleholder align_center_flex'>
		<div class='nav_splash_logo inl'></div>
			<h1 class='splashead inl'><b>UCC</b><br>onTime</h1>
		</div>
   		</div>
		<div class='divider-w show-on-s'> </div>
    		<div id='navcontainerright' class='fiftycontainer inl prmtxt_w splashcontainer'> 
			<br>
    		<h2><b>Schedule Quick Look:</b></h2>
			<div class='divider-w'></div>
			<div class='schedQL-holder'> </div>
    		<h2><b>Coming up next:</b></h2>
			<div class='divider-w'></div>
			<div class='cup-holder'> </div>
    	</div>
   	<div class='littlepod'> </div>
</div>
";	
	}
}
else if ($whatsite == "log-in/register")
{
 $nav_splash = 
 "
<div class='nav_splash prmtxt_w'>
 	<div class='pod'> </div>
<div id='log-in-holder' class='con-100'>
 <div id='log-in' class='.con-50-to-100'>
  <h1 class='accent-header'> <center><b>Account Log-in</b></center></h1>
  <form id='form-log-in'>
   <div class='offset-h-30px'> </div>
   <center>  
   <input 
   type='text' 
   name='form-log-in-username' 
   class='text-input-80-accent prmtxt_w'
   placeholder='Username'
   > 
   <div class='offset-h-30px'> </div>
   <input 
   type='password' 
   name='form-log-in-password'
   class='text-input-80-accent prmtxt_w'
   placeholder='Password'
   >
   <div class='offset-h-30px'> </div>
   <input type='submit' 
   class='submit-80 button-accent prmtxt_b'
   value='Log-in'
   >
  <br><br>
<h3 class='accent-header normalfont'> <center>You can log-in using your <b> Student Number </b> as Username and <br> <b>First Name</b> as your password</center></h3>
<h3 class='accent-header normalfont'> <center>Sample: <b>Username:</b> 20139999 <b>Pass:</b> Juan</center></h3>
<br><h3 class='accent-header normalfont'> <center><b>You will be logged as Regular Student</b></center></h3>
   </center>
  </form>
 </div>
</div>
 	<div class='pod'> </div>
</div>
 ";
	}
else
{
 $nav_splash = 
 "
 <div class='nav_splash prmtxt_w'>
 	<div class='pod'> </div>
	<h1 class='splashtitle'> $whatname </h1>
  	<div class='littlepod'> </div>
 </div>
 ";
}

$fill = $nav_main . $nav_splash;
return $fill;
	}

function sidebar($whatsite = "home", $whattype = "none", $whatstatus = "common")
{
if($whatsite == "home")
{
$sb_home = "index.php";
$sb_link = "onTime/";
$sb_lg = "onTime/oT-Log-out.php";
	}
else
{
$sb_home = "../index.php";
$sb_link = "";
$sb_lg = "oT-Log-out.php";
	}
if($whattype != 'none')
{
# <a href='$sb_link"."oT-Account-Manager.php' id='sb_accset'><li><div class='sb_minilogo sb_accset icon_active_b inlc'> </div>Account Manager</li></a>
$addsidebar = "
    <a href='$sb_lg' id='sb_lg'><li><div class='sb_minilogo sb_accset icon_active_b inlc'> </div>Log-out</li></a>";
	}
else{
$addsidebar = null;
	}
if($whattype == 'Professor')
{
$sideadd ="
    <a href='$sb_link"."oT-Professor-Setting.php' id='sb_psetting'><li> <div class='sb_minilogo sb_psetting icon_active_b inlc'></div>Professor Setting</li></a>
";}
else if($whattype == 'Student'&& $whatstatus == 'Irregular')
{
$sideadd ="<a href='$sb_link"."oT-Irregular-Setting.php' id='sb_isetting'><li> <div class='sb_minilogo sb_isetting icon_active_b inlc'></div>Irregular Setting</li></a>";
	}
else{ 
$sideadd = null;
	}

$sidebar =
"
<div id='sboverlay' class='sboverlay'> </div>
<div id='sbholder' class='sidebar slide2hide'>
	<div class='sblogoholder'>
    <div id='littlelogo' class='inl'></div>
    <h2 class='prmtxt_b inlc nowrap'><b> UCC</b> <br> onTime</h2>
	</div>
    <div id='sblistholder'>
    <ul id='sblist' class='prmtxt_b'>
    <a href='$sb_home' id='sb_home'><li><div class='sb_minilogo sb_home icon_active_b inlc'> </div>Home</li></a>
	<li id='sb_sched'><div class='sb_minilogo sb_adv icon_active_b inlc'> </div>Schedules</li>
    <div id='sb_sched_sub'>
    <ul class='prmtxt_b'> 
    <a href='$sb_link"."oT-Building-Block.php' id='sb_bblock'><li> <div class='sb_minilogo sb_bblock icon_active_b inlc'></div>Building Block</li></a>
    <!-- a href='$sb_link"."oT-Schedule-Grid.php' id='sb_scgrid'><li> <div class='sb_minilogo sb_scgrid icon_active_b inlc'></div>Schedule Grid</li></a>
    <a href='$sb_link"."oT-Course-Setting.php' id='sb_csetting'><li> <div class='sb_minilogo sb_csetting icon_active_b inlc'></div>Course Setting</li></a-->
	$sideadd 
    </ul>
    </div>
	<a href='$sb_link"."oT-SchedCode.php' id='sb_adv'><li><div class='sb_minilogo sb_sched icon_active_b inlc'> </div>SchedCode List</li></a>
	$addsidebar
    </ul>
    </div>
</div>
";
return $sidebar;
	}
function lotus(){
	$info = 
	"
	<div id='lotus-c' class='prmtxt_b'>
  <div id='lotus-sc-container'>
    <div id='lotus-account' class='lotus-sc inlc'>
      <div class='lotus-img-s lotus-img-account icon_active_b'> </div>
      <span id='lotus-txt-account'>Your Account </span> 
    </div>
    <div id='lotus-time' class='lotus-sc inlc'>
      <div class='lotus-img-s lotus-img-time icon_active_b'> </div>
      <span id='lotus-txt-time'> Time </span>
    </div>
    <div id='lotus-activity' class='lotus-sc inlc'>
      <div class='lotus-img-s lotus-img-activity icon_active_b'> </div>
      <span id='lotus-txt-activity'>No Recent<br>
      Activity</span> 
    </div>
    <div id='lotus-request' class='lotus-sc inlc'>
      <div class='lotus-img-s lotus-img-request icon_active_b'> </div>
      <span id='lotus-txt-request'>No Request</span> 
    </div>
  <div id='lotus-master-overlay'>
    <div id='lotus-time-main' class='lotus-main'>
      <div id='lotus-back' class='inlc'><div class='lotus-img-back icon_active_b'></div></div>
      <i class='lotus-main-title prmtxt_b inlc'> <b>Time and Date</b></i>
      <div class='lotus-img-m lotus-img-time icon_active_b'> </div>
    </div>
  </div>
  </div>
  <div id='lotus-x'>
    <div class='lotus-img-x'></div>
  </div>
</div>
	";
	return $info;
	}
function modal()
{
return
"<div id='modal-overlay' hidden='true'> </div>

<div id='modal' class='modal-prop'>
<div id='modal-title' class='prmtxt_b'><h2></h2></div>
<div id='modal-content' class='modal-content prmtxt_b'> 
<span id='modal-content-inside'>
</span>
</div>

<div class='modal-button-holder'> 
<button id='modal-button-yes'> Accept </button>
<button id='modal-button-no' > Dismiss </button>
</div>

</div>";
	
	}
function footer()
{
return "<footer class='futar'> 
<h2 class='prmtxt_w inlb'> <b>UCC onTime</b></h2>
<h3 class='prmtxt_w fright inlb'> About | Help | Contact Us</h3>
<br>
<p class='prmtxt_w inlb'> University of Caloocan City Schedule Organizing System</p>
<p class='prmtxt_w fright inlb'> &copy; 2015-2016. All Rights Reserved.</p>
</footer>";	
	}
?>