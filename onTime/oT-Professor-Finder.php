<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'oT-Homepage+Navbar.php'; 
$site = "prof-finder";
$user = $_SESSION['session_user'];
$name = "Professor Finder";
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

<body>
<!-- Nav bar starto --> 
<?php echo navbar($site,$name); ?> 
<!-- Lotus Starto -->
<?php echo lotus(); ?> 
<!-- Lotus Endo --> 
<!-- Nav bar Endo --> 
<!-- Content Starto -->

<?php echo filler(); ?>

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