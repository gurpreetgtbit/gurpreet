<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
$oId=$_POST['Id'];
$InvoiceNumber=$_POST['InvoiceNumber'];
$InvoiceDate=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$OrderDate=$_POST['o_year']."-".$_POST['o_month']."-".$_POST['o_day'];
$ProductId=$_POST['ProductId'];
$CustomerId=$_POST['CustomerId'];
$UnitPrice=$_POST['UnitPrice'];
$Quantity=$_POST['Quantity'];
$TaxId=$_POST['TaxId'];
$items=$_POST['create'];

$q="SELECT `Tax Percentage` FROM `Tax Class` WHERE `Tax ID`=$TaxId";
$run=mysqli_query($con,$q)or die("error in finding tax %");
$row=mysqli_fetch_array($run);	
$TaxAmount=($UnitPrice*($row['Tax Percentage'])/100)*($Quantity);

$q="SELECT `Category ID` FROM `Products` WHERE `Product ID`=$ProductId";
$run=mysqli_query($con,$q)or die("error in finding categoryID");
$row=mysqli_fetch_array($run);	
$CategoryId=$row['Category ID'];

$q="SELECT `Custom Duty` FROM `Product Category` WHERE `Category ID`=$CategoryId";
$run=mysqli_query($con,$q)or die("error in finding CustomDuty");
$row=mysqli_fetch_array($run);	
$ShippingCost=(($row['Custom Duty']/100)*$UnitPrice)*($Quantity);

$TotalAmount=$ShippingCost+$TaxAmount+($UnitPrice*$Quantity);

//insert details into product
$sql="SELECT count(`Ordered Product ID`) as total from `Ordered Products`";
$run=mysqli_query($con,$sql)or die("error in joining Baaaank");
$row=mysqli_fetch_array($run);
$num= $row['total'];
$sql="INSERT INTO `Ordered Products` VALUES($num+1,'$oId','$ProductId','$UnitPrice','$Quantity','$TaxId','$TaxAmount')";
$con->query($sql);
//,'$ShippingCost','$TotalAmount'store the value of shipping Cost and Total Amount
for($i=0;$i<$items;$i++)
{
	$ProductId=$_POST['ProductId'.$i];
	$UnitPrice=$_POST['UnitPrice'.$i];
	$Quantity=$_POST['Quantity'.$i];
	$TaxId=$_POST['TaxId'.$i];	
	
	$q="SELECT `Tax Percentage` FROM `Tax Class` WHERE `Tax ID`=$TaxId";
	$run=mysqli_query($con,$q)or die("error in finding tax %");
	$row=mysqli_fetch_array($run);	
	$TaxAmount=($UnitPrice*($row['Tax Percentage'])/100)*($Quantity);

	$q="SELECT `Category ID` FROM `Products` WHERE `Product ID`=$ProductId";
	$run=mysqli_query($con,$q)or die("error in finding categoryID");
	$row=mysqli_fetch_array($run);	
	$CategoryId=$row['Category ID'];

	$q="SELECT `Custom Duty` FROM `Product Category` WHERE `Category ID`=$CategoryId";
	$run=mysqli_query($con,$q)or die("error in finding CustomDuty");
	$row=mysqli_fetch_array($run);	
	$ShippingCost+=(($row['Custom Duty']/100)*$UnitPrice)*($Quantity);
	
	$TotalAmount+=$ShippingCost+$TaxAmount+($UnitPrice*$Quantity);
	$sql="SELECT count(`Ordered Product ID`) as total from `Ordered Products`";
	$run=mysqli_query($con,$sql)or die("error in joining Bank");
	$row=mysqli_fetch_array($run);
	$num= $row['total'];
	$sql="INSERT INTO `Ordered Products` VALUES($num+1,'$oId','$ProductId','$UnitPrice','$Quantity','$TaxId','$TaxAmount')";
	$con->query($sql);	
}
$sql="INSERT INTO `Order Register` VALUES('$oId','$InvoiceNumber','$InvoiceDate','$OrderDate','$CustomerId','$ShippingCost','$TotalAmount')";
$con->query($sql);

header("Location:invoice_reg_table.php?id=".$oId);
exit();

?>
