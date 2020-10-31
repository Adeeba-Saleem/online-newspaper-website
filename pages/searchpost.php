                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                      
                        <div class="trending-bottom">
                            <div class="row">

                        <!-- Trending Bottom -->
                    <?php
                     if (isset($_GET['s']) && $_GET['s'] !== "") {
                         $post_obj->getPostBySearch($_GET['s']); 
                     }else {
                        header("Location: index.php");
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