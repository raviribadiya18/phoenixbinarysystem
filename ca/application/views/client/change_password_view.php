<div class="contentpanel"> 

  <!-------------->
  
  <div class="panel panel-default">
  
    <div class="panel-heading">
    
      <h4 class="panel-title"><?=$sub_title?></h4>
      
    </div>
    
    <div class="panel-body">
    
       <form action="<?=file_path('client')?><?=$this->uri->rsegment(1)?>/change_password_insert" method="post" class="form-horizontal row-border" enctype="multipart/form-data">
       
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
           
		  		<div class="form-group">
						
						<label class="col-sm-3 control-label" for="demo-hor-inputemail">Enter Old Password</label>
						<div class="col-sm-9">
						<?php $form_value = set_value('old_pass',''); ?>
							<input type="password" name="old_pass" id="old_pass" value="" class="form-control" placeholder="Enter Old Password" required title="Enter Old Password" />
                 		<?php echo form_error('old_pass', '<p class="error_p">', '</p>'); ?>
						</div>
					</div>
					
					<div class="form-group">
						
						<label class="col-sm-3 control-label" for="demo-hor-inputemail">New Password</label>
						<div class="col-sm-9">
						<?php $form_value = set_value('new_pass',''); ?>
							<input type="password" name="new_pass" id="new_pass" value="" class="form-control" placeholder="New Password" required title="New Password" />
                 		<?php echo form_error('new_pass', '<p class="error_p">', '</p>'); ?>
						</div>
					</div>
					
					<div class="form-group">
						
						<label class="col-sm-3 control-label" for="demo-hor-inputemail">Confirm Password</label>
						<div class="col-sm-9">
						<?php $form_value = set_value('confirm_pass',''); ?>
							<input type="password" name="confirm_pass" id="confirm_pass" value="" class="form-control" placeholder="Confirm Password" required title="Confirm Password" />
                 		<?php echo form_error('confirm_pass', '<p class="error_p">', '</p>'); ?>
						</div>
					</div>
					
		   
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('client')?><?=$this->uri->rsegment(1)?>/change_password">
                <button type="button" class="btn btn-default">Cancel</button>
                </a> </div>
              <!--/form-group--> 
            </div>
          </form>
    </div>
    <!-- panel-body --> 
  </div>
  <!--------------> 
  
</div>
<!-- contentpanel --> 
