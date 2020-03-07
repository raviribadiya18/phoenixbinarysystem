<?php 
	$arr_filed=json_decode($option[0]['option'],true);		
?>
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
		var url='<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/view/'+$(this).val()
		
		window.location.href=url;
	});	
	
</script>



<div class="contentpanel"> 
  <!-------------->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"><?=$sub_title?>
      	<span class="pull-right">
        	 <?php if(in_array('addnew',$arr_filed['option'])){?>
          			<div class="btn-group pull-right"> 
                    <a class="btn btn-success btn-small" href="<?=file_path('admin')?>/<?=$this->uri->rsegment(1)?>/addnew/add/<?=$option[0]['contain_name']?>">
            		Add New
            		</a></div>
              <?php } ?>      
        </span>
      </h4>
    </div>
    <div class="panel-body">
    	 <div>
            <select name="all_option" id="all_option" class="form-control" style="width:200px;margin-bottom:15px;">
              <?php for($i=0;$i<count($all_option);$i++){
							$sel=($this->uri->rsegment(3)==$all_option[$i]['contain_name'])? "selected='selected'" : "";
							echo '<option '.$sel.' value="'.$all_option[$i]['contain_name'].'">'.$all_option[$i]['contain_lable'].'</option>';
						}?>
            </select>
          </div>
       <table class="table  table-bordered responsive" id="data-table">
            <thead>
            	<?php	
            		$title = ($arr_filed['head_title']!='') ? $arr_filed['head_title']:"Title";
				?>
				
              <tr>
                <th>Sr. No</th>
                <th>Type</th>
                <?php if(in_array('title',$arr_filed['option'])){?>
                <th><?=$title?></th>
                <?php } ?>
                <?php if(in_array('image',$arr_filed['option'])){?>
                <th>Image</th>
                <?php } ?>
                <?php if(in_array('date',$arr_filed['option'])){?>
                <th>Date</th>
                <?php } ?>
                <th>Opration</th>
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


