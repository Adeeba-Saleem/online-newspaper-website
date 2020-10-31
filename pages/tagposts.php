                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                      
                        <div class="trending-bottom">
                            <div class="row">

                        <!-- Trending Bottom -->
                       <?php 
                     if (isset($_GET['tag'])) {
                         $tag = $_GET['tag'];
                         $post_obj->getNewsByTags($tag); 
                     }
                     
                     ?>

                        </div>
                    </div>
                 </div>
 <?php include 'sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->