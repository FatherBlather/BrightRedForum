<?php
include 'dbconnect.php';
session_start();

if(isset($_POST["submit"]) && !empty($_POST["CommentText"])){
$id = intval($_SESSION['id']);
echo  $_SESSION['id'] . '<p> </p>'   ; 
$BodyText = $conn -> real_escape_string($_POST['CommentText']) ; 
$User = $_SESSION['username'];

//Replace flairs with <img> tags 
/*not working currently) */
$new = str_replace(":Stalin-tired","<img src='flairs/stalin-tired.jpg'> </img>","'$BodyText'");
echo "$new";
/************************/ 

	 $sql = "INSERT INTO Posts (User, CommentText, IdOfThread)
     VALUES ('$User','$new','$id')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }


     mysqli_close($conn);

}

?>
<!DOCTYPE html>
<html>
   <body>

      <script>
         setTimeout(function(){
 
  <?php echo          "window.location.href = 'viewthread.php?id=$id' "; ?>
         },20	000);
      </script>
      <p>Web page redirects after 2 seconds.</p>
   </body>