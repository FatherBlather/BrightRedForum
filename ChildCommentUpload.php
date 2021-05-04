<?php
include 'dbconnect.php';
session_start();

if(isset($_POST["submit"]) && !empty($_POST["ChildCommentText"])){
$id = intval($_SESSION['id']);
echo  $_SESSION['id'] . '<p> </p>'   ; 
$BodyText = $conn -> real_escape_string($_POST['ChildCommentText']) ; 
$User = $_SESSION['username'];
//To do: Change the "Test user" to actual user when user logins are created
	 $sql = "INSERT INTO Posts (User, ChildCommentText, IdOfThread)
     VALUES ('$User','$BodyText','$id')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }


     mysqli_close($conn);

}

?>