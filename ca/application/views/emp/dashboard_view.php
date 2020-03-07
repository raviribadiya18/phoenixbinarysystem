<script type="text/javascript">
$(document).ready(function(e) {
		$('#demo-dt-basic').dataTable( {
		"responsive": true,
		"language": {
		"paginate": {
		"previous": '<i class="demo-psi-arrow-left"></i>',
		"next": '<i class="demo-psi-arrow-right"></i>'
		}
		}
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
					                    <p class="text-2x mar-no text-semibold"><?=$count_initial[0]['tot_task']?></p>
					                    <p class="mar-no">Initial</p>
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
					                    <p class="text-2x mar-no text-semibold"><?=$count_inprogress[0]['tot_task']?></p>
					                    <p class="mar-no">Inprogress</p>
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
					                    <p class="text-2x mar-no text-semibold"><?=$count_completed[0]['tot_task']?></p>
					                    <p class="mar-no">Completed</p>
					                </div>
					            </div>
					        </div>
                            
                            
                            
					        <div class="col-md-3">
					            <div class="panel panel-danger panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-psi-monitor-2 icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
                                        <a href="" style="color:#fff;">
                                            <p class="text-2x mar-no text-semibold"><?=$count_pending[0]['tot_task']?></p>
                                            <p class="mar-no">Pending</p>
                                        </a>
					                </div>
					            </div>
					        </div>
					
					    </div>
 
<div class="row">
					      
					    </div>
 
 
                            <div class="row">
                            
                          <?php /*?>  <div class="col-md-12">      
                                             
                            <div class="panel">
                            <div class="panel-body">
                            <h3>Login Details</h3>
                            
                            
                            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Date</th>
                            <th>IP</th>
                           
                            <!-- <th>#</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            
                           
                            
                            </tbody>
                            </table>
                            
                            </div>
                            </div>
                            
                            
                            </div><?php */?>

                            
                            </div>
