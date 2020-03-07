<?php $arr_filed = json_decode($option[0]['option'], true);?>


	<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

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

       <form action="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/insert" method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">

            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

            <input type="hidden" name="mode" id="mode" value="<?=$form_set['mode']?>" />

            <input type="hidden" name="eid" id="eid" value="<?=$form_set['eid']?>" />

            <input type="hidden" name="option_type" id="option_type" value="<?=$option[0]['contain_name']?>" />



 			<?php if (in_array('title', $arr_filed['option'])) {?>

            <?php $title = ($arr_filed['head_title'] != '') ? $arr_filed['head_title'] : "Title Text";?>

            <div class="form-group">

              <label class="col-sm-2 control-label"><?=$title?></label>

              <div class="col-sm-9">

                <?php $form_value = set_value('title', isset($result[0]['title']) ? $result[0]['title'] : '');?>

                <input type="text" class="form-control" id="title" name="title" value="<?=$form_value?>" required="required" placeholder="<?=$title?>">

                <?php echo form_error('title', '<p class="error_p">', '</p>'); ?> </div>

            </div>

            <?php }?>

            <!--/form-group-->

            <?php if (in_array('date', $arr_filed['option'])) {?>

                 <div class="form-group">

                  <label class="col-sm-2 control-label">Date</label>

                  <div class="col-sm-9">

                    <?php $form_value = set_value('timedt', isset($result[0]['timedt']) ? date('d-m-Y', $result[0]['timedt']) : '');?>

                    <input type="text" class="form-control default-date-picker" id="timedt" name="timedt" value="<?=$form_value?>" required="required" placeholder="Publish Date">

                    <?php echo form_error('timedt', '<p class="error_p">', '</p>'); ?> </div>
                </div>
                <!--/form-group-->
         	<?php }?>



            <?php if (in_array('image', $arr_filed['option'])) {?>

            <div class="form-group">

              <label class="col-sm-2 control-label">Image</label>

              <div class="col-sm-9">
                <input type="file" class="form-control1" id="upload_file" name="upload_file" style="display:inline;">
                <input type="hidden" name="old_file" value="<?=$result[0]['img_name']?>" />
                <?php if ($result[0]['img_name'] != '') {?>
                		<img src="<?=base_url()?>upload/web/slider/<?=$result[0]['img_name']?>" height="50" />
                <?php }?>

                <?php echo form_error('upload_file', '<p class="error_p">', '</p>'); ?> </div>
            </div>
            <!--/form-group-->
            <?php }?>

             <?php if (in_array('description', $arr_filed['option'])) {?>

            <div class="form-group">

              <label class="col-sm-2 control-label"><?=$arr_filed['desc_title']?></label>
              <div class="col-sm-9">
                <?php $form_value = set_value('description', isset($result[0]['description']) ? $result[0]['description'] : '');?>
                <textarea class="form-control" id="description" name="description" required><?=$form_value?></textarea>
                 <?php if (in_array('ckeditor', $arr_filed['option'])) {?>
               		 <script type="text/javascript">CKEDITOR.replace('description');</script>
                 <?php }?>
              </div>
            </div>
            <?php }?>

             <?php if (in_array('sort_order', $arr_filed['option'])) {?>
             <div class="form-group">
              <label class="col-sm-2 control-label">Sort Order <span class="req">*</span></label>
              <div class="col-sm-9">
                <?php $form_value = set_value('sort_order', isset($result[0]['sort_order']) ? $result[0]['sort_order'] : '0');?>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?=$form_value?>" required="required" placeholder="Sort Order">
                <?php echo form_error('sort_order', '<p class="error_p">', '</p>'); ?> </div>
            </div>
            <!--/form-group-->
             <?php }?>

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
<!-- contentpanel -->
<?php if ($option[0]['contain_name'] == 'back_office_q2A') {?>
<style>
	#description{
		height:250px;
	}
</style>
<?php }?>