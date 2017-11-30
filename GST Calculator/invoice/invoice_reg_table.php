<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
	$order_ID=$_GET['id'];
	$col=array('Order ID','Invoice Number','Invoice Date','Order Date','Customer ID','Shipping Cost','Total Amount');
	$col1=array('Ordered Product ID','Order ID','Product ID','Unit Price','Quantity','Tax ID','Tax Amount');
	$q="SELECT * FROM `Order Register` WHERE `Order Register`.`Order ID`="."'$order_ID'";
	$q1="SELECT * FROM `Ordered Products` WHERE `Ordered Products`.`Order ID`="."'$order_ID'";
	$count=7;
	$count1=7;
	echo "<b>Details of Order are :</b><br>&nbsp" ;	

$run=mysqli_query($con,$q)or die("error in joining Order");

echo"<table border=='1'>";
echo"<tr>";
		 for($i=0;($i<$count);$i++)
		echo"<th>&nbsp $col[$i] </th>";
	echo"<th>&nbsp Invoice&nbsp</th>";
	echo"<th>&nbsp Product Slip&nbsp</th>";
echo"</tr>";

$num=mysqli_num_rows($run);
for($i=0;$i<$num;$i++)
{
echo"<tr>";
	$row=mysqli_fetch_array($run);
	for($j=0;($j<$count);$j++)
	 {
		 echo "<td>";echo $row["$col[$j]"]; echo"</td>" ;
	 }
	 echo "<td><a href='invoice.php?id=$order_ID'>Link</a></td>";
	 echo "<td><a href='productSlip.php?id=$order_ID'>Link</a></td>";

echo"</tr>";	 
}
echo"</table>";
echo "<b></br></br>Details of Product are :</b><br>&nbsp" ;	

$run=mysqli_query($con,$q1)or die("error in joining Product");

echo"<table border=='1'>";
echo"<tr>";
		 for($i=0;($i<$count1);$i++)
		echo"<th>&nbsp $col1[$i] </th>";
echo"</tr>";

$num=mysqli_num_rows($run);
for($i=0;$i<$num;$i++)
{
echo"<tr>";
	$row=mysqli_fetch_array($run);
	for($j=0;($j<$count1);$j++)
	 {
		 echo "<td>";echo $row["$col1[$j]"]; echo"</td>" ;
	 }
echo"</tr>";	 
}
echo"</table>";

?>