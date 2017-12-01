<?php 
session_start();
unset($_SESSION['login1']);
$bool=isset($_SESSION['error']);
if ($bool)
{
	$val=$_SESSION['error'];
	unset($_SESSION['error']); 
}	
?>

<script>
var attempts='<?php echo $counting;?>';
if(attempts>5)
{
	alert('You have been blocked because of security reasons'); 
	window.location='http://www.google.com';
}
</script>
<script>
var error='<?php echo $bool; ?>';
var msg='<?php echo $val; ?>';

if(error)
{
alert(msg);
msg=null;
}
</script>
<html>
<head>
<title> a login page</title>

<meta name="viewport" content="width=device-width ,initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="style1.css"/>
</head>

<div class ="navbar navbar-default navbar-fixed-top" >
<div class="container-fluid">
<div class="navbar-header">
<a  class="navbar-brand"><img src="daya.jpg" class="navbar-brand  circle">BhaiDayaSingh</img></a>
</div>
<ul class="nav navbar-nav ">
<li><a href="#">Home</a></li>
<li class="dropdown">
	<a href="#"class="dropdown-toggle" data-toggle="dropdown" >Software<span class="caret"></span></a>
		<ul class="dropdown-menu" >
			<li><a href="#">Notepadd++</a></li>
			<li><a href="#">WAMP</a></li>
		</ul>
	 </li>
<li><a href="#">About Us</a></li>
</ul>
<ul class="navbar-nav nav navbar-right">
<li><a href="form.php">Register</a></li>
<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown">Sign In<span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="login.php">Students</a>
			<li><a href="login(teacher).php">Teachers</a>
		</ul>
</li>
<li><a href="#">Contact Us</a></li>
</ul>
</div>
</div>
</br></br>
<body  style="background:#eee">
<div class="modal-dialog">
 <div class="modal-content">
   <div class="modal-header">
   <h1 class="text-center">Admin</h1>
   </div>
   <div class="modal-body">
     <form class="col-md-12 center-block" action="s.php" method="post">
	 <div class="form-group">
	 <input type="text" class="form-control input-lg" placeholder="Email" name="email_id"/>
	 </div>
	 <div class="form-group">
	 <input type="password" class="form-control input-lg" placeholder="Password" name="pass1"/>
	 </div>
	 <div class ="form-group">
		<input type="hidden" name="counter" value=0 class="form-control input-lg"/>
	 </div>
	 <div class="form-group">
		<input type="submit" class="btn btn-block btn-lg btn-primary" name="Sbutton" value="Login"/>
	 </div>
	 <span class="pull-right"><a href="form.php">REGISTER</a></span>
	 <span><a href="@">Forgot Password</a></span>
	</form>
   </div>
   <div class="modal-footer">
   <div class="col-md-12">
   <button class="btn">Cancel</button>
   </div>
   </div>
  </div>
 </div>

<script>

var count=document.getElementsByName("counter")[0];
var no=count.value;
count.value='<?php echo"$counting" ?>';
</script>


</body>
</html> 