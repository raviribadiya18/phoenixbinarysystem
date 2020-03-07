<script>
	$(document).ready(function(e) {



		$(document).on('change','#cname',function(e){
			//alert('hi');
			e.preventDefault();
			var eid=$(this).val();
			var url='<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/sub_user_client/'+eid;
			//alert(url);
			$.ajax({url:url,
				beforeSend: function(){
     				$('.process1').append('<span class="loding_process"> <i class="fa fa-spinner fa-spin"></i></span>');
   				},
   				complete: function(){
     				$('.loding_process').remove();
   				},
				success:function(result){
					$('#sub_id').html(result);
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
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

       <form action="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/insert" method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">

            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />

            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />

            <?php /*?>  <div class="form-group">

<label class="col-sm-2 control-label">Client Name</label>

<div class="col-sm-9">

<?php $form_value = set_value('cname', isset($result[0]['usercode']) ? $result[0]['usercode'] : ''); ?>

<select class="form-control chosen-select" name="cname" id="cname" data-placeholder="Select Client Here" required>

<option value="">Select Client</option>

<?php for($i=0;$i<count($cname);$i++){ ?>

<?php if($form_value==$cname[$i]['usercode']){

$sel1="selected=selected";

}else{

$sel1="";

}

?>

<option <?=$sel1?> value="<?=$cname[$i]['usercode']?>"><?=$cname[$i]['fname'].' '.$cname[$i]['lname']?></option>

<?php } ?>

</select>

<?php echo form_error('cname', '<p class="error_p">', '</p>'); ?> </div>

</div>
<?php */?>

		    <div class="form-group">

              <label class="col-sm-2 control-label">Client Name</label>

              <div class="col-sm-9">


                <?php $form_value = set_value('cname', isset($result[0]['usercode']) ? $result[0]['usercode'] : '');?>


                <select class="form-control chosen-select" name="cname" id="cname" data-placeholder="Select Client Here" required>

					<option value="">Select Client</option>

					<?php for ($i = 0; $i < count($cname); $i++) {
	?>

						<?php if ($form_value == $cname[$i]['usercode']) {

		$sel1 = "selected=selected";

	} else {

		$sel1 = "";

	}
	//$sel1

	?>


						<option <?=$sel1?> value="<?=$cname[$i]['usercode']?>"><?=$cname[$i]['fname'] . ' ' . $cname[$i]['lname'] . ' (' . $cname[$i]['mobileno'] . ')'?></option>



					<?php }?>

				</select>

                <?php echo form_error('cname', '<p class="error_p">', '</p>'); ?> </div>

            </div>

		    <div class="form-group">

              <label class="col-sm-2 control-label">User</label>

              <div class="col-sm-9">


                <?php $form_value = set_value('sub_id', isset($result[0]['sub_id']) ? $result[0]['sub_id'] : '');?>

				 <select id="sub_id" name="sub_id"  class="form-control"  data-placeholder="Select Client Here" required>

                  <?php if ($form_set['mode'] == "edit") {?>
					 <?=$this->comman_fun->client_sub_users(array('usercode' => $result[0]['usercode'], 'sel' => $result[0]['sub_id']))?>

					 	<?php } else {?>

					  <?=$this->comman_fun->client_sub_users(array('usercode' => $_REQUEST['usercode'], 'sel' => $_REQUEST['sub_id']))?>
					 <?php }?>
                </select>



                <?php echo form_error('sub_id', '<p class="error_p">', '</p>'); ?> </div>

            </div>

		   <div class="form-group">

              <label class="col-sm-2 control-label">Title</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('title', isset($result[0]['title']) ? $result[0]['title'] : '');?>

                <input type="text" class="form-control" id="title" value="<?=$form_value?>" name="title" required="required" placeholder="Title">

                <?php echo form_error('title', '<p class="error_p">', '</p>'); ?> </div>

            </div>


		    <div class="form-group">

              <label class="col-sm-2 control-label">Upload Document here</label>

              <div class="col-sm-9">

                <?php /*?><input type="file" name="upload_file" id="upload_file" onChange="Checkfiles();" required><?php */?>
				 <?php if ($form_set['mode'] == 'edit') {?>

                <input type="file" name="upload_file" id="upload_file" onChange="Checkfiles();">

				<?php } else {?>

				<input type="file" name="upload_file[]" id="upload_file[]" multiple onChange="Checkfiles();" required>

				<?php }?>
				<?php echo form_error('upload_file', '<p class="error_p">', '</p>'); ?>
				<p class="error_p1" style="color: #ff0000d4;font-weight: 600;"></p>
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

<script>
	function Checkfiles()
  {
    var fileName = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    var ext = ext.toLowerCase();
  	if(ext=="pdf")
  	{
      $('.error_p1').text("");
      return true;
 		}
  	else
  	{
      $('.error_p1').text("Only pdf file extentions allow to upload.");
      $('input[type=file]').val('');
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

