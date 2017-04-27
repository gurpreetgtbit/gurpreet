<?php
session_start();

$con=mysqli_connect('localhost','root')or die("error in connecting");
$email=$_POST['email_id'];
$password=$_POST['pass1'];
$count=$_POST['counter'];
mysqli_select_db($con,'login');

$q="select * from registeration where email='$email'";
$run=mysqli_query($con,$q)or die("error in selection");

$row=mysqli_fetch_array($run);

if($row['password']==$password && $password!="")
{
	$_SESSION['count']=0;
	
	header("location:https://www.facebook.com/?stype=lo&jlou=AfeWY7ZueF1ZBkZY5DabUhlHJYoA2TpxVMeP1JYP1Atxgg6UoV_M1ckBNf7lf6Qabp8V4iWvVqRisAuJJ_ThFlTygUBdGemq8kiEOqNjZguXwA&smuh=51539&lh=Ac_XwZXfx0-fU0xv");
	die();
}
else
{
	$_SESSION['error']="EMAIL ID OR PASSWORD IS INCORRECT"; 
	$_SESSION['count']=$count+1;
	if($_SESSION['count']>5)
	{
		//if header is used than echo does not work
		echo"<script>alert('You have been blocked because of security reasons'); 
		window.location='http://www.google.com'
		</script>";
	}
	echo"<script>window.location='http://localhost:8080/login/login.php' </script>";
}
?>