<script type="text/javascript">
$(document).ready(function(e) {
		$('#demo-dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
					"previous": '<i class="demo-psi-arrow-left"></i>',
					"next": '<i class="demo-psi-arrow-right"></i>'
				}
			},
			"order": [[ 0, "desc" ]]
		}); 
		
			$('#demo-dt-basic2').dataTable( {
		"responsive": true,
		"language": {
		"paginate": {
		"previous": '<i class="demo-psi-arrow-left"></i>',
		"next": '<i class="demo-psi-arrow-right"></i>'
		}
		}
		});  
});	
	
	<?php 
		if($result_due_amt[0]['tot_due_amt']!=0){

			$amt=$result_due_amt[0]['tot_due_amt'];

		}else{

			$amt="0.00";

		}
	?>

</script>
<div class="row">
					        <div class="col-md-3">
					            <div class="panel panel-warning panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-add-user icon-3x"></i>
					                    </div>
					                </div>
                                    
                                    
                                    
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold"><?=$tot_user[0]['tot_user'];?></p>
					                    <p class="mar-no">Total User</p>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-3">
					            <div class="panel panel-info panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-receipt-4 icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold"><?=count($result)?></p>
					                    <p class="mar-no">Notification</p>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-3">
					            <div class="panel panel-mint panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-data-storage icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold"><?=$amt;?></p>
					                    <p class="mar-no">Due Amount</p>
					                </div>
					            </div>
					        </div>
                            
                            
                            
					        <!--<div class="col-md-3">
					            <div class="panel panel-danger panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-psi-monitor-2 icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
                                        <a href="" style="color:#fff;">
                                            <p class="text-2x mar-no text-semibold">10</p>
                                            <p class="mar-no">Notification</p>
                                        </a>
					                </div>
					            </div>
					        </div>-->
					
					    </div>
 
 
                            <div class="row">
                            
                            <div class="col-md-12">      
                                             
                            <div class="panel">
                            <div class="panel-body">
                            <h3>Notification</h3>
                            
                            
                            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
							<th>Code</th>
                            <th>Title</th>
							<th>Description</th>	
							<th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
									
									uasort($result, 'cmp');
								
								
									for($i=0;$i<count($result);$i++){

								?>
								<tr>
									<td><?=$result[$i]['noti_code']?></td>
									<td><?=$result[$i]['noti_title']?></td>
									<td><?=$result[$i]['noti_desc']?></td>
									<td><?=date('d-m-Y',strtotime($result[$i]['create_date']))?></td>
								</tr>
                           
                            	<?php } ?>
                           
                            
                            </tbody>
                            </table>
                            
                            </div>
                            </div>
                            
                            
                            </div>

                            
                            </div>

<?php
		function cmp($a, $b) {

		if ($a['noti_code'] == $b['noti_code']) {

			return 0;

		}

		return ($a['noti_code'] < $b['noti_code']) ? 1 : -1;

		} 
?>
