 <!-- Begin:: Slider Section -->
 <section class="page_banner" style="background-image: url(<?php echo $this->config->item('front_assets'); ?>images/bg/blogs.jpg);">
     <div class="container largeContainer">
         <div class="row">
             <div class="col-md-6">
                 <h2 class="banner-title">Blogs</h2>
             </div>

         </div>
         <div class="row">
             <div class="banner-subtitle">The Latest in HR Trends and Best Practices</div>
         </div>
     </div>
 </section>
 <!-- End:: Slider Section -->

 <!-- Blog Start -->
 <section class="blogPage">
     <div class="container largeContainer">
         <div class="row">
             <?php if ($blog) {
                    foreach ($blog as $key => $value) { ?>
                     <div class="col-lg-4 col-md-6">
                         <div class="blogItem03 bbrm">
                             <div class="blogThumb">
                                 <img src="<?php echo $this->config->item('front_assets'); ?>images/blog/3.jpg" alt="">
                             </div>
                             <div class="blogContent">
                                 <div class="bmeta">
                                     <span><i class="twi-folder2"></i><a href="<?php echo base_url('blogs/detail/' . $value->BlogID) ?>"><?php echo $value->AuthorName ?></a></span>|<span><i class="twi-user2"></i><a href="<?php echo base_url('blogs/detail/' . $value->BlogID) ?>">Vithoba Pagdiyal</a></span>
                                 </div>
                                 <h3><a href="<?php echo base_url('blogs/detail/' . $value->BlogID) ?>"><?php echo substr($value->Content, 0, 50) ?></a></h3>
                                 <a class="rm_more" href="<?php echo base_url('blogs/detail/' . $value->BlogID) ?>">Read More</a>
                             </div>
                         </div>
                     </div>
             <?php }
                } ?>

         </div>
     </div>
 </section>
 <!-- Blog End -->