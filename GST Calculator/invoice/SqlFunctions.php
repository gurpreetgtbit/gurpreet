<?php
require_once ("Config.php");// Add this line to access MySql Credentials
function sqltoarray($table)
{
	 /**
	 * Get data from sql table into an associated array.
	 * 
	 * Example:	 	echo '<pre>';
					print_r(sqltoarray('file'));
					echo '</pre>';
	 * 
	 * @param string $table as table name
	 * 
	 * @return associative array with SQL table data
	 */
	
	// Create connection

	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
	}
	$sql = "SELECT * FROM `$table`";		
	$result = mysqli_query($con,$sql);
	if (!$result) {
    	echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    	exit;
	}
	if (mysqli_num_rows($result) == 0) {
    	echo "No rows found, nothing to print so am exiting";
    	exit;
	}
	$result_data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$result_data[] = $row;
	}
	return $result_data;
}

function array_to_sql($queryData , $table , $multiple = false)
{
   /**
   * Put associative array values into table
   * Input associative array of data, and insert data into SQL Database
   *
   * @param array $queryData associative array of data, or array of associative array of data
   * @param string $table name of table, in which to insert data
   * @param boolean $multiple to define true if the query dara is array of associative array
   * that is, true if multiple data entries are provided
   */
	// Create connection
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
	} 
	
	//If single Entry
	if(!$multiple)
	{
		  if (count($queryData) > 0) {
			  foreach ($queryData as $key => $value) {
				  $value = "'$value'";
				  $updates[] = "$key = $value";
			  }
		  }
			  
		  $implodeArray = implode(', ', $updates);
		  
		  $sql = ("INSERT INTO `$table` (`".implode("` , `",array_keys($queryData))."`) "
				  . "VALUES ('".implode("' , '",array_values($queryData))."')"
				  . " ON DUPLICATE KEY UPDATE $implodeArray");
				  
		  if ($con->query($sql) === TRUE) {
			  echo "Request Updated";
		  } else {
			  echo "Error: ". "<br>" . $con->error . $sql;
		  }
	}
	//If multiple data
	else
	{
		foreach($queryData as $queryEntry)
		{
			  if (count($queryEntry) > 0) {
				  foreach ($queryEntry as $key => $value) {
					  $value = "'$value'";
					  $updates[] = "$key = $value";
				  }
			  }
			  
		      $implodeArray = implode(', ', $updates);
		  
			  $sql = ("INSERT INTO `$table` (`".implode("` , `",array_keys($queryEntry))."`) "
					  . "VALUES ('".implode("' , '",array_values($queryEntry))."')"
					  . " ON DUPLICATE KEY UPDATE $implodeArray");
					  	  
			if ($con->query($sql) === TRUE) {
    		echo "Request Updated";
  			} else {
    			echo "Error: ". "<br>" . $con->error . $sql;
			}
		}				  
	}		
}

function getAttribute($table , $attr , $key , $value)
{
	/**
	* Get $attr from $table, where $key = $value
	* Example:	 	echo getAttribute('mws_report_type' , 'Table Name' , 'ReportType' , 'key');
	* @param string $table as table name
	* @param string $attr 
	* @return string : Attribute Requested
	*/
	// Create connection
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
	} 
	
	$sql = "SELECT `$attr` FROM `$table` where `$key` = '$value'";		
	$result = mysqli_query($con,$sql);
	
	if (!$result) {
    	echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    	return;
	}
	if (mysqli_num_rows($result) == 0) {
    	echo "No rows found, nothing to print so am exiting";
    	return;
	}
	$row = mysqli_fetch_assoc($result);
	return $row["$attr"];
}

function getSelectedRow($table , $key , $value , $type = 'json')
{
	/**
	* Get selected row from $table, where $key = $value
	* Example:	 	print_r( getSelectedRow('Products' , 'MRP', '1499' , 'array'));
	* @param string $table as table name
	* @param string $Key , $Value  : The primary key, and it's value to select 
	* @return string : Array or Json format of requested row
	*/
	
	// Create connection
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
	if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
	} 
	
	//$result=sqltoarray($table)[0];
	$sql="select * from `$table` where `$key` ='$value'";
	$run=mysqli_query($con,$sql);
	$result=mysqli_fetch_array($run);
	if( $type == 'array')
		return $result;
	else if($type == 'json')
		return json_encode($result);
}

function getColumnValues($table , $columnName , $type = 'array')
{
	/**
	* Get Complete Column from $table
	* Example:	 	print_r( getColumnValues('Products' , 'Product ID' , 'array'));
	* @param string $table as table name
	* @param string $columnName : Name of column requested
	* @return string : Array or Json format of requested column
	*/
	
	// Create connection
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
	} 
	
	$sql="SELECT `$columnName` FROM `$table`";
	$run=mysqli_query($con,$sql)or die("error in connecting table");

	$num=mysqli_num_rows($run);
	$result = array ();
	for($i=0;$i<$num;$i++)
	{
		$row=mysqli_fetch_array($run);
		array_push($result , $row[$columnName]);
	}
	if($type == 'array')
		return $result;
	else if($type == 'json')
		return json_encode($result);
}

function getEnumOptions($table , $field , $ReturnType = 'array')
{
	/**
	* Get Enumeration Values from $table for $field
	* Example:	 	print_r(getEnumOptions('Products' , 'Weight Units' , 'array'));
	* @param string $table as table name
	* @param string $fiels : Name of column field requested
	* @return string : Array or Json format of requested enum values
	*/
	
	// Create connection
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
	} 
	
	$sql="SHOW COLUMNS FROM `$table` WHERE Field ='$field'";
	//echo $sql;
	$run=mysqli_query($con,$sql)or die("error in connecting table");
	$row=mysqli_fetch_array($run);
	
	$type=$row['Type']; //Get Type of Column
	
	preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches); //Separate enum Values
	$enum = explode("','", $matches[1]); //get enum values in array variable
	
	if($ReturnType == 'array')
		return $enum;
	else if($ReturnType == 'json')
		return json_encode($enum);	
}
?>