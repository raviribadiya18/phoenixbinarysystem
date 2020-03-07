<script>
	$(document).ready(function(e) {
      //  alert('hi');
		
$('#add').click(function () {
	alert($('.sr1').length + 1);
    var n = $('.sr1').length + 1;
    var temp = $('.sr1:first').clone();
    $('input:first', temp).attr('placeholder', 'Item #' + n)
    $('.sr1:last').after(temp);
});
   });
</script>
    <script src="<?=asset_path()?>js/chosen.jquery.js"></script>
    
	<link href="<?=asset_path()?>css/chosen.css" rel="stylesheet">
    
   <script>
    	$(document).ready(function(e) {
			
			$(".chzn-select").chosen();
			
       	 	$(".chzn-select-deselect").chosen({
				
            	allow_single_deselect: true
				
        	});
			
             $('.default-date-picker').datepicker({
				 
           		 format: 'dd-mm-yyyy'
				 
       		 });
			 
        });
    </script> 


<div class="contentpanel"> 

  <!-------------->
  
  <div class="panel panel-default">
  
    <div class="panel-heading">
    
      <h4 class="panel-title"><?=$sub_title?></h4>
      
    </div>
    
    <div class="panel-body">
    
       <form class="form-horizontal row-border">
       
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            
            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />
            
            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />
            
        
          
            
            <div class="form-group">
            
              <label class="col-sm-2 control-label">Client Name</label>
              
              <div class="col-sm-9">
              
             
                
                <input type="text" class="form-control" name="fname" value="<?=$result[0]['fname'].''.$result[0]['lname']?>"placeholder="First Name" readonly>
                
                 </div>
                
            </div>
            
           
		   
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Mobile No</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('mobileno', isset($result[0]['mobileno']) ? $result[0]['mobileno'] : ''); ?>
                
                <input type="text" class="form-control"name="mobileno" value="<?=$result[0]['mobileno']?>" readonly>
                
                <?php echo form_error('mobileno', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		 
          </form>
    </div>
    <!-- panel-body --> 
  </div>
  <!--------------> 
   <div class="panel panel-default">
  
    <div class="panel-heading">
    
      <h4 class="panel-title"><?=$sub_title?></h4>
      
    </div>
    
    <div class="panel-body">
    
     <?php /*?>  <form  method="post" class="form-horizontal row-border" enctype="multipart/form-data">
       
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            
            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />
            
            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />
            
        
          
		   <div class="sr1">
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Select Serevice</label>
              
             	 <div class="col-sm-9">
              
                <?php $form_value = set_value('s_id', isset($result[0]['s_id']) ? $result[0]['s_id'] : ''); ?>
                <select class="form-control chosen-select" name="s_id" data-placeholder="Select Task Here" required>
					<option value="">Select Task</option>
					
					
					<?php for($i=0;$i<count($services);$i++){ ?>
					
					
						<option value="<?=$services[$i]['id']?>"><?=$services[$i]['name']?></option>
					
					<?php } ?>
					
				</select>
                
                <?php echo form_error('s_id', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		     <div class="form-group">
            
              <label class="col-sm-2 control-label">Amount</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('amount', isset($result[0]['amount']) ? $result[0]['amount'] : ''); ?>
                
                <input type="number" class="form-control" id="amount" name="amount" value="<?=$form_value?>" required="required" placeholder="amount">
                
                <?php echo form_error('amount', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   
		    </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
				  <input type='button' class="btn btn-primary" id='add' value='Add item' />
               
                <a href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/view">
                <button type="button" class="btn btn-default">Cancel</button>
                </a> </div>
              <!--/form-group--> 
            </div>
          </form><?php */?>
    </div>
    <!-- panel-body --> 
  </div>
	
	  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">List
      	
      </h4>
    </div>
    <div class="panel-body">
    	 
       <table class="table  table-bordered responsive" id="data-table">
            <thead>
            	
              <tr>
                <th>Sr. No</th>
                <th>Service Name</th>
				<th>Price</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
    </div>
    <!-- panel-body --> 
  </div>
</div>
<!-- contentpanel --> 
