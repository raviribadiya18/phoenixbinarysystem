<script src='https://www.google.com/recaptcha/api.js'></script>
<section class="bg-parallax py-5"><span class="bg-overlay" style="opacity: .6;"></span>
  <div class="bg-parallax-img" data-parallax="{&quot;y&quot; : 100}"><img src="<?=asset_path()?>img/pages/contacts-hero-bg.jpg" alt="Parallax Background"/>
  </div>
  <div class="bg-parallax-content px-3 py-md-5 mx-auto mt-lg-5 mb-lg-5 text-center" style="max-width: 800px;">
    <h1 class="text-white pt-2">Get in touch with us!</h1>
    <p class="text-xl text-white opacity-80 pb-3">Share your ideas with us and we do our best to turn your ideas into reality.</p>
  </div>
</section>
<section class="container-fluid mb-5">
  <div class="row">
    <div class="col-md-3 col-sm-6 border-right py-2 border-bottom"><a class="scroll-to icon-box text-center mx-auto box-shadow-none px-0" href="#map">
        <div class="icon-box-icon"><i class="fe-icon-map-pin"></i></div>
        <h3 class="icon-box-title">Find us at Anand</h3>
        <p class="icon-box-text font-weight-medium">F-12, Triveni Arcade, Vidyanagar Road, Anand - 388001,Gujarat - INDIA</p></a></div>
    <div class="col-md-3 col-sm-6 border-right py-2 border-bottom"><a class="scroll-to icon-box text-center mx-auto box-shadow-none px-0" href="#map">
        <div class="icon-box-icon"><i class="fe-icon-map-pin"></i></div>
        <h3 class="icon-box-title">Find us at Surat</h3>
        <p class="icon-box-text font-weight-medium">316, Polaris Commercial Mall, Opp. Bhaiyanagar BRTS Station, Parvat Patiya, Surat - 395010 Gujarat - INDIA</p></a>
    </div>  
        <div class="col-md-3 col-sm-6 border-right py-2 border-bottom"><a class="scroll-to icon-box text-center mx-auto box-shadow-none px-0" href="#map">
        <div class="icon-box-icon"><i class="fe-icon-map-pin"></i></div>
        <h3 class="icon-box-title">Find us at Pune</h3>
        <p class="icon-box-text font-weight-medium">101 , Mauli Building , Gajraj Colony No. 2 , Near Shiloh Church, Jyotibanagar, Kalewadi, Pune , 411017 - INDIA</p></a></div>   
    <!-- <div class="col-md-3 col-sm-6 py-2 border-right border-bottom"><a class="icon-box text-center mx-auto box-shadow-none px-0" href="tel:+918866220233">
        <div class="icon-box-icon"><i class="fe-icon-mail"></i></div>
        <h3 class="icon-box-title">Call us</h3>
        <p class="icon-box-text font-weight-medium">+91 88662 20233</p>
        <p class="icon-box-text font-weight-medium">+91 8155 010101</p></a></div> -->
    <div class="col-md-3 col-sm-6 py-2 border-right border-bottom"><a class="icon-box text-center mx-auto box-shadow-none px-0" href="mailto:phoenix8155@gmail.com.com">
        <div class="icon-box-icon"><i class="fe-icon-phone"></i></div>
        <h3 class="icon-box-title">Contact us</h3>
        <p class="icon-box-text font-weight-medium">+91 88662 20233</p>
        <p class="icon-box-text font-weight-medium">+91 8155 010101</p>
        <p class="icon-box-text font-weight-medium">phoenix8155@gmail.com</p></a></div>
    <!-- <div class="col-md-3 col-sm-6 py-2 border-bottom"><a class="icon-box text-center mx-auto box-shadow-none px-0" href="#">
        <div class="icon-box-icon"><i class="fe-icon-facebook"></i></div>
        <h3 class="icon-box-title">Follow us</h3>
        <p class="icon-box-text font-weight-medium">Facebook, Twitter, LinkedIn</p></a></div> -->
  </div>
</section>
<section class="container mb-5 pb-3">
  <div class="wizard">
    <div class="wizard-body pt-3">
      <h2 class="h4 text-center">Drop us a line</h2>
      <p class="text-muted text-center">We will get back to you as soon as possible</p>
      <p class="text-muted text-center"><?php
          
          if($this->session->flashdata('msg_true')!='')
          {
             echo '<h4 style="color:green;">'.$this->session->flashdata('msg_true').'</h4>';
            
          }
          if($this->session->flashdata('msg_false')!='')
          {
             echo '<h4 style="color:red;">'.$this->session->flashdata('msg_false').'</h4>';
          }
        ?></p>
      <form class="needs-validation" action="<?=base_url()?>index.php/contact/send_email" method="post" novalidate> 
        <div class="row pt-3">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="contact-name">Your Name <span class='text-danger font-weight-medium'>*</span></label>
              <input class="form-control" name="contact_name" type="text" id="contact-name" placeholder="Please enter your name!" required>
              <div class="invalid-feedback">Please enter your name!</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="contact-email">Your Email <span class='text-danger font-weight-medium'>*</span></label>
              <input class="form-control" type="email" name="contact_email" id="contact-email" placeholder="Please provide a valid email address!" required>
              <div class="invalid-feedback">Please provide a valid email address!</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="contact-subject">Subject</label>
              <input class="form-control" type="text" id="contact-subject" name="contact_subject" placeholder="Provide short title!">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="contact-file">Mobile No</label>
              <div class="custom-file">
                <input class="form-control" type="number" pattern="[0-9]{10}"  id="contact-contact" name="contact_no" placeholder="Please provide a valid mobile no!" required onKeyPress="if(this.value.length==13) return false;">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="contact-message">Message
            <span class='text-danger font-weight-medium'>*</span>
          </label>
          <textarea class="form-control" rows="7" id="contact-message" name="contact_message" placeholder="Please write a message!" required></textarea>
          <div class="invalid-feedback">Please write a message!</div>
        </div>
        
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LeUl9YUAAAAAGHY6FFK7TeYWQ_JUr82gXCCCs1o"></div>
        </div>
     
        <div class="text-center">
          <button class="btn btn-primary" type="submit">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</section>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14739.069745394798!2d72.9339553!3d22.550383!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe4cf49360715ca70!2sPhoenix+Binary+System+Pvt+Ltd!5e0!3m2!1sen!2sin!4v1546405293459" width="570" height="500" frameborder="0" style="border:0" allowfullscreen=""></iframe>