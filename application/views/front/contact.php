 <!-- Begin:: Slider Section -->
 <section class="page_banner" style="background-image: url(<?php echo $this->config->item('front_assets'); ?>images/bg/contact.jpg);">
     <div class="container largeContainer">
         <div class="row">
             <div class="col-md-6">
                 <h2 class="banner-title">Contact Us</h2>
             </div>

         </div>
         <div class="row">
             <div class="banner-subtitle">Talk to Us About Your Human Resource needs</div>
         </div>
     </div>
 </section>
 <!-- End:: Slider Section -->
 <style>
     .field-error {
         color: red;
     }
 </style>
 <!-- Icon Box Start -->
 <section class="coniconboxPage">
     <div class="container largeContainer">
         <div class="row">
             <div class="col-lg-4 col-md-6">
                 <div class="icon_box_10">
                     <div class="ib_box"><i class="icons-location-pin"></i></div>
                     <h3>Office Address:</h3>
                     <p>C-402,4th Floor, Sumel Business Park-7,<br> N.H.NO-8,Soni Ki Chawl,Odhav,Ahmedabad-382415</p>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6">
                 <div class="icon_box_10">
                     <div class="ib_box"><i class="icons-telephone"></i></div>
                     <h3>Call Us For Help:</h3>
                     <p>91 73833 57731,<br> +91 70696 90700</p>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6">
                 <div class="icon_box_10">
                     <div class="ib_box"><i class="icons-envelope-1"></i></div>
                     <h3>Mail info:</h3>
                     <p>contact@unique-hr.com<br> info@unique-hr.com</p>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Icon Box End -->

 <!-- Contact Form Start -->
 <section class="contactSection">
     <div class="container largeContainer">
         <div class="row">
             <div class="col-md-8">
                 <div class="appointment_form">
                     <?php if (!empty($status)) { ?>
                         <div class="status <?php echo $status['type']; ?>"><?php echo $status['msg']; ?></div>
                     <?php } ?>
                     <p>Your email address will not be published*</p>
                     <h3>Send Us a Message</h3>
                     <form action="" method="POST" class="row" id="">
                         <div class="input-field col-md-6">
                             <i class="twi-user2"></i>
                             <input class="required" type="text" name="name" value="<?php echo !empty($postData['name']) ? $postData['name'] : ''; ?>" placeholder="Your Name">
                             <?php echo form_error('name', '<p class="field-error">', '</p>'); ?>
                         </div>
                         <div class="input-field col-md-6">
                             <i class="twi-envelope2"></i>
                             <input class="required" type="email" name="email" value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" placeholder="Email Address">
                             <?php echo form_error('email', '<p class="field-error">', '</p>'); ?>
                         </div>
                         <div class="input-field icRight col-md-12">
                             <select name="subject">
                                 <option>Select Subjects</option>
                                 <option>Finance Consultant</option>
                                 <option>Business Consultant</option>
                                 <option>Financial Advices</option>
                                 <option>Business Growth</option>
                             </select>
                         </div>
                         <div class="input-field col-md-12">
                             <i class="twi-pen2"></i>
                             <textarea class="required" name="message" placeholder="Type Your Message"><?php echo !empty($postData['message']) ? $postData['message'] : ''; ?></textarea>
                             <?php echo form_error('message', '<p class="field-error">', '</p>'); ?>
                         </div>
                         <div class="col-md-7 input-field">
                             <label>
                                 <input type="checkbox" name="subscribe" value="Also subscribe us">
                                 <span class="wpcf7-list-item-label">I Agree to get-e- mails about future conferences.</span>
                             </label>
                         </div>
                         <div class="input-field col-md-12">
                             <button type="submit" name="contactSubmit" class="qu_btn" value="Submit">Submit Now</button>
                             <div class="con_message"></div>
                         </div>
                     </form>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="chatNow">
                     <h4>Chat With Support</h4>
                     <p>Let’s chat our live experts to get answer your question</p>
                     <a href="javascript:void(0);" class="qu_btn">Live Chat</a>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Contact Form End -->

 <!-- Contact Map Start -->
 <section class="mapSection">
     <div class="google_map" id="google_map"></div>
 </section>
 <!-- Contact Map End -->