<?php
   $host = "localhost";
   $username = "root";
   $password = "";
   $dbname = "asmtnews";

  $con = mysqli_connect($host,$username,$password,$dbname);
  
  if(!$con){
      die("connection failed");
  }
  
?>