
<div class="contentpanel"> 

  <!-------------->
  
  <div class="panel panel-default">
  
    <div class="panel-heading">
    
      <h4 class="panel-title"><?=$sub_title?></h4>
      
    </div>
    
    <div class="panel-body">
    
       <form action="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/export_income_report" method="post" class="form-horizontal row-border" enctype="multipart/form-data">
       
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
        
		    <div class="form-group">
            
              <label class="col-sm-2 control-label">Start Date</label>
              
              <div class="col-sm-9">

				<input type="date" name="start_date" id="start_date" required>  
				
				</div>
		    </div>
		   
		   <div class="form-group">
            
              <label class="col-sm-2 control-label">End Date</label>
              
              <div class="col-sm-9">

				<input type="date" name="end_date" id="end_date" required>  
				
				</div>
		    </div>
		   
		   
		   
		   
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/view">
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


