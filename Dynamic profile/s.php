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

if($row['password']==$password && $password!=""&&$email!="GurpreetSingh@gmail.com")
{
	
	$_SESSION['count']=0;
	$_SESSION['login1']=$row['email'];
	$link=$row['email'];
	header("location:".$link.".php");
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