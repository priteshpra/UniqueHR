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

 <!-- Service Detailss Start -->
 <section class="singleServicePage" style="margin-bottom:-100px;">
     <section class="relatedService">
         <?php echo isset($cms[0]) ? $cms[0]->Content : ''; ?>
     </section>
 </section>

 <!-- Related Service End -->