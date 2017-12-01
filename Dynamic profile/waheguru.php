<?php
session_start();
if (!isset($_SESSION['login']))
{
	
	header("location:login(teacher).php");
}	
$name=$_GET['id'];
$con=mysqli_connect('localhost','root')or die("error in connecting");
mysqli_select_db($con,'counter');

/*$q="insert into view values($name,1,1)"or die("error");
mysqli_query($con,$q);
*/


$query="select * from `view` where ID='$name'" ;
$record =mysqli_query($con,$query) or die("error in selecting");
	
$row=mysqli_fetch_array($record) ;
	
	
	
if($row['ID']!='')
{
	$query="update `view` SET Visitor_view=Visitor_view+1 where ID='$name'";
	
	mysqli_query($con,$query)or die("cant update");
	
}
else{
	mysqli_query($con,"insert into view values('$name',1)")or die("cant insert value");
	
}
$qu="select sum(Visitor_view) from view  " ;
$re=mysqli_query($con,$qu) or die ("cant sum");
	$record =mysqli_fetch_array($re);
	
$p="select * from view order by Visitor_view DESC";
$data=mysqli_query($con,$p);

$num=mysqli_num_rows($data);
$number=($num>=10)?10:$num;

	
for($i=0;$i<$number;$i++)
{
	$value=mysqli_fetch_array($data);
	 $b[$i]=$value['ID'];
	
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
window.onload=function get()
{
	var followers='<?php echo $record[0]; ?>';
	var no='<?php echo $number; ?>';
	document.getElementById('count').value=followers;
	var num=(followers-(followers%100))/100;//for no of stars
	var a=[];
	 a[0]='<?php echo $b[0]?>';
	 a[1]='<?php echo $b[1]?>';
	 a[2]='<?php echo $b[2]?>';
	 a[3]='<?php echo $b[3]?>';
	 a[4]='<?php echo $b[4]?>';
	 
	if(num>3)
	{
		num=3;
	}
	if(followers>100)
	{
		
		for(var j=0;j<num;j++)
		{
			//for stars
			var place=document.getElementById('star');
			var img=document.createElement("img");
			img.src="star.jpg ";
			img.style="height:04%"
			place.appendChild(img);
			
		}
			var img1=document.createElement("img");
			img1.src="v.jpeg ";
			img1.style="height:04%"
			place.appendChild(img1)
		// for list
			
			var no='<?php echo $number ?>';
			for(i=0;i<5;i++)
			document.getElementById(i).innerHTML=a[i];
		document.getElementById('para').innerHTML="VOLUNTEERS";
		
		
			var place0=document.getElementById("a");
	place0.href="Gurpreet_info.php?y="+a[0];
	place0.style="color:pink";
	var place1=document.getElementById("b");
	place1.href="Gurpreet_info.php?y="+a[1];
	place1.style="color:pink";
	var place2=document.getElementById("c");
	place2.href="Gurpreet_info.php?y="+a[2];
	place2.style="color:pink";
	var place3=document.getElementById("d");
	place3.href="Gurpreet_info.php?y="+a[3];
	place3.style="color:pink";
	var place4=document.getElementById("e");
	place4.href="Gurpreet_info.php?y="+a[4];
	place4.style="color:pink";

	}

	
}
</script>
<script>
function logout()
{
	window.location='login(teacher).php'
}
</script>
<body style="background-image: url(back.jpg);
    background-size: 100% auto;" class="responsive" >
	
<div class ="navbar navbar-default navbar-top" >
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  <a  class="navbar-brand"><img src="daya.jpg" class="navbar-brand  circle">BhaiDayaSingh</img></a>
</div>
<div class="collapse navbar-collapse" id="myNavbar">
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



	<font color="white">
<p style="float:right"><a style="color:red" href="details.php" method ="get">Gurpreet</a></p>

<img src="me.jpg" style="height:20%;float:left"> </img>

<div style="margin-left:100px;">
<div id ="star"></div>
<br>
<br>
<br>
<p> Tag Line : <input type="text" class="text-danger"value="Life is all about second chance " readonly="readonly" style="width:300px"/></p>
<p>Followers:<input type="text" class="text-danger" readonly="readonly" id="count"style="width:80px"/ ><br><br>
<label>Channel: 1)TechTricks	</label>
<div style="padding-left:58px;">
<p> 2)Dhur Ki Baani</p> 
</div>
<div id ="list" style="margin-top:20%;float:right"; margin-left:80%">
<P id ="para"></p>
<ul id="list">
<a id="a" style="color:black"  method ="get"><li id="0"></li></a>
<a id="b" style="color:black"  method ="get"><li id="1"></li></a>
<a id="c" style="color:black"  method ="get"><li id="2"></li></a>
<a id="d" style="color:black"  method ="get"><li id="3"></li></a>
<a id="e" style="color:black"  method ="get"><li id="4"> </li></a>
</ul>
</div>
</div>
</font>
</body>
</html>