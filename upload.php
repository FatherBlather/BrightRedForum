<?php
include 'dbconnect.php';

$statusMsg = '';

$Title = $conn -> real_escape_string($_POST['Title']) ; 
$BodyText = $conn -> real_escape_string($_POST['ThreadBody']) ; 
	 

// File upload path
$targetDir = "upload/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$Thumbnail = "upload/Thumbnails/'$fileName'";
session_start();
$User = $_SESSION['username'];

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf', "webm", "mp4");
    if(in_array($fileType, $allowTypes)){

        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

            // Insert image file name into database
            $insert = $conn->query("INSERT into Threads (Title, Users, ThreadBody, filename) VALUES ('$Title', '$User','$BodyText', '$fileName')");
            if($insert){
               $statusMsg = "The file ".$fileName. " has been uploaded successfully."; 

		$targetFilePathArg = escapeshellarg($targetFilePath);
		$output=null;
		$retval=null;
		    $allowTypes = array('jpg','png','jpeg','gif');
		    if(in_array($fileType, $allowTypes)){
					 //exec("convert $targetFilePathArg -resize 300x200 ./upload/Thumbnails/'$fileName'", $output, $retval);
					 exec("convert $targetFilePathArg -resize 200x200 $Thumbnail", $output, $retval);
					echo "REturned with status $retval and output:\n" ; 
					if ($retval == null) { 
					echo "Retval is null\n" ;
					echo "Thumbnail equals $Thumbnail\n" ; 
									}
								}
							
							            }else{
							                $statusMsg = "File upload failed, please try again.";
echo '<pre>';
													print_r($_FILES);
													echo '</pre>';
							            } 
							        }else{
							            $statusMsg = "Sorry, there was an error uploading your file.";
echo '<pre>';
													print_r($_FILES);
													echo '</pre>';
							        }
    	}else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, mp4, webm & PDF files are allowed to upload.';
    }
}

else{
    $statusMsg = 'Please select a file to upload.';
}

$allowTypes = array('jpg','png','jpeg','gif');
if(in_array($fileType, $allowTypes)){

//Update SQL db by setting the thumbnail column to equal $Thumbnail
$update = $conn->query("update Threads set thumbnail = '$Thumbnail' where filename = '$fileName'");
            if($update){
               $statusMsg = "Updated the thumbnail to sql correctly.";
				echo $statusMsg ;  } 
				else 
				{ echo "\n Failed to update Thumbnail. Thumbnail equals $Thumbnail" ; } 

}

// Display status message
echo $statusMsg;
?> 

<?php header('index.php') ?>
<!DOCTYPE html>
<html>
   <body>
   setTimeout(function()
      <script>
         setTimeout(function(){
 
           window.location.href = 'index.php';
         }, 5000);
      </script>
      <p>Web page redirects after 5 seconds.</p>
   </body>
