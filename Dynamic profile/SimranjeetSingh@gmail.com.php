<?php
session_start();
$bool=isset($_SESSION['login1']);
if($bool)
{
	if($_SESSION['login1']!="SimranjeetSingh@gmail.com")
	{	
		$exactlink=$_SESSION['login1'];
		header("location:".$exactlink);
	}
}
if(!$bool)
{
	header("location:login.php");
}

?>
<html>
<head>
<title> Waheguru</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script>

</script>
<script>
function logout()
{
	window.location='login.php'
}
</script>
<body style="background-image: url(back.jpg);
    background-size: 100% auto;"  >
	<div class ="navbar navbar-default navbar-top" >
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-target="#nav" data-toggle="collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a  class="navbar-brand"><img src="daya.jpg" class="navbar-brand  circle">BhaiDayaSingh</img></a>
</div>
<div class="collapse navbar-collapse" id="nav">
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
<li><a href="#" onclick="return logout()">Log Out</a></li>
<li><a href="#">Contact Us</a></li>
</ul>
</div>
</div>
</div>
</br></br></br>

	<font color="white">
	
<p style="float:right"><a style="color:red" href="gurpreet_info.php?y=SimranjeetSingh@gmail.com" method ="get">Simranjeet</a></p>

<img src="daya.jpg" style="height:20%;float:left"> </img>
<div style="margin-left:100px;">
<br>
<br>
<br>
<p> Tag Line : <input type="text" class="text-primary" value="Sant Sipahi" readonly="readonly" style="width:300px"/></p>
<label>channel: 1)Gatka	</label>
<div style="padding-left:58px;">

<p> 2)Sikhi</p> 
</div>
</div>
<p>Famous Personalities : <a href="waheguru.php?id=SimranjeetSingh@gmail.com">Gurpreet Singh</a>

</font>

</body>
</html>