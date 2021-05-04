<?php include 'dbconnect.php'; ?> 
<?php //include auth_session.php file on all user panel pages 
//include("auth_session.php");
//?>

<!DOCTYPE html>

<html> 
<header> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all">
<title>Richies Image Board</title>

 <div class="header">
  <a href="index.php" class="logo">☭RED ARMY ONLINE☭</a>
  <div class="header-right">
    <a class="active" href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Education</a>
    <a href="#about">Tech</a>
  </div>
  
 
<div class ="sidebar"> </div> 


 <?php 
 
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
$User = $_SESSION['username'] ; 
$query = mysqli_query($conn, "SELECT * FROM Posts where User='	$User'")
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
