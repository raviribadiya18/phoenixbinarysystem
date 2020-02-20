<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="page-title d-flex bg-dark" aria-label="Page title" style="background-image: url(<?=asset_path()?>img/pages/help-hero-bg.jpg);">
      <div class="container text-left align-self-center">
        <h3 class="text-white">INQUIRY</h3>
      </div>
    </div>
    <!-- Page Content-->
    <!-- Main Container-->
    <section class="container pb-5 mb-3">
      
      <div class="wizard">
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
        <form class="wizard-body needs-validation" action="<?=base_url()?>index.php/inquiry/inquiry_submit" method="post" enctype="multipart/form-data">
          <div class="row">
            <!-- <div class="col-sm-6">
              <div class="form-group">
                <label for="help-topic">Select a job title <strong class='text-danger'>*</strong></label>
                <select class="form-control" required name="job_title" id="help-topic">
                  <option value>—</option>
                  <option value="PHP Developer">PHP Developer</option>
                  <option value="Web Design">Web Design</option>
                  <option value="Codeigniter Developer">Codeigniter Developer</option>
                  <option value="Laravel Developer">Laravel Developer</option>
                  <option value="Wordpress Developer">Wordpress Developer</option>
                  <option value="SEO">SEO</option>
                  <option value="Android Developer">Android Developer</option>
                  <option value="IOS Developer">IOS Developer</option>
                  <option value="Full Stack Developer">Full Stack Developer</option>
                  <option value="Joomla Developer">Joomla Developer</option>
                  <option value="Magento Developer">Magento Developer</option>
                  <option value="Blockchain Developer">Blockchain Developer</option>
                  <option value="Business Development Executive">Business Development Executive</option>
                </select>
                <div class="invalid-feedback">Please choose a title!</div>
              </div>
            </div> -->
           <!--  <div class="col-sm-6">
              <div class="form-group">
                <label for="help-subject">Name</label>
                <input class="form-control" type="text" name="name" id="help-name">
              </div>
            </div>
             <div class="col-sm-6">
              <div class="form-group">
                <label for="help-subject">Company </label>
                <input class="form-control" type="text" name="company" id="help-company">
              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-name">Your Name <strong class='text-danger'>*</strong></label>
                <input class="form-control" type="text" name="contact_name" required id="help-name">
                <div class="invalid-feedback">Please enter your name!</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-email">Company Name<strong class='text-danger'>*</strong></label>
                <input class="form-control" type="company" name="contact_company" required id="help-email">
                <div class="invalid-feedback">Please enter company name</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-email">Designation <strong class='text-danger'>*</strong></label>
                <input class="form-control" type="text" name="designation" required id="help-designation">
                <div class="invalid-feedback">Please enter Designations!</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-email">Your Email <strong class='text-danger'>*</strong></label>
                <input class="form-control" type="email" name="contact_email" required id="help-email">
                <div class="invalid-feedback">Please enter valid email address!</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-url">Mobile No</label>
                <input class="form-control" type="number"  pattern="[0-9]{10}" title="Enter valid mobile number" name="contact_no" required id="help-url" onKeyPress="if(this.value.length==13) return false;">
              </div>
            </div>
             <div class="col-sm-6">
              <div class="form-group">
                <label for="help-email">How you found us ? <strong class='text-danger'>*</strong></label>
                <input class="form-control" type="text" name="found_us" required id="help-found_us">
                <div class="invalid-feedback">Please enter Found Us!</div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="help-message">Message <strong class='text-danger'>*</strong></label>
            <textarea class="form-control" rows="6" name="message" required id="help-message"></textarea>
            <div class="invalid-feedback">Please provide a detailed description of your problem!</div>
          </div>
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LeUl9YUAAAAAGHY6FFK7TeYWQ_JUr82gXCCCs1o"></div>
        </div>
          <button class="btn btn-primary mr-4" type="submit">Submit a request</button><!-- <a class="navi-link d-inline-block align-middle py-2" href="#">Privacy policy</a> -->
        </form>
      </div>
    </section>