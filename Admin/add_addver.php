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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Advertistment</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Advertistment</li>
            </ol>
          </div>
        </div>

        <div class="container row">
          <?php 
              if(isset($_POST['add_adver']) && $_FILES['post_aimage'] !== "" && $_FILES['post_aimage'] !== " ") {
                  // necessary variables.

                $fileName = $_FILES['post_aimage']['name'];
                $fileTmpName = $_FILES['post_aimage']['tmp_name'];
                $imageSize = $_FILES['post_aimage']['size'];
                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','png','gif');
                if (!in_array($fileActualExt, $allowed)) {
                  header("Location: add_addver.php?message=file_type_not_allowed");
                } else {
                    if($imageSize > 10000000) {
                      header("Location: add_addver.php?message=file_is_large");
                    } else {
                        $fileNewName = uniqid('',true) . "." . $fileActualExt;
                        $dir = "news_images/";
                        $target_file = $dir . basename($fileNewName);
                        move_uploaded_file($fileTmpName, $target_file);
                         $addver_obj->addAdt($target_file);
                     echo "<script>alert('Advertistment Added');</script>"; 
                    }
                }
              }



           ?>
           
          <form method="POST" action="" role="form" class="col-lg-8" autocomplete="off" runat="server" enctype="multipart/form-data">
            <h3>Add Advertistment</h3>

            <div class="form-group">
              <label>Image</label>
              <input type="file" name="post_aimage" onchange="readURL(this)">
              <br>
              <img src="#" class="img-rounded" alt="Image to be displayed here" id="img" width="250" height="250">
            </div>
            <div class="form-group">
              <input type="submit" name="add_adver" value="Add Advertistment" class="btn btn-primary">
            </div>
          </form>
        </div>
        <!--/.row-->

       
        <!-- project team & activity start -->
        <br><br>

        
        <!-- project team & activity end -->

      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->
  <script>
      var title = document.querySelector("#title");
      var max = 60;
      title.addEventListener('keyup',function() {
        var left = document.getElementById('left');
          if (title.value.length > max) {
               title.value = title.value.substring(0, max);
               title.style.border = "2px solid red";
          } else {
              left.textContent = max - title.value.length;
              title.style.border = "1px solid green";
          }
      });

      function readURL(input) {
        if(input.files && input.files[0]) {
          let reader = new FileReader();
          reader.onload = function(e) {
            $("#img").attr("src", e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
  </script>
  <!-- javascripts -->
  <?php include 'pages/footer.php'; ?>
