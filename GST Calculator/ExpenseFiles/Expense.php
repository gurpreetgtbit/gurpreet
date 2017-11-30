<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
require ("FileHandler.php");// Add this line to access upload files option

//it is to have the value which would be present in auto increment  for Order id 
$q="SELECT `Expense ID` FROM `Expense Register` ORDER BY `Expense Register`.`Expense ID` DESC";
$run=mysqli_query($con,$q)or die("error in joining Order");
$row=mysqli_fetch_array($run);
$EId= $row['Expense ID']+1;
$InvoiceDate=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$InvoiceNumber=$_POST['InvoiceNumber'];
$Purpose=$_POST['Purpose'];
$amount=$_POST['Amount'];
$PaymentDate=$_POST['p_year']."-".$_POST['p_month']."-".$_POST['p_day'];
$ExpenseType=$_POST['ExpenseType'];
$PaymentMode=$_POST['PaymentMode'];
$PaymentSourceID=$_POST['PaymentSourceID'];

//using the File Handler to upload all the files 
		//Here Direct Expense name is directory where files would be uploaded and $Eid i.e expense id would be the subdirectory
		uploadSaveFile("theFile","Expense ID/$EId");
		//Here Direct Expense name is directory where files would be uploaded and $Eid i.e expense id would be the subdirectory
		uploadSaveFile("theFile1","Expense ID/$EId");
$sql="INSERT INTO `Expense Register` VALUES('$EId','$InvoiceDate','$InvoiceNumber','$Purpose','$amount','$PaymentDate','$ExpenseType','$PaymentMode','$PaymentSourceID')";
//to store in Direct expense Register
//if every thing is perfect then go to respone.html
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
