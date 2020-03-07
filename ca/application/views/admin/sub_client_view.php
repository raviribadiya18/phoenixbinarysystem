
<link href="<?=asset_path()?>plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="<?=asset_path()?>plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
<link href="<?=asset_path()?>plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
<script src="<?=asset_path()?>plugins/data-tables/jquery.dataTables.js"></script>
<script src="<?=asset_path()?>plugins/data-tables/DT_bootstrap.js"></script>
<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
			"bProcessing": true,
			"iDisplayLength": 25,
			"responsive": true,
			"bDestroy": true
		});
    });


</script>

<?php $record = $this->comman_fun->get_table_data('membermaster', array('usercode' => $this->uri->rsegment(3)));

$name = ucfirst($record[0]['fname']) . ' ' . ucfirst($record[0]['lname']);

?>

<div class="contentpanel">
  <!-------------->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"><span><?=$name;?></span>
      	<span class="pull-right">

          			<div class="btn-group pull-right">
                    <a class="btn btn-success btn-small" style="margin-right: 2px; margin-top: 2px;" href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/addnew_member/add/<?=$this->uri->rsegment(3)?>">
            		Add New
            		</a><a style="margin-left: 5px; margin-top: 2px;" class="btn btn-danger btn-small" href="<?=file_path('admin')?>client/view">Back</a> </div>

        </span>
      </h4>
    </div>
    <div class="panel-body">

       <table class="table  table-bordered responsive" id="data-table">
            <thead>

              <tr>
                <th>Sr. No</th>
                <th>Name</th>
				<th>Company/Trust/Organization Name</th>
				<th>Mobile No</th>
            	<th>Email</th>
				<th>Due Amount</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?=$html?>
            </tbody>
          </table>
    </div>
    <!-- panel-body -->
  </div>
  <!-------------->

</div>
<!-- contentpanel -->

<style>
	.btn_custom {
    	padding: 3px 15px !important;
	}
</style>


