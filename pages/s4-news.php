<aside class="single_sidebar_widget popular_post_widget">
   <h3 class="widget_title">Related News</h3>
 <?php 
            $query = mysqli_query($connection, "SELECT * FROM news WHERE status='approved' AND timestamped>DATE_SUB(curdate(),INTERVAL 1 WEEK) ORDER BY num_views DESC LIMIT 4");
              
        while ($row = mysqli_fetch_assoc($query)):
            $id = $row['id'];
            $title = $row['title'];
            $category = $row['post_category'];
            $image = $row['post_image'];
            $num_likes = $row['num_likes'];
            $post_cat_id = $row['post_cat_id'];
            $num_comments = $row['num_comments'];
                    ?>


                     
                     <div class="media post_item">
                        <img src="<?php echo "Admin/$image"; ?>" width='150'>
                        <div class="media-body">
                           <a href="">
                              <h5><?php echo $title; ?></h5>
                           </a>
                           <span class='color3'><?php echo $category; ?></span>
                        </div>
                     </div>
                  
      <?php endwhile;  
            }


         ?>
                  </aside>