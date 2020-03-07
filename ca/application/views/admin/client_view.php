
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



<div class="contentpanel">
  <!-------------->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"><?=$sub_title?>
      	<span class="pull-right">

          			<div class="btn-group pull-right">
                    <a class="btn btn-success btn-small" href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/addnew/add">
            		Add New
            		</a><a class="btn btn-danger btn-small" style="margin-left: 5px;" target="_blank" href="<?=file_path('admin')?>client_ie">
            		Import Excel
            		</a><a class="btn btn-success btn-small" style="margin-left: 5px;" target="_blank" href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/export_income_report_view">
            		Income Report
            		</a></div>

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
				<!-- <th>Username</th>
				<th>Password</th>   -->
            	<th>Mobile No</th>
            	<th>Email</th>
				<th>City</th>
				<th>Amount</th>
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
	.myDropDown
	{
	   height: 180px;
	   overflow: auto;
	}
</style>


