

<div class="contentpanel"> 

  <!-------------->
  
  <div class="panel panel-default">
  
    <div class="panel-heading">
    
      <h4 class="panel-title"><?=$sub_title?></h4>
      
    </div>
    
    <div class="panel-body">
    
       <form action="<?=file_path('emp')?><?=$this->uri->rsegment(1)?>/insert" method="post" class="form-horizontal row-border" enctype="multipart/form-data">
       
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            
            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />
            
            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />
            
        
          
            
            <div class="form-group">
            
              <label class="col-sm-2 control-label">Task Status</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('task_status', isset($result[0]['task_status']) ? $result[0]['task_status'] : ''); ?>
                <select class="form-control chosen-select" name="task_status" data-placeholder="Select Your Task Status Here" required="required">
					<?php if($form_value=="Initial"){
	
								$sel1="selected=selected";
	
							}else{
	
								$sel1="";
	
							}
					
							if($form_value=="Inprogress"){
								
								$sel2="selected=selected";
								
							}else{
								
								$sel2="";
								
							}
					
							if($form_value=="Pending"){
								
								$sel3="selected=selected";
								
							}else{
								
								$sel3="";
							}
					
							if($form_value=="Completed"){
								
								$sel4="selected=selected";
								
							}else{
								
								$sel4="";
							}
					?>
					
					<option value="">Select Status</option>
					
					<option <?=$sel1?> value="Initial">Initial</option>
					
					<option <?=$sel2?> value="Inprogress">Inprogress</option>
					
					<option <?=$sel3?> value="Pending">Pending</option>
					
					<option <?=$sel4?> value="Completed">Completed</option>
				
					
				</select>
                
                <?php echo form_error('fname', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
            
           
        	 <div class="form-group">
            
              <label class="col-sm-2 control-label">Task Name</label>
              
              <div class="col-sm-9">
               <?php 
				  	
				  $record_service	=	$this->comman_fun->get_table_data('service_master',array('id'=>$result[0]['s_id']));
				
				 // $record_service[0]['name'];
				  
				 ?>
				  
                <?php $form_value = set_value('task_name', isset($record_service[0]['name']) ? $record_service[0]['name'] : ''); ?>
               
                <input type="text" class="form-control" id="task_name" name="task_name" value="<?=$form_value?>" readonly>
                
                <?php echo form_error('task_name', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		
		   
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Task Details</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('task_details', isset($result[0]['task_details']) ? $result[0]['task_details'] : ''); ?>
                
                <textarea class="form-control" id="task_details" name="task_details" readonly><?=$form_value?></textarea>
                
                <?php echo form_error('task_details', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		   <div class="form-group">
            
              <label class="col-sm-2 control-label">Working Notes</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('working_notes', isset($result[0]['working_notes']) ? $result[0]['working_notes'] : ''); ?>
                
                <textarea class="form-control" id="working_notes" name="working_notes" placeholder="Enter Working Notes Here"><?=$form_value?></textarea>
                
                <?php echo form_error('working_notes', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
     	
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('emp')?><?=$this->uri->rsegment(1)?>/view/<?=$option[0]['contain_name']?>">
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

