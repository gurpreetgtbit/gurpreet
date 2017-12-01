<?php 
session_start();
$bool=isset($_SESSION['error']);
if ($bool)
{
	$val=$_SESSION['error'];
	unset($_SESSION['error']);
}	
	
  
?>
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


<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<script>
function validation()
{
	
	var result=true;
	var i=0;
	
	var password1=document.getElementsByName('pass1')[0].value;
	var password2=document.getElementsByName('pass2')[0].value;
	for(i=0;i<5;i++)
	{
	 var variable=document.getElementsByTagName('input')[i].value;
	 if (variable.length==0)
	 {
	  alert("INPUT FIED IS EMPTY");
	  result=false;
	  return result;
	 }
	}
	if(password1.length<6)
	{
	 alert("PASSWORD TOO SHORT");
	 document.getElementsByName('pass1')[0].value="";
	 document.getElementsByName('pass2')[0].value="";
	 result=false;
	}
	else if(password1!=password2)
	{
	 document.getElementsByName('pass1')[0].value="";
	 document.getElementsByName('pass2')[0].value="";
	 alert('PASSWORD DIDNT MATCH');
	 result=false;
	}
	return result;
	
}
</script>
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


<div class="modal-dialog">
 <div class="modal-content"style="background:#eee">
   <div class="modal-header" >
   <h1 class="text-center"><b>Registeration-Form</b></h1>
   </div>
   <div class="modal-body">
     <form class="col-md-12 center-block" action="save.php" method="post" enctype="multipart/form-data" onsubmit="return validation()">
	 <div class="form-group">
	 <label for="name">NAME</label></br>
	 <input type="text" class="input-lg" placeholder="First Name" name="Fname" class="name"/> 
	 <input type="text" class="input-lg" placeholder="Last Name" name="Lname" class="name"/>
	 </div>
	 <div class="form-group">
	 <label for="username">USERNAME</label>
	 <input type="text" class="form-control input-lg" placeholder="Username" name="username"/>
	 </div>
	 <div class ="form-group">
	 <label for="email_id">EMAIL</label>
	 <input type="email" class="form-control input-lg" placeholder="Email ID" name="email_id"/>
	 </div>
	 <div class="form-group">
	 <label for="pass1">CHOOSE PASSWORD</label>
	 <input type="password" class="form-control input-lg" placeholder="Password(atleast 6 charcters)" name="pass1"/>
	 </div>
	 <div class="form-group">
	 <label for="pass2">CONFIRM PASSWORD</label>
	 <input type="password" class="form-control input-lg" placeholder="Confirm Password" name="pass2"/>
	 </div>
	 <div class="form-group">
	 <label for="gender">GENDER</label>
	 <select class="form-control input-lg"name="gender">
		<option>Male</option>
		<option> Female</option>
	 </select>
	 </div>
	 <div class ="form-group">
	 <label for="location">LOCATION</label>
	 <input type="text" class="form-control input-lg" placeholder="Loaction" name="location"/>
	 </div>
	 <div class="form-group">
	 <label for="visible">Visibility Of Location</label>
	 <select class="form-control input-lg" name="visible">
		<option>Public(would be visible to all your fans)</option>
	    <option>Private(would not be visible to any fan)</option>
	 </select>
	 </div>
	 <div class ="form-group">
	 <label for="contact">CONTACT NO</label>
	 <input type="text" class="form-control input-lg" placeholder="Mobile Number" name="contact"/>
	<div class="form-group">
	<input type="submit" class=" btn btn-lg btn-block btn-primary" name="Sbutton" />
	</div>
	</form>
   </div>
   <div class="modal-footer">
   <div class="col-lg-12">
	 <a href="www.google.com"><button class="btn  ">Cancel</button></a>
   </div>
   </div>
  </div>
 </div>
</body>
</html> 