

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
            
        
          
            
            <div class="form-group">
            
              <label class="col-sm-2 control-label">Service</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('service_id', isset($result[0]['service_id']) ? $result[0]['service_id'] : ''); ?>
                <select class="form-control chosen-select" name="service_id" data-placeholder="Select Service Here" required>
					<option value="">Select Service</option>
					
					
					<?php for($i=0;$i<count($services);$i++){ ?>
					
						<?php if($form_value==$services[$i]['id']){
								
								$sel="selected=selected";
	
							}else{
								
								$sel="";
								
							}
															 
															 
					
						?>
					
						<option <?=$sel?> value="<?=$services[$i]['id']?>"><?=$services[$i]['name']?></option>
					
					<?php } ?>
					
				</select>
                
                <?php echo form_error('fname', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
            
            <div class="form-group">
            
              <label class="col-sm-2 control-label">Request For</label>
              
              <div class="col-sm-9">
              	
				  
                <?php $form_value = set_value('req_for', isset($result[0]['req_for']) ? $result[0]['req_for'] : ''); ?>
				  
				 
                <select class="form-control chosen-select2" name="req_for" data-placeholder="Select Request For" required>
					
					<option value="">Request For</option>
					
					<?php for($i=0;$i<count($user);$i++){ ?>
					
						<?php if($form_value==$user[$i]['id']){
								
								$sel1="selected=selected";
	
							}else{
								
								$sel1="";
								
							}
					
						?>
						
					
						<option <?=$sel1?> value="<?=$user[$i]['id']?>"><?=$user[$i]['fname'].' '.$user[$i]['lname']?></option>
					
						
					
					<?php } ?>
					
				</select>
                
                <?php echo form_error('req_for', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
        	 
		
		   
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Request Details</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('request_details', isset($result[0]['request_details']) ? $result[0]['request_details'] : ''); ?>
                
                <textarea class="form-control" id="request_details" name="request_details" required="required" placeholder="Request Details"><?=$form_value?></textarea>
                
                <?php echo form_error('request_details', '<p class="error_p">', '</p>'); ?> </div>
                
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
 <script src="<?=base_url('assets')?>/choosen/chosen.jquery.js" type="text/javascript"></script>
  <!--<script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>-->
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"},
	  '.chosen-select2'           : {},
      '.chosen-select2-deselect'  : {allow_single_deselect:true},
      '.chosen-select2-no-single' : {disable_search_threshold:10},
      '.chosen-select2-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select2-width'     : {width:"100%"}
    }
	
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
</script>

