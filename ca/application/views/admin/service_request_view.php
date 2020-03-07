
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
	
	$(document).on('change','#all_option',function(e){
		
		var url='<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/view/'+$(this).val()
		
		window.location.href=url;
	});	
	
</script>



<div class="contentpanel"> 
  <!-------------->
  <div class="panel panel-default">
    <!--<div class="panel-heading">
      <h4 class="panel-title"><?=$sub_title?>
      	
      </h4>
    </div>-->
    <div class="panel-body">
    	 
       <table class="table  table-bordered responsive" id="data-table">
            <thead>
            	
              <tr>
                <th>Sr. No</th>
				<th>Client Name</th>
				<th>Request For</th>  
                <th>Service Name</th>
				<th>Service Details</th>
				<th>Date</th>    
				<th>Request Seen</th>
				
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


