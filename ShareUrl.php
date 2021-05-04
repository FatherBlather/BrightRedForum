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

$FormText = "<form action='uploadURL.php' method='post' enctype='multipart/form-data'>
<table>
<tr>
<td>URL : </td>
<td><input  type='text' name='URL' style ='height:30px; width:600px;'/></td>
<td></td>
</tr>
<tr>
<tr>
<td>Title : </td>
<td><input  type='text' name='Title' style ='height:30px; width:600px;'/></td>
<td></td>
</tr>
<td>Post : </td>
<td> <textarea name='ThreadBody' cols='50' rows='5'> Enter your posts... 
</textarea>
 </td>
<td></td>
</tr>
<tr>
<td></td>
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



</body> 
</html> 
