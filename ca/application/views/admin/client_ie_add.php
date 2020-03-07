
<div class="contentpanel">

  <!-------------->

  <div class="panel panel-default">

    <div class="panel-heading">

      <h4 class="panel-title"><?=$sub_title?></h4>

    </div>

    <div class="panel-body">

       <form action="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/import" method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">

            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

		    <div class="form-group">

              <label class="col-sm-2 control-label">Upload file here</label>

              <div class="col-sm-9">

				<input type="file" name="filename" id="upload_file" onChange="Checkfiles();" required>


				</div>
		   </div>




            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>">
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
    	if(ext=="csv")
    	{
        	return true;
   		}
    	else
    	{
        	alert("Only csv file extentions allow to upload");
			fup.value="";
        	return false;
    	}
    }
</script>


