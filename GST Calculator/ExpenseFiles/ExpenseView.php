<?php
require ("config.php");// Add this line to access MySql Credentials
// Create connection
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
require("FileHandler.php");
//contains all the column name of Expense Register
	$col=array("Expense ID","Invoice Date","Invoice Number","Purpose","Amount","Payment Date","Expense Type","Payment Mode","Payment Source ID");     
	$q="SELECT * FROM `Expense Register`";
//no of columns 
	$count=9;
	echo "<b>Details of Expense  are :</b><br>&nbsp" ;
	
$run=mysqli_query($con,$q)or die("error in joining Bank");
//prints the table  with border
echo"<table border=='1'>";
echo"<tr>";
//echo all the heading of the table
		 for($i=0;($i<$count);$i++)
		echo"<th>&nbsp $col[$i] </th>";
		echo "<th>Files</th>";
		echo "<th>Download All</th>";
echo"</tr>";
$num=mysqli_num_rows($run);

for($i=0;$i<$num;$i++)
{
echo"<tr>";
	$row=mysqli_fetch_array($run);
	 for($j=0;($j<$count);$j++)
	 {
		//print all the value present in table named Expense Register
		 echo "<td>";echo $row["$col[$j]"]; echo"</td>" ;
	 }
//array containing all the files present in the folder Direct Expense Id 
	$numb=$row["Expense ID"];
	$arr=file_iterate("Expense ID/$numb");
	echo "<td ><ul>";
	 //if the folder does not exist or no file is present in that folde then print nno file
	 if(count($arr)==0)
	 	 echo"<li>No Files</li>";
	 else
	 {
		 $numb=$row["Expense ID"];
		createZip("Expense ID/$numb");
//run the fuction download which will create a zip file containg all the files
		for($j=0;$j<count($arr);$j++)
		{
			$directory=$row["Expense ID"];
			$tempvar=$arr[$j]['BaseName'];
			
			echo"<li>".$arr[$j]['BaseName'].
			"<span style='float:right;'>&nbsp&nbsp&nbsp<a href='Expense ID/$directory/$tempvar.'>View</a>&nbsp"."<a href='Expense ID/$directory/$tempvar.' download>Download</a>&nbsp</span>".
			"</li>";
		}	
	 }
	 //column to print view and download links
	 echo"</ul></td>";
//to remove the bullets of unorderd list
	 
//to create download link of zip file
$name=$row["Expense ID"].".zip";
	 echo"<td><a href='temp/$name' download>Download All</a></td>";
echo"</tr>";	 
}

echo"</table>";
?>