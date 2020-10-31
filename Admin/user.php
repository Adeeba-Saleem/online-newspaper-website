<?php include 'pages/header.php'; ?>
  <!-- container section start -->
  <section id="container" class="">

    <!--header end-->
<?php include 'pages/top_nav.php'; ?>
    <!--sidebar start-->
<?php include 'pages/side_bar.php'; ?>
    <!--sidebar end-->
 <?php
          $role = $user_obj->getRole();
              if($role === 'Admin') {
           ?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Users</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-users"></i>Users</li>
            </ol>
          </div>
        </div>
        <div class="container row">
         
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered table-success">
              <thead>
                <tr>
                  <th>User Id</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Action</th>   
                </tr>
              </thead>
              <tbody>
                <?php
                $user_obj->getAllUsers();
                if(isset($_GET['d_user_id'])) {
                  $user_obj->deleteUser($_GET['d_user_id']);
                  header("Location: user.php?message=deleted_success");
                }
              

                ?>
              </tbody>
            </table>
          </div>
        <?php }
          else{
                header("Location: index.php");
             }
        ?>
        
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
