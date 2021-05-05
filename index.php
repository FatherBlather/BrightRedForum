<?php include 'dbconnect.php'; ?> 

<?php //include auth_session.php file on all user panel pages 
//include("auth_session.php");
?>

<!DOCTYPE html>

<html> 
<header> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all">
<title>Image Board</title>

 <div class="header">
  <a href="#default" class="logo">☭ RED ARMY ONLINE ☭</a>
  <div class="header-right">
    <a class="active" href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Education</a>
    <a href="#about">Tech</a>
    <a href="#about">History</a>
    <a href="#about">Video</a>

  </div>

 <?php  
    session_start();
 if(isset($_SESSION['username'])){
	echo 
    	"<div class='profile'>
    		<a href='ShareUrl.php'>Share URL</a> 
    		<a href='CreateThread.php'>Create Thread</a> 
			<a href='profile.php'>Profile</a> 
  		    <a href='logout.php'>Logout</a>
  		    
  		    </div> 
  		    ";
    }
    else{
    	echo 
    	"<div class='loginregister'> 
  		    <a href='login.php'>Login</a>
  		    <a href='register.php'>Register</a>
  		    </div> 
  		    ";
    }
    ?>
      
</div> 
</header> 
<body> 
<div class ='grid-container'>
<?php


//Get the Threads and output them onto the screen in a grid container
$query = mysqli_query($conn, "select Threads.id as ThreadId, Title, Users, filename,url, LEFT(ThreadBody, 8000) as body, date_format(Thread_date, '%D %b %Y %l:%i %p') as ftime     , count(Posts.IdOfThread) as num_posts from Threads Left join Posts on Threads.id = Posts.IdOfThread group by Threads.id order by Thread_date desc;")
   or die (mysqli_error($conn));

while ($row = mysqli_fetch_array($query)) {
$imageURL = 'upload/Thumbnails/'.rawurlencode($row["filename"]);
$PostBody = nl2br($row['body']);

  echo
  
  
  
   "  <div class ='grid-item'>	
   
	<div class='ThreadComment'> <a href='viewthread.php?id={$row['ThreadId']}'>  Comments:{$row['num_posts']} </a><br>  </div> 
	<div class='ThreadNumber'> <a href='viewthread.php?id={$row['ThreadId']}'>  Post {$row['ThreadId']}</a><br> </div> 
	<div class='indexpageUser'>{$row['Users']}  </div> 
      	<h2><a href='viewthread.php?id={$row['ThreadId']}'>  {$row['Title']} </a></h2> 
      	<a href='{$row['url']}'> {$row['url']}</a> 
      	
      <div class='mainpageUpvoteCount'> {$row['upvotes']} </div>" ;  
     //If user is logged in display upvote arrows. 
 		if(isset($_SESSION['username'])){
	echo 
    	" <div class='mainpageupvote' id='upvote'><form action='upvotes.php' method='post' enctype='multipart/form-data' ><button class='upvotes' name='ThreadID' value={$row['ThreadId']}> ⬆ </button></form></div> 
		<div class='mainpagedownvote'><button onclick='downvote()' class='upvotes' value={$row['ThreadId']} > ⬇</button></div> 
  		    ";
    }
      
      echo "<div class ='img-block'>" ;  
				//If file is a PDF display standard PDF icon else select the filename from the uploads folder 
		  		if(strpos($imageURL, "pdf") !== false){
		 			echo "<a href='viewthread.php?id={$row['ThreadId']}'><img src='Icons/PDF.jpg' alt='' /> </a> " ;
		 			}		
		 		else { 
		 			echo "<a href='viewthread.php?id={$row['ThreadId']}'><img src={$row['$imageURL']}$imageURL alt='' /> </a>"; 
		 			}
		echo "
		</div> 
		
       <p>$PostBody </p>
      </div> 

    \n";
    
}

/*  "  <div class ='grid-item'>
   
	<div class='ThreadComment'> <a href='viewthread.php?id={$row['ThreadId']}'>  Comments:{$row['num_posts']} </a><br>  </div> 
	<div class='ThreadNumber'> <a href='viewthread.php?id={$row['ThreadId']}'>  Post {$row['ThreadId']}</a><br> </div> 
	<div class='indexpageUser'>{$row['Users']}  </div> 
      	<h2><a href='viewthread.php?id={$row['ThreadId']}'>  {$row['Title']} </a></h2> 
      <div class='mainpageUpvoteCount'> {$row['upvotes']} </div> 
      	 <div class='mainpageupvote' id='upvote'><button onclick='upvote()' class='upvotes' value={$row['ThreadId']}> ⬆ </button></div> 
		<div class='mainpagedownvote'><button onclick='downvote()' class='upvotes' value={$row['ThreadId']} > ⬇</button></div> 
		<div class ='img-block'>" ;  
		//If file is a PDF display standard PDF icon else select the filename from the uploads folder 
		  if(strpos($imageURL, "pdf") !== false){
		 echo "<a href='viewthread.php?id={$row['ThreadId']}'><img src='Icons/PDF.jpg' alt='' /> </a> " ;
		 }		
		 else { 
		 echo "<a href='viewthread.php?id={$row['ThreadId']}'><img src={$row['$imageURL']}$imageURL alt='' /> </a>"; 
		 }
		echo "
		</div> 
		
       <p>$PostBody </p>
      </div> 

    \n";
    */
?>

</body> 
</html> 

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script> 
function upvote(){
      $.ajax({
        type: "POST",
        url: "upvotes.php",
		data: {$row['ThreadId']},
        success:function( msg ) {
         alert( "Data Saved: " + msg );
        }
       });
  }
</script> 

<script> 
function downvote(){
      $.ajax({
        type: "POST",
        url: "upvotes.php",
        data: name: $("select[name='players']").val()},
        success:function( msg ) {
         alert( "Data Saved: " + msg );
        }
       });
  }
</script> 
