<?php

require("SqlFunctions.php");
$type=$_GET['type'];
function selectColumn($Id,$table)
{
	$result=sqltoarray($table);
	echo"<option>Please select your $Id</option>";
	//loops through all the values present in table
	for($i=0;$i<count($result);$i++)
	{
		//this would echo all the sorce ids as an option of select tag
		echo"<option>".$result[$i][$Id]."</option>";
	}
}

function selectRow($table,$col,$value,$type='json')
{
	
		$result=getSelectedRow($table,$col,$value);
		echo $result;
}

//3rd function
function selectoptions($table,$col)
{
	$enum=getEnumOptions($table , $col);
	echo"<option>Please select your $col</option>";
	$count=count($enum);
	for($i=0;$i<$count;$i++)
	{
		echo"<option> $enum[$i]</option>";
	}
}	

switch($type){

case "details":
$id=$_GET['id'];
$table=$_GET['table'];
$col=$_GET['col'];
selectRow("$table",$col,$id);
break;

case "option":
$table=$_GET['table'];
$col=$_GET['col'];
selectoptions("$table","$col");
break;

case "IndirectEx":
$col=$_GET['col'];
$table=$_GET['table'];
selectColumn($col,$table);
break;
}
?>