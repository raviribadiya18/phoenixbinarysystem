<?php /*?><script>
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
</script><?php */?>
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


  <!-------------->
   <div class="panel panel-default">

    <div class="panel-heading">

      <h4 class="panel-title"><?=$sub_title?></h4>

    </div>

    <div class="panel-body">

       <form id="user_form" method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">

            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />

		    <input type="hidden" name="usercode" id="usercode" value="<?=$form_set['usercode']?>" />

		    <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />

        	 <input type="hidden" name="total_amt" id="total_amt1" />

		  	 <div class="form-group">

              <label class="col-sm-2 control-label">Client Name</label>

              <div class="col-sm-9">

                <input type="text" class="form-control" name="fname" value="<?=$result[0]['fname'] . ' ' . $result[0]['lname']?>"placeholder="First Name" readonly>

                 </div>

            </div>



		     <div class="form-group">

              <label class="col-sm-2 control-label">User Name</label>

              <div class="col-sm-9">


                <?php $form_value = set_value('sub_uid', isset($result[0]['sub_uid']) ? $result[0]['sub_uid'] : '');?>


                <select class="form-control chosen-select" name="sub_uid" id="sub_uid" data-placeholder="Select User Here" required>

					<option value="">Select User</option>

					<?php for ($i = 0; $i < count($all_users_list); $i++) {
	?>

						<?php if ($form_value == $all_users_list[$i]['id']) {

		$sel1 = "selected=selected";

	} else {

		$sel1 = "";

	}
	//$sel1

	?>


						<option <?=$sel1?> value="<?=$all_users_list[$i]['id']?>"><?=$all_users_list[$i]['fname'] . ' ' . $all_users_list[$i]['lname'] . ' (' . $all_users_list[$i]['mobileno'] . ')'?></option>



					<?php }?>

				</select>

                <?php echo form_error('sub_uid', '<p class="error_p">', '</p>'); ?> </div>

            </div>



		     <div class="form-group">

              <label class="col-sm-2 control-label">Invoice Date</label>

              <div class="col-sm-9">


                <input type="date" class="form-control" id="invoice_date" name="invoice_date" required="required" required >

               </div>

            </div>


           <hr>





  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



   <div align="right" style="margin-bottom:5px;">
    <button type="button" name="add" id="add" class="btn btn-success btn-xs">Add</button>
   </div>
   <br />
  <!-- <form method="post" id="user_form">-->




    <div class="table-responsive">
     <table class="table table-striped table-bordered" id="user_data">
      <tr>
	   <th>Sr No</th>
       <th>Service Name</th>
       <th>Price</th>
	   <th>Description</th>
       <th>Details</th>
       <th>Remove</th>
      </tr>
     </table>
    </div>
	<hr>
	<p>Total Amount <span id="total_amt"></span></p>

    <div align="center">
     <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Insert" />
    </div>
   </form>


  <div id="user_dialog" title="Add Service">
   <div class="form-group">
    <label>Select Service</label>
    <select name="service_name" id="service_name" class="form-control" >
		<option value="">Please Select Service</option>
			<?php for ($i = 0; $i < count($services); $i++) {?>

				<option value="<?=$services[$i]['id']?>"><?=$services[$i]['name']?></option>

			<?php }?>
	   </select>
    <span id="error_service_name" class="text-danger"></span>
   </div>
   <div class="form-group">
    <label>Price</label>
    <input type="number" name="price" id="price" class="form-control" />
    <span id="error_price" class="text-danger"></span>
   </div>
	<div class="form-group">
    <label>Description</label>
    <input type="text" name="decription" id="decription" class="form-control" />
    <span id="error_decription" class="text-danger"></span>
   </div>

   <div class="form-group" align="center">
    <input type="hidden" name="row_id" id="hidden_row_id" />
    <button type="button" name="save" id="save" class="btn btn-info">Save</button>
   </div>
  </div>
  <div id="action_alert" title="Action">

  </div>


<script>
$(document).ready(function(){

 var count = 0;
 var total = 0;
 $('#user_dialog').dialog({
  autoOpen:false,
  width:400
 });

 $('#add').click(function(){
  $('#user_dialog').dialog('option', 'title', 'Add Service');
  $('#service_name').val('');
  $('#price').val('');
  $('#decription').val('');
  $('#error_service_name').text('');
  $('#error_price').text('');
  $('#error_decription').text('');
  $('#service_name').css('border-color', '');
  $('#price').css('border-color', '');
  $('#decription').css('border-color', '');
  $('#save').text('Save');
  $('#user_dialog').dialog('open');
 });

 $('#save').click(function(){
  var error_service_name = '';
  var error_price = '';
  var error_decription = '';
  var service_name = '';
  var price = '';
  var decription = '';
  var service_id='';

  if($('#service_name').val() == '')
  {
   error_service_name = 'Service is required';
   $('#error_service_name').text(error_service_name);
   $('#service_name').css('border-color', '#cc0000');
   service_name = '';
  }
  else
  {
   error_service_name = '';
   $('#error_service_name').text(error_service_name);
   $('#service_name').css('border-color', '');
   service_id = $('#service_name').val();
   service_name =$("#service_name option:selected").text();
  }
  if($('#price').val() == '')
  {
   error_price = 'Price is required';
   $('#error_price').text(error_price);
   $('#price').css('border-color', '#cc0000');
   price = '';


  }
  else
  {
   error_price = '';
   $('#error_price').text(error_price);
   $('#price').css('border-color', '');
   price = $('#price').val();

  }
  if($('#decription').val() == '')
  {
	   error_decription = 'Decription is required';
	   $('#error_decription').text(error_decription);
	   $('#decription').css('border-color', '#cc0000');
	   decription = '';
  }
  else
  {
	   error_decription = '';
	   $('#error_decription').text(error_decription);
	   $('#decription').css('border-color', '');
	   decription = $('#decription').val();

  }
  if(error_service_name != '' || error_price != '' || error_decription != '')
  {
   return false;
  }
  else
  {
   if($('#save').text() == 'Save')
   {
    count = count + 1;
	total+=parseInt(price);
	$("#total_amt").text(total);
	$("#total_amt1").val(total);
    output = '<tr id="row_'+count+'">';
    output += '<td>'+count+'</td><td>'+service_name+' <input type="hidden" name="hidden_service_name[]" id="service_name'+count+'" class="service_name" value="'+service_id+'" /></td>';
    output += '<td>'+price+' <input type="hidden" name="hidden_price[]" id="price'+count+'" value="'+price+'" /></td>';
	output += '<td>'+decription+' <input type="hidden" name="hidden_decription[]" id="decription'+count+'" value="'+decription+'" /></td>';
    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">View</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
    output += '</tr>';
	//output += '<tr><td colspan="2" style="text-align:right;">Total</td><td>'+total+'</td><td colspan="2"></td></tr>';

    $('#user_data').append(output);
   }
   else
   {
	 total+=parseInt(price);
	$("#total_amt").text(total);
	$("#total_amt1").val(total);
    var row_id = $('#hidden_row_id').val();
    output = '<td>'+count+'</td><td>'+service_name+' <input type="hidden" name="hidden_service_name[]" id="service_name'+row_id+'" class="service_name" value="'+service_id+'" /></td>';
    output += '<td>'+price+' <input type="hidden" name="hidden_price[]" id="price'+row_id+'" value="'+price+'" /></td>';
	output += '<td>'+decription+' <input type="hidden" name="hidden_decription[]" id="decription'+row_id+'" value="'+decription+'" /></td>';
    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">View</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
    $('#row_'+row_id+'').html(output);
   }

   $('#user_dialog').dialog('close');
  }
 });

 $(document).on('click', '.view_details', function(){
  var row_id = $(this).attr("id");
  var service_name = $('#service_name'+row_id+'').val();
  var price = $('#price'+row_id+'').val();
  var decription = $('#decription'+row_id+'').val();

  total-=parseInt(price);
  $("#total_amt").text(total);
  $("#total_amt1").val(total);

  $('#service_name').val(service_name);
  $('#price').val(price);
  $('#decription').val(decription);
  $('#save').text('Edit');
  $('#hidden_row_id').val(row_id);
  $('#user_dialog').dialog('option', 'title', 'Edit Service');
  $('#user_dialog').dialog('open');


 });

 $(document).on('click', '.remove_details', function(){
  var row_id = $(this).attr("id");

  var price = $('#price'+row_id+'').val();

  if(confirm("Are you sure you want to remove this row data?"))
  {
   $('#row_'+row_id+'').remove();

   total-=parseInt(price);
   $("#total_amt").text(total);
   $("#total_amt1").val(total);

  }
  else
  {
   return false;
  }
 });

 $('#action_alert').dialog({
  autoOpen:false
 });

 $('#user_form').on('submit', function(event){
  event.preventDefault();
  var count_data = 0;
  $('.service_name').each(function(){
   count_data = count_data + 1;
  });
  if(count_data > 0)
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:'<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/insert_invoice/',
    method:"POST",
    data:form_data,
    success:function(data)
    {

     $('#user_data').find("tr:gt(0)").remove();
     //$('#action_alert').html('<p>Data Inserted Successfully</p>');
	 //$('#action_alert').dialog('open');

	  window.location='<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/invoice_view/'+data;

    }
   })
  }
  else
  {
   $('#action_alert').html('<p>Please Add atleast one Service</p>');
   $('#action_alert').dialog('open');
  }
 });

});
</script>



    </div>
    <!-- panel-body -->
  </div>


</div>
<!-- contentpanel -->
