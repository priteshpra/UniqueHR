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
                     <p>C-402, 4th Floor, <br> Sumel Business Park-7, N.H.NO-8, <br> Soni Ki Chawl, Odhav,<br> Ahmedabad- 382415</p>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6">
                 <div class="icon_box_10">
                     <div class="ib_box"><i class="icons-telephone"></i></div>
                     <h3>Call Us For Help:</h3>
                     <p><a href="tel:+917069690700">+91 70696 90700</a></p>
                     <p><a href="tel:7069690701">+91 70696 90701</a></p>
                     <p><a href="tel:7069690702">+91 70696 90702</a></p>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6">
                 <div class="icon_box_10">
                     <div class="ib_box"><i class="icons-envelope-1"></i></div>
                     <h3>Mail info:</h3>
                     <p>info@unique-hr.com</p>
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
             <div class="col-md-12">
                 <div class="appointment_form">
                     <?php
                        if (!empty($status)) { ?>
                         <div style="color: green; font-size:25px" class="status <?php echo $status['type']; ?>"><?php echo $status['msg']; ?></div>
                     <?php } ?>
                     <p>Your email address will not be published*</p>
                     <h3>Send Us a Message</h3>
                     <form action="<?php echo base_url('contact/sendEmail') ?>" method="post" class="row" id="contact_forms" enctype="multipart/form-data">
                         <div class="input-field col-md-6">
                             <input class="required" type="text" name="con_firstname" maxlength="50" placeholder="First Name" tabindex="1">
                             <span style="color: red;"><?php echo form_error('con_firstname'); ?></span>
                         </div>
                         <div class="input-field col-md-6">
                             <input class="required" type="text" maxlength="50" name="con_lastname" placeholder="Last Name" tabindex="2">
                             <span style="color: red;"><?php echo form_error('con_lastname'); ?></span>
                         </div>
                         <div class="input-field col-md-6">
                             <input class="required" type="text" name="con_contact" onkeydown="return onlyNumbers(event)" id="con_contact" maxlength="10" minlength="10" placeholder="Contact Number" tabindex="3">
                             <span style="color: red;"><?php echo form_error('con_contact'); ?></span>
                         </div>
                         <div class="input-field col-md-6">
                             <input class="required" type="email" name="con_email" id="con_email" placeholder="Email Address" tabindex="4">
                             <span style="color: red;"><?php echo form_error('con_email'); ?></span>
                         </div>
                         <div class="input-field col-md-12">
                             <input type="file" id="con_cv" accept=".doc,.docx,.pdf" name="filename" tabindex="6">
                             <span style="color: red;"><?php echo form_error('filename'); ?></span>
                         </div>
                         <div class="input-field col-md-12">
                             <p style="margin-bottom:20px;"></p>
                         </div>
                         <div class="input-field col-md-12">
                             <textarea class="required" name="con_intro" placeholder="Brief Introduction" tabindex="5"></textarea>
                         </div>
                         <?php echo $recaptcha_html; ?>
                         <span style="color: red;"><?php echo form_error('g-recaptcha-response'); ?></span>

                         <div class="input-field col-md-12" style="margin-top:15px;">
                             <?php if (isset($recaptcha_error)) {
                                    echo '<p style="color: red;">' . $recaptcha_error . '</p>';
                                } ?>
                             <input type="submit" name="contactSubmit" class="frm-submit qu_btn" value="SUBMIT">
                             <div class="con_message"></div>
                         </div>
                     </form>
                 </div>
             </div>
             <div class="col-md-4" style="display:none;">
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
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <script>
    function onlyNumbers(e){
    var keynum;
    var keychar;

    if(window.event){  //IE
        keynum = e.keyCode;
    }
    if(e.which){ //Netscape/Firefox/Opera
        keynum = e.which;
    }
    if((keynum == 8 || keynum == 9 || keynum == 46 || (keynum >= 35 && keynum <= 40) ||
       (event.keyCode >= 96 && event.keyCode <= 105)))return true;

    if(keynum == 110 || keynum == 190){
        var checkdot=document.getElementById('price').value;
        var i=0;
        for(i=0;i<checkdot.length;i++){
            if(checkdot[i]=='.')return false;
        }
        if(checkdot.length==0)document.getElementById('price').value='0';
        return true;
    }
    keychar = String.fromCharCode(keynum);

    return !isNaN(keychar);
}
 </script>