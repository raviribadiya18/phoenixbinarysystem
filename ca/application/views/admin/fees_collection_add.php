
<?php $record = $this->comman_fun->get_table_data('sub_membermaster', array('id' => $this->uri->rsegment(5)));

$name = ucfirst($record[0]['fname']) . ' ' . ucfirst($record[0]['lname']);

?>
<style>
.dis_none{

	display:none;
}
</style>
<script>

		$(document).on('change','#pay_type',function(e){

			if($(this).val()=='cash' || $(this).val()=='Net Banking' || $(this).val()==''){

				$('.payment_div').addClass('dis_none');
				$('.gen_req').prop('required',false);
			}else{
				$('.payment_div').removeClass('dis_none');
				$('.gen_req').prop('required',true);
			}
		});

		$(document).on('keyup','#amount',function(e){



			var amount = $('#amount').val();

			var due_amount = $('#due_amount').val();

			 if(amount>=0){

					if(parseFloat(Number(amount).toFixed(2))>due_amount){

						alert('The Amount is not grater than due amount.');

						amount.focus();
					}
			 }else{

				 alert("Please Enter valid amount");
			 }

		});

		$(document).on('keyup','#discount_amount',function(e){


			var amount = $('#amount').val();

			var damount = $('#discount_amount').val();

			var due_amount = $('#due_amount').val();

			var total_amt= parseFloat(Number(amount).toFixed(2))+parseFloat(Number(damount).toFixed(2));

		//	alert(total_amt);
		 if(damount>=0){

			 if(total_amt>due_amount){

				alert('Please Enter Valid Discount Amount. Your Discount Limit is Over.');

				damount.focus();
			}

		 }else{

			 alert("Please Enter valid amount");
		 }


		});




</script>
<script>
	$(document).ready(function(e) {



		$(document).on('change','#invoice_no',function(e){
			//alert('hi');
			e.preventDefault();
			var eid=$(this).val();
			var url='<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/get_price/'+eid;
			//alert(url);
			$.ajax({url:url,
				beforeSend: function(){
     				$('.process1').append('<span class="loding_process"> <i class="fa fa-spinner fa-spin"></i></span>');
   				},
   				complete: function(){
     				$('.loding_process').remove();
   				},
				success:function(result){
					//alert(result);
					$('#due_amount').val(result);
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

      <h4 class="panel-title"><span style="font-size: 15px;"><?=$name;?></span></h4>

    </div>

    <div class="panel-body">

       <form action="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/insert" id="amtsubmin" method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">

            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />

            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />

		   <input type="hidden" name="usercode" id="usercode" value="<?=$form_set['usercode']?>" />

        	<input type="hidden" name="suid" id="suid" value="<?=$form_set['suid']?>" />

		   	<div class="form-group">

              <label class="col-sm-2 control-label">Select Invoice</label>

              <div class="col-sm-9">


				  <select class="form-control" id="invoice_no" name="invoice_no" required>
				  	<option value="">Please Select Invoice</option>
					  <?php for ($i = 0; $i < count($unpaid_invoice); $i++) {?>
					  <option value="<?=$unpaid_invoice[$i]['invoice_id']?>"><?=$unpaid_invoice[$i]['invoice_id']?> ( <?=$unpaid_invoice[$i]['total_amt']?> )</option>
					  <?php }?>
				  </select>

                </div>

            </div>


            <div class="form-group">

              <label class="col-sm-2 control-label">Date</label>

              <div class="col-sm-9">

            	<?php $form_value = set_value('date_info', isset($result[0]['date_info']) ? $result[0]['date_info'] : '');?>
                <input type="date" class="form-control" name="date_info" value="<?=$form_value?>"  required>
                <?php echo form_error('date_info', '<p class="error_p">', '</p>'); ?>
               </div>

            </div>



		    <div class="form-group">

              <label class="col-sm-2 control-label">Payment Type</label>

              <div class="col-sm-9">
              	<?php $form_value = set_value('pay_type', isset($result[0]['pay_type']) ? $result[0]['pay_type'] : '');?>
				  <?php
if ($form_value == "cash") {

	$sel1 = "selected";

} else {

	$sel1 = "";

}

if ($form_value == "cheque") {

	$sel2 = "selected";

} else {

	$sel2 = "";

}
if ($form_value == "cheque") {

	$sel3 = "selected";

} else {
	$sel3 = "";
}
?>
				  <select id="pay_type" name="pay_type" class="form-control" required>
				  	<option value="">Please Select</option>
					<option <?=$sel1?> value="cash">Cash</option>
					<option <?=$sel2?> value="cheque">Cheque</option>
					<option <?=$sel3?> value="Net Banking">Net Banking</option>
				  </select>

                 <?php echo form_error('pay_type', '<p class="error_p">', '</p>'); ?>
               </div>

            </div>

		      <div class="form-group">

              <label class="col-sm-2 control-label">Due Amount</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('due_amount', isset($result[0]['due_amount']) ? $result[0]['due_amount'] : '');?>

                <input type="text" class="form-control" id="due_amount" name="due_amount" readonly value="<?=$form_value?>">

                <?php echo form_error('due_amount', '<p class="error_p">', '</p>'); ?> </div>

            </div>


            <div class="form-group">

              <label class="col-sm-2 control-label">Amount</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('amount', isset($result[0]['amount']) ? $result[0]['amount'] : '');?>

                <input type="number" min="0" class="form-control" id="amount" name="amount" required="required" value="<?=$form_value?>" placeholder="Amount">

                <?php echo form_error('amount', '<p class="error_p">', '</p>'); ?> </div>

            </div>

		   <div class="form-group">

              <label class="col-sm-2 control-label">Discount</label>

              <div class="col-sm-9">

                <?php $form_value = set_value('discount_amount', isset($result[0]['discount_amount']) ? $result[0]['discount_amount'] : '0');?>

                <input type="number" min="0" class="form-control" id="discount_amount" name="discount_amount" required="required" value="<?=$form_value?>" placeholder="Discount">

                <?php echo form_error('discount_amount', '<p class="error_p">', '</p>'); ?> </div>

            </div>



		   	 <?php
if ($form_set['mode'] == "edit") {
	if ($pay_type == 'cheque' || $pay_type == 'dd') {
		$cls = '';
		$req = 'required="required"';
	} else {
		$cls = 'dis_none';
	}

	if ($result[0]['pay_type'] == "cash") {
		$cls = 'dis_none';
	} else {
		$cls = '';
	}
} else {

	if ($pay_type == 'cheque' || $pay_type == 'dd') {
		$cls = '';
		$req = 'required="required"';
	} else {
		$cls = 'dis_none';
	}

}
?>

		   	<div class="payment_div <?=$cls?>">

			   <div class="form-group">

				  <label class="col-sm-2 control-label">Cheque/DD No.</label>

				  <div class="col-sm-9">

					<?php $form_value = set_value('cheque_dd_no', isset($result[0]['cheque_dd_no']) ? $result[0]['cheque_dd_no'] : '');?>

					<input type="text" class="form-control gen_req" id="cheque_dd_no" name="cheque_dd_no"  <?=$req?>  value="<?=$form_value?>" placeholder="Cheque/DD No">

					<?php echo form_error('cheque_dd_no', '<p class="error_p">', '</p>'); ?> </div>

				</div>

			   <div class="form-group">

				  <label class="col-sm-2 control-label">Bank Name</label>

				  <div class="col-sm-9">

					<?php $form_value = set_value('bank_name', isset($result[0]['bank_name']) ? $result[0]['bank_name'] : '');?>

					<input type="text" class="form-control gen_req" id="bank_name" name="bank_name" <?=$req?> value="<?=$form_value?>" placeholder="Bank Name">

					<?php echo form_error('bank_name', '<p class="error_p">', '</p>'); ?> </div>

				</div>

			   <div class="form-group">

				  <label class="col-sm-2 control-label">Cheque/DD Date</label>

				  <div class="col-sm-9">

					<?php $form_value = set_value('cheque_dd_date', isset($result[0]['cheque_dd_date']) ? $result[0]['cheque_dd_date'] : '');?>

					<input type="date" class="form-control gen_req" id="cheque_dd_date" name="cheque_dd_date"  <?=$req?>  value="<?=$form_value?>">

					<?php echo form_error('cheque_dd_date', '<p class="error_p">', '</p>'); ?> </div>

				</div>



		   </div>

		     <div class="form-group">

				  <label class="col-sm-2 control-label">Description</label>

				  <div class="col-sm-9">

					<?php $form_value = set_value('description', isset($result[0]['description']) ? $result[0]['description'] : '');?>

					<input type="text" class="form-control" id="description" name="description" required="required" value="<?=$form_value?>" placeholder="Description">

					<?php echo form_error('description', '<p class="error_p">', '</p>'); ?> </div>

				</div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/view/<?=$this->uri->rsegment(4)?>/<?=$this->uri->rsegment(5)?>">
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
