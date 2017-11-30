<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
require ("SmartSmithDetails.php");//to add the details of the company

$order_ID=$_GET['id'];
$q="SELECT * FROM `Order Register` WHERE `Order Register`.`Order ID`="."'$order_ID'";
$run=mysqli_query($con,$q)or die("error in connecting table");
$row=mysqli_fetch_array($run);

$q="SELECT `Address` FROM `CustomerBase` WHERE `Customer ID`=".$row['Customer ID'];
$run=mysqli_query($con,$q)or die("error in connecting table");
$row1=mysqli_fetch_array($run);

echo"<center><h2>Product Slip</h2></center>";

echo"<div style='float:right'><b>From:</b>".
SoldBy."</div>";

echo"<b>To:</b></br>";

$arr2 = str_split($row1['Address']);
for ($no=0;$no<strlen($row1['Address']);$no++)
	{
		echo $arr2[$no];
		if($arr2[$no]==',')
		echo "</br>";
	}

?>