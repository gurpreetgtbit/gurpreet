<?php
$name="gurpreet";
$con=mysqli_connect('localhost','root')or die("error in connecting");
$fname=$_POST['Fname'];
$lname=$_POST['Lname'];
$username=$_POST['username'];
$email=$_POST['email_id'];
$password1=$_POST['pass1'];
$gender=$_POST['gender'];
$location=$_POST['location'];
$contact=$_POST['contact'];
$visible=$_POST['visible'];
$name=$fname.' '.$lname;
if($visible=="Public(would be visible to all your fans)")
{
	$visible=1; 
}
else{
	$visible=0;
}
mysqli_select_db($con,'login')or die("db not selected");
{
$q="insert into registeration(name,username,email,password,gender,location,contact,visible) values('$name','$username','$email','$password1','$gender','$location','$contact','$visible')";
mysqli_query($con,$q)or die("we");
}
?>
<Html>
<head>
</head>
<body>
<h1><center > YOUR INFORMATION HAS BEEN SAVED</center></h1>
</body>
</html>