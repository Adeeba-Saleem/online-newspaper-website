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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Post</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Post</li>
            </ol>
          </div>
        </div>

        <div class="container row">

            <?php 
             $id = $user_obj->getID();
             if(isset($_GET['pos_id']) && $_GET['pos_id'] !== "" && $_GET['added_by'] === "$id" ) {
                $pos_id = $_GET['pos_id'];
                $sql = mysqli_query($connection, "SELECT * FROM news WHERE id=$pos_id");
                $row = mysqli_fetch_array($sql);
                $title = $row['title'];
                $content = $row['content'];
                $category = $row['post_category'];
                $post_image=$row['post_image'];
                $tags=$row['tags'];
                $type = $row['type'];
             }
              else{
                header("Location: post.php");
             }

                 if(isset($_POST['u_news']) && $_FILES['upost_image'] !== "" && $_FILES['upost_image'] !== " ") {
                  // necessary variables.

                $fileName = $_FILES['upost_image']['name'];
                $fileTmpName = $_FILES['upost_image']['tmp_name'];
                $imageSize = $_FILES['upost_image']['size'];
                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','png','gif');
                if (!in_array($fileActualExt, $allowed)) {
                  header("Location: edit_user_post.php?message=file_type_not_allowed");
                } elseif ($_POST['utitle'] == "") {
                  $err_msg['utitle'] ="Title is required";
                }
                 elseif ($_POST['ucontent']=="") {
                  $err_msg['ucontent'] ="Content is required";
                }
                elseif ($_POST['utags']=="") {
                  $err_msg['utags'] ="Tags are required";
                }
                else {
                    if($imageSize > 10000000) {
                      header("Location:edit_user_post.php?message=file_is_large");
                    } else {
                        $fileNewName = uniqid('',true) . "." . $fileActualExt;
                        $dir = "news_images/";
                        $target_file = $dir . basename($fileNewName);
                        move_uploaded_file($fileTmpName, $target_file);
                        $post_obj->updateUserPost($pos_id, $_POST['utitle'],$_POST['ucontent'],$_POST['ucategory'],$_POST['utype_news'],$_POST['utags'],$target_file);
                        header("Location: post.php?message=updated");
                    }
                }
              }

           ?>
           
          <form method="POST" action="" role="form" class="col-lg-8" autocomplete="off" runat="server" enctype="multipart/form-data">
            <h3>Update News</h3>
             <?php
                if(isset($err_msg['utitle'])){
                  echo "<div style='color:#cc0000;padding-top:5px;float:left;width:100%;'>".$err_msg['utitle']."</div>";
                } 
              ?>
            <div class="form-group">
              <div class="input-group">
              <input type="text" name="utitle" value="<?php echo $title; ?>" id="title" placeholder="News Title" class="form-control">
              <span class="input-group-addon" id="left">60</span>
              </div>
            </div>
             <?php
                if(isset($err_msg['ucontent'])){
                  echo "<div style='color:#cc0000;padding-top:5px;float:left;width:100%;'>".$err_msg['ucontent']."</div>";
                } 
              ?>
             <div class="form-group">
              <textarea class="form-control" placeholder="<?php echo $content; ?>" name="ucontent"></textarea>
            </div>
              <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="ucategory" value="<?php echo $category; ?>">
                <?php 
                  $query = mysqli_query($connection, "SELECT DISTINCT * FROM category ORDER BY cat_title ASC");
                  while ($row = mysqli_fetch_array($query)) {
                        $cat_title = $row['cat_title'];
                        echo "<option value='{$cat_title}'>$cat_title</option>";
                  }
                 ?>
              </select>
            </div>
             <div class="form-group">
              <label>Type of News</label>
              <select class="form-control" name="utype_news" value="<?php echo $type; ?>">
                <option value="Breaking News">Breaking News</option>
                <option value="Casual News">Casual News</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tags</label>
              <input type="text" name="utags" placeholder="News Tags (seperate by a comma)" class="form-control" value="<?php echo $tags; ?>">
                <?php
                if(isset($err_msg['utags'])){
                  echo "<div style='color:#cc0000;padding-top:5px;float:left;width:100%;'>".$err_msg['utags']."</div>";
                } 
              ?>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="upost_image" onchange="readURL(this)" value="<?php echo $post_image; ?>">
              <br>
              <img src="#" class="img-rounded" alt="Image to be displayed here" id="img" width="250" height="250">
            </div>
            <div class="form-group">
              <input type="submit" name="u_news" value="Update News" class="btn btn-primary">
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
