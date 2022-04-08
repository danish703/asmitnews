<?php
 session_start();
 
 include('connect.php');
 $date = date('Y-m-d'); 
 $userid = $_SESSION['user_id'];
 if(isset($_POST['submit'])){
$comment = $_POST['comment'];
$postid = $_GET['id'];
    
$query ="INSERT INTO  comment(commentMessage, comment_date, user_id,post_id) VALUES('$comment','$date','$userid','$postid')";
  if(mysqli_query($conn,$query)){
      header('location:../details.php?msg=success&&id='.$postid);
  }else{
      header('location:../details.php?error=error occured&&id='.$postid);
  }
 }
 ?>