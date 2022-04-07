<?php
   session_start();
   $user_id = $_SESSION['user_id'];
   include('connect.php');
   if(isset($_GET['postid'])){
       $postid = $_GET['postid']; 
        $checkQuery = "SELECT * FROM likes where post_id='$postid' and user_id='$user_id'";
        $result = mysqli_query($conn,$checkQuery);
        if(mysqli_num_rows($result)==0){
            $query = "INSERT INTO `likes`(user_id,post_id)VALUES('$user_id','$postid')";
                if(mysqli_query($conn,$query)){
                    header('Location:../home.php');
                }else{
                    echo mysqli_error($conn);
                }
            }else{
                $query = "DELETE FROM likes WHERE post_id='$postid' and user_id='$user_id'";
                mysqli_query($conn,$query);
                header('Location:../home.php');
            }
   }
?>