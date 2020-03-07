<link href="<?=asset_path()?>datatable/style.datatables.css" rel="stylesheet">
<link href="<?=asset_path()?>datatable/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?=asset_path()?>datatable/dataTables.responsive.css" rel="stylesheet">
<script src="<?=asset_path()?>datatable/jquery.dataTables.min.js"></script>
<script src="<?=asset_path()?>datatable/dataTables.responsive.js"></script>
<script src="<?=asset_path()?>datatable/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function(e) {
         $('#data-table').DataTable({
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
      	
      </h4>
    </div>
    <div class="panel-body">
    	 
       <table class="table  table-bordered responsive" id="data-table">
            <thead>
            	
				
              <tr>
                <th>Sr. No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
				<th>File</th>  
                <th>Date</th>
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



