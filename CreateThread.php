<? include 'dbconnect.php'; 
session_start();?>

<html> 
<header> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all">
<title>Richies Image Board</title>

 <div class="header">
  <a href="index.php" class="logo">RED ARMY ONLINE</a>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Education</a>
    <a href="#about">Tech</a>
  </div>
</div> 
</header> 
<body> 


<?php 

$FormText = "<form action='upload.php' method='post' enctype='multipart/form-data'>
<table>
<tr>
<td>Title : </td>
<td><input  type='text' name='Title' style ='height:30px; width:600px;'/></td>
<td></td>
</tr>
<tr>
<td>Post : </td>
<td> <textarea name='ThreadBody' cols='50' rows='5'> Enter your posts... 
</textarea>
 </td>
<td></td>
</tr>
<tr>
<td></td>
<input type='file' name='file' />
<td><input type='submit' name='submit' value='Submit'/></td>
<td></td>
</tr>
</table> 
</form>";
session_start();
 if(isset($_SESSION['username'])){
		echo "$FormText ";
    }
    else { 
    
  echo " You are not logged in " ; 
    
    }
    
    ?>

<?php 
if (isset($_POST['submit']))
{
// Escape special characters, if any

	$Title = $conn -> real_escape_string($_POST['Title']) ; 
	$BodyText = $conn -> nl2br(real_escape_string($_POST['ThreadBody'])) ; 
	$User = $_SESSION['username'];
	 $sql = "INSERT INTO Threads (Title, Users, ThreadBody)
     VALUES ('$Title','$User', '$BodyText')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !" . "$User";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
  
     mysqli_close($conn);
}
?>



</body> 
</html> 
