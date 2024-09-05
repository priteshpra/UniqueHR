 <!-- Begin:: Slider Section -->
 <?php if ($banner) {
        foreach ($banner as $key => $value) { ?>
         <section class="page_banner" style="background-image: url(<?php echo base_url() . $value->Image; ?>);">
             <div class="container largeContainer">
                 <div class="row">
                     <div class="col-md-6">
                         <h2 class="banner-title"><?php echo $value->SubTitle1; ?></h2>
                         <h2 class="banner-title"><?php echo ($value->SubTitle2) ? $value->SubTitle2 : ''; ?></h2>

                     </div>
                 </div>
                 <div class="row">
                     <div class="banner-subtitle"><?php echo ($value->SubTitle3) ? $value->SubTitle3 : ''; ?></div>
                 </div>
             </div>
         </section>
 <?php }
    } ?>
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