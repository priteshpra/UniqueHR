<!-- Begin:: Slider Section -->
<section class="page_banner" style="background-image: url(<?php echo $this->config->item('front_assets'); ?>images/bg/blogs.jpg);">
    <div class="container largeContainer">
        <div class="row">
            <div class="col-md-6">
                <h2 class="banner-title">Blogs</h2>
            </div>

        </div>
        <div class="row">
            <div class="banner-subtitle"><?php echo $Blog[0]->BlogTitle ?></div>
        </div>
    </div>
</section>
<!-- End:: Slider Section -->

<!-- Blog Start -->
<section class="singleBlog">
    <div class="container largeContainer">
        <div class="row">
            <div class="col-lg-11">
                <div class="sic_details clearfix">
                    <div class="bmeta">
                        <p><i class="twi-folder2"></i>Data Analytics</p>
                        <p><i class="twi-user2"></i><?php echo $Blog[0]->AuthorName ?></p>
                        <p><i class="twi-calendar-alt2"></i><?php echo date('d M Y', strtotime($Blog[0]->PublishedDate)) ?></p>
                    </div>
                    <div class="sic_the_content clearfix">
                        <?php echo $Blog[0]->Content ?>
                    </div>
                </div>

            </div>
        </div>
</section>
<!-- Blog End -->