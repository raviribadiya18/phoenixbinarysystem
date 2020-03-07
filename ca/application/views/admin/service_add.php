

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



              <label class="col-sm-2 control-label">Service Name</label>



              <div class="col-sm-9">



                <?php $form_value = set_value('name', isset($result[0]['name']) ? $result[0]['name'] : '');?>



                <input type="text" class="form-control" id="name" name="name" value="<?=$form_value?>" required="required" placeholder="Service Name">



                <?php echo form_error('name', '<p class="error_p">', '</p>'); ?> </div>



            </div>



           <?php /*?><div class="form-group">

<label class="col-sm-2 control-label">Amount</label>

<div class="col-sm-9">

<?php $form_value = set_value('amount', isset($result[0]['amount']) ? $result[0]['amount'] : ''); ?>

<input type="number" class="form-control" id="amount" name="amount" required="required" value="<?=$form_value?>" placeholder="Amount">

<?php echo form_error('amount', '<p class="error_p">', '</p>'); ?> </div>

</div><?php */?>







		  <!--   <div class="form-group">



              <label class="col-sm-2 control-label">Service Details</label>



              <div class="col-sm-9">



                <?php $form_value = set_value('text_details', isset($result[0]['text_details']) ? $result[0]['text_details'] : '');?>



                <textarea class="form-control" id="text_details" name="text_details" required="required" placeholder="Service Details"><?=$form_value?></textarea>



                <?php echo form_error('text_details', '<p class="error_p">', '</p>'); ?> </div>



            </div> -->



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

