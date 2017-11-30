<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
require ("FileHandler.php");// Add this line to access upload files option

$q="SELECT `Expense ID` FROM `Direct Expense Register` ORDER BY `Direct Expense Register`.`Expense ID` DESC";
$run=mysqli_query($con,$q)or die("error in joining Order");
$row=mysqli_fetch_array($run);
$EId= $row['Expense ID']+1;
$InvoiceDate=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$InvoiceNumber=$_POST['InvoiceNumber'];
$OrderID=$_POST['OrderID'];
$PaymentCurrency=$_POST['PaymentCurrency'];
$PaymentAmount=$_POST['PaymentAmount'];
$amount=$_POST['Amount'];
$PaymentDate=$_POST['p_year']."-".$_POST['p_month']."-".$_POST['p_day'];
$PaymentType=$_POST['PaymentType'];
$Description=$_POST['Description'];
$ReferenceNo=$_POST['ReferenceNo'];
$PaymentMode=$_POST['PaymentMode'];
$PaymentSourceID=$_POST['PaymentSourceID'];
$VendorID=$_POST['VendorID'];
		//Here Direct Expense name is directory where files would be uploaded and $Eid i.e expense id would be the subdirectory
		uploadSaveFile("theFile","Direct Expense ID/$EId");
		//Here Direct Expense name is directory where files would be uploaded and $Eid i.e expense id would be the subdirectory 
		uploadSaveFile("theFile1","Direct Expense ID/$EId");
	
$sql="INSERT INTO `Direct Expense Register` VALUES(NULL,'$InvoiceDate','$InvoiceNumber','$OrderID','$PaymentCurrency','$PaymentAmount','$amount','$PaymentDate','$PaymentType','$Description','$ReferenceNo','$PaymentMode','$PaymentSourceID','$VendorID')";
//to store in Direct expense Register
if($con->query($sql)==true)
{
	
header("Location:response.html");
exit();
}

else
{
echo "Error :" .$sql . $con->error;
}

?>