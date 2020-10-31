<aside class="single_sidebar_widget popular_post_widget">
   <h3 class="widget_title">Related News</h3>
 <?php 
            if (isset($_GET['cat_r']) && $_GET['cat_r'] !== "") {
                $cat_r = $_GET['cat_r'];
                $sql = mysqli_query($connection, "SELECT * FROM news WHERE post_category='$cat_r' AND status='approved'  ORDER BY RAND() LIMIT 4");
                while ($row = mysqli_fetch_assoc($sql)):
                    $id = $row['id'];
                    $title = substr($row['title'], 0, 15)."...";
                    $image = $row['post_image'];
                    $num_likes = $row['num_likes'];
                    $num_comments = $row['num_comments'];
                    $category = $row['post_category'];
                    ?>


                     
                     <div class="media post_item">
                        <a href='single-post.php?post_id=<?php echo $id; ?>&cat_r=<?php echo $category; ?>'><img src="<?php echo "Admin/$image"; ?>" width='150'></a>
                        <div class="media-body">
                           <a href='single-post.php?post_id=<?php echo $id; ?>&cat_r=<?php echo $category; ?>'>
                              <h5><?php echo $title; ?></h5>
                           </a>
                           <span class='color3'><?php echo $category; ?></span>
                        </div>
                     </div>
                  
      <?php endwhile;  
            }


         ?>
                  </aside>