<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
require("FileHandler.php");
//$col is an array containing all the columns present in Direct Expense Table
	$col=array("Expense ID","Invoice Date","Invoice Number","Order ID","Payment Currency","Payment Amount","Amount","Payment Date","Payment Type","Description","Reference No","Payment Mode","Payment Source ID","Vendor ID");     
//an sql query to select all rows of Direct Expense Reg table
	$q="SELECT * FROM `Direct Expense Register`";
//tells the no of colums present in the table
	$count=9;
//to print the line in bold 
	echo "<b>Details of Direct Expense  are :</b><br>&nbsp" ;
//$run is an array containing values for row	
$run=mysqli_query($con,$q)or die("error in joining Bank");
//make a table with border
echo"<table border=='1'>";
echo"<tr>";
//below lines are just to have headings of the rows		
		for($i=0;($i<$count);$i++)
		echo"<th>&nbsp $col[$i] </th>";
		echo "<th>Files</th>";
		echo "<th>Download All</th>";
echo"</tr>";
$num=mysqli_num_rows($run);
//stores the number of rows selected above 
for($i=0;$i<$num;$i++)
{
echo"<tr>";
//running the for loop to print all the files
	$row=mysqli_fetch_array($run);
	 for($j=0;($j<$count);$j++)
	 {
		 echo "<td>";echo $row["$col[$j]"]; echo"</td>" ;
	 }
//prints all the values stored in database
//$arr will fetch all the files present in that row whose all colums have been added now
	$numb=$row["Expense ID"];
	$arr=file_iterate("Direct Expense ID/$numb");
	 echo "<td><ul>";
//if the folder does not exist or is empty then No files would be displayed
	 if(count($arr)==0)
	 	 echo"<li>No Files</li>";
	 else
	 {
		$numb=$row["Expense ID"];
		createZip("Direct Expense ID/$numb");	//to make a zip file containg all the files
		for($j=0;$j<count($arr);$j++)
		{
			$directory=$row["Expense ID"];
			$tempvar=$arr[$j]['BaseName'];
			echo"<li>".$arr[$j]['BaseName'].
			"<span style='float:right;'><a href='Direct Expense ID/$directory/$tempvar.'>View</a>&nbsp"."<a href='Direct Expense ID/$directory/$tempvar.' download>Download</a>&nbsp</span>".
			"</li>";
		}	
	 }
	 //column to print view and download links
	 echo"</ul></td>";
$name=$row["Expense ID"].".zip";
	 echo"<td><a href='temp/$name' download>Download All</a></td>";
echo"</tr>";	 
}
//end of table
echo"</table>";
?>