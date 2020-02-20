<div class="contents-area">

        <div class="row">
            <div class="col-sm-3">

                <div class="title-box bg-primary ico-box icon-phone-o">
                    <!--<span class="num-bx">02.</span>-->
                    <div class="title-1">
                        <h6>Call Now</h6>
                        <h4 class="text-uppercase">Touch with us</h4>
                    </div>
                    <p>+91 886 622 0223</p>
                    <a href="#" class="readmore"><i class="fa fa-plus"></i>Call us now</a>
                </div><!-- /title-box -->

            </div>
           
           <?php /*?> <div class="col-sm-3">
                <div class="title-box bg-secondary ico-box icon-browser">
                    <span class="num-bx">01.</span>
                    <div class="title-1">
                        <h6>Address</h6>
                        <h4 class="text-uppercase">Our Location</h4>
                    </div>
                    <a href="#" class="readmore"><i class="fa fa-plus"></i>Get Direction</a>
                </div><!-- /title-box -->
            </div><?php */?>

            <div class="col-sm-6">
                <div class="box bg-grey">
                    <div class="address-box">
                        <div class="iconic"><i class="icon icon-location"></i></div>
                        <div class="text">
                            <div class="title-2"><h5>Address</h5></div>
                            <p><b>Anand:</b> F-12, Triveni Arcade, Vidyanagar Road, Anand - 388001</p>
							<p><b>Surat:</b> 316, Polaris Commercial Mall, Parvat Patiya, Surat - 395010</p>
                        </div>
                    </div><!-- /info-box -->
                </div><!-- /box -->
            </div>
			
            <div class="col-sm-3">
                        <div class="title-box bg-primary ico-box icon-envelope-o">
                          <!--  <span class="num-bx">03.</span>-->
                            <div class="title-1">
                                <h6>Mail Now</h6>
                                <h4 class="text-uppercase">Email Address</h4>
                            </div>
                            <p>phoenix8155@gmail.com</p>
                            <a href="#" class="readmore"><i class="fa fa-plus"></i>Mail us now</a>
                        </div><!-- /title-box -->
                    </div>
           
        </div><!-- /row -->

        <div class="row">
            <div class="col-sm-6">
                <div class="box box-dh bg-white">
                    <div class="contact-box">
                        
                        <?php
							
							if($this->session->flashdata('msg_true')!='')
							{
								 echo '<h4 style="color:green;">'.$this->session->flashdata('msg_true').'</h4>';
								
							}
							if($this->session->flashdata('msg_false')!='')
							{
								 echo '<h4 style="color:red;">'.$this->session->flashdata('msg_false').'</h4>';
							}
						?>
                        
                        
                        <h4 class="text-uppercase">Contact us</h4>
                        <div id="message"></div>
                        <form id="contactform_forms1" class="contact-form checkout-form" action="<?=base_url()?>index.php/contact/contact_us" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><input id="contact_name" name="contact_name" type="text" class="form-control" placeholder="Name*" required="required"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input id="contact_email" name="contact_email" type="email" class="form-control" placeholder="Email Address*" required="required"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><input id="contact_no" name="contact_no" type="tel"  pattern="[0-9]{10}" title="Enter valid mobile number" class="form-control" placeholder="Mobile*" required="required"></div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group"><input id="contact_subject" name="contact_subject" type="text" class="form-control" placeholder="Subject*" required="required"></div>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group"><textarea id="contact_message" name="contact_message" class="form-control" placeholder="Message*" required="required"></textarea></div>
                                </div>
                            </div>
                            <input type="submit" value="Send Now" class="btn btn-success">
                            <div class="error_p" style="color:red;">
							 <?php echo validation_errors(); ?>
                            </div>
                        </form>
                    </div><!-- /info-box -->
                </div><!-- /box -->
            </div>
            <div class="col-sm-6">
                <div class="row">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14739.069745394798!2d72.9339553!3d22.550383!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe4cf49360715ca70!2sPhoenix+Binary+System+Pvt+Ltd!5e0!3m2!1sen!2sin!4v1546405293459" width="570" height="540" frameborder="0" style="border:0" allowfullscreen></iframe>
                   <!-- <div class="box box-dh">
                        <div id="map-canvas"></div>
                    </div>-->
                    <!-- /title-box -->
                </div>
            </div>
        </div><!-- /row -->

    </div><!-- /contents-area -->
    
<!-- google map script --> 
<?php /*?><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7z3qSfW7_1ArWHGs69jHLbLw-jOOGwuk"></script><?php */?>
<?php /*?><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEY-NcZPPTXSMTwBcS9w8Rx9q5B1HQF30"></script><?php */?>

<?php /*?><script>
    function initialize() {
      var location = new google.maps.LatLng(22.5509376,72.933376);
      var mapOptions = {
        center: location,
        scrollwheel: true,
        disableDefaultUI: true,
        zoom: 14,
        styles: [   
            {       featureType:'water',        stylers:[{color:'#c3c3c3'},{visibility:'on'}]   },
            {       featureType:'landscape',        stylers:[{color:'#f2f2f2'}] },
            {       featureType:'road',     stylers:[{saturation:-100},{lightness:25}]  },
            {       featureType:'road.highway',     stylers:[{visibility:'simplified'}] },
            {       featureType:'road.arterial',        elementType:'labels.icon',      stylers:[{visibility:'off'}]    },
            {       featureType:'administrative',       elementType:'labels.text.fill',     stylers:[{color:'#444444'}] },
            {       featureType:'transit',      stylers:[{visibility:'off'}]    },
            {       featureType:'poi',      stylers:[{visibility:'off'}]    }]              
      };
      var mapElement = document.getElementById('map-canvas');
      var map = new google.maps.Map(mapElement, mapOptions);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script><?php */?>