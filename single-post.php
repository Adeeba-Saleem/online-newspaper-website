<?php require 'pages/header.php' ?>
        <!-- Navbar Area -->
<?php require 'pages/navbar.php' ?>
       <!-- Nav End -->
        
    <!-- ##### Header Area End ##### -->

     
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
    
<?php include 'pages/s-news.php'; ?>
<?php
if(isset($_GET['post_id'])){
   $id = $_GET['post_id'];
$sql = mysqli_query($connection, "SELECT * FROM comments WHERE post_id=$id AND status='approved'");
$num = mysqli_num_rows($sql);
}

?>
               <div class="comments-area">
                  <h4><?php echo $num;?> Comments</h4>
<?php
    if(isset($_GET['post_id'])){
        $id = $_GET['post_id'];
        $sql = mysqli_query($connection, "SELECT * FROM comments WHERE post_id=$id AND status='approved' ORDER BY id DESC");
        while ($row = mysqli_fetch_array($sql)) {
            $name = $row['name'];
            $body = $row['body'];

            ?>

                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="assets/img/comment/comment_1.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                <?php echo $body;?>
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#"><?php echo $name;?></a>
                                    </h5>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   <?php }
    }

?>
        
           
               </div>
               <div class="comment-form">
                  <h4>Leave a Reply</h4>
                  <?php 
if(isset($_GET['post_id']) && isset($_GET['cat_r'])){
    $id = $_GET['post_id'];
    $post_category = $_GET['cat_r'];

    if(isset($_POST['comment-add'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $website = $_POST['website'];

        if($comment_obj->addComment($name, $email, $body, $website, $id)){
            $msg = "<div class='alert alert-success'>You comment was added and will soon be approved by the admin</div>";
        }else{
            return false;
        }
    }
}

 ?> 
 <?php
if(isset($msg)){
    echo $msg;
}

 ?> 
                  <form class="form-contact comment_form" action="single-post.php?post_id=<?php echo $id;?>&cat_r=<?php echo $post_category;?>" method="post" id="commentForm">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea class="form-control w-100" name="body" id="comment" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="comment-add" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                     <?php include 'pages/keycatsearch.php' ?>
                        <?php include 'pages/s-related.php'; ?>

            

                  
            
                  <aside class="single_sidebar_widget newsletter_widget">
                     <h4 class="widget_title">Newsletter</h4>
                     <form action="#">
                        <div class="form-group">
                           <input type="email" class="form-control" onfocus="this.placeholder = ''"
                              onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                           type="submit">Subscribe</button>
                     </form>
                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->

       <!-- ##### Footer Add Area start ##### -->
<?php require 'pages/footer.php' ?>
    <!-- ##### Footer Area end ##### -->