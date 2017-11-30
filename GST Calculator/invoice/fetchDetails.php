<?php
require("SqlFunctions.php");
$type=$_GET['type'];
//$type is to get the fuction which requires the values to be fetched in html page
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
function selectValue($attr,$table,$key,$value)
{
	$result=getAttribute($table , $attr , $key , $value);
	echo $result;

}

switch($type){

case "Value":
$attr=$_GET['attr'];
$table=$_GET['table'];
$key=$_GET['key'];
$value=$_GET['value'];
selectValue($attr,$table,$key,$value);
break;

case "colvalue":
$col=$_GET['col'];
$table=$_GET['table'];
selectColumn($col,$table);
break;
}/*
*/
?>