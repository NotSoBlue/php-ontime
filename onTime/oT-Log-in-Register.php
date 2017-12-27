<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include '../onTime/oT-Homepage-Navbar.php'; 
$site = 'log-in/register';
$name = 'Log-in | Register';
$user = $_SESSION['session_user'];

if(isset($_SESSION['session_user']))
{
header("Location: ../index.php");
	}

?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Log-in | Register</title>
</head>
<link href='../css/typography.css' rel='stylesheet' type='text/css'>
<link href='../css/navbar.css' rel='stylesheet' type='text/css'>
<link href='../css/assorted.css' rel='stylesheet' type='text/css'>
<link href='../css/responsive.css' rel='stylesheet' type='text/css'>
<script src='../js/jquery-2.1.4.min.js'> </script>
<script>

$(function(){
var	conf = "";
var	isCaptchaOk = false;
$('#freg-student-selected').slideDown(0);
$('#freg-admin-selected').slideUp(0);
$('#type-selection').on('change', function(){
	var hoy = $('#type-selection').val();
	if(hoy == 'Student')
	{
		$('#freg-student-selected').slideDown(200);
		$('#freg-admin-selected').delay(200).slideUp(200);
		}
	else
	{
		$('#freg-student-selected').delay(200).slideUp(200);
		$('#freg-admin-selected').slideDown(200);
		}
	});

// AJAX Form submission
$('#form-register').on('submit',function(e){	e.preventDefault();
if(	isCaptchaOk === true){
	  $.ajax({
		 	type: 'post',
            url: "oT-core.php?form_type=register",
            data: $('#form-register').serialize(),
			complete: function(x) {
			var res = x.responseText;
			resbak = res.split('#');
			if(resbak[1] == 'ok')
			{
			$('#modal').modal("Register Successful", "teal", resbak[0], null, 'Log-in', 'Close');
			$('#modal').centerize();
			$('#modal').modalbuttons(true,true,true,
			function(){
				$.ajax({
					 	type: 'post',
			            url: "oT-core.php?form_type=rlogin",
						complete: function(){ location.reload(true); }
					}); 
				});
			}
			else
			{
			$('#modal').modal("Register Failed", "amber", resbak[0], null, null, 'Close');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);
			$('#form-register-captcha').val("");
			$('.captcha').click();
			}
			}
            });
}
else
{
			$('#modal').modal("Register Failed", "red", "Wrong Captcha. Confirm it again.", null, null, 'Close');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);
			$('#form-register-captcha').val("");
			$('.captcha').click();

	}
});

$('#form-log-in').on('submit', function(e){ e.preventDefault();
	$.ajax({
		 	type: 'post',
            url: "oT-core.php?form_type=login",
            data: $('#form-log-in').serialize(),
			complete: function(x) {
			var res = x.responseText;
			resbak = res.split('#');
			if(resbak[1] == 'ok'){
			$('#modal').modal("Successful", "teal", resbak[0], null, 'Okay', 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(true,false,true,
			function() {	location.reload(true);	});
				}
			else
			{
			$('#modal').modal("Failed", "red", resbak[0], null, null, 'Dismiss');
			$('#modal').centerize();
			$('#modal').modalbuttons(false,true,true);
				}

			}
		});
	});
$('#sn-keyup').on('keyup',function(){
			var str = $(this).val();
			var howlong = str.length;
			if(howlong>=8){
			$.ajax({
		 	type: 'post',
            url: "oT-core.php?form_type=getstudinfo&student_number=" + str +"-M",
			complete: function(e){
				$('#fetch-SN').html(e.responseText);
				}
			})
			}
			else
			{
			$('#fetch-SN').html('');
				}
	});
$('.captcha').on('click',function(){
	conf = randch(Math.floor(Math.random() * 5)+6);
	$(this).text(conf);
	$('.captcha').css("background","#424242");
	isCaptchaOk = false;
	});
$('.captcha').click();
$('#form-register-captcha').on('keyup change', function(){
	var input = $(this).val();
	if(input.toLowerCase() === conf.toLowerCase())
	{
	$('.captcha').css("background","#009688");
	isCaptchaOk = true;
		}
	else if(input == ""||input == null)
	{
	$('.captcha').css("background","#424242");
	isCaptchaOk = false;
		}
	else
	{
	$('.captcha').css("background","#C62828");
	isCaptchaOk = false;
		}
	});
// ---------------------------------------------------
	var winheight = $(window).height();
	var totalheight = winheight - 572;	
	$('#lr-action-scroll').css('height', totalheight);
	$(window).on('scroll',
	function() {
	$('#lr-action-scroll').addClass('poof');
	$('#lr-action-scroll').removeClass('plok');
		});
	function randch(length)	{
	length = length || 1;
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i=1 ; i < length ; i++)
       { text += possible.charAt(Math.floor(Math.random() * possible.length));}
    return text;
	}
	});
</script>
<script src='../js/asynctime.js'> </script>
<script src='../js/navbar.js'> </script>
<script src='../js/responsive.js'> </script>
<body>
<!-- Nav bar Starto -->
<?php echo navbar($site,$name); ?> 
<!-- Nav bar Endo -->
<!-- Lotus Starto -->
<?php echo lotus(); ?> 
<!-- Lotus Endo -->
<!-- Content Starto -->

<div id='lr-action-scroll' class='conflex justcenter alcenter con-100 plok'>
<h2 class='teal-header'><b>- Register by going down -</b></h2>
</div>
<div class="main-con">
<div class="secon">
<div  class='offset-h-30px'> </div><div  class='offset-h-30px'> </div>
<div id='reg-container' class='con-100'>
  <h1 class='teal-header ind-30px-l'> <b>Account Register</b></h1>
  <div class='offset-h-30px'> </div>
  <form id='form-register' autocomplete="off">
  <div class='con-50-to-100 reg-acc-con collapse-inltop'>
  <i class='prmtxt_b'><b>Account Information</b></i>
  <div class='divider con-100'> </div>
  <p class='scndtext_b'> Information given below will serve as your account's identity. <br>You can use it to log-in on this site.</p>

   <h3 class='prmtxt_b text-input-70-sidetext inl'> Username:</h3>
   <input 
   type='text' 
   name='form-register-username' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Username'
   maxlength="22"
   >

   <h3 class='prmtxt_b text-input-70-sidetext inl'> Password:</h3>
   <input 
   type='password' 
   name='form-register-password' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Password'
   >

   <h3 class='prmtxt_b text-input-70-sidetext inl'> Confirm: </h3>
   <input 
   type='password' 
   name='form-register-confirm-password' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Confirm Password'
   > 
   <h3 class='prmtxt_b text-input-70-sidetext inl'> Nickname: </h3>
   <input 
   type='text' 
   name='form-register-nickname' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Nickname'
   title='What name you want us to call you'
   maxlength="18"
   >

   <div class='offset-h-30px'> </div>

  <i class='prmtxt_b'><b>Your Contacts</b></i>
  <div class='divider con-100'> </div>
  <p class='scndtext_b'> You'll be contacted by us with this information</p>
  
   <h3 class='prmtxt_b text-input-70-sidetext inl'> Email: </h3>
   <input 
   type='text' 
   name='form-register-email' 
   class='text-input-70 prmtxt_b inl'
   placeholder='e.g.: youremail@gmail.com'
   >

   <h3 class='prmtxt_b text-input-70-sidetext inl'> Phone Number: </h3>
   <input 
   type='number' 
   name='form-register-num'
   class='text-input-70 prmtxt_b inl'
   placeholder='Cellphone or Telephone Number'
   >  

   <div class='offset-h-30px'> </div>       

</div>

<div id='campus-info' class='con-50-to-100 collapse-inltop'> 
 <i class='prmtxt_b'><b>Campus Information</b></i>
  <div class='divider con-100'> </div>
  <p class='scndtext_b'> We’ll fetch your information automatically <br> based on the information given to us</p>
  
  <h3 class='text-input-70-sidetext'> Account Type:</h3> 
  <select id="type-selection" name='form-register-type' class="select-70 select-light prmtxt_b">
  <option value='Student'> <b>Student</b> </option>
  <option value='Professor'> <b>Professor</b> </option>
<!--  <option value='Administrator'> <b>Administrator</b> </option> -->
  </select>
  
  <div id="freg-student-selected">
   <h3 class='prmtxt_b text-input-70-sidetext inl'> Student Number: </h3>
   <input 
   type='number' 
   name='form-register-sn'
   id="sn-keyup"
   class='text-input-70 prmtxt_b inl'
   placeholder='Your Student Number'
   >
 <h3 class='text-input-70-sidetext'> Status:</h3> 
 <select id="studtus-selection" name='form-register-studtus' class="select-70 select-light prmtxt_b">
  <option value='Regular'> <b>Regular</b> </option>
  <option value='Irregular'> <b>Irregular</b> </option>
 </select>

   <span id="fetch-SN"> </span>
  </div>
  
  <div id="freg-admin-selected">
   <h3 class='prmtxt_b text-input-70-sidetext inl'> Your name: </h3>
 <input 
   type='text' 
   name='form-register-name' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Enter full name for confirmation'
   > 
   <h3 class='prmtxt_b text-input-70-sidetext inl'> Referral Username: </h3>
 <input 
   type='text' 
   name='form-register-refname' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Username of your Referral'
   >
   <h3 class='prmtxt_b text-input-70-sidetext inl'> Referral Code: </h3>
   <input 
   type='text' 
   name='form-register-refcode' 
   class='text-input-70 prmtxt_b inl'
   placeholder='Given code by your referral'
   > 
  </div>
  <div class='offset-h-30px'> </div>
  <div class="captchacon">
  <i class='prmtxt_b'><b>Captcha</b></i>
  <div class='divider con-100'> </div>
  <p class='scndtext_b'> Enter the characters below to confirm. Change by clicking it.</p>
  <div class="captcha"> HEYYY</div>
  <input 
   type='text' 
   id='form-register-captcha' 
   class='text-input-50 prmtxt_b inlb'
   placeholder='Input characters from the left'
  > 
  </div>
   <input type='submit' 
   class='submit-100 button-dark prmtxt_w'
   value='Register'
   >
  <div class='offset-h-30px'> </div>
</div>

</form>
</div></div>
</div>
<?php echo footer(); ?>
<!-- Content Endo -->
<!--Side bar Starto-->
<?php echo sidebar($site); ?>
<!--Side bar Endo-->
<!--Modal Starto-->
<?php echo modal(); ?>
</body>
<style> 
#lr-action-scroll
{
overflow: hidden;
-webkit-transition: 0.2s;
	}
#form-register h3, #form-register input, #form-register select
{
margin-top: 15px;  display: inline-block;
	}
#reg-container p
{
font-size: 16px;
	}
.captcha
{
	background: #424242;
	color: rgba(255,255,255,1.00);
	font-family: "Lucida Console";
	font-size: 24px;
	width: 50%;
	height: 50px;
	margin-top: 15px;
	display: inline-flex;
	vertical-align: baseline;
	align-items: center;
	justify-content: center;
	-webkit-user-select: none;
	-webkit-transition: 0.2s;
	cursor:pointer;
	}
.captcha:hover
{
	box-shadow: 0px 3px 10px rgba(0,0,0,0.50);
	}
.text-input-50
{
	width: 45%;
	padding-left: 2%;
	box-sizing: content-box;
	border-bottom: #00685C solid 2px !important;
	font-size:20px;
	opacity: 0.87;
	-webkit-transition: 0.2s;
	}
.text-input-50:focus
{
	border-bottom: #00685C solid 3px !important;
	opacity: 1;
}
</style>
</html>
