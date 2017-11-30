<?php
require ("FileHandler.php");// Add this line to access upload files option

$EId=$_POST['ExpenseType'];
//$Eid takes the subdirectory of Expense table created in task 1
$i=0;
//fetch through all the file which have been chosen to upload 
		uploadSaveFile("theFile1","Direct Expense ID/$EId");
	
?>