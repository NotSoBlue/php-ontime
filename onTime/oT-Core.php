<?php 
session_start(); include 'oT-Connections.php';
#
# | onTime Database System
#

# | Declare as null

$reg_username = $reg_password = $reg_cpassword = $reg_nickname = $reg_email = 
$reg_phone = $reg_type = $reg_studtus = $reg_sn = $reg_name = $reg_refname = $reg_refcode =
$isRegister = $login_username = $login_password = $prof_id = $errormsg = null;

# | Initializing Important Variable

$arr_time = array('7:00am','8:00am','9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm',
				  '3:00pm','4:00pm','5:00pm','6:00pm','7:00pm','8:00pm','9:00pm');
$tema = array('red','pink','purple','deep purple','indigo','blue','light blue',
				'cyan','teal','green','light green','lime','yellow','amber','orange','deep orange');
$current_user = $_SESSION['session_user'];
$current_type = $_SESSION['session_type'];
$sql_get_current_info = "SELECT student_number, prof_id FROM tbl_account_manager WHERE username='$current_user';";
$current_res = $connectMe->query($sql_get_current_info);
while($current_row = mysqli_fetch_array($current_res,MYSQLI_ASSOC))
{
$current_sn = $current_row['student_number'];
$current_prof_id = $current_row['prof_id'];	
}

# | Get type of form 

$formType = $_REQUEST['form_type'];

# Start | Form Controls

# Start | Form Register 

if($formType == 'register')
{

# | Fetch Values from Form Register

$reg_username = test_input($_POST['form-register-username']);	
$reg_password = test_input($_POST['form-register-password']);
$reg_confirm_password = test_input($_POST['form-register-confirm-password']);

$reg_nickname = test_input($_POST['form-register-nickname']);
$reg_email = test_input($_POST['form-register-email']);
$reg_phone = test_input($_POST['form-register-num']);
$reg_type = $_POST['form-register-type'];
$reg_studtus = $_POST['form-register-studtus'];

$uname_char_bilang=strlen($reg_username);
$password_char_bilang=strlen($reg_password);
$nickname_char_bilang=strlen($reg_nickname);
$number_char_bilang=strlen($reg_phone);

$throwerrors = null;
$con_username = $con_password = $con_nickname = $con_email = $con_num = $reg_confirm = false;

# | Get Values from DB

$sql_get_reg_list = "SELECT username, email, phone_number, student_number FROM tbl_account_manager";
$res = $connectMe->query($sql_get_reg_list);
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
$poll_username[] = $row['username'];
$poll_email[] = $row['email'];
$poll_phone_number[] = $row['phone_number'];
$poll_student_number[] = $row['student_number'];
	}
# | Validation

	if (empty($_POST["form-register-username"])) {	$throwerrors = $throwerrors . "<li><b>Username</b> is required</li>";}
		else if(!preg_match("/^[a-zA-Z0-9]*$/",$reg_username)) { $throwerrors = $throwerrors . "<li>Invalid <b>username</b> (Alphanumeric only, no spaces)</li>"; }
		else if($uname_char_bilang<=3 || $uname_char_bilang>=22){ $throwerrors = $throwerrors ."<li><b>Username</b> minimum of 4 characters</li>"; }
		else if(in_array($reg_username,$poll_username)){ $throwerrors = $throwerrors ."<li><b>Username</b> already in use</li>"; }
		else { $con_username = true; }
	if (empty($_POST["form-register-password"])){ $throwerrors = $throwerrors ."<li><b>Password</b> is required</li>"; } 
		else if($password_char_bilang<=7 || $password_char_bilang>=25){ $throwerrors = $throwerrors . "<li><b>Password</b> minimum of 8 characters</li>";}
		else if ($reg_password!=$reg_confirm_password){ $throwerrors = $throwerrors . "<li><b>Password</b> does not match</li>"; }
		else{ $con_password = true; }
	if (empty($_POST["form-register-nickname"])){ $throwerrors = $throwerrors . "<li><b>Nickname</b> is required</li>"; }
		else if(!preg_match("/^[a-zA-Z ]*$/",$reg_nickname)) { $throwerrors = $throwerrors . "<li>Invalid <b>nickname</b> (Alphabetical only, no spaces)</li>"; }
		else if($nickname_char_bilang <= 1 || $nickname_char_bilang >= 16) { $throwerrors = $throwerrors ."<li><b>Nickname</b> minimum of 4 characters</li>"; }
		else{  $con_nickname = true; }
	if (empty($_POST["form-register-email"])) {	$throwerrors = $throwerrors . "<li><b>E-mail</b> is required</li>"; }	
	else if(in_array($reg_email,$poll_email)){ $throwerrors = $throwerrors ."<li><b>E-mail</b> already in use</li>"; }else{ $con_email = true; }
	if (empty($_POST["form-register-num"]))   { $throwerrors = $throwerrors . "<li><b>Phone number</b> is required</li>"; }
	else if(in_array($reg_phone,$poll_phone_number)){ $throwerrors = $throwerrors ."<li><b>Phone number</b> already in use</li>"; }else{ $con_num = true; }
	
	if($reg_type == 'Student')
	{ $con_sn = false; $reg_sn = $_POST['form-register-sn'];
	$sql_get_studno = "SELECT student_number FROM tbl_south_student_info WHERE student_number='$reg_sn"."-M';";
	$res = $connectMe->query($sql_get_studno);
	while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
	$poll_db_student_number = $row['student_number'];
	}
	if (empty($_POST["form-register-sn"]))   { $throwerrors = $throwerrors . "<li><b>Student number</b> is required</li>"; }
	else if($reg_sn != rtrim($poll_db_student_number,"-M")){ $throwerrors = $throwerrors . "<li>No match of your <b>student number</b>, please contact the administrators</li>";}
	else if(in_array($reg_sn,$poll_student_number)){ $throwerrors = $throwerrors ."<li><b>Student number</b> already in use</li>"; }
	else{ $con_sn = true;}
	$con_admin = true;
	}
	else {
	$con_admin = false;
	$reg_name = $_POST['form-register-name'];
	$reg_refname = $_POST['form-register-refname'];
	$reg_refcode = $_POST['form-register-refcode'];
	$sql_get_referral = "SELECT referral_name, referral_code, referral_prof_id, referral_is_used FROM tbl_referral WHERE referral_code='$reg_refcode';";
	$res = $connectMe->query($sql_get_referral);
	while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
	$poll_ref_name = $row['referral_name'];
	$poll_ref_code = $row['referral_code'];
	$poll_ref_prof_id = $row['referral_prof_id'];
	$poll_ref_isUsed = $row['referral_is_used'];
	}
	
	if(empty($reg_name)||empty($reg_refname)||empty($reg_refcode)){
	$throwerrors = $throwerrors ."<li><b>All Campus Information</b> required</li>";
	}
	else if(empty($poll_ref_code)){
	$throwerrors = $throwerrors ."<li><b>No matched Referral Code</b></li>";
	}
	else if($reg_refname!=$poll_ref_name)
	{ 
	$throwerrors = $throwerrors ."<li>Wrong <b>Referral Name</b></li>";
	}
	else if($poll_ref_isUsed==0)
	{ 
	$throwerrors = $throwerrors ."<li><b>Referral Code Already Used!</b></li>";
	}
	else
	{
	$con_admin = true;
	$prof_id =	$poll_ref_prof_id;
	}
	$con_sn = true;
	}
	if($con_username === true && $con_password === true && $con_nickname === true &&
	$con_email === true && $con_num === true && $con_sn === true && $con_admin = true) 
	{ $reg_confirm = true; }
	else{ echo "<ul>" . $throwerrors . "</ul>#no"; }

# | Inserting to database
if($reg_confirm === true){
$sql = 
"INSERT INTO tbl_account_manager 
	(username, 
	 password, 
	 nickname, 
	 email, 
	 phone_number, 
	 account_type, 
	 status, 
	 student_Number, 
	 your_name, 
	 prof_id, 
	 referral_username, 
	 referral_code, 
	 date_registered)
VALUES 
	('$reg_username', 
	 '$reg_password',
	 '$reg_nickname', 
	 '$reg_email', 
	 '$reg_phone', 
	 '$reg_type', 
	 '$reg_studtus', 
	 '$reg_sn', 
	 '$reg_name', 
	 '$prof_id', 
	 '$reg_refname', 
	 '$reg_refcode', 
	 '$getDateNow')
	 ;";
if($reg_type=='Administrator'||$reg_type=='Professor')
{
$sql_used_ref = "UPDATE tbl_referral SET referral_is_used = " . true . " WHERE referral_code = '$reg_refcode';";
}
if ($connectMe->query($sql) === TRUE) {   
echo "Log-in now?#ok#";
$_SESSION['session_r_user'] = $reg_username;
$_SESSION['session_r_nickname'] = $reg_nickname;
$_SESSION['session_r_type'] = $reg_type;
$_SESSION['session_r_studtus'] = $reg_studtus;
}
else {
	echo "Error: " . $sql . "<br>" . $connectMe->error + "#no";
	}
}
	}

#  End | Form Register

#  Start | Form Log-in

else if($formType == 'login')
{

# | Fetching data from form

$login_username = $_POST['form-log-in-username'];
$login_password = $_POST['form-log-in-password'];

# | Logged as Regular Student

if($login_username >= 20000000&&$login_username <= 20170000)
{
$login_password = strtolower($login_password);
# | Use student number for logging in
$sql_get_uname_pass = "
SELECT 
	left(student_number,8) AS 'student_number', student_firstname 
FROM 
	tbl_south_student_info 
WHERE 
	left(student_number,8)='$login_username';";
$res = $connectMe->query($sql_get_uname_pass);
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
$con_log_username = $row['student_number'];
$con_log_password = strtolower($row['student_firstname']);
$con_log_nickname = ucwords(strtolower($row['student_firstname']));
}

$con_log_type = "Student";
$con_log_studtus = "Regular";
	}
else
{

# | Run SQL Query for username

$sql_get_uname_pass = "SELECT username, password, nickname, account_type FROM tbl_account_manager WHERE username='$login_username';";
$res = $connectMe->query($sql_get_uname_pass);

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
$con_log_username = $row['username'];
$con_log_password = $row['password'];
$con_log_nickname = $row['nickname'];
$con_log_type = $row['account_type'];
$con_log_studtus = $row['status'];
}
	}
# | Validation for log-in form

if(empty($con_log_username)||empty($con_log_password))
{ echo "Log-in failed, <b>username doesn't exists</b>#no"; }
else
{
if($con_log_username == $login_username && $con_log_password == $login_password)
 { 
 $_SESSION['session_user'] = $login_username;
 $_SESSION['session_nickname'] = $con_log_nickname;
 $_SESSION['session_type'] = $con_log_type;
 $_SESSION['session_studtus'] = $con_log_studtus;
 echo "Log-in Successful.#ok#";
 }
else
 { echo "Log-in failed, <b>wrong password</b>#no"; }
}
}

else if($formType == 'rlogin')
{
# Start | Register Log-in
$_SESSION['session_user'] = $_SESSION['session_r_user'];
$_SESSION['session_nickname'] = $_SESSION['session_r_nickname'];
$_SESSION['session_type'] = $_SESSION['session_r_type'];
$_SESSION['session_studtus'] = $_SESSION['session_r_studtus'];
# End | Register Log-in
}

# End | Form Log-in
# Start | Get Student Info by Student Number

else if($formType == 'getstudinfo'){
	$studno = $_GET['student_number'];
	$sql_get_studinfo = "SELECT student_fullname, student_fullcourse, student_number FROM tbl_south_student_info WHERE student_number='$studno';";
	$res = $connectMe->query($sql_get_studinfo);
	while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
	$con_sn_fullname = $row['student_fullname'];
	$con_sn_fullcourse = $row['student_fullcourse'];
	$con_sn_number = $row['student_number'];
	}
	if(!empty($con_sn_number)){
	echo "<br><br><h2 class='prmtxt_b'><b>Name: " . $con_sn_fullname . "</b></h2>
	<h3 class='scndtext_b'><b>Course: </b>" . $con_sn_fullcourse . "</h3><br>
	<h3 class='scndtext_b'><b>Student Number: </b>" . $con_sn_number . "</h3>";}
	else
	{echo "<br><br><h2 class='prmtxt_b'><b>No Result..</b></h2>";}
	}
else if($formType == 'fetch_by_sched_code'){	
    $schedcode = $_REQUEST['send_sc'];
	$sql_get_subj_by_schedcode = "SELECT sbj_code, sbj_description, sbj_unit, sbj_year, sbj_section, sbj_course, sbj_sem FROM tbl_south_subject_info WHERE sbj_schedule_code = " . $schedcode . ";";
	
	if($res = $connectMe->query($sql_get_subj_by_schedcode))
	{
	while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
	$con_scc_code =  $row['sbj_code'];	$con_scc_description = $row['sbj_description'];
	$con_scc_unit = $row['sbj_unit'];	$con_scc_year = $row['sbj_year'];
	$con_scc_course = $row['sbj_course'];	$con_scc_section = $row['sbj_section'];
	$con_scc_sem = $row['sbj_sem'];	

		}
	if(!empty($con_scc_code)){
		echo "<p class='prmtxt_w'>Schedule code: " . $con_scc_code ."<br><br>Description: <br><b>" .	$con_scc_description 
			. "</b><br><br>Unit: " . $con_scc_unit . "<br><br> CYS: " . $con_scc_course ." ". $con_scc_year ."-". $con_scc_section . " - " . $con_scc_sem . " Sem</p>";
		$_SESSION['session_r_schedcode'] = $schedcode;
		}
	else{
		echo "<p class='prmtxt_w'>No result..</p>";
		$_SESSION['session_r_schedcode'] = "";
		}
	}
	else
	{
		$_SESSION['session_r_schedcode'] = "";
		}
	}
	else if($formType == "prof_add_subj" || $formType == "prof_edit_subj" )
	{
		if($formType == "prof_add_subj"){
		$pas_schedcode = $_POST['prof-add-schedcode'];
		$pas_room = $_POST['prof-add-room'];
		$pas_day = $_POST['prof-add-subj-day'];
		$pas_timein = $_POST['prof-add-subj-timein'];
		$pas_timeout = $_POST['prof-add-subj-timeout'];
		}
		else
		{
		$pas_schedcode = $_REQUEST['profesc'];
		$pas_room = $_POST['prof-edit-room'];
		$pas_day = $_POST['prof-edit-subj-day'];
		$pas_timein = $_POST['prof-edit-subj-timein'];
		$pas_timeout = $_POST['prof-edit-subj-timeout'];
			}
		$sql = "SELECT room_code FROM tbl_south_room_list WHERE room_status NOT LIKE '%special%'";
		$res = $connectMe->query($sql);
		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$roomcode[] = $row['room_code'];
		}
		
		if((!empty($pas_schedcode)&&!empty($pas_room)&&!empty($_SESSION['session_r_schedcode'])
							&&in_array($pas_room,$roomcode)&&$formType == "prof_add_subj")
		||(!empty($pas_room)&&$formType == "prof_edit_subj"))
		{

# | Start Professor Schedule Input Validations


if($formType == "prof_add_subj"){	
$sql2 = "SELECT * FROM tbl_south_prof_sched;";
}
else
{
$sql2 = "SELECT * FROM tbl_south_prof_sched WHERE ps_schedule_code <> '$pas_schedcode';";
	}
		$res2 = $connectMe->query($sql2);
		while($roww = mysqli_fetch_array($res2,MYSQLI_ASSOC)) {
		$pasc_prof_id[] = $roww['prof_id'];
		$pasc_schedule_code[] = $roww['ps_schedule_code'];
		$pasc_roomcode[] = $roww['ps_roomcode'];
		$pasc_day[] = $roww['ps_day'];
		$pasc_timein[] = $roww['ps_timein'];
		$pasc_timeout[] = $roww['ps_timeout'];
		}
		for($cc = 0; $cc <= count($pasc_prof_id); $cc++)
		{
		$check_the_time = timecovered(array_search($pasc_timein[$cc],$arr_time),
		array_search($pasc_timeout[$cc],$arr_time),
		array_search($pas_timein,$arr_time),
		array_search($pas_timeout,$arr_time));

				if($pas_room == $pasc_roomcode[$cc])
				{$isRoomOver = false;}
				else{$isRoomOver = true;}
				
				if($pas_day == $pasc_day[$cc])
				{$isDayOver = false;}
				else{$isDayOver = true;}
				
				if($pasc_schedule_code[$cc] == $pas_schedcode)
				{
				$sql_fetch_prof_info = "SELECT professor FROM tbl_south_prof_list WHERE prof_id = " . $pasc_prof_id[$cc] . ";";
				$res = $connectMe->query($sql_fetch_prof_info);
				while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
				{
				$panganame = $row['professor'];
					}
				$errormsg = "Schedule Code Already Used By: <br><b>$panganame</b><br>";
				$modal = "#no";
				$NoConflict = false;
				break;
					}	
				else if($isDayOver === false&&$check_the_time === false&&$current_prof_id == $pasc_prof_id[$cc])
				{
				$errormsg = "Possible Cause of this Error:<br><br>
				- Your own schedule was overlapped by your recently inserted schedule
				<br><br>
				If you think this is an error, <b>tell us about it</b>.
				";
				$modal = "#no";
				$NoConflict = false;
				break;
					}
				else if($isDayOver === false&&$check_the_time === false&&$isRoomOver === false)
				{
				$sql_fetch_prof_info = "SELECT professor FROM tbl_south_prof_list WHERE prof_id = " . $pasc_prof_id[$cc] . ";";
				$res = $connectMe->query($sql_fetch_prof_info);
				while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
				{
				$panganame = $row['professor'];
					}
				$errormsg = "
				<b>[PROF_ID: ".$pasc_prof_id[$cc]."]<br>
				Professor Name: $panganame<br><br>
				<div class='divider'> </div><br>
				Schedule Code: $check_the_schedcode<br>
				Room: ".$pasc_roomcode[$cc] ."<br>
				Day: ".$pasc_day[$cc]." <br><br><div class='divider'> </div><br>
				Time In: ".$pasc_timein[$cc]." <br>
				Time Out: ".$pasc_timeout[$cc]." <br>
				<br><div class='divider'> </div><br>
				Possible Action: Request</b>
				";
				$modal = "#pt#";
				$NoConflict = false;
				break;
					}	
				else
				{
				$NoConflict = true;
					}
		}
		if($NoConflict == true)
		{
		if($formType == 'prof_add_subj')
		{
		$pas_theme = $tema[(mt_rand(0,15))];
		$connectMe->query("
		INSERT INTO
			tbl_south_prof_sched
				(prof_id,
				ps_schedule_code,
				ps_roomcode,
				ps_day,
				ps_timein,
				ps_timeout,
				ps_theme)
		VALUES
			(	$current_prof_id,
				'$pas_schedcode',
				'$pas_room',
				'$pas_day',
				'$pas_timein',
				'$pas_timeout',
				'$pas_theme')
						   ;");
		echo "Schedule Succesfully Added.". $connectMe->error ."#ok#";
		}
		else
		{
		$connectMe->query("
		UPDATE
			tbl_south_prof_sched
		SET
				ps_roomcode = '$pas_room',
				ps_day = '$pas_day',
				ps_timein = '$pas_timein',
				ps_timeout = '$pas_timeout'
		WHERE
				prof_id = $current_prof_id
			AND
				ps_schedule_code = '$pas_schedcode'
						   ;");
			}
		echo "Schedule Succesfully Updated.". $connectMe->error ."#ok#";
		}
		else
		{
			echo trim($errormsg . $modal);
		}
		}
		else
		{
		echo "
			Possible Errors:<br><br>
			- You left the <b>Schedule Code</b> blank<br>
			- You left the <b>Room Code</b> blank<br>
			- No matched <b>Schedule Code</b><br>
			- No matched <b>Room Code</b><br><br>
			- <b>Room Code</b> might be in special status<br><br>
			If you think this is an error, <b>tell us about it</b>.
			#no";	
			}
	}
else if($formType == "populate_prof_sched_table")
{
$sql_pop_ps_table = "
SELECT
	 sps.ps_schedule_code,
 	 ssi.sbj_code,
	 ssi.sbj_description,
	 ssi.sbj_course,
	 ssi.sbj_year,
	 ssi.sbj_section,
	 sps.ps_roomcode, 
	 sps.ps_day,
	 sps.ps_timein,
	 sps.ps_timeout,
	 sps.ps_theme,
	 spl.professor,
	 am.nickname,	 
	 rl.room_name
FROM
	tbl_south_prof_sched sps
INNER JOIN
	tbl_south_prof_list spl
ON
	sps.prof_id = spl.prof_id
INNER JOIN
	tbl_south_subject_info ssi
ON
	sps.ps_schedule_code = ssi.sbj_schedule_code
INNER JOIN
	tbl_account_manager am
ON
	sps.prof_id = am.prof_id
INNER JOIN
	tbl_south_room_list rl
ON
	sps.ps_roomcode = rl.room_code
WHERE
	sps.prof_id = $current_prof_id
;";
$bunga = $connectMe->query($sql_pop_ps_table);
while($sanhi = mysqli_fetch_array($bunga,MYSQLI_NUM))
{
echo $sanhi[0] . "|" . $sanhi[1] . "|" . $sanhi[2] . "|" 
   . $sanhi[3] . "|" . $sanhi[4] . "|" . $sanhi[5] . "|"
   . $sanhi[6] . "|" . $sanhi[7] . "|" . $sanhi[8] . "|"
   . $sanhi[9] . "|" . $sanhi[10] . "|" . $sanhi[11] .  "|" 
   . $sanhi[12] . "|" . $sanhi[13] . "`";
	}
	}
else if($formType == "prof_del_sub")
{
	$connectMe->query("DELETE FROM tbl_south_prof_sched WHERE ps_schedule_code = " . $_GET['profdelsc'] . ";");
	echo $_GET['profdelsc'];
	}
else if($formType == "prof_stheme")
{
	$connectMe->query("UPDATE tbl_south_prof_sched SET ps_theme = '".$_REQUEST['thema']."' WHERE ps_schedule_code = '".$_REQUEST['sc']."'");
	echo $connectMe->error;
	}
else if($formType == 'bbf_table'||$formType == 'bbf_search')
{

$needle = $_GET['serts'];
$menu = $_REQUEST['bbf_menu'];
$switch = $formType;

if($menu=="all")
{
$res = $connectMe->query("
SELECT
	rs.room_code, 
	rs.room_name, 
	rs.room_floor, 
	rs.room_side, 
	rs.room_status,
	pl.PROFESSOR, 
	ps.ps_schedule_code,
	si.sbj_code,
	si.sbj_description,
	si.sbj_course,
	si.sbj_year,
	si.sbj_section,
	ps.ps_day, 
	ps.ps_timein, 
	ps.ps_timeout
FROM 
	tbl_south_room_list rs
LEFT JOIN
	tbl_south_prof_sched ps
ON
	rs.room_code = ps.ps_roomcode
LEFT JOIN
	tbl_south_prof_list pl
ON
	ps.prof_id = pl.prof_id
LEFT JOIN
	tbl_south_subject_info si
ON
	ps.ps_schedule_code = si.sbj_schedule_code
".searchparam($needle,$menu,$switch)."
ORDER BY rs.room_code ASC
;");

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo $row['room_code'] ."|". $row['room_name'] . "|" . $row['room_floor'] ."|"  
	. $row['room_side'] ."|" . $row['room_status'] . "|" . $row['PROFESSOR'] ."|"
	. $row['ps_schedule_code'] ."|<b>" . $row['sbj_code'] ."</b><br>". $row['sbj_description'] . "|" .  $row['sbj_course'] . "<br>"
	. $row['sbj_year'] . "-" . $row['sbj_section'] . "|" .$row['ps_day'] ."|"
	. $row['ps_timein'] . "|" . $row['ps_timeout'] . "`";
	}
}
else if($menu=="room")
{
$res = $connectMe->query("
SELECT
	rs.room_code, rs.room_name, rs.room_floor, rs.room_side, rs.room_status
FROM 
	tbl_south_room_list rs
".searchparam($needle,$menu,$switch)."
ORDER BY rs.room_code ASC;
");
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo $row['room_code'] ."|". $row['room_name'] . "|" . $row['room_floor'] ."|"  
. $row['room_side'] ."|" . $row['room_status'] . "`";
}
	}
else if($menu=="subject")
{
$res = $connectMe->query("
SELECT
	rs.room_code, 
	rs.room_name, 
	ps.ps_schedule_code,
	si.sbj_code,
	si.sbj_description,
	ps.ps_day,
	ps.ps_timein, 
	ps.ps_timeout
FROM 
	tbl_south_room_list rs
LEFT JOIN
	tbl_south_prof_sched ps
ON
	rs.room_code = ps.ps_roomcode
LEFT JOIN
	tbl_south_subject_info si
ON
	ps.ps_schedule_code = si.sbj_schedule_code
".searchparam($needle,$menu,$switch)."
ORDER BY rs.room_code ASC
;");

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo $row['room_code'] ."|". $row['room_name'] . "|"
	.$row['ps_schedule_code'] ."|<b>" . $row['sbj_code'] ."</b><br>". $row['sbj_description'] ."|"
	.$row['ps_day'] ."|" . $row['ps_timein'] . "|" . $row['ps_timeout'] . "`";
	}
}
else if($menu=="course")
{
$res = $connectMe->query("
SELECT
	rs.room_code, 
	rs.room_name, 
	ps.ps_schedule_code,
	si.sbj_code,
	si.sbj_description,
	si.sbj_course,
	si.sbj_year,
	si.sbj_section,
	ps.ps_day, 
	ps.ps_timein, 
	ps.ps_timeout
FROM 
	tbl_south_room_list rs
LEFT JOIN
	tbl_south_prof_sched ps
ON
	rs.room_code = ps.ps_roomcode
LEFT JOIN
	tbl_south_subject_info si
ON
	ps.ps_schedule_code = si.sbj_schedule_code
".searchparam($needle,$menu,$switch)."
ORDER BY rs.room_code ASC
;");

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo $row['room_code'] ."|". $row['room_name'] . "|"
	. $row['ps_schedule_code'] ."|<b>" . $row['sbj_code'] ."</b><br>". $row['sbj_description'] ."|" .  $row['sbj_course'] . "<br>"
	. $row['sbj_year'] . "-" . $row['sbj_section'] . "|" .$row['ps_day'] ."|"
	. $row['ps_timein'] . "|" . $row['ps_timeout'] . "`";
	}
}
else if($menu=="prof")
{
$res = $connectMe->query("
SELECT
	rs.room_code, 
	rs.room_name, 
	pl.PROFESSOR, 
	ps.ps_schedule_code,
	si.sbj_code,
	si.sbj_description,
	si.sbj_course,
	si.sbj_year,
	si.sbj_section,
	ps.ps_day, 
	ps.ps_timein, 
	ps.ps_timeout
FROM 
	tbl_south_room_list rs
LEFT JOIN
	tbl_south_prof_sched ps
ON
	rs.room_code = ps.ps_roomcode
LEFT JOIN
	tbl_south_prof_list pl
ON
	ps.prof_id = pl.prof_id
LEFT JOIN
	tbl_south_subject_info si
ON
	ps.ps_schedule_code = si.sbj_schedule_code
".searchparam($needle,$menu,$switch)."
ORDER BY rs.room_code ASC
;");

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo $row['room_code'] ."|". $row['room_name'] . "|" . $row['PROFESSOR'] ."|"
	. $row['ps_schedule_code'] ."|<b>" . $row['sbj_code'] ."</b><br>". $row['sbj_description'] . "|" .  $row['sbj_course'] . "<br>"
	. $row['sbj_year'] . "-" . $row['sbj_section'] . "|" .$row['ps_day'] ."|"
	. $row['ps_timein'] . "|" . $row['ps_timeout'] . "`";
	}
}
}
else if($formType == 'sch_table'||$formType == 'sch_search'||$formType == 'sch_ddpagi')
{
$needle = $_GET['serts'];
$menu = $_REQUEST['sch_menu'];
$switch = $formType;
$set = $_REQUEST['offset'];
$off = $set*50;
if($menu=="all")
{
$res = $connectMe->query("
SELECT 
ssi.sbj_schedule_code,
ssi.sbj_code,
ssi.sbj_description,
ssi.sbj_unit,
ssi.sbj_course,
ssi.sbj_year,
ssi.sbj_section
FROM 
tbl_south_subject_info ssi
".searchparam($needle,$menu,$switch)."
LIMIT $off,50
");

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo  $row['sbj_schedule_code'] ."|<b>" . $row['sbj_code'] ."</b><br>". $row['sbj_description'] . "|" .  $row['sbj_course'] . "<br>"
	. $row['sbj_year'] . "-" . $row['sbj_section'] . "`";
	}
}
else if($menu=="vacant")
{
$res = $connectMe->query("
SELECT 
ssi.sbj_schedule_code,
ssi.sbj_code,
ssi.sbj_description,
ssi.sbj_unit,
ssi.sbj_course,
ssi.sbj_year,
ssi.sbj_section
FROM 
tbl_south_subject_info ssi
LEFT JOIN
tbl_south_prof_sched ps
ON
ssi.sbj_schedule_code = ps.ps_schedule_code
".searchparam($needle,$menu,$switch)."
AND
ps.ps_schedule_code IS NULL
LIMIT $off,50
;");

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo  $row['sbj_schedule_code'] ."|<b>" . $row['sbj_code'] ."</b><br>". $row['sbj_description'] . "|" .  $row['sbj_course'] . "<br>"
	. $row['sbj_year'] . "-" . $row['sbj_section'] . "`";
	}
}
else if($menu=="occupied")
{
$res = $connectMe->query("
SELECT 
ssi.sbj_schedule_code,
ssi.sbj_code,
ssi.sbj_description,
ssi.sbj_unit,
ssi.sbj_course,
ssi.sbj_year,
ssi.sbj_section,
pl.professor,
ps_roomcode,
ps_day,
ps_timein,
ps_timeout
FROM 
tbl_south_subject_info ssi
INNER JOIN
tbl_south_prof_sched ps
ON
ssi.sbj_schedule_code = ps.ps_schedule_code
INNER JOIN
tbl_south_prof_list pl
ON
ps.prof_id = pl.prof_id
".searchparam($needle,$menu,$switch)."
LIMIT $off,50
;");
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
echo  $row['sbj_schedule_code'] 
	. "|<b>" . $row['sbj_code'] ."</b><br>" . $row['sbj_description'] 
	. "|" .  $row['sbj_course'] . "<br>" . $row['sbj_year'] . "-" . $row['sbj_section'] 
	. "|" . $row['professor'] . "|" 
	. $row['ps_roomcode'] . "|" 
	. $row['ps_day'] . "|" . $row['ps_timein'] . "|" . $row['ps_timeout'] . "`";
	}
}

else
{
echo "Tsigaymas suyo! hahahaha";
	}

echo $connectMe->error;
	}
else if($formType == 'sch_table_limit')
{
	$menu = $_REQUEST['sch_menu'];
	if($menu == 'all')
	{
	$res = $connectMe->query("
	SELECT 
		count(sbj_schedule_code) AS 'kawnt' 
	FROM 
		tbl_south_subject_info;");
		}
	else if($menu == 'vacant')
	{
	$res = $connectMe->query("
	SELECT 
		count(sbj_schedule_code) AS 'kawnt' 
	FROM
		tbl_south_subject_info ssi
	LEFT JOIN
		tbl_south_prof_sched ps
	ON
		ssi.sbj_schedule_code = ps.ps_schedule_code
	WHERE 
		ps.ps_schedule_code IS NULL;");
		}
	else if($menu== 'occupied')
	{
	$res = $connectMe->query("
	SELECT 
		count(sbj_schedule_code) AS 'kawnt' 
	FROM
		tbl_south_subject_info ssi
	LEFT JOIN
		tbl_south_prof_sched ps
	ON
		ssi.sbj_schedule_code = ps.ps_schedule_code
	WHERE 
		ps.ps_schedule_code IS NOT NULL;");
		}
	else
	{
	echo "Hoy Mali!";
		}
	
	while($row = mysqli_fetch_array($res,MYSQLI_NUM))
	{
		$kawnt = $row[0];
	}
	$howmanyresult = floor($kawnt/50);
	for($zxc = 1; $zxc <= $howmanyresult; $zxc++)
	{		echo "<option value='$zxc'> $zxc </option>";	}
}
else if($formType == "populate_room")
{
$sql_get_all_room = "
SELECT
	rl.room_code,
	rl.room_name,
	rl.room_floor,
	rl.room_side,
	rl.room_status
FROM
	tbl_south_room_list rl
";
	}
	else if($formType == "addprof_table")
	{
	$needle = $_REQUEST['apsearch'];
$sql_profulate = "
SELECT
	prof_id,
	professor,
	evaluators_limit
FROM
	tbl_south_prof_list
WHERE
	prof_id LIKE '%$needle%'
OR	professor LIKE '%$needle%'
OR	evaluators_limit LIKE '%$needle%'
";
$res = $connectMe->query($sql_profulate);
while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
{
	echo "<tr><td>".$row['prof_id'] ."</td><td>". $row['professor'] ."</td><td>". $row['evaluators_limit'] . "</td><tr>";
	}

		}
else if($formType=="addprof"){
$lname = $_POST['addprof-lname'];
$fname = $_POST['addprof-fname'];
$eval = $_POST['addprof-eval'];
$sql_addprof = "
INSERT INTO tbl_south_prof_list(
	professor,
	evaluators_limit)
VALUES(
	'$lname, $fname',
	'$eval'
	)
";
$connectMe->query($sql_addprof);
echo "Professor Successfully Added#ok";
	}
else{ echo "Please get out!"; }
#  End | Connection
$connectMe->close();

function timecovered($x,$y,$a,$b)
{
		if($y<=$a||$b<=$x)
		{return true;}
		else{return false;}	
}
function searchparam($needle,$menu,$switch){
	if(empty($switch))
	{
	return null;
		}
	else if($switch == "bbf_search")
	{
#########################################################
if($menu == "all")
	{
	return 	"
	WHERE 
			rs.room_code LIKE '%$needle%'
	OR		rs.room_name  LIKE '%$needle%'
	OR		rs.room_floor LIKE '%$needle%'
	OR		rs.room_side LIKE '%$needle%'
	OR		rs.room_status LIKE '%$needle%'
	OR		pl.PROFESSOR LIKE '%$needle%'
	OR		ps.ps_schedule_code LIKE '%$needle%'
	OR		si.sbj_code LIKE '%$needle%'
	OR		si.sbj_description LIKE '%$needle%'
	OR		si.sbj_course LIKE '%$needle%'
	OR		si.sbj_year LIKE '%$needle%'
	OR		si.sbj_section LIKE '%$needle%'
	OR		ps.ps_day LIKE '%$needle%'
	OR		ps.ps_timein LIKE '%$needle%'
	OR		ps.ps_timeout LIKE '%$needle%'";
		}
else if($menu == "room")
	{
	return 	"
	WHERE 
			rs.room_code LIKE '%$needle%'
	OR		rs.room_name  LIKE '%$needle%'
	OR		rs.room_floor LIKE '%$needle%'
	OR		rs.room_side LIKE '%$needle%'
	OR		rs.room_status LIKE '%$needle%'";
		}
else if($menu == "subject")
	{
	return 	"
	WHERE 
			rs.room_code LIKE '%$needle%'
	OR		rs.room_name  LIKE '%$needle%'
	OR		ps.ps_schedule_code LIKE '%$needle%'
	OR		si.sbj_code LIKE '%$needle%'
	OR		si.sbj_description LIKE '%$needle%'
	OR		ps.ps_day LIKE '%$needle%'
	OR		ps.ps_timein LIKE '%$needle%'
	OR		ps.ps_timeout LIKE '%$needle%'";
		}
else if($menu == "course")
	{
	return 	"
	WHERE 
			rs.room_code LIKE '%$needle%'
	OR		rs.room_name  LIKE '%$needle%'
	OR		ps.ps_schedule_code LIKE '%$needle%'
	OR		si.sbj_code LIKE '%$needle%'
	OR		si.sbj_description LIKE '%$needle%'
	OR		si.sbj_course LIKE '%$needle%'
	OR		si.sbj_year LIKE '%$needle%'
	OR		si.sbj_section LIKE '%$needle%'
	OR		ps.ps_day LIKE '%$needle%'
	OR		ps.ps_timein LIKE '%$needle%'
	OR		ps.ps_timeout LIKE '%$needle%'";		
	}
else if($menu == "prof")
	{
	return 	"
	WHERE 
			rs.room_code LIKE '%$needle%'
	OR		rs.room_name  LIKE '%$needle%'
	OR		pl.PROFESSOR LIKE '%$needle%'
	OR		ps.ps_schedule_code LIKE '%$needle%'
	OR		si.sbj_code LIKE '%$needle%'
	OR		si.sbj_description LIKE '%$needle%'
	OR		si.sbj_course LIKE '%$needle%'
	OR		si.sbj_year LIKE '%$needle%'
	OR		si.sbj_section LIKE '%$needle%'
	OR		ps.ps_day LIKE '%$needle%'
	OR		ps.ps_timein LIKE '%$needle%'
	OR		ps.ps_timeout LIKE '%$needle%'
	";		
	}
	}
##########################################################
else if($switch == "sch_search")
{
	if($menu == "all"||$menu == "vacant")
	{
		return 	"
		WHERE 
				ssi.sbj_schedule_code LIKE '%$needle%'
		OR		ssi.sbj_code LIKE '%$needle%'
		OR		ssi.sbj_description LIKE '%$needle%'
		OR		CONCAT(ssi.sbj_course, ' ',ssi.sbj_year, '-', ssi.sbj_section) LIKE '%$needle%'";	
	}
	else if($menu=="occupied")
	{
		return 	"
		WHERE 
				ssi.sbj_schedule_code LIKE '%$needle%'
		OR		ssi.sbj_code LIKE '%$needle%'
		OR		ssi.sbj_description LIKE '%$needle%'
		OR		CONCAT(ssi.sbj_course, ' ',ssi.sbj_year, '-', ssi.sbj_section) LIKE '%$needle%'
		OR		pl.professor LIKE '%$needle%'
		OR		ps_roomcode LIKE '%$needle%'
		OR		ps_day LIKE '%$needle%'
		OR		ps_timein LIKE '%$needle%'
		OR		ps_timeout LIKE '%$needle%'";
		}
	else
	{
	return null;
		}
	}
	else
	{
	return null;
		}
	}

?>