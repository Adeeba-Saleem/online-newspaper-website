<!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Casual News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class='tab-content' id='nav-tabContent'>
                            <!-- card one -->
                            <div class='tab-pane fade show active' id='nav-home' role='tabpanel' aria-labelledby='nav-home-tab'>           
                                <div class='whats-news-caption'>
                                    <div class='row'>
                        <!-- Nav Card -->
               <?php $post_obj-> getCasualNews(); ?>
                    <!-- End Nav Card -->
                    </div>  </div>
                            </div>
                            </div>           
                        </div>
                </div>
            </div>
                    <?php include 'follow.php'; ?>
            </div>
        </div>
    </section>
    <!-- Whats New End -->