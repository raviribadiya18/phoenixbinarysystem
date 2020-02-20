<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="page-title d-flex bg-dark" aria-label="Page title" style="background-image: url(<?=asset_path()?>img/pages/help-hero-bg.jpg);">
      <div class="container text-left align-self-center">
        <h3 class="text-white">TRAINING PROGRAM</h3>
      </div>
    </div>
    
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
        <form class="wizard-body needs-validation" action="<?=base_url()?>index.php/training_program/send_email" method="post">
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
                <label for="help-email">Your Email <strong class='text-danger'>*</strong></label>
                <input class="form-control" type="email" name="contact_email" required id="help-email">
                <div class="invalid-feedback">Please enter valid email address!</div>
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-subject">Subject </label>
                <input class="form-control" type="text" name="subject" required="required" id="help-subject">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="help-url">Mobile No</label>
                <input class="form-control" type="number"  pattern="[0-9]{10}" title="Enter valid mobile number" name="contact_no" required id="help-url" maxlength="13">
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
          <div class="row">
            <!-- <div class="col-sm-6">
              <div class="form-group">
                <label for="help-url">Include a relevant URL</label>
                <input class="form-control" type="text" id="help-url">
              </div>
            </div> -->
            <!-- <div class="col-sm-6">
              <div class="form-group">
                <label for="help-file">Attachments</label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" id="help-file">
                  <label class="custom-file-label" for="help-file">Choose file...</label>
                </div>
              </div>
            </div> -->
          </div>
          <button class="btn btn-primary mr-4" type="submit">Submit a request</button><!-- <a class="navi-link d-inline-block align-middle py-2" href="#">Privacy policy</a> -->
        </form>
      </div>
    </section>