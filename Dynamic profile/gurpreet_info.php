<?php
$con=mysqli_connect('localhost','root')or die("error in connecting");
mysqli_select_db($con,'login');
$name=$_GET['y'];

$query="select * from `registeration` where email='$name'" ;
$record =mysqli_query($con,$query) or die("error in selecting");

$row=mysqli_fetch_array($record) ;
mysqli_select_db($con,'counter');
$query="select * from `view` where ID='$name'" ;
$record =mysqli_query($con,$query) or die("error in selecting2");

$row1=mysqli_fetch_array($record) ;
	
	
?>
<html>
<head>
<title>Volunteer Details</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body >
<script>
window.onload=function check()
{
var namee='<?php echo $row[0]?>';
document.getElementsByName('Name')[0].value='<?php echo $row[0]?>';
document.getElementsByName('username')[0].value='<?php echo $row[1]?>';
document.getElementsByName('Email')[0].value='<?php echo $row[2]?>';
document.getElementsByName('Gender')[0].value='<?php echo $row[4]?>';
document.getElementsByName('Bday')[0].value='<?php echo $row[8]?>';

document.getElementsByName('Visits')[0].value='<?php echo $row1[1]?>';

var visible='<?php echo $row[7]?>';
if(visible==1)
{
	var location='<?php echo $row[5]?>';
	var row1=document.getElementById('location');
	var data=document.createElement("td");
	data.innerHTML="Location";
	data.colspan="6";
	row1.appendChild(data);
	var row2=document.getElementById('loc');
	var data1=document.createElement("td");
	var inp=document.createElement("input");
	inp.value=location;
	inp.type="text";
	inp.style="width:200";
	data1.appendChild(inp);
	row2.appendChild(data1);
}

}
</script>
<center>
<form  id="form" style="width:24%;vertical-align:middle" >
<table cellspacing="10">
<tr>
</tr>
<tr>
</tr>
<tr>
<td colspan="6"><b> Name </b> </td>
</tr>
<tr>
<td colspan="6" ><input type="text" placeholder="name" name="Name" readonly="readonly" style="width:200"/></td>
</tr>
<tr>
<td colspan="6">Username </td>
</tr>
<tr>
<td colspan="6"><input type="text" readonly="readonly" name="username" style="width:200"/></td>
</tr>
<tr>
<td colspan="6">Email address</td>
</tr>
<tr>
<td colspan="6"><input type="email" readonly="readonly" placeholder="anything@something.com" readonly="readonly" style="width:200" name="Email"/> </td>
</tr>
<tr>
<td colspan="6">Bithday</td>
</tr>
<tr>
<td colspan="6"><input type="text" readonly="readonly" placeholder="date month year" readonly="readonly" style="width:200" name="Bday"/> </td>
</tr>

<tr>
<td colspan="6"> Gender</td>
</tr>
<tr>
<td colspan="6"><input type="text" readonly="readonly" placeholder="Gender" readonly="readonly" style="width:200" name="Gender"/> </td>
</tr>


<tr>
<td colspan="6">Visits</td>
</tr>
<tr>
<td colspan="6"><input type="text" readonly="readonly" placeholder="Visits" readonly="readonly" style="width:200" name="Visits"/> </td>
</tr>


<tr id="location">

</tr>
<tr id="loc">

</tr>



</table>
</form>
</center>
</body>
</html>