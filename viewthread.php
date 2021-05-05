<!DOCTYPE html>

<html> 
<header> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all">
<title> Image Board</title>

 <div class="header">
  <a href="index.php" class="logo">RED ARMY ONLINE</a>
  <div class="header-right">
    <a class="active" href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Education</a>
    <a href="#about">Tech</a>
  </div>
</div> 
</header> 
<body> 

<!-- <a href="CreateThread.php"> <h1>Create Thread</h1> </a> --> 


<div class ='Thread-grid-container'>
<?php
include 'dbconnect.php';
$number = intval($_GET['id']) ; 
session_start();
$_SESSION['id'] = $number ;
$query = mysqli_query($conn, "SELECT * FROM Threads where id=$number")
   or die (mysqli_error($conn));
//Output Grid layout for a Thread post
while ($row = mysqli_fetch_array($query)) {
//output picture from upload folder
        $imageURL = 'upload/'.rawurlencode($row["filename"]);
  //Check if filename is a pdf otherwise output for image 
  if(strpos($imageURL, "pdf") !== false){
	echo   "  <div class ='Thread-grid-item'>
<div class='ThreadNumber'> Post {$row['id']}<br> </div> 

      	<div class='UserOnThread'>{$row['Users']} </div> 
      	<h2>{$row['Title']} </h2> 

      	<button type='button' class ='collapse'>Hide</button>
      			<div class ='img-block'> 
		 <a href=$imageURL> <img src='Icons/PDF.jpg' alt='' /> </a>		
		 </div>	
	<div class='bodytextThread'> <p>{$row['ThreadBody']}</p> </div>

		
      </div> 


    \n";
    

} else{
	echo   "  <div class ='Thread-grid-item'>
<div class='ThreadNumber'> Post {$row['id']}<br> </div> 

      	<div class='UserOnThread'>{$row['Users']} </div> 
      	<h2>{$row['Title']} </h2> 

      	<button type='button' class ='collapse'>Hide</button>
		<div class ='img-block'> 
		 <img src=$imageURL alt='' />		
		</div> 
	<div class='bodytextThread'> <p>{$row['ThreadBody']}</p> </div>

		
      </div> 


    \n";
   
}      
        
  
  

}?>

<div class="comment-upload-box"> 
<form action="CommentUpload.php" method="post" enctype="multipart/form-data">
<table>
<tr>
<td></td>
</tr>
<tr>
<td>Comment: </td>
<td> <textarea name="CommentText" cols="100" rows="10" > Enter your posts... 
</textarea>
 </td>
<td></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name='submit' value="Submit"/></td>
<td></td>
</tr>
</table> 
</form>

</div>
<div class='divTableForComments'>
<div class='divTableBody'>

<?php 
include 'dbconnect.php';
//Output Comments onto page

//Create a variable for the Comment boxes so when clicking reply a text area shows 
$ChildCommentBoxes = "<div class='child-comment-upload-box' style='margin-left: 48px'> 
<form action='ChildCommentUpload.php' method='post' enctype'multipart/form-data'>
<table>
<tr>
<td></td>
</tr>
<tr>
<td>Comment: </td>
<td> <textarea name='ChildCommentText' cols='100' rows='10' > Enter your posts... 
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

$query = mysqli_query($conn, "SELECT * FROM Posts where IDOfThread=$number")
   or die (mysqli_error($conn));

while ($row = mysqli_fetch_array($query)) {
//May need this later to output pictures   
//     $imageURL = 'upload/'.rawurlencode($row["filename"]);
$CommentText = nl2br($row['CommentText']) ; 

$ParentComment = ""  ;
$replies = ""  ;
if (empty($row['ParentId'])) {

$ParentComment .=    "  <div class='divTableRow'>
	<div class='divTableCell'>{$row['User']} 
	<div class='pointsincommentbox'> {$row['Upvotes']}points</div>
	<div class='divTableComment'> 
		$CommentText <br>
	<div class='divCommentLinks'> 
		 <div class='upvotes' id='upvote'> ⬆</div> 
		<div class='upvotes'> ⬇</div> 
		<div> view comment </div> 
		<div>report </div> 
		<div>permalink</div> 
		<button type='button' class ='CommentChildButton'>reply</button>
		<div class ='OpenChildCommentBox'> 
		 $ChildCommentBoxes 	
		</div> 
	</div>

 </div>

</div>
</div> 
    \n";
}
    echo "$ParentComment "; 
}
?> 

<div class ="sidebar"> </div> 

</body> 
</html> 

<script>
var coll = document.getElementsByClassName("collapse");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>


<script>
var coll2 = document.getElementsByClassName("CommentChildButton");
var i;

for (i = 0; i < coll2.length; i++) {
  coll2[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block	") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>


<script>

document.getElementById("upvote").onclick = function(){
	onmouseover = document.body.style.cursor = "pointer";
	document.getElementById("upvote").style.color = 'orange';
}
</script>


