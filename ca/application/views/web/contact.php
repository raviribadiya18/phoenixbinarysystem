<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Page Title Section START -->
<div class="page-title-section" style="background-image: url(<?=asset_path('web/')?>img/contact-hdr.jpg);">
	<div class="container">
		<div class="page-title center-holder">
			<h1>Contact</h1>
			<ul>
				<li><a href="<?=file_path()?>home">Home</a></li>
				<li><a href="<?=file_path()?>contact">Contact</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- Page Title Section END -->



<!-- Contact icos START -->
<div class="partner-section-grey">
	<div class="container" > 
		<div class="contact-box">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12 contact-icon">
					<div class="icon-box">
						<i class="icon-phone-reciever"></i>
					</div>
					<h4>Phone</h4>
					<p> Phone: +91 96623 34487</p>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12 contact-icon">
					<div class="icon-box">
						<i class="icon-map-location"></i>
					</div>
					
					<h4>Address</h4>
					<p>307, Polaris Commercial Mall,</p>
					<p>Opp. Bhaiya nagar BRTS station, </p>
					<p>Puna canal Road,</p>
					<p>Punagam, Surat - 395 010</p>
					<p>Gujarat, India</p>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12 contact-icon">
					<div class="icon-box">
						<i class="icon-chat-bubbles"></i>
					</div>

					<h4>Email</h4>
					<p>Email: capbmandco@gmail.com</p>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contact icos END -->



<!-- Contact Form Section Start -->
<div class="section-block">
	<div class="container">
		<div class="section-heading center-holder">
			<h2>Send us a message</h2>
			<?php
	
			$top_msg=$this->session->flashdata('msg_show');
	 		
			if(is_array($top_msg)){

				if($top_msg['class']=='false'){	?>
			<h5 style="color: red;"><?=$top_msg['msg']?></h5>
			
			<?php }else{ ?>
					<h5 style="color: red;"><?=$top_msg['msg']?></h5>
				<?php } }?>
		</div>
		<div class="row mt-70">
			<div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

				<form method="post" action="<?=file_path()?><?=$this->uri->rsegment(1)?>/check" class="primary-form">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
					<div class="col-xs-12">
						<?php $form_value = set_value('name',''); ?>
						<input type="text" name="name" value="<?=$form_value?>" placeholder="Your Name" required>
						<?php echo form_error('name', '<p class="error_p">', '</p>'); ?>
					</div>
					<div class="col-xs-6">
						<?php $form_value = set_value('email',''); ?>
						<input type="email" name="email" value="<?=$form_value?>" placeholder="E-mail adress" required>
						<?php echo form_error('email', '<p class="error_p">', '</p>'); ?>
					</div>
					<div class="col-xs-6">
						<?php $form_value = set_value('phone',''); ?>
						<input type="number" name="phone" value="<?=$form_value?>" placeholder="Phone Number" required>
						<?php echo form_error('phone', '<p class="error_p">', '</p>'); ?>
					</div>	
					<div class="col-xs-12">
						<?php $form_value = set_value('message',''); ?>
						<textarea name="message" placeholder="Your Message" required><?=$form_value?></textarea>
						<?php echo form_error('message', '<p class="error_p">', '</p>'); ?>
					</div>
					<div class="col-xs-12">
						
						<div class="g-recaptcha" data-sitekey="6LcIEYAUAAAAALJKFk-UqNeTViyxKe7l04mVMKSD"></div>
						<?php echo form_error('g-recaptcha-response', '<p class="error_p">', '</p>'); ?>
						<!--<div class="g-recaptcha" data-sitekey="6LcIEYAUAAAAALJKFk-UqNeTViyxKe7l04mVMKSD"></div>-->
					</div>
					<div class="center-holder">
						<button type="submit" class="button button-primary mt-30">Send Message</button>
					</div>							
				</form>	

			</div>
		</div>
	</div>
</div>
<!-- Contact Form Section End -->



<!-- Map Start -->
<div id="map">
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFfiIWQysJYvv8Rp4Y3a9ZNJtBWWLKde0&callback=initMap">
	</script>  	
</div>
<!-- Map End -->
<script src="<?=asset_path('web/')?>js/map.js"></script>