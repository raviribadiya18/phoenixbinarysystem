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
					$('#c_id').html(result);
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




            <div class="form-group">

              <label class="col-sm-2 control-label">Select Employee</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('task_assign', isset($result[0]['task_assign']) ? $result[0]['task_assign'] : '');?>
                <select class="form-control chosen-select" name="task_assign" data-placeholder="Select Your Employee Here" required="required">
					<option value="">Select Employee</option>


					<?php for ($i = 0; $i < count($employee); $i++) {
	?>

						<?php if ($form_value == $employee[$i]['usercode']) {

		$sel = "selected=selected";

	} else {

		$sel = "";

	}

	?>

						<option <?=$sel?> value="<?=$employee[$i]['usercode']?>"><?=$employee[$i]['fname'] . ' ' . $employee[$i]['lname']?></option>

					<?php }?>

				</select>

                <?php echo form_error('task_assign', '<p class="error_p">', '</p>'); ?> </div>

            </div>

		               <div class="form-group">

              <label class="col-sm-2 control-label">Select Task</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('s_id', isset($result[0]['s_id']) ? $result[0]['s_id'] : '');?>
                <select class="form-control chosen-select" name="s_id" data-placeholder="Select Task Here" required>
					<option value="">Select Task</option>


					<?php for ($i = 0; $i < count($services); $i++) {
	?>

						<?php if ($form_value == $services[$i]['id']) {

		$sel = "selected=selected";

	} else {

		$sel = "";

	}

	?>

						<option <?=$sel?> value="<?=$services[$i]['id']?>"><?=$services[$i]['name']?></option>

					<?php }?>

				</select>

                <?php echo form_error('s_id', '<p class="error_p">', '</p>'); ?> </div>

            </div>

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


						<option <?=$sel1?> value="<?=$cname[$i]['usercode']?>"><?=$cname[$i]['fname'] . ' ' . $cname[$i]['lname'] . ' (' . $cname[$i]['username'] . ')'?></option>



					<?php }?>

				</select>

                <?php echo form_error('cname', '<p class="error_p">', '</p>'); ?> </div>

            </div>

		      <div class="form-group">

              <label class="col-sm-2 control-label">User</label>

              <div class="col-sm-9">


                <?php $form_value = set_value('c_id', isset($result[0]['c_id']) ? $result[0]['c_id'] : '');?>

				 <select id="c_id" name="c_id"  class="form-control"  data-placeholder="Select Client Here" required>

                  <?php if ($form_set['mode'] == "edit") {?>
					 <?=$this->comman_fun->client_sub_users(array('usercode' => $result[0]['usercode'], 'sel' => $result[0]['c_id']))?>

					 	<?php } else {?>

					  <?=$this->comman_fun->client_sub_users(array('usercode' => $_REQUEST['usercode'], 'sel' => $_REQUEST['c_id']))?>
					 <?php }?>
                </select>

                <?php /*?><select class="form-control chosen-select2" name="c_id" id="c_id" data-placeholder="Select Client Here" required>

<option value="">Select Client</option>

<?php for($i=0;$i<count($user);$i++){ ?>

<?php if($form_value==$user[$i]['id']){

$sel1="selected=selected";

}else{

$sel1="";

}
//$sel1

$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$user[$i]['usercode']));

$user_name=$record[0]['username'];

?>

<option  <?=$sel?>  value="<?=$user[$i]['id']?>"><?=$user[$i]['fname'].' '.$user[$i]['lname'].' ('.$user_name.')'?></option>

<?php } ?>

</select><?php */?>

                <?php echo form_error('c_id', '<p class="error_p">', '</p>'); ?> </div>

            </div>






        	<?php /*?> <div class="form-group">

<label class="col-sm-2 control-label">Task Name</label>

<div class="col-sm-9">

<?php $form_value = set_value('task_name', isset($result[0]['task_name']) ? $result[0]['task_name'] : ''); ?>

<input type="text" class="form-control" id="task_name" name="task_name" value="<?=$form_value?>" required="required" placeholder="Task Name">

<?php echo form_error('task_name', '<p class="error_p">', '</p>'); ?> </div>

</div><?php */?>


		    <div class="form-group">

              <label class="col-sm-2 control-label">Task Details</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('task_details', isset($result[0]['task_details']) ? $result[0]['task_details'] : '');?>

                <textarea class="form-control" id="task_details" name="task_details" required="required" placeholder="Task Details"><?=$form_value?></textarea>

                <?php echo form_error('task_details', '<p class="error_p">', '</p>'); ?> </div>

            </div>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/view/<?=$option[0]['contain_name']?>">
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

