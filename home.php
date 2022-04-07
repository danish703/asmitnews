<?php
session_start();
 if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
   header('Location:login.php');
 }
 $id = $_SESSION['user_id']; 
 include('db/connect.php');
 $query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);
$news = "SELECT * FROM post order by postDate desc";
$allNews = mysqli_query($conn,$news);



?>

<html>
  <head>
      <title>Home-Asmt News</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
<body>
<?php include('include/nav.php');?>    
 
<div class="container">
   <div class="row justify-content-md-center">
      <div class="col-8">
        <?php while($row= mysqli_fetch_assoc($allNews)){ ?>
            <div class="card">
              <img src="<?php echo $row['coverImage'];?>" class="card-img-top" style="height:400px;" alt="...">
              <div class="card-body">
                <h4><?php echo $row['title'];?></h4>
                <hr/>
                <p class="card-text">
                  <?php echo substr($row['content'],0,100); ?>
                </p>
              </div>
              <div class="card-footer">
                 <div class="row">
                   <div class="col-6">
                     <?php
                       $postid = $row['id'];
                       $query = "SELECT count(*) as t from likes WHERE post_id=$postid";
                       $r = mysqli_query($conn,$query);
                       $res = mysqli_fetch_assoc($r); 
                     ?>
                     <span><?php echo $res['t'];?></span>
                     <?php
                        $query = "SELECT * FROM likes WHERE post_id=$postid and user_id=$id";
                        $res = mysqli_query($conn,$query);
                        if(mysqli_num_rows($res)==0){ ?>
                          
                     <a href="db/like.php?postid=<?php echo $row['id'];?>"> LIKE </a>
                       <?php  }else{ ?>
                            
                     <a href="db/like.php?postid=<?php echo $row['id'];?>"> Unlike</a>
                     <?php    }
                     ?>
                   </div>
                   <div class="col-6"><a href="details.php?id=<?php echo $row['id']; ?>" style="float:right;" class="btn btn-success">Read more</a></div>
                 </div>
              </div>
            </div>
             <br/>
       <?php } ?>
      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>