<?php
//theFile
/**
 * $_FILES["myFile"]["name"] stores the original filename from the client
 * $_FILES["myFile"]["type"] stores the file’s mime-type
 * $_FILES["myFile"]["size"] stores the file’s size (in bytes)
 * $_FILES["myFile"]["tmp_name"] stores the name of the temporary file
 * $uploadFile["name"] stores the original filename from the client
 * $uploadFile["type"] stores the file’s mime-type
 * $uploadFile["size"] stores the file’s size (in bytes)
 * $uploadFile["tmp_name"] stores the name of the temporary file
 */
//define("UPLOAD_DIR", "");

	//uploadSaveFile("theFile");
	//echo "<br> Func Output : ".createZip('test/test1');
	//downloadZip(createZip('test/test1'));
	
	
function uploadSaveFile($fileName , $dir = "")
{
	if (!file_exists($dir))
			mkdir($dir, 0755, true);
		
	$i=0;
	while($i<count($_FILES[$fileName]['name'])) //Variable i moves from 0 to number of files
	{
		//Format Directory Name
		$dir = realpath ($dir) . "/";
		echo "</br>".$dir;
		$uploadFile = uploadFile($fileName , $i);
		//Create Directory if not exist
		
		// ensure a safe filename
		$name = format_file_name($uploadFile , $i);
		
		//echo $name;
	
		// don't overwrite an existing file
		$name = existance_name($dir , $name);
		
		checkSize($uploadFile);
		
		// preserve file from temporary directory
		savefile($dir, $i , $name , $uploadFile);
	
		// set proper permissions on the new file
		chmod($dir . $name, 0644);
		$i++;
	}
}

function uploadFile($fileName , $key=0)
{
	//echo $_FILES["$fileName"][$key];
	if (!empty($_FILES["$fileName"])) {	//If File Is Uploaded
		$uploadFile = $_FILES["$fileName"];	//Take file array dimension to $uploadFile single dimension
		//If there is error
		if ($uploadFile["error"][$key] !== UPLOAD_ERR_OK) {
			echo "<p>An error occurred.</p>";
			echo $uploadFile["error"][$key];
			exit;
		}
		return $uploadFile;
	}
}

function format_file_name($uploadFile, $key = 0)
{
	/**
 	* Removes special characters from the file name
	* $uploadFile name of file to format
	* returns string of formatted filename
 	*/
	//Remove Special Characters
	$name = preg_replace("/[^A-Z0-9._-]/i", "_", $uploadFile["name"][$key]);
	return $name;
}

function existance_name($dir , $filename)
{
	/**
 	* Check if the file already exist in given directory
	* if the filename already exist, rename the file appending a number to it
	* $dir name of the directory
	* $filename name of the file
	* Returns new filename
 	*/
	//echo $filename;
	$i = 0;
	$name = $filename ;
    $parts = pathinfo($name);
	while (file_exists($dir . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		//echo $name;
	}
	if ($name != $filename)
	{
		echo "<br>The file $filename already exist in directory.<br>";
		echo "The file Renamed to $name to avoid confilct.<br>";
	}
	return $name;
}

function savefile($dir , $key = 0 , $name , $file)
{
	/**
 	* Saves the uploaded file to required location
	* $dir The directory in which to save
	* $name the desired name of file to save
	* $file the file array of uploaded file
 	*/
	$success = move_uploaded_file($file["tmp_name"][$key],
        $dir . $name);
    if (!$success) { 
        echo "<br><p>Unable to save file.</p><br>";
        exit;
    }
	else
	{
		echo "<br>File Saved Successfully<br>";
		echo "The Uploaded file is : " . $dir . $name ."<br>";
	}	
}

function checkSize($file , $key = 0 , $allowed_size = 10)
{
	/**
 	* Checks if the size of file is less than the given file size
	* $file The file array
	* $allowedsize the maximum size of allowed file (Default 10 MB)
 	*/
	$filesize = $file["size"][$key]/1000000;	//Filesize in mb
	//echo $filesize;
	if ($filesize > $allowed_size)
	{
		echo "<br>The Size of file is greater than $allowed_size MB<br>";
		echo " This File Cannot be saved";
		exit ;
	}
}


//fuction to make a zip file containing all the files
function createZip($dir)
{
	$zipLocation = 'temp';
	//Create Zip Location Directory if not exist
	if (!file_exists($zipLocation))
    	mkdir($zipLocation, 0755, true);
	$files = file_iterate($dir); //Fetch all files
	$dirname = basename ( $dir ); //Directory Name 
	$zipname = $zipLocation.'/'.$dirname.'.zip'; //Zip File Location
	//create an object of ZipArchive
	$zip = new ZipArchive;
	//open the zip file to store files
	$zip->open($zipname, ZipArchive::CREATE);
	//fetch all the files of array one by one
	foreach ($files as $file) {
		// add files to zip , remove second parameter to retain root folder structure.
		$zip->addFile($file['RealPath'],$file['BaseName']);
	}
	//close the zip file
	$zip->close();
	return __dir__."/".$zipname;
}

//Download the zip file from the given link to zip file
function downloadZip($file)
{
	$filename = ($file);
	 if(file_exists($filename) && is_readable($filename) && file_exists($filename)){
             header("Content-Disposition: attachment; filename=".basename(str_replace(' ', '_', $filename)));
             header("Content-Type: application/force-download");
             header("Content-Type: application/octet-stream");
             header("Content-Type: application/download");
             header("Content-Description: File Transfer");
             header("Content-Length: " . filesize($filename));
             flush(); // this doesn't really matter.

             $fp = fopen($filename, "r");
             while (!feof($fp))
             {
                 echo fread($fp, 65536);
                 flush(); // this is essential for large downloads
             }
             fclose($fp);
         	 return;
    }
	else
		echo "<br>Error : Cannot Reda File <br>";
}


//Iterate all files recursively in given directory
function file_iterate($root)
{ 
if (is_dir($root)){
	$iter = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
		RecursiveIteratorIterator::SELF_FIRST,
		RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
	);
	$fileList = array();
	$paths = array($root);
	foreach ($iter as $path => $dir) {	
		if ($dir->isDir()) {
			//echo "<br><br>Directory : " . $dir . "<br>";
		}
		else{
			$path_parts = pathinfo($dir);
			$file = array (
			'BaseName' => $path_parts['basename'],
			'Extension' => $path_parts['extension'] ,
			'Path' => $path_parts['dirname'] ,
			'Name' => $path_parts['filename'] ,
			'Parent' => basename(dirname($dir)) ,
			'RealPath' => realpath($dir),
			'GrandParent' => basename(dirname($dir))
			);
			array_push($fileList , $file);
		}
	}
	return $fileList;
}
}
?>