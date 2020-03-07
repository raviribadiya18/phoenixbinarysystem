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
            
              <label class="col-sm-2 control-label">Subject</label>
              
              <div class="col-sm-9">
              	
				  
                <?php $form_value = set_value('subject', isset($result[0]['subject']) ? $result[0]['subject'] : ''); ?>
				  
				 
               <input type="text" name="subject" class="form-control"  value="<?=$form_value?>" placeholder="Subject"/>
                
                <?php echo form_error('subject', '<p class="error_p">', '</p>'); ?> </div>
                
            </div>
		   <div class="form-group">
            
              <label class="col-sm-2 control-label">Message</label>
              
              <div class="col-sm-9">
              
                <?php $form_value = set_value('message', isset($result[0]['message']) ? $result[0]['message'] : ''); ?>
                
                <textarea class="form-control" id="message" name="message" required="required" placeholder="Message"><?=$form_value?></textarea>
                
                <?php echo form_error('message', '<p class="error_p">', '</p>'); ?> </div>
                
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

<script>
	function Checkfiles()
    {
		
        var fup = document.getElementById('upload_file');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		var ext = ext.toLowerCase();
    	if(ext =="jpeg" ||  ext=="png"  || ext=="jpg" || ext=="docx" || ext=="csv" || ext=="xls" || ext=="xlsx" || ext=="pdf")
    	{
        	return true;
   		}
    	else
    	{
        	alert("Only jpeg,png,jpg,docx,csv,xls,xlsx,pdf file extentions allow to upload");
			fup.value="";
        	return false;
    	}
    }
</script>
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

