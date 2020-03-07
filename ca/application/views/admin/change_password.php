

<div class="contentpanel">
  <!-------------->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"><?=$sub_title?></h4>
    </div>
    <div class="panel-body">
       <form method="post" class="form-horizontal row-border" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata['pbm_superadmin']['usercode']; ?>" />


            <div class="form-group">
              <label class="col-sm-2 control-label">Old Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="old_pass" name="old_pass" required="required" placeholder="Old Password">
                <?php echo form_error('old_pass', '<p class="error_p">', '</p>'); ?> </div>
            </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">New Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="new_pass" name="new_pass" required="required" placeholder="New Password">
                <?php echo form_error('new_pass', '<p class="error_p">', '</p>'); ?> </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Confirm New Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="con_pass" name="con_pass" required="required" placeholder="Confirm New Password">
                <?php echo form_error('con_pass', '<p class="error_p">', '</p>'); ?> </div>
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
