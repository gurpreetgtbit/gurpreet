<?php
/*
create table `invoice`(`soldBy` varchar(200),`BillingAddress` varchar (200),`panNo` varchar(20),`GSTRegistrationNo` varchar(20),ShippingAddress Varchar(200),`OrderId` varchar(50),`OrderDate` date NOT NULL,`Invoice Number` varchar(30) NOT NULL,`Invoice Date` date NOT NULL,  `Goods Description` varchar(200) NOT NULL,`Currency` enum('USD','INR') NOT NULL DEFAULT 'USD', `Total Amount` int(11) NOT NULL, `Payment Status` varchar(100) NOT NULL)
*/
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
require("SmartSmithDetails.php");

	$order_ID = $_GET['id'];
	echo "<img src=SmartSmith-Logo height='102' width='272'>";
	echo "<div style='float:right';><h2>Tax Invoice/Bill of Supply/Cash Memo</h2></div>";
//stores all the values which are o be shown on php page of invoice
	$col = array('SoldBy','BillingAddress','panNo','ShippingAddress','GSTRegistrationNo','Invoice Number','Order ID','Invoice Date','Order Date','Item Name','Product Type','Color','Details','Weight (With Packing)','Unit Price','Quantity','Tax Amount','Shipping Cost','Total Amount') ;
//stores total lenth of col array
	$count = 19;
	$q = "SELECT * FROM `Order Register` WHERE `Order Register`.`Order ID`="."'$order_ID'";
	$q1 = "SELECT * FROM `Ordered Products` WHERE `Ordered Products`.`Order ID`="."'$order_ID'";
		
	echo "<center><b><h2>Details of Order are :</h2></b></center>&nbsp" ;	
	
	$run=mysqli_query($con,$q)or die("error in connecting table");
	$row=mysqli_fetch_array($run);
//$row and $run contains the info about the Order 
//run3 and row3 holds the product details 
	$run3=mysqli_query($con,$q1)or die("error in connecting table1");

	$q="SELECT `Address` FROM `CustomerBase` WHERE `Customer ID`=".$row['Customer ID'];

	$run1=mysqli_query($con,$q)or die("error in connecting table2");
	$row1=mysqli_fetch_array($run1);
//$run1 and $row1 contains info about the Customer
	

	echo"
	<div style='float:right';>";
	echo"<b>&nbsp</br>".$col[1] .":-</br><b>";
	$arr2 = str_split($row1['Address']);
	for ($no=0;$no<strlen($row1['Address']);$no++)
	{
		echo $arr2[$no];
		if($arr2[$no]==',')
		echo "</br>";
	}
	
	echo"</br><b>&nbsp</br>".$col[3] .":-</b></br>";
	$arr2 = str_split($row1['Address']);
	for ($no=0;$no<strlen($row1['Address']);$no++)
	{
		echo $arr2[$no];
		if($arr2[$no]==',')
		echo "</br>";
	}
	for($i=4;($i<9);$i++)
	{
		if($i%2!=0)
		{
			echo"</br><b>&nbsp</br>".$col[$i] .":-</b></br>";
			echo ($row["$col[$i]"]);			
		}

	}
	echo"</div> ";
	echo"<b>&nbsp</br>".$col[0] .":-</br></b>".SoldBy;
	echo"</br><b>&nbsp</br>".$col[2] .":-</br></b>".panNo;
	echo"<b>&nbsp</br>".$col[4] .":-</b></br>".GSTRegistrationNo;

	for($i=5;($i<9);$i++)
	{
		if($i%2==0)
		{
			echo"<b>&nbsp</br>".$col[$i] .":-</b></br>";
			echo ($row["$col[$i]"])."</br>";
		}

	}

	echo"</br></br></br></br>";
	//table starts
	echo"<center><table border=='1'>";
	echo"<tr>";
	echo"<th>&nbsp S.No </th>";
		for($i=9;($i<$count);$i++)
		 {
			echo"<th>&nbsp $col[$i] </th>";
		 }
	echo"</tr>";
	//headings of table given in above code 
	$num=mysqli_num_rows($run3);

	$temp=1;

	for($i=0;$i<$num;$i++)
	{
		$row3=mysqli_fetch_array($run3);//Fetching the table os Ordered Products
		//fetching the table of Products to have detail about that Product
		$q="SELECT * FROM `Products` WHERE `Product ID`=".$row3['Product ID'];
		$run2=mysqli_query($con,$q)or die("error in connecting table3");
		$row2=mysqli_fetch_array($run2);
		echo"<tr>";
	
		echo "<td>";echo $temp; echo"</td>" ;$temp++;
		for($j=9;($j<14);$j++)
		{
			echo "<td>";echo $row2["$col[$j]"]; echo"</td>" ;
		}
		for($j=14;($j<17);$j++)
		{
			echo "<td>";echo $row3["$col[$j]"]; echo"</td>" ;
		 
		}
		for($j=17;($j<$count);$j++)
		{
			echo "<td></td>" ;
		 
		}
	echo"</tr>";	 
	}
	//store all columns other than cost as empty and put the value of shipping cost and total amount in table
	echo"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>".$row["$col[17]"]."</td><td>".$row["$col[18]"]."</td></tr>";
	echo"</table></center>";

	echo"</br></br></br></br>
	<div style='float:right';>
	<img  src=sign height='42' width='172'>";
	echo"<h2><b ><u>Authority Signature</b></u></h2></div>";

?>