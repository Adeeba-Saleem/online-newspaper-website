                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                      
                        <div class="trending-bottom">
                            <div class="row">

                        <!-- Trending Bottom -->
                    <?php
                     if (isset($_GET['c_id']) && $_GET['c_id'] !== "") {
                         $cat_obj->getPostByCat($_GET['c_id']); 
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