<?php
include 'dbconnect.php';
?>

<?php 
session_start();
/*Scan the Upvotes table to check if user has already upvoted the comment*/ 
$query = mysqli_query($conn, "SELECT * FROM Threads where id=$number")


/* +1 to the Threads.upvote column if conditions are met */
if(isset($_POST["ThreadID"]) && !empty($_SESSION['username']))
{
	$User = $conn -> real_escape_string($_SESSION['username']) ; 
	$id = $conn -> real_escape_string( $_POST["ThreadID"]) ; 
	echo "Thread id equals <br>" ; 
	echo $_POST['ThreadID']; 
	
	$sql = "UPDATE Threads
SET upvotes = upvotes + 1 
WHERE id = '$id'";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }


     mysqli_close($conn);
}


?>