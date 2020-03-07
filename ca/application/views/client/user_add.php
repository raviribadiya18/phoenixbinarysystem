<div class="contentpanel"> 

  <!-------------->
  
  <div class="panel panel-default">
  
    <div class="panel-heading">
    
      <h4 class="panel-title"><?=$sub_title?></h4>
      
    </div>
    
    <div class="panel-body">
    
       <form action="<?=file_path('client')?><?=$this->uri->rsegment(1)?>/insert" method="post" class="form-horizontal row-border" enctype="multipart/form-data">
       
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            
            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />
            
            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />
		   
		    <input type="hidden" name="usercode" id="usercode" value="<?=$form_set['usercode']?>" />
            
        
          
            
            <div class="form-group">
            
              <label class="col-sm-2 control-label">First Name</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('fname', isset($result[0]['fname']) ? $result[0]['fname'] : ''); ?>
                
                <input type="text" class="form-control" id="fname" name="fname" value="<?=$form_value?>" required="required" placeholder="First Name">
                
                <?php echo form_error('fname', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
            
           
        	 <div class="form-group">
            
              <label class="col-sm-2 control-label">Last Name</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('lname', isset($result[0]['lname']) ? $result[0]['lname'] : ''); ?>
                
                <input type="text" class="form-control" id="lname" name="lname" value="<?=$form_value?>" required="required" placeholder="Last Name">
                
                <?php echo form_error('lname', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Company Name</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('company_name', isset($result[0]['company_name']) ? $result[0]['company_name'] : ''); ?>
                
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?=$form_value?>" required="required" placeholder="Company Name">
                
                <?php echo form_error('company_name', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		   
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Mobile No</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('mobileno', isset($result[0]['mobileno']) ? $result[0]['mobileno'] : ''); ?>
                
                <input type="number" class="form-control" id="mobileno" name="mobileno" value="<?=$form_value?>" required="required" placeholder="Mobile No">
                
                <?php echo form_error('mobileno', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Email</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('emailid', isset($result[0]['emailid']) ? $result[0]['emailid'] : ''); ?>
                
                <input type="email" class="form-control" id="emailid" name="emailid" value="<?=$form_value?>" required="required" placeholder="Email">
                
                <?php echo form_error('emailid', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('client')?><?=$this->uri->rsegment(1)?>/view">
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
