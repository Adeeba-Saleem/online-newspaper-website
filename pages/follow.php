           <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Follow Us</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="fa fa-globe">   
                            </div>
                            <div class="follow-count">  
                                <span><?php echo $misc->getNumPosts(); ?></span>
                                <p>News</p>
                            </div>
                        </div> 
                        <div class="follow-us d-flex align-items-center">
                            <div class="fa fa-cubes">   
                            </div>
                            <div class="follow-count">  
                                <span><?php echo $misc->getNumCategories(); ?></span>
                                <p>Categories</p>
                            </div>
                        </div> 
                         <div class="follow-us d-flex align-items-center">
                            <div class="fa fa-users">   
                            </div>
                            <div class="follow-count">  
                                <span><?php echo $misc->getNumSubscribers(); ?></span>
                                <p>Subscribers</p>
                            </div>
                        </div> 
                    
                    </div>
                </div>
                <!-- New Poster -->
                         <div class="col-lg-12">
               <div class="blog_right_sidebar">
            
             
                  <aside class="single_sidebar_widget instagram_feeds">
                     <h4 class="widget_title">Adveristment Blog</h4>
                     <ul class="instagram_row flex-wrap">
                       <?php 
                       $addver_obj->getAdv();                      
                    ?>
                     </ul>
                  </aside>
                
               </div>
            </div>
            </div>