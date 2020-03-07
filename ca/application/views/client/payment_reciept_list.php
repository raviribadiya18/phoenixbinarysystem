
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
		//alert($(this).val());
		var url='<?=file_path('client')?><?=$this->uri->rsegment(1)?>/view/'+$(this).val()
		//alert(url);
		window.location.href=url;
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
    	 <div>
            <select name="all_option" id="all_option" class="form-control" style="width:200px;margin-bottom:15px;">
				<option value="0">All</option>
              <?php for($i=0;$i<count($all_option);$i++){
							$sel=($this->uri->rsegment(3)==$all_option[$i]['id'])? "selected='selected'" : "";
							echo '<option '.$sel.' value="'.$all_option[$i]['id'].'">'.$all_option[$i]['fname'].' '.$all_option[$i]['lname'].'</option>';
						}?>
            </select>
          </div>
       <table class="table  table-bordered responsive" id="data-table">
            <thead>
            	
              <tr>
                <th>Sr. No</th>
                <th>User Name</th>
				<th>Reciept</th>
				<th>Received Amount</th>  
				<th>Discount Amount</th>    
				<th>Date</th>
				
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


