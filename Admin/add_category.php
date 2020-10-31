<?php include 'pages/header.php'; ?>
  <!-- container section start -->
  <section id="container" class="">

    <!--header end-->
<?php include 'pages/top_nav.php'; ?>
    <!--sidebar start-->
<?php include 'pages/side_bar.php'; ?>
 <?php
          $role = $user_obj->getRole();
              if($role === 'Admin') {
           ?>
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
              <li><i class="fa fa-laptop"></i>Category</li>
            </ol>
          </div>
        </div>

          <?php 
              $role = $user_obj->getRole();
              if(isset($_POST['add_cat']) &&  $role === 'Admin') {
                $cat_t=$_POST['cat_title'];
                $cat_e = mysqli_query($connection,"SELECT * FROM category WHERE cat_title='$cat_t'");
                if(empty($cat_t)){
            echo "<div class='container'><div class=' alert alert-block alert-danger fade in text-center col-lg-6'>Can't be empty</div></div>";
           }  elseif(mysqli_num_rows($cat_e) > 0){
            echo "<div class='container'><div class=' alert alert-block alert-danger fade in text-center col-lg-6'>Category Already Taken</div></div>";
              }else{
                 $cat_obj->addCategory($_POST['cat_title']);
                header("Location: category.php?message=category_added");
              }
               
              }
            
           ?>
        <div class="container row">
          
          <form method="POST" action="" role="form" class="col-lg-6" autocomplete="off">
            <h3>Add Category</h3>
            <div class="form-group">
              <input type="text" name="cat_title" placeholder="Category" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="add_cat" value="Add Category" class="btn btn-primary">
            </div>
          </form>
             <?php }
             else{
                header("Location: category.php");
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
