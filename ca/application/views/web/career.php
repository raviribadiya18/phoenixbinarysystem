<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Page Title Section START -->
<div class="page-title-section" style="background-image: url(<?=asset_path('web/')?>img/career-hdr.jpg);">
	<div class="container">
		<div class="page-title center-holder">
			<h1>Career</h1>
			<ul>
				<li><a href="<?=file_path()?>home">Home</a></li>
				<li><a href="<?=file_path()?>career">Career</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- Page Title Section END -->



<!-- Contact Form Section Start -->
<div class="section-block">
	<div class="container">
		<div class="section-heading center-holder">
			<h2>Apply for Job</h2>
			
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

				<form method="post" action="<?=file_path()?><?=$this->uri->rsegment(1)?>/check" enctype="multipart/form-data" class="primary-form">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
					<div class="col-xs-12">
						<?php $form_value = set_value('name',''); ?>
						<input type="text" value="<?=$form_value?>" name="name" placeholder="Name" required>
						<?php echo form_error('name', '<p class="error_p">', '</p>'); ?>
					</div>
					<div class="col-xs-6">
						<?php $form_value = set_value('email',''); ?>
						<input type="email" value="<?=$form_value?>" name="email" placeholder="E-mail adress" required>
						<?php echo form_error('name', '<p class="error_p">', '</p>'); ?>
					</div>
					<div class="col-xs-6">
						<?php $form_value = set_value('phone',''); ?>
						<input type="number" value="<?=$form_value?>" name="phone" placeholder="Mobile Number" required>
						<?php echo form_error('name', '<p class="error_p">', '</p>'); ?>
					</div>	
					<div class="col-xs-12">
						<?php $form_value = set_value('message',''); ?>
						<textarea name="message" placeholder="Message" required><?=$form_value?></textarea>
						<?php echo form_error('message', '<p class="error_p">', '</p>'); ?>
					</div>
					<div class="col-xs-12">
						<input type="file" name="upload_file" id="upload_file" onChange="Checkfiles();" required>
						<?php echo form_error('upload_file', '<p class="error_p">', '</p>'); ?>
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

<script src="<?=asset_path('web/')?>js/jquery.min.js"></script>


<script>
	function Checkfiles()
    {
		
        var fup = document.getElementById('upload_file');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		var ext = ext.toLowerCase();
    	if(ext=="docx" || ext=="pdf")
    	{
        	return true;
   		}
    	else
    	{
        	alert("Only docx,pdf file extentions allow to upload");
			fup.value="";
        	return false;
    	}
    }
</script>