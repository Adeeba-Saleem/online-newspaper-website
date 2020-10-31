<?php include 'pages/header.php'; ?>
  <!-- container section start -->
  <section id="container" class="">

    <!--header end-->
<?php include 'pages/top_nav.php'; ?>
    <!--sidebar start-->
<?php include 'pages/side_bar.php'; ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Category</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-globe"></i>Posts</li>
            </ol>
          </div>
        </div>
        <div class="container row">
          
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered table-success">
              <thead>
                <tr>
                  <th>News ID</th>
                  <th>News Title</th>
                  <th>Added By</th>
                  <th>Role</th>
                  <th>News Category</th>
                  <th>News Type</th>
                  <th>Number of views</th>
                  <th colspan='2' class='text-center'>Update</th>
                  <?php 
                    $role = $user_obj->getRole();
                    if($role === 'Admin') {
                      echo "<th colspan='2' class='text-center'>Action</th>";
                    }
                   ?>
                </tr>
              </thead>
              <tbody>
                <?php 
                $role = $user_obj->getRole();
                 if($role === 'Admin') {
                $post_obj->getAllPosts();
                if(isset($_GET['d_post_id']) && $role === 'Admin') {
                  $post_obj->deletePost($_GET['d_post_id']);
                  header("Location: post.php?message=deleted_success");
                }
                    }else{
                  $post_obj->getUserPosts();
                if(isset($_GET['d_post_id']) && $_GET['added_by'] ) {
                  $post_obj-> deleteUserPost($_GET['d_post_id'],$_GET['added_by']);
                  header("Location: post.php?message=deleted_success");
                    }
               }
                ?>
                
              </tbody>
            </table>
          </div>
        </div>
        <!--/.row-->

        <!-- Today status end -->



       
          <!--/col-->
          
            
          <!--/col-->

      



        <!-- statics end -->




        <!-- project team & activity start -->
        <br><br>

        
        <!-- project team & activity end -->

      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php include 'pages/footer.php'; ?>
