<script>
	$(document).ready(function(e) {

		$(document).on('submit','#form11',function(e){

				var receiver_code=$('#receiver_code').val();
				var noti_title=$('#noti_title').val();
				var noti_desc=$('#noti_desc').val();

				if(receiver_code==''){
					alert('Select Receiver Code');
					$('#receiver_code').focus();
					return false;
				}

				if(noti_title==''){
					alert('Enter Notification Title');
					$('#noti_title').focus();
					return false;
				}

				if(noti_desc==''){
					alert('Enter Notification Description');
					$('#noti_desc').focus();
					return false;
				}



				if(receiver_code=='Selected_client'){

					if(!check_selected_list()){
								alert('Please Select Record');
								return false;
							}
				}




		});

		$(document).on('change','#checkall',function(e){
			$('.endcode').each( function( i , e ) {
				$(this).prop( "checked", $('#checkall').is(':checked') );
			 });
		});


		$(document).on('change','#receiver_code',function(e){

			get_data_list();

			e.preventDefault();

		});




    });

	function check_selected_list(){
		var tot_select=false;
		$('.endcode').each( function( i , e ) {
			if($(this).is(':checked')){
				tot_select=true;
			}
		});
		return tot_select;
	}

	function get_data_list()
	{
		var receiver_code=$('#receiver_code').val();

		if(receiver_code=='All_client'){
			$('.data-table-div').html('<h2 class="show_msg">Notification Send to All Client</h2>');
			return;
		}




		$('.data-table-div').html('<h2 class="show_msg">loading</h2>');

		var url='<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/get_data_list/'+receiver_code;
		$.ajax({url:url,
		success:function(result){

			$('.data-table-div').html(result);
		}});
	}
</script>

<div class="contentpanel">

  <!-------------->
  <form action="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/insertrecord" id="form11" method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">
  <div class="panel panel-default">

    <div class="panel-heading">

      <h4 class="panel-title"><?=$sub_title?></h4>

    </div>

    <div class="panel-body">



            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />

            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />




            <div class="form-group">

              <label class="col-sm-2 control-label">Select Receiver</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('receiver_code', isset($result[0]['receiver_code']) ? $result[0]['receiver_code'] : '');?>
                <select class="form-control chosen-select" name="receiver_code" id="receiver_code" data-placeholder="Select Here" required="required" required>
					<option value="">Select Client</option>
					<option value="All_client">All Client</option>
                    <option value="Selected_client">Selected Client</option>

				</select>

                <?php echo form_error('receiver_code', '<p class="error_p">', '</p>'); ?> </div>

            </div>


        	 <div class="form-group">

              <label class="col-sm-2 control-label">Title</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('noti_title', isset($result[0]['noti_title']) ? $result[0]['noti_title'] : '');?>

                <input type="text" class="form-control" id="noti_title" name="noti_title" value="<?=$form_value?>" required="required" placeholder="Title">

                <?php echo form_error('noti_title', '<p class="error_p">', '</p>'); ?> </div>

            </div>


		    <div class="form-group">

              <label class="col-sm-2 control-label">Notification</label>

              <div class="col-sm-9">

                	<?php $form_value = set_value('noti_desc', isset($result[0]['noti_desc']) ? $result[0]['noti_desc'] : '');?>

                	<textarea class="form-control" id="noti_desc" name="noti_desc" required="required" placeholder="Notification"><?=$form_value?></textarea>

                	<?php echo form_error('noti_desc', '<p class="error_p">', '</p>'); ?><br>
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

    </div>
    <!-- panel-body -->
  </div>
  <!-------------->


    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
      	List
      </h4>
    </div>
    <div class="panel-body">

       <div class="data-table-div"></div>

    </div>

    <!-- panel-body -->
  </div>

</form>
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



    }

    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

	$(document).ready(function(){
	    $('#noti_desc').keyup(function(){
	    	var val = $(this).val().length;
	    	if(val > 100){
	    		$('.error_p1').text('More than 50 words not allowed.');
	    	}else{
	    		$('.error_p1').text('');
	    	}
	    });
	});
</script>

