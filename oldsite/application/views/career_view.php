<div class="contents-area">
  <div class="row">
    <div class="col-sm-12">
      <div class="box bg-grey">
        <div class="info-box">
          <div class="title-2">
            <h5>Career</h5>
          </div>
          <div class="carousel-single owl-carousel" data-autoplay="true" data-paginate="false" data-btn-prev="testim-prev" data-btn-next="testim-next">
            <div class="item">
              <div class="testim-box">
                <h4 class="text-uppercase">There are no current openings, please check back soon </h4>
                <br>
              </div>
              <!-- /testim-box --> 
            </div>
          </div>
          <div class="caro-control">
            <ul>
              <li><span class="caro-prev testim-prev">Prev</span></li>
              <li><span class="caro-next testim-next">Next</span></li>
            </ul>
          </div>
          <!-- /caro-control --> 
        </div>
        <!-- /info-box --> 
      </div>
      <!-- /box --> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="col-sm-12">
        <div class="box bg-grey">
          <div class="info-box">
            <div class="title-2">
              <h5>Services</h5>
            </div>
            <div class="carousel-single owl-carousel caro-pagin-2" data-autoplay="true" data-paginate="true" data-trans="goDown">
              <div class="item">
                <div class="branding-block">
                  <div class="text service_font">
                    <p>Web Design & Development</p>
                  </div>
                </div>
                <!-- /branding-block --> 
              </div>
              <div class="item">
                <div class="branding-block">
                  <div class="text service_font">
                    <p>Mobile App Development</p>
                  </div>
                </div>
                <!-- /branding-block --> 
              </div>
              <div class="item">
                <div class="branding-block">
                  <div class="text service_font">
                    <p>Online Marketing & Digital Promotion</p>
                  </div>
                </div>
                <!-- /branding-block --> 
              </div>
              <div class="item">
                <div class="branding-block">
                  <div class="text service_font">
                    <p>Search Engine Optimization (SEO)</p>
                  </div>
                </div>
                <!-- /branding-block --> 
              </div>
              <div class="item">
                <div class="branding-block">
                  <div class="text service_font">
                    <p>E-Commerce Solutions</p>
                  </div>
                </div>
                <!-- /branding-block --> 
              </div>
              <div class="item">
                <div class="branding-block">
                  <div class="text service_font">
                    <p>Branding & Graphic Design</p>
                  </div>
                </div>
                <!-- /branding-block --> 
              </div>
            </div>
          </div>
          <!-- /info-box --> 
        </div>
        <!-- /box --> 
      </div>
      <div class="col-sm-6">
        <div class="title-box bg-primary ico-box icon-comment-o"> 
          <!--<span class="num-bx">03.</span>-->
          <div class="title-1">
            <h6>Contact Us</h6>
            <h4 class="text-uppercase">GET IN TOUCH</h4>
          </div>
          <a href="<?=file_path()?>contact" class="readmore"><i class="fa fa-plus"></i>View More</a> </div>
        <!-- /title-box --> 
      </div>
      <div class="col-sm-6">
        <div class="team-box">
          <div class="image block-image">
            <figure> <img src="<?=asset_path()?>images/resource/img-23.jpg" alt="image">
              <figcaption> 
                <!-- <h6 class="text-secondary"><a href="#">Jhonathan</a></h6>
                                   <p>Visual Designer</p>-->
                <ul class="social-links" style="top: 3px;">
                  <li><a href="https://www.facebook.com/phoenixbinarysystem/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/phoenixbinary" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="https://www.instagram.com/phoenixbinarysystem/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </figcaption>
            </figure>
          </div>
          <!-- /image --> 
        </div>
        <!-- /team-box --> 
        
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-dh bg-white" style="padding-top: 40px;">
        <div class="contact-box">
          <?php
				//
//				if($this->session->flashdata('msg_true')!='')
//				{
//					 echo '<h4 style="color:green;">'.$this->session->flashdata('msg_true').'</h4>';
//					
//				}
//				if($this->session->flashdata('msg_false')!='')
//				{
//					 echo '<h4 style="color:red;">'.$this->session->flashdata('msg_false').'</h4>';
//				}
			?>
          <h4 class="text-uppercase">Apply Now</h4>
          <div id="message"></div>
          <form id="contactform_forms1" class="contact-form checkout-form" action="<?=base_url()?>index.php/career/career_submit" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input id="contact_name" name="contact_fname" type="text" class="form-control" placeholder="First Name*" required="required">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input id="contact_name" name="contact_lname" type="text" class="form-control" placeholder="Last Name*" required="required">
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input id="contact_email" name="contact_email" type="email" class="form-control" placeholder="Email Address*" required="required">
                </div>
              </div>
              	
              <div class="col-md-6">
                <div class="form-group">
                  <input id="contact_no" name="contact_no" type="tel"  pattern="[0-9]{10}" title="Enter valid mobile number" class="form-control" placeholder="Mobile*" required="required">
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="file" name="resume" accept=".doc,.docx, .pdf" class="form-control" required="required" style="padding: 13px 20px;font-size:13px;"/>
                </div>
              </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-success">
            <div class="error_p" style="color:red;"> <?php // echo validation_errors(); ?> </div>
          </form>
        </div>
        <!-- /info-box --> 
      </div>
      <!-- /box --> 
      
    </div>
  </div>
</div>
<!-- /row -->

</div>
<!-- /contents-area --> 

